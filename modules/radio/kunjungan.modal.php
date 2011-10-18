<?

Class Kunjungan_Modal {

	function buka_kunjungan($id_kunjungan_radio) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$sql = "
			SELECT 
				lk.kunjungan_kamar_id as kunjungan_kamar_id,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				p.sex as sex,
				p.tgl_lahir as tgl_lahir,
				DATE(lk.tgl_daftar) as tgl_daftar,
				DATE(lk.tgl_periksa) as tgl_periksa,
				lk.kelas as kelas,
				lk.pengirim as pengirim,
				CONCAT_WS(' - ', lk.cara_masuk, kmr.nama) as cara_masuk,
				CONCAT_WS(' - ', lk.cara_bayar, lk.jenis_askes, rper.nama) as cara_bayar
			FROM 
				radio_kunjungan lk
				JOIN pasien p ON (p.id = lk.pasien_id)
				LEFT JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = lk.perusahaan_id)
			WHERE
				lk.id = '".$id_kunjungan_radio."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();

		//get data pemeriksaan
		$kon->sql = "
			SELECT
				id as kunjungan_bayar_id,
				nama as nama,
				hak_id as hak_id,
				jumlah as jumlah,
				biaya_bhp as biaya_bhp,
				biaya_jasa as biaya_jasa,
				bayar_bhp as bayar_bhp,
				bayar_jasa as bayar_jasa
			FROM
				kunjungan_bayar
			WHERE
				radio_kunjungan_id = '".$id_kunjungan_radio."'
				AND radio_pemeriksaan_id IS NOT NULL
			GROUP BY 
				id
		";
		$kon->execute();
		$data_spc = $kon->getAll();
		
		//get data BHP
		$kon->sql = "
			SELECT
				id as kunjungan_bayar_id,
				nama as nama,
				hak_id as hak_id,
				jumlah as jumlah,
				sifat as sifat,
				biaya_bhp as biaya,
				bayar_bhp as bayar
			FROM
				kunjungan_bayar
			WHERE
				radio_kunjungan_id = '".$id_kunjungan_radio."'
				AND bhp_id IS NOT NULL
			GROUP BY 
				id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();


		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("input_no_rm", "innerHTML", $data[no_rm]);
		$objResponse->addAssign("input_pasien", "innerHTML", $data[nama]);
		$objResponse->addAssign("input_sex", "innerHTML", $data[sex]);
		$objResponse->addAssign("input_usia", "innerHTML", $umur);
		$objResponse->addAssign("input_cara_masuk", "innerHTML", $data[cara_masuk]);
		$objResponse->addAssign("input_cara_bayar", "innerHTML", $data[cara_bayar]);
		$objResponse->addAssign("input_id_kunjungan_radio", "value", $id_kunjungan_radio);
		$objResponse->addAssign("input_id_kunjungan_kamar", "value", $data[kunjungan_kamar_id]);
		$objResponse->addAssign("input_kelas", "value", $data[kelas]);
		$objResponse->addAssign("display_kelas", "innerHTML", $data[kelas]);
		$objResponse->addAssign("kelas", "value", $data[kelas]);
		
		$objResponse->addAssign("input_kunjungan_ke", "innerHTML", $data[kunjungan_ke]);
		$objResponse->addAssign("input_spesialisasi", "innerHTML", $data[spesialisasi]);
		$objResponse->addScriptCall("xajax_ref_get_dokter_from_kamar", "input_dokter_id", $data[id_kamar], $data[id_dokter]);

		$objResponse->addAssign("input_tgl_daftar", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("input_tgl_periksa", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("input_pengirim", "innerHTML", $data[pengirim]);


		if(!empty($data_spc)) $objResponse->addScriptCall("xajax_get_pemeriksaan_from_kunjungan", $data_spc);
		if(!empty($data_bhp)) $objResponse->addScriptCall("xajax_get_bhp_from_kunjungan", $data_bhp);

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_dokter_id");
		return $objResponse;
	}

	function simpan_kunjungan($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		$kon = new Konek;
		$objResponse = new xajaxResponse();

		//$objResponse->addAlert(print_r($val));
		//$objResponse->addAppend("debug", "innerHTML", $mampu_bayar);
//INSERT UPDATE SPECIMEN
		for($i=0;$i<sizeof($val[input_pemeriksaan]);$i++) {
			$kunci = key($val[input_pemeriksaan]);
/* BAGI BAYAR => BHP+JASA */
/*$bayar_bhp = round($val[input_pemeriksaan_biaya_bhp][$kunci]*$val[input_pemeriksaan_bayar][$kunci]/($val[input_pemeriksaan_biaya_bhp][$kunci]+$val[input_pemeriksaan_biaya_jasa][$kunci]));
$bayar_jasa = round($val[input_pemeriksaan_biaya_jasa][$kunci]*$val[input_pemeriksaan_bayar][$kunci]/($val[input_pemeriksaan_biaya_bhp][$kunci]+$val[input_pemeriksaan_biaya_jasa][$kunci]));
$selisih = $val[input_pemeriksaan_bayar][$kunci]-$bayar_bhp-$bayar_jasa;
$bayar_jasa += $selisih;*/
$bayar_jasa = round($val[input_pemeriksaan_bayar][$kunci]);
			if(!$val[input_kunjungan_pemeriksaan_id][$kunci]) {
				//insert
				$sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						radio_kunjungan_id,
						radio_pemeriksaan_id, 
						hak_id, 
						biaya_jasa
					)	VALUES (
							'".$val[input_pemeriksaan_nama][$i]."', 
							NULLIF('".$val[input_id_kunjungan_kamar]."', ''), 
							'".$val[input_id_kunjungan_radio]."',
							'".$val[input_pemeriksaan][$kunci]."', 
							'".$val[input_pemeriksaan_hak][$kunci]."', 
							'".$bayar_jasa."')
					";
				$kon->sql = $sql;
				$kon->execute();
			} else {
				//update
				$sql = "
				UPDATE 
					kunjungan_bayar 
				SET 
					hak_id = '".$val[input_pemeriksaan_hak][$kunci]."', 
					bayar_jasa = '".$bayar_jasa."'
				WHERE 
					id = '".$val[input_kunjungan_pemeriksaan_id][$kunci]."'";
				$kon->sql = $sql;
				$kon->execute();
				//$objResponse->addAppend("debug", "innerHTML", $sql);
			}
			//$objResponse->addAppend("debug", "innerHTML", $sql);
			next($val[input_pemeriksaan]);
		}

//BHP
/*		for($i=0;$i<sizeof($val[input_bhp]);$i++) {
			$kunci = key($val[input_bhp]);
			if(!$val[input_kunjungan_bhp_id][$kunci]) {
				//insert
				$sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						radio_kunjungan_id,
						bhp_id, 
						hak_id, 
						biaya_bhp,
						sifat,
						jumlah, 
						bayar_bhp,
						tgl
						) VALUES ( 
							'".$val[input_bhp_nama][$i]."', 
							NULLIF('".$val[input_id_kunjungan_kamar]."', ''), 
							'".$val[input_id_kunjungan_radio]."',
							'".$val[input_bhp][$kunci]."', 
							'".$val[input_bhp_hak][$kunci]."', 
							'".$val[input_bhp_biaya][$kunci]."',
							'".$val[input_bhp_sifat][$kunci]."', 
							'".$val[input_bhp_jml][$kunci]."', 
							'".$val[input_bhp_bayar][$kunci]."',
							NOW())
					";
				$kon->sql = $sql;
				$kon->execute();
			} else {
				//update
				$sql = "
				UPDATE 
					kunjungan_bayar 
				SET 
					hak_id = '".$val[input_bhp_hak][$kunci]."', 
					biaya = '".$val[input_bhp_biaya][$kunci]."', 
					sifat = '".$val[input_bhp_sifat][$kunci]."', 
					jumlah = '".$val[input_bhp_jml][$kunci]."', 
					bayar_bhp = '".$val[input_bhp_bayar][$kunci]."'
				WHERE 
					id = '".$val[input_kunjungan_bhp_id][$kunci]."'";
				$kon->sql = $sql;
				//$objResponse->addAssign("debug", "innerHTML", $sql);
				$kon->execute();
			}
			next($val[input_bhp]);
		}*/
		$afek = $kon->affected_rows;
		
		if($afek < 0) {
			$objResponse->addAlert("Data Tidak Dapat Disimpan\nHubungi Bagian SIM.");
			//$objResponse->addAssign("debug", "innerHTML", $sql);
		} else {
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("tutup_kunjungan");
			$objResponse->addScriptCall("show_status_simpan");
		}
		return $objResponse;
	}

}

