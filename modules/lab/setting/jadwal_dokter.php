<?
$_TITLE = "Administrasi Jadwal Dokter Poliklinik";
Class Jadwal_Dokter {

	function list_data($hal = 0, $pel_id = "", $dok_id = "", $hari = "") {
		if($pel_id) $s .= " AND pel.id = '".$pel_id."'";
		if($dok_id) $s .= " AND d.id = '".$dok_id."'";
		if($hari) $s .= " AND j.hari = '".$hari."'";

		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->setOnclickValue($pel_id, $dok_id, $har);
		$paging->rows_on_page = 20;
		
		$paging->sql = "
			SELECT 
				j.id as id,
				j.hari as nama_hari,
				d.nama as nama_dokter,
				DATE_FORMAT(j.jam_mulai, '%H:%i') as jam_mulai,
				DATE_FORMAT(j.jam_selesai, '%H:%i') as jam_selesai,
				pel.nama as klinik,
				j.ket as ket
				FROM
					jadwal_dokter j
					JOIN dokter d ON (d.id = j.dokter_id)
					JOIN pelayanan pel ON (pel.id = j.pelayanan_id)				
				WHERE
					d.aktif = '1'
					$s
				GROUP BY
					j.id
				ORDER BY 
					pel.nama, 
					j.hari,
					4, 
					3
		";
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$tabel = new Table;
		$tabel->tbody_height = 320;
		$tabel->addTh(
			"No", 
			"Klinik", 
			"Dokter", 
			"Hari",
			"Mulai", 
			"Selesai", 
			"Keterangan", 
			"Hapus");
		$tabel->addExtraTh(
			"style=\"width:50px;\"", 
			"style=\"width:150px;\"", 
			"style=\"width:250px;\"", 
			"style=\"width:70px;\"", 
			"style=\"width:70px;\"", 
			"style=\"width:70px;\"", 
			"", 
			"style=\"width:70px;\"");
		$hari_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
		$hari_id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

		for($i=0;$i<sizeof($data);$i++) {
			$hari = str_replace($hari_en, $hari_id, $data[$i][nama_hari]);
			$tabel->addRow(
				($no+$i), 
				$data[$i][klinik], 
				$data[$i][nama_dokter], 
				$hari, 
				$data[$i][jam_mulai], 
				$data[$i][jam_selesai], 
				$data[$i][ket], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_jadwal_dokter('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')", 
				"xajax_get_jadwal_dokter('".$data[$i][id]."')"
			);
		}
		$buka = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $buka);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		return $objResponse;
	}

	function get_jadwal_dokter($id) {
		$kon = new Konek;
		$kon->sql = "
		SELECT  
			j.id as id,
			j.hari as hari,
			pel.id as pelayanan_id,
			d.id as dokter_id,
			j.jam_mulai as jam_mulai, 
			j.jam_selesai as jam_selesai,
			j.ket as ket
		FROM 
			jadwal_dokter j
			JOIN dokter d ON (d.id = j.dokter_id)
			JOIN pelayanan pel ON (pel.id = j.pelayanan_id)
		WHERE 
			j.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		//$objResponse->addAlert(print_r($data));
		$objResponse->addAssign("id_jadwal_dokter", "value", $data[id]);
		$objResponse->addAssign("pelayanan_id", "value", $data[pelayanan_id]);
		$objResponse->addScriptCall("xajax_ref_get_dokter", "dokter_id", $data[pelayanan_id], $data[dokter_id]);
		$objResponse->addAssign("hari", "value", $data[hari]);

		$mulai = $data[jam_mulai];
		$arr_mulai = explode(":", $mulai);
		$objResponse->addAssign("mulai_jam", "value", $arr_mulai[0]);
		$objResponse->addAssign("mulai_menit", "value", $arr_mulai[1]);

		$selesai = $data[jam_selesai];
		$arr_selesai = explode(":", $selesai);
		$objResponse->addAssign("selesai_jam", "value", $arr_selesai[0]);
		$objResponse->addAssign("selesai_menit", "value", $arr_selesai[1]);

		$objResponse->addAssign("ket", "value", $data[ket]);
		$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}

	function hapus_jadwal_dokter($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM jadwal_dokter WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.\nTerdapat data lain yang menggunakan data ini.");
		} else {
			$objResponse->addScriptCall("cumaIni");
			$objResponse->addScriptCall("fokus", "pelayanan_id");
		}
		return $objResponse;
	}

	function simpan_jadwal_dokter($value) {
		$kon = new Konek;
		if(!$value['id_jadwal_dokter']) {
			$sql = "INSERT INTO jadwal_dokter(dokter_id, pelayanan_id, hari, jam_mulai, jam_selesai, ket) VALUES ('".$value[dokter_id]."', '".$value[pelayanan_id]."', '".$value[hari]."', '".$value[jam_mulai]."','".$value[jam_selesai]."','".$value[ket]."')";
		} else {
			$sql = "UPDATE jadwal_dokter SET dokter_id = '".$value[dokter_id]."', pelayanan_id = '".$value[pelayanan_id]."', hari = '".$value[hari]."', jam_mulai = '".$value[jam_mulai]."', jam_selesai = '".$value[jam_selesai]."', ket='".$value[ket]."' WHERE id = '".$value[id_jadwal_dokter]."'";
		}
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("cumaIni");
		$objResponse->addScriptCall("xajax_reset_jadwal_dokter");
		return $objResponse;
	}

	function simpan_jadwal_dokter_check($value) {
		$objResponse = new xajaxResponse();
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();
		$new_value[mulai_menit] = empty($new_value[mulai_menit])?"00":$new_value[mulai_menit];
		$new_value[selesai_menit] = empty($new_value[selesai_menit])?"00":$new_value[selesai_menit];

		$new_value[jam_mulai] = $new_value[mulai_jam] . ":" . $new_value[mulai_menit] . ":00";
		$new_value[jam_selesai] = $new_value[selesai_jam] . ":" . $new_value[selesai_menit] . ":00";
		$str_mulai = strtotime($new_value[jam_mulai]);
		$str_selesai = strtotime($new_value[jam_selesai]);

		if(!$new_value[pelayanan_id]) {
			$objResponse->addAlert("Silakan Pilih Klinik.");
			$objResponse->addScriptCall("fokus", "pelayanan_id");
		} elseif(!$new_value[dokter_id]) {
			$objResponse->addAlert("Silakan Pilih Dokter.");
			$objResponse->addScriptCall("fokus", "dokter_id");
		} elseif(!$new_value[hari]) {
			$objResponse->addAlert("Silakan Pilih Hari.");
			$objResponse->addScriptCall("fokus", "hari");
		} elseif($str_mulai > $str_selesai) {
			$objResponse->addAlert("Jam mulai harus kurang dari jam selesai.");
			$objResponse->addScriptCall("fokus", "mulai_jam");
		} else {
			/*
			cek jadwal tabrakan
			ceking ini cuma tabrakan 1 dokter dengan dirinya sendiri, bukan dengan dokter lain dalam 1 klinik
			*/
			$kon = new Konek;
			$sql = "
				SELECT 
					pel.nama as klinik,
					d.nama as nama_dokter,
					j.hari as nama_hari,
					DATE_FORMAT(j.jam_mulai, '%H:%i') as jam_mulai,
					DATE_FORMAT(j.jam_selesai, '%H:%i') as jam_selesai,
					CASE
						WHEN (pel.id = '".$new_value[pelayanan_id]."') THEN '1'
						ELSE '0'
					END as tabrakan_klinik,
					CASE
						WHEN (d.id = '".$new_value[dokter_id]."') THEN '1'
						ELSE '0'
					END AS tabrakan_dokter
				FROM 
					jadwal_dokter j 
					JOIN dokter d ON (d.id = j.dokter_id)
					JOIN pelayanan pel ON (pel.id = j.pelayanan_id)
				WHERE 
					(('".$new_value[jam_selesai]."' BETWEEN j.jam_mulai AND j.jam_selesai)
						OR
						('".$new_value[jam_mulai]."' BETWEEN j.jam_mulai AND j.jam_selesai)
						OR
						(j.jam_mulai BETWEEN '".$new_value[jam_mulai]."' AND '".$new_value[jam_selesai]."')
						OR
						(j.jam_selesai BETWEEN '".$new_value[jam_mulai]."' AND '".$new_value[jam_selesai]."'))
					AND 
						(d.aktif = '1' AND j.hari = '".$new_value[hari]."' AND j.id <> '".$new_value[id_jadwal_dokter]."' AND pel.id = '".$new_value[pelayanan_id]."')
				";
			$kon->sql = $sql;
			$kon->execute();
			$data = $kon->getOne();
			//$objResponse->addAssign("debug", "innerHTML", $sql);
			if($data[tabrakan_dokter] == "1") {
				$objResponse->addAlert("Jadwal tidak dapat diinput.\nTerjadi tabrakan waktu praktek dokter dengan :\nDokter : " . $data[nama_dokter] . "\nKlinik : " . $data[klinik] . "\nHari : " . $data[nama_hari] . "\nWaktu : " . $data[jam_mulai] . " - " . $data[jam_selesai]);
				$objResponse->addScriptCall("fokus", "pelayanan_id");
			} elseif($data[tabrakan_klinik] == "1") {
				$objResponse->addConfirmCommands(1, "Waktu praktek dokter berikut bersamaan/ hampir bersamaan dengan dokter yang Anda input :\nDokter : " . $data[nama_dokter] . "\nKlinik : " . $data[klinik] . "\nHari : " . $data[nama_hari] . "\nWaktu : " . $data[jam_mulai] . " - " . $data[jam_selesai] . "\nKlik OK untuk tetap menyimpan data.\nKlik Cancel untuk tidak menyimpan data.");
				$objResponse->addScriptCall("xajax_simpan_jadwal_dokter", $new_value);
				$objResponse->addScriptCall("fokus", "pelayanan_id");
			} else {
				$objResponse->addScriptCall("xajax_simpan_jadwal_dokter", $new_value);
			}
		}
		return $objResponse;
	}

	function reset_jadwal_dokter () {
		$objResponse = new xajaxResponse();
		$objResponse->addClear("id_jadwal_dokter", "value");
		$objResponse->addClear("pelayanan_id", "value");
		$objResponse->addClear("dokter_id", "value");
		$objResponse->addClear("hari", "value");
		$objResponse->addClear("mulai_jam", "value");
		$objResponse->addClear("mulai_menit", "value");
		$objResponse->addClear("selesai_jam", "value");
		$objResponse->addClear("selesai_menit", "value");
		$objResponse->addClear("ket", "value");
		$objResponse->addScriptCall("fokus", "pelayanan_id");
		return $objResponse;
	}
}

$kon = new Konek;
$kon->sql = "SELECT id, nama FROM pelayanan WHERE jenis = 'RAWAT JALAN' ORDER BY nama";
$kon->execute();
$_data_pelayanan = $kon->getAll();

//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Jadwal_Dokter", "list_data"));
$_xajax->registerFunction(array("get_jadwal_dokter", "Jadwal_Dokter", "get_jadwal_dokter"));
$_xajax->registerFunction(array("get_dokter", "Jadwal_Dokter", "get_dokter"));
$_xajax->registerFunction(array("hapus_jadwal_dokter", "Jadwal_Dokter", "hapus_jadwal_dokter"));
$_xajax->registerFunction(array("simpan_jadwal_dokter", "Jadwal_Dokter", "simpan_jadwal_dokter"));
$_xajax->registerFunction(array("simpan_jadwal_dokter_check", "Jadwal_Dokter", "simpan_jadwal_dokter_check"));
$_xajax->registerFunction(array("reset_jadwal_dokter", "Jadwal_Dokter", "reset_jadwal_dokter"));
include AJAX_REF_DIR . "kunjungan.php";

?>