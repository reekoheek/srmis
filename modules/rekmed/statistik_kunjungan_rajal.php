<?
$_TITLE = "Statistik Kunjungan Rawat Jalan";

Class Statistik_Kunjungan_Rawat_Jalan {

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
		unset($_SESSION[rekmed][statistik_kunjungan_rajal]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Statistik Kunjungan Rawat Jalan";
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		if($val[pelayanan_id]) {
			$kon->sql = "SELECT nama FROM pelayanan WHERE id = '".$val[pelayanan_id]."'";
			$kon->execute();
			$poli = $kon->getOne();
			$title .= "\nPoliklinik " . $poli[nama];
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
				$_SESSION[rekmed][statistik_kunjungan_rajal][label_tick][$i] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$label_x[$i] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$where = " AND DATE(kk.tgl_periksa) = '" . $tgl[$i] . "' ";
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "M\nY");
				$_SESSION[rekmed][statistik_kunjungan_rajal][label_tick][$i] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$label_x[$i] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$where = " AND EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) = EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') ";
			} else {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $i)));
				$tgl_periksa[$i] = tanggalIndo($tgl[$i], "Y");
				$_SESSION[rekmed][statistik_kunjungan_rajal][label_tick][$i] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$i)));
				$label_x[$i] = "Tahun";
				$where = " AND YEAR(kk.tgl_periksa) = YEAR('" . $tgl[$i] . "') ";
			}
			
			$sql = "
				SELECT
					COUNT(kk.id) as jml_baru
				FROM
					kunjungan_kamar kk 
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				WHERE
					DATE(kk.tgl_periksa) = DATE(p.tgl_daftar)
					AND pel.jenis = 'RAWAT JALAN'
					$q
					$where
				";
			$kon->sql = $sql;
			$kon->execute();
			$baru[$i] = $kon->getOne();
			if(!$baru[$i][jml_baru]) $baru[$i][jml_baru] = 0;

			$sql = "
				SELECT
					COUNT(kk.id) as jml_lama
				FROM
					kunjungan_kamar kk 
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				WHERE
					DATE(kk.tgl_periksa) <> DATE(p.tgl_daftar)
					AND pel.jenis = 'RAWAT JALAN'
					$q
					$where
				";
			$kon->sql = $sql;
			$kon->execute();
			$lama[$i] = $kon->getOne();
			if(!$lama[$i][jml_lama]) $lama[$i][jml_lama] = 0;

			$_SESSION[rekmed][statistik_kunjungan_rajal][jml_baru][$i] = $baru[$i][jml_baru];
			$_SESSION[rekmed][statistik_kunjungan_rajal][jml_lama][$i] = $lama[$i][jml_lama];
			$_SESSION[rekmed][statistik_kunjungan_rajal][tgl_periksa][$i] = $tgl_periksa[$i];
		}
		//$objResponse->addAlert(print_r($lama));
		$_SESSION[rekmed][statistik_kunjungan_rajal][title] = $title . "\nPeriode " . tanggalIndo($tgl_start, "j F Y") . " s.d. " . tanggalIndo($tgl_end, "j F Y");
		$labelx = @array_unique($label_x);
		$_SESSION[rekmed][statistik_kunjungan_rajal][label_x] = @implode(", ",$labelx);

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
			$table->Th[2][] = $i+1;
		}
		$table->Th[2][] = $i+1;
		$table->Th[2][] = $i+2;
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

		$_SESSION[rekmed][statistik_kunjungan_rajal][th_0] = $table->Th[0];
		$_SESSION[rekmed][statistik_kunjungan_rajal][th_1] = $table->Th[1];
		$_SESSION[rekmed][statistik_kunjungan_rajal][extra_th_0] = $table->extra_th[0];
		$_SESSION[rekmed][statistik_kunjungan_rajal][row] = $table->Row[0];
		
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[rekmed][statistik_kunjungan_rajal][graph] = "<img src=\"" . URL . "rekmed/statistik_kunjungan_rajal_graph_bar/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[rekmed][statistik_kunjungan_rajal][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_kunjungan_rajal][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_kunjungan_rajal][graph]);
		return $objResponse;
	}

}
$kon = new Konek;
$kon->sql = "SELECT id, nama FROM pelayanan WHERE jenis = 'RAWAT JALAN' ORDER BY nama";
$kon->execute();
$data_poli = $kon->getAll();

$_xajax->registerFunction(array("get_kunjungan", "Statistik_Kunjungan_Rawat_Jalan", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Statistik_Kunjungan_Rawat_Jalan", "get_kunjungan_check"));
?>