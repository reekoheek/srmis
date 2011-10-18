<?
$_TITLE = "Statistik Kunjungan Laboratorium Berdasar Cara Masuk";

Class Statistik_Kunjungan_IGD {

	function get_kunjungan_check($val) {
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
			$objResponse->addScriptCall("fokus", "tgl_periksa_tgl_end");
		} elseif($tgl_start > $tgl_end) {
			$objResponse->addAlert("Tanggal Awal Harus Kurang Dari Tanggal Akhir");
			$objResponse->addScriptCall("fokus", "tgl_periksa_tgl_start");
		} else {
			$objResponse->addScriptCall("xajax_get_kunjungan", $val);
		}
		return $objResponse;
	}

	function get_kunjungan($val) {
		unset($_SESSION[lab][statistik_kunjungan_semua_cara_masuk]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Statistik Kunjungan Laboratorium Berdasar Cara Masuk";
		
		if($val[tampilkan] == "hari") {
			$selisih = datediff('d', $tgl_start, $tgl_end);
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
		} elseif($val[tampilkan] == "bulan") {
			$selisih = datediff('m', $tgl_start, $tgl_end);
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
		} else {
			$selisih = datediff('y', $tgl_start, $tgl_end);
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
		}

		$title .= "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;

		$arr_tgl_start = explode("-",$tgl_start);
		$tgl_start_tgl = $arr_tgl_start[2];
		$tgl_start_bln = $arr_tgl_start[1];
		$tgl_start_thn = $arr_tgl_start[0];

		$arr_tgl_end = explode("-",$tgl_end);
		$tgl_end_tgl = $arr_tgl_end[2];
		$tgl_end_bln = $arr_tgl_end[1];
		$tgl_end_thn = $arr_tgl_end[0];

		$objResponse = new xajaxResponse();
		$kon = new Konek;

		for($i=0;$i<=$selisih;$i++) {
			if($val[tampilkan] == "hari") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($i+$tgl_start_tgl), $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "j M\nY");
				$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][label_tick][$i] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$label_x[$i] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$where = " AND DATE(lk.tgl_periksa) = '" . $tgl[$i] . "' ";
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "M\nY");
				$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][label_tick][$i] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$label_x[$i] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$where = " AND EXTRACT(YEAR_MONTH FROM lk.tgl_periksa) = EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') ";
			} else {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $i)));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "Y");
				$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][label_tick][$i] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$i)));
				$label_x[$i] = "Tahun";
				$where = " AND YEAR(lk.tgl_periksa) = YEAR('" . $tgl[$i] . "') ";
			}
			//dari IRD
			$kon->sql = "
				SELECT
					COUNT(lk.id) as jml_igd
				FROM
					lab_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					lk.cara_masuk = 'IGD'
					$where
			";
			$kon->execute();
			$igd[$i] = $kon->getOne();
			if(!$igd[$i][jml_igd]) $igd[$i][jml_igd] = "-";


			//dari RAWAT JALAN
			$kon->sql = "
				SELECT
					COUNT(lk.id) as jml_rajal
				FROM
					lab_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					lk.cara_masuk = 'RAWAT JALAN'
					$where
			";
			$kon->execute();
			$rajal[$i] = $kon->getOne();
			if(!$rajal[$i][jml_rajal]) $rajal[$i][jml_rajal] = "-";


			//dari RAWAT INAP
			$kon->sql = "
				SELECT
					COUNT(lk.id) as jml_ranap
				FROM
					lab_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					lk.cara_masuk = 'RAWAT INAP'
					$where
			";
			$kon->execute();
			$ranap[$i] = $kon->getOne();
			if(!$ranap[$i][jml_ranap]) $ranap[$i][jml_ranap] = "-";


			//dari RAWAT INAP
			$kon->sql = "
				SELECT
					COUNT(lk.id) as jml_luar
				FROM
					lab_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					lk.cara_masuk = 'PASIEN LUAR'
					$where
			";
			$kon->execute();
			$luar[$i] = $kon->getOne();
			if(!$luar[$i][jml_luar]) $luar[$i][jml_luar] = "-";

			$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][jml_igd][$i] = $igd[$i][jml_igd];
			$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][jml_rajal][$i] = $rajal[$i][jml_rajal];
			$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][jml_ranap][$i] = $ranap[$i][jml_ranap];
			$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][jml_luar][$i] = $luar[$i][jml_luar];

			$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][tgl_periksa][$i] = $tgl_periksa[$i];
		}
		//$objResponse->addAlert(print_r($lama));
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][title] = $title . "\nPeriode " . tanggalIndo($tgl_start, "j F Y") . " s.d. " . tanggalIndo($tgl_end, "j F Y");
		$labelx = @array_unique($label_x);
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][label_x] = @implode(", ",$labelx);

		$table = new Table;
		$table->scroll = false;
		//$table->Th[0][] = "Pelayanan";
		//$table->extra_th[0][] = "rowspan=\"2\"";
		for($i=0;$i<=$selisih;$i++) {
			$table->Th[0][] = $tgl_periksa[$i];
			$table->extra_th[0][] = "colspan=\"4\"";
		}
		$table->Th[0][] = "Jumlah";
		$table->extra_th[0][] = "colspan=\"4\"";
		$kolom = $selisih*4+3;
		for($i=0;$i<=$selisih;$i++) {
			$table->Th[1][] = "IRD";
			$table->Th[1][] = "Rajal";
			$table->Th[1][] = "Ranap";
			$table->Th[1][] = "Px Luar";
		}
		//kolom jumlah
		$table->Th[1][] = "IRD";
		$table->Th[1][] = "Rajal";
		$table->Th[1][] = "Ranap";
		$table->Th[1][] = "Px Luar";

		//isinya
		//$table->Row[0][0] = "IGD";
		for($i=0;$i<=$selisih;$i++) {
			$table->Row[0][] = $igd[$i][jml_igd];
			$table->Row[0][] = $rajal[$i][jml_rajal];
			$table->Row[0][] = $ranap[$i][jml_ranap];
			$table->Row[0][] = $luar[$i][jml_luar];
			$jumlah[igd] += $igd[$i][jml_igd];
			$jumlah[rajal] += $rajal[$i][jml_rajal];
			$jumlah[ranap] += $ranap[$i][jml_ranap];
			$jumlah[luar] += $luar[$i][jml_luar];
		}

		//kolom terakhir
		$table->Row[0][] = $jumlah[igd];
		$table->Row[0][] = $jumlah[rajal];
		$table->Row[0][] = $jumlah[ranap];
		$table->Row[0][] = $jumlah[luar];
		$ret = $table->build();

		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][th_0] = $table->Th[0];
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][th_1] = $table->Th[1];
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][extra_th_0] = $table->extra_th[0];
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][row] = $table->Row[0];
		
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][graph] = "<img src=\"" . URL . "lab/statistik_kunjungan_semua_cara_masuk_graph_line/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[lab][statistik_kunjungan_semua_cara_masuk][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[lab][statistik_kunjungan_semua_cara_masuk][graph]);
		return $objResponse;
	}

}

$_xajax->registerFunction(array("get_kunjungan", "Statistik_Kunjungan_IGD", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Statistik_Kunjungan_IGD", "get_kunjungan_check"));
?>