Class Specimen {
	
	function cari_pemeriksaan($hal = 0, $val) {
		$val[pemeriksaan] = addslashes($val[pemeriksaan]);
		$q = " AND ls.nama LIKE '%".$val[pemeriksaan]."%' ";
		$paging = new MyPagina;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		
		$paging->sql = "
			SELECT 
				ls.id as id,
				REPLACE(ls.nama, '".$val[pemeriksaan]."','<b>".$val[pemeriksaan]."</b>') as nama_replace,
				ls.nama as nama,
				ls.biaya_bhp as biaya_bhp,
				lsd.biaya_jasa as biaya_jasa
			FROM 
				radio_pemeriksaan ls
				JOIN radio_pemeriksaan_detil lsd ON (lsd.tingkat = ls.tingkat)
			WHERE
				lsd.kelas = '".$val[kelas]."' 
				$q
			ORDER BY 
				ls.nama
			";
		
		$paging->onclick_func = "xajax_cari_pemeriksaan";
		$paging->setOnclickValue("xajax.getFormValues('cari_pemeriksaan')");
		$paging->get_page_result();

		$pemeriksaan_data = $paging->data;
		$pemeriksaan_no = $paging->start_number();
		$pemeriksaan_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "Specimen", "Biaya");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($pemeriksaan_data);$i++) {
			$table->addRow(($pemeriksaan_no+$i), $pemeriksaan_data[$i]['nama_replace'], uangIndo($pemeriksaan_data[$i]['biaya_bhp'] + $pemeriksaan_data[$i]['biaya_jasa']));
			$table->addOnclickTd(
				"xajax_get_pemeriksaan(" . $pemeriksaan_data[$i][id] . ", '" . addslashes($pemeriksaan_data[$i]['nama']) . "', '".($pemeriksaan_data[$i]['biaya_bhp'])."', '".($pemeriksaan_data[$i]['biaya_jasa'])."');",
				"xajax_get_pemeriksaan(" . $pemeriksaan_data[$i][id] . ", '" . addslashes($pemeriksaan_data[$i]['nama']) . "', '".($pemeriksaan_data[$i]['biaya_bhp'])."', '".($pemeriksaan_data[$i]['biaya_jasa'])."');",
				"xajax_get_pemeriksaan(" . $pemeriksaan_data[$i][id] . ", '" . addslashes($pemeriksaan_data[$i]['nama']) . "', '".($pemeriksaan_data[$i]['biaya_bhp'])."', '".($pemeriksaan_data[$i]['biaya_jasa'])."');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("pemeriksaan_navi", "innerHTML", $pemeriksaan_navi);
		$objResponse->addAssign("list_pemeriksaan","innerHTML", $tabel);
		return $objResponse;
	}

	function get_pemeriksaan($id, $nama, $biaya_bhp, $biaya_jasa) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[radio][hak];
		$opt = "<select name=\"input_pemeriksaan_hak[]\" id=\"input_pemeriksaan_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_pemeriksaan_biaya_bhp_".$n."', event, 'input_pemeriksaan_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 36) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";
		$ret .= "<tr id=\"input_pemeriksaan_tr_".$n."\">";
		$ret .= "<td>".$nama."</td>";
		$ret .= "<td style=\"text-align:center;\">".$opt."</td>";
	/*	$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_pemeriksaan_biaya_bhp[]\" id=\"input_pemeriksaan_biaya_bhp_".$n."\" value=\"".($biaya_bhp)."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', this.value, document.getElementById('input_pemeriksaan_biaya_jasa_".$n."').value, document.getElementById('input_pemeriksaan_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_pemeriksaan_biaya_jasa_".$n."', event, 'input_pemeriksaan_hak_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_pemeriksaan_biaya_jasa[]\" id=\"input_pemeriksaan_biaya_jasa_".$n."\" value=\"".($biaya_jasa)."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', this.value, document.getElementById('input_pemeriksaan_biaya_bhp_".$n."').value, document.getElementById('input_pemeriksaan_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_pemeriksaan_jml_".$n."', event, 'input_pemeriksaan_biaya_bhp_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td style=\"text-align:center;\">";
		$ret .= "<input type=\"text\" name=\"input_pemeriksaan_jml[]\" id=\"input_pemeriksaan_jml_".$n."\" value=\"1\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', document.getElementById('input_pemeriksaan_biaya_bhp_".$n."').value, document.getElementById('input_pemeriksaan_biaya_jasa_".$n."').value, this.value);\" onkeypress=\"focusNext( 'input_pemeriksaan_bayar_".$n."', event, 'input_pemeriksaan_biaya_".$n."', this)\" />";
		$ret .= "</td>";*/
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_pemeriksaan_bayar[]\" id=\"input_pemeriksaan_bayar_".$n."\" value=\"".($biaya_bhp+$biaya_jasa)."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_pemeriksaan_hak_".$n."', event, 'input_pemeriksaan_jml_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('','input_pemeriksaan_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_pemeriksaan_id[]\" id=\"input_kunjungan_pemeriksaan_id_".$n."\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_pemeriksaan[]\" id=\"input_pemeriksaan_".$n."\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_pemeriksaan_nama[]\" value=\"".$nama."\" />";
		$ret .= "</td>";
		$ret .= "<tr>";
		$objResponse = new xajaxResponse;
		$objResponse->addAppend("tbody_input_pemeriksaan", "innerHTML", $ret);
		return $objResponse;
	}

	function get_pemeriksaan_from_kunjungan($arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$data_hak = $_SESSION[radio][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$hak = "<select name=\"input_pemeriksaan_hak[]\" id=\"input_pemeriksaan_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_pemeriksaan_biaya_bhp_".$n."', event, 'input_pemeriksaan_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			$ret .= "<tr id=\"input_pemeriksaan_tr_".$n."\">";
			$ret .= "<td>".$arr[$j][nama]."</td>";
			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";
		/*	$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_pemeriksaan_biaya_bhp[]\" id=\"input_pemeriksaan_biaya_bhp_".$n."\" value=\"".$arr[$j][biaya_bhp]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', this.value, document.getElementById('input_pemeriksaan_biaya_jasa_".$n."').value, document.getElementById('input_pemeriksaan_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_pemeriksaan_biaya_jasa_".$n."', event, 'input_pemeriksaan_hak_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_pemeriksaan_biaya_jasa[]\" id=\"input_pemeriksaan_biaya_jasa_".$n."\" value=\"".$arr[$j][biaya_jasa]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', this.value, document.getElementById('input_pemeriksaan_biaya_bhp_".$n."').value, document.getElementById('input_pemeriksaan_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_pemeriksaan_jml_".$n."', event, 'input_pemeriksaan_biaya_bhp_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td style=\"text-align:center;\">";
			$ret .= "<input type=\"text\" name=\"input_pemeriksaan_jml[]\" id=\"input_pemeriksaan_jml_".$n."\" value=\"".$arr[$j][jumlah]."\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan('input_pemeriksaan_bayar_".$n."', document.getElementById('input_pemeriksaan_biaya_bhp_".$n."').value, document.getElementById('input_pemeriksaan_biaya_jasa_".$n."').value, this.value);\" onkeypress=\"focusNext( 'input_pemeriksaan_bayar_".$n."', event, 'input_pemeriksaan_biaya_jasa_".$n."', this)\" />";
			$ret .= "</td>";*/
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_pemeriksaan_bayar[]\" id=\"input_pemeriksaan_bayar_".$n."\" value=\"".($arr[$j][biaya_jasa])."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_pemeriksaan_hak_".$n."', event, 'input_pemeriksaan_jml_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('".$arr[$j][kunjungan_bayar_id]."','input_pemeriksaan_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_pemeriksaan_id[]\" id=\"input_kunjungan_pemeriksaan_id_".$n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_pemeriksaan[]\" id=\"input_pemeriksaan_".$n."\" value=\"".$arr[$j][pemeriksaan_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_pemeriksaan_nama[]\" value=\"\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
		}
		$objResponse->addAppend("tbody_input_pemeriksaan", "innerHTML", $ret);
		return $objResponse;
	}
}


