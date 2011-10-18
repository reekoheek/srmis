<?
$_TITLE = "Administrasi Data Kamar Rawat Inap";
Class Kamar {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->sql = "
			SELECT 
				k.id as id, 
				pel.id as pelid,
				pel.nama as pel,
				k.nama as nama,
				k.jml_bed as jml_bed,
				k.kelas as kelas
			FROM 
				pelayanan pel
				JOIN kamar k ON (k.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
			ORDER BY pel.nama, k.kelas, k.nama";
		$paging->rows_on_page = 15;
		$paging->hal = $hal;
		$_SESSION[modul_setting][kamar][hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 350;
		$table->addTh(
			"No", 
			"Nama Bangsal", 
			"Kamar", 
			"Kelas",
			"Jml<br />TT", 
			"Hapus"
		);
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:200px;\"","","","","style=\"width:70px;\"");
		$kon = new Konek;
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][pelid] == $data[$i-1][pelid])
				$pel = "";
			else {
				$kon->sql = "SELECT SUM(jml_bed) as jml FROM kamar WHERE pelayanan_id = '".$data[$i][pelid]."'";
				$kon->execute();
				$tt = $kon->getOne();
				$pel = "<b>" . $data[$i][pel] . "</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;[" . $tt[jml] . " tt]";
			}
			$table->addRow(
				($no+$i), 
				$pel, 
				$data[$i][nama],
				$data[$i][kelas], 
				$data[$i][jml_bed], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kamar('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>"
			);
			$table->addOnclickTd(
				"xajax_get_kamar('".$data[$i][id]."')", 
				"xajax_get_kamar('".$data[$i][id]."')", 
				"xajax_get_kamar('".$data[$i][id]."')", 
				"xajax_get_kamar('".$data[$i][id]."')", 
				"xajax_get_kamar('".$data[$i][id]."')"
			);
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_kamar($id) {
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				k.id as id, 
				k.nama as nama, 
				k.kelas as kelas, 
				k.jml_bed as jml_bed,
				p.id as pelayanan_id
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
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[modul_setting][kamar][hal]);
			//panggil sidebar bangsal
			$objResponse->addScriptCall("xajax_info_get_kamar_kosong");
			$objResponse->addScriptCall("fokus", "jenis");
		}
		return $objResponse;
	}

	function simpan_kamar($value) {
		$kon = new Konek;
		if(!$value['id_kamar'])
			$sql = "INSERT INTO kamar(pelayanan_id, kelas, nama, jml_bed) VALUES ('".$value[pelayanan_id]."', '".$value[kelas]."', '".$value[nama]."', NULLIF('".$value[jml_bed]."', ''))";
		else 
			$sql = "UPDATE kamar SET pelayanan_id = '".$value[pelayanan_id]."', kelas = '".$value[kelas]."', nama = '".$value[nama]."', jml_bed = NULLIF('".$value[jml_bed]."', '') WHERE id = '".$value[id_kamar]."'";
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[modul_setting][kamar][hal]);
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
		} elseif(!$new_value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama Kamar.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$new_value[kelas]) {
			$objResponse->addAlert("Silakan Isi Kelas.");
			$objResponse->addScriptCall("fokus", "kelas");
		} elseif(!$new_value[jml_bed]) {
			$objResponse->addAlert("Silakan isi jumlah TT.");
			$objResponse->addScriptCall("fokus", "jml_bed");
		} else {
			$objResponse->addScriptCall("xajax_simpan_kamar", $new_value);
		}
		return $objResponse;
	}

	function reset_kamar () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_kamar", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("pelayanan_id", "value");
		$objResponse->addClear("kelas", "value");
		$objResponse->addClear("jml_bed", "value");
		$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT * FROM pelayanan WHERE jenis = 'RAWAT INAP' ORDER BY nama";
$kon->execute();
$_data_pel = $kon->getAll();

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Kamar", "list_data"));
$_xajax->registerFunction(array("get_kamar", "Kamar", "get_kamar"));
$_xajax->registerFunction(array("hapus_kamar", "Kamar", "hapus_kamar"));
$_xajax->registerFunction(array("simpan_kamar", "Kamar", "simpan_kamar"));
$_xajax->registerFunction(array("simpan_kamar_check", "Kamar", "simpan_kamar_check"));
$_xajax->registerFunction(array("reset_kamar", "Kamar", "reset_kamar"));

include AJAX_REF_DIR . "kunjungan.php";
?>