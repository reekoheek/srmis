<?
$_TITLE = "Laporan RL1 (Data Kegiatan Rumah Sakit)";

Class Laporan_RL1 {

	function get_lap_rl1($val) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT
				id,
				nama as nama_lain
			FROM
				pelayanan
			WHERE
				jenis = 'RAWAT INAP'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$baru = array();
		$s = 0;
		
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
			default : 
				$tgl_awal = $val[tahun] . "-10-01";
				$tgl_akhir = $val[tahun] . "-12-31";
				$tgl_start_bln = 10;
			break;
		}
		$selisih_hari = datediff("d", $tgl_awal, $tgl_akhir);
		for($i=0;$i<sizeof($data);$i++) {
			$baru[$i][nama] = $data[$i][nama_lain];
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
				WHERE
					kmr.pelayanan_id = '".$data[$i][id]."'
					AND (DATE(kk.tgl_daftar) < '".$tgl_awal."' AND (DATE(kk.tgl_keluar) >= '".$tgl_awal."' OR kk.tgl_keluar IS NULL))
			";
			$kon->execute();
			$px_awal = $kon->getOne();
			$baru[$i][px_awal] = $px_awal[jml];
			$total[px_awal] += $baru[$i][px_awal];

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
				WHERE
					kmr.pelayanan_id = '".$data[$i][id]."'
					AND (DATE(kk.tgl_daftar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
			";
			$kon->execute();
			$px_masuk = $kon->getOne();
			$baru[$i][px_masuk] = $px_masuk[jml];
			$total[px_masuk] += $baru[$i][px_masuk];

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
				WHERE
					kmr.pelayanan_id = '".$data[$i][id]."'
					AND (DATE(kk.tgl_keluar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY kk.id
			";
			$kon->execute();
			$px_keluar = $kon->getAll();
			for($j=0;$j<sizeof($px_keluar);$j++) {
				switch($px_keluar[$j][keadaan_keluar]) {
					case "MATI < 48 JAM" :
						$baru[$i][px_keluar_mati_kurang_dari] += $px_keluar[$j][jml];
					break;
					case "MATI >= 48 JAM" :
						$baru[$i][px_keluar_mati_lebih_dari] += $px_keluar[$j][jml];
					break;
					default :
						$baru[$i][px_keluar_hidup] += $px_keluar[$j][jml];
					break;
				}
			}
			$total[px_keluar_mati_kurang_dari] += $baru[$i][px_keluar_mati_kurang_dari];
			$total[px_keluar_mati_lebih_dari] += $baru[$i][px_keluar_mati_lebih_dari];
			$total[px_keluar_hidup] += $baru[$i][px_keluar_hidup];
			$baru[$i][px_keluar_mati] = $baru[$i][px_keluar_mati_kurang_dari] + $baru[$i][px_keluar_mati_lebih_dari];
			$total[px_keluar_mati] += $baru[$i][px_keluar_mati];

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
				WHERE
					kmr.pelayanan_id = '".$data[$i][id]."'
					AND (DATE(kk.tgl_keluar) BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY kk.id
			";
			$kon->execute();
			$ld = $kon->getAll();
			for($j=0;$j<sizeof($ld);$j++) {
				$baru[$i][lama_dirawat] += $ld[$j][jml];
			}
			$total[lama_dirawat] += $baru[$i][lama_dirawat];

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
				WHERE
					kmr.pelayanan_id = '".$data[$i][id]."'
					AND (DATE(kk.tgl_daftar) < '".$tgl_akhir."' AND (DATE(kk.tgl_keluar) > '".$tgl_akhir."' OR kk.tgl_keluar IS NULL))
			";
			$kon->execute();
			$px_akhir = $kon->getOne();
			$baru[$i][px_akhir] = $px_akhir[jml];
			$total[px_akhir] += $baru[$i][px_akhir];

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
					WHERE
						kmr.pelayanan_id = '".$data[$i][id]."'
						AND (DATE(kk.tgl_daftar) <= '".$tgl."' AND (DATE(kk.tgl_keluar) > '".$tgl."' OR kk.tgl_keluar IS NULL))
					GROUP BY kmr.kelas
				";
				$kon->execute();
				$px_hari_ini[$j] = $kon->getAll();
				for($k=0;$k<sizeof($px_hari_ini[$j]);$k++) {
					switch($px_hari_ini[$j][$k][kelas]) {
						case "I" :
							$baru[$i][hp_kelas_i] += $px_hari_ini[$j][$k][jml];
						break;
						case "II" :
							$baru[$i][hp_kelas_ii] += $px_hari_ini[$j][$k][jml];
						break;
						case "III" :
							$baru[$i][hp_kelas_iii] += $px_hari_ini[$j][$k][jml];
						break;
						case "VIP" :
							$baru[$i][hp_kelas_vip] += $px_hari_ini[$j][$k][jml];
						break;
						default :
							$baru[$i][hp_kelas_tanpa_kelas] += $px_hari_ini[$j][$k][jml];
						break;
					}
				}
			}
			$total[hp_kelas_i] += $baru[$i][hp_kelas_i];
			$total[hp_kelas_ii] += $baru[$i][hp_kelas_ii];
			$total[hp_kelas_iii] += $baru[$i][hp_kelas_iii];
			$total[hp_kelas_vip] += $baru[$i][hp_kelas_vip];
			$total[hp_kelas_tanpa_kelas] += $baru[$i][hp_kelas_tanpa_kelas];
			$baru[$i][hp_total] +=$baru[$i][hp_kelas_i] + $baru[$i][hp_kelas_ii] + $baru[$i][hp_kelas_iii] + $baru[$i][hp_kelas_vip] + $baru[$i][hp_kelas_tanpa_kelas];
			$total[hp_total] += $baru[$i][hp_total];
		}
		$tabel_all = new Table;
		$tabel_all->scroll = false;
		$tabel_all->extra_table = "style=\"width:27cm;margin:0\"";
		$tabel_all->cellspacing="0";
		$tabel_all->css_table="";
		$tabel_all->anime_bg_color="";
		$tabel_header = new Table;
		$tabel_header->scroll = false;
		$tabel_header->extra_tr_th = "";
		$tabel_header->cellspacing="0";
		$tabel_header->css_table="";
		$tabel_header->anime_bg_color="";
		$tabel_header->extra_table = "style=\"width:27cm;border:0;\"";
		$tabel_header->addTh("","DATA KEGIATAN RUMAH SAKIT<br />TRIWULAN : ".$val[tw]."<br />TAHUN : ".$val[tahun]."");
		//$tabel_header->addExtraTh("colspan=\"3\"");
		$tabel_header->addRow("","","Formulir RL1");
		//$tabel_header->addExtraTh();
		$tabel_header->addRow($_SESSION[setting][rs_nama], "", "No. Kode RS : " . $_SESSION[setting][rs_kode]);
		//$tabel_header->addExtraTh("colspan=\"3\"");

		$tabel_isi = new Table;
		$tabel_isi->scroll = false;
		$tabel_isi->cellspacing="0";
		$tabel_isi->extra_table = "style=\"width:27cm;font-size:7pt;\"";
		$tabel_header->css_table="";
		$tabel_isi->addTh(
			"No.", 
			"JENIS PELAYANAN", 
			"Pasien<br />Awal<br />Triwulan", 
			"Pasien<br />Masuk", 
			"Pasien<br />Keluar<br />Hidup", 
			"Pasien Keluar Mati", 
			"Jumlah<br />Lama<br />Dirawat", 
			"Pasien<br />Akhir<br />Triwulan",
			"Jumlah<br />Hari Pe-<br />rawatan",
			"Rincian Hari Perawatan per Kelas",
			"No."
		);
		$tabel_isi->addExtraTh(
			"rowspan=\"2\"", 
			"rowspan=\"2\"", 
			"rowspan=\"2\"", 
			"rowspan=\"2\"", 
			"rowspan=\"2\"", 
			"colspan=\"3\"", 
			"rowspan=\"2\"", 
			"rowspan=\"2\"",
			"rowspan=\"2\"", 
			"colspan=\"5\"", 
			"rowspan=\"2\""
		);
		$tabel_isi->addTh("&lt; 48 jam", "&ge; 48 jam", "jumlah", "Kelas<br />Utama", "Kelas I", "Kelas II", "Kelas III", "Tanpa<br />Kelas");
		$tabel_isi->addTh("1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17");
		for($i=0;$i<sizeof($baru);$i++) {
			$tabel_isi->addRow(
				($i+1),
				$baru[$i][nama],
				$baru[$i][px_awal],
				$baru[$i][px_masuk],
				$baru[$i][px_keluar_hidup],
				$baru[$i][px_keluar_mati_kurang_dari],
				$baru[$i][px_keluar_mati_lebih_dari],
				$baru[$i][px_keluar_mati],
				$baru[$i][lama_dirawat],
				$baru[$i][px_akhir],
				$baru[$i][hp_total],
				$baru[$i][hp_kelas_vip],
				$baru[$i][hp_kelas_i],
				$baru[$i][hp_kelas_ii],
				$baru[$i][hp_kelas_iii],
				$baru[$i][hp_kelas_tanpa_kelas],
				($i+1)
			);
		}
		$tabel_isi->addRow(
			99,
			"TOTAL",
			$total[px_awal],
			$total[px_masuk],
			$total[px_keluar_hidup],
			$total[px_keluar_mati_kurang_dari],
			$total[px_keluar_mati_lebih_dari],
			$total[px_keluar_mati],
			$total[lama_dirawat],
			$total[px_akhir],
			$total[hp_total],
			$total[hp_kelas_vip],
			$total[hp_kelas_i],
			$total[hp_kelas_ii],
			$total[hp_kelas_iii],
			$total[hp_kelas_tanpa_kelas],
			99
		);
		$ret_tabel_header = $tabel_header->build();
		$ret_tabel_isi = $tabel_isi->build();
		$tabel_all->addRow($ret_tabel_header);
		$tabel_all->addRow($ret_tabel_isi);
		$ret = $tabel_all->build();
		unset($_SESSION[rekmed][lap_rl1]);
		$cetak = new Cetak;
		$tanda_tangan = $cetak->setTandaTangan();
		$ret .= $tanda_tangan;
		$_SESSION[rekmed][lap_rl1] = $ret;
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}
}
$_xajax->registerFunction(array("get_lap_rl1", "Laporan_RL1", "get_lap_rl1"));
?>