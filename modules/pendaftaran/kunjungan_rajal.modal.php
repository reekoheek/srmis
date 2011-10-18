<?
Class Kunjungan_Modal {

	function buka_kunjungan($id_kunjungan_kamar) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				k.kunjungan_ke as kunjungan_ke,
				k.cara_masuk as cara_masuk,
				kk.cara_bayar as cara_bayar,
				k.perujuk_id as perujuk_id,
					kk.jenis_askes as jenis_askes,
					kk.perusahaan_id as perusahaan_id,
				kk.nomor as nomor,
				kk.pj_nama as pj_nama,
				kk.pj_alamat as pj_alamat,
				kk.pj_telp as pj_telp,
				kk.pj_hubungan_keluarga as pj_hubungan_keluarga,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				p.sex as jk,
				kk.id as id_kunjungan_kamar,
				DATE_FORMAT(kk.tgl_daftar, '%Y-%m-%d-%H-%i') as tgl_daftar,
				DATE_FORMAT(kk.tgl_periksa, '%Y-%m-%d-%H-%i') as tgl_periksa,
				kk.dokter_id as id_dokter,
				kk.kelanjutan as kelanjutan,
				kmr.id as id_kamar,
				kk.diagnosa_utama_id as diagnosa_utama_id,
				IF(i.id IS NULL, '&nbsp;', CONCAT(i.kode_icd, ' - ', i.nama)) as diagnosa_utama_nama
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();

		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("input_no_rm", "innerHTML", $data[no_rm]);
		$objResponse->addAssign("input_pasien", "innerHTML", $data[nama]);
		$objResponse->addAssign("input_sex", "innerHTML", $data[jk]);
		$objResponse->addAssign("input_usia", "innerHTML", $umur);
		$objResponse->addAssign("input_id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("input_id_kunjungan", "value", $data[id_kunjungan]);

		//tab data_kunjungan
		$objResponse->addAssign("input_kamar_id", "value", $data[id_kamar]);
		$objResponse->addScriptCall("xajax_ref_get_dokter_from_kamar", "input_dokter_id", $data[id_kamar], $data[id_dokter]);
		$objResponse->addAssign("input_kelanjutan", "value", $data[kelanjutan]);
		
		$tgl_daftar = explode("-", $data[tgl_daftar]);
		$objResponse->addAssign("input_tgl_daftar_tgl", "value", $tgl_daftar[2]);
		$objResponse->addAssign("input_tgl_daftar_bln", "value", $tgl_daftar[1]);
		$objResponse->addAssign("input_tgl_daftar_thn", "value", $tgl_daftar[0]);

		$objResponse->addAssign("input_tgl_daftar_jam", "value", $tgl_daftar[3]);
		$objResponse->addAssign("input_tgl_daftar_mnt", "value", $tgl_daftar[4]);

		$tgl_periksa = explode("-", $data[tgl_periksa]);
		$objResponse->addAssign("input_tgl_periksa_tgl", "value", $tgl_periksa[2]);
		$objResponse->addAssign("input_tgl_periksa_bln", "value", $tgl_periksa[1]);
		$objResponse->addAssign("input_tgl_periksa_thn", "value", $tgl_periksa[0]);

		$objResponse->addAssign("input_tgl_periksa_jam", "value", $tgl_periksa[3]);
		$objResponse->addAssign("input_tgl_periksa_mnt", "value", $tgl_periksa[4]);

		//tab data_lain
		$objResponse->addAssign("input_kunjungan_ke", "value", $data[kunjungan_ke]);
		$objResponse->addAssign("input_cara_masuk", "value", $data[cara_masuk]);
		$objResponse->addScriptCall("xajax_ref_get_perujuk", "input_perujuk_id", $data[cara_masuk], $data[perujuk_id]);
		$objResponse->addAssign("input_cara_bayar", "value", $data[cara_bayar]);
		$objResponse->addScriptCall("xajax_ref_get_jenis_askes", "input_jenis_askes", $data[cara_bayar], $data[jenis_askes]);
		$objResponse->addScriptCall("xajax_ref_get_perusahaan", "input_perusahaan_id", $data[cara_bayar], $data[perusahaan_id]);
		$objResponse->addScriptCall("showNomor", $data[cara_bayar]);
		$objResponse->addAssign("input_nomor", "value", $data[nomor]);
		$objResponse->addAssign("input_pj_nama", "value", $data[pj_nama]);
		$objResponse->addAssign("input_pj_alamat", "value", $data[pj_alamat]);
		$objResponse->addAssign("input_pj_telp", "value", $data[pj_telp]);
		$objResponse->addAssign("input_pj_hubungan_keluarga", "value", $data[pj_hubungan_keluarga]);

		//list kunjungan yg pernah dilakukan
		//$objResponse->addScriptCall("xajax_tab_list_semua_kunjungan", '0', $data[pasien_id]);

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_kamar_id");
		return $objResponse;
	}

	function simpan_kunjungan($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		//update
			$sql = "
			UPDATE
				kunjungan k 
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
			SET
				k.kunjungan_ke = NULLIF('".$val[input_kunjungan_ke]."',''),
				k.cara_masuk = NULLIF('".$val[input_cara_masuk]."',''),
				k.perujuk_id = NULLIF('".$val[input_perujuk_id]."', ''),
				kk.cara_bayar = NULLIF('".$val[input_cara_bayar]."',''),
				kk.jenis_askes = NULLIF('".$value[input_jenis_askes]."',''),
				kk.perusahaan_id = NULLIF('".$value[input_perusahaan_id]."',''),
				kk.nomor = NULLIF('".$value[input_nomor]."',''),
				kk.pj_nama = '".$val[input_pj_nama]."',
				kk.pj_alamat = '".$val[input_pj_alamat]."',
				kk.pj_telp = '".$val[input_pj_telp]."',
				kk.pj_hubungan_keluarga = NULLIF('".$val[input_pj_hubungan_keluarga]."',''),

				kk.kamar_id = NULLIF('".$val[input_kamar_id]."', ''),
				kk.dokter_id = NULLIF('".$val[input_dokter_id]."', ''),
				kk.kelanjutan = NULLIF('".$val[input_kelanjutan]."',''),
				kk.tgl_daftar = '".$val[input_tgl_daftar_thn]."-".$val[input_tgl_daftar_bln]."-".$val[input_tgl_daftar_tgl]." ".$val[input_tgl_daftar_jam].":".$val[input_tgl_daftar_mnt].":00',
				kk.tgl_periksa = '".$val[input_tgl_periksa_thn]."-".$val[input_tgl_periksa_bln]."-".$val[input_tgl_periksa_tgl]." ".$val[input_tgl_periksa_jam].":".$val[input_tgl_periksa_mnt].":00'
			WHERE
				kk.id = '".$val[input_id_kunjungan_kamar]."'
		";
		//}
		$kon = new Konek;
		$kon->sql = $sql;
		$kon->execute();
		$afek = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);

		if($afek < 0) {
			$objResponse->addAlert("Data Kunjungan Tidak Dapat Disimpan\nCek kembali nomor kunjungan");
		} else {
			$objResponse->addScriptCall("enable_mainbar");
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("xajax_tutup_kunjungan");
			$objResponse->addScriptCall("show_status_simpan");
		}
		return $objResponse;
	}

	function simpan_kunjungan_check($val) {
		$objResponse = new xajaxResponse;
		$objResponse->addScriptCall("xajax_simpan_kunjungan", $val);
		return $objResponse;
	}

	function tutup_kunjungan() {
		$objResponse = new xajaxResponse;
		$objResponse->addScriptCall("enable_mainbar");
		$objResponse->addAssign("modal_kunjungan", "style.display", "none");
		$objResponse->addScriptCall("ref_clear_form", "input_kunjungan");
		return $objResponse;
	}
}

$kon = new Konek;

$kon->sql = "SELECT kmr.id as id, kmr.nama as nama FROM kamar kmr JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id) WHERE pel.jenis = 'RAWAT JALAN' ORDER BY kmr.nama";
$kon->execute();
$data_kamar = $kon->getAll();


//Class Kunjungan_Modal
$_xajax->registerFunction(array("buka_kunjungan", "Kunjungan_Modal", "buka_kunjungan"));
$_xajax->registerFunction(array("simpan_kunjungan", "Kunjungan_Modal", "simpan_kunjungan"));
$_xajax->registerFunction(array("simpan_kunjungan_check", "Kunjungan_Modal", "simpan_kunjungan_check"));
$_xajax->registerFunction(array("tutup_kunjungan", "Kunjungan_Modal", "tutup_kunjungan"));

?>