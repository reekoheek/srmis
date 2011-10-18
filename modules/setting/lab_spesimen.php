<?
$_TITLE = "Administrasi Data Lab Spesimen";
Class lab_spesimen {

	function list_data_lab($hal = 0) {
		$paging = new MyPagina;
		$paging->sql = "
			SELECT 
				ls.id as id,
				ls.nama as nama,
				ls.biaya_bhp as biaya_bhp,
				lsd.biaya_jasa as biaya_jasa,
				lsd.kelas as kelas
			FROM 
				lab_specimen ls
				JOIN lab_specimen_detil lsd ON (lsd.tingkat = ls.tingkat)			
			ORDER BY 
				ls.nama
			";
			
		$paging->rows_on_page = 15;
		$paging->hal = $hal;
		$_SESSION[modul_setting][lab_spesimen][hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 350;
		$table->addTh("No","Nama","Biaya_bhp","Biaya Jasa","Kelas","Hapus");
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:200px;\"","","","");
		$kon = new Konek;
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][nama],
				$data[$i][biaya_bhp], 
				$data[$i][biaya_jasa],
				$data[$i][kelas], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kamar('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>"
			);
			$table->addOnclickTd(
				"xajax_get_info('".$data[$i][id]."')", 
				"xajax_get_info('".$data[$i][id]."')", 
				"xajax_get_info('".$data[$i][id]."')", 
				"xajax_get_info('".$data[$i][id]."')", 
				"xajax_get_info('".$data[$i][id]."')"
			);
		}
		$buka = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data_lab", "innerHTML", $buka);
		return $objResponse;
	}

	function get_lab($id) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				ls.id as id,
				ls.nama as nama,
				ls.biaya_bhp as biaya_bhp,
				lsd.biaya_jasa as biaya_jasa,
				lsd.kelas as kelas
			FROM 
				lab_specimen ls
				JOIN lab_specimen_detil lsd ON (lsd.tingkat = ls.tingkat)			
			WHERE 
				ls.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("biaya_bhp", "value", $data[biaya_bhp]);
		$objResponse->addAssign("biaya_jasa", "value", $data[biaya_jasa]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		return $objResponse;
	}
		function hapus_lab($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM karcis WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_lab_spesimen][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}
	
	function simpan_lab($value) {
		$kon = new Konek;
		if(!$value['id_lab'])
		{
			$sql = "INSERT INTO lab_specimen(nama, tingkat, biaya_bhp) VALUES ('".$value[nama]."', '".$value[tingkat]."', '".$value[biaya]."')";
			$kon->sql = $sql;
			$kon->execute();
			
			$sql = "INSERT INTO lab_specimen_detil(tingkat, kelas, jenis_pelayanan, biaya_jasa) VALUES ('".$value[tingkat]."', '".$value[kelas]."', '".$value[jenis_pelayanan]."', '".$value[biaya_jasa]."')";
		}
		else 
		{
			$sql = "UPDATE lab_specimen SET nama = '".$value[nama]."', tingkat = '".$value[tingkat]."' , biaya_bhp = '".$value[biaya]."' WHERE id = '".$value[id_lab]."'";
		}
		$kon->sql = $sql;
		$kon->execute();
		
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_data_lab", $_SESSION[modul_setting][lab_spesimen][hal]);
		//panggil sidebar bangsal
		//$objResponse->addScriptCall("xajax_info_get_kamar_kosong");
		$objResponse->addScriptCall("xajax_reset_lab");
		return $objResponse;
	}

	function simpan_lab_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		//$objResponse->addAlert(print_r($value));
		if(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Specimen.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$new_value[biaya]) {
			$objResponse->addAlert("Silakan Isi Biaya.");
			$objResponse->addScriptCall("fokus", "biaya");
		} elseif(!$new_value[tingkat]) {
			$objResponse->addAlert("Silakan Isi Tingkat.");
			$objResponse->addScriptCall("fokus", "tingkat");
		} else {
			$objResponse->addScriptCall("xajax_simpan_lab", $new_value);
		}
		return $objResponse;
	}

	function reset_lab () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_lab", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("kelas", "value");
		$objResponse->addClear("tingkat", "value");
		$objResponse->addClear("jenis_pelayanan", "value");
		$objResponse->addClear("biaya", "value");
		$objResponse->addClear("biaya_jasa", "value");	
		//$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}
}

/*$kon = new Konek;
$kon->sql = "SELECT * FROM pelayanan WHERE jenis = 'RAWAT INAP' ORDER BY nama";
$kon->execute();
$_data_pel = $kon->getAll();*/

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data_lab", "lab_spesimen", "list_data_lab"));
$_xajax->registerFunction(array("get_lab", "lab_spesimen", "get_lab"));
$_xajax->registerFunction(array("hapus_lab", "lab_spesimen", "hapus_lab"));
$_xajax->registerFunction(array("simpan_lab", "lab_spesimen", "simpan_lab"));
$_xajax->registerFunction(array("simpan_lab_check", "lab_spesimen", "simpan_lab_check"));
$_xajax->registerFunction(array("reset_lab", "lab_spesimen", "reset_lab"));

?>