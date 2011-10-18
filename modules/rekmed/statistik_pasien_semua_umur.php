<?
$_TITLE = "Distribusi Pasien Menurut Golongan Umur";
Class Statistik_Pasien_Semua_Umur {
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
		
		$title = "Distribusi Pasien Menurut Golongan Umur";
		
		unset($_SESSION[rekmed][statistik_pasien_semua_umur]);

		$kon = new Konek;
		if($val[jangka_waktu] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q .= "AND DATE(tgl_daftar) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
		} elseif($val[jangka_waktu] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q .= "AND EXTRACT(YEAR_MONTH FROM tgl_daftar) BETWEEN EXTRACT(YEAR_MONTH FROM '" . $tgl_start . "') AND EXTRACT(YEAR_MONTH FROM '" . $tgl_end . "')";
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q .= "AND YEAR(tgl_daftar) BETWEEN YEAR('" . $tgl_start . "') AND YEAR ('" . $tgl_end . "')";
		}

		$title .= "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$_SESSION[rekmed][statistik_pasien_semua_umur][title] = $title;
		$sql = "
			SELECT
				tgl_lahir as tgl_lahir,
				tgl_daftar as tgl_daftar
			FROM
				pasien
			WHERE
				1=1
				$_q
			GROUP BY
				id
			ORDER BY tgl_daftar
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$total = sizeof($data);
		$baru = array();
		$persen = array();
		for($i=0;$i<sizeof($data);$i++) {
			$umur = hitungUmur($data[$i][tgl_lahir], $data[$i][tgl_daftar]);
			$umur_tahun = $umur[tahun];
			$umur_hari = $umur[hari];
			if($umur[tahun] > 64) {
				$baru['nam_lima'] += 1;
				$persen['nam_lima'] = @round($baru['nam_lima']*100/$total, 2);
			} elseif ($umur[tahun] > 44) {
				$baru['pat_lima'] += 1;
				$persen['pat_lima'] = @round($baru['pat_lima']*100/$total, 2);
			} elseif ($umur[tahun] > 24) {
				$baru['dua_lima'] += 1;
				$persen['dua_lima'] = @round($baru['dua_lima']*100/$total, 2);
			} elseif ($umur[tahun] > 14) {
				$baru['lima_belas'] += 1;
				$persen['lima_belas'] = @round($baru['lima_belas']*100/$total, 2);
			} elseif ($umur[tahun] > 4) {
				$baru['lima'] += 1;
				$persen['lima'] = @round($baru['lima']*100/$total, 2);
			} elseif ($umur[tahun] >=1) {
				$baru['satu'] += 1;
				$persen['satu'] = @round($baru['satu']*100/$total, 2);
			} elseif ($umur[hari] > 27) {
				$baru['dua_lapan'] += 1;
				$persen['dua_lapan'] = @round($baru['dua_lapan']*100/$total, 2);
			} else {
				$baru['nol'] += 1;
				$persen['nol'] = @round($baru['nol']*100/$total, 2);
			}
		}
		$arr_umur = array("0-28 HR", "28 HR - &lt;1 TH", "1-4 TH", "5-14 TH", "15-24 TH", "25-44 TH", "45-64 TH", "65+ TH");
		$new = array_reverse($baru);
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$table = new Table;
		$table->scroll = false;
		$table->addTh("No", "Golongan Umur", "Jumlah", "%");
		$table->addExtraTh(
			"style=\"width:50px\"",
			"style=\"width:200px\"",
			"",
			"style=\"width:70px\""
		);
		$table->addTh("1", "2", "3", "4");
		for($i=0;$i<sizeof($arr_umur);$i++) {
			$kunci = key($new);
			$table->addRow(($i+1), $arr_umur[$i], $new[$kunci], $persen[$kunci]);
			$_SESSION[rekmed][statistik_pasien_semua_umur][no][$i] = ($i+1);
			$_SESSION[rekmed][statistik_pasien_semua_umur][nama][$i] = $arr_umur[$i];
			$_SESSION[rekmed][statistik_pasien_semua_umur][jml][$i] = $new[$kunci];
			$_SESSION[rekmed][statistik_pasien_semua_umur][persen][$i] = $persen[$kunci];
			$persen_total += $persen[$kunci];
			next($new);
		}
		$_SESSION[rekmed][statistik_pasien_semua_umur][total] = $total;
		$_SESSION[rekmed][statistik_pasien_semua_umur][persen_total] = round($persen_total);
		$table->addRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_semua_umur][total], $_SESSION[rekmed][statistik_pasien_semua_umur][persen_total]);
		$ret = $table->build();
		if(empty($_SESSION[rekmed][statistik_pasien_semua_umur][jml])) $_SESSION[rekmed][statistik_pasien_semua_umur][jml][0] = 1;
		if(empty($_SESSION[rekmed][statistik_pasien_semua_umur][nama]))	$_SESSION[rekmed][statistik_pasien_semua_umur][nama][0] = "No Data";
		

		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_pasien_semua_umur][title]));
		$_SESSION[rekmed][statistik_pasien_semua_umur][graph] = "<img src=\"" . URL . "rekmed/statistik_pasien_semua_umur_graph_pie/?md5=".md5(date("Ymdhis"))."\" alt=\"Pasien\" />";
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_pasien_semua_umur][graph]);
		return $objResponse;
	}

}

$_xajax->registerFunction(array("get_pasien_check", "Statistik_Pasien_Semua_Umur", "get_pasien_check"));
$_xajax->registerFunction(array("get_pasien", "Statistik_Pasien_Semua_Umur", "get_pasien"));
$_xajax->registerFunction(array("list_pasien", "Statistik_Pasien_Semua_Umur", "list_pasien"));
?>