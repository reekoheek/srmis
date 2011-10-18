<?
$_TITLE = "Administrasi Data Kecamatan";
Class Kecamatan {

	function list_data($hal = 0, $prop_id = "", $kab_id = "") {
		$_SESSION[setting_kecamatan][hal] = $hal;
		//$all_id = @explode("|", $prop_kab_id);
		if($prop_id) $s .= " AND p.id = '".$prop_id."'";
		if($kab_id) $s .= " AND k.id = '".$kab_id."'";

		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->setOnclickValue($prop_id, $kab_id);
		//$paging->onclick2_value = "'" . $prop_kab_id . "'";
		$paging->sql = "
			SELECT 
				kec.id AS id, 
				p.id AS prop_id,
				p.nama AS prop, 
				k.id AS kab_id,
				k.nama AS kab,
				kec.nama AS nama,
				COUNT(d.id) as jml_desa
			FROM 
				ref_kecamatan kec 
				JOIN ref_kabupaten k ON (k.id = kec.kabupaten_id)
				JOIN ref_propinsi p ON (p.id = k.propinsi_id) 
				LEFT JOIN ref_desa d ON (d.kecamatan_id = kec.id)
			WHERE
				1=1
				$s
			GROUP BY kec.id
			ORDER BY p.nama, k.nama, kec.nama
			
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 370;
		$tabel->addTh("No", "Propinsi", "Kabupaten", "Kecamatan", "Jml<br />Kelurahan", "Hapus");
		$tabel->addExtraTh(" style=\"width: 50px;\"", " style=\"width: 200px;\"", "", "", "style=\"width: 100px;\"", " style=\"width: 70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][prop_id] != $data[$i-1][prop_id]) $prop = $data[$i][prop];
			else $prop = "";
			if($data[$i][kab_id] != $data[$i-1][kab_id]) $kab = $data[$i][kab];
			else $kab = "";
			$tabel->addRow(($no+$i), $prop, $kab, $data[$i][nama], $data[$i][jml_desa], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kecamatan('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd("xajax_get_kecamatan('".$data[$i][id]."')","xajax_get_kecamatan('".$data[$i][id]."')", "xajax_get_kecamatan('".$data[$i][id]."')", "xajax_get_kecamatan('".$data[$i][id]."')");
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_kecamatan($id) {
		$kon = new Konek;
		$kon->sql = "
		SELECT 
			kec.id as id,
			kec.nama as nama,
			k.id as kab_id,
			k.propinsi_id as prop_id
		FROM 
			ref_kecamatan kec
			JOIN ref_kabupaten k ON (k.id = kec.kabupaten_id)
		WHERE 
			kec.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_kecamatan", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("propinsi_id", "value", $data[prop_id]);
		$objResponse->addScriptCall("xajax_get_kabupaten", $data[prop_id], $data[kab_id]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function get_kabupaten($id_propinsi, $id_sel = NULL) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				id, 
				nama
			FROM 
				ref_kabupaten
			WHERE
				propinsi_id = '".$id_propinsi."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("kabupaten_id", "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('kabupaten_id','kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
			} else {
				$objResponse->addScript("addOption('kabupaten_id','kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		//$objResponse->addScript("addOption('kabupaten_id','add_kabupaten','--- TAMBAH KABUPATEN ---','add_kabupaten');");
		return $objResponse;
	}

	function hapus_kecamatan($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_kecamatan WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("show_this_only", $_SESSION[setting_kecamatan][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_kecamatan($value) {
		$kon = new Konek;
		if(!$value['id_kecamatan']) {
			$sql = "INSERT INTO ref_kecamatan(kabupaten_id, nama) VALUES ('".$value[kabupaten_id]."', '".$value[nama]."')";
			$kon->sql = $sql;
		} else {
			$sql = "UPDATE ref_kecamatan SET kabupaten_id = '".$value[kabupaten_id]."', nama = '".$value[nama]."' WHERE id = '".$value[id_kecamatan]."'";
			$kon->sql = $sql;
		}
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_kecamatan");
		$objResponse->addScriptCall("show_this_only", $_SESSION[setting_kecamatan][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_kecamatan_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		if(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Kecamatan.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$new_value[propinsi_id]) {
			$objResponse->addAlert("Silakan Pilih Propinsi.");
			$objResponse->addScriptCall("fokus", "propinsi_id");
		} elseif(!$new_value[kabupaten_id]) {
			$objResponse->addAlert("Silakan Pilih Kabupaten.");
			$objResponse->addScriptCall("fokus", "kabupaten_id");
		} else {
			$objResponse->addScriptCall("xajax_simpan_kecamatan", $new_value);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function reset_kecamatan () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_kecamatan", "value");
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
$_xajax->registerFunction(array("list_data", "Kecamatan", "list_data"));
$_xajax->registerFunction(array("get_kecamatan", "Kecamatan", "get_kecamatan"));
$_xajax->registerFunction(array("get_kabupaten", "Kecamatan", "get_kabupaten"));
$_xajax->registerFunction(array("hapus_kecamatan", "Kecamatan", "hapus_kecamatan"));
$_xajax->registerFunction(array("simpan_kecamatan", "Kecamatan", "simpan_kecamatan"));
$_xajax->registerFunction(array("simpan_kecamatan_check", "Kecamatan", "simpan_kecamatan_check"));
$_xajax->registerFunction(array("reset_kecamatan", "Kecamatan", "reset_kecamatan"));


?>