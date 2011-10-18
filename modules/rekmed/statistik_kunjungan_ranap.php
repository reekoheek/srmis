<?
$_TITLE = "Statistik Kunjungan Rawat Inap";

Class Statistik_Kunjungan_Rawat_Inap {

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
		unset($_SESSION[rekmed][statistik_kunjungan_ranap]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Statistik Kunjungan Rawat Inap";
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		if($val[pelayanan_id]) {
			$kon->sql = "SELECT nama FROM pelayanan WHERE id = '".$val[pelayanan_id]."'";
			$kon->execute();
			$poli = $kon->getOne();
			$title .= "\nBangsal " . $poli[nama];
			$q = "AND pel.id = '".$val[pelayanan_id]."'";
		}
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

		
		for($i=0;$i<=$selisih;$i++) {
			if($val[tampilkan] == "hari") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($i+$tgl_start_tgl), $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "j M\nY");
				$_SESSION[rekmed][statistik_kunjungan_ranap][label_tick][$i] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$label_x[$i] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$where = " AND DATE(kk.tgl_periksa) = '" . $tgl[$i] . "' ";
				$where_keluar = " AND DATE(kk.tgl_keluar) = '" . $tgl[$i] . "' ";
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "M\nY");
				$_SESSION[rekmed][statistik_kunjungan_ranap][label_tick][$i] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$label_x[$i] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$where = " AND EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) = EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') ";
				$where_keluar = " AND EXTRACT(YEAR_MONTH FROM kk.tgl_keluar) = EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') ";
			} else {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $i)));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "Y");
				$_SESSION[rekmed][statistik_kunjungan_ranap][label_tick][$i] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$i)));
				$label_x[$i] = "Tahun";
				$where = " AND YEAR(kk.tgl_periksa) = YEAR('" . $tgl[$i] . "') ";
				$where_keluar = " AND YEAR(kk.tgl_keluar) = YEAR('" . $tgl[$i] . "') ";
			}
			
			$sql = "
				SELECT
					COUNT(kk.id) as jml
				FROM
					kunjungan_kamar kk 
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				WHERE
					pel.jenis = 'RAWAT INAP'
					$q
					$where
				";
			$kon->sql = $sql;
			$kon->execute();
			$masuk[$i] = $kon->getOne();
			if(!$masuk[$i][jml]) $masuk[$i][jml] = 0;

			$_SESSION[rekmed][statistik_kunjungan_ranap][jml_masuk][$i] = $masuk[$i][jml];
			$_SESSION[rekmed][statistik_kunjungan_ranap][tgl_periksa][$i] = $tgl_periksa[$i];
			

			//GET DATA PX KELUAR
			$sql2 = "
				SELECT
					COUNT(kk.id) as jml
				FROM
					kunjungan_kamar kk 
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				WHERE
					pel.jenis = 'RAWAT INAP'
					$q
					$where_keluar
				";
			$kon->sql = $sql2;
			$kon->execute();
			$keluar[$i] = $kon->getOne();
			if(!$keluar[$i][jml]) $keluar[$i][jml] = 0;

			$_SESSION[rekmed][statistik_kunjungan_ranap][jml_keluar][$i] = $keluar[$i][jml];

		}
		//$objResponse->addAlert(print_r($lama));
		$_SESSION[rekmed][statistik_kunjungan_ranap][title] = $title . "\nPeriode " . tanggalIndo($tgl_start, "j F Y") . " s.d. " . tanggalIndo($tgl_end, "j F Y");
		$labelx = @array_unique($label_x);
		$_SESSION[rekmed][statistik_kunjungan_ranap][label_x] = @implode(", ",$labelx);

		$table = new Table;
		$table->scroll = false;
		for($i=0;$i<=$selisih;$i++) {
			$table->Th[0][] = $tgl_periksa[$i];
			$table->extra_th[0][] = "colspan=\"2\"";
			$table->Row[0][$i*2] = $masuk[$i][jml];
			$table->Row[0][$i*2+1] = $keluar[$i][jml];	
		}
		for($i=0;$i<=($selisih*2+1);$i++) {
			$x = $i;
			if($i % 2 == 0) {
				$table->Th[1][] = "Masuk";
			} else {
				$table->Th[1][] = "Keluar";
			}
			$table->Th[2][] = ($i+1);		
		}
		$ret = $table->build();

		$_SESSION[rekmed][statistik_kunjungan_ranap][th_0] = $table->Th[0];
		$_SESSION[rekmed][statistik_kunjungan_ranap][th_1] = $table->Th[1];
		$_SESSION[rekmed][statistik_kunjungan_ranap][extra_th_0] = $table->extra_th[0];
		$_SESSION[rekmed][statistik_kunjungan_ranap][row] = $table->Row[0];
		
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[rekmed][statistik_kunjungan_ranap][graph] = "<img src=\"" . URL . "rekmed/statistik_kunjungan_ranap_graph_bar/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[rekmed][statistik_kunjungan_ranap][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_kunjungan_ranap][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_kunjungan_ranap][graph]);
		return $objResponse;
	}

}
$kon = new Konek;
$kon->sql = "SELECT id, nama FROM pelayanan WHERE jenis = 'RAWAT INAP' ORDER BY nama";
$kon->execute();
$data_poli = $kon->getAll();

$_xajax->registerFunction(array("get_kunjungan", "Statistik_Kunjungan_Rawat_Inap", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Statistik_Kunjungan_Rawat_Inap", "get_kunjungan_check"));
?>