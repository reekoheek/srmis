<?
$_TITLE = "Administrasi Data Poliklinik";
Class Pelayanan {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->sql = "
			SELECT 
				pel.id as id, 
				pel.nama as nama,
				spc.nama as spec,
				pel.hari_buka as hari_buka
			FROM 
				pelayanan pel
				JOIN spesialisasi spc ON (spc.id = pel.spesialisasi_id)
			WHERE
				pel.jenis ='RAWAT JALAN'
			ORDER BY spc.nama";
		$paging->rows_on_page = 20;
		$paging->hal = $hal;
		$paging->get_page_result();
		$_SESSION[hal] = $hal;
		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 390;
		$table->addTh("No", "Nama Poliklinik", "Spesialisasi", "Hari Buka<br />Seminggu", "Hapus");
		$table->addExtraTh("style=\"width:50px;\"","","","","style=\"width:70px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][nama], 
				$data[$i][spec], 
				$data[$i][hari_buka], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_pelayanan('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>"
			);
			$table->addOnclickTd(
				"xajax_get_pelayanan('".$data[$i][id]."')", 
				"xajax_get_pelayanan('".$data[$i][id]."')", 
				"xajax_get_pelayanan('".$data[$i][id]."')", 
				"xajax_get_pelayanan('".$data[$i][id]."')"
			);
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_pelayanan($id) {
		$kon = new Konek;
		$kon->sql = "SELECT * FROM pelayanan WHERE id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pelayanan", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("spesialisasi_id", "value", $data[spesialisasi_id]);
		$objResponse->addAssign("hari_buka", "value", $data[hari_buka]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function hapus_pelayanan($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM pelayanan WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_pelayanan($value) {
		/*
		khusus untuk pelayanan rawat jalan(pj = 2), ketika simpan juga menginsert/update di tabel kamar, isinya sama.
		alasan sudah fix
		*/
		$kon = new Konek;
		if(!$value['id_pelayanan']) {
			$kon->sql = "INSERT INTO pelayanan(jenis, spesialisasi_id, nama, hari_buka) VALUES ('RAWAT JALAN', '".$value[spesialisasi_id]."', '".$value[nama]."', NULLIF('".$value[hari_buka]."',''))";
			$kon->execute();
			$last_id = $kon->last_id;
			$kon->sql = "INSERT INTO kamar(pelayanan_id, kelas, nama) VALUES ('".$last_id."', 'III', '".$value[nama]."')";
			$kon->execute();
		} else {
			$kon->sql = "UPDATE pelayanan SET spesialisasi_id = '".$value[spesialisasi_id]."', nama = '".$value[nama]."', hari_buka = '".$value[hari_buka]."' WHERE id = '".$value[id_pelayanan]."'";
			$kon->execute();
			$kon->sql = "
			UPDATE 
				kamar kmr 
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id) 
			SET 
				kmr.pelayanan_id = '".$value[id_pelayanan]."', 
				kmr.kelas = 'III', 
				kmr.nama = '".$value[nama]."' 
			WHERE 
				pel.id = '".$value[id_pelayanan]."'";
			$kon->execute();
		}
		$afek = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($afek < 0) {
			$objResponse->addAlert("Data gagal disimpan.\nSilakan Ulangi.");
		} else {
			$objResponse->addScriptCall("show_status_simpan");
			$objResponse->addScriptCall("xajax_reset_pelayanan");
			$objResponse->addScriptCall("xajax_list_data");
		}
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function simpan_pelayanan_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse();
		if(!$new_value[spesialisasi_id]) {
			$objResponse->addAlert("Silakan Pilih Spesialisasi.");
			$objResponse->addScriptCall("fokus", "spesialisasi_id");
		} elseif(!$new_value[hari_buka]) {
			$objResponse->addAlert("Silakan Isi Hari Buka Dalam Seminggu.");
			$objResponse->addScriptCall("fokus", "hari_buka");
		} elseif($new_value[hari_buka] > 7 || $new_value[hari_buka] < 1) {
			$objResponse->addAlert("Isikan Hari Buka antara 1 - 7.");
			$objResponse->addScriptCall("fokus", "hari_buka");
		} else {
			$objResponse->addScriptCall("xajax_simpan_pelayanan", $new_value);
		}
		return $objResponse;
	}

	function reset_pelayanan () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_pelayanan", "value");
		$objResponse->addClear("spesialisasi_id", "value");
		$objResponse->addClear("nama", "value");
		$objResponse->addClear("hari_buka", "value");
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT * FROM spesialisasi ORDER BY id";
$kon->execute();
$_data_spc = $kon->getAll();

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Pelayanan", "list_data"));
$_xajax->registerFunction(array("get_pelayanan", "Pelayanan", "get_pelayanan"));
$_xajax->registerFunction(array("hapus_pelayanan", "Pelayanan", "hapus_pelayanan"));
$_xajax->registerFunction(array("simpan_pelayanan", "Pelayanan", "simpan_pelayanan"));
$_xajax->registerFunction(array("simpan_pelayanan_check", "Pelayanan", "simpan_pelayanan_check"));
$_xajax->registerFunction(array("reset_pelayanan", "Pelayanan", "reset_pelayanan"));


?>