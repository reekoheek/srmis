<?
$_TITLE = "Administrasi Data Penyakit";
Class Penyakit {

	function list_data($hal = 0, $val) {
		if(!empty($val)) {
			$val[cari_nama] = addslashes($val[cari_nama]);
			$q = " AND (kode_icd_group LIKE '%".$val[cari_nama]."%' OR kode_icd LIKE '%".$val[cari_nama]."%' OR no_dtd LIKE '%".$val[cari_nama]."%' OR nama LIKE '%".$val[cari_nama]."%' OR gol_sebab_sakit LIKE '%".$val[cari_nama]."%')";
		}
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->setOnclickValue("xajax.getFormValues('form_icd')");

		$paging->sql = "
			SELECT 
				id,
				REPLACE(kode_icd_group, '".$val[cari_nama]."','<b>".$val[cari_nama]."</b>') as kode_icd_group,
				REPLACE(kode_icd, '".$val[cari_nama]."','<b>".$val[cari_nama]."</b>') as kode_icd,
				REPLACE(no_dtd, '".$val[cari_nama]."','<b>".$val[cari_nama]."</b>') as no_dtd,
				REPLACE(nama, '".$val[cari_nama]."','<b>".$val[cari_nama]."</b>') as nama,
				REPLACE(gol_sebab_sakit, '".$val[cari_nama]."','<b>".$val[cari_nama]."</b>') as gol_sebab_sakit
			FROM 
				icd 
			WHERE 
				1=1 
				$q
			ORDER BY
				kode_icd
		";
		$paging->rows_on_page = 20;
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();
		$_SESSION[modul_setting][penyakit][hal] = $hal;

		$tabel = new Table;
		$tabel->tbody_height = 300;
		$tabel->addTh("No", "Kode ICD Group", "Kode ICD", "No. DTD", "Nama Penyakit", "Gol. Sebab Sakit", "Hapus");
		$tabel->addExtraTh(" style=\"width: 50px;\"", " style=\"width: 50px;\"", " style=\"width: 70px;\" ", " style=\"width: 70px;\" ", "", "", " style=\"width: 70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			$tabel->addExtraTr("id=\"tr_".$i."\"");
			$tabel->addRow(
				($no+$i), 
				$data[$i][kode_icd_group], 
				$data[$i][kode_icd], 
				$data[$i][no_dtd], 
				$data[$i][nama], 
				$data[$i][gol_sebab_sakit], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_icd('".$data[$i][id]."', 'tr_".$i."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_icd('".$data[$i][id]."')", 
				"xajax_get_icd('".$data[$i][id]."')", 
				"xajax_get_icd('".$data[$i][id]."')", 
				"xajax_get_icd('".$data[$i][id]."')", 
				"xajax_get_icd('".$data[$i][id]."')", 
				"xajax_get_icd('".$data[$i][id]."')"
			);
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_icd($id) {
		$kon = new Konek;
		$kon->sql = "SELECT * FROM icd WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_icd", "value", $data[id]);
		$objResponse->addAssign("kode_icd_group", "value", $data[kode_icd_group]);
		$objResponse->addAssign("kode_icd", "value", $data[kode_icd]);
		$objResponse->addAssign("no_dtd", "value", $data[no_dtd]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("gol_sebab_sakit", "value", $data[gol_sebab_sakit]);
		$objResponse->addScriptCall("fokus", "kode_icd_group");
		return $objResponse;
	}

	function hapus_icd($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM icd WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("list_data", $_SESSION[modul_setting][penyakit][hal]);
			$objResponse->addScriptCall("fokus", "kode_icd_group");
		}
		return $objResponse;
	}

	function simpan_icd($value) {
		$kon = new Konek;
		if(!$value['id_icd'])
			$kon->sql = "INSERT INTO icd(kode_icd_group, kode_icd, no_dtd, nama, gol_sebab_sakit) VALUES ('".$value[kode_icd_group]."','".$value[kode_icd]."','".$value[no_dtd]."','".$value[nama]."','".$value[gol_sebab_sakit]."')";
		else 
			$kon->sql = "UPDATE icd SET kode_icd_group = '".$value[kode_icd_group]."', kode_icd = '".$value[kode_icd]."', no_dtd = '".$value[no_dtd]."', nama = '".$value[nama]."', gol_sebab_sakit = '".$value[gol_sebab_sakit]."' WHERE id = '".$value[id_icd]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_icd");
		$objResponse->addScriptCall("list_data", $_SESSION[modul_setting][penyakit][hal]);
		$objResponse->addScriptCall("fokus", "kode_icd_group");
		return $objResponse;
	}

	function simpan_icd_check($value) {
		$objResponse = new xajaxResponse();
		$clean = new FormCleaner;
		$clean->setValue($value);
		$clean->clean();
		$val = $clean->getValue();
		if(!$val[kode_icd_group]) {
			$objResponse->addAlert("Silakan Isi Kode ICD Group.");
			$objResponse->addScriptCall("fokus", "kode_icd_group");
		} elseif(!$val[kode_icd]) {
			$objResponse->addAlert("Silakan Isi Kode ICD.");
			$objResponse->addScriptCall("fokus", "kode_icd");
		} elseif(!$val[no_dtd]) {
			$objResponse->addAlert("Silakan Isi No. DTD.");
			$objResponse->addScriptCall("fokus", "no_dtd");
		} elseif(!$val[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Penyakit.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$val[gol_sebab_sakit]) {
			$objResponse->addAlert("Silakan Isi Golongan Sebab Sakit.");
			$objResponse->addScriptCall("fokus", "gol_sebab_sakit");
		} else {
			$objResponse->addScriptCall("xajax_simpan_icd", $val);
		}
		return $objResponse;
	}

	function reset_icd () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_icd", "value");
		$objResponse->addClear("kode_icd_group", "value");
		$objResponse->addClear("kode_icd", "value");
		$objResponse->addClear("no_dtd", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("gol_sebab_sakit", "value");
		$objResponse->addScriptCall("fokus", "kode_icd_group");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Penyakit", "list_data"));
$_xajax->registerFunction(array("get_icd", "Penyakit", "get_icd"));
$_xajax->registerFunction(array("hapus_icd", "Penyakit", "hapus_icd"));
$_xajax->registerFunction(array("simpan_icd", "Penyakit", "simpan_icd"));
$_xajax->registerFunction(array("simpan_icd_check", "Penyakit", "simpan_icd_check"));
$_xajax->registerFunction(array("reset_icd", "Penyakit", "reset_icd"));


?>