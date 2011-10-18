<?
$_TITLE = "Administrasi Data Radiologi Spesimen";
Class radiologi_spesimen {

	function list_data_radio($hal = 0) {
		$_SESSION[setting_radiologi_spesimen][hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 15;
		$paging->sql = "
			SELECT 
				rp.id as id,
				rp.nama as nama,
				rp.biaya_bhp as biaya_bhp,
				rpd.biaya_jasa as biaya_jasa,
				rpd.kelas as kelas
			FROM 
				radio_pemeriksaan rp
				JOIN radio_pemeriksaan_detil rpd ON (rpd.tingkat = rp.tingkat)			
			ORDER BY 
				rp.nama
			";
		
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 350;
		$table->addTh(
			"No", 
			"Nama", 
			"Biaya BHP", 
			"Biaya Jasa",
			"Kelas",
			"Hapus"
		);
		//$table->addExtraTh("style=\"width:50px;\"","style=\"width:200px;\"","","","");
		//$kon = new Konek;
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
		$objResponse->addAssign("list_data_radio", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}
	
	function get_radio($id) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				rp.id as id,
				rp.nama as nama,
				rp.biaya_bhp as biaya_bhp,
				rpd.biaya_jasa as biaya_jasa,
				rpd.kelas as kelas
			FROM 
				radio_pemeriksaan rp
				JOIN radio_pemeriksaan_detil rpd ON (rpd.tingkat = rp.tingkat)			
			WHERE 
				rp.id = '".$id."'";
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
	
	/*function get_info($id) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				k.id as id, 
				k.nama as nama, 
				k.kelas as kelas, 
				k.jml_bed as jml_bed,
				p.id as pelayanan_id,
                k.tarif_asuransi as tarif_asuransi,k.tarif_umum as tarif_umum,
                k.no_kamar as no_kamar
			FROM 
				kamar k
				 JOIN pelayanan p ON (p.id = k.pelayanan_id)
			WHERE 
				k.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_kamar", "value", $data[id]);
		$objResponse->addAssign("pelayanan_id", "value", $data[pelayanan_id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		$objResponse->addAssign("jml_bed", "value", $data[jml_bed]);
        $objResponse->addAssign("no_kamar", "value", $data[no_kamar]);
        $objResponse->addAssign("tarif_umum", "value", $data[tarif_umum]);
        $objResponse->addAssign("tarif_asuransi", "value", $data[tarif_asuransi]);
		$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}*/

	function hapus_radio($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM kamar WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data_radio", $_SESSION[modul_setting][radiologi_spesimen][hal]);
			//panggil sidebar bangsal
			$objResponse->addScriptCall("xajax_info_get_kamar_kosong");
			$objResponse->addScriptCall("fokus", "jenis");
		}
		return $objResponse;
	}

	function simpan_radio($value) {
		$kon = new Konek;
		if(!$value['id_radio'])
		{
			$sql = "INSERT INTO radio_pemeriksaan(nama, tingkat, biaya_bhp) VALUES ('".$value[nama]."', '".$value[tingkat]."', '".$value[biaya]."')";
			$kon->sql = $sql;
			$kon->execute();
			
			$sql = "INSERT INTO radio_pemeriksaan_detil(tingkat, kelas, jenis_pelayanan, biaya_jasa) VALUES ('".$value[tingkat]."', '".$value[kelas]."', '".$value[jenis_pelayanan]."', '".$value[biaya_jasa]."')";
		}
		else 
		{
			$sql = "UPDATE radio_pemerksaan SET nama = '".$value[nama]."', tingkat = '".$value[tingkat]."' , biaya_bhp = '".$value[biaya]."' WHERE id = '".$value[id_radio]."'";
		}
		
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_data_radio", $_SESSION[modul_setting][radiologi_spesimen][hal]);
		//panggil sidebar bangsal
		//$objResponse->addScriptCall("xajax_info_get_radio");
		$objResponse->addScriptCall("xajax_reset_radio");
		return $objResponse;
	}

	function simpan_radio_check($value) {
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
			$objResponse->addScriptCall("xajax_simpan_radio", $new_value);
		}
		return $objResponse;
	}

	function reset_radio () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_radio", "value");
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
$_xajax->registerFunction(array("list_data_radio", "radiologi_spesimen", "list_data_radio"));
$_xajax->registerFunction(array("get_radio", "radiologi_spesimen", "get_radio"));
$_xajax->registerFunction(array("hapus_radio", "radiologi_spesimen", "hapus_radio"));
$_xajax->registerFunction(array("simpan_radio", "radiologi_spesimen", "simpan_radio"));
$_xajax->registerFunction(array("simpan_radio_check", "radiologi_spesimen", "simpan_radio_check"));
$_xajax->registerFunction(array("reset_radio", "radiologi_spesimen", "reset_radio"));

//include AJAX_REF_DIR . "kunjungan.php";
?>