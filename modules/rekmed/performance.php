<?
$_TITLE = "Performance Rumah Sakit";

Class Laporan_Performance {

	function get_performance($val) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;

		/*
			I : 1 januari - 31 maret
			II : 1 april - 30 juni
			III : 1 juli - 30 september
			IV : 1 oktober - 31 desember
		*/

		switch($val[tw]) {
			case "I" : 
				$tgl_awal = $val[tahun] . "-01-01";
				$tgl_akhir = $val[tahun] . "-03-31";
				$tgl_start_bln = 1;
			break;
			case "II" : 
				$tgl_awal = $val[tahun] . "-04-01";
				$tgl_akhir = $val[tahun] . "-06-30";
				$tgl_start_bln = 4;
			break;
			case "III" : 
				$tgl_awal = $val[tahun] . "-07-01";
				$tgl_akhir = $val[tahun] . "-09-30";
				$tgl_start_bln = 7;
			break;
			case "IV" : 
				$tgl_awal = $val[tahun] . "-10-01";
				$tgl_akhir = $val[tahun] . "-12-31";
				$tgl_start_bln = 10;
			break;
			default :
				// 1 tahun
				$tgl_awal = $val[tahun] . "-01-01";
				$tgl_akhir = $val[tahun] . "-12-31";
				$tgl_start_bln = 1;
			break;
		}
		$selisih_hari = datediff("d", $tgl_awal, $tgl_akhir);

		if($val[kelas]) {
			$qkelas = "AND kmr.kelas = '".$val[kelas]."'";
			$title_kelas = "Kelas " . $val[kelas] . "<br />";
		}
		else $qkelas = "";

		/* 
		get px awal triwulan ~ pasien sisa / pasien yg masih dirawat
		syarat : tgl masuk < tgl_awal 
				 tgl_keluar > tgl_awal
		*/
		$kon->sql = "
			SELECT 
				COUNT(kk.id) as jml
			FROM
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_daftar) < '".$tgl_awal."' AND (DATE(kk.tgl_keluar) >= '".$tgl_awal."' OR kk.tgl_keluar IS NULL))
				$qkelas
		";
		$kon->execute();
		$px_awal = $kon->getOne();
		$total[px_awal] += $px_awal[jml];

		/* 
		get px masuk
		ASUMSI SEMENTARA : PASIEN PINDAHAN DIHITUNG
		syarat : tgl masuk diantara tgl_awal dan tgl_keluar
		*/
		$kon->sql = "
			SELECT 
				COUNT(kk.id) as jml
			FROM
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_daftar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				$qkelas
		";
		$kon->execute();
		$px_masuk = $kon->getOne();
		$total[px_masuk] += $px_masuk[jml];

		/* 
		get px keluar 
		syarat : tgl keluar diantara tgl_awal dan tgl_keluar dan keadaan keluar = sembuh, belum sembuh
		*/
		$kon->sql = "
			SELECT 
				COUNT(kk.id) as jml,
				k.keadaan_keluar as keadaan_keluar
			FROM
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_keluar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				$qkelas
			GROUP BY kk.id
		";
		$kon->execute();
		$px_keluar = $kon->getAll();
		for($j=0;$j<sizeof($px_keluar);$j++) {
			switch($px_keluar[$j][keadaan_keluar]) {
				case "MATI < 48 JAM" :
					$total[px_keluar_mati_kurang_dari] += $px_keluar[$j][jml];
					$total[px_keluar_mati] += $px_keluar[$j][jml];
				break;
				case "MATI >= 48 JAM" :
					$total[px_keluar_mati_lebih_dari] += $px_keluar[$j][jml];
					$total[px_keluar_mati] += $px_keluar[$j][jml];
				break;
				default :
					$total[px_keluar_hidup] += $px_keluar[$j][jml];
				break;
			}
		}
		$total[px_keluar] = $total[px_keluar_mati] + $total[px_keluar_hidup];

		/* 
		get jumlah lama dirawat ~ lamanya seorang pasien dirawat
		syarat : tgl keluar diantara tgl_awal dan tgl_keluar 
				 hitung tgl_keluar-tanggal_daftar
				 
		cara : cari dulu px yg keluar pada tw tsb
			   hitung tgl_keluar-tanggal_daftar
			   jika tgl_keluar = tgl_daftar -> dihitung 1 hari lama dirawat
		*/
		$kon->sql = "
			SELECT 
				kk.id as kkid,
				CASE
					WHEN (DATE(kk.tgl_daftar) = DATE(kk.tgl_keluar)) THEN 1
					ELSE DATEDIFF(kk.tgl_keluar, kk.tgl_daftar)
				END as jml
			FROM
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_keluar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				$qkelas
			GROUP BY kk.id
		";
		$kon->execute();
		$ld = $kon->getAll();
		for($j=0;$j<sizeof($ld);$j++) {
			$total[lama_dirawat] += $ld[$j][jml];
		}

		/* 
		get px akhir triwulan ~ pasien sisa / pasien yg masih dirawat
		syarat : tgl masuk < tgl_akhir 
				 tgl_keluar > tgl_akhir
		*/
		$kon->sql = "
			SELECT 
				COUNT(kk.id) as jml
			FROM
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_daftar) < '".$tgl_akhir."' AND (DATE(kk.tgl_keluar) > '".$tgl_akhir."' OR kk.tgl_keluar IS NULL))
				$qkelas
		";
		$kon->execute();
		$px_akhir = $kon->getOne();
		$total[px_akhir] += $px_akhir[jml];

		/* 
		get jumlah hari perawatan ~ pasien sisa per hari
		sampe sini
		*/
		//sampe sini 7/4/2007 
		for($j=0;$j<=$selisih_hari;$j++) {
			$tgl = @date("Y-m-d", @mktime(1, 1, 1, $tgl_start_bln, ($j+1), $val[tahun]));
			$kon->sql = "
				SELECT 
					COUNT(kk.id) as jml,
					kmr.kelas as kelas
				FROM
					kunjungan_kamar kk
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pelayanan pel ON (kmr.pelayanan_id = pel.id)
				WHERE
					pel.jenis = 'RAWAT INAP'
					AND (DATE(kk.tgl_daftar) <= '".$tgl."' AND (DATE(kk.tgl_keluar) > '".$tgl."' OR kk.tgl_keluar IS NULL))
					$qkelas
				GROUP BY kmr.kelas
			";
			$kon->execute();
			$px_hari_ini[$j] = $kon->getAll();
			for($k=0;$k<sizeof($px_hari_ini[$j]);$k++) {
				$total[hp_total] += $px_hari_ini[$j][$k][jml];
			}
		}

		$kon->sql = "SELECT SUM(kmr.jml_bed) as jml FROM kamar kmr WHERE 1=1 " . $qkelas;
		$kon->execute();
		$tt = $kon->getOne();
//
		/*
		BOR = (jml hari perawatan / jml TT * jml hari) * 100%;
		AvLOS = (jml lama dirawat / jml px keluar)
		BTO = jml px keluar / jml TT
		TOI = (jml TT * periode - jml HP)/ jml px keluar
		GDR = (jml px mati/ jml px keluar) x 1000 permil
		NDR = (jml px mati > 48 jam/ jml px keluar) x 1000 permil
		RATA2 kunjungan poliklinik
		*/
		$per = array();
		unset($_SESSION[rekmed][performance]);
		$selisih_hari = $selisih_hari + 1;
		$per[bor] = @round(($total[hp_total]*100) / ($tt[jml] * $selisih_hari), 2);
		$per[avlos] = @round($total[lama_dirawat] / $total[px_keluar]);
		$per[bto] = @round($total[px_keluar] / $tt[jml], 2);
		$per[toi] = @round(($tt[jml] * $selisih_hari - $total[hp_total]) / $total[px_keluar]);
		$per[gdr] = @round(($total[px_keluar_mati] * 1000) / $total[px_keluar], 2);
		$per[ndr] = @round(($total[px_keluar_mati_lebih_dari] * 1000) / $total[px_keluar], 2);
		$title = "Performance Rumah Sakit<br />".$title_kelas."Periode Triwulan " . $val[tw] . " Tahun " . $val[tahun];
		$objResponse->addAssign("performance_title", "innerHTML", $title);
		$_SESSION[rekmed][performance][graph] = "<img src=\"" . URL . "rekmed/barber_johnson/?md5=".md5(date("Ymdhis"))."\" alt=\"Barber Johnson\" />";
		$_SESSION[rekmed][performance][graph_resize] = "<img src=\"" . URL . "rekmed/barber_johnson/?md5=".md5(date("Ymdhis"))."\" alt=\"Barber Johnson\" height=\"600\"/>";
		$_SESSION[rekmed][performance][per] = $per;
		$objResponse->addAssign("graph", "innerHTML", $_SESSION[rekmed][performance][graph]);

		$table = new Table;
		$table->scroll = false;
		$table->addTh("Indikator", "Nilai", "Nilai Standar");
		$table->addRow("BOR", $per[bor] . " %", "60 - 85 %");
		$table->addRow("AvLOS", $per[avlos] . " hari", "6 - 9 hari");
		$table->addRow("BTO", $per[bto] . " kali per triwulan", "40 - 50 kali per tahun");
		$table->addRow("TOI", $per[toi] . " hari", "1 - 3 hari");
		$table->addRow("GDR", $per[gdr] . " &permil;", "45 &permil;");
		$table->addRow("NDR", $per[ndr] . " &permil;", "25 &permil;");
		$_SESSION[rekmed][performance][bj] = $per;
		$_SESSION[rekmed][performance][bj][selisih_hari] = $selisih_hari;
		$_SESSION[rekmed][performance][selisih_hari] = $selisih_hari;
		$_SESSION[rekmed][performance][title] = $title;
		$_SESSION[rekmed][performance][th_0] = $table->Th[0];
		$_SESSION[rekmed][performance][row] = $table->Row;
		$ret = $table->build();
		$objResponse->addAssign("performance_list_data", "innerHTML", $ret);

		$objResponse->addAssign("performance_param_title", "innerHTML", "Parameter Performance Rumah Sakit<br />".$title_kelas."Periode Triwulan " . $val[tw] . " Tahun " . $val[tahun]);
		$table_param = new Table;
		$table_param->scroll = false;
		$table_param->addTh("Parameter", "Nilai");
		$table_param->addRow("Total Lama Dirawat", $total[lama_dirawat]);
		$table_param->addRow("Total Hari Perawatan", $total[hp_total]);
		$table_param->addRow("Pasien Keluar Mati Lebih Dari", $total[px_keluar_mati_lebih_dari]);
		$table_param->addRow("Pasien Keluar", $total[px_keluar]);
		$table_param->addRow("Jumlah TT", $tt[jml]);
		$table_param->addRow("Jumlah Hari", $selisih_hari);
		$ret2 = $table_param->build();
		$objResponse->addAssign("performance_param_list_data", "innerHTML", $ret2);

//
		return $objResponse;
	}
}
$_xajax->registerFunction(array("get_performance", "Laporan_Performance", "get_performance"));
?>