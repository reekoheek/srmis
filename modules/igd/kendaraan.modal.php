<?

Class Kunjungan_Modal {

	function buka_kunjungan($id_kunjungan_kamar) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT 
				k.kunjungan_ke as kunjungan_ke,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				p.sex as sex,
				p.tgl_lahir as tgl_lahir,
				kk.id as id_kunjungan_kamar,
				k.id as id_kunjungan,
				DATE(kk.tgl_daftar) as tgl_daftar,
				DATE(kk.tgl_periksa) as tgl_periksa,
				DATE(kk.tgl_keluar) as tgl_keluar,
				TIME(kk.tgl_keluar) as wkt_keluar,
				d.nama as dokter,
				kk.kelanjutan as kelanjutan,
				k.keadaan_keluar as keadaan_keluar,
				kmr.id as id_kamar,
				kmr.kelas as kelas,
				kmr.nama as spesialisasi,
				kk.diagnosa_utama_id as diagnosa_utama_id,
				IF(i.id IS NULL, '&nbsp;', CONCAT(i.kode_icd, ' - ', i.nama)) as diagnosa_utama_nama,
				CONCAT_WS(' - ', k.cara_masuk, rp.nama) as cara_masuk,
				CONCAT_WS(' - ', kk.cara_bayar, kk.jenis_askes, rper.nama) as cara_bayar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
				LEFT JOIN ref_perujuk rp ON (rp.id = k.perujuk_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();
		
		//get data kendaraan
		$sqlkd = "
			SELECT
				kkd.id as kunjungan_kendaraan_id,
				kkd.jarak_tempuh as jarak_tempuh,
				kkd.harga_bbm as harga_bbm,
				kb.id as kunjungan_bayar_id,
				kkd.nama as nama,
				kb.hak_id as hak_id,
				kb.nama as kolom,
				kb.biaya_bhp+kb.biaya_jasa as biaya,
				kb.bayar_bhp+kb.bayar_jasa as bayar
			FROM
				kunjungan_kendaraan kkd
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kendaraan_id = kkd.id)
			WHERE
				kkd.kunjungan_kamar_id = '".$id_kunjungan_kamar."'
			GROUP BY 
				kkd.id, kb.id
			ORDER BY
				kkd.id, kb.id
		";
		$kon->sql = $sqlkd;
		$kon->execute();
		$data_kd = $kon->getAll();
		
		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sqlkd);
		//info utama
		$objResponse->addAssign("input_no_rm", "innerHTML", $data[no_rm]);
		$objResponse->addAssign("input_pasien", "innerHTML", $data[nama]);
		$objResponse->addAssign("input_sex", "innerHTML", $data[sex]);
		$objResponse->addAssign("input_usia", "innerHTML", $umur);
		$objResponse->addAssign("input_cara_masuk", "innerHTML", $data[cara_masuk]);
		$objResponse->addAssign("input_cara_bayar", "innerHTML", $data[cara_bayar]);
		$objResponse->addAssign("input_id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("input_id_kunjungan", "value", $data[id_kunjungan]);
		$objResponse->addAssign("icopim_kelas", "value", $data[kelas]);
		
		$objResponse->addAssign("input_kunjungan_ke", "innerHTML", $data[kunjungan_ke]);
		$objResponse->addAssign("input_spesialisasi", "innerHTML", $data[spesialisasi]);
		$objResponse->addAssign("input_dokter", "innerHTML", $data[dokter]);

		$objResponse->addAssign("input_kelanjutan", "innerHTML", $data[kelanjutan]);
		$objResponse->addAssign("input_keadaan_keluar", "innerHTML", $data[keadaan_keluar]);

		$objResponse->addAssign("input_tgl_keluar", "innerHTML", tanggalIndo($data[tgl_keluar], 'j F Y'));
		$objResponse->addAssign("input_tgl_daftar", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("input_tgl_periksa", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));

		//tab diagnosa_tindakan
		$objResponse->addAssign("input_diagnosa_utama_nama", "innerHTML", $data[diagnosa_utama_nama]);
		//$objResponse->addAssign("debug", "innerHTML", $sqlkd);
		if(!empty($data_kd)) {
			$objResponse->addScriptCall("xajax_get_kendaraan_from_kunjungan", $data_kd);
			$objResponse->addAssign("input_harga_bbm", "value", $data_kd[0][harga_bbm]);
			$objResponse->addAssign("input_jarak_tempuh", "value", $data_kd[0][jarak_tempuh]);
		} else {
			$objResponse->addAssign("input_harga_bbm", "value", $_SESSION[setting][harga_bbm]);
			$objResponse->addClear("input_jarak_tempuh", "value");
		}

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_jarak_tempuh");
		return $objResponse;
	}

	function simpan_kunjungan($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		$kon = new Konek;
		$objResponse = new xajaxResponse();

//KENDARAAN
		for($i=0;$i<sizeof($val[input_kendaraan_jenis]);$i++) {
			$parent = key($val[input_kendaraan_jenis]);
			//get
			if(!$val[input_kunjungan_kendaraan_id][$parent] && $val[input_kendaraan_jenis][$parent]) {
				//insert
				$sql = "INSERT INTO kunjungan_kendaraan (kunjungan_kamar_id, nama, jarak_tempuh, harga_bbm, tgl) VALUES ('".$val[input_id_kunjungan_kamar]."', '".$val[input_kendaraan_jenis][$parent]."', '".$val[input_jarak_tempuh]."', '".$val[input_harga_bbm]."', NOW())";
				$kon->sql = $sql;
				$kon->execute();
				$id_kki = $kon->last_id;
				if($val[input_kendaraan_jenis][$parent] == "SEWA AMBULANCE") {
					$jasa_p = '0.75';
					$jasa_rs = '0.25';
					$jasa_rs_op = '0.2';
					$jasa_rs_kembang = '0.025';
					$jasa_rs_adm = '0.025';
				} else {
					//SEWA MOBIL JENAZAH
					$jasa_p = '0.5';
					$jasa_rs = '0.5';
					$jasa_rs_op = '0.4';
					$jasa_rs_kembang = '0.05';
					$jasa_rs_adm = '0.05';
				}

/*diinsert satu satu*/
/*
$data[bahan_habis_pakai] = round(0.5 * $biaya);
$data[jasa_rumah_sakit] = round(0.25 * $biaya);
$data[rumah_tangga] = round(0.0375 * $biaya);
$data[sopir] = round(0.10625 * $biaya);
$data[perawat] = round(0.10625 * $biaya);
*/
				for($j=0;$j<sizeof($val[input_kendaraan_field][$parent]);$j++) {
					$field = "";
					$field = $val[input_kendaraan_field][$parent][$j];

					if($field == "jasa_rumah_sakit") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kendaraan_id, hak_id, biaya_jasa, bayar_jasa, jasa_p, jasa_rs, jasa_rs_op, jasa_rs_kembang, jasa_rs_adm) VALUES ('".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_kendaraan_hak][$parent][$j]."', '".$val[input_kendaraan_biaya][$parent][$j]."', '".$val[input_kendaraan_bayar][$parent][$j]."', '".$jasa_p."', '".$jasa_rs."', '".$jasa_rs_op."', '".$jasa_rs_kembang."', '".$jasa_rs_adm."')";

					} elseif($field == "bahan_habis_pakai") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kendaraan_id, hak_id, biaya_bhp, bayar_bhp, bhp_rs, bhp_rs_op) VALUES ('".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_kendaraan_hak][$parent][$j]."', '".$val[input_kendaraan_biaya][$parent][$j]."', '".$val[input_kendaraan_bayar][$parent][$j]."', '1', '1')";

					} elseif($field == "rumah_tangga") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kendaraan_id, hak_id, biaya_jasa, bayar_jasa, grabaf, netto) VALUES ('".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_kendaraan_hak][$parent][$j]."', '".$val[input_kendaraan_biaya][$parent][$j]."', '".$val[input_kendaraan_bayar][$parent][$j]."', '1', '1')";
					
					} elseif($field == "sopir") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kendaraan_id, hak_id, biaya_jasa, bayar_jasa, grabaf, netto) VALUES ('".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_kendaraan_hak][$parent][$j]."', '".$val[input_kendaraan_biaya][$parent][$j]."', '".$val[input_kendaraan_bayar][$parent][$j]."', '1', '1')";
					
					} elseif($field == "perawat") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kendaraan_id, hak_id, biaya_jasa, bayar_jasa, perawat, netto) VALUES ('".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_kendaraan_hak][$parent][$j]."', '".$val[input_kendaraan_biaya][$parent][$j]."', '".$val[input_kendaraan_bayar][$parent][$j]."', '1', '1')";

					} else {
						//lain-lain
					}
					//$objResponse->addAppend("debug", "innerHTML", $sql . "<br /><br />");
					$kon->sql = $sql;
					$kon->execute();
				}

			} else {
				//UPDATE
				$sqlup = "UPDATE kunjungan_kendaraan SET jarak_tempuh = '".$val[input_jarak_tempuh]."', harga_bbm = '".$val[input_harga_bbm]."' WHERE id = '".$val[input_kunjungan_kendaraan_id][$parent]."'";
				$kon->sql = $sqlup;
				$kon->execute();
/*diinsert satu satu*/
				for($j=0;$j<sizeof($val[input_kendaraan_field][$parent]);$j++) {
					$field = "";
					$field = $val[input_kendaraan_field][$parent][$j];

					//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $val[input_icopim_detil_bayar][$parent][$field] . "<br />");
					if($field == "jasa_rumah_sakit") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_kendaraan_hak][$parent][$j]."', biaya_jasa = '".$val[input_kendaraan_biaya][$parent][$j]."', bayar_jasa = '".$val[input_kendaraan_bayar][$parent][$j]."' WHERE id = '".$val[input_kunjungan_bayar_id][$parent][$j]."'";

					} elseif($field == "bahan_habis_pakai") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_kendaraan_hak][$parent][$j]."', biaya_bhp = '".$val[input_kendaraan_biaya][$parent][$j]."', bayar_bhp = '".$val[input_kendaraan_bayar][$parent][$j]."' WHERE id = '".$val[input_kunjungan_bayar_id][$parent][$j]."'";

					} elseif($field == "rumah_tangga") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_kendaraan_hak][$parent][$j]."', biaya_jasa = '".$val[input_kendaraan_biaya][$parent][$j]."', bayar_jasa = '".$val[input_kendaraan_bayar][$parent][$j]."' WHERE id = '".$val[input_kunjungan_bayar_id][$parent][$j]."'";
					
					} elseif($field == "sopir") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_kendaraan_hak][$parent][$j]."', biaya_jasa = '".$val[input_kendaraan_biaya][$parent][$j]."', bayar_jasa = '".$val[input_kendaraan_bayar][$parent][$j]."' WHERE id = '".$val[input_kunjungan_bayar_id][$parent][$j]."'";
					
					} elseif($field == "perawat") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_kendaraan_hak][$parent][$j]."', biaya_jasa = '".$val[input_kendaraan_biaya][$parent][$j]."', bayar_jasa = '".$val[input_kendaraan_bayar][$parent][$j]."' WHERE id = '".$val[input_kunjungan_bayar_id][$parent][$j]."'";
					
					} else {
						//lain-lain
					}
					//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $sql . "<br /><br />");
					$kon->sql = $sql;
					$kon->execute();
				} //endfor

			}
			next($val[input_kendaraan_jenis]);
		}
		$afek = $kon->affected_rows;

		if($afek < 0) {
			$objResponse->addAlert("Data Tidak Dapat Disimpan\nHubungi Bagian SIM.");
		} else {
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("tutup_kunjungan");
			$objResponse->addScriptCall("show_status_simpan");
		}
		return $objResponse;
	}

}

Class Kendaraan {
	
	function cari_kendaraan() {
		$objResponse = new xajaxResponse;
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "Jenis Kendaraan");
		$table->addExtraTh("style=\"width:30px\"", "");
		$table->addRow("1", "SEWA AMBULANCE");
		$table->addOnclickTd("xajax_get_kendaraan('SEWA AMBULANCE');","xajax_get_kendaraan('SEWA AMBULANCE', xajax.getFormValues('input_kunjungan'));");
		$table->addRow("2", "SEWA MOBIL JENAZAH");
		$table->addOnclickTd("xajax_get_kendaraan('SEWA MOBIL JENAZAH');","xajax_get_kendaraan('SEWA MOBIL JENAZAH', xajax.getFormValues('input_kunjungan'));");
		$tabel = $table->build();
		$objResponse->addAssign("list_kendaraan","innerHTML", $tabel);
		return $objResponse;
	}

	function get_kendaraan($jenis, $val) {
		$objResponse = new xajaxResponse;
		$parent = md5(microtime());

		if($jenis == "SEWA AMBULANCE") {
			if($val[input_jarak_tempuh] <= 20) $biaya = $val[input_harga_bbm] * 10 * 2;
			else $biaya = ($val[input_harga_bbm] * 10 * 2) + ($val[input_jarak_tempuh] - 20) * 4000;

			$data[bahan_habis_pakai] = round(0.5 * $biaya);
			$data[jasa_rumah_sakit] = round(0.25 * $biaya);
			$data[rumah_tangga] = round(0.0375 * $biaya);
			$data[sopir] = round(0.10625 * $biaya);
			$data[perawat] = round(0.10625 * $biaya);
		} else {
			if($val[input_jarak_tempuh] <= 20) $biaya = $val[input_harga_bbm] * 10 * 3;
			else $biaya = ($val[input_harga_bbm] * 10 * 3) + ($val[input_jarak_tempuh] - 20) * 4000;

			$data[bahan_habis_pakai] = round(0.333333333 * $biaya);
			$data[jasa_rumah_sakit] = round(0.333333333 * $biaya);
			$data[sopir] = round(0.333333333 * $biaya);

		}
		if($val[input_jarak_tempuh] > 100) {
			$makan = round(0.1 * $biaya);
			$data[bahan_habis_pakai] -= $makan;
			$data[sopir] += $makan;
		}
		
		$ret .= "<tr id=\"input_kendaraan_tr_".$parent."\" style=\"background-color: #EDEDED;\">";
		$ret .= "<td><b>".$jenis."</b><input type=\"hidden\" name=\"input_kendaraan_jenis[".$parent."]\" value=\"".$jenis."\" /><input type=\"hidden\" name=\"input_kunjungan_kendaraan_id[".$parent."]\" value=\"\" /></td>";
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Kendaraan\" onclick=\"hapus_kunjungan_kendaraan('','input_kendaraan_tr_".$parent."','input_kendaraan_table_".$parent."')\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Kendaraan\" border=\"0\" /></a></td>";
		$ret .= "<tr id=\"input_kendaraan_table_".$parent."\"><td colspan=\"2\">";
		$ret .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tabel_biaya\"><tr><th style=\"width:200px;\">Nama Jasa</th><th>Hak</th><th>Biaya</th><th style=\"width:100px;\">Bayar</th><th style=\"width:20px;\">&nbsp;</th></tr>";

		//get hak
		$data_hak = $_SESSION[igd][hak];
		$opt_hak = "";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt_hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt_hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}

		for($i=0;$i<sizeof($data);$i++) {
			$n = md5(microtime());
			$kunci = key($data);
			$nama_baris = ucwords(str_replace("_", " ", $kunci));
			$ret .= "<tr id=\"input_kendaraan_detil_tr_".$n."\">";
			$ret .= "<td>".$nama_baris."</td>";

			//HAK
			$hak = "<select name=\"input_kendaraan_hak[".$parent."][]\" id=\"input_kendaraan_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_kendaraan_biaya_".$n."', event, 'input_kendaraan_bayar_".$n."', this)\">" . $opt_hak . "</select>";

			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";

			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_kendaraan_biaya[".$parent."][]\" id=\"input_kendaraan_biaya_".$n."\" value=\"".$data[$kunci]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kopiPaste(this, 'input_kendaraan_bayar_".$n."');\" onkeypress=\"focusNext( 'input_kendaraan_bayar_".$n."', event, 'input_kendaraan_biaya_bhp_".$n."', this)\" />";
			$ret .= "</td>";

			//BAYAR
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_kendaraan_bayar[".$parent."][]\" id=\"input_kendaraan_bayar_".$n."\" value=\"".$data[$kunci]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_kendaraan_hak_".$n."', event, 'input_kendaraan_biaya_".$n."', this)\" />";
			$ret .= "</td>";

			//HAPUS
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus ".$nama_baris."\" onclick=\"hapus_kunjungan_bayar('','input_kendaraan_detil_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus ".$nama_baris."\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kendaraan_field[".$parent."][]\" value=\"".$kunci."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_bayar_id[".$parent."][]\" value=\"\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
			next($data);
		}
		$ret .= "</table></td></tr>";
		$objResponse->addAssign("tbody_input_kendaraan", "innerHTML", $ret);
		return $objResponse;
	}


	function get_kendaraan_from_kunjungan($data) {
		$objResponse = new xajaxResponse;
		for($k=0;$k<sizeof($data);$k++) {
			if($data[$k][kunjungan_kendaraan_id] != $data[$k-1][kunjungan_kendaraan_id]) {
				$parent = md5(microtime());
				if($k != 0) $ret .= "</table></td></tr>";
				
				$ret .= "<tr id=\"input_kendaraan_tr_".$parent."\" style=\"background-color: #EDEDED;\">";
				$ret .= "<td><b>".$data[$k][nama]."</b><input type=\"hidden\" name=\"input_kendaraan_jenis[".$parent."]\" value=\"".$data[0][nama]."\" /><input type=\"hidden\" name=\"input_kunjungan_kendaraan_id[".$parent."]\" value=\"".$data[$k][kunjungan_kendaraan_id]."\" /></td>";
				$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Kendaraan\" onclick=\"hapus_kunjungan_kendaraan('".$data[$k][kunjungan_kendaraan_id]."','input_kendaraan_tr_".$parent."','input_kendaraan_table_".$parent."')\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Kendaraan\" border=\"0\" /></a></td>";
				$ret .= "<tr id=\"input_kendaraan_table_".$parent."\"><td colspan=\"2\">";
				$ret .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tabel_biaya\"><tr><th style=\"width:200px;\">Nama Jasa</th><th>Hak</th><th>Biaya</th><th style=\"width:100px;\">Bayar</th><th style=\"width:20px;\">&nbsp;</th></tr>";
			}

			//get hak
			$data_hak = $_SESSION[igd][hak];

			$n = md5(microtime());
			$nama_kolom = ucwords(str_replace("_", " ", $data[$k][kolom]));
			$ret .= "<tr id=\"input_kendaraan_detil_tr_".$n."\">";
			$ret .= "<td>".$nama_kolom."</td>";

			//HAK

			$opt_hak = "";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $data[$k][hak_id]) $opt_hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $opt_hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}

			$hak = "<select name=\"input_kendaraan_hak[".$parent."][]\" id=\"input_kendaraan_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_kendaraan_biaya_".$n."', event, 'input_kendaraan_bayar_".$n."', this)\">" . $opt_hak . "</select>";

			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";

			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_kendaraan_biaya[".$parent."][]\" id=\"input_kendaraan_biaya_".$n."\" value=\"".$data[$k][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kopiPaste(this, 'input_kendaraan_bayar_".$n."');\" onkeypress=\"focusNext( 'input_kendaraan_bayar_".$n."', event, 'input_kendaraan_biaya_bhp_".$n."', this)\" />";
			$ret .= "</td>";

			//BAYAR
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_kendaraan_bayar[".$parent."][]\" id=\"input_kendaraan_bayar_".$n."\" value=\"".$data[$k][bayar]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_kendaraan_hak_".$n."', event, 'input_kendaraan_biaya_".$n."', this)\" />";
			$ret .= "</td>";

			//HAPUS
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus ".$nama_kolom."\" onclick=\"hapus_kunjungan_bayar('".$data[$k][kunjungan_bayar_id]."','input_kendaraan_detil_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus ".$nama_kolom."\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kendaraan_field[".$parent."][]\" value=\"".$data[$k][kolom]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_bayar_id[".$parent."][]\" value=\"".$data[$k][kunjungan_bayar_id]."\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
			if(($k+1) == sizeof($data)) $ret .= "</table></td></tr>";
		}
		$objResponse->addAssign("tbody_input_kendaraan", "innerHTML", $ret);
		return $objResponse;
	}

	function hapus_kunjungan_kendaraan($id) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "DELETE FROM kunjungan_kendaraan WHERE id = '".$id."'";
		$kon->execute();
		return $objResponse;
	}

}

Class Kunjungan_Bayar {
	function hapus_kunjungan_bayar($id) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "DELETE FROM kunjungan_bayar WHERE id = '".$id."'";
		$kon->execute();
		return $objResponse;
	}

}

//Class Kunjungan_Modal
$_xajax->registerFunction(array("buka_kunjungan", "Kunjungan_Modal", "buka_kunjungan"));
$_xajax->registerFunction(array("simpan_kunjungan", "Kunjungan_Modal", "simpan_kunjungan"));

//diagnosa
$_xajax->registerFunction(array("cari_diagnosa", "Diagnosa", "cari_diagnosa"));

//kendaraan
$_xajax->registerFunction(array("cari_kendaraan", "Kendaraan", "cari_kendaraan"));
$_xajax->registerFunction(array("get_kendaraan", "Kendaraan", "get_kendaraan"));
$_xajax->registerFunction(array("get_kendaraan_from_kunjungan", "Kendaraan", "get_kendaraan_from_kunjungan"));
$_xajax->registerFunction(array("hapus_kunjungan_kendaraan", "Kendaraan", "hapus_kunjungan_kendaraan"));

$_xajax->registerFunction(array("hapus_kunjungan_bayar", "Kunjungan_Bayar", "hapus_kunjungan_bayar"));

?>