<?
$_TITLE = "Administrasi Data Imunisasi";
Class Imunisasi {

	function list_data($hal = 0) {
		$_SESSION[setting_imunisasi][hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "
		SELECT 
			id as id,
			nama as nama,
			sebab_sakit as sebab_sakit
		FROM
			imunisasi
		ORDER BY 
			nama
		";
		$paging->hal = $hal;
		$paging->get_page_result();		
		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 350;
		$tabel->addTh("No", "Nama", "Sebab Sakit", "Hapus");
		$tabel->addExtraTh(" style=\"width:50px;\"", "style=\"width:200px;\"", "", " style=\"width:70px;\"");

		for($i=0;$i<sizeof($data);$i++) {
			$tabel->addRow(($i+1), $data[$i][nama], $data[$i][sebab_sakit], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_imunisasi('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_imunisasi('".$data[$i][id]."')", 
				"xajax_get_imunisasi('".$data[$i][id]."')", 
				"xajax_get_imunisasi('".$data[$i][id]."')"
			);
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_imunisasi($id) {
		
		$objResponse = new xajaxResponse();
		$objResponse->addScript("document.getElementById('sebab_sakit_1').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_2').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_3').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_4').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_5').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_6').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_7').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_8').checked=false;");
		$kon = new Konek;
		$kon->sql = "
		SELECT 
			id as id,
			nama as nama,
			sebab_sakit as sebab_sakit
		FROM 
			imunisasi
		WHERE 
			id = '".$id."'
		GROUP BY id
		";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse->addAssign("id_imunisasi", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$arr_sebab_sakit = explode(",", $data[sebab_sakit]);
		if(in_array("Dipteri", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_1').checked=true;");
		}
		if(in_array("Pertusis", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_2').checked=true;");
		}
		if(in_array("Tetanus", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_3').checked=true;");
		}
		if(in_array("Tetanus Neonatorum", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_4').checked=true;");
		}
		if(in_array("TBC Paru", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_5').checked=true;");
		}
		if(in_array("Campak", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_6').checked=true;");
		}
		if(in_array("Polio", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_7').checked=true;");
		}
		if(in_array("Hepatitis", $arr_sebab_sakit)) {
			$objResponse->addScript("document.getElementById('sebab_sakit_8').checked=true;");
		}
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_imunisasi($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM imunisasi WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_imunisasi][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_imunisasi($value, $baru) {
		for($i=0;$i<sizeof($baru);$i++) {
			if($baru[$i]) $new[$i] = "".$baru[$i]."";
		}
		$sebab_sakit = implode(",", $new);
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		if(!$value['id_imunisasi']) {
			$sql = "INSERT INTO imunisasi(nama, sebab_sakit) VALUES ('".$value[nama]."', ('".$sebab_sakit."'))";
			$kon->sql = $sql;
			$kon->execute();
		} else {
			$sql = "UPDATE imunisasi SET nama = '".$value[nama]."', sebab_sakit = ('".$sebab_sakit."') WHERE id = '".$value[id_imunisasi]."'";
			$kon->sql = $sql;
			$kon->execute();
		}
		
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addAssign("id_imunisasi", "value", "");
		$objResponse->addClear("nama", "value");
		$objResponse->addScriptCall("xajax_reset_imunisasi");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_imunisasi][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//$objResponse->addAlert(print_r($sebab_sakit));
		//$objResponse->addAlert(print_r($value));
		return $objResponse;
	}

	function simpan_imunisasi_check($value, $baru) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Imunisasi.");
		else {
			$objResponse->addScriptCall("xajax_simpan_imunisasi", $value, $baru);
		}
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_imunisasi () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_imunisasi", "value", "");
		$objResponse->addScript("document.getElementById('sebab_sakit_1').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_2').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_3').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_4').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_5').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_6').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_7').checked=false;");
		$objResponse->addScript("document.getElementById('sebab_sakit_8').checked=false;");
		$objResponse->addScript("document.getElementById('form_imunisasi').reset()");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Imunisasi", "list_data"));
$_xajax->registerFunction(array("get_imunisasi", "Imunisasi", "get_imunisasi"));
$_xajax->registerFunction(array("hapus_imunisasi", "Imunisasi", "hapus_imunisasi"));
$_xajax->registerFunction(array("simpan_imunisasi", "Imunisasi", "simpan_imunisasi"));
$_xajax->registerFunction(array("simpan_imunisasi_check", "Imunisasi", "simpan_imunisasi_check"));
$_xajax->registerFunction(array("reset_imunisasi", "Imunisasi", "reset_imunisasi"));


?>