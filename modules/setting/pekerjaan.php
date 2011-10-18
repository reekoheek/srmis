<?
$_TITLE = "Administrasi Data Pekerjaan";
Class Pekerjaan {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT id, nama FROM ref_pekerjaan ORDER BY nama";
		$paging->hal = $hal;
		$_SESSION[setting_pekerjaan][hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		
		$table = new Table;
		$table->tbody_height = 440;
		$table->addTh("No", "Nama", "Hapus");
		$table->addExtraTh(" style=\"width: 50px;\"", "", " style=\"width: 70px;\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(($no+$i), $data[$i][nama], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_pekerjaan('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$table->addExtraTd(" onclick=\"xajax_get_pekerjaan('".$data[$i][id]."')\" ", " onclick=\"xajax_get_pekerjaan('".$data[$i][id]."')\" ");
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_pekerjaan($id) {
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM ref_pekerjaan WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pekerjaan", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_pekerjaan($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_pekerjaan WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_pekerjaan][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_pekerjaan($value) {
		$kon = new Konek;
		if(!$value['id_pekerjaan'])
			$kon->sql = "INSERT INTO ref_pekerjaan(nama) VALUES ('".$value[nama]."')";
		else 
			$kon->sql = "UPDATE ref_pekerjaan SET nama = '".$value[nama]."' WHERE id = '".$value[id_pekerjaan]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addAssign("id_pekerjaan", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_pekerjaan][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_pekerjaan_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Pekerjaan.");
		else 
			$objResponse->addScriptCall("xajax_simpan_pekerjaan", $value);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_pekerjaan () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pekerjaan", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Pekerjaan", "list_data"));
$_xajax->registerFunction(array("get_pekerjaan", "Pekerjaan", "get_pekerjaan"));
$_xajax->registerFunction(array("hapus_pekerjaan", "Pekerjaan", "hapus_pekerjaan"));
$_xajax->registerFunction(array("simpan_pekerjaan", "Pekerjaan", "simpan_pekerjaan"));
$_xajax->registerFunction(array("simpan_pekerjaan_check", "Pekerjaan", "simpan_pekerjaan_check"));
$_xajax->registerFunction(array("reset_pekerjaan", "Pekerjaan", "reset_pekerjaan"));


?>