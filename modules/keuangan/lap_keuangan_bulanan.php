<?
$_TITLE = "Laporan Keuangan Bulanan";
Class Kunjungan {

	function list_data($val) {
		unset($_SESSION[keuangan][lap_keuangan_bulanan]);
		//get data karcis dan BHP
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$title = "Laporan Keuangan Bulanan";
		$title .= "\nTahun " . $val[tahun];
		$sql = "
			SELECT
				MONTH(kw.tgl) as bulan,
				SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as bayar,
				CASE
					WHEN rk.cara_bayar IS NOT NULL THEN rk.cara_bayar
					WHEN lk.cara_bayar IS NOT NULL THEN lk.cara_bayar
					ELSE kk.cara_bayar
				END as cara_bayar,
				CASE
					WHEN rk.jenis_askes IS NOT NULL THEN rk.jenis_askes
					WHEN lk.jenis_askes IS NOT NULL THEN lk.jenis_askes
					ELSE kk.jenis_askes
				END as jenis_askes
			FROM
				kunjungan_bayar kb
				LEFT JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
				LEFT JOIN lab_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
				LEFT JOIN radio_kunjungan rk ON (rk.id = kb.radio_kunjungan_id)
				JOIN kwitansi kw ON (kw.id = kb.kwid)
			WHERE
				YEAR(kw.tgl) = '".$val[tahun]."'
				AND kb.kwid IS NOT NULL
			GROUP BY
				MONTH(kw.tgl), kk.cara_bayar, lk.cara_bayar, rk.cara_bayar, kk.jenis_askes, lk.jenis_askes, rk.jenis_askes
			ORDER BY
				MONTH(kw.tgl)
		";
		//$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();

		$table = new Table;
		$table->cellspacing = "0";
		$table->anime_bg_color = false;
		$table->addTh("No", "Bulan", "Cara Pembayaran", "Jumlah", "Kumulatif", "Target", "% Pendapatan", "% Kumulatif");
		$table->addExtraTh("rowspan=\"2\"", "rowspan=\"2\"", "colspan=\"7\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"");
		$table->addTh("Umum", "Jamsostek", "Dana Reksa Desa", "Kontrak", "Askeskin", "Askes Lain", "Lain-lain");
		$table->addTh("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14");
		$new = array();
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][bulan] == $data[$i-1][bulan]) {
				if($data[$i][cara_bayar] == "UMUM") {
					$new[$data[$i][bulan]][UMUM] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "JAMSOSTEK") {
					$new[$data[$i][bulan]][JAMSOSTEK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "DANA REKSA DESA") {
					$new[$data[$i][bulan]][DANA_REKSA_DESA] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "KONTRAK") {
					$new[$data[$i][bulan]][KONTRAK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "ASKES"){
					if($data[$i][jenis_askes] == "Askes Kin") {
						$new[$data[$i][bulan]][ASKESKIN] = $data[$i][bayar];
					} else {
						$new[$data[$i][bulan]][ASKES_LAIN] = $data[$i][bayar];
					}
				} else {
					$new[$data[$i][bulan]][LAIN] = $data[$i][bayar];
				}
				$new[$data[$i][bulan]][JUMLAH] += $data[$i][bayar];
			} else {
				if($data[$i][cara_bayar] == "UMUM") {
					$new[$data[$i][bulan]][UMUM] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "JAMSOSTEK") {
					$new[$data[$i][bulan]][JAMSOSTEK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "DANA REKSA DESA") {
					$new[$data[$i][bulan]][DANA_REKSA_DESA] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "KONTRAK") {
					$new[$data[$i][bulan]][KONTRAK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "ASKES"){
					if($data[$i][jenis_askes] == "Askes Kin") {
						$new[$data[$i][bulan]][ASKESKIN] = $data[$i][bayar];
					} else {
						$new[$data[$i][bulan]][ASKES_LAIN] = $data[$i][bayar];
					}
				} else {
					$new[$data[$i][bulan]][LAIN] = $data[$i][bayar];
				}
				$new[$data[$i][bulan]][JUMLAH] = $data[$i][bayar];
			}
		}
		for($i=1;$i<13;$i++) {
			$bulan = bulanIndo($i, "F");
			$kumulatif += $new[$i][JUMLAH];
			$persen_pendapatan = @round($new[$i][JUMLAH]*100/$kumulatif,2);
			$persen_kumulatif = @round($kumulatif*100/$val["bulan_" . $i],2);

			$table->addRow(
				$i, 
				$bulan, 
				uangIndo($new[$i][UMUM], false), 
				uangIndo($new[$i][JAMSOSTEK], false), 
				uangIndo($new[$i][DANA_REKSA_DESA], false), 
				uangIndo($new[$i][KONTRAK], false), 
				uangIndo($new[$i][ASKESKIN], false), 
				uangIndo($new[$i][ASKES_LAIN], false), 
				uangIndo($new[$i][LAIN], false), 
				uangIndo($new[$i][JUMLAH], false), 
				uangIndo($kumulatif, false), 
				uangIndo($val["bulan_" . $i], false), 
				uangIndo($persen_pendapatan, false), 
				uangIndo($persen_kumulatif)
			);
			$table->addExtraTd(
				"",
				"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\"",
				"style=\"text-align:right\""
			);

			$total[UMUM] += $new[$i][UMUM];
			$total[JAMSOSTEK] += $new[$i][JAMSOSTEK];
			$total[DANA_REKSA_DESA] += $new[$i][DANA_REKSA_DESA];
			$total[KONTRAK] += $new[$i][KONTRAK];
			$total[ASKESKIN] += $new[$i][ASKESKIN];
			$total[ASKES_LAIN] += $new[$i][ASKES_LAIN];
			$total[LAIN] += $new[$i][LAIN];
			$total[JUMLAH] += $new[$i][JUMLAH];
			$total[kumulatif] += $kumulatif;
			$total[target] += $val["bulan_" . $i];
			
			$table->addExtraTr("onclick=\"setBg(this);\"");
		}
		$table->addTfoot(
			"TOTAL",
			uangIndo($total[UMUM], false),
			uangIndo($total[JAMSOSTEK], false),
			uangIndo($total[DANA_REKSA_DESA], false),
			uangIndo($total[KONTRAK], false),
			uangIndo($total[ASKESKIN], false),
			uangIndo($total[ASKES_LAIN], false),
			uangIndo($total[LAIN], false),
			uangIndo($total[JUMLAH], false),
			uangIndo($total[kumulatif], false),
			uangIndo($total[target], false),
			"-","-"
		);
		$table->addExtraTfoot("colspan=\"2\"");
		$content = $table->build();
		$judul = nl2br($title);
		//$objResponse->addAlert(print_r($new));
		$objResponse->addAssign("title", "innerHTML", $judul);
		$objResponse->addAssign("list_data", "innerHTML", $content);
		$_SESSION[keuangan][lap_keuangan_bulanan][title] = $judul;
		$_SESSION[keuangan][lap_keuangan_bulanan][content] = $content;
		return $objResponse;
	}
}


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
include AJAX_REF_DIR . "kunjungan.php";
?>