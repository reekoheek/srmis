<?
$_TITLE = "Administrasi Data Kabupaten";
Class Kabupaten {

	function list_data($hal = 0, $prop_id = 0) {
		$_SESSION[setting_kabupaten][hal] = $hal;
		if($prop_id) $s = " AND p.id = '".$prop_id."'";
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->setOnclickValue($prop_id);
		$paging->sql = "
			SELECT 
				k.id AS id, 
				p.id AS prop_id,
				p.nama AS prop, 
				k.nama AS nama,
				COUNT(kec.id) as jml_kec
			FROM 
				ref_kabupaten k 
				JOIN ref_propinsi p ON (p.id = k.propinsi_id) 
				LEFT JOIN ref_kecamatan kec ON (kec.kabupaten_id = k.id)
			WHERE
				1=1
				$s
			GROUP BY k.id
			ORDER BY p.nama, k.nama
			
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 390;
		$tabel->addTh("No", "Propinsi", "Kabupaten", "Jml<br />Kecamatan", "Hapus");
		$tabel->addExtraTh(" style=\"width: 50px;\"", " style=\"width: 200px;\"", "", "style=\"width: 100px;\"", " style=\"width: 70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][prop_id] != $data[$i-1][prop_id]) $prop = $data[$i][prop];
			else $prop = "";
			$tabel->addRow(($no+$i), $prop, $data[$i][nama], $data[$i][jml_kec], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kabupaten('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd("xajax_get_kabupaten('".$data[$i][id]."')","xajax_get_kabupaten('".$data[$i][id]."')", "xajax_get_kabupaten('".$data[$i][id]."')", "xajax_get_kabupaten('".$data[$i][id]."')");
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_kabupaten($id) {
		$kon = new Konek;
		$kon->sql = "SELECT * FROM ref_kabupaten WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_kabupaten", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("propinsi_id", "value", $data[propinsi_id]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_kabupaten($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_kabupaten WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("show_prop", $_SESSION[setting_kabupaten][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_kabupaten($value) {
		$kon = new Konek;
		if(!$value['id_kabupaten'])
			$kon->sql = "INSERT INTO ref_kabupaten(propinsi_id, nama) VALUES ('".$value[propinsi_id]."', '".$value[nama]."')";
		else 
			$kon->sql = "UPDATE ref_kabupaten SET propinsi_id = '".$value[propinsi_id]."', nama = '".$value[nama]."' WHERE id = '".$value[id_kabupaten]."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_kabupaten");
		$objResponse->addScriptCall("show_prop", $_SESSION[setting_kabupaten][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_kabupaten_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		if(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Kabupaten.");
			$objResponse->addScriptCall("fokus");
		} elseif(!$new_value[propinsi_id]) {
			$objResponse->addAlert("Silakan Pilih Propinsi.");
			$objResponse->addScriptCall("fokus", "propinsi_id");
		} else {
			$objResponse->addScriptCall("xajax_simpan_kabupaten", $new_value);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function reset_kabupaten () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_kabupaten", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT * FROM ref_propinsi ORDER BY nama";
$kon->execute();
$_data_prop = $kon->getAll();

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Kabupaten", "list_data"));
$_xajax->registerFunction(array("get_kabupaten", "Kabupaten", "get_kabupaten"));
$_xajax->registerFunction(array("hapus_kabupaten", "Kabupaten", "hapus_kabupaten"));
$_xajax->registerFunction(array("simpan_kabupaten", "Kabupaten", "simpan_kabupaten"));
$_xajax->registerFunction(array("simpan_kabupaten_check", "Kabupaten", "simpan_kabupaten_check"));
$_xajax->registerFunction(array("reset_kabupaten", "Kabupaten", "reset_kabupaten"));


?>