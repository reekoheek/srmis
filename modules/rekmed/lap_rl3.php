<?
$_TITLE = "Laporan RL3 (Data Dasar Rumah Sakit)";

Class Laporan_RL3 {
	function get_jml_tt($val) {
		$kon = new Konek;
		$kon->sql = "
			SELECT
				pel.id as id,
				pel.nama_lain as nama,
				kmr.kelas as kelas,
				SUM(kmr.jml_bed) as jml_tt
			FROM
				pelayanan pel
				JOIN kamar kmr ON (kmr.pelayanan_id = pel.id)
			WHERE 
				pel.jenis = 'RAWAT INAP'
			GROUP BY
				pel.id, kmr.kelas
			ORDER BY
				pel.id, kmr.kelas
		";
		$kon->execute();
		$data = $kon->getAll();
		$s = 0;
		$baru = array();
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $data[$i-1][id]) {
				//bikin anak
				$baru[$s][jml_tt] += $data[$i][jml_tt];
				$total[jml_tt] += $data[$i][jml_tt];
				switch($data[$i][kelas]) {
					case "I" :
						$baru[$s][kelas_1] += $data[$i][jml_tt];
						$total[kelas_1] += $data[$i][jml_tt];
					break;
					case "II" :
						$baru[$s][kelas_2] += $data[$i][jml_tt];
						$total[kelas_2] += $data[$i][jml_tt];
					break;
					case "III" :
						$baru[$s][kelas_3] += $data[$i][jml_tt];
						$total[kelas_3] += $data[$i][jml_tt];
					break;
					case "VIP" :
						$baru[$s][kelas_utama] += $data[$i][jml_tt];
						$total[kelas_utama] += $data[$i][jml_tt];
					break;
					default :
						$baru[$s][tanpa_kelas] += $data[$i][jml_tt];
						$total[tanpa_kelas] += $data[$i][jml_tt];
					break;
				}
			} else {
				if($i != 0) $s++;
				//bikin embok
				$baru[$s][nama] = $data[$i][nama];
				$baru[$s][jml_tt] = $data[$i][jml_tt];
				$total[jml_tt] += $data[$i][jml_tt];
				switch($data[$i][kelas]) {
					case "I" :
						$baru[$s][kelas_1] = $data[$i][jml_tt];
						$total[kelas_1] += $data[$i][jml_tt];
					break;
					case "II" :
						$baru[$s][kelas_2] = $data[$i][jml_tt];
						$total[kelas_2] += $data[$i][jml_tt];
					break;
					case "III" :
						$baru[$s][kelas_3] = $data[$i][jml_tt];
						$total[kelas_3] += $data[$i][jml_tt];
					break;
					case "VIP" :
						$baru[$s][kelas_utama] = $data[$i][jml_tt];
						$total[kelas_utama] += $data[$i][jml_tt];
					break;
					default :
						$baru[$s][tanpa_kelas] = $data[$i][jml_tt];
						$total[tanpa_kelas] += $data[$i][jml_tt];
					break;
				}
			}
		}
		$table = new Table;
		$table->extra_table = "style=\"width:20cm;\"";
		$objResponse = new xajaxResponse;
		$objResponse->addAssign("keadaan_tahun", "innerHTML", $val[tahun]);
		$objResponse->addAssign("keadaan_tahun_2", "innerHTML", $val[tahun]);
		$table->addTh("No", "Jenis Pelayanan/<br />Ruang Rawat Inap *)", "Jumlah<br />TT<br />Tersedia", "Perincian Tempat Tidur Per-Kelas", "No");
		$table->addExtraTh("rowspan=\"2\"", "rowspan=\"2\"", "rowspan=\"2\"", "colspan=\"5\"", "rowspan=\"2\"");
		$table->addTh("Kelas<br />Utama", "Kelas I", "Kelas II", "Kelas III", "Tanpa<br />Kelas");
		for($i=0;$i<sizeof($baru);$i++) {
			$table->addRow(
				($i+1),
				$baru[$i][nama],
				$baru[$i][jml_tt],
				$baru[$i][kelas_utama],
				$baru[$i][kelas_1],
				$baru[$i][kelas_2],
				$baru[$i][kelas_3],
				$baru[$i][tanpa_kelas],
				($i+1)
			);
		}
		$ret_1 = $table->build();
		//get data rawat jalan
		$kon->sql = "
			SELECT
				pel.id as id,
				pel.nama as nama,
				pel.hari_buka as hari_buka,
				sub.nama as nama_sub
			FROM
				pelayanan pel
				JOIN spesialisasi spc ON (spc.id = pel.spesialisasi_id)
				JOIN subspesialisasi sub ON (sub.spesialisasi_id = spc.id)
			WHERE
				pel.jenis = 'RAWAT JALAN'
			ORDER BY
				pel.id
		";
		$kon->execute();
		$data_2 = $kon->getAll();
		$baru_2 = array();
		$s = 0;
		for($i=0;$i<sizeof($data_2);$i++) {
			if($data_2[$i][id] == $data_2[$i-1][id]) {
				$baru_2[$s][sub][] = $data_2[$i][nama_sub];
			} else {
				if($i != 0) $s++;
				$baru_2[$s][nama] = $data_2[$i][nama];
				$baru_2[$s][hari_buka] = $data_2[$i][hari_buka];
			}
		}
		//print_r($baru_2);
		$tabel = new Table;
		$tabel->addTh("","UNIT RAWAT JALAN SPESIALISASI *)", "UNIT RAWAT JALAN SUB SPESIALISASI *)");
		for($i=0;$i<sizeof($baru_2);$i++) {
			if(!empty($baru_2[$i][sub])) $sub = implode("<br />", $baru_2[$i][sub]); 
			else $sub = "";
			$tabel->addRow(
				($i+1),
				"<span style=\"border:solid 1px #000000;padding:2px 5px 2px 5px;\">".$baru_2[$i][hari_buka]."</span>&nbsp;&nbsp;" . $baru_2[$i][nama],
				$sub
			);
		}
		$ret_2 = $tabel->build();
		$objResponse->addAssign("list_data", "innerHTML", $ret_1);
		$objResponse->addAssign("list_data_2", "innerHTML", $ret_2);
		return $objResponse;
	}
}
$_xajax->registerFunction(array("get_jml_tt", "Laporan_RL3", "get_jml_tt"));
?>