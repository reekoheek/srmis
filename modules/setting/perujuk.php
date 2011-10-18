<?
$_TITLE = "Administrasi Data Perujuk";
Class Status_nikah {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT id, nama, alamat FROM ref_perujuk ORDER BY nama";
		$paging->get_page_result();
		$paging->hal = $hal;
		$_SESSION[hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 420;
		$table->addTh("No", "Nama", "Alamat", "Hapus");
		$table->addExtraTh(" style=\"width: 50px;\"", " style=\"width: 200px;\"", "", " style=\"width: 70px;\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][nama], 
				$data[$i][alamat], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_perujuk('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$table->addExtraTd(
				" onclick=\"xajax_get_perujuk('".$data[$i][id]."')\" ", 
				" onclick=\"xajax_get_perujuk('".$data[$i][id]."')\" ", 
				" onclick=\"xajax_get_perujuk('".$data[$i][id]."')\" ");
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_perujuk($id) {
		$kon = new Konek;
		$kon->sql = "SELECT id, nama, alamat FROM ref_perujuk WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_perujuk", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("alamat", "value", $data[alamat]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_perujuk($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_perujuk WHERE id = '".$id."'";
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

	function simpan_perujuk($value) {
		$kon = new Konek;
		if(!$value['id_perujuk'])
			$kon->sql = "INSERT INTO ref_perujuk(nama, alamat) VALUES ('".$value[nama]."', '".$value[alamat]."')";
		else 
			$kon->sql = "UPDATE ref_perujuk SET nama = '".$value[nama]."', alamat = '".$value[alamat]."' WHERE id = '".$value[id_perujuk]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_perujuk");
		$objResponse->addScriptCall("xajax_list_data");
		return $objResponse;
	}

	function simpan_perujuk_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Perujuk.");
		else 
			$objResponse->addScriptCall("xajax_simpan_perujuk", $value);
		return $objResponse;
	}

	function reset_perujuk () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_perujuk", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addAssign("alamat", "value", "");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Status_nikah", "list_data"));
$_xajax->registerFunction(array("get_perujuk", "Status_nikah", "get_perujuk"));
$_xajax->registerFunction(array("hapus_perujuk", "Status_nikah", "hapus_perujuk"));
$_xajax->registerFunction(array("simpan_perujuk", "Status_nikah", "simpan_perujuk"));
$_xajax->registerFunction(array("simpan_perujuk_check", "Status_nikah", "simpan_perujuk_check"));
$_xajax->registerFunction(array("reset_perujuk", "Status_nikah", "reset_perujuk"));


?>