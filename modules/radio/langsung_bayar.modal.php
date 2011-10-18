<?
Class Langsung_Bayar {
	function buka_langsung_bayar($idlk) {
		unset($_SESSION[radio][langsung_bayar]);
		$kon = new Konek;
		//$kon->debug = 1;
		$objResponse = new xajaxResponse;
		//get data pasien
		$kon->sql = "
			SELECT
				lk.kunjungan_kamar_id as kunjungan_kamar_id, 
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				p.sex as jk,
				lk.tgl_periksa as tgl_periksa,
				CONCAT_WS(' - ', lk.cara_masuk, kmr.nama) as cara_masuk,
				CONCAT_WS(' - ', lk.cara_bayar, lk.jenis_askes, rper.nama) as cara_bayar,
				lk.nomor as nomor
			FROM
				radio_kunjungan lk
				JOIN pasien p ON (p.id = lk.pasien_id)
				LEFT JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
			WHERE
				lk.id = '".$idlk."'
			GROUP BY
				p.id
		";
		$kon->execute();
		$data_pasien = $kon->getOne();
		$arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
		$data_pasien[usia] = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
		$data_pasien[usia] .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
		$data_pasien[usia] .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
		$objResponse->addClear("modal_lb", "style.display");
		$objResponse->addAssign("lb_id_kunjungan_radio", "value", $idlk);
		$objResponse->addAssign("lb_id_kunjungan_kamar", "value", $data_pasien[id_kunjungan_kamar]);
		$objResponse->addAssign("lb_no_rm", "innerHTML", $data_pasien[id_display]);
		$objResponse->addAssign("lb_pasien", "innerHTML", $data_pasien[nama]);
		$objResponse->addAssign("lb_sex", "innerHTML", $data_pasien[jk]);
		$objResponse->addAssign("lb_usia", "innerHTML", $data_pasien[usia]);
		$objResponse->addAssign("lb_alamat", "innerHTML", $data_pasien[alamat]);
		$objResponse->addAssign("lb_tgl_periksa", "innerHTML", tanggalIndo($data_pasien[tgl_periksa], 'j F Y'));
		$objResponse->addAssign("lb_cara_bayar", "innerHTML", $data_pasien[cara_bayar]);
		$objResponse->addAssign("lb_nomor", "innerHTML", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);

		//BIKIN SESSION UNTUK DICETAK
		$_SESSION[radio][langsung_bayar][data_px] = $data_pasien;

		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->cellspacing = "0";
		$tabel->extra_table = "style=\"width:9cm;\"";
		$tabel->addTh("No", "Jasa", "Biaya");
		$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "");
		//get data pemeriksaan
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.radio_pemeriksaan_id IS NOT NULL
				AND lk.id = '".$idlk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_pemeriksaan = $kon->getAll();
		if(!empty($data_pemeriksaan)) {
			$tabel->addRow("","<b>Pemeriksaan</b>","");
			for($i=0;$i<sizeof($data_pemeriksaan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_pemeriksaan[$i][nama],
					uangIndo($data_pemeriksaan[$i][bayar])
				);
				$total += $data_pemeriksaan[$i][bayar];
				$sudah_dibayar += $data_pemeriksaan[$i][mampu_bayar];
				//belum bayar
				if(!$data_pemeriksaan[$i][kwitansi_id]) $kurang += $data_pemeriksaan[$i][bayar];
			}
		}

		//get data bhp
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp as bayar,
				kb.mampu_bayar_bhp as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.bhp_id IS NOT NULL
				AND lk.id = '".$idlk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();
		if(!empty($data_bhp)) {
			$tabel->addRow("","<b>Bahan Habis Pakai</b>","");
			for($i=0;$i<sizeof($data_bhp);$i++) {
				$tabel->addRow(
					($i+1),
					$data_bhp[$i][nama],
					uangIndo($data_bhp[$i][bayar])
				);
				$total += $data_bhp[$i][bayar];
				$sudah_dibayar += $data_bhp[$i][mampu_bayar];
				//belum bayar
				if(!$data_bhp[$i][kwitansi_id]) $kurang += $data_bhp[$i][bayar];
			}
		}
		
		$tabel->addRow("","<b>Total</b>", uangIndo($total));
		$tabel_jasa = $tabel->build();
		$objResponse->addAssign("lb_list_jasa", "innerHTML", $tabel_jasa);

		$objResponse->addAssign("lb_total_display", "value", uangIndo($total));
		$objResponse->addAssign("lb_total_display", "title", terbilang($total));
		$objResponse->addAssign("lb_sudah_dibayar_display", "value", uangIndo($sudah_dibayar));
		$objResponse->addAssign("lb_sudah_dibayar_display", "title", terbilang($sudah_dibayar));
		$objResponse->addAssign("lb_kurang_display", "value", uangIndo($kurang));
		$objResponse->addAssign("lb_kurang", "value", $kurang);
		$objResponse->addAssign("lb_kurang_display", "title", terbilang($kurang));
		$objResponse->addAssign("lb_mampu_bayar", "value", $kurang);
		$objResponse->addAssign("mampu_terbilang", "innerHTML", terbilang($kurang));

		//get data kwitansi :
		$kon->sql = "
			SELECT
				CONCAT_WS('-', kw.tempat_pembayaran, kw.id) as no_kwitansi,
				kw.bayar as mampu_bayar,
				kw.tgl as tgl
			FROM
				kunjungan_bayar kb
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kwitansi kw ON (kw.id = kwd.kwitansi_id)
			WHERE
				kb.radio_kunjungan_id = '".$idlk."'
				AND kw.tempat_pembayaran = 'RADIO'
			GROUP BY
				kw.id
			ORDER BY 
				kw.id
		";
		$kon->execute();
		$data_kw = $kon->getAll();

		if($kurang) {
			//ada yang belum dibayar
			$objResponse->addAssign("lb_simpan", "style.display", "");
		}

		if(!empty($data_kw)) {
			//ada yang sudah dibayar
			for($i=0;$i<sizeof($data_kw);$i++) {
				$kw .= "<br /><input type=\"button\" name=\"lb_cetak\" id=\"lb_cetak\" value=\"Cetak Kwitansi ".$data_kw[$i][no_kwitansi]."\" class=\"inputan\" onclick=\"cetak_kwitansi('".$data_kw[$i][no_kwitansi]."');\" /> <br /> <em>Rp.&nbsp;".uangIndo($data_kw[$i][mampu_bayar])."&nbsp;-&nbsp;".tanggalIndo($data_kw[$i][tgl], "j F Y H:i")."</em><br />";
			}
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "");
			$objResponse->addAssign("lb_button_kwitansi", "innerHTML", $kw);
			if(!$kurang) $objResponse->addAssign("lb_simpan", "style.display", "none");
		} else {
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "none");
		}
		return $objResponse;
	}


    function buka_langsung_bayar1($idlk) {
		unset($_SESSION[radio][langsung_bayar]);
		$kon = new Konek;
		//$kon->debug = 1;
		$objResponse = new xajaxResponse;
		//get data pasien
		$kon->sql = "
			SELECT
				lk.kunjungan_kamar_id as kunjungan_kamar_id, 
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				p.sex as jk,
				lk.tgl_periksa as tgl_periksa,
				CONCAT_WS(' - ', lk.cara_masuk, kmr.nama) as cara_masuk,
				CONCAT_WS(' - ', lk.cara_bayar, lk.jenis_askes, rper.nama) as cara_bayar,
				lk.nomor as nomor
			FROM
				radio_kunjungan lk
				JOIN pasien p ON (p.id = lk.pasien_id)
				LEFT JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
			WHERE
				lk.id = '".$idlk."'
			GROUP BY
				p.id
		";
		$kon->execute();
		$data_pasien = $kon->getOne();
		$arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
		$data_pasien[usia] = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
		$data_pasien[usia] .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
		$data_pasien[usia] .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
        if($val[lb_mampu_bayar] < $val[lb_kurang]) $status = "ANGSUR";
			else $status = "LUNAS";
		$id_kwitansi = bikinKwitansi("RADIO", $val[lb_mampu_bayar], $status);
        $id_kwitansi = tambahNol($id_kwitansi, 20);
		$objResponse->addClear("modal_lb", "style.display");
        $objResponse->addAssign("lb_no_trs", "innerHTML", "RADIO-".$id_kwitansi);
		$objResponse->addAssign("lb_id_kunjungan_radio", "value", $idlk);
		$objResponse->addAssign("lb_id_kunjungan_kamar", "value", $data_pasien[id_kunjungan_kamar]);
		$objResponse->addAssign("lb_no_rm", "innerHTML", $data_pasien[id_display]);
		$objResponse->addAssign("lb_pasien", "innerHTML", $data_pasien[nama]);
		$objResponse->addAssign("lb_sex", "innerHTML", $data_pasien[jk]);
		$objResponse->addAssign("lb_usia", "innerHTML", $data_pasien[usia]);
		$objResponse->addAssign("lb_alamat", "innerHTML", $data_pasien[alamat]);
		$objResponse->addAssign("lb_tgl_periksa", "innerHTML", tanggalIndo($data_pasien[tgl_periksa], 'j F Y'));
		$objResponse->addAssign("lb_cara_bayar", "innerHTML", $data_pasien[cara_bayar]);
		$objResponse->addAssign("lb_nomor", "innerHTML", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);

		//BIKIN SESSION UNTUK DICETAK
		$_SESSION[radio][langsung_bayar][data_px] = $data_pasien;

		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->cellspacing = "0";
		$tabel->extra_table = "style=\"width:9cm;\"";
		$tabel->addTh("No", "Jasa", "Biaya");
		$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "");
		//get data pemeriksaan
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.radio_pemeriksaan_id IS NOT NULL
				AND lk.id = '".$idlk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_pemeriksaan = $kon->getAll();
		if(!empty($data_pemeriksaan)) {
			$tabel->addRow("","<b>Pemeriksaan</b>","");
			for($i=0;$i<sizeof($data_pemeriksaan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_pemeriksaan[$i][nama],
					uangIndo($data_pemeriksaan[$i][bayar])
				);
				$total += $data_pemeriksaan[$i][bayar];
				$sudah_dibayar += $data_pemeriksaan[$i][mampu_bayar];
				//belum bayar
				if(!$data_pemeriksaan[$i][kwitansi_id]) $kurang += $data_pemeriksaan[$i][bayar];
			}
		}

		//get data bhp
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp as bayar,
				kb.mampu_bayar_bhp as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.bhp_id IS NOT NULL
				AND lk.id = '".$idlk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();
		if(!empty($data_bhp)) {
			$tabel->addRow("","<b>Bahan Habis Pakai</b>","");
			for($i=0;$i<sizeof($data_bhp);$i++) {
				$tabel->addRow(
					($i+1),
					$data_bhp[$i][nama],
					uangIndo($data_bhp[$i][bayar])
				);
				$total += $data_bhp[$i][bayar];
				$sudah_dibayar += $data_bhp[$i][mampu_bayar];
				//belum bayar
				if(!$data_bhp[$i][kwitansi_id]) $kurang += $data_bhp[$i][bayar];
			}
		}
		
		$tabel->addRow("","<b>Total</b>", uangIndo($total));
		$tabel_jasa = $tabel->build();
		$objResponse->addAssign("lb_list_jasa", "innerHTML", $tabel_jasa);

		$objResponse->addAssign("lb_total_display", "value", uangIndo($total));
		$objResponse->addAssign("lb_total_display", "title", terbilang($total));
		$objResponse->addAssign("lb_sudah_dibayar_display", "value", uangIndo($sudah_dibayar));
		$objResponse->addAssign("lb_sudah_dibayar_display", "title", terbilang($sudah_dibayar));
		$objResponse->addAssign("lb_kurang_display", "value", uangIndo($kurang));
		$objResponse->addAssign("lb_kurang", "value", $kurang);
		$objResponse->addAssign("lb_kurang_display", "title", terbilang($kurang));
		$objResponse->addAssign("lb_mampu_bayar", "value", $kurang);
		$objResponse->addAssign("mampu_terbilang", "innerHTML", terbilang($kurang));

		//get data kwitansi :
		$kon->sql = "
			SELECT
				CONCAT_WS('-', kw.tempat_pembayaran, kw.id) as no_kwitansi,
				kw.bayar as mampu_bayar,
				kw.tgl as tgl
			FROM
				kunjungan_bayar kb
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kwitansi kw ON (kw.id = kwd.kwitansi_id)
			WHERE
				kb.radio_kunjungan_id = '".$idlk."'
				AND kw.tempat_pembayaran = 'RADIO'
			GROUP BY
				kw.id
			ORDER BY 
				kw.id
		";
		$kon->execute();
		$data_kw = $kon->getAll();

		if($kurang) {
			//ada yang belum dibayar
			$objResponse->addAssign("lb_simpan", "style.display", "");
		}

		if(!empty($data_kw)) {
			//ada yang sudah dibayar
			for($i=0;$i<sizeof($data_kw);$i++) {
				$kw .= "<br /><input type=\"button\" name=\"lb_cetak\" id=\"lb_cetak\" value=\"Cetak Kwitansi ".$data_kw[$i][no_kwitansi]."\" class=\"inputan\" onclick=\"cetak_kwitansi('".$data_kw[$i][no_kwitansi]."');\" /> <br /> <em>Rp.&nbsp;".uangIndo($data_kw[$i][mampu_bayar])."&nbsp;-&nbsp;".tanggalIndo($data_kw[$i][tgl], "j F Y H:i")."</em><br />";
			}
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "");
			$objResponse->addAssign("lb_button_kwitansi", "innerHTML", $kw);
			if(!$kurang) $objResponse->addAssign("lb_simpan", "style.display", "none");
		} else {
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "none");
		}
		return $objResponse;
	}

	function simpan_langsung_bayar($val) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.bayar_jasa as bayar_jasa FROM kunjungan_bayar kb LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kb.radio_kunjungan_id = '".$val[lb_id_kunjungan_radio]."' AND kwd.kwitansi_id IS NULL";
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
			if($val[lb_mampu_bayar] < $val[lb_kurang]) $status = "ANGSUR";
			else $status = "LUNAS";
			$id_kwitansi = bikinKwitansi("RADIO", $val[lb_mampu_bayar], $status);
			$mampu = round($val[lb_mampu_bayar]/$val[lb_kurang], 2);
			$tot = 0;
			for($i=0;$i<sizeof($data);$i++) {
				$data[$i][mampu_bayar_bhp] = round($data[$i][bayar_bhp] * $mampu);
				$data[$i][mampu_bayar_jasa] = round($data[$i][bayar_jasa] * $mampu);
				$tot += $data[$i][mampu_bayar_bhp] + $data[$i][mampu_bayar_jasa];
			}
			$selisih = $val[lb_mampu_bayar] - $tot;
			if($data[0][mampu_bayar_jasa]) $data[0][mampu_bayar_jasa] += $selisih;
			else $data[0][mampu_bayar_bhp] += $selisih;

			for($i=0;$i<sizeof($data);$i++) {
				//$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwitansi_id = '".$id_kwitansi."', tempat_pembayaran = 'RADIO' WHERE id = '".$data[$i][id]."'";
				//$kon->execute();
				$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwid = '".$id_kwitansi."' WHERE id = '".$data[$i][id]."'";
				$kon->execute();
				//pembayaran angsuran
				$kon->sql = "INSERT INTO kwitansi_detil(kunjungan_bayar_id, kwitansi_id, angsuran_bhp, angsuran_jasa) VALUES ('".$data[$i][id]."', '".$id_kwitansi."', '".$data[$i][mampu_bayar_bhp]."', '".$data[$i][mampu_bayar_jasa]."')";
				$kon->execute();
			}
			$id_kwitansi = tambahNol($id_kwitansi, 20);
			$objResponse->addScriptCall("cetak_kwitansi", "RADIO-" . $id_kwitansi);
			$objResponse->addScriptCall("show_status_simpan");
		} else {
			$objResponse->addAlert("Data Pembayaran Tidak Dapat Dirubah, karena : \n1. Kwitansi Sudah Dibuat atau\n2. Belum Terjadi Transaksi!");
		}
		$objResponse->addScriptCall("tutup_modal_lb");
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		return $objResponse;
	}

    function simpan_langsung_bayar1($val) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.bayar_jasa as bayar_jasa FROM kunjungan_bayar kb LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kb.radio_kunjungan_id = '".$val[lb_id_kunjungan_radio]."' AND kwd.kwitansi_id IS NULL";
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
			if($val[lb_mampu_bayar] < $val[lb_kurang]) $status = "ANGSUR";
			else $status = "LUNAS";
			$id_kwitansi = bikinKwitansi("RADIO", $val[lb_mampu_bayar], $status);
			$mampu = round($val[lb_mampu_bayar]/$val[lb_kurang], 2);
			$tot = 0;
			for($i=0;$i<sizeof($data);$i++) {
				$data[$i][mampu_bayar_bhp] = round($data[$i][bayar_bhp] * $mampu);
				$data[$i][mampu_bayar_jasa] = round($data[$i][bayar_jasa] * $mampu);
				$tot += $data[$i][mampu_bayar_bhp] + $data[$i][mampu_bayar_jasa];
			}
			$selisih = $val[lb_mampu_bayar] - $tot;
			if($data[0][mampu_bayar_jasa]) $data[0][mampu_bayar_jasa] += $selisih;
			else $data[0][mampu_bayar_bhp] += $selisih;

		for($i=0;$i<sizeof($data);$i++) {
				//$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwitansi_id = '".$id_kwitansi."', tempat_pembayaran = 'RADIO' WHERE id = '".$data[$i][id]."'";
				//$kon->execute();
				$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwid = '".$id_kwitansi."' WHERE id = '".$data[$i][id]."'";
				$kon->execute();
				//pembayaran angsuran
				$kon->sql = "INSERT INTO kwitansi_detil(kunjungan_bayar_id, kwitansi_id, angsuran_bhp, angsuran_jasa) VALUES ('".$data[$i][id]."', '".$id_kwitansi."', '".$data[$i][mampu_bayar_bhp]."', '".$data[$i][mampu_bayar_jasa]."')";
				$kon->execute();
			}
			$id_kwitansi = tambahNol($id_kwitansi, 20);
			$objResponse->addScriptCall("cetak_kwitansi", "RADIO-" . $id_kwitansi);
			$objResponse->addScriptCall("show_status_simpan");
		} else {
			$objResponse->addAlert("Data Pembayaran Tidak Dapat Dirubah, karena : \n1. Kwitansi Sudah Dibuat atau\n2. Belum Terjadi Transaksi!");
		}
		$objResponse->addScriptCall("tutup_modal_lb");
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		return $objResponse;
	}

}

$_xajax->registerFunction(array("buka_langsung_bayar", "Langsung_Bayar", "buka_langsung_bayar"));
$_xajax->registerFunction(array("buka_langsung_bayar1", "Langsung_Bayar", "buka_langsung_bayar1"));
$_xajax->registerFunction(array("simpan_langsung_bayar", "Langsung_Bayar", "simpan_langsung_bayar"));
$_xajax->registerFunction(array("simpan_langsung_bayar1", "Langsung_Bayar", "simpan_langsung_bayar1"));
?>