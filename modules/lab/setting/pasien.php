<?
$_TITLE = "Administrasi Data Pasien";
Class IRD {

	function get_pasien($id) {
		$kon = new Konek;
		$sql = "
		SELECT p.id as id, p.nama as nama, p.tempat_lahir as tempat_lahir, p.tgl_lahir as tgl_lahir, p.gol_darah as gol_darah, p.alamat as alamat, p.rt as rt, p.rw as rw, p.desa_id as des_id, kec.id as kec_id, kab.id as kab_id, prop.id as prop_id, p.telp as telp, p.agama as agama, p.sex as sex, p.pendidikan_id as pendidikan_id, p.pekerjaan_id as pekerjaan_id, p.status_nikah as status_nikah, p.tgl_daftar as tgl_daftar
   FROM pasien p JOIN ref_desa des ON (des.id = p.desa_id) JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id) JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id) JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
   WHERE p.id = '".$id."'";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();

		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_hide_form", "form_tambah");
		$objResponse->addAssign("propinsi_id", "value", $data[prop_id]);
		$objResponse->addScriptCall("xajax_ref_get_kabupaten", "kabupaten_id", $data[prop_id], $data[kab_id], true);
		$objResponse->addScriptCall("xajax_ref_get_kecamatan", "kecamatan_id", $data[kab_id], $data[kec_id], true);
		$objResponse->addScriptCall("xajax_ref_get_desa", "desa_id", $data[kec_id], $data[des_id], true);

		$tgl_lahir = explode("-", $data[tgl_lahir]);
		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		//$objResponse->addAssign("debug", "innerHTML", $tgl_lahir[2] . ":" . $tgl_lahir[1] . ":" . $tgl_lahir[0]);

		//jika data ditemukan
		if(!empty($data)) {
			$objResponse->addAssign("id", "value", $data[id]);
			$objResponse->addAssign("id_pasien", "value", $data[id]);
			$objResponse->addAssign("nama", "value", $data[nama]);
			$objResponse->addAssign("usia_tahun", "value", $usia[tahun]);
			$objResponse->addAssign("usia_bulan", "value", $usia[bulan]);
			$objResponse->addAssign("usia_hari", "value", $usia[hari]);
			$objResponse->addAssign("tempat_lahir", "value", $data[tempat_lahir]);
			$objResponse->addAssign("tgl_lahir_tgl", "value", $tgl_lahir[2]);
			$objResponse->addAssign("tgl_lahir_bln", "value", $tgl_lahir[1]);
			$objResponse->addAssign("tgl_lahir_thn", "value", $tgl_lahir[0]);
			$objResponse->addAssign("gol_darah", "value", $data[gol_darah]);
			$objResponse->addAssign("alamat", "value", $data[alamat]);
			$objResponse->addAssign("rt", "value", $data[rt]);
			$objResponse->addAssign("rw", "value", $data[rw]);
			$objResponse->addAssign("telp", "value", $data[telp]);
			$objResponse->addAssign("agama", "value", $data[agama]);
			$objResponse->addAssign("sex", "value", $data[sex]);
			$objResponse->addAssign("pendidikan_id", "value", $data[pendidikan_id]);
			$objResponse->addAssign("pekerjaan_id", "value", $data[pekerjaan_id]);
			$objResponse->addAssign("status_nikah", "value", $data[status_nikah]);
			$objResponse->addScriptCall("fokus", "nama");
		} else {
			//jika tidak ada data pasien dengan no rm $id
			$objResponse->addScript("document.tambah_pasien.reset()");
			$objResponse->addAssign("id", "value", $id);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_pasien($value) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		if(!$value['id_pasien']) {
			if(!$value['id']) {
				$sql = "
					INSERT INTO pasien(
						nama,
						tempat_lahir,
						tgl_lahir,
						gol_darah,
						sex,
						agama,
						pendidikan_id,
						pekerjaan_id,
						status_nikah,
						alamat,
						rt,
						rw,
						desa_id,
						telp,
						tgl_daftar
						) 
					VALUES (
						'".$value[nama]."', 
						'".$value[tempat_lahir]."', 
						'".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl]."',
						NULLIF('".$value[gol_darah]."',''), 
						'".$value[sex]."',
						'".$value[agama]."',
						'".$value[pendidikan_id]."',
						'".$value[pekerjaan_id]."',
						'".$value[status_nikah]."',
						'".$value[alamat]."',
						'".$value[rt]."',
						'".$value[rw]."',
						'".$value[desa_id]."',
						'".$value[telp]."',
						NOW()
					)";
			} else {
				$sql = "
					INSERT INTO pasien(
						id,
						nama,
						tempat_lahir,
						tgl_lahir,
						gol_darah,
						sex,
						agama,
						pendidikan_id,
						pekerjaan_id,
						status_nikah,
						alamat,
						rt,
						rw,
						desa_id,
						telp,
						tgl_daftar
						) 
					VALUES (
						'".$value[id]."',
						'".$value[nama]."', 
						'".$value[tempat_lahir]."', 
						'".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl]."',
						NULLIF('".$value[gol_darah]."',''), 
						'".$value[sex]."',
						'".$value[agama]."',
						'".$value[pendidikan_id]."',
						'".$value[pekerjaan_id]."',
						'".$value[status_nikah]."',
						'".$value[alamat]."',
						'".$value[rt]."',
						'".$value[rw]."',
						'".$value[desa_id]."',
						'".$value[telp]."',
						NOW()
					)";
			}
			$kon->sql = $sql;
			$kon->execute();
			$afek = $kon->affected_rows;
			$last_id = $kon->last_id;
		} else {
			$sql = "
				UPDATE pasien SET 
					id = '".$value[id]."',
					nama= '".$value[nama]."', 
					tempat_lahir = '".$value[tempat_lahir]."',
					tgl_lahir= '".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl]."',
					gol_darah = NULLIF('".$value[gol_darah]."', ''),
					sex= '".$value[sex]."',
					agama= '".$value[agama]."',
					pendidikan_id= '".$value[pendidikan_id]."',
					pekerjaan_id= '".$value[pekerjaan_id]."',
					status_nikah= '".$value[status_nikah]."',
					alamat= '".$value[alamat]."', 
					rt= '".$value[rt]."',
					rw= '".$value[rw]."',
					desa_id= '".$value[desa_id]."',
					telp= '".$value[telp]."'
				WHERE 
					id = '".$value[id_pasien]."'";
			$kon->sql = $sql;
			$kon->execute();
			$afek = $kon->affected_rows;
			$last_id = $value[id];
		}
		
		if($afek < 0) {
			$objResponse->addAlert("Data Tidak Dapat Disimpan.\nCek kembali Nomor Rekam Medis.");
			$objResponse->addScriptCall("fokus", "id");
		} else {
			$objResponse->addConfirmCommands(1, "Cetak Kartu Periksa?");
			$objResponse->addScriptCall("cetak", URL . "setting/kartu_periksa_cetak/?id=" . $last_id, 350, 210);
			$objResponse->addScriptCall("show_status_simpan");
			$objResponse->addScriptCall("xajax_reset_pasien");
			$objResponse->addScriptCall("fokus", "id");
		}
		return $objResponse;
	}

	function simpan_pasien_check($value) {
		$objResponse = new xajaxResponse();
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		if(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Pasien.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!checkdate($new_value[tgl_lahir_bln],$new_value[tgl_lahir_tgl],$new_value[tgl_lahir_thn])) {
			$objResponse->addAlert("Tanggal Lahir Tidak Valid.");
			$objResponse->addScriptCall("fokus", "tgl_lahir_tgl");
		} elseif(!$new_value[sex]) {
			$objResponse->addAlert("Silakan Isi Jenis Kelamin Pasien.");
			$objResponse->addScriptCall("fokus", "sex");
		} elseif(!$new_value[agama]) {
			$objResponse->addAlert("Silakan Isi Agama Pasien.");
			$objResponse->addScriptCall("fokus", "agama");
		} elseif(!$new_value[pendidikan_id]) {
			$objResponse->addAlert("Silakan Isi Pendidikan Pasien.");
			$objResponse->addScriptCall("fokus", "pendidikan_id");
		} elseif(!$new_value[pekerjaan_id]) {
			$objResponse->addAlert("Silakan Isi Pekerjaan Pasien.");
			$objResponse->addScriptCall("fokus", "pekerjaan_id");
		} elseif(!$new_value[status_nikah]) {
			$objResponse->addAlert("Silakan Isi Status Nikah Pasien.");
			$objResponse->addScriptCall("fokus", "status_nikah");
		} elseif(!$new_value[alamat]) {
			$objResponse->addAlert("Silakan Isi Alamat Pasien.");
			$objResponse->addScriptCall("fokus", "alamat");
		} elseif(!$new_value[propinsi_id]) {
			$objResponse->addAlert("Silakan Isi Propinsi Pasien.");
			$objResponse->addScriptCall("fokus", "propinsi_id");
		} elseif(!$new_value[kabupaten_id]) {
			$objResponse->addAlert("Silakan Isi Kabupaten Pasien.");
			$objResponse->addScriptCall("fokus", "kabupaten_id");
		} elseif(!$new_value[kecamatan_id]) {
			$objResponse->addAlert("Silakan Isi Kecamatan Pasien.");
			$objResponse->addScriptCall("fokus", "kecamatan_id");
		} elseif(!$new_value[desa_id]) {
			$objResponse->addAlert("Silakan Isi Kelurahan Pasien.");
			$objResponse->addScriptCall("fokus", "desa_id");
		} else {
			$objResponse->addScriptCall("xajax_simpan_pasien", $new_value);
		}
		return $objResponse;
	}

	function reset_pasien () {
		$objResponse = new xajaxResponse();
		$objResponse->addScript("document.tambah_pasien.reset()");
		$objResponse->addClear("id_pasien", "value");
		$objResponse->addAssign("list_tombol_besar_kunjungan", "style.display", "none");
		//$objResponse->addScriptCall("fokus", "id");
		return $objResponse;
	}

	function get_tgl_lahir($value) {
		$tgl_skr = date("Y-m-d");
		$arr_tgl_skr = explode("-", $tgl_skr);
		
		$ret = @date("Y-m-d", @mktime(0, 0, 0, $arr_tgl_skr[1]-$value[usia_bulan], $arr_tgl_skr[2]-$value[usia_hari], $arr_tgl_skr[0]-$value[usia_tahun]));
		$arr_ret = explode("-", $ret);
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("tgl_lahir_tgl", "value", $arr_ret[2]);
		$objResponse->addAssign("tgl_lahir_bln", "value", $arr_ret[1]);
		$objResponse->addAssign("tgl_lahir_thn", "value", $arr_ret[0]);
		return $objResponse;
	}

	function hitung_umur($value) {
		$tgl_lahir = $value[tgl_lahir_thn] . "-" . $value[tgl_lahir_bln] . "-" . $value[tgl_lahir_tgl];
		$skr = date("Y-m-d");
		$usia = hitungUmur($tgl_lahir, $skr);
		
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("usia_tahun", "value", $usia[tahun]);
		$objResponse->addAssign("usia_bulan", "value", $usia[bulan]);
		$objResponse->addAssign("usia_hari", "value", $usia[hari]);
		return $objResponse;
	}
}



$kon = new Konek;
$kon->sql = "SELECT id, nama FROM ref_pendidikan";
$kon->execute();
$data_pendidikan = $kon->getAll();

$kon->sql = "SELECT id, nama FROM ref_pekerjaan";
$kon->execute();
$data_pekerjaan = $kon->getAll();

$kon->sql = "SELECT id, nama FROM ref_propinsi";
$kon->execute();
$data_propinsi = $kon->getAll();

$_xajax->registerFunction(array("get_pasien", "IRD", "get_pasien"));
$_xajax->registerFunction(array("simpan_pasien", "IRD", "simpan_pasien"));
$_xajax->registerFunction(array("simpan_pasien_check", "IRD", "simpan_pasien_check"));
$_xajax->registerFunction(array("reset_pasien", "IRD", "reset_pasien"));
$_xajax->registerFunction(array("get_tgl_lahir", "IRD", "get_tgl_lahir"));
$_xajax->registerFunction(array("hitung_umur", "IRD", "hitung_umur"));
include "sub.pasien_pencarian.php";
include AJAX_REF_DIR . "daerah.php";
include AJAX_REF_DIR . "kunjungan.php";
?>