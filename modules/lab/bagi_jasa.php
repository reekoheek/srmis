<?
$_TITLE = "Laporan Pembagian Jasa Laboratorium";
Class Kunjungan {

	function list_data($val) {
		unset($_SESSION[lab][pendapatan]);
		//get data karcis dan BHP
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$title = "Laporan Pembagian Jasa Laboratorium";
		if($val[jangka_waktu] == "tahun") {
			$q = "AND YEAR(kw.tgl) BETWEEN '".$val[thn_start]."' AND '".$val[thn_end]."'";
			$title .= "\nPeriode " . $val[thn_start] . " - " . $val[thn_end];
		} elseif($val[jangka_waktu] == "bulan") {
			$q = "AND EXTRACT(YEAR_MONTH FROM kw.tgl) BETWEEN '".$val[thn_start].$val[bln_start]."' AND '".$val[thn_end].$val[bln_end]."'";
			$title .= "\nPeriode " . bulanIndo($val[bln_start], "F") . " " . $val[thn_start] . " - " . bulanIndo($val[bln_end], "F") . " " . $val[thn_end];
		} else {
			$q = "AND DATE(kw.tgl) BETWEEN '".$val[thn_start]."-".$val[bln_start]."-".$val[tgl_start]."' AND '".$val[thn_end]."-".$val[bln_end]."-".$val[tgl_end]."'";
			$title .= "\nPeriode " . tanggalIndo($val[thn_start] . "-" . $val[bln_start] . "-" . $val[tgl_start], "j F Y") . " - " . tanggalIndo($val[thn_end] . "-" . $val[bln_end] . "-" . $val[tgl_end], "j F Y");
		}
		$sql = "
			SELECT
				kb.nama as nama,
				hak.nama as nama_hak,
				SUM(ROUND(kb.mampu_bayar_bhp * bhp_p)) as bhp_p,
				SUM(ROUND(kb.mampu_bayar_bhp * bhp_rs_adm)) as bhp_rs_adm,
				SUM(ROUND(kb.mampu_bayar_bhp * bhp_rs_op)) as bhp_rs_op,
				SUM(ROUND(kb.mampu_bayar_jasa * jasa_p)) as jasa_p,
				SUM(ROUND(kb.mampu_bayar_jasa * jasa_rs_adm)) as jasa_rs_adm,
				SUM(ROUND(kb.mampu_bayar_jasa * jasa_rs_sdm)) as jasa_rs_sdm,
				SUM(ROUND(kb.mampu_bayar_jasa * jasa_rs_kembang)) as jasa_rs_kembang,
				SUM(ROUND(kb.mampu_bayar_jasa * jasa_rs_op)) as jasa_rs_op,

				SUM(ROUND(kb.mampu_bayar_jasa * spesialis * netto)) as spesialis,
				SUM(ROUND(kb.mampu_bayar_jasa * spesialis_pendamping * netto)) as spesialis_pendamping,
				SUM(ROUND(kb.mampu_bayar_jasa * perawat_perinatologi * netto)) as perawat_perinatologi,
				SUM(ROUND(kb.mampu_bayar_jasa * dr_umum * netto)) as dr_umum,
				SUM(ROUND(kb.mampu_bayar_jasa * dr_gigi * netto)) as dr_gigi,
				SUM(ROUND(kb.mampu_bayar_jasa * assisten_non_dokter * netto)) as assisten_non_dokter,
				SUM(ROUND(kb.mampu_bayar_jasa * spesialis_anestesi * netto)) as spesialis_anestesi,
				SUM(ROUND(kb.mampu_bayar_jasa * aknest * netto)) as aknest,
				SUM(ROUND(kb.mampu_bayar_jasa * gizi * netto)) as gizi,
				SUM(ROUND(kb.mampu_bayar_jasa * fisioterapi * netto)) as fisioterapi,
				SUM(ROUND(kb.mampu_bayar_jasa * analis_pa * netto)) as analis_pa,
				SUM(ROUND(kb.mampu_bayar_jasa * bidan * netto)) as bidan,
				SUM(ROUND(kb.mampu_bayar_jasa * perawat * netto)) as perawat,
				SUM(ROUND(kb.mampu_bayar_jasa * penunjang * netto)) as penunjang,
				SUM(ROUND(kb.mampu_bayar_jasa * ugp * netto)) as ugp,
				SUM(ROUND(kb.mampu_bayar_jasa * grabaf * netto)) as grabaf,
				SUM(ROUND(kb.mampu_bayar_jasa * zakat * netto)) as zakat,
				SUM(ROUND(pajak * (kb.mampu_bayar_jasa - kb.mampu_bayar_jasa * kb.jasa_p - kb.mampu_bayar_jasa * kb.jasa_rs_op - kb.mampu_bayar_jasa * kb.jasa_rs_kembang - kb.mampu_bayar_jasa * kb.jasa_rs_adm - kb.mampu_bayar_jasa * kb.jasa_rs_sdm))) as pajak,
				SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as mampu_bayar
			FROM
				kunjungan_bayar kb
				JOIN hak ON (hak.id = kb.hak_id)
				JOIN kwitansi kw ON (kw.id = kb.kwid)
			WHERE
				(kb.lab_specimen_id IS NOT NULL OR kb.bhp_id IS NOT NULL)
				AND kw.tempat_pembayaran = 'LAB'
				$q
			GROUP BY
				kb.lab_specimen_id, kb.bhp_id, kb.hak_id
		";
		//$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
		$kon->sql = $sql;
		$kon->execute();
		$data_karcis = $kon->getAll();

		$table = new Table;
		$table->anime_bg_color = false;
		$table->addTh("Jasa", "Pemilik", "BHP", "JASA RS", "Sp", "Sp1", "SpAn", "UGP", "GRABAF", "Prwt", /*"Ass Non Dokter", "Aknest", "Gizi", "Fisio", "Analis PA", "Bidan", */"Pnjg", "Zakat", "Pajak", "Sub Total");
		$table->addExtraTh("rowspan=\"2\"", "rowspan=\"2\"", "colspan=\"5\"", "colspan=\"5\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"");
		$table->addTh("Pemda", "Adm", "Op", "Rad", "Lab", "Pemda", "Adm", "Sdm", "Bang", "Op");
		for($i=0;$i<sizeof($data_karcis);$i++) {
			$table->addRow(
				$data_karcis[$i][nama], 
				$data_karcis[$i][nama_hak],
				$data_karcis[$i][bhp_p],
				$data_karcis[$i][bhp_rs_adm],
				$data_karcis[$i][bhp_rs_op],
				"?",
				"?",
				uangIndo($data_karcis[$i][jasa_p], false),
				uangIndo($data_karcis[$i][jasa_rs_adm], false),
				uangIndo($data_karcis[$i][jasa_rs_sdm], false),
				uangIndo($data_karcis[$i][jasa_rs_kembang], false),
				uangIndo($data_karcis[$i][jasa_rs_op], false),

				uangIndo($data_karcis[$i][spesialis], false),
				uangIndo($data_karcis[$i][spesialis_pendamping], false),
				uangIndo($data_karcis[$i][spesialis_anestesi], false),
				//uangIndo($data_karcis[$i][dr_umum] + $data_karcis[$i][dr_gigi] + $data_karcis[$i][ugp], false),
				uangIndo($data_karcis[$i][ugp], false),
				uangIndo($data_karcis[$i][grabaf], false),
				//uangIndo($data_karcis[$i][perawat] + $data_karcis[$i][perawat_perinatologi], false),
				uangIndo($data_karcis[$i][perawat], false),
				/*uangIndo($data_karcis[$i][assisten_non_dokter], false),
				uangIndo($data_karcis[$i][aknest], false),
				uangIndo($data_karcis[$i][gizi], false),
				uangIndo($data_karcis[$i][fisioterapi], false),
				uangIndo($data_karcis[$i][analis_pa], false),
				uangIndo($data_karcis[$i][bidan], false),*/
				uangIndo($data_karcis[$i][penunjang], false),
				uangIndo($data_karcis[$i][zakat], false),
				uangIndo($data_karcis[$i][pajak], false),
				uangIndo($data_karcis[$i][mampu_bayar], false)

				/*
				$data_karcis[$i][assisten_non_dokter],
				$data_karcis[$i][aknest],
				$data_karcis[$i][gizi],
				$data_karcis[$i][fisioterapi],
				$data_karcis[$i][analis_pa],
				$data_karcis[$i][bidan],
				*/
			);
			$table->addExtraTr("onclick=\"setBg(this);\"");

			$total[bhp_p] += $data_karcis[$i][bhp_p];
			$total[bhp_rs_adm] += $data_karcis[$i][bhp_rs_adm];
			$total[bhp_rs_op] += $data_karcis[$i][bhp_rs_op];
			$total[jasa_p] += $data_karcis[$i][jasa_p];
			$total[jasa_rs_adm] += $data_karcis[$i][jasa_rs_adm];
			$total[jasa_rs_sdm] += $data_karcis[$i][jasa_rs_sdm];
			$total[jasa_rs_kembang] += $data_karcis[$i][jasa_rs_kembang];
			$total[jasa_rs_op] += $data_karcis[$i][jasa_rs_op];
			$total[spesialis] += $data_karcis[$i][spesialis];
			$total[spesialis_pendamping] += $data_karcis[$i][spesialis_pendamping];
			$total[spesialis_anestesi] += $data_karcis[$i][spesialis_anestesi];
			//$total[ugp] += $data_karcis[$i][dr_umum] + $data_karcis[$i][dr_gigi] + $data_karcis[$i][ugp];
			$total[ugp] += $data_karcis[$i][ugp];
			$total[grabaf] += $data_karcis[$i][grabaf];
			//$total[perawat] += $data_karcis[$i][perawat]+$data_karcis[$i][perawat_perinatologi];
			$total[perawat] += $data_karcis[$i][perawat];
			/*$total[assisten_non_dokter] += $data_karcis[$i][assisten_non_dokter];
			$total[aknest] += $data_karcis[$i][aknest];
			$total[gizi] += $data_karcis[$i][gizi];
			$total[fisioterapi] += $data_karcis[$i][fisioterapi];
			$total[analis_pa] += $data_karcis[$i][analis_pa];
			$total[bidan] += $data_karcis[$i][bidan];*/
			$total[penunjang] += $data_karcis[$i][penunjang];
			$total[zakat] += $data_karcis[$i][zakat];
			$total[pajak] += $data_karcis[$i][pajak];
			$total[mampu_bayar] += $data_karcis[$i][mampu_bayar];
		}
		$table->addTfoot(
			"Total", 
			uangIndo($total[bhp_p], false), 
			uangIndo($total[bhp_rs_adm], false), 
			uangIndo($total[bhp_rs_op], false), 
			"?", 
			"?", 
			uangIndo($total[jasa_p], false), 
			uangIndo($total[jasa_rs_adm], false), 
			uangIndo($total[jasa_rs_sdm], false), 
			uangIndo($total[jasa_rs_kembang], false), 
			uangIndo($total[jasa_rs_op], false), 
			uangIndo($total[spesialis], false), 
			uangIndo($total[spesialis_pendamping], false), 
			uangIndo($total[spesialis_anestesi], false), 
			uangIndo($total[ugp], false), 
			uangIndo($total[grabaf], false), 
			uangIndo($total[perawat], false), 
			/*uangIndo($total[assisten_non_dokter], false), 
			uangIndo($total[aknest], false), 
			uangIndo($total[gizi], false), 
			uangIndo($total[fisioterapi], false), 
			uangIndo($total[analis_pa], false), 
			uangIndo($total[bidan], false), */
			uangIndo($total[penunjang], false), 
			uangIndo($total[zakat], false), 
			uangIndo($total[pajak], false), 
			uangIndo($total[mampu_bayar], false)
			);
		$table->addExtraTfoot("colspan=\"2\"");
		$content = $table->build();
		$judul = nl2br($title);
		$objResponse->addAssign("title", "innerHTML", $judul);
		$objResponse->addAssign("list_data", "innerHTML", $content);
		$_SESSION[lab][pendapatan][title] = $judul;
		$_SESSION[lab][pendapatan][content] = $content;
		return $objResponse;
	}
}


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
?>