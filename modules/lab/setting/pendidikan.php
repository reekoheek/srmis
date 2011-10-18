<?
$_TITLE = "Administrasi Data Pendidikan";
Class Pendidikan {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT id, nama FROM ref_pendidikan ORDER BY nama";
		$paging->get_page_result();
		$paging->hal = $hal;
		$_SESSION[hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 440;
		$table->addTh("No", "Nama", "Hapus");
		$table->addExtraTh(" style=\"width: 50px;\"", "", " style=\"width: 70px;\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(($no+$i), $data[$i][nama], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_pendidikan('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$table->addExtraTd(" onclick=\"xajax_get_pendidikan('".$data[$i][id]."')\" ", " onclick=\"xajax_get_pendidikan('".$data[$i][id]."')\" ");
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_pendidikan($id) {
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM ref_pendidikan WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pendidikan", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_pendidikan($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_pendidikan WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_pendidikan($value) {
		$kon = new Konek;
		if(!$value['id_pendidikan'])
			$kon->sql = "INSERT INTO ref_pendidikan(nama) VALUES ('".$value[nama]."')";
		else 
			$kon->sql = "UPDATE ref_pendidikan SET nama = '".$value[nama]."' WHERE id = '".$value[id_pendidikan]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addAssign("id_pendidikan", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_pendidikan_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Pendidikan.");
		else 
			$objResponse->addScriptCall("xajax_simpan_pendidikan", $value);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_pendidikan () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pendidikan", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Pendidikan", "list_data"));
$_xajax->registerFunction(array("get_pendidikan", "Pendidikan", "get_pendidikan"));
$_xajax->registerFunction(array("hapus_pendidikan", "Pendidikan", "hapus_pendidikan"));
$_xajax->registerFunction(array("simpan_pendidikan", "Pendidikan", "simpan_pendidikan"));
$_xajax->registerFunction(array("simpan_pendidikan_check", "Pendidikan", "simpan_pendidikan_check"));
$_xajax->registerFunction(array("reset_pendidikan", "Pendidikan", "reset_pendidikan"));


?>