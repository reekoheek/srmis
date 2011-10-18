<?

/**
 * @author yudasy
 * @copyright 2011
 */

$_TITLE = "Administrasi Data No Bed Rawat Inap";
Class no_kamar {

	function list_kamar($hal = 0) {
		$paging = new MyPagina;
	    
        $paging->sql = "select p.nama as bangsal,
                               k.id as kamar_id,
                               k.nama as nama_kamar, 
                               rk.nomor as no_kamar,
                               rk.status as status 
                               from kamar k, ref_kamar rk,
                               pelayanan p 
                               where k.id = rk.kamar_id and k.pelayanan_id = p.id
                               and p.jenis = 'RAWAT INAP'
                               order by p.nama, k.kelas, k.nama";
            
		
		
		$paging->rows_on_page = 15;
		$paging->hal = $hal;
		$_SESSION[modul_setting][no_kamar][hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 350;
		$table->addTh(
			"No", 
			"Nama Bangsal", 
			"Nama Kamar", 
			"No Bed",
            "Status",
			"Hapus"
		);
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:200px;\"","","","","","","style=\"width:70px;\"");
		$kon = new Konek;
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][bangsal], 
				$data[$i][nama_kamar],
				$data[$i][no_kamar],
                $data[$i][status], 
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
		$objResponse->addAssign("list_kamar", "innerHTML", $buka);
		return $objResponse;
	}

	function get_kamar($id) {
		$kon = new Konek;
        $kon->sql = "    
              select p.nama as bangsal,
                               k.id as kamar_id,
                               k.nama as nama_kamar, 
                               rk.nomor as no_kamar, k.pelayanan_id as pelayanan_id 
                               from kamar k, ref_kamar rk,
                               pelayanan p 
                               where k.id = rk.kamar_id and k.pelayanan_id = p.id
                               and p.jenis = 'RAWAT INAP'
                               order by p.nama, k.kelas, k.nama 
                               and k.id = '".$id."'";  
                
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_kamar", "value", $data[kamar_id]);
		$objResponse->addAssign("pelayanan_id", "value", $data[pelayanan_id]);
		$objResponse->addAssign("kamar_id", "value", $data[kamar_id]);
		$objResponse->addAssign("no_kamar", "value", $data[no_kamar]);
        $objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}

	function hapus_kamar($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM kamar WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_kamar", $_SESSION[modul_setting][kamar][hal]);
			//panggil sidebar bangsal
			$objResponse->addScriptCall("xajax_info_get_kamar_kosong");
			$objResponse->addScriptCall("fokus", "jenis");
		}
		return $objResponse;
	}

	function simpan_kamar($value) {
		$kon = new Konek;
		if(!$value['id_kamar'])
			$sql = "INSERT INTO ref_kamar(kamar_id, nomor) VALUES ('".$value[kamar_id]."', '".$value[no_kamar]."')";
		else 
			$sql = "UPDATE ref_kamar SET kamar_id = '".$value[kamr_id]."', nomor = '".$value[no_kamar]."' WHERE id = '".$value[id_kamar]."'";
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_kamar", $_SESSION[modul_setting][kamar][hal]);
		//panggil sidebar bangsal
		$objResponse->addScriptCall("xajax_info_get_kamar_kosong");
		$objResponse->addScriptCall("xajax_reset_kamar");
		return $objResponse;
	}

	function simpan_kamar_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		//$objResponse->addAlert(print_r($value));
		if(!$new_value[pelayanan_id]) {
			$objResponse->addAlert("Silakan Isi Bangsal.");
			$objResponse->addScriptCall("fokus", "pelayanan_id");
		} elseif(!$new_value[kamar_id]) {
			$objResponse->addAlert("Silakan Isi Nama Kamar.");
			$objResponse->addScriptCall("fokus", "kamar_id");
		} elseif(!$new_value[no_kamar]) {
			$objResponse->addAlert("Silakan Isi no kamar.");
			$objResponse->addScriptCall("fokus", "no_kamar");
		} else {
			$objResponse->addScriptCall("xajax_simpan_kamar", $new_value);
		}
		return $objResponse;
	}

	function reset_kamar () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_kamar", "value");
		$objResponse->addClear("kamar_id", "value");
		$objResponse->addClear("pelayanan_id", "value");
		$objResponse->addClear("no_kamar", "value");	
		$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT * FROM pelayanan WHERE jenis = 'RAWAT INAP' ORDER BY nama";
$kon->execute();
$_data_pel = $kon->getAll();

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_kamar", "no_kamar", "list_kamar"));
$_xajax->registerFunction(array("get_kamar", "no_kamar", "get_kamar"));
$_xajax->registerFunction(array("hapus_kamar", "no_kamar", "hapus_kamar"));
$_xajax->registerFunction(array("simpan_kamar", "no_kamar", "simpan_kamar"));
$_xajax->registerFunction(array("simpan_kamar_check", "no_kamar", "simpan_kamar_check"));
$_xajax->registerFunction(array("reset_kamar", "no_kamar", "reset_kamar"));

//include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR.  "ref_kamar.php";

?>