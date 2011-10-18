<?
$_TITLE = "Statistik Penyakit Rawat Jalan";
Class Statistik_Penyakit {
	function get_penyakit_check($val) {
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
			$objResponse->addScriptCall("xajax_get_penyakit", $val);
		}
		return $objResponse;
	}

	function get_penyakit($val) {
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));

		if($val[tampilkan] != "Semua") {
			$batas = $val[tampilkan];
			$title = "Statistik ".$val[tampilkan]." Besar Penyakit Rawat Jalan";
		} else {
			$batas = 0;
			$title = "Statistik Penyakit Rawat Jalan";
		}

		unset($_SESSION[rekmed][statistik_penyakit_rajal]);

		$kon = new Konek;
		if($val[pelayanan_id]) {
			$kon->sql = "SELECT nama FROM pelayanan WHERE id = '".$val[pelayanan_id]."'";
			$kon->execute();
			$pel = $kon->getOne();
			$title .= "\nPoliklinik " . $pel[nama];
			$_q = "AND pel.id = '".$val[pelayanan_id]."'";
		}
		if($val[jangka_waktu] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q .= "AND DATE(kk.tgl_periksa) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
		} elseif($val[jangka_waktu] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q .= "AND EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) BETWEEN EXTRACT(YEAR_MONTH FROM '" . $tgl_start . "') AND EXTRACT(YEAR_MONTH FROM '" . $tgl_end . "')";
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q .= "AND YEAR(kk.tgl_periksa) BETWEEN YEAR('" . $tgl_start . "') AND YEAR ('" . $tgl_end . "')";
		}

		$title .= "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$_SESSION[rekmed][statistik_penyakit_rajal][title] = $title;

		$sql = "
			SELECT
				i.nama as nama,
				i.id as id_icd,
				i.kode_icd as kode_icd,
				1 as jml,
				DATE(kk.tgl_periksa) as tgl_periksa
			FROM
				icd i 
				JOIN kunjungan_kamar kk ON (kk.diagnosa_utama_id = i.id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
			WHERE
				kk.kelanjutan IN('DIRUJUK', 'PULANG')
				AND pel.jenis = 'RAWAT JALAN'
				$_q
			GROUP BY
				i.id, k.pasien_id
			ORDER BY 2 DESC, kk.id ASC
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$table = new Table;
		$table->scroll = false;
		$table->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
		$table->addExtraTh(
			"style=\"width:50px\"",
			"style=\"width:150px\"",
			"",
			"",
			"style=\"width:70px\"",
			"style=\"width:70px\""
		);
		$table->addTh("1", "2", "3", "4", "5");
		
		$n=0;
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id_icd] != $data[$i-1][id_icd]) {
				$new_data[$n][jml] = 1;
				$new_data[$n][id_icd] = $data[$i][id_icd];
				$new_data[$n][nama] = $data[$i][nama];
				$new_data[$n][kode_icd] = $data[$i][kode_icd];
				$n++;
			} else {
				$new_data[$n-1][jml]++;
			}
		}
		//sorting	
		for($i=0;$i<sizeof($new_data);$i++) { //0-10
			for($j=($i+1);$j<=sizeof($new_data);$j++) { //1-10
				if($new_data[$j][jml] > $new_data[$i][jml]) {
					$tmp = $new_data[$i];
					$new_data[$i] = $new_data[$j];
					$new_data[$j] = $tmp;
				}
			}
		}
		for($i=0;$i<sizeof($new_data);$i++) {
			if($batas != 0 && $i == $batas) break;
			$total += $new_data[$i][jml];
		}
		for($i=0;$i<sizeof($new_data);$i++) {
			if($batas != 0 && $i == $batas) break;
			$persen = round($new_data[$i][jml]/$total * 100, 2);
			$table->addRow(($i+1), $new_data[$i][kode_icd], $new_data[$i][nama], $new_data[$i][jml], $persen);
			$table->addOnclickTd(
				"xajax_list_pasien('0', '".$new_data[$i][id_icd]."', xajax.getFormValues('sepuluh_besar'))", 
				"xajax_list_pasien('0', '".$new_data[$i][id_icd]."', xajax.getFormValues('sepuluh_besar'))", 
				"xajax_list_pasien('0', '".$new_data[$i][id_icd]."', xajax.getFormValues('sepuluh_besar'))", 
				"xajax_list_pasien('0', '".$new_data[$i][id_icd]."', xajax.getFormValues('sepuluh_besar'))");

			$_SESSION[rekmed][statistik_penyakit_rajal][no][$i] = ($i+1);
			$_SESSION[rekmed][statistik_penyakit_rajal][kode][$i] = $new_data[$i][kode_icd];
			$_SESSION[rekmed][statistik_penyakit_rajal][nama][$i] = $new_data[$i][nama];
			$_SESSION[rekmed][statistik_penyakit_rajal][jml][$i] = $new_data[$i][jml];
			$_SESSION[rekmed][statistik_penyakit_rajal][persen][$i] = $persen;
			$persen_total += $persen;
		}
		$table->addRow("", "<b>Total</b>", "", $total, round($persen_total));

		$_SESSION[rekmed][statistik_penyakit_rajal][total] = $total;
		$_SESSION[rekmed][statistik_penyakit_rajal][persen_total] = round($persen_total);

		if(empty($_SESSION[rekmed][statistik_penyakit_rajal][jml])) $_SESSION[rekmed][statistik_penyakit_rajal][jml][0] = 1;
		if(empty($_SESSION[rekmed][statistik_penyakit_rajal][kode])) $_SESSION[rekmed][statistik_penyakit_rajal][kode][0] = "No Data";
		$ret = $table->build();
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_penyakit_rajal][title]));
		$_SESSION[rekmed][statistik_penyakit_rajal][graph] = "<img src=\"" . URL . "rekmed/statistik_penyakit_rajal_graph_pie/?md5=".md5(date("Ymdhis"))."\" alt=\"Penyakit\" />";
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_penyakit_rajal][graph]);
		return $objResponse;
	}

	function list_pasien($hal, $id_icd, $val) {
		unset($_SESSION[rekmed][statistik_penyakit_rajal][list_pasien][cetak]);
		/*cek tanggal untuk menghindari 2007-02-31=>mundur 1 hari atw 1 bulan*/
		$val[tgl_periksa_tgl_start] = empty($val[tgl_periksa_tgl_start])?"1":$val[tgl_periksa_tgl_start];
		$val[tgl_periksa_bln_start] = empty($val[tgl_periksa_bln_start])?"1":$val[tgl_periksa_bln_start];
		$val[tgl_periksa_tgl_end] = empty($val[tgl_periksa_tgl_end])?"1":$val[tgl_periksa_tgl_end];
		$val[tgl_periksa_bln_end] = empty($val[tgl_periksa_bln_end])?"1":$val[tgl_periksa_bln_end];


		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		//echo $val[tgl_periksa_tgl_start];
		if($val[jangka_waktu] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q = "AND DATE(kk.tgl_periksa) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
		} elseif($val[jangka_waktu] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q = "AND EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) BETWEEN '" . $val[tgl_periksa_thn_start] . $val[tgl_periksa_bln_start] . "' AND '" . $val[tgl_periksa_thn_end] . $val[tgl_periksa_bln_end] . "'";
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q = "AND YEAR(kk.tgl_periksa) BETWEEN '" . $val[tgl_periksa_thn_start] . "' AND '" . $val[tgl_periksa_thn_end] . "'";
		}
	
		if($val[pelayanan_id]) {
			$kon = new Konek;
			$kon->sql = "SELECT nama FROM pelayanan WHERE id = '".$val[pelayanan_id]."'";
			$kon->execute();
			$pel = $kon->getOne();
			$pelayanan = " Poliklinik " . $pel[nama] . " ";
			$_q .= "AND pel.id = '".$val[pelayanan_id]."'";
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
				kk.tgl_periksa as tgl_periksa,
				i.kode_icd as kode_icd,
				CONCAT(i.kode_icd, ' - ', i.nama) as diagnosa,
				p.sex as jk
			FROM
				pasien p
				JOIN kunjungan k ON (k.pasien_id = p.id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN icd i ON (kk.diagnosa_utama_id = i.id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
			WHERE
				kk.diagnosa_utama_id = '".$id_icd."'
				AND kk.kelanjutan IN('DIRUJUK', 'PULANG')
				AND pel.jenis = 'RAWAT JALAN'
				$_q
			GROUP BY i.id, p.id
			ORDER BY
				kk.id
		";
		
		//echo $sql;
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$paging->onclick_func = "xajax_list_pasien";
		$paging->setOnclickValue($id_icd, "xajax.getFormValues('sepuluh_besar')");

		$paging->sql = $sql;
		$paging->get_page_result();
		$ket_hal = $paging->ket_hal_ini();
		$no = $paging->start_number();
		$data = $paging->data;
		$navi = $paging->navi();
		$is_last_page = $paging->is_last_page();

		$title = "Daftar Pasien Rawat Jalan".$pelayanan."Penderita ".$data[0][diagnosa]." [ ".$data[0][kode_icd]."] " . $ply ." \nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$objResponse->addClear("list_pasien", "style.display");
		$atas = "<div style=\"text-align:right;width:100%;\">";
		$atas .= "<img src=\"". IMAGES_URL . "printer.gif\" alt=\"Cetak\" onclick=\"cetak('".URL."rekmed/statistik_penyakit_rajal_list_pasien_cetak/?hal=".$hal."');\" class=\"printer_button\" />";
		$atas .= "<img src=\"". IMAGES_URL . "close.gif\" alt=\"Tutup\" onclick=\"tutup_list_pasien();\" class=\"close_button2\" />";
		$atas .= "</div>";
		$atas .= "<h3>".nl2br($title)."</h3>";
		$atas .= "<div class=\"navi\">" . $navi . "</div>";
		$atas .= "<hr />";
		for($i=0;$i<sizeof($data);$i++) {
			$arr_usia = hitungUmur($data[$i][tgl_lahir], $data[$i][tgl_periksa]);
			$usia = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
			$usia .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
			$usia .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
			$ret .= "<table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">";
			$ret .= "<tr><td style=\"width:30px;vertical-align:top;\" rowspan=\"6\">".($no+$i).".</td><td style=\"width:150px\">No. RM</td><td>" . $data[$i][id_display] . "</td></tr>";
			$ret .= "<tr><td>Nama</td><td>" . $data[$i][nama] . "</td></tr>";
			$ret .= "<tr><td>Usia</td><td>" . (empty($usia)?"-":$usia) . "</td></tr>";
			$ret .= "<tr><td>Jenis Kelamin</td><td>" . $data[$i][jk] . "</td></tr>";
			$ret .= "<tr><td style=\"vertical-align:top;\">Alamat</td><td>" . $data[$i][alamat] . "</td></tr>";
			$ret .= "<tr><td>Tgl Periksa</td><td>" . tanggalIndo($data[$i][tgl_periksa], "j F Y") . "</td></tr>";
			$ret .= "</table>";
			$ret .= "<hr />";
		}
		$_SESSION[rekmed][statistik_penyakit_rajal][list_pasien][cetak][is_last_page] = $is_last_page;
		$_SESSION[rekmed][statistik_penyakit_rajal][list_pasien][cetak][title] = $title;
		$_SESSION[rekmed][statistik_penyakit_rajal][list_pasien][cetak][content] = $ret;
		$_SESSION[rekmed][statistik_penyakit_rajal][list_pasien][cetak][ket_hal] = $ket_hal;
		$objResponse->addAssign("list_pasien", "innerHTML", $atas.$ret);
		return $objResponse;
	}
}
$kon = new Konek;
$kon->sql = "SELECT id, nama FROM pelayanan WHERE jenis = 'RAWAT JALAN' ORDER BY nama";
$kon->execute();
$_data_pelayanan = $kon->getAll();


$_xajax->registerFunction(array("get_penyakit_check", "Statistik_Penyakit", "get_penyakit_check"));
$_xajax->registerFunction(array("get_penyakit", "Statistik_Penyakit", "get_penyakit"));
$_xajax->registerFunction(array("list_pasien", "Statistik_Penyakit", "list_pasien"));
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "daerah.php";
?>