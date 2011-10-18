<?
$_TITLE = "Statistik Kunjungan Radiologi";

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
		unset($_SESSION[radio][statistik_kunjungan_radio]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Statistik Kunjungan Radiologi";
		
		if($val[tampilkan] == "hari") {
			$selisih = datediff('d', $tgl_start, $tgl_end);
		} elseif($val[tampilkan] == "bulan") {
			$selisih = datediff('m', $tgl_start, $tgl_end);
		} else {
			$selisih = datediff('y', $tgl_start, $tgl_end);
		}
		if($val[tampilkan] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
		} elseif($val[tampilkan] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
		} else {
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
		$kon->sql = "SELECT id, nama, hari_buka FROM pelayanan WHERE jenis = 'RAWAT JALAN'";
		$kon->execute();
		$poli = $kon->getAll();
		
		for($i=0;$i<=$selisih;$i++) {
			if($val[tampilkan] == "hari") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($i+$tgl_start_tgl), $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "j M\nY");
				$_SESSION[radio][statistik_kunjungan_radio][radioel_tick][$i] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$radioel_x[$i] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$where = " AND DATE(lk.tgl_periksa) = '" . $tgl[$i] . "' ";
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "M\nY");
				$_SESSION[radio][statistik_kunjungan_radio][radioel_tick][$i] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$radioel_x[$i] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$where = " AND EXTRACT(YEAR_MONTH FROM lk.tgl_periksa) = EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') ";
			} else {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $i)));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "Y");
				$_SESSION[radio][statistik_kunjungan_radio][radioel_tick][$i] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$i)));
				$radioel_x[$i] = "Tahun";
				$where = " AND YEAR(lk.tgl_periksa) = YEAR('" . $tgl[$i] . "') ";
			}
			
			$sql = "
				SELECT
					COUNT(lk.id) as jml_baru
				FROM
					radio_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					DATE(lk.tgl_daftar) = DATE(p.tgl_daftar)
					$where
				";
			$kon->sql = $sql;
			$kon->execute();
			$baru[$i] = $kon->getOne();
			if(!$baru[$i][jml_baru]) $baru[$i][jml_baru] = 0;

			$sql = "
				SELECT
					COUNT(lk.id) as jml_lama
				FROM
					radio_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					DATE(lk.tgl_daftar) <> DATE(p.tgl_daftar)
					$where
				";
			$kon->sql = $sql;
			$kon->execute();
			$lama[$i] = $kon->getOne();
			if(!$lama[$i][jml_lama]) $lama[$i][jml_lama] = 0;

			//dari IRD
			$kon->sql = "
				SELECT
					COUNT(lk.id) as jml_igd
				FROM
					radio_kunjungan lk 
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
					radio_kunjungan lk 
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
					radio_kunjungan lk 
					JOIN pasien p ON (p.id = lk.pasien_id)
				WHERE
					lk.cara_masuk = 'RAWAT INAP'
					$where
			";
			$kon->execute();
			$ranap[$i] = $kon->getOne();
			if(!$ranap[$i][jml_ranap]) $ranap[$i][jml_ranap] = "-";


			$_SESSION[radio][statistik_kunjungan_radio][jml_baru][$i] = $baru[$i][jml_baru];
			$_SESSION[radio][statistik_kunjungan_radio][jml_lama][$i] = $lama[$i][jml_lama];

			$_SESSION[radio][statistik_kunjungan_radio][jml_igd][$i] = $igd[$i][jml_igd];
			$_SESSION[radio][statistik_kunjungan_radio][jml_rajal][$i] = $rajal[$i][jml_rajal];
			$_SESSION[radio][statistik_kunjungan_radio][jml_ranap][$i] = $ranap[$i][jml_ranap];

			$_SESSION[radio][statistik_kunjungan_radio][tgl_periksa][$i] = $tgl_periksa[$i];
		}
		//$objResponse->addAlert(print_r($lama));
		$_SESSION[radio][statistik_kunjungan_radio][title] = $title . "\nPeriode " . tanggalIndo($tgl_start, "j F Y") . " s.d. " . tanggalIndo($tgl_end, "j F Y");
		$radioelx = @array_unique($radioel_x);
		$_SESSION[radio][statistik_kunjungan_radio][radioel_x] = @implode(", ",$radioelx);

		$table = new Table;
		$table->scroll = false;
		//$table->Th[0][] = "Pelayanan";
		//$table->extra_th[0][] = "rowspan=\"2\"";
		for($i=0;$i<=$selisih;$i++) {
			$table->Th[0][] = $tgl_periksa[$i];
			$table->extra_th[0][] = "colspan=\"2\"";
		}
		$table->Th[0][] = "Jumlah";
		$table->extra_th[0][] = "colspan=\"2\"";
		$kolom = $selisih*2+1;
		for($i=0;$i<=$kolom;$i++) {
			if($i%2 == 0) {
				$table->Th[1][] = "Lama";
			} else $table->Th[1][] = "Baru";
		}
		//kolom jumlah
		$table->Th[1][] = "Lama";
		$table->Th[1][] = "Baru";

		//isinya
		//$table->Row[0][0] = "IGD";
		for($i=0;$i<=$selisih;$i++) {
			$table->Row[0][] = $lama[$i][jml_lama];
			$table->Row[0][] = $baru[$i][jml_baru];
			$jumlah[lama] += $lama[$i][jml_lama];
			$jumlah[baru] += $baru[$i][jml_baru];
		}

		//kolom terakhir
		$table->Row[0][] = $jumlah[lama];
		$table->Row[0][] = $jumlah[baru];
		$ret = $table->build();

		$_SESSION[radio][statistik_kunjungan_radio][th_0] = $table->Th[0];
		$_SESSION[radio][statistik_kunjungan_radio][th_1] = $table->Th[1];
		$_SESSION[radio][statistik_kunjungan_radio][extra_th_0] = $table->extra_th[0];
		$_SESSION[radio][statistik_kunjungan_radio][row] = $table->Row[0];
		
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[radio][statistik_kunjungan_radio][graph] = "<img src=\"" . URL . "radio/statistik_kunjungan_radio_graph_bar/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[radio][statistik_kunjungan_radio][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[radio][statistik_kunjungan_radio][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[radio][statistik_kunjungan_radio][graph]);
		return $objResponse;
	}

}

$_xajax->registerFunction(array("get_kunjungan", "Statistik_Kunjungan_IGD", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Statistik_Kunjungan_IGD", "get_kunjungan_check"));
?>