Class BHP {
	
	function cari_bhp($hal = 0, $val) {
		$val[bhp] = addslashes($val[bhp]);
		$q = " AND nama LIKE '%".$val[bhp]."%' ";
		$paging = new MyPagina;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		
		$paging->sql = "select db_apotek.ms_barang.id as id, db_apotek.ms_barang.kd_barang as kd_barang,db_apotek.ms_barang.nama as nama,
          barang_unit.stok as stok, db_apotek.barang_unit.fld02 as biaya from db_apotek.ms_barang, db_apotek.barang_unit 
where db_apotek.ms_barang.id = db_apotek.barang_unit.barang_id";  

		 $paging->onclick_func = "xajax_cari_obat";
         $paging->setOnclickValue("xajax.getFormValues('cari_obat')");
         $paging->get_page_result();

         $bhp_data = $paging->data;
         $bhp_no = $paging->start_number();
         $bhp_navi = $paging->navi();


         $objResponse = new xajaxResponse();

         $table = new Table;
         $table->tbody_height = 200;
         $table->addTh("No", "Obat", "Harga");
         $table->addExtraTh("style=\"width:30px\"", "", "");
         for($i = 0; $i < sizeof($bhp_data); $i++) {
            $table->addRow(($bhp_no + $i), $bhp_data[$i]['nama'], uangIndo($bhp_data[$i]['biaya']));
            $table->addOnclickTd("xajax_get_bhp(".$bhp_data[$i]['id'].", '".addslashes($bhp_data[$i]['nama']).
               "', '".($bhp_data[$i]['biaya'])."');", "xajax_get_bhp(".$bhp_data[$i]['id'].", '".
               addslashes($bhp_data[$i]['nama'])."', '".($bhp_data[$i]['biaya'])."');",
               "xajax_get_bhp(".$bhp_data[$i]['id'].", '".addslashes($bhp_data[$i]['nama']).
               "', '".($bhp_data[$i]['biaya'])."');");
         }
         $tabel = $table->build();
         $objResponse->addAssign("bhp_navi", "innerHTML", $bhp_navi);
         $objResponse->addAssign("list_bhp", "innerHTML", $tabel);
		return $objResponse;
	}

	function get_bhp($id, $nama, $biaya) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[radio][hak];
		$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 36) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";

		//get sifat
		$data_sifat = $_SESSION[radio][sifat];
		$opt_sifat = "<select name=\"input_bhp_sifat[]\" id=\"input_bhp_sifat_".$n."\" class=\"inputan\" onchange=\"kaliKan2('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_biaya_".$n."').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_jml_".$n."', event, 'input_bhp_biaya_".$n."', this)\">";
		for($i=0;$i<sizeof($data_sifat);$i++) {
			$opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\">".$data_sifat[$i][nama]."</option>";
		}
		$opt_sifat .= "</select>";
		$ret .= "<tr id=\"input_bhp_tr_".$n."\">";
		//BHP
		$ret .= "<td>".$nama."</td>";
		//HAK
		$ret .= "<td style=\"text-align:center;\">".$opt."</td>";
		//BIAYA
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_bhp_biaya[]\" id=\"input_bhp_biaya_".$n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan2('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_sifat_".$n."').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_sifat_".$n."', event, 'input_bhp_hak_".$n."', this)\" />";
		$ret .= "</td>";
		//SIFAT
		$ret .= "<td style=\"text-align:center;\">".$opt_sifat."</td>";
		//JUMLAH
		$ret .= "<td style=\"text-align:center;\">";
		$ret .= "<input type=\"text\" name=\"input_bhp_jml[]\" id=\"input_bhp_jml_".$n."\" value=\"1\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan2('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_sifat_".$n."').value, document.getElementById('input_bhp_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_bayar_".$n."', event, 'input_bhp_sifat_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_bhp_bayar[]\" id=\"input_bhp_bayar_".$n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_bhp_hak_".$n."', event, 'input_bhp_jml_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus BHP\" onclick=\"hapus_kunjungan_bayar('','input_bhp_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus BHP\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_bhp_id[]\" id=\"input_kunjungan_bhp_id_".$n."\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_bhp[]\" id=\"input_bhp_".$n."\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_bhp_nama[]\" value=\"".$nama."\" />";
		$ret .= "</td>";
		$ret .= "<tr>";
		$objResponse = new xajaxResponse;
		$objResponse->addAppend("tbody_input_bhp", "innerHTML", $ret);
		return $objResponse;
	}

	function get_bhp_from_kunjungan($arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		//get hak
		$data_hak = $_SESSION[radio][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			
			//get sifat
			$data_sifat = $_SESSION[radio][sifat];
			$opt_sifat = "<select name=\"input_bhp_sifat[]\" id=\"input_bhp_sifat_".$n."\" class=\"inputan\" onchange=\"kaliKan2('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_biaya_".$n."').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_jml_".$n."', event, 'input_bhp_biaya_".$n."', this)\">";
			for($i=0;$i<sizeof($data_sifat);$i++) {
				if($data_sifat[$i][nilai] == $arr[$j][sifat]) $opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\" selected=\"\">".$data_sifat[$i][nama]."</option>";
				else $opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\">".$data_sifat[$i][nama]."</option>";
			}
			$opt_sifat .= "</select>";

			$ret .= "<tr id=\"input_bhp_tr_".$n."\">";
			$ret .= "<td>".$arr[$j][nama]."</td>";
			$ret .= "<td style=\"text-align:center;\">".$opt."</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_bhp_biaya[]\" id=\"input_bhp_biaya_".$n."\" value=\"".$arr[$j][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_sifat_".$n."', event, 'input_bhp_hak_".$n."', this)\" />";
			$ret .= "</td>";
			//SIFAT
			$ret .= "<td style=\"text-align:center;\">".$opt_sifat."</td>";
			$ret .= "<td style=\"text-align:center;\">";
			$ret .= "<input type=\"text\" name=\"input_bhp_jml[]\" id=\"input_bhp_jml_".$n."\" value=\"".$arr[$j][jumlah]."\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan('input_bhp_bayar_".$n."', this.value, document.getElementById('input_bhp_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_bayar_".$n."', event, 'input_bhp_sifat_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_bhp_bayar[]\" id=\"input_bhp_bayar_".$n."\" value=\"".$arr[$j][bayar]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_bhp_hak_".$n."', event, 'input_bhp_jml_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus BHP\" onclick=\"hapus_kunjungan_bayar('".$arr[$j][kunjungan_bayar_id]."','input_bhp_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus BHP\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_bhp_id[]\" id=\"input_kunjungan_bhp_id_".$n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_bhp[]\" id=\"input_bhp_".$n."\" value=\"".$arr[$j][bhp_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_bhp_nama[]\" value=\"".$nama."\" />";
			$ret .= "</td>";
			$ret .= "<tr>";
		}
		$objResponse->addAppend("tbody_input_bhp", "innerHTML", $ret);
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

//pemeriksaan
$_xajax->registerFunction(array("cari_pemeriksaan", "Specimen", "cari_pemeriksaan"));
$_xajax->registerFunction(array("get_pemeriksaan", "Specimen", "get_pemeriksaan"));
$_xajax->registerFunction(array("get_pemeriksaan_from_kunjungan", "Specimen", "get_pemeriksaan_from_kunjungan"));

//bhp
$_xajax->registerFunction(array("cari_bhp", "BHP", "cari_bhp"));
$_xajax->registerFunction(array("get_bhp", "BHP", "get_bhp"));
$_xajax->registerFunction(array("get_bhp_from_kunjungan", "BHP", "get_bhp_from_kunjungan"));

$_xajax->registerFunction(array("get_total", "Kunjungan_Bayar", "get_total"));
$_xajax->registerFunction(array("hapus_kunjungan_bayar", "Kunjungan_Bayar", "hapus_kunjungan_bayar"));

?>