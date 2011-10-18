<?
$_TITLE = "Setting Cara Bayar";
Class Status_nikah {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->sql = "SELECT id, nama FROM ref_cara_bayar ORDER BY nama";
		$paging->get_page_result();
		$paging->hal = $hal;
		$_SESSION[hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->addTh("No", "Nama", "Hapus");
		$table->addExtraTh(" style=\"width: 50px;\"", "", " style=\"width: 70px;\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(($no+$i), $data[$i][nama], "<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_cara_bayar_confirm('".$data[$i][id]."', '".addslashes($data[$i][nama])."')\" />");
			$table->addExtraTd(" onclick=\"xajax_get_cara_bayar('".$data[$i][id]."')\" ", " onclick=\"xajax_get_cara_bayar('".$data[$i][id]."')\" ");
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_cara_bayar($id) {
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM ref_cara_bayar WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_cara_bayar", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_cara_bayar($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_cara_bayar WHERE id = '".$id."'";
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

	function hapus_cara_bayar_confirm($id, $nama) {
		$objResponse = new xajaxResponse();
		$objResponse->addConfirmCommands(1, "Yakin akan menghapus data : \n$nama?");
		$objResponse->addScriptCall("xajax_hapus_cara_bayar", $id);
		return $objResponse;
	}

	function simpan_cara_bayar($value) {
		$kon = new Konek;
		if(!$value['id_cara_bayar'])
			$kon->sql = "INSERT INTO ref_cara_bayar(nama) VALUES ('".$value[nama]."')";
		else 
			$kon->sql = "UPDATE ref_cara_bayar SET nama = '".$value[nama]."' WHERE id = '".$value[id_cara_bayar]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addAssign("id_cara_bayar", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_cara_bayar_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Status Nikah.");
		else 
			$objResponse->addScriptCall("xajax_simpan_cara_bayar", $value);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_cara_bayar () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_cara_bayar", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Status_nikah", "list_data"));
$_xajax->registerFunction(array("get_cara_bayar", "Status_nikah", "get_cara_bayar"));
$_xajax->registerFunction(array("hapus_cara_bayar", "Status_nikah", "hapus_cara_bayar"));
$_xajax->registerFunction(array("hapus_cara_bayar_confirm", "Status_nikah", "hapus_cara_bayar_confirm"));
$_xajax->registerFunction(array("simpan_cara_bayar", "Status_nikah", "simpan_cara_bayar"));
$_xajax->registerFunction(array("simpan_cara_bayar_check", "Status_nikah", "simpan_cara_bayar_check"));
$_xajax->registerFunction(array("reset_cara_bayar", "Status_nikah", "reset_cara_bayar"));


?>