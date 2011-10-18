<?
$_TITLE = "Statistik Perkembangan Penyakit";

Class Statistik_Perkembangan_Penyakit {

	function get_kunjungan_check($val) {
		$val[tgl_periksa_tgl_start] = empty($val[tgl_periksa_tgl_start])?"1":$val[tgl_periksa_tgl_start];
		$val[tgl_periksa_bln_start] = empty($val[tgl_periksa_bln_start])?"1":$val[tgl_periksa_bln_start];
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
		unset($_SESSION[rekmed][statistik_perkembangan_penyakit]);
		$tgl_start = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_start], $val[tgl_periksa_tgl_start], $val[tgl_periksa_thn_start]));
		$tgl_end = @date("Y-m-d", @mktime(1,1,1,$val[tgl_periksa_bln_end], $val[tgl_periksa_tgl_end], $val[tgl_periksa_thn_end]));
		$title = "Statistik Perkembangan Penyakit";
		
		if($val[tampilkan] == "hari") {
			$tanggal_awal = tanggalIndo($tgl_start, "j F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "j F Y");
			$_q .= "AND DATE(kk.tgl_periksa) BETWEEN '" . $tgl_start . "' AND '" . $tgl_end . "'";
			$select = ", DATE(kk.tgl_periksa) as tgl ";
			$selisih = datediff('d', $tgl_start, $tgl_end);
		} elseif($val[tampilkan] == "bulan") {
			$tanggal_awal = tanggalIndo($tgl_start, "F Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "F Y");
			$_q .= "AND EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) BETWEEN EXTRACT(YEAR_MONTH FROM '" . $tgl_start . "') AND EXTRACT(YEAR_MONTH FROM '" . $tgl_end . "')";
			$select = ", EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) as tgl ";
			$selisih = datediff('m', $tgl_start, $tgl_end);
		} else {
			$tanggal_awal = tanggalIndo($tgl_start, "Y");
			$tanggal_akhir = tanggalIndo($tgl_end, "Y");
			$_q .= "AND YEAR(kk.tgl_periksa) BETWEEN YEAR('" . $tgl_start . "') AND YEAR ('" . $tgl_end . "')";
			$select = ", YEAR(kk.tgl_periksa) as tgl ";
			$selisih = datediff('y', $tgl_start, $tgl_end);
		}
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
		$kon->sql = "SELECT CONCAT(kode_icd, ' - ', nama) as nama FROM icd WHERE id = '".$val[icd_id]."'";
		$kon->execute();
		$penyakit = $kon->getOne();

		$kon = new Konek;
		$sql = "
			SELECT
				1 as jml
				$select
			FROM
				icd i 
				JOIN kunjungan_kamar kk ON (kk.diagnosa_utama_id = i.id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
			WHERE
				kk.kelanjutan IN('DIRUJUK', 'PULANG')
				AND i.id = '".$val[icd_id]."'
				$_q
			GROUP BY
				i.id, k.pasien_id
			ORDER BY 2 ASC, kk.id ASC
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		/*
		mengelompokkan berdasar tanggal
		*/
		$n=0;
		$new_data = array();
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][tgl] != $data[$i-1][tgl]) {
				$new_data[jml][$n] = 1;
				$new_data[tgl][$n] = $data[$i][tgl];
				$n++;
			} else {
				$new_data[jml][$n-1]++;
			}
		}
		//$objResponse->addAlert(print_r($new_data));
		$table = new Table;
		$table->scroll = false;
		//$table->addExtraTh("style=\"width:300px;\"");
		//$table->Th[0][] = "Penyakit/ Periode";
		//$table->Th[1][] = "1";
		//$table->Row[0][] = $penyakit[nama];

		for($j=0;$j<=$selisih;$j++) {
			if($val[tampilkan] == "hari") {
				$tgl[$j] = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($j+$tgl_start_tgl), $tgl_start_thn));
				$tgl_periksa = tanggalIndo($tgl[$j], "j M Y");
				$_SESSION[rekmed][statistik_perkembangan_penyakit][label_tick][$j] = @date("j", @mktime(1, 1, 1,$tgl_start_bln, ($tgl_start_tgl+$j), $tgl_start_thn));
				$label_x[$j] = @date("M Y", @mktime(1, 1, 1, $tgl_start_bln, ($tgl_start_tgl+$j), $tgl_start_thn));
			} elseif($val[tampilkan] == "bulan") {
				$tgl[$j] = @date("Ym", @mktime(1, 1, 1, ($tgl_start_bln+$j), 1, $tgl_start_thn));
				$tglx = @date("Y-m-d", @mktime(1, 1, 1, ($tgl_start_bln+$j), 1, $tgl_start_thn));
				$tgl_periksa = tanggalIndo($tglx, "M Y");
				$_SESSION[rekmed][statistik_perkembangan_penyakit][label_tick][$j] = @date("M y", @mktime(1, 1, 1, ($tgl_start_bln+$j), 1, $tgl_start_thn));
				$label_x[$j] = @date("Y", @mktime(1, 1, 1, ($tgl_start_bln+$j), 1, $tgl_start_thn));
			} else {
				$tgl[$j] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $j)));
				$tglx = @date("Y-m-d", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn + $j)));
				$tgl_periksa = tanggalIndo($tglx, "Y");
				$_SESSION[rekmed][statistik_perkembangan_penyakit][label_tick][$j] = @date("Y", @mktime(1, 1, 1, 1, 1, ($tgl_start_thn+$j)));
				$label_x[$j] = "Tahun";
			}
			$table->Th[0][] = $tgl_periksa;
			$table->Th[1][] = ($j+1);
			//cek tanggal sama
			if(is_array($new_data[tgl])) {
				if(in_array($tgl[$j], $new_data[tgl])) {
					$kunci = array_search($tgl[$j],$new_data[tgl]);
					$jml[$j] = $new_data[jml][$kunci];
				} else {
					$jml[$j] = 0;
				}
			} else {
				$jml[$j] = 0;
			}
			$table->Row[0][] = $jml[$j];
			$_SESSION[rekmed][statistik_perkembangan_penyakit][jml][] = $jml[$j];
		}

		$ret = $table->build();
		$_SESSION[rekmed][statistik_perkembangan_penyakit][th_0] = $table->Th[0];
		$_SESSION[rekmed][statistik_perkembangan_penyakit][th_1] = $table->Th[1];
		$_SESSION[rekmed][statistik_perkembangan_penyakit][row][0] = $table->Row[0];
		$title .= "\n" . $penyakit[nama];
		$title .= "\nPeriode " . $tanggal_awal . " s.d. " . $tanggal_akhir;
		$_SESSION[rekmed][statistik_perkembangan_penyakit][title] = $title;

		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$_SESSION[rekmed][statistik_perkembangan_penyakit][graph] = "<img src=\"" . URL . "rekmed/statistik_perkembangan_penyakit_graph_line/?md5=".md5(date("Ymdhis"))."\" alt=\"Kunjungan\" />";
		$_SESSION[rekmed][statistik_perkembangan_penyakit][title] = $title;
		$objResponse->addAssign("title", "innerHTML", nl2br($_SESSION[rekmed][statistik_perkembangan_penyakit][title]));
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][statistik_perkembangan_penyakit][graph]);
		return $objResponse;
	}

}

Class Diagnosa {
	
	function cari_diagnosa($hal = 0, $val) {
		$val[diagnosa] = addslashes($val[diagnosa]);
		$q = " AND (kode_icd LIKE '%".$val[diagnosa]."%' OR nama LIKE '%".$val[diagnosa]."%' OR gol_sebab_sakit LIKE '%".$val[diagnosa]."%')";
		$paging = new MyPagina;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		
		$paging->sql = "
			SELECT 
				id,
				REPLACE(UPPER(kode_icd), '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as kode_icd,
				REPLACE(UPPER(nama), '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as nama,
				REPLACE(UPPER(gol_sebab_sakit), '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as gol_sebab_sakit
			FROM 
				icd
			WHERE
				1=1 
				$q
			ORDER BY 
				kode_icd
			";
		$paging->onclick_func = "xajax_cari_diagnosa";
		$paging->setOnclickValue("xajax.getFormValues('cari_diagnosa')");
		$paging->get_page_result();

		$diagnosa_data = $paging->data;
		$diagnosa_no = $paging->start_number();
		$diagnosa_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("diagnosa_navi", "innerHTML", $diagnosa_navi);
		$table = new Table;
		$table->addTh("No", "Kode", "Nama", "Gol. Sebab Sakit");
		$table->addExtraTh("style=\"width:40px\"", "style=\"width:40px\"", "style=\"width:200px\"");
		
		for($i=0;$i<sizeof($diagnosa_data);$i++) {
			$table->addRow(($diagnosa_no+$i), $diagnosa_data[$i]['kode_icd'], $diagnosa_data[$i]['nama'], $diagnosa_data[$i]['gol_sebab_sakit']);

			$table->addOnclickTd(
				"get_diagnosa(" . $diagnosa_data[$i][id] . ", '" . htmlentities($diagnosa_data[$i]['kode_icd'] . "-" . addslashes($diagnosa_data[$i]['nama'])) . "');",
				"get_diagnosa(" . $diagnosa_data[$i][id] . ", '" . $diagnosa_data[$i]['kode_icd'] . "-" . addslashes($diagnosa_data[$i]['nama']) . "');",
				"get_diagnosa(" . $diagnosa_data[$i][id] . ", '" . $diagnosa_data[$i]['kode_icd'] . "-" . addslashes($diagnosa_data[$i]['nama']) . "');",
				"get_diagnosa(" . $diagnosa_data[$i][id] . ", '" . $diagnosa_data[$i]['kode_icd'] . "-" . addslashes($diagnosa_data[$i]['nama']) . "');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("list_diagnosa","innerHTML", $tabel);
		return $objResponse;
	}

}
$_xajax->registerFunction(array("get_kunjungan", "Statistik_Perkembangan_Penyakit", "get_kunjungan"));
$_xajax->registerFunction(array("get_kunjungan_check", "Statistik_Perkembangan_Penyakit", "get_kunjungan_check"));

//diagnosa
$_xajax->registerFunction(array("cari_diagnosa", "Diagnosa", "cari_diagnosa"));

?>