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
			"jasa p", 
			"jasa rs", 
			"jasa rs op", 
			"jasa rs kembang", 
			"jasa rs adm", 
			"jasa rs sdm", 
			"jasa rumah sakit", 
			"spesialis", 
			"spesialis pendamping", 
			"perawat perinatologi", 
			"dr umum", 
			"dr gigi", 
			"assisten non dokter", 
			"spesialis anestesi", 
			"aknest", 
			"gizi", 
			"fisioterapi", 
			"analis pa", 
			"bidan", 
			"perawat", 
			"penunjang", 
			"zakat", 
			"pajak", 
			"netto", 
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
				$data[$i][jasa_p], 
				$data[$i][jasa_rs], 
				$data[$i][jasa_rs_op], 
				$data[$i][jasa_rs_kembang], 
				$data[$i][jasa_rs_adm], 
				$data[$i][jasa_rs_sdm], 
				$data[$i][jasa_rumah_sakit], 
				$data[$i][spesialis], 
				$data[$i][spesialis_pendamping], 
				$data[$i][perawat_perinatologi], 
				$data[$i][dr_umum], 
				$data[$i][dr_gigi], 
				$data[$i][assisten_non_dokter], 
				$data[$i][spesialis_anestesi], 
				$data[$i][aknest], 
				$data[$i][gizi], 
				$data[$i][fisioterapi], 
				$data[$i][analis_pa], 
				$data[$i][bidan], 
				$data[$i][perawat], 
				$data[$i][penunjang], 
				$data[$i][zakat], 
				$data[$i][pajak], 
				$data[$i][netto], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_tindakan('".$data[$i][icid]."', '".$data[$i][idid]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			$tabel->addOnclickTd(
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
				"xajax_get_tindakan('".$data[$i][icid]."', '".$data[$i][tingkat]."', '".$data[$i][kelas]."')", 
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
				id.*
		FROM 
			icopim i 
			LEFT JOIN icopim_detil id ON (id.tingkat = i.tingkat) 
		WHERE i.id = '".$id."' $q ";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$objResponse->addAssign("id_icopim", "value", $data[icid]);
		$objResponse->addAssign("id_icopim_detil", "value", $data[idid]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("kode", "value", $data[kode]);
		$objResponse->addAssign("tingkat", "value", $data[tingkat]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		$objResponse->addAssign("biaya", "value", $data[biaya]);
		$objResponse->addAssign("jasa_p", "value", $data[jasa_p]);
		$objResponse->addAssign("jasa_rs", "value", $data[jasa_rs]);
		$objResponse->addAssign("jasa_rs_op", "value", $data[jasa_rs_op]);
		$objResponse->addAssign("jasa_rs_kembang", "value", $data[jasa_rs_kembang]);
		$objResponse->addAssign("jasa_rs_adm", "value", $data[jasa_rs_adm]);
		$objResponse->addAssign("jasa_rs_sdm", "value", $data[jasa_rs_sdm]);
		$objResponse->addAssign("jasa_rumah_sakit", "value", $data[jasa_rumah_sakit]);
		$objResponse->addAssign("spesialis", "value", $data[spesialis]);
		$objResponse->addAssign("spesialis_pendamping", "value", $data[spesialis_pendamping]);
		$objResponse->addAssign("perawat_perinatologi", "value", $data[perawat_perinatologi]);
		$objResponse->addAssign("dr_umum", "value", $data[dr_umum]);
		$objResponse->addAssign("dr_gigi", "value", $data[dr_gigi]);
		$objResponse->addAssign("assisten_non_dokter", "value", $data[assisten_non_dokter]);
		$objResponse->addAssign("spesialis_anestesi", "value", $data[spesialis_anestesi]);
		$objResponse->addAssign("aknest", "value", $data[aknest]);
		$objResponse->addAssign("gizi", "value", $data[gizi]);
		$objResponse->addAssign("fisioterapi", "value", $data[fisioterapi]);
		$objResponse->addAssign("analis_pa", "value", $data[analis_pa]);
		$objResponse->addAssign("bidan", "value", $data[bidan]);
		$objResponse->addAssign("perawat", "value", $data[perawat]);
		$objResponse->addAssign("penunjang", "value", $data[penunjang]);
		$objResponse->addAssign("zakat", "value", $data[zakat]);
		$objResponse->addAssign("pajak", "value", $data[pajak]);
		$objResponse->addAssign("netto", "value", $data[netto]);
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
		$objResponse = new xajaxResponse();
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
		if(!$value['id_icopim']) {
			$sql_ic = "
			INSERT INTO 
				icopim(
				kode, 
				nama,
				tingkat
			) VALUES (
				'".$value[kode]."', 
				'".$value[nama]."',
				UPPER('".$value[tingkat]."')
			)";	
			$kon->sql = $sql_ic;
			$id_icopim = $kon->last_id;
		} else {
			$sql_ic = "UPDATE icopim SET kode = '".$value[kode]."', nama = '".$value[nama]."', tingkat = UPPER('".$value[tingkat]."') WHERE id = '".$value[id_icopim]."'";	
			$kon->sql = $sql_ic;
			$id_icopim = $value[id_icopim];
		}

		if(!$value[id_icopim_detil]) {
			$sql_id = "
			INSERT INTO 
				icopim_detil(
				icopim_id,
				tingkat,
				kelas,
				biaya,
				jasa_p, 
				jasa_rs, 
				jasa_rs_op, 
				jasa_rs_kembang, 
				jasa_rs_adm, 
				jasa_rs_sdm, 
				jasa_rumah_sakit,
				spesialis, 
				spesialis_pendamping, 
				perawat_perinatologi,
				dr_umum,
				dr_gigi,
				assisten_non_dokter,
				spesialis_anestesi,
				aknest,
				gizi,
				fisioterapi,
				analis_pa,
				bidan,
				perawat, 
				penunjang, 
				zakat, 
				pajak, 
				netto
			) VALUES (
				'".$id_icopim."', 
				UPPER('".$value[tingkat]."'),
				'".$value[kelas]."',
				'".$value[biaya]."',
				'".$value[jasa_p]."', 
				'".$value[jasa_rs]."', 
				'".$value[jasa_rs_op]."', 
				'".$value[jasa_rs_kembang]."', 
				'".$value[jasa_rs_adm]."', 
				'".$value[jasa_rs_sdm]."', 
				'".$value[jasa_rumah_sakit]."', 
				'".$value[spesialis]."', 
				'".$value[spesialis_pendamping]."', 
				'".$value[perawat_perinatologi]."', 
				'".$value[dr_umum]."', 
				'".$value[dr_gigi]."', 
				'".$value[assisten_non_dokter]."', 
				'".$value[spesialis_anestesi]."', 
				'".$value[aknest]."', 
				'".$value[gizi]."', 
				'".$value[fisioterapi]."', 
				'".$value[analis_pa]."', 
				'".$value[bidan]."', 
				'".$value[perawat]."', 
				'".$value[penunjang]."', 
				'".$value[zakat]."', 
				'".$value[pajak]."', 
				'".$value[netto]."'
			)";
		} else {
			$sql_id = "
				UPDATE icopim_detil SET	icopim_id = '".$id_icopim."', tingkat = UPPER('".$value[tingkat]."'), kelas ='".$value[kelas]."', biaya ='".$value[biaya]."', jasa_p ='".$value[jasa_p]."', jasa_rs ='".$value[jasa_rs]."', jasa_rs_op ='".$value[jasa_rs_op]."', jasa_rs_kembang ='".$value[jasa_rs_kembang]."', jasa_rs_adm ='".$value[jasa_rs_adm]."', jasa_rs_sdm ='".$value[jasa_rs_sdm]."', jasa_rumah_sakit ='".$value[jasa_rumah_sakit]."', spesialis ='".$value[spesialis]."', spesialis_pendamping ='".$value[spesialis_pendamping]."', perawat_perinatologi ='".$value[perawat_perinatologi]."', dr_umum ='".$value[dr_umum]."', dr_gigi ='".$value[dr_gigi]."', assisten_non_dokter ='".$value[assisten_non_dokter]."', spesialis_anestesi ='".$value[spesialis_anestesi]."', aknest ='".$value[aknest]."', gizi ='".$value[gizi]."', fisioterapi ='".$value[fisioterapi]."', analis_pa ='".$value[analis_pa]."', bidan ='".$value[bidan]."', perawat ='".$value[perawat]."', penunjang ='".$value[penunjang]."', zakat ='".$value[zakat]."', pajak ='".$value[pajak]."', netto = '".$value[netto]."' WHERE id = '".$value[id_icopim_detil]."'";
		}
		$kon->sql = $sql_id;
		$kon->execute();
		$objResponse = new xajaxResponse();
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