<?
$_TITLE = "Distribusi Pasien Menurut Tingkat Pendidikan";
Class Statistik_Pasien_Semua_Pendidikan {
	function get_pasien_check($val) {
		$val[tgl_periksa_tgl_start] = empty($val[tgl_periksa_tgl_start])?1:$val[tgl_periksa_tgl_start];
		$val[tgl_periksa_bln_start] = empty($val[tgl_periksa_bln_start])?1:$val[tgl_periksa_bln_start];
		$val[tgl_periksa_tgl_end] = empty($val[tgl_periksa_tgl_end])?1:$val[tgl_periksa_tgl_end];
		$val[tgl_periksa_bln_end] = empty($val[tgl_periksa_bln_end])?1:$val[tgl_periksa_bln_end];

		$objResponse = new xajaxResponse;

		$tgl_start = strtotime($val[tgl_periksa_thn_start] . "-" . $val[tgl_periksa_bln_start] . "-" . $val[tgl_periksa_tgl_start]);
		$tgl_end = strtotime($val[tgl_periksa_thn_end] . "-" . $val[tgl_periksa_bln_end] . "-" . $val[tgl_periksa_tgl_end]);

		if(!checkdate($val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start])) {
			$objResponse->addAlert("Tanggal Awal Tidak Valid");
			$objResponse->addScriptCall("fokus", "tgl_periksa_tgl_start");
		} elseif(!checkdate($val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end])) {
			$objResponse->addAlert("Tanggal Akhir Tidak Valid");
			$objResponse->addScriptCall("fokus", "tgl_periksa_tgl_start");
		} elseif($tgl_start > $tgl_end) {
			$objResponse->addAlert("Tanggal Awal Harus Kurang Dari Tanggal Akhir");
			$objResponse->addScriptCall("fokus", "tgl_periksa_tgl_start");
		} else {
			$objResponse->addScriptCall("xajax_get_pasien", $val);
		}
		return $objResponse;
	}

	function get_pasien($val) {
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		
		$title = "Distribusi Pasien Menurut Tingkat Pendidikan";
		
		unset($_SESSION[rekmed][statistik_pasien_semua_pendidikan]);

		$kon = new Konek;
		if($val[jangka_waktu] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q .= "AND DATE(p.tgl_daftar) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
		} elseif($val[jangka_waktu] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q .= "AND EXTRACT(YEAR_MONTH FROM p.tgl_daftar) BETWEEN EXTRACT(YEAR_MONTH FROM '" . $tgl_start . "') AND EXTRACT(YEAR_MONTH FROM '" . $tgl_end . "')";
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q .= "AND YEAR(p.tgl_daftar) BETWEEN YEAR('" . $tgl_start . "') AND YEAR ('" . $tgl_end . "')";
		}

		$title .= "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][title] = $title;
		$sql = "
			SELECT
				rp.id as id,
				rp.nama as nama,
				COUNT(p.id) as jml
			FROM
				ref_pendidikan rp
				JOIN pasien p ON (p.pendidikan_id = rp.id)
			WHERE
				1=1
				$_q
			GROUP BY
				rp.id
			ORDER BY 3 DESC
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$table = new Table;
		$table->scroll = false;
		$table->addTh("No", "Tingkat Pendidikan", "Jumlah", "%");
		$table->addExtraTh(
			"style=\"width:50px\"",
			"style=\"width:200px\"",
			"",
			"style=\"width:70px\""
		);
		$table->addTh("1", "2", "3", "4");
		for($i=0;$i<sizeof($data);$i++) {
			$total = $total+$data[$i][jml];
		}
		for($i=0;$i<sizeof($data);$i++) {
			$persen = round($data[$i][jml]/$total * 100, 2);
			$table->addRow(($i+1), $data[$i][nama], $data[$i][jml], $persen);
			$table->addOnclickTd(
				"xajax_list_pasien('0', '".$data[$i][id]."', xajax.getFormValues('statistik_pasien_semua_pendidikan'))", 
				"xajax_list_pasien('0', '".$data[$i][id]."', xajax.getFormValues('statistik_pasien_semua_pendidikan'))", 
				"xajax_list_pasien('0', '".$data[$i][id]."', xajax.getFormValues('statistik_pasien_semua_pendidikan'))", 
				"xajax_list_pasien('0', '".$data[$i][id]."', xajax.getFormValues('statistik_pasien_semua_pendidikan'))");

			$_SESSION[rekmed][statistik_pasien_semua_pendidikan][no][$i] = ($i+1);
			$_SESSION[rekmed][statistik_pasien_semua_pendidikan][nama][$i] = $data[$i][nama];
			$_SESSION[rekmed][statistik_pasien_semua_pendidikan][jml][$i] = $data[$i][jml];
			$_SESSION[rekmed][statistik_pasien_semua_pendidikan][persen][$i] = $persen;
			$persen_total += $persen;
		}
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][total] = $total;
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][persen_total] = round($persen_total);
		$table->addRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_semua_pendidikan][total], $_SESSION[rekmed][statistik_pasien_semua_pendidikan][persen_total]);
		$ret = $table->build();
		if(empty($_SESSION[rekmed][statistik_pasien_semua_pendidikan][jml])) $_SESSION[rekmed][statistik_pasien_semua_pendidikan][jml][0] = 1;
		if(empty($_SESSION[rekmed][statistik_pasien_semua_pendidikan][nama]))	$_SESSION[rekmed][statistik_pasien_semua_pendidikan][nama][0] = "No Data";
		

		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_pasien_semua_pendidikan][title]));
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][graph] = "<img src=\"" . URL . "rekmed/statistik_pasien_semua_pendidikan_graph_pie/?md5=".md5(date("Ymdhis"))."\" alt=\"Pasien\" />";
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_pasien_semua_pendidikan][graph]);
		return $objResponse;
	}

	function list_pasien($hal, $id_pendidikan, $val) {
		unset($_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien]);
		/*cek tanggal untuk menghindari 2007-02-31=>mundur 1 hari atw 1 bulan*/
		$val[tgl_periksa_tgl_start] = empty($val[tgl_periksa_tgl_start])?"1":$val[tgl_periksa_tgl_start];
		$val[tgl_periksa_bln_start] = empty($val[tgl_periksa_bln_start])?"1":$val[tgl_periksa_bln_start];

		$val[tgl_periksa_tgl_end] = empty($val[tgl_periksa_tgl_end])?"1":$val[tgl_periksa_tgl_end];
		$val[tgl_periksa_bln_end] = empty($val[tgl_periksa_bln_end])?"1":$val[tgl_periksa_bln_end];

		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));

		if($val[jangka_waktu] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q = "AND DATE(p.tgl_daftar) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
		} elseif($val[jangka_waktu] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q = "AND EXTRACT(YEAR_MONTH FROM p.tgl_daftar) BETWEEN '" . $val[tgl_periksa_thn_start] . $val[tgl_periksa_bln_start] . "' AND '" . $val[tgl_periksa_thn_end] . $val[tgl_periksa_bln_end] . "'";
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q = "AND YEAR(p.tgl_daftar) BETWEEN '" . $val[tgl_periksa_thn_start] . "' AND '" . $val[tgl_periksa_thn_end] . "'";
		}

		$objResponse = new xajaxResponse();
		$paging = new MyPagina;
		$paging->rows_on_page = 5;
		$paging->hal = $hal;
		$sql = "
			SELECT
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				p.tgl_daftar as tgl_daftar,
				p.sex as jk,
				rp.nama as nama_pendidikan
			FROM
				pasien p
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				JOIN ref_pendidikan rp ON (rp.id = p.pendidikan_id)
			WHERE
				rp.id = '".$id_pendidikan."'
				$_q
			GROUP BY p.id
			ORDER BY
				p.tgl_daftar
		";
		
		//echo $sql;
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$paging->onclick_func = "xajax_list_pasien";
		$paging->setOnclickValue($id_pendidikan, "xajax.getFormValues('statistik_pasien_semua_pendidikan')");

		$paging->sql = $sql;
		$paging->get_page_result();
		$ket_hal = $paging->ket_hal_ini();
		$no = $paging->start_number();
		$data = $paging->data;
		$navi = $paging->navi();
		$is_last_page = $paging->is_last_page();

		$title = "Daftar Pasien Pasien Dengan Tingkat Pendidikan ".$data[0][nama_pendidikan]. "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$objResponse->addClear("list_pasien", "style.display");
		$atas = "<div style=\"text-align:right;width:100%;\">";
		$atas .= "<img src=\"". IMAGES_URL . "printer.gif\" alt=\"Cetak\" onclick=\"cetak('".URL."rekmed/statistik_pasien_semua_pendidikan_list_pasien_cetak/?hal=".$hal."');\" class=\"printer_button\" />";
		$atas .= "<img src=\"". IMAGES_URL . "close.gif\" alt=\"Tutup\" onclick=\"tutup_list_pasien();\" class=\"close_button2\" />";
		$atas .= "</div>";
		$atas .= "<h3>".nl2br($title)."</h3>";
		$atas .= "<div class=\"navi\">" . $navi . "</div>";
		$atas .= "<hr />";
		for($i=0;$i<sizeof($data);$i++) {
			$arr_usia = hitungUmur($data[$i][tgl_lahir], $data[$i][tgl_daftar]);
			$usia = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
			$usia .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
			$usia .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
			$ret .= "<table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">";
			$ret .= "<tr><td style=\"width:30px;vertical-align:top;\" rowspan=\"6\">".($no+$i).".</td><td style=\"width:150px\">No. RM</td><td>" . $data[$i][id_display] . "</td></tr>";
			$ret .= "<tr><td>Nama</td><td>" . $data[$i][nama] . "</td></tr>";
			$ret .= "<tr><td>Usia</td><td>" . (empty($usia)?"-":$usia) . "</td></tr>";
			$ret .= "<tr><td>Jenis Kelamin</td><td>" . $data[$i][jk] . "</td></tr>";
			$ret .= "<tr><td style=\"vertical-align:top;\">Alamat</td><td>" . $data[$i][alamat] . "</td></tr>";
			$ret .= "<tr><td>Tgl Daftar</td><td>" . tanggalIndo($data[$i][tgl_daftar], "j F Y") . "</td></tr>";
			$ret .= "</table>";
			$ret .= "<hr />";
		}
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][is_last_page] = $is_last_page;
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][title] = $title;
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][content] = $ret;
		$_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][ket_hal] = $ket_hal;
		$objResponse->addAssign("list_pasien", "innerHTML", $atas.$ret);
		return $objResponse;
	}
}

$_xajax->registerFunction(array("get_pasien_check", "Statistik_Pasien_Semua_Pendidikan", "get_pasien_check"));
$_xajax->registerFunction(array("get_pasien", "Statistik_Pasien_Semua_Pendidikan", "get_pasien"));
$_xajax->registerFunction(array("list_pasien", "Statistik_Pasien_Semua_Pendidikan", "list_pasien"));
?>