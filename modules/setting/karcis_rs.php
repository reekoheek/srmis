<?
$_TITLE = "Administrasi Data Karcis";
Class karcis_rs {

	function list_data($hal = 0) {
		$_SESSION[setting_karcis][hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT * FROM karcis ORDER BY jenis, nama";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 430;
		$tabel->addTh("No", "Nama", "Jenis", "Kelas", "Jasa", "Hapus");
		//$tabel->addExtraTh("style=\"width: 50px;\"", "", " style=\"width: 70px;\"");

		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][jenis] == "IGD") $jenis = "IRD";
			else $jenis = $data[$i][jenis];
			$tabel->addRow(
				($no+$i), 
				$data[$i][nama], 
				$jenis, 
				$data[$i][kelas], 
				$data[$i][biaya_jasa], 
				$data[$i][bhp_p], 
				$data[$i][bhp_rs], 
				$data[$i][bhp_rs_adm], 
				$data[$i][bhp_rs_op], 
				$data[$i][jasa_p], 
				$data[$i][jasa_rs], 
				$data[$i][jasa_rs_op], 
				$data[$i][jasa_rs_kembang], 
				$data[$i][jasa_rs_adm], 
				$data[$i][jasa_rs_sdm], 
				$data[$i][spesialis], 
				$data[$i][spesialis_pendamping], 
				$data[$i][ugp], 
				$data[$i][grabaf], 
				$data[$i][perawat], 
				$data[$i][penunjang], 
				$data[$i][zakat], 
				$data[$i][pajak], 
				$data[$i][netto], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_karcis('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')", 
				"xajax_get_karcis('".$data[$i][id]."')"
			);
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_karcis($id) {
		$kon = new Konek;
		$kon->sql = "SELECT * FROM karcis WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		/*
				$data[$i][kelas], 
				$data[$i][biaya_bhp], 
				$data[$i][biaya_jasa], 
				$data[$i][bhp_p], 
				$data[$i][bhp_rs], 
				$data[$i][bhp_rs_adm], 
				$data[$i][bhp_rs_op], 
				$data[$i][jasa_p], 
				$data[$i][jasa_rs], 
				$data[$i][jasa_rs_op], 
				$data[$i][jasa_rs_kembang], 
				$data[$i][jasa_rs_adm], 
				$data[$i][jasa_rs_sdm], 
				$data[$i][spesialis], 
				$data[$i][spesialis_pendamping], 
				$data[$i][ugp], 
				$data[$i][grabaf], 
				$data[$i][perawat], 
				$data[$i][penunjang], 
				$data[$i][zakat], 
				$data[$i][pajak], 
				$data[$i][netto], 
		
		*/
		$objResponse->addAssign("id_karcis", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("jenis", "value", $data[jenis]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		$objResponse->addAssign("biaya_bhp", "value", $data[biaya_bhp]);
		$objResponse->addAssign("biaya_jasa", "value", $data[biaya_jasa]);
		$objResponse->addAssign("bhp_p", "value", $data[bhp_p]);
		$objResponse->addAssign("bhp_rs", "value", $data[bhp_rs]);
		$objResponse->addAssign("bhp_rs_adm", "value", $data[bhp_rs_adm]);
		$objResponse->addAssign("bhp_rs_op", "value", $data[bhp_rs_op]);
		$objResponse->addAssign("jasa_p", "value", $data[jasa_p]);
		$objResponse->addAssign("jasa_rs", "value", $data[jasa_rs]);
		$objResponse->addAssign("jasa_rs_op", "value", $data[jasa_rs_op]);
		$objResponse->addAssign("jasa_rs_kembang", "value", $data[jasa_rs_kembang]);
		$objResponse->addAssign("jasa_rs_adm", "value", $data[jasa_rs_adm]);
		$objResponse->addAssign("jasa_rs_sdm", "value", $data[jasa_rs_sdm]);
		$objResponse->addAssign("spesialis", "value", $data[spesialis]);
		$objResponse->addAssign("spesialis_pendamping", "value", $data[spesialis_pendamping]);
		$objResponse->addAssign("ugp", "value", $data[ugp]);
		$objResponse->addAssign("grabaf", "value", $data[grabaf]);
		$objResponse->addAssign("perawat", "value", $data[perawat]);
		$objResponse->addAssign("penunjang", "value", $data[penunjang]);
		$objResponse->addAssign("zakat", "value", $data[zakat]);
		$objResponse->addAssign("pajak", "value", $data[pajak]);
		$objResponse->addAssign("netto", "value", $data[netto]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_karcis($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM karcis WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_karcis][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_karcis($value) {
		$kon = new Konek;
		if(!$value['id_karcis']) {
			$sql = "
			INSERT INTO 
				karcis(
					nama,
					jenis,
					kelas, 
					biaya_bhp, 
					biaya_jasa, 
					bhp_p, 
					bhp_rs, 
					bhp_rs_adm, 
					bhp_rs_op, 
					jasa_p, 
					jasa_rs, 
					jasa_rs_op, 
					jasa_rs_kembang, 
					jasa_rs_adm, 
					jasa_rs_sdm, 
					spesialis, 
					spesialis_pendamping, 
					ugp, 
					grabaf, 
					perawat, 
					penunjang, 
					zakat, 
					pajak, 
					netto

				) 
			VALUES (
					'".$value[nama]."',
					'".$value[jenis]."',
					'".$value[kelas]."', 
					'".$value[biaya_bhp]."', 
					'".$value[biaya_jasa]."', 
					'".$value[bhp_p]."', 
					'".$value[bhp_rs]."', 
					'".$value[bhp_rs_adm]."', 
					'".$value[bhp_rs_op]."', 
					'".$value[jasa_p]."', 
					'".$value[jasa_rs]."', 
					'".$value[jasa_rs_op]."', 
					'".$value[jasa_rs_kembang]."', 
					'".$value[jasa_rs_adm]."', 
					'".$value[jasa_rs_sdm]."', 
					'".$value[spesialis]."', 
					'".$value[spesialis_pendamping]."', 
					'".$value[ugp]."', 
					'".$value[grabaf]."', 
					'".$value[perawat]."', 
					'".$value[penunjang]."', 
					'".$value[zakat]."', 
					'".$value[pajak]."', 
					'".$value[netto]."'
			)
			";
		} else {
			$sql = "
			UPDATE 
				karcis 
			SET 
				nama = '".$value[nama]."',
				jenis =	'".$value[jenis]."',
				kelas =	'".$value[kelas]."', 
				biaya_bhp = '".$value[biaya_bhp]."', 
				biaya_jasa = '".$value[biaya_jasa]."', 
				bhp_p = '".$value[bhp_p]."', 
				bhp_rs	= '".$value[bhp_rs]."', 
				bhp_rs_adm	= '".$value[bhp_rs_adm]."', 
				bhp_rs_op	= '".$value[bhp_rs_op]."', 
				jasa_p	= '".$value[jasa_p]."', 
				jasa_rs	= '".$value[jasa_rs]."', 
				jasa_rs_op	= '".$value[jasa_rs_op]."', 
				jasa_rs_kembang	= '".$value[jasa_rs_kembang]."', 
				jasa_rs_adm	= '".$value[jasa_rs_adm]."', 
				jasa_rs_sdm	= '".$value[jasa_rs_sdm]."', 
				spesialis	= '".$value[spesialis]."', 
				spesialis_pendamping	= '".$value[spesialis_pendamping]."', 
				ugp	= '".$value[ugp]."', 
				grabaf	= '".$value[grabaf]."', 
				perawat	= '".$value[perawat]."', 
				penunjang	= '".$value[penunjang]."', 
				zakat	= '".$value[zakat]."', 
				pajak	= '".$value[pajak]."', 
				netto	= '".$value[netto]."'
			WHERE 
				id = '".$value[id_karcis]."'
			";
		}
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[setting_karcis][hal]);
		$objResponse->addScriptCall("xajax_reset_karcis");
		return $objResponse;
	}

	function simpan_karcis_check($value) {
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama])
			$objResponse->addAlert("Silakan Isi Nama Karcis.");
		else 
			$objResponse->addScriptCall("xajax_simpan_karcis", $value);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function reset_karcis () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_karcis", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("jenis", "value");
		$objResponse->addClear("kelas", "value");
		$objResponse->addClear("biaya_bhp", "value");
		$objResponse->addClear("biaya_jasa", "value");
		$objResponse->addClear("bhp_p", "value");
		$objResponse->addClear("bhp_rs", "value");
		$objResponse->addClear("bhp_rs_adm", "value");
		$objResponse->addClear("bhp_rs_op", "value");
		$objResponse->addClear("jasa_p", "value");
		$objResponse->addClear("jasa_rs", "value");
		$objResponse->addClear("jasa_rs_op", "value");
		$objResponse->addClear("jasa_rs_kembang", "value");
		$objResponse->addClear("jasa_rs_adm", "value");
		$objResponse->addClear("jasa_rs_sdm", "value");
		$objResponse->addClear("spesialis", "value");
		$objResponse->addClear("spesialis_pendamping", "value");
		$objResponse->addClear("ugp", "value");
		$objResponse->addClear("grabaf", "value");
		$objResponse->addClear("perawat", "value");
		$objResponse->addClear("penunjang", "value");
		$objResponse->addClear("zakat", "value");
		$objResponse->addClear("pajak", "value");
		$objResponse->addClear("netto", "value");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "BHP", "list_data"));
$_xajax->registerFunction(array("get_karcis", "BHP", "get_karcis"));
$_xajax->registerFunction(array("hapus_karcis", "BHP", "hapus_karcis"));
$_xajax->registerFunction(array("simpan_karcis", "BHP", "simpan_karcis"));
$_xajax->registerFunction(array("simpan_karcis_check", "BHP", "simpan_karcis_check"));
$_xajax->registerFunction(array("reset_karcis", "BHP", "reset_karcis"));


?>