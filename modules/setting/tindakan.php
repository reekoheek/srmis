<?
$_TITLE = "Administrasi Data Tindakan";
Class Tindakan {

	function list_data($hal = 0) {
		$_SESSION[hal] = $hal;
		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT 
				i.id as icid, 
				i.kode as kode, 
				i.nama as nama, 
				id.id as idid,
				id.*
		FROM 
			icopim i 
			LEFT JOIN icopim_detil id ON (id.tingkat = i.tingkat) 
		GROUP BY i.id, id.kelas
		ORDER BY i.nama, id.kelas
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 400;
		$tabel->addTh(
			"No", 
			"Kode", 
			"Tindakan", 
			"Tingkat", 
			"Kelas", 
			"Biaya",		
			"Hapus"
		);

		for($i=0;$i<sizeof($data);$i++) {
			$tabel->addRow(
				($no+$i), 
				$data[$i][kode], 
				$data[$i][nama], 
				$data[$i][tingkat], 
				$data[$i][kelas], 
				$data[$i][biaya],			 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_tindakan('".$data[$i][icid]."', '".$data[$i][idid]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')"				
			);
		}

		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_tindakan($id, $tingkat, $kelas) {
		$kon = new Konek;
		if($tingkat) $q .= " AND i.tingkat = '".$tingkat."' ";
		if($kelas) $q .= " AND id.kelas = '".$kelas."' ";
		$sql = "SELECT 
				i.id as icid, 
				id.id as idid,
				i.kode as kode, 
				i.nama as nama, 
				id.*,
                i.jenis_tindakan as jenis_tindakan
		FROM 
			icopim i 
			LEFT JOIN icopim_detil id ON (id.tingkat = i.tingkat) 
		WHERE i.id = '".$id."' $q ";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
        $objResponse->addAssign("tindakan_id", "value", $data[jenis_tindakan]);
		$objResponse->addAssign("id_icopim", "value", $data[icid]);
		$objResponse->addAssign("id_icopim_detil", "value", $data[idid]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("kode", "value", $data[kode]);
		$objResponse->addAssign("tingkat", "value", $data[tingkat]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		$objResponse->addAssign("biaya", "value", $data[biaya]);		
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_tindakan($icid, $idid) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM icopim_detil WHERE id = '".$idid."'";
		$kon->execute();

		$kon->sql = "DELETE FROM icopim WHERE id = '".$icid."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_tindakan($value) {
		$kon = new Konek;
        $objResponse = new xajaxResponse();
		if(!$value['id_icopim']) {
			$sql_ic = "
			INSERT INTO 
				icopim(
                jenis_tindakan,
				kode, 
				nama,
				tingkat
			) VALUES (
                '".$value[tindakan_id]."',
				'".$value[kode]."', 
				'".$value[nama]."',
				UPPER('".$value[tingkat]."')
			)";	
			$kon->sql = $sql_ic;
             $kon->execute();
			$id_icopim = $kon->last_id;
		} else {
			$sql_ic = "UPDATE icopim SET kode = '".$value[kode]."', nama = '".$value[nama]."', tingkat = UPPER('".$value[tingkat]."'), jenis_tindakan ='".$value[tindakan_id]."' WHERE id = '".$value[id_icopim]."'";	
			$kon->sql = $sql_ic;
            $kon->execute();
			$id_icopim = $value[id_icopim];
            //$objResponse->addAlert($sql_ic);
		}

		if(!$value[id_icopim_detil]) {
			$sql_id = "
			INSERT INTO 
				icopim_detil(
				icopim_id,
				tingkat,
				kelas,
				biaya				
			) VALUES (
				'".$id_icopim."', 
				UPPER('".$value[tingkat]."'),
				'".$value[kelas]."',
				'".$value[biaya]."')";
		} else {
			$sql_id = "
				UPDATE icopim_detil SET	icopim_id = '".$id_icopim."', tingkat = UPPER('".$value[tingkat]."'), kelas ='".$value[kelas]."', biaya ='".$value[biaya]."' WHERE id = '".$value[id_icopim_detil]."'";
		}
		$kon->sql = $sql_id;
		$kon->execute();
		
		//$objResponse->addAssign("debug", "innerHTML", $sql_ic);
		//$objResponse->addAppend("debug", "innerHTML", $sql_id);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
		$objResponse->addScriptCall("xajax_reset_tindakan");
		return $objResponse;
	}

	function simpan_tindakan_check($value) {
		$objResponse = new xajaxResponse();
		$value[kode] = addslashes(trim($value[kode]));
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Tindakan.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$value[tingkat]) {
			$objResponse->addAlert("Silakan Isi Nama Tingkat.");
			$objResponse->addScriptCall("fokus", "tingkat");
		} else {
			$objResponse->addScriptCall("xajax_simpan_tindakan", $value);
		}
		return $objResponse;
	}

	function reset_tindakan () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_tindakan", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("kode", "value");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Tindakan", "list_data"));
$_xajax->registerFunction(array("get_tindakan", "Tindakan", "get_tindakan"));
$_xajax->registerFunction(array("hapus_tindakan", "Tindakan", "hapus_tindakan"));
$_xajax->registerFunction(array("simpan_tindakan", "Tindakan", "simpan_tindakan"));
$_xajax->registerFunction(array("simpan_tindakan_check", "Tindakan", "simpan_tindakan_check"));
$_xajax->registerFunction(array("reset_tindakan", "Tindakan", "reset_tindakan"));


?>