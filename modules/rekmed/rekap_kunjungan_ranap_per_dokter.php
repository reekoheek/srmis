<?
$_TITLE = "Rata-rata Pasien Dirawat per Dokter";

Class Lap_Jml_Kunjungan_Per_Pelayanan {

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
		unset($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Rata-rata Pasien Dirawat per Dokter";
		
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
	
		for($i=0;$i<=$selisih;$i++) {
			if($val[tampilkan] == "hari") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($i+$tgl_start_tgl), $tgl_start_thn));
				$data[$i][tgl_periksa] = tanggalIndo($tgl[$i], "j F Y");
				$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_tick][$i] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$label_x[$i] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$i), $tgl_start_thn));
				$where = " AND DATE(kk.tgl_daftar) <= '" . $tgl[$i] . "' AND (DATE(kk.tgl_keluar) >= '".$tgl[$i]."' OR kk.tgl_keluar IS NULL)";
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$data[$i][tgl_periksa] = tanggalIndo($tgl[$i], "F Y");
				$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_tick][$i] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$label_x[$i] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$i), 1, $tgl_start_thn));
				$where = " AND EXTRACT(YEAR_MONTH FROM kk.tgl_daftar) <= EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "')  AND (EXTRACT(YEAR_MONTH FROM kk.tgl_keluar) >= EXTRACT(YEAR_MONTH FROM '" . $tgl[$i] . "') OR kk.tgl_keluar IS NULL)";
			} else {
				$tgl[$i] = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $i)));
				$data[$i][tgl_periksa] = tanggalIndo($tgl[$i], "Y");
				$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_tick][$i] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$i)));
				$label_x[$i] = "Tahun";
				$where = " AND YEAR(kk.tgl_daftar) = YEAR('" . $tgl[$i] . "')  AND (YEAR(kk.tgl_keluar) >= YEAR('" . $tgl[$i] . "') OR kk.tgl_keluar IS NULL)";
			}
			$sql = "
				SELECT
					kk.dokter_id as dokter_id,
					COUNT(kk.id) as jml_px
				FROM
					kunjungan_kamar kk 
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				WHERE
					pel.jenis = 'RAWAT INAP'
					$where
				GROUP BY
					kk.dokter_id
				ORDER BY
					kk.dokter_id
				";
			$kon->sql = $sql;
			$kon->execute();
			$baru[$i] = $kon->getAll();
		}
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][title] = $title . "\nPeriode " . tanggalIndo($tgl_start, "j F Y") . " s.d. " . tanggalIndo($tgl_end, "j F Y");
		$labelx = @array_unique($label_x);
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][label_x] = @implode(", ",$labelx);
		$new = array();
		for($i=0;$i<sizeof($baru);$i++) {
			if(empty($baru[$i])) {
				$new[jml_px][$i] = 0;
				$new[jml_dokter][$i] = 0;
			} else {
				for($s=0;$s<sizeof($baru[$i]);$s++) {
					if($baru[$i][$s][dokter_id] == $baru[$i][$s-1][dokter_id]) {
						$new[jml_dokter][$i] += 1;
						$new[jml_px][$i] += $baru[$i][$s][jml_px];
					} else {
						//bikin embok
						$new[jml_dokter][$i] += 1;
						$new[jml_px][$i] += $baru[$i][$s][jml_px];
					}
				}
			}
		}

		//print_r($new);
		$table = new Table;
		$table->scroll = false;
		$table->addExtraTh("style=\"width:300px;\"");
		$table->Th[0][] = "Parameter/ Periode";
		$table->Th[1][] = "1";
		for($i=0;$i<=$selisih;$i++) {
			$table->Th[0][] = $data[$i][tgl_periksa];
			$table->Th[1][] = ($i+2);
		}
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][th_0] = $table->Th[0];
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][th_1] = $table->Th[1];

		$table->Row[0][] = "Rata-rata Jumlah Pasien yang Dirawat/Dokter";
		$table->Row[1][] = "Jumlah Dokter yang Merawat";
		$table->Row[2][] = "Jumlah Pasien yang Dirawat";
		for($i=0;$i<sizeof($new[jml_dokter]);$i++) {
			//rata-rata
			$table->Row[0][] = @round($new[jml_px][$i]/$new[jml_dokter][$i]);
			//jumlah dokter
			$table->Row[1][] = $new[jml_dokter][$i];
			$table->Row[2][] = $new[jml_px][$i];
			$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][rata][$i] = @round($new[jml_px][$i]/$new[jml_dokter][$i]);
		}
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][row] = $table->Row;
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][jml_dokter] = $new[jml_dokter];
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][jml_px] = $new[jml_px];

		$ret = $table->build();
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][graph] = "<img src=\"" . URL . "rekmed/rekap_kunjungan_ranap_per_dokter_graph_line/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][graph]);
		return $objResponse;
	}

}

$_xajax->registerFunction(array("get_kunjungan", "Lap_Jml_Kunjungan_Per_Pelayanan", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Lap_Jml_Kunjungan_Per_Pelayanan", "get_kunjungan_check"));
?>