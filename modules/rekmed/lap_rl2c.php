<?
$_TITLE = "Laporan RL2c (Data Status Imunisasi)";

Class Laporan_RL2c {

	function get_lap_rl2c($val) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT
				kk.id as kkid,
				kki.id as kkiid,
				kki.imunisasi_id as imunisasi_id,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.sex as sex,
				p.tgl_lahir as tgl_lahir,
				p.id as pasien_id,
				kk.tgl_periksa as tgl_periksa,
				k.keadaan_keluar as keadaan_keluar_id,
				im.sebab_sakit as sebab_sakit
			FROM
				kunjungan_kamar_imunisasi kki
				JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN imunisasi im ON (im.id = kki.imunisasi_id)
			WHERE
				EXTRACT(YEAR_MONTH FROM kk.tgl_periksa) = EXTRACT(YEAR_MONTH FROM '".$val[tahun]."-".$val[bulan]."-01')
			GROUP BY
				kki.id
			ORDER BY 
				kk.id, kki.imunisasi_id, p.id
		";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$baru = array();
		$s = 0;
		for($i=0;$i<sizeof($data);$i++) {
			$umur = hitungUmur($data[$i][tgl_lahir], $data[$i][tgl_keluar]);
			$usia = $umur[tahun];
			$satuan = "th";
			if($usia < 1) {
				$usia = $umur[bulan];
				$satuan = "bl";
			}
			if($usia < 1) {
				$usia = $umur[hari];
				$satuan = "hr";
			}
			$baru[$s][kolom_2] = $data[$i][no_rm];
			if($data[$i][sex] == "LAKI-LAKI") {
				//laki-laki
				$baru[$s][kolom_3] = $usia . $satuan;
				$total[kolom_3] += 1;
			} else {
				//perempuan
				$baru[$s][kolom_4] = $usia . $satuan;
				$total[kolom_4] += 1;
			}
			$arr_sebab_sakit = array();
			$arr_sebab_sakit = explode(",", $data[$i][sebab_sakit]);
			if(in_array("Dipteri", $arr_sebab_sakit)) {
				$baru[$s][kolom_5] = "&radic;";
				$total[kolom_5] += 1;
			}
			if(in_array("Pertusis", $arr_sebab_sakit)) {
				$baru[$s][kolom_6] = "&radic;";
				$total[kolom_6] += 1;
			}
			if(in_array("Tetanus", $arr_sebab_sakit)) {
				$baru[$s][kolom_7] = "&radic;";
				$total[kolom_7] += 1;
			}
			if(in_array("Tetanus Neonatorum", $arr_sebab_sakit)) {
				$baru[$s][kolom_8] = "&radic;";
				$total[kolom_8] += 1;
			}
			if(in_array("TBC Paru", $arr_sebab_sakit)) {
				$baru[$s][kolom_9] = "&radic;";
				$total[kolom_9] += 1;
			}
			if(in_array("Campak", $arr_sebab_sakit)) {
				$baru[$s][kolom_10] = "&radic;";
				$total[kolom_10] += 1;
			}
			if(in_array("Polio", $arr_sebab_sakit)) {
				$baru[$s][kolom_11] = "&radic;";
				$total[kolom_11] += 1;
			}
			if(in_array("Hepatitis", $arr_sebab_sakit)) {
				$baru[$s][kolom_12] = "&radic;";
				$total[kolom_12] += 1;
			}
			/*
				status imunisasi
				pilihlah satu diantara status imunisasi yg ada dan berilah tanda (V) 
				pada status imunisasi yg dipilih sesuai diagnosis pasien yg bersangkutan
				status imunisasi dibagi sebagai berikut :
				0 kolom 13 ~ tidak pernah imunisasi
				1 kolom 14 ~ imunisasi 1x
				2 kolom 15 ~ imunisasi 2x
				3 kolom 16 ~ imunisasi 3x
				TK kolom 17 ~ tidak tahu apakah sudah pernah dapat imunisasi
			*/
			$kon->sql = "
				SELECT 
					COUNT(kki.id) as kali
				FROM
					kunjungan_kamar_imunisasi kki
					JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN imunisasi i ON (i.id = kki.imunisasi_id)
				WHERE
					kk.id <> '".$data[$i][kkid]."'
					AND DATE(kk.tgl_periksa) < DATE('".$data[$i][tgl_periksa]."')
					AND i.id = '".$data[$i][imunisasi_id]."'
					AND p.id = '".$data[$i][pasien_id]."'
			";
			$kon->execute();
			$kali = $kon->getOne();
			switch($kali[kali]) {
				case 1 :
					$baru[$s][kolom_14] = "&radic;";
					$total[kolom_14] += 1;
				break;
				case 2 :
					$baru[$s][kolom_15] = "&radic;";
					$total[kolom_15] += 1;
				break;
				case 3 :
					$baru[$s][kolom_16] = "&radic;";
					$total[kolom_16] += 1;
				break;
				default :
					$baru[$s][kolom_17] = "&radic;";
					$total[kolom_17] += 1;
				break;
			}
			if($data[$i][keadaan_keluar] == "MATI < 48 JAM" || $data[$i][keadaan_keluar] == "MATI >= 48 JAM") {
				$baru[$s][kolom_19] = "&radic;";
				$total[kolom_19] += 1;
			} else {
				$baru[$s][kolom_18] = "&radic;";
				$total[kolom_18] += 1;
			}
			$s++;
		}
		$tabel_all = new Table;
		$tabel_all->scroll = false;
		$tabel_all->extra_table = "style=\"width:21.5cm;margin:0\"";
		$tabel_all->cellspacing="0";
		$tabel_all->css_table="";
		$tabel_all->anime_bg_color="";
		$tabel_header = new Table;
		$tabel_header->scroll = false;
		$tabel_header->extra_tr_th = "";
		$tabel_header->cellspacing="0";
		$tabel_header->css_table="";
		$tabel_header->anime_bg_color="";
		$tabel_header->extra_table = "style=\"width:20cm;border:0;\"";
		$tabel_header->addTh("","DATA STATUS IMUNISASI<br />BULAN : ".bulanIndo($val[bulan], "F")."<br />TAHUN : ".$val[tahun],"");
		//$tabel_header->addExtraTh("colspan=\"3\"");
		$tabel_header->addRow("","","Formulir RL2c");
		//$tabel_header->addExtraTh();
		$tabel_header->addRow($_SESSION[setting][rs_nama], "", "No. Kode RS : " . $_SESSION[setting][rs_kode]);
		//$tabel_header->addExtraTh("colspan=\"3\"");

		$tabel_isi = new Table;
		$tabel_isi->scroll = false;
		$tabel_isi->cellspacing="0";
		$tabel_isi->extra_table = "style=\"width:20cm;font-size:7pt;\"";
		$tabel_header->css_table="";
		$tabel_isi->addTh(
			"NO.", 
			"NO. REKAM MEDIS PASIEN", 
			"UMUR SEX", 
			"PENYEBAB SAKIT", 
			"STATUS IMUNISASI **", 
			"KEADAAN PASIEN KELUAR RS"
		);
		$tabel_isi->addExtraTh("rowspan=\"2\"", "rowspan=\"2\"", "colspan=\"2\"", "colspan=\"8\"", "colspan=\"5\"", "colspan=\"2\"");
		$tabel_isi->addTh("L", "P", "DIPTERI", "PERTUSIS", "TETANUS", "TETANUS NEONATORUM", "TBC PARU", "CAMPAK", "POLIO", "HEPATITIS", "0", "1", "2", "3", "TK", "HIDUP", "MATI");
		$tabel_isi->addTh("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19");
		for($i=0;$i<sizeof($baru);$i++) {
			$tabel_isi->addRow(
				($i+1),
				$baru[$i][kolom_2],
				$baru[$i][kolom_3],
				$baru[$i][kolom_4],
				$baru[$i][kolom_5],
				$baru[$i][kolom_6],
				$baru[$i][kolom_7],
				$baru[$i][kolom_8],
				$baru[$i][kolom_9],
				$baru[$i][kolom_10],
				$baru[$i][kolom_11],
				$baru[$i][kolom_12],
				$baru[$i][kolom_13],
				$baru[$i][kolom_14],
				$baru[$i][kolom_15],
				$baru[$i][kolom_16],
				$baru[$i][kolom_17],
				$baru[$i][kolom_18],
				$baru[$i][kolom_19]
			);
		}
		$tabel_isi->addRow(
			"","Total", 
			$total[kolom_3], 
			$total[kolom_4], 
			$total[kolom_5], 
			$total[kolom_6], 
			$total[kolom_7], 
			$total[kolom_8], 
			$total[kolom_9], 
			$total[kolom_10], 
			$total[kolom_11], 
			$total[kolom_12], 
			$total[kolom_13], 
			$total[kolom_14],
			$total[kolom_15],
			$total[kolom_16],
			$total[kolom_17],
			$total[kolom_18],
			$total[kolom_19]
		);
		$ret_tabel_header = $tabel_header->build();
		$ret_tabel_isi = $tabel_isi->build();
		$tabel_all->addRow($ret_tabel_header);
		$tabel_all->addRow($ret_tabel_isi);
		$ret = $tabel_all->build();
		unset($_SESSION[rekmed][lap_rl2c]);
		$cetak = new Cetak;
		$tanda_tangan = $cetak->setTandaTangan();
		$ret .= $tanda_tangan;
		$_SESSION[rekmed][lap_rl2c] = $ret;
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

}
$_xajax->registerFunction(array("get_lap_rl2c", "Laporan_RL2c", "get_lap_rl2c"));
?>