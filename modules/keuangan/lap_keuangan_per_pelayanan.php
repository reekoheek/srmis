<?
$_TITLE = "Laporan Keuangan Per Pelayanan";
Class Kunjungan {

	function list_data($val) {
		unset($_SESSION[keuangan][lap_keuangan_bulanan]);
		//get data karcis dan BHP
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$title = "Laporan Keuangan Per Pelayanan";
		$title .= "\nPeriode " . tanggalIndo($val[thn_start] . "-" . $val[bln_start] . "-" . $val[tgl_start], "j F Y") . " - " . tanggalIndo($val[thn_end] . "-" . $val[bln_end] . "-" . $val[tgl_end], "j F Y");
		$sql = "
			SELECT
				CASE
					WHEN kb.lab_kunjungan_id IS NOT NULL THEN 'LAB'
					WHEN kb.radio_kunjungan_id IS NOT NULL THEN 'RADIO'
					ELSE pel.id
				END as id_pelayanan,
				CASE
					WHEN kb.lab_kunjungan_id IS NOT NULL THEN 'Laboratorium'
					WHEN kb.radio_kunjungan_id IS NOT NULL THEN 'Radiologi'
					WHEN pel.jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', pel.jenis, pel.nama)
				END as nama_pelayanan,
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
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				LEFT JOIN lab_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
				LEFT JOIN radio_kunjungan rk ON (rk.id = kb.radio_kunjungan_id)
				JOIN kwitansi kw ON (kw.id = kb.kwid)
			WHERE
				DATE(kw.tgl) BETWEEN '".$val[thn_start]."-".$val[bln_start]."-".$val[tgl_start]."' AND '".$val[thn_end]."-".$val[bln_end]."-".$val[tgl_end]."'
				AND kb.kwid IS NOT NULL
			GROUP BY
				id_pelayanan, kk.cara_bayar, lk.cara_bayar, rk.cara_bayar, kk.jenis_askes, lk.jenis_askes, rk.jenis_askes
			ORDER BY
				1
		";
		//$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();

		$table = new Table;
		$table->cellspacing = "0";
		$table->anime_bg_color = false;
		$table->addTh("No", "Pelayanan", "Cara Pembayaran", "Jumlah");
		$table->addExtraTh("rowspan=\"2\"", "rowspan=\"2\"", "colspan=\"7\"", "rowspan=\"2\"");
		$table->addTh("Umum", "Jamsostek", "Dana Reksa Desa", "Kontrak", "Askeskin", "Askes Lain", "Lain-lain");
		$table->addTh("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
		$new = array();
		$s = 0;
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id_pelayanan] == $data[$i-1][id_pelayanan]) {
				if($data[$i][cara_bayar] == "UMUM") {
					$new[$s][UMUM] += $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "JAMSOSTEK") {
					$new[$s][JAMSOSTEK] += $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "DANA REKSA DESA") {
					$new[$s][DANA_REKSA_DESA] += $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "KONTRAK") {
					$new[$s][KONTRAK] += $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "ASKES"){
					if($data[$i][jenis_askes] == "Askes Kin") {
						$new[$s][ASKESKIN] += $data[$i][bayar];
					} else {
						$new[$s][ASKES_LAIN] += $data[$i][bayar];
					}
				} else {
					$new[$s][LAIN] += $data[$i][bayar];
				}
				$new[$s][JUMLAH] += $data[$i][bayar];
			} else {
				if($i !=0 ) $s++;
				$new[$s][nama_pelayanan] = $data[$i][nama_pelayanan];
				if($data[$i][cara_bayar] == "UMUM") {
					$new[$s][UMUM] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "JAMSOSTEK") {
					$new[$s][JAMSOSTEK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "DANA REKSA DESA") {
					$new[$s][DANA_REKSA_DESA] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "KONTRAK") {
					$new[$s][KONTRAK] = $data[$i][bayar];
				} elseif($data[$i][cara_bayar] == "ASKES"){
					if($data[$i][jenis_askes] == "Askes Kin") {
						$new[$s][ASKESKIN] = $data[$i][bayar];
					} else {
						$new[$s][ASKES_LAIN] = $data[$i][bayar];
					}
				} else {
					$new[$s][LAIN] = $data[$i][bayar];
				}
				$new[$s][JUMLAH] = $data[$i][bayar];
			}
		}
		for($i=0;$i<sizeof($new);$i++) {
			$table->addRow(
				($i+1), 
				$new[$i][nama_pelayanan], 
				uangIndo($new[$i][UMUM], false), 
				uangIndo($new[$i][JAMSOSTEK], false), 
				uangIndo($new[$i][DANA_REKSA_DESA], false), 
				uangIndo($new[$i][KONTRAK], false), 
				uangIndo($new[$i][ASKESKIN], false), 
				uangIndo($new[$i][ASKES_LAIN], false), 
				uangIndo($new[$i][LAIN], false), 
				uangIndo($new[$i][JUMLAH], false)
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
			uangIndo($total[JUMLAH], false)
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