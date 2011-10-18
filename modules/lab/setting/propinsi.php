<?
$_TITLE = "Administrasi Data Provinsi";
Class Propinsi {

	function list_data($hal = 0) {
		$_SESSION[setting_propinsi][hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "
			SELECT 
				p.id AS id, 
				p.nama AS nama, 
				COUNT(k.id) AS jml_kab
			FROM 
				ref_propinsi p 
				LEFT JOIN ref_kabupaten k ON (k.propinsi_id = p.id) 
			GROUP BY 
				p.id 
			ORDER BY 
				p.nama
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 420;
		$tabel->addTh("No", "Propinsi", "Jml<br />Kabupaten", "Hapus");
		$tabel->addExtraTh(" style=\"width: 50px;\"", "", " style=\"width: 100px;\"", " style=\"width: 70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			$tabel->addRow(($no+$i), $data[$i][nama], $data[$i][jml_kab], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_propinsi('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd("xajax_get_propinsi('".$data[$i][id]."')", "xajax_get_propinsi('".$data[$i][id]."')", "xajax_get_propinsi('".$data[$i][id]."')");
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_propinsi($id) {
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM ref_propinsi WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_propinsi", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_propinsi($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_propinsi WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_propinsi][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_propinsi($value) {
		$kon = new Konek;
		if(!$value['id_propinsi'])
			$kon->sql = "INSERT INTO ref_propinsi(nama) VALUES ('".$value[nama]."')";
		else 
			$kon->sql = "UPDATE ref_propinsi SET nama = '".$value[nama]."' WHERE id = '".$value[id_propinsi]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addAssign("id_propinsi", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_propinsi][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_propinsi_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Propinsi.");
		else 
			$objResponse->addScriptCall("xajax_simpan_propinsi", $value);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_propinsi () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_propinsi", "value");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Propinsi", "list_data"));
$_xajax->registerFunction(array("get_propinsi", "Propinsi", "get_propinsi"));
$_xajax->registerFunction(array("hapus_propinsi", "Propinsi", "hapus_propinsi"));
$_xajax->registerFunction(array("simpan_propinsi", "Propinsi", "simpan_propinsi"));
$_xajax->registerFunction(array("simpan_propinsi_check", "Propinsi", "simpan_propinsi_check"));
$_xajax->registerFunction(array("reset_propinsi", "Propinsi", "reset_propinsi"));


?>