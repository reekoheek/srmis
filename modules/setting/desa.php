<?
$_TITLE = "Administrasi Data Kelurahan";
Class Kelurahan {

	function list_data($hal = 0, $prop_id = "", $kab_id="", $kec_id="") {
		$_SESSION[setting_desa][hal] = $hal;

		if($prop_id) $s .= " AND p.id = '".$prop_id."'";
		if($kab_id) $s .= " AND k.id = '".$kab_id."'";
		if($kec_id) $s .= " AND kec.id = '".$kec_id."'";

		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->setOnclickValue($prop_id, $kab_id, $kec_id);
		$paging->sql = "
			SELECT 
				
				p.id AS prop_id,
				p.nama AS prop_nama, 
				k.id AS kab_id,
				k.nama AS kab_nama,
				kec.id AS kec_id, 
				kec.nama AS kec_nama,
				d.id as id,
				d.nama as nama
			FROM 
				ref_desa d 
				JOIN ref_kecamatan kec ON (kec.id = d.kecamatan_id)
				JOIN ref_kabupaten k ON (k.id = kec.kabupaten_id)
				JOIN ref_propinsi p ON (p.id = k.propinsi_id) 
			WHERE
				1=1
				$s
			GROUP BY d.id
			ORDER BY p.nama, k.nama, kec.nama, d.nama
			
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 360;
		$tabel->addTh("No", "Propinsi", "Kabupaten", "Kecamatan", "Kelurahan", "Hapus");
		$tabel->addExtraTh(" style=\"width: 50px;\"", " style=\"width: 200px;\"", "", "", "", " style=\"width: 70px;\" ");

		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][prop_id] != $data[$i-1][prop_id]) $prop = $data[$i][prop_nama];
			else $prop = "";
			if($data[$i][kab_id] != $data[$i-1][kab_id]) $kab = $data[$i][kab_nama];
			else $kab = "";
			if($data[$i][kec_id] != $data[$i-1][kec_id]) $kec = $data[$i][kec_nama];
			else $kec = "";
			$tabel->addRow(($no+$i), $prop, $kab, $kec, $data[$i][nama], "<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_desa('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_desa('".$data[$i][id]."')",
				"xajax_get_desa('".$data[$i][id]."')", 
				"xajax_get_desa('".$data[$i][id]."')", 
				"xajax_get_desa('".$data[$i][id]."')", 
				"xajax_get_desa('".$data[$i][id]."')");
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_desa($id) {
		$kon = new Konek;
		$kon->sql = "
		SELECT 
			p.id AS prop_id,
			k.id AS kab_id,
			kec.id AS kec_id, 
			d.id as id,
			d.nama as nama
		FROM 
			ref_desa d 
			JOIN ref_kecamatan kec ON (kec.id = d.kecamatan_id)
			JOIN ref_kabupaten k ON (k.id = kec.kabupaten_id)
			JOIN ref_propinsi p ON (p.id = k.propinsi_id) 
		WHERE 
			d.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_desa", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("propinsi_id", "value", $data[prop_id]);
		$objResponse->addScriptCall("xajax_get_kabupaten", $data[prop_id], $data[kab_id]);
		$objResponse->addScriptCall("xajax_get_kecamatan", $data[kab_id], $data[kec_id]);
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

	function get_kecamatan($id_kabupaten, $id_sel = NULL) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				id, 
				nama
			FROM 
				ref_kecamatan
			WHERE
				kabupaten_id = '".$id_kabupaten."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("kecamatan_id", "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('kecamatan_id','kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
			} else {
				$objResponse->addScript("addOption('kecamatan_id','kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}

		}
		//$objResponse->addScript("addOption('kecamatan_id','add_kecamatan','--- TAMBAH KECAMATAN ---','add_kecamatan');");
		return $objResponse;
	}

	function hapus_desa($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM ref_desa WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("show_this_only", $_SESSION[setting_desa][hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_desa($value) {
		$kon = new Konek;
		if(!$value['id_desa']) {
			$sql = "INSERT INTO ref_desa(kecamatan_id, nama) VALUES ('".$value[kecamatan_id]."', '".$value[nama]."')";
			$kon->sql = $sql;
		} else {
			$sql = "UPDATE ref_desa SET kecamatan_id = '".$value[kecamatan_id]."', nama = '".$value[nama]."' WHERE id = '".$value[id_desa]."'";
			$kon->sql = $sql;
		}
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_desa");
		$objResponse->addScriptCall("show_this_only", $_SESSION[setting_desa][hal]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_desa_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		if(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Kelurahan.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$new_value[propinsi_id]) {
			$objResponse->addAlert("Silakan Pilih Propinsi.");
			$objResponse->addScriptCall("fokus", "propinsi_id");
		} elseif(!$new_value[kabupaten_id]) {
			$objResponse->addAlert("Silakan Pilih Kabupaten.");
			$objResponse->addScriptCall("fokus", "kabupaten_id");
		} elseif(!$new_value[kecamatan_id]) {
			$objResponse->addAlert("Silakan Pilih Kecamatan.");
			$objResponse->addScriptCall("fokus", "kecamatan_id");
		} else {
			$objResponse->addScriptCall("xajax_simpan_desa", $new_value);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function reset_desa () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_desa", "value");
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
$_xajax->registerFunction(array("list_data", "Kelurahan", "list_data"));
$_xajax->registerFunction(array("get_desa", "Kelurahan", "get_desa"));
$_xajax->registerFunction(array("get_kabupaten", "Kelurahan", "get_kabupaten"));
$_xajax->registerFunction(array("get_kecamatan", "Kelurahan", "get_kecamatan"));
$_xajax->registerFunction(array("hapus_desa", "Kelurahan", "hapus_desa"));
$_xajax->registerFunction(array("simpan_desa", "Kelurahan", "simpan_desa"));
$_xajax->registerFunction(array("simpan_desa_check", "Kelurahan", "simpan_desa_check"));
$_xajax->registerFunction(array("reset_desa", "Kelurahan", "reset_desa"));


?>