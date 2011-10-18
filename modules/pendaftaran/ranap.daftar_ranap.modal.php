<?
Class Daftar_Ranap {

	function buka_daftar_ranap($id_kunjungan_kamar) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				pel.id as pelid,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				kk.id as id_kunjungan_kamar,
				pel.nama as pelayanan_asal,
				p.sex as jenis_kelamin,
				d.nama as dokter_pengirim,
				CONCAT(i.kode_icd, ' - ', i.nama) as diagnosa_klinik,
				kk.cara_bayar as cara_bayar,
					kk.jenis_askes as jenis_askes,
					kk.perusahaan_id as perusahaan_id,
				kk.nomor as nomor,
				kk.pj_nama as pj_nama,
				kk.pj_alamat as pj_alamat,
				kk.pj_telp as pj_telp,
				kk.pj_hubungan_keluarga as pj_hubungan_keluarga
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();

		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("judul_daftar_ranap", "innerHTML", "Pendaftaran Pasien Rawat Inap");
		$objResponse->addAssign("no_rm", "innerHTML", $data[no_rm]);
		$objResponse->addAssign("pasien", "innerHTML", $data[nama]);
		$objResponse->addAssign("jenis_kelamin", "innerHTML", $data[jenis_kelamin]);
		$objResponse->addAssign("usia", "innerHTML", $umur);
		$objResponse->addAssign("pelayanan_asal", "innerHTML", $data[pelayanan_asal]);
		$objResponse->addAssign("dokter_pengirim", "innerHTML", $data[dokter_pengirim]);
		$objResponse->addAssign("diagnosa_klinik", "innerHTML", $data[diagnosa_klinik]);

		$objResponse->addAssign("id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("id_kunjungan", "value", $data[id_kunjungan]);
		$objResponse->addClear("is_ranap", "value");

		$objResponse->addAssign("cara_bayar", "value", $data[cara_bayar]);
			$objResponse->addScriptCall("xajax_ref_get_jenis_askes", "jenis_askes", $data[cara_bayar], $data[jenis_askes]);
			$objResponse->addScriptCall("xajax_ref_get_perusahaan", "perusahaan_id", $data[cara_bayar], $data[perusahaan_id]);
		//$objResponse->addAssign("jenis_askes", "value", $data[jenis_askes]);
		//$objResponse->addAssign("perusahaan_id", "value", $data[perusahaan_id]);
		$objResponse->addAssign("nomor", "value", $data[nomor]);
		$objResponse->addScriptCall("showNomor", $data[cara_bayar]);
		$objResponse->addAssign("pj_nama", "value", $data[pj_nama]);
		$objResponse->addAssign("pj_alamat", "value", $data[pj_alamat]);
		$objResponse->addAssign("pj_telp", "value", $data[pj_telp]);
		$objResponse->addAssign("pj_hubungan_keluarga", "value", $data[pj_hubungan_keluarga]);
		$objResponse->addScriptCall("xajax_ref_get_pelayanan", "pelayanan_id", "RAWAT INAP", $data[pelid]);

		//tampilkan modal window input pesan kamar
		$objResponse->addClear("modal_daftar_ranap", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall('fokus', 'cara_bayar');
		return $objResponse;
	}


	function buka_edit_ranap($id_kunjungan_kamar, $id_kunjungan_kamar_asal) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		//get data bukan ranap
		$sql = "
			SELECT 
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				pel.nama as pelayanan_asal,
				p.sex as jenis_kelamin,
				d.nama as dokter_pengirim,
				CONCAT(i.kode_icd, ' - ', i.nama) as diagnosa_klinik
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar_asal."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data_asal = $kon->getOne();

		$sql = "
			SELECT 
				k.id as id_kunjungan,
				pel.id as pelid,
				kmr.id as kamar_id,
				kk.id as id_kunjungan_kamar,
				d.id as dokter_id,
				kk.cara_bayar as cara_bayar,
					kk.jenis_askes as jenis_askes,
					kk.perusahaan_id as perusahaan_id,
				kk.nomor as nomor,
				kk.pj_nama as pj_nama,
				kk.pj_alamat as pj_alamat,
				kk.pj_telp as pj_telp,
				kk.pj_hubungan_keluarga as pj_hubungan_keluarga,
				rk.nomor as no_kamar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN ref_kamar rk ON (rk.id = kk.no_kamar)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();

		$skr = date("Y-m-d");
		$usia = hitungUmur($data_asal[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("judul_daftar_ranap", "innerHTML", "Ubah Data Pendaftaran Pasien Rawat Inap");
		$objResponse->addAssign("no_rm", "innerHTML", $data_asal[no_rm]);
		$objResponse->addAssign("pasien", "innerHTML", $data_asal[nama]);
		$objResponse->addAssign("jenis_kelamin", "innerHTML", $data_asal[jenis_kelamin]);
		$objResponse->addAssign("usia", "innerHTML", $umur);
		$objResponse->addAssign("pelayanan_asal", "innerHTML", $data_asal[pelayanan_asal]);
		$objResponse->addAssign("dokter_pengirim", "innerHTML", $data_asal[dokter_pengirim]);
		$objResponse->addAssign("diagnosa_klinik", "innerHTML", $data_asal[diagnosa_klinik]);

		$objResponse->addAssign("id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("id_kunjungan", "value", $data[id_kunjungan]);
		$objResponse->addAssign("is_ranap", "value", "1");

		$objResponse->addAssign("cara_bayar", "value", $data[cara_bayar]);
			$objResponse->addScriptCall("xajax_ref_get_jenis_askes", "jenis_askes", $data[cara_bayar], $data[jenis_askes]);
			$objResponse->addScriptCall("xajax_ref_get_perusahaan", "perusahaan_id", $data[cara_bayar], $data[perusahaan_id]);
		//$objResponse->addAssign("jenis_askes", "value", $data[jenis_askes]);
		//$objResponse->addAssign("perusahaan_id", "value", $data[perusahaan_id]);
		$objResponse->addAssign("nomor", "value", $data[nomor]);
		$objResponse->addScriptCall("showNomor", $data[cara_bayar]);
		$objResponse->addAssign("pj_nama", "value", $data[pj_nama]);
		$objResponse->addAssign("pj_alamat", "value", $data[pj_alamat]);
		$objResponse->addAssign("pj_telp", "value", $data[pj_telp]);
		
		$objResponse->addAssign("pj_hubungan_keluarga", "value", $data[pj_hubungan_keluarga]);
		$objResponse->addScriptCall("xajax_ref_get_pelayanan", "pelayanan_id", "RAWAT INAP", $data[pelid]);
		$objResponse->addScriptCall("xajax_ref_get_kamar", "kamar_id", $data[pelid], $data[kamar_id]);
		$objResponse->addScriptCall("xajax_ref_get_bed", "no_kamar", $data[pelid], $data[no_kamar]);
		$objResponse->addScriptCall("xajax_ref_get_dokter", "dokter_id", $data[pelid], $data[dokter_id]);

		//tampilkan modal window input pesan kamar
		$objResponse->addClear("modal_daftar_ranap", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall('fokus', 'cara_bayar');
		return $objResponse;
	}

	function simpan_daftar_ranap($value) {
		$kon = new Konek;
		/*
		cek apakah user mendaftar ranap atau mengedit ranap
		*/
		if($value[is_ranap] == "1") {
			// adalah pasien rawat inap, maka diubah
			$kon->sql = "
				UPDATE
					kunjungan_kamar
				SET
					kamar_id = '".$value[kamar_id]."',
					dokter_id = NULLIF('".$value[dokter_id]."', ''),
					cara_bayar = '".$value[cara_bayar]."',
					jenis_askes = NULLIF('".$value[jenis_askes]."',''),
					perusahaan_id = NULLIF('".$value[perusahaan_id]."',''),
					nomor = NULLIF('".$value[nomor]."',''),
					pj_nama = '".$value[pj_nama]."',
					pj_alamat = '".$value[pj_alamat]."',
					pj_telp = '".$value[pj_telp]."',
					pj_hubungan_keluarga = '".$value[pj_hubungan_keluarga]."',
					tgl_daftar = '".$value[tgl_keluar_thn]."-".$value[tgl_keluar_bln]."-".$value[tgl_keluar_tgl]." ".$value[tgl_keluar_jam].":".$value[tgl_keluar_mnt].":".$value[tgl_keluar_dtk]."',
					tgl_periksa = '".$value[tgl_keluar_thn]."-".$value[tgl_keluar_bln]."-".$value[tgl_keluar_tgl]." ".$value[tgl_keluar_jam].":".$value[tgl_keluar_mnt].":".$value[tgl_keluar_dtk]."'
				WHERE
					id = '".$value[id_kunjungan_kamar]."'
			";
		} else {
			//adalah pasien IGD atau rajal, maka ditambah
			$kon->sql = "
				UPDATE 
					kunjungan_kamar
				SET
					kelanjutan = 'DIRAWAT',
					tgl_keluar = '".$value[tgl_keluar_thn]."-".$value[tgl_keluar_bln]."-".$value[tgl_keluar_tgl]." ".$value[tgl_keluar_jam].":".$value[tgl_keluar_mnt].":".$value[tgl_keluar_dtk]."'
				WHERE
					id = '".$value[id_kunjungan_kamar]."'
			";
			$kon->execute();
			
			//update status no bed kamar
			$kon->sql = "
			UPDATE 
				ref_kamar
			SET
				status = 1
			WHERE
				id = '".$value[no_kamar]."'";
			$kon->execute();		
			
			$kon->sql = "
			INSERT INTO
				kunjungan_kamar(
					parent_id,
					kunjungan_id,
					kamar_id,
                    no_kamar,
					tgl_daftar,
					tgl_periksa,
					dokter_id,
					cara_bayar,
					jenis_askes,
					perusahaan_id,
					nomor,
					pj_nama,
					pj_alamat,
					pj_telp,
					pj_hubungan_keluarga
				) 
			VALUES (
				'".$value[id_kunjungan_kamar]."',
				'".$value[id_kunjungan]."',
				'".$value[kamar_id]."',
                '".$value[no_kamar]."',
				'".$value[tgl_keluar_thn]."-".$value[tgl_keluar_bln]."-".$value[tgl_keluar_tgl]." ".$value[tgl_keluar_jam].":".$value[tgl_keluar_mnt].":".$value[tgl_keluar_dtk]."',
				'".$value[tgl_keluar_thn]."-".$value[tgl_keluar_bln]."-".$value[tgl_keluar_tgl]." ".$value[tgl_keluar_jam].":".$value[tgl_keluar_mnt].":".$value[tgl_keluar_dtk]."',
				NULLIF('".$value[dokter_id]."', ''),
				'".$value[cara_bayar]."',
						NULLIF('".$value[jenis_askes]."',''),
						NULLIF('".$value[perusahaan_id]."',''),
						NULLIF('".$value[nomor]."',''),
				'".$value[pj_nama]."',
				'".$value[pj_alamat]."',
				'".$value[pj_telp]."',
				NULLIF('".$value[pj_hubungan_keluarga]."', '')
				)
			";
		}
        $sql = $kon->sql;
		$kon->execute();
		$afek = $kon->getJml();
		$objResponse = new xajaxResponse();
      
        //update no kamar yg terisi
        
		//$objResponse->addAssign("debug", "innerHTML", $sql);

		if($afek < 0) {
			$objResponse->addAlert("Data gagal disimpan.\nHubungi bagian SIM");
            //$objResponse->addAlert($afek);
			//$objResponse->addAssign("debug", "innerHTML", $sql);
		} else {
		  
                 $kon->sql = "SELECT biaya_jasa FROM karcis WHERE id='77'";
                  $kon->execute();
                  $bayar = $kon->getOne();
                  //$id_kwitansi = bikinKwitansi("KASIR", $bayar[biaya_jasa]+$bayar_poli[tarif],"");
                  $sql = "
        					INSERT INTO
        						kunjungan_bayar (
        							nama,
        							kunjungan_kamar_id,
        							karcis_id,                                           
        							hak_id,
        							biaya_bhp,
        							biaya_jasa,
        							jumlah,
        							bayar_bhp,
        							bayar_jasa,
        							mampu_bayar_bhp,
        							jasa_p,
        							jasa_rs,
        							jasa_rs_op,
        							jasa_rs_kembang,
        							jasa_rs_adm,
        							jasa_rs_sdm,
        							spesialis,
        							spesialis_pendamping,
        							ugp,
        							grabaf,
        							perawat,
        							penunjang,
        							zakat,
        							pajak,
                                    tgl
        						) SELECT
        							nama,
        							'".$value[id_kunjungan_kamar]."',
        							'77',
                                   	'89',
        							biaya_bhp,
        							biaya_jasa,
        							'1',
        							biaya_bhp,
        							biaya_jasa,
        							biaya_bhp,
        							jasa_p,
        							jasa_rs,
        							jasa_rs_op,
        							jasa_rs_kembang,
        							jasa_rs_adm,
        							jasa_rs_sdm,
        							spesialis,
        							spesialis_pendamping,
        							ugp,
        							grabaf,
        							perawat,
        							penunjang,
        							zakat,
        							pajak,
                                    NOW()
        						FROM
        							karcis
        						WHERE
        							id = '77'
        				";
                  $kon->sql = $sql;
                  //$objResponse->addAppend("debug", "innerHTML", $sql);                  
                  $kon->execute();                
            
			$objResponse->addScriptCall("enable_mainbar");
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("xajax_tutup_daftar_ranap");
			$objResponse->addScriptCall("show_status_simpan");
		}
		return $objResponse;
	}

	function simpan_daftar_ranap_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();

		$objResponse = new xajaxResponse;
		if(!$val[cara_bayar]) {
			$objResponse->addAlert('Silakan Pilih Cara Pembayaran');
			$objResponse->addScriptCall('fokus', 'cara_bayar');
		} elseif(!$val[pelayanan_id]) {
			$objResponse->addAlert('Silakan Pilih Pelayanan');
			$objResponse->addScriptCall('fokus', 'pelayanan_id');
		} elseif(!$val[kamar_id]) {
			$objResponse->addAlert('Silakan Pilih Kamar');
			$objResponse->addScriptCall('fokus', 'kamar_id');
		} else {
			$objResponse->addScriptCall("xajax_simpan_daftar_ranap", $val);
		}
		return $objResponse;
	}

	function tutup_daftar_ranap() {
		$objResponse = new xajaxResponse;
		$objResponse->addScriptCall("enable_mainbar");
		$objResponse->addAssign("modal_daftar_ranap", "style.display", "none");
		$objResponse->addScript("document.getElementById('daftar_ranap').reset()");
		$objResponse->addClear("cara_bayar", "value");
		$objResponse->addClear("pelayanan_id", "value");
		$objResponse->addClear("info_kamar", "innerHTML");
		$objResponse->addScriptCall("xajax_ref_get_kamar", "kamar_id", "0");
		$objResponse->addScriptCall("hide_info_kamar()");
		return $objResponse;
	}

	function get_info_kamar($pelid, $kamarId) {
		$kon = new Konek;
		$sql = " SELECT * FROM kamar WHERE pelayanan_id = '".$pelid."' ORDER BY kelas";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->addTh("No", "Kamar", "Jml TT", "Kelas","Terisi", "Kosong","Tarif Asuransi", "Tarif Umum");
		for($i=0;$i<sizeof($data);$i++) {
			$kon->sql = "
			SELECT 
				COUNT(*) as terisi
			FROM kunjungan_kamar
			WHERE             
				kamar_id = '".$data[$i][id]."'
				AND kelanjutan IS NULL
			GROUP BY 
				kamar_id
			";
			$kon->execute();
			$isi = $kon->getOne();
			$kosong = $data[$i][jml_bed] - $isi[terisi];
			$tabel->addRow(
				($i+1),
				$data[$i][nama],
				$data[$i][jml_bed],$data[$i][kelas],
				empty($isi[terisi])?"0":$isi[terisi],
				$kosong, $data[$i][tarif_asuransi], $data[$i][tarif_umum]
			);
			$tabel->addOnclickTd(
				"xajax_ref_get_kamar('kamar_id', '".$data[$i][pelayanan_id]."', '".$data[$i][id]."');fokus('".$kamarId."')",
				"xajax_ref_get_kamar('kamar_id', '".$data[$i][pelayanan_id]."', '".$data[$i][id]."');fokus('".$kamarId."')",
				"xajax_ref_get_kamar('kamar_id', '".$data[$i][pelayanan_id]."', '".$data[$i][id]."');fokus('".$kamarId."')",
				"xajax_ref_get_kamar('kamar_id', '".$data[$i][pelayanan_id]."', '".$data[$i][id]."');fokus('".$kamarId."')",
				"xajax_ref_get_kamar('kamar_id', '".$data[$i][pelayanan_id]."', '".$data[$i][id]."');fokus('".$kamarId."')"
			);
		}
		$ret = $tabel->build();
		$objResponse = new xajaxResponse;
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addAssign("info_kamar", "innerHTML", $ret);
		return $objResponse;
	}
}
//Class Pesan_Kamar_Modal
$_xajax->registerFunction(array("buka_daftar_ranap", "Daftar_Ranap", "buka_daftar_ranap"));
$_xajax->registerFunction(array("buka_edit_ranap", "Daftar_Ranap", "buka_edit_ranap"));
$_xajax->registerFunction(array("simpan_daftar_ranap", "Daftar_Ranap", "simpan_daftar_ranap"));
$_xajax->registerFunction(array("simpan_daftar_ranap_check", "Daftar_Ranap", "simpan_daftar_ranap_check"));
$_xajax->registerFunction(array("tutup_daftar_ranap", "Daftar_Ranap", "tutup_daftar_ranap"));
$_xajax->registerFunction(array("get_info_kamar", "Daftar_Ranap", "get_info_kamar"));
?>