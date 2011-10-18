<?
Class Langsung_Bayar {
	function buka_langsung_bayar($idkw) {
		unset($_SESSION[kasir][kunjungan][jasa_cetak]);
		$kon = new Konek;
		//$kon->debug = 1;
		$objResponse = new xajaxResponse;
		//get data pasien
		$sql = "
			SELECT
				k.id as kunjungan_id,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				pel.nama as nama_pelayanan,
				p.sex as jk,
				CONCAT_WS(' - ', kk.cara_bayar, kk.jenis_askes, rper.nama) as cara_bayar,
				kk.nomor as nomor
			FROM
				kunjungan_kamar kk
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_id = kk.id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kwitansi kw ON (kw.id = kwd.kwitansi_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
			WHERE
				kw.id = '".$idkw."'
			GROUP BY
				p.id
		";
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$kon->sql = $sql;
		$kon->execute();
		$data_pasien = $kon->getOne();
		$arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
		$data_pasien[usia] = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
		$data_pasien[usia] .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
		$data_pasien[usia] .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
		$objResponse->addClear("modal_lb", "style.display");
		$objResponse->addAssign("lb_id_kunjungan", "value", $data_pasien[kunjungan_id]);
		$objResponse->addAssign("lb_id_kwitansi", "value", $idkw);
		$objResponse->addAssign("lb_no_rm", "innerHTML", $data_pasien[id_display]);
		$objResponse->addAssign("lb_pasien", "innerHTML", $data_pasien[nama]);
		$objResponse->addAssign("lb_sex", "innerHTML", $data_pasien[jk]);
		$objResponse->addAssign("lb_usia", "innerHTML", $data_pasien[usia]);
		$objResponse->addAssign("lb_alamat", "innerHTML", $data_pasien[alamat]);
		$objResponse->addAssign("lb_tgl_daftar", "innerHTML", tanggalIndo($data_pasien[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("lb_cara_bayar", "innerHTML", $data_pasien[cara_bayar]);
		$objResponse->addAssign("lb_nomor", "innerHTML", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);
	
		//BIKIN SESSION UNTUK DICETAK
		$_SESSION[igd][langsung_bayar][data_px] = $data_pasien;

		$tabel = new Table;
		$tabel->cellspacing = "0";
		$tabel->scroll = false;
		$tabel->extra_table = "style=\"width:9cm;\"";
		$tabel->addTh("No", "Jasa", "Biaya");
		$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "");
		//get data karcis
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kb.karcis_id IS NOT NULL
				AND kwd.kwitansi_id = '".$idkw."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_karcis = $kon->getAll();
		if(!empty($data_karcis)) {
			$tabel->addRow("","<b>Karcis</b>","");
			for($i=0;$i<sizeof($data_karcis);$i++) {
				$tabel->addRow(
					($i+1),
					$data_karcis[$i][nama],
					uangIndo($data_karcis[$i][bayar])
				);
				$total += $data_karcis[$i][bayar];
				$sudah_dibayar += $data_karcis[$i][mampu_bayar];
				//belum bayar
				$kurang += $data_karcis[$i][bayar]-$data_karcis[$i][mampu_bayar];
			}
		}

		//get data tindakan
		$kon->sql = "
			SELECT
				kki.nama as nama,
				SUM(kb.bayar_jasa) as bayar,
				SUM(kb.mampu_bayar_jasa) as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_kamar_icopim kki 
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_icopim_id = kki.id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
			WHERE
				kb.icopim_detil_id IS NOT NULL
				AND kwd.kwitansi_id = '".$idkw."'
			GROUP BY
				kki.id
			ORDER BY kki.id
		";
		$kon->execute();
		$data_tindakan = $kon->getAll();
		if(!empty($data_tindakan)) {
			$tabel->addRow("","<b>Tindakan</b>","");
			for($i=0;$i<sizeof($data_tindakan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_tindakan[$i][nama],
					uangIndo($data_tindakan[$i][bayar])
				);
				$total += $data_tindakan[$i][bayar];
				$sudah_dibayar += $data_tindakan[$i][mampu_bayar];
				//belum bayar
				$kurang += $data_tindakan[$i][bayar]-$data_tindakan[$i][mampu_bayar];
			}
		}

		//get data specimen
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN lab_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
				JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.lab_specimen_id IS NOT NULL
				AND kwd.kwitansi_id = '".$idkw."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_specimen = $kon->getAll();
		if(!empty($data_specimen)) {
			$tabel->addRow("","<b>Pemeriksaan Specimen</b>","");
			for($i=0;$i<sizeof($data_specimen);$i++) {
				$tabel->addRow(
					($i+1),
					$data_specimen[$i][nama],
					uangIndo($data_specimen[$i][bayar])
				);
				$total += $data_specimen[$i][bayar];
				$sudah_dibayar += $data_specimen[$i][mampu_bayar];
				//belum bayar
				$kurang += $data_specimen[$i][bayar]-$data_specimen[$i][mampu_bayar];
			}
		}

		//get data radio
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
				JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.radio_specimen_id IS NOT NULL
				AND kwd.kwitansi_id = '".$idkw."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_radio = $kon->getAll();
		if(!empty($data_radio)) {
			$tabel->addRow("","<b>Pemeriksaan Radiologi</b>","");
			for($i=0;$i<sizeof($data_radio);$i++) {
				$tabel->addRow(
					($i+1),
					$data_radio[$i][nama],
					uangIndo($data_radio[$i][bayar])
				);
				$total += $data_radio[$i][bayar];
				$sudah_dibayar += $data_radio[$i][mampu_bayar];
				//belum bayar
				$kurang += $data_radio[$i][bayar]-$data_radio[$i][mampu_bayar];
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
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.bhp_id IS NOT NULL
				AND kwd.kwitansi_id = '".$idkw."'
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
				$kurang += $data_bhp[$i][bayar]-$data_bhp[$i][mampu_bayar];
			}
		}

		//get data kendaraan
		$kon->sql = "
			SELECT
				kkd.nama as nama,
				SUM(kb.bayar_bhp+kb.bayar_jasa) as bayar,
				SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_kendaraan kkd 
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kendaraan_id = kkd.id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kwd.kwitansi_id = '".$idkw."'
			GROUP BY
				kkd.id
			ORDER BY kkd.id
		";
		$kon->execute();
		$data_kendaraan = $kon->getAll();
		if(!empty($data_kendaraan)) {
			$tabel->addRow("","<b>Sewa Kendaraan</b>","");
			for($i=0;$i<sizeof($data_kendaraan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_kendaraan[$i][nama],
					uangIndo($data_kendaraan[$i][bayar])
				);
				$total += $data_kendaraan[$i][bayar];
				$sudah_dibayar += $data_kendaraan[$i][mampu_bayar];
				//belum bayar
				$kurang += $data_kendaraan[$i][bayar]-$data_kendaraan[$i][mampu_bayar];
			}
		}

		$tabel->addRow("","<b>Total</b>", uangIndo($total));
		$tabel_jasa = $tabel->build();
		$objResponse->addAssign("lb_list_jasa", "innerHTML", $tabel_jasa);

		$objResponse->addAssign("lb_total_display", "value", uangIndo($total));
		$objResponse->addAssign("lb_total_display", "title", terbilang($total));
		$objResponse->addAssign("lb_sudah_dibayar", "value", $sudah_dibayar);
		$objResponse->addAssign("lb_sudah_dibayar_display", "value", uangIndo($sudah_dibayar));
		$objResponse->addAssign("lb_sudah_dibayar_display", "title", terbilang($sudah_dibayar));
		$objResponse->addAssign("lb_kurang_display", "value", uangIndo($kurang));
		$objResponse->addAssign("lb_kurang", "value", $kurang);
		$objResponse->addAssign("lb_kurang_display", "title", terbilang($kurang));
		$objResponse->addAssign("lb_mampu_bayar", "value", $kurang);
		$objResponse->addAssign("mampu_terbilang", "innerHTML", terbilang($kurang));
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "lb_mampu_bayar");

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
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kw.id = '".$idkw."'
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
		$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.bayar_jasa as bayar_jasa, kb.mampu_bayar_bhp as mampu_bayar_bhp, kb.mampu_bayar_jasa as mampu_bayar_jasa FROM kunjungan_bayar kb JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id) JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kk.kunjungan_id = '".$val[lb_id_kunjungan]."' AND kwd.kwitansi_id = '".$val[lb_id_kwitansi]."'";
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
			if($val[lb_mampu_bayar] < $val[lb_kurang]) $status = "ANGSUR";
			else $status = "LUNAS";
			$id_kwitansi = bikinKwitansi("KASIR", $val[lb_mampu_bayar], $status);
			$mampu = round($val[lb_mampu_bayar]/$val[lb_kurang], 2);
			//$objResponse->addAppend("debug", "innerHTML", $mampu . "<br />");
			$tot = 0;
			for($i=0;$i<sizeof($data);$i++) {
				$data[$i][angsuran_bhp] = round($data[$i][bayar_bhp] * $mampu);
				$data[$i][angsuran_jasa] = round($data[$i][bayar_jasa] * $mampu);
				$data[$i][pertambahan_bhp] += $data[$i][angsuran_bhp]-$data[$i][mampu_bayar_bhp];
				$data[$i][pertambahan_jasa] += $data[$i][angsuran_jasa]-$data[$i][mampu_bayar_jasa];
				$tot += $data[$i][angsuran_bhp] + $data[$i][angsuran_jasa];
				//$objResponse->addAppend("debug", "innerHTML", $data[$i][angsuran_bhp] . " - " . $data[$i][angsuran_jasa] . ", tot : ".$tot."<br />");
			}
			$selisih = ($val[lb_mampu_bayar]+$val[lb_sudah_dibayar]) - $tot;
			//$objResponse->addAppend("debug", "innerHTML", "selisih : " . $selisih . ", mampu bayar : " .$val[lb_mampu_bayar]. ", tot : ".$tot."<br />");
			if($data[0][angsuran_jasa]) {
				$data[0][angsuran_jasa] += $selisih;
			} else {
				$data[0][angsuran_bhp] += $selisih;
			}

			for($i=0;$i<sizeof($data);$i++) {
				$sql = "UPDATE kunjungan_bayar kb, kwitansi_detil kwd SET kb.mampu_bayar_bhp = '".$data[$i][angsuran_bhp]."', kb.mampu_bayar_jasa = '".$data[$i][angsuran_jasa]."' WHERE kwd.kunjungan_bayar_id = kb.id AND kb.id = '".$data[$i][id]."' AND kwd.kwitansi_id = '".$val[lb_id_kwitansi]."'";
				//$objResponse->addAppend("debug", "innerHTML", nl2br($sql) . "<br />");
				$kon->sql = $sql;
				$kon->execute();
				//pembayaran angsuran
				$sql = "INSERT INTO kwitansi_detil(kunjungan_bayar_id, kwitansi_id, angsuran_bhp, angsuran_jasa) VALUES ('".$data[$i][id]."', '".$id_kwitansi."', '".$data[$i][pertambahan_bhp]."', '".$data[$i][pertambahan_jasa]."')";
				//$objResponse->addAppend("debug", "innerHTML", nl2br($sql) . "<br />");
				$kon->sql = $sql;
				$kon->execute();
			}
			$id_kwitansi = tambahNol($id_kwitansi, 20);
			$objResponse->addScriptCall("cetak_kwitansi", "KASIR-" . $id_kwitansi);
			$objResponse->addScriptCall("show_status_simpan");
		} else {
			$objResponse->addAlert("Data Pembayaran Tidak Dapat Dirubah, karena : \n1. Kwitansi Sudah Dibuat atau\n2. Belum Terjadi Transaksi!");
		}
		$objResponse->addScriptCall("tutup_modal_lb");
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		return $objResponse;
	}
    function bayar_uang_muka($val){
        $kon = new Konek;
        $objResponse= new xajaxResponse;
       	$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.biaya_jasa as bayar_jasa FROM kunjungan_bayar kb JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id) LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kk.kunjungan_id = '".$val[lb_id_kunjungan]."' AND kwd.kwitansi_id IS NULL";
        $_SESSION[idkk] = $val[lb_id_kunjungan];
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
		  for($i=0;$i<sizeof($data);$i++){
		      $kon->sql= "update kunjungan_bayar set uang_muka = '".$data[$i][lb_uang_muka]."' WHERE id = '".$data[$i][id]."'";
              $kon->execute();
		  }
		}
        return $objResponse;
    }
}

$_xajax->registerFunction(array("buka_langsung_bayar", "Langsung_Bayar", "buka_langsung_bayar"));
$_xajax->registerFunction(array("simpan_langsung_bayar", "Langsung_Bayar", "simpan_langsung_bayar"));
$_xajax->registerFunction(array("bayar_uang_muka", "Langsung_Bayar", "bayar_uang_muka"));

?>