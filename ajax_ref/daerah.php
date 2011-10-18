<?
Class Ref_Daerah {
	function get_kabupaten($inputId, $id_propinsi, $id_sel = NULL, $add_kabupaten = false) {
		$kon = new Konek;
		$kon->sql = "CALL get_kabupaten('".$id_propinsi."')";
		//$kon->sql = "SELECT id,nama FROM ref_kabupaten WHERE propinsi_id = '".$id_propinsi."' ORDER BY nama";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "_kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
			} else {
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		if($add_kabupaten == true)
			$objResponse->addScript("addOption('".$inputId."','add_kabupaten','--- TAMBAH KABUPATEN ---','add_kabupaten');");
		return $objResponse;
	}

	function get_kecamatan($inputId, $id_kabupaten, $id_sel = NULL, $add_kecamatan = false) {
		$kon = new Konek;
		$kon->sql = "CALL get_kecamatan('".$id_kabupaten."')";
		//$kon->sql = "SELECT id,nama FROM ref_kecamatan WHERE kabupaten_id='".$id_kabupaten."' ORDER BY nama";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "_kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
			} else {
				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "_kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		if($add_kecamatan == true)
			$objResponse->addScript("addOption('".$inputId."','add_kecamatan','--- TAMBAH KECAMATAN ---','add_kecamatan');");
		return $objResponse;
	}

	function get_desa($inputId, $id_kecamatan, $id_sel = NULL, $add_desa = false) {
		$kon = new Konek;
		$kon->sql = "CALL get_desa('".$id_kecamatan."')";
		//$kon->sql = "SELECT id,nama FROM ref_desa WHERE kecamatan_id = '".$id_kecamatan."' ORDER BY nama";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "_desa_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
			} else {
				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "_desa_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		if($add_desa == true)
		$objResponse->addScript("addOption('".$inputId."','add_desa','--- TAMBAH KELURAHAN ---','add_desa');");
		return $objResponse;
	}

	function add_kabupaten_check($id_propinsi, $nama) {
		$objResponse = new xajaxResponse();
		$nama = addslashes(strtoupper($nama));
		if(!$id_propinsi) {
			$objResponse->addAlert("Silakan Pilih Propinsi.");
			$objResponse->addScriptCall("fokus", "propinsi_id");
		} else {
			$kon = new Konek;
			$kon->sql = "
				SELECT 
					kab.id as id, 
					kab.nama as nama_kab_lama,
					prop.nama as nama_prop
				FROM 
					ref_kabupaten kab
					JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				WHERE 
					TRIM(LOWER(kab.nama)) = TRIM(LOWER('".$nama."')) 
					AND prop.id = '".$id_propinsi."'";
			$kon->execute();
			$data = $kon->getOne();
			if($data[id]) {
				$objResponse->addConfirmCommands(2, "Nama kabupaten\n " . $nama . "\n mirip dengan kabupaten\n" . $data[nama_kab_lama] . "\n di Propinsi " . $data[nama_prop] . "\nKlik Ok untuk menambah kabupaten baru\n Klik Cancel untuk menggunakan kabupaten yang telah ada");
				$objResponse->addScriptCall("xajax_add_kabupaten", $id_propinsi, $nama);
				$objResponse->addScriptCall("fokus", "kecamatan_id");
				$objResponse->addAssign("kabupaten_id", "value", $data[id]);
				$objResponse->addScriptCall("fokus", "kecamatan_id");
			} else {
				$objResponse->addScriptCall("xajax_add_kabupaten", $id_propinsi, $nama);
				$objResponse->addScriptCall("fokus", "kecamatan_id");		
			}
		}
		return $objResponse;
	}

	function add_kabupaten($id_propinsi, $nama) {
		$kon = new Konek;
		$kon->sql = "
			INSERT INTO ref_kabupaten(
				propinsi_id, 
				nama
			)
			VALUES(
				'".$id_propinsi."',
				'".$nama."'
			)
			";
		$kon->execute();
		$last_id = $kon->last_id;
		$objResponse = new xajaxResponse();
		$objResponse->addScript("addOption('kabupaten_id','kabupaten_".$last_id."','".$nama."','".$last_id."', false, true);");
		return $objResponse;
	}

	function add_kecamatan_check($id_kabupaten, $nama) {
		$nama = addslashes(strtoupper($nama));
		$objResponse = new xajaxResponse();
		if(!$id_kabupaten) {
			$objResponse->addAlert("Silakan Pilih Kabupaten.");
			$objResponse->addScriptCall("fokus", "kabupaten_id");
		} else {
			$kon = new Konek;
			$kon->sql = "
				SELECT 
					kec.id as id, 
					kec.nama as nama_kec_lama,
					kab.nama as nama_kab
				FROM 
					ref_kecamatan kec
					JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				WHERE 
					TRIM(LOWER(kec.nama)) = TRIM(LOWER('".$nama."')) 
					AND kab.id = '".$id_kabupaten."'";
			$kon->execute();
			$data = $kon->getOne();
			if($data[id]) {
				$objResponse->addConfirmCommands(2, "Nama kecamatan\n " . $nama . "\n mirip dengan kecamatan\n" . $data[nama_kec_lama] . "\n di " . $data[nama_kab] . "\nKlik Ok untuk menambah kecamatan baru\n Klik Cancel untuk menggunakan kecamatan yang telah ada");
				$objResponse->addScriptCall("xajax_add_kecamatan", $id_kabupaten, $nama);
				$objResponse->addScriptCall("fokus", "desa_id");
				$objResponse->addAssign("kecamatan_id", "value", $data[id]);
				$objResponse->addScriptCall("fokus", "desa_id");
			} else {
				$objResponse->addScriptCall("xajax_add_kecamatan", $id_kabupaten, $nama);
				$objResponse->addScriptCall("fokus", "desa_id");		
			}
		}
		return $objResponse;
	}

	function add_kecamatan($id_kabupaten, $nama) {
		$kon = new Konek;
		$kon->sql = "
			INSERT INTO ref_kecamatan(
				kabupaten_id, 
				nama
			)
			VALUES(
				'".$id_kabupaten."',
				'".$nama."'
			)
			";
		$kon->execute();
		$last_id = $kon->last_id;
		$objResponse = new xajaxResponse();
		$objResponse->addScript("addOption('kecamatan_id','kecamatan_".$last_id."','".$nama."','".$last_id."', false, true);");
		return $objResponse;
	}

	function add_desa_check($id_kecamatan, $nama) {
		$nama = addslashes(strtoupper($nama));
		$objResponse = new xajaxResponse();
		if(!$id_kecamatan) {
			$objResponse->addAlert("Silakan Pilih Kecamatan.");
			$objResponse->addScriptCall("fokus", "kecamatan_id");
		} else {
			$kon = new Konek;
			$kon->sql = "
				SELECT 
					des.id as id, 
					des.nama as nama_desa_lama,
					kec.nama as nama_kec
				FROM 
					ref_desa des
					JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				WHERE 
					TRIM(LOWER(des.nama)) = TRIM(LOWER('".$nama."')) 
					AND kec.id = '".$id_kecamatan."'";
			$kon->execute();
			$data = $kon->getOne();
			if($data[id]) {
				$objResponse->addConfirmCommands(2, "Nama kelurahan\n " . $nama . "\n mirip dengan kelurahan\n" . $data[nama_desa_lama] . "\n di " . $data[nama_kec] . "\nKlik Ok untuk menambah kelurahan baru\n Klik Cancel untuk menggunakan kelurahan yang telah ada");
				$objResponse->addScriptCall("xajax_add_desa", $id_kecamatan, $nama);
				$objResponse->addScriptCall("fokus", "desa_id");
				$objResponse->addAssign("desa_id", "value", $data[id]);
				$objResponse->addScriptCall("fokus", "desa_id");
			} else {
				$objResponse->addScriptCall("xajax_add_desa", $id_kecamatan, $nama);
				$objResponse->addScriptCall("fokus", "desa_id");		
			}
		}
		return $objResponse;
	}

	function add_desa($id_kecamatan, $nama) {
		$kon = new Konek;
		$kon->sql = "
			INSERT INTO ref_desa(
				kecamatan_id, 
				nama
			)
			VALUES(
				'".$id_kecamatan."',
				'".$nama."'
			)
			";
		$kon->execute();
		$last_id = $kon->last_id;
		$objResponse = new xajaxResponse();
		$objResponse->addScript("addOption('desa_id','desa_".$last_id."','".$nama."','".$last_id."', false, true);");
		return $objResponse;
	}
}
$_xajax->registerFunction(array("ref_get_kabupaten", "Ref_Daerah", "get_kabupaten"));
$_xajax->registerFunction(array("ref_get_kecamatan", "Ref_Daerah", "get_kecamatan"));
$_xajax->registerFunction(array("ref_get_desa", "Ref_Daerah", "get_desa"));
$_xajax->registerFunction(array("add_kabupaten_check", "Ref_Daerah", "add_kabupaten_check"));
$_xajax->registerFunction(array("add_kabupaten", "Ref_Daerah", "add_kabupaten"));
$_xajax->registerFunction(array("add_kecamatan_check", "Ref_Daerah", "add_kecamatan_check"));
$_xajax->registerFunction(array("add_kecamatan", "Ref_Daerah", "add_kecamatan"));
$_xajax->registerFunction(array("add_desa_check", "Ref_Daerah", "add_desa_check"));
$_xajax->registerFunction(array("add_desa", "Ref_Daerah", "add_desa"));

?>