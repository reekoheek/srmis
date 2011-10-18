<?
$_TITLE = "Administrasi Data Dokter";
Class Dokter {

	function list_data($hal = 0) {
		$_SESSION[hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;

		$paging->sql = "
			SELECT 
				d.id as id, 
				d.nama as nama, 
				spc.id as spc_id, 
				spc.nama as spc_nama, 
				sub.id as sub_id, 
				sub.nama as sub_nama, 
				d.telp as telp, 
				d.aktif as aktif,
				CASE 
					WHEN (d.aktif = '1') THEN 'Ya'
					ELSE 'Tidak'
				END AS aktif_nama
				FROM 
					dokter d 
					JOIN subspesialisasi sub ON (sub.id = d.subspesialisasi_id)
					JOIN spesialisasi spc ON (spc.id = sub.spesialisasi_id)
				ORDER BY 
					spc.nama, sub.nama, d.nama
			";
		$paging->hal = $hal;
		$paging->get_page_result();
		$_SESSION[modul_setting][dokter][hal] = $hal;
		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 380;
		$tabel->addTh("No", "Nama", "Spesialisasi/<br />Sub Spesialisasi", "Telp", "Aktif", "Hapus");
		$tabel->addExtraTh(" style=\"width:50px;\"", "style=\"width:200px;\"", "", "", "", " style=\"width:70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			$tabel->addRow(
				($no+$i), 
				$data[$i][nama], 
				$data[$i][spc_nama] . "<br />" . $data[$i][sub_nama], 
				$data[$i][telp], $data[$i][aktif_nama], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_dokter('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_dokter('".$data[$i][id]."')", 
				"xajax_get_dokter('".$data[$i][id]."')", 
				"xajax_get_dokter('".$data[$i][id]."')", 
				"xajax_get_dokter('".$data[$i][id]."')"
			);
		}
		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_dokter($id) {
		$kon = new Konek;
		$kon->sql = "
		SELECT 
			d.id as id, 
			d.nama as nama, 
			d.alamat as alamat,
			d.telp as telp,
			d.aktif as aktif,
			sub.id as sub_id, 
			sub.spesialisasi_id as spc_id
		FROM 
			dokter d 
			JOIN subspesialisasi sub ON (sub.id = d.subspesialisasi_id) 
		WHERE 
			d.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_dokter", "value", $data[id]);
		$objResponse->addAssign("spesialisasi_id", "value", $data[spc_id]);
		$objResponse->addScriptCall("xajax_ref_get_subspesialisasi", "subspesialisasi_id", $data[spc_id], $data[sub_id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("alamat", "value", $data[alamat]);
		$objResponse->addAssign("telp", "value", $data[telp]);
		$objResponse->addAssign("aktif", "value", $data[aktif]);
		$objResponse->addScriptCall("fokus", "spesialisasi_id");
		return $objResponse;
	}

	function hapus_dokter($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM dokter WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.\nTerdapat data lain yang menggunakan data ini.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[modul_setting][dokter][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_dokter($value) {
		$kon = new Konek;
		if(!$value['id_dokter']) {
			$kon->sql = "INSERT INTO dokter(subspesialisasi_id, nama, alamat, telp, aktif) VALUES ('".$value[subspesialisasi_id]."', '".$value[nama]."', '".$value[alamat]."','".$value[telp]."','".$value[aktif]."')";
		} else {
			$kon->sql = "UPDATE dokter SET subspesialisasi_id = '".$value[subspesialisasi_id]."', nama = '".$value[nama]."', alamat = '".$value[alamat]."', telp = '".$value[telp]."', aktif='".$value[aktif]."' WHERE id = '".$value[id_dokter]."'";
		}
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_dokter");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[modul_setting][dokter][hal]);
		return $objResponse;
	}

	function simpan_dokter_check($value) {
		$objResponse = new xajaxResponse();
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		if(!$new_value[spesialisasi_id]) {
			$objResponse->addAlert("Silakan Isi Spesialisasi.");
			$objResponse->addScriptCall("fokus", "spesialisasi_id");
		} elseif(!$new_value[subspesialisasi_id]) {
			$objResponse->addAlert("Silakan Isi Subspesialisasi.");
			$objResponse->addScriptCall("fokus", "subspesialisasi_id");
		} elseif(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi nama.");
			$objResponse->addScriptCall("fokus", "nama");
		} else {
			$objResponse->addScriptCall("xajax_simpan_dokter", $new_value);
		}
		return $objResponse;
	}

	function reset_dokter () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_dokter", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("alamat", "value");
		$objResponse->addClear("telp", "value");
		$objResponse->addScriptCall("fokus", "spesialisasi_id");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT id, nama FROM spesialisasi ORDER BY nama";
$kon->execute();
$_data_spc = $kon->getAll();


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Dokter", "list_data"));
$_xajax->registerFunction(array("get_dokter", "Dokter", "get_dokter"));
$_xajax->registerFunction(array("hapus_dokter", "Dokter", "hapus_dokter"));
$_xajax->registerFunction(array("simpan_dokter", "Dokter", "simpan_dokter"));
$_xajax->registerFunction(array("simpan_dokter_check", "Dokter", "simpan_dokter_check"));
$_xajax->registerFunction(array("reset_dokter", "Dokter", "reset_dokter"));
include AJAX_REF_DIR . "kunjungan.php";

?>