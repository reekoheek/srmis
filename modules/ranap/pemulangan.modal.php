<?

Class Pemulangan_Modal {

	function buka_kunjungan($id_kunjungan_kamar, $parent_id) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		//get pelayanan asal
		$kon->sql = "
			SELECT 
				pel.nama as asal
			FROM
				pelayanan pel
				JOIN kamar kmr ON (kmr.pelayanan_id = pel.id)
				JOIN kunjungan_kamar kk ON (kk.kamar_id = kmr.id)
			WHERE
				kk.id = '".$parent_id."'
		";
		$kon->execute();
		$asal = $kon->getOne();
		$sql = "
			SELECT 
				k.kunjungan_ke as kunjungan_ke,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				p.sex as sex,
				p.tgl_lahir as tgl_lahir,
				kk.id as id_kunjungan_kamar,
				k.id as id_kunjungan,
				DATE(kk.tgl_daftar) as tgl_daftar,
				DATE(kk.tgl_periksa) as tgl_periksa,
				DATE(kk.tgl_keluar) as tgl_keluar,
				TIME(kk.tgl_keluar) as wkt_keluar,
				d.nama as dokter,
				kmr.id as id_kamar,
				kmr.nama as spesialisasi,
				k.cara_masuk as cara_masuk,
				CONCAT_WS(' - ', kk.cara_bayar, kk.jenis_askes, rper.nama) as cara_bayar,
				k.keadaan_keluar as keadaan_keluar,
				kk.kelanjutan as kelanjutan,
				IF(i.id IS NULL, '&nbsp;', CONCAT(i.kode_icd, ' - ', i.nama)) as diagnosa_utama_nama,
				CASE WHEN (kk.tgl_keluar IS NULL) THEN DATEDIFF(DATE(NOW()), kk.tgl_daftar)
				ELSE DATEDIFF(kk.tgl_keluar, kk.tgl_daftar) END as lama_dirawat
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();
		

		//get data biaya kamar
		$kon->sql = "
			SELECT
				nama as nama
			FROM
				kunjungan_bayar
			WHERE
				kunjungan_kamar_id = '".$id_kunjungan_kamar."'
				AND karcis_id IS NOT NULL
			GROUP BY 
				id
		";
		$kon->execute();
		$data_karcis = $kon->getAll();

		//get data tindakan
		$kon->sql = "
			SELECT
				ic.nama as nama
			FROM
				kunjungan_kamar_icopim kkic
				JOIN icopim ic ON (ic.id = kkic.icopim_id)
			WHERE
				kkic.kunjungan_kamar_id = '".$id_kunjungan_kamar."'
			GROUP BY 
				kkic.id
		";
		$kon->execute();
		$data_ic = $kon->getAll();

		
		//get data BHP
		$kon->sql = "
			SELECT
				nama as nama
			FROM
				kunjungan_bayar
			WHERE
				kunjungan_kamar_id = '".$id_kunjungan_kamar."'
				AND bhp_id IS NOT NULL
			GROUP BY 
				id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();
/*
		//get data im
		$kon->sql = "
			SELECT
				im.nama as nama
			FROM
				kunjungan_bayar kki
				JOIN imunisasi im ON (im.id = kki.imunisasi_id)
			WHERE
				kki.kunjungan_kamar_id = '".$id_kunjungan_kamar."'
			GROUP BY
				kki.id
		";
		$kon->execute();
		$data_im = $kon->getAll();
		//$objResponse->addAlert(print_r($data_im));
*/
		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("input_no_rm", "innerHTML", $data[no_rm]);
		$objResponse->addAssign("input_pasien", "innerHTML", $data[nama]);
		$objResponse->addAssign("input_sex", "innerHTML", $data[sex]);
		$objResponse->addAssign("input_usia", "innerHTML", $umur);
		$objResponse->addAssign("input_cara_masuk", "innerHTML", $data[cara_masuk]);
		$objResponse->addAssign("input_pelayanan_asal", "innerHTML", $asal[asal]);
		$objResponse->addAssign("input_cara_bayar", "innerHTML", $data[cara_bayar]);
		$objResponse->addAssign("input_id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("input_id_kunjungan", "value", $data[id_kunjungan]);
		
		$objResponse->addAssign("input_kunjungan_ke", "innerHTML", $data[kunjungan_ke]);
		$objResponse->addAssign("input_spesialisasi", "innerHTML", $data[spesialisasi]);
		$objResponse->addAssign("input_lama_dirawat", "innerHTML", $data[lama_dirawat] . " hari");
		$objResponse->addAssign("input_dokter", "innerHTML", $data[dokter]);

		//set default
		$kelanjutan = empty($data[kelanjutan])?"PULANG":$data[kelanjutan];
		$objResponse->addAssign("input_kelanjutan", "value", $kelanjutan);
		$keadaan_keluar = empty($data[keadaan_keluar])?"SEMBUH":$data[keadaan_keluar];
		$objResponse->addAssign("input_keadaan_keluar", "value", $keadaan_keluar);

		//tanggal keluar
		$tgl_keluar = explode("-", $data[tgl_keluar]);
		$objResponse->addAssign("input_tgl_keluar_thn", "value", $tgl_keluar[2]);
		$objResponse->addAssign("input_tgl_keluar_bln", "value", $tgl_keluar[1]);
		$objResponse->addAssign("input_tgl_keluar_tgl", "value", $tgl_keluar[0]);
		$wkt_keluar = explode(":", $data[wkt_keluar]);
		$objResponse->addAssign("input_tgl_keluar_jam", "value", $wkt_keluar[0]);
		$objResponse->addAssign("input_tgl_keluar_mnt", "value", $wkt_keluar[1]);

		$objResponse->addAssign("input_tgl_daftar", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));

		//tab diagnosa_tindakan
		$objResponse->addAssign("input_diagnosa_utama_nama", "innerHTML", $data[diagnosa_utama_nama]);
		for($i=0;$i<sizeof($data_karcis);$i++) {
			$ret_data_karcis .= "<li>".$data_karcis[$i][nama]."</li>";
		}
		$objResponse->addAssign("tabel_input_karcis", "innerHTML", $ret_data_karcis);

		for($i=0;$i<sizeof($data_ic);$i++) {
			$ret_data_ic .= "<li>".$data_ic[$i][nama]."</li>";
		}
		$objResponse->addAssign("tabel_input_tindakan", "innerHTML", $ret_data_ic);

		for($i=0;$i<sizeof($data_bhp);$i++) {
			$ret_data_bhp .= "<li>".$data_bhp[$i][nama]."</li>";
		}
		$objResponse->addAssign("tabel_input_bhp", "innerHTML", $ret_data_bhp);
/*
		for($i=0;$i<sizeof($data_im);$i++) {
			$ret_data_im .= "<li>".$data_im[$i][nama]."</li>";
		}
		$objResponse->addAssign("tabel_input_imunisasi", "innerHTML", $ret_data_im);
*/
		//list kunjungan yg pernah dilakukan
		//$objResponse->addScriptCall("xajax_tab_list_semua_kunjungan", '0', $data[pasien_id]);

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_kelanjutan");
		return $objResponse;
	}

	function simpan_kunjungan($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		$kon = new Konek;
		//update
		
		$kon->sql = "
			UPDATE
				kunjungan
			SET 
				keadaan_keluar = '".$val[input_keadaan_keluar]."'
			WHERE
				id = '".$val[input_id_kunjungan]."'
		";
		$kon->execute();
		
		$sql = "
			UPDATE
				kunjungan_kamar
			SET
				kelanjutan = '".$val[input_kelanjutan]."',
				tgl_keluar = '".$val[input_tgl_keluar_thn]."-".$val[input_tgl_keluar_bln]."-".$val[input_tgl_keluar_tgl]." ".$val[input_tgl_keluar_jam].":".$val[input_tgl_keluar_mnt].":00'
			WHERE
				id = '".$val[input_id_kunjungan_kamar]."'
		";
		//}
		
		$kon->sql = $sql;
		$kon->execute();
		$afek = $kon->getJml();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);

		if($afek < 0) {
			$objResponse->addAlert("Data Pemulangan Tidak Dapat Disimpan\nHubungi Bagian SIM.");
		} else {
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("xajax_tutup_kunjungan");
			$objResponse->addScriptCall("show_status_simpan");
		}
		return $objResponse;
	}

	function simpan_kunjungan_check($val) {
		$objResponse = new xajaxResponse;
		if(!$val[input_kelanjutan]) {
			$objResponse->addAlert('Silakan pilih kelanjutan pasien.');
			$objResponse->addScriptCall("fokus", "input_kelanjutan");	
		} elseif(!$val[input_keadaan_keluar]) {
			$objResponse->addAlert('Silakan pilih keadaan pasien waktu keluar.');
			$objResponse->addScriptCall("fokus", "input_keadaan_keluar");	
		} elseif(!checkdate($val[input_tgl_keluar_bln], $val[input_tgl_keluar_tgl], $val[input_tgl_keluar_thn])) {
			$objResponse->addAlert('Tanggal Keluar Tidak Valid.');
			$objResponse->addScriptCall("fokus", "input_tgl_keluar_tgl");	
		} else {
			$objResponse->addScriptCall("xajax_simpan_kunjungan", $val);
		}
		return $objResponse;
	}

	function tutup_kunjungan() {
		$objResponse = new xajaxResponse;
		$objResponse->addAssign("modal_kunjungan", "style.display", "none");
		$objResponse->addAssign("input_diagnosa_utama_nama", "innerHTML", "&nbsp;");
		
		$objResponse->addScriptCall("ref_clear_form", "input_kunjungan");
		$objResponse->addScriptCall("enable_mainbar");
		return $objResponse;
	}


}

//Class Kunjungan_Modal
$_xajax->registerFunction(array("buka_kunjungan", "Pemulangan_Modal", "buka_kunjungan"));
$_xajax->registerFunction(array("simpan_kunjungan", "Pemulangan_Modal", "simpan_kunjungan"));
$_xajax->registerFunction(array("simpan_kunjungan_check", "Pemulangan_Modal", "simpan_kunjungan_check"));
$_xajax->registerFunction(array("tutup_kunjungan", "Pemulangan_Modal", "tutup_kunjungan"));

?>