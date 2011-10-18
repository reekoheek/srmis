<?
$_TITLE = "Cetak Tracer";
Class Cetak_Tracer {

	function list_data($jenis = "BELUM", $limit = 5, $auto = "0", $tgl="") {
		if($jenis == "BELUM") $s .= " AND trc.cetak = 'BELUM' ";
		elseif($jenis == "SUDAH") $s .= " AND trc.cetak = 'SUDAH' ";
		if($tgl) $s .= "AND DATE(trc.tgl_keluar) = '".$tgl."' ";
		$kon = new Konek;
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				kmr.nama as kamar,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				d.nama as nama_dokter,
				trc.cetak as tercetak
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN tracer trc ON (trc.kunjungan_kamar_id = kk.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				trc.cetak IS NOT NULL
				$s
			ORDER BY 
				kk.id
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();

		$table = new Table;
		$table->tbody_height = 340;
		$table->addTh(
			"No", 
			"No.<br />Kjg",
			"No. RM", 
			"Pasien", 
			"Pelayanan", 
			"Dokter", 
			"Tgl<br />Daftar",
			"Tgl<br />Periksa",
			"Tracer<br />Tercetak",
			"Cetak<br />Sendiri"
		);
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","","","style=\"width:50px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($i+1), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kamar], 
				$data[$i][nama_dokter], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y'), 
				tanggalIndo($data[$i][tgl_periksa], 'j M Y'), 
				$data[$i][tercetak], 
				"<a href=\"javascript:void(0)\" title=\"Cetak ini saja\" style=\"display:block;\" onclick=\"cetak('".URL."filing/cetak_tracer_cetak/?kkid=".$data[$i][id_kunjungan_kamar]."',350,300)\"><img src=\"".IMAGES_URL."printer_hitam.png\" alt=\"Cetak\" border=\"0\" /></a>");
			$table->addOnclickTd(
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')"
			);
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $auto);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);

		//jika ada pasien dan auto cetak dihidupkan, maka jalankan skrip membuka window cetak
		if(!empty($data) && $auto == "1") {
			$tgl = str_replace("-", "|", $tgl);
			$objResponse->addScriptCall("cetak_tracer", URL . "filing/cetak_tracer_cetak/?jenis=" . $jenis . "&limit=" . $limit . "&tgl=" . $tgl, 350, 600);
		}
		return $objResponse;
	}


	function list_semua_kunjungan($hal, $pasien_id) {
		$paging = new MyPagina;
		$paging->hal = $hal;
		$paging->rows_on_page = 5;
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				k.kunjungan_ke as kunjungan_ke,
				kk.no_antrian as no_antrian,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				kmr.nama as kamar,
				kk.tgl_periksa as tgl_periksa,
				d.nama as nama_dokter
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				p.id = '".$pasien_id."'
			ORDER BY 
				kk.id ASC
		";
		$paging->sql = $sql;
		$paging->onclick_func = "xajax_list_semua_kunjungan";
		$paging->setOnclickValue($pasien_id);
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$objResponse = new xajaxResponse();
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addScriptCall("buka_semua_kunjungan");
		$ret .= "<br /><b>No.RM : " . $data[0][no_rm] . "</b>";
		$ret .= "<br /><b>Pasien : " . $data[0][nama] . "</b>";
		$ret .= "<hr />";

		for($i=0;$i<sizeof($data);$i++) {
			
			$ret .= "<table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">";
			$ret .= "<tr><td colspan=\"2\"><b>Kunjungan Ke-" . $data[$i][kunjungan_ke] ."</b></td></tr>";
			$ret .= "<tr><td style=\"width:150px\">Tanggal Kunjung</td><td>" . tanggalIndo($data[$i][tgl_periksa], "j F Y") . "</td></tr>";
			$ret .= "<tr><td>Pelayanan</td><td>" . $data[$i][kamar] . "</td></tr>";
			$ret .= "<tr><td>Dokter</td><td>" . $data[$i][nama_dokter] . "</td></tr>";
			$ret .= "</table>";
			$ret .= "<hr />";
		}
		$modal = new Modal;
		$modal->setNavi($navi);
		$modal->setTitle("Daftar Kunjungan");
		$modal->setContent($ret);
		$modal->setCloseButtonOnclick("tutup_semua_kunjungan()");
		$modal_cnt = $modal->build();
		//$objResponse->addAssign("list_semua_kunjungan_navi", "innerHTML", $navi);
		$objResponse->addAssign("list_semua_kunjungan", "innerHTML", $modal_cnt);
		return $objResponse;
	}
}


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Cetak_Tracer", "list_data"));
$_xajax->registerFunction(array("list_semua_kunjungan", "Cetak_Tracer", "list_semua_kunjungan"));

?>