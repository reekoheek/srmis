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
				kk.dokter_id as id_dokter,
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
			WHERE
				kk.id = '".$id_kunjungan_kamar."'
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getOne();
/*
KARCIS :
jasa_p
jasa_rs
jasa_rs_op
jasa_rs_kembang
jasa_rs_adm
jasa_rs_sdm
spesialis
spesialis_pendamping
ugp
grabaf
perawat
penunjang
zakat
pajak
netto

BHP :
bhp_p
bhp_rs
bhp_rs_adm
bhp_rs_op

ICOPIM:
jasa_p
jasa_rs
jasa_rs_op
jasa_rs_kembang
jasa_rs_adm
jasa_rs_sdm
spesialis
spesialis_pendamping
perawat_perinatologi
dr_umum
dr_gigi
assisten_non_dokter
spesialis_anestesi
aknest
gizi
fisioterapi
analis_pa
bidan
perawat
penunjang
zakat
pajak

*/		
		//get data karcis
		$kon->sql = "
			SELECT
				id as kunjungan_bayar_id,
				karcis_id as karcis_id,
				nama as nama,
				hak_id as hak_id,
				jumlah as jumlah,
				biaya as biaya,
				bayar as bayar
			FROM
				kunjungan_bayar
			WHERE
				kunjungan_kamar_id = '".$id_kunjungan_kamar."'
				AND karcis_id IS NOT NULL
			GROUP BY 
				id
		";
		$kon->execute();
		$data_kc = $kon->getAll();
		
		//get data tindakan
		$kon->sql = "
			SELECT
				kkic.id as kunjungan_icopim_id,
				kby.id as kunjungan_bayar_id,
				kkic.nama as nama,
				kby.nama as kolom,
				kby.hak_id as hak_id,
				kby.sifat as sifat,
				kby.biaya as biaya,
				kby.jumlah as jumlah,
				kby.bayar as bayar
			FROM
				kunjungan_kamar_icopim kkic
				JOIN kunjungan_bayar kby ON (kby.kunjungan_kamar_icopim_id = kkic.id)
			WHERE
				kkic.kunjungan_kamar_id = '".$id_kunjungan_kamar."'
			GROUP BY 
				kby.id
			ORDER BY
				kkic.id, kby.id
		";
		$kon->execute();
		$data_ic = $kon->getAll();
		
		//get data BHP
		$kon->sql = "
			SELECT
				id as kunjungan_bayar_id,
				nama as nama,
				hak_id as hak_id,
				jumlah as jumlah,
				sifat as sifat,
				biaya as biaya,
				bayar as bayar
			FROM
				kunjungan_bayar
			WHERE
				kunjungan_kamar_id = '".$id_kunjungan_kamar."'
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
		$objResponse->addAssign("input_id_kunjungan_kamar", "value", $data[id_kunjungan_kamar]);
		$objResponse->addAssign("input_id_kunjungan", "value", $data[id_kunjungan]);
		$objResponse->addAssign("icopim_kelas", "value", $data[kelas]);
		
		$objResponse->addAssign("input_kunjungan_ke", "innerHTML", $data[kunjungan_ke]);
		$objResponse->addAssign("input_spesialisasi", "innerHTML", $data[spesialisasi]);
		$objResponse->addScriptCall("xajax_ref_get_dokter_from_kamar", "input_dokter_id", $data[id_kamar], $data[id_dokter]);

		//set default
		$kelanjutan = empty($data[kelanjutan])?"PULANG":$data[kelanjutan];
		$objResponse->addAssign("input_kelanjutan", "value", $kelanjutan);
		$keadaan_keluar = empty($data[keadaan_keluar])?"SEMBUH":$data[keadaan_keluar];
		$objResponse->addAssign("input_keadaan_keluar", "value", $keadaan_keluar);

		//tanggal keluar
		$tgl_keluar = explode("-", $data[tgl_keluar]);
		$objResponse->addAssign("input_tgl_keluar_thn", "value", $tgl_keluar[2]);
		$objResponse->addAssign("input_tgl_keluar_bln", "value", $tgl_keluar[1]);
		$objResponse->addAssign("input_tgl_keluar_tgl", "value", $tgl_keluar[0]);
		$wkt_keluar = explode(":", $data[wkt_keluar]);
		$objResponse->addAssign("input_tgl_keluar_jam", "value", $wkt_keluar[0]);
		$objResponse->addAssign("input_tgl_keluar_mnt", "value", $wkt_keluar[1]);

		$objResponse->addAssign("input_tgl_daftar", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("input_tgl_periksa", "innerHTML", tanggalIndo($data[tgl_daftar], 'j F Y'));

		//tab diagnosa_tindakan
		$objResponse->addAssign("input_diagnosa_utama", "value", $data[diagnosa_utama_id]);
		$objResponse->addAssign("input_diagnosa_utama_nama", "innerHTML", $data[diagnosa_utama_nama]);

		if(!empty($data_kc)) $objResponse->addScriptCall("xajax_get_karcis_from_kunjungan", $data_kc);
		if(!empty($data_bhp)) $objResponse->addScriptCall("xajax_get_bhp_from_kunjungan", $data_bhp);
		if(!empty($data_ic)) $objResponse->addScriptCall("xajax_get_icopim_from_kunjungan", $data_ic);
		//$idkk[input_id_kunjungan_kamar] = $data[id_kunjungan_kamar];
		//$objResponse->addScriptCall("xajax_get_total", $idkk);

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_dokter_id");
		return $objResponse;
	}

	function simpan_kunjungan($value, $langsung_bayar = false, $tutup_modal = true) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		$kon = new Konek;
		//update
		$kon->sql = "
			UPDATE
				kunjungan
			SET 
				keadaan_keluar = '".$val[input_keadaan_keluar]."'
			WHERE
				id = '".$val[input_id_kunjungan]."'
		";
		$kon->execute();

		//update
		$sql = "
			UPDATE
				kunjungan_kamar
			SET
				dokter_id = NULLIF('".$val[input_dokter_id]."', ''),
				kelanjutan = NULLIF('".$val[input_kelanjutan]."',''),
				diagnosa_utama_id = NULLIF('".$val[input_diagnosa_utama]."', ''),
				tgl_keluar = '".$val[input_tgl_keluar_thn]."-".$val[input_tgl_keluar_bln]."-".$val[input_tgl_keluar_tgl]." ".$val[input_tgl_keluar_jam].":".$val[input_tgl_keluar_mnt].":00'
			WHERE
				id = '".$val[input_id_kunjungan_kamar]."'
		";

		$kon->sql = $sql;
		$kon->execute();
		$afek = $kon->affected_rows;
		$objResponse = new xajaxResponse();
//LANGSUNG BAYAR
		if($langsung_bayar == true) {
			$id_kwitansi = bikinKwitansi();
			$mampu_bayar = @round($val[mampu]/$val[total]);
		} else {
			$id_kwitansi = NULL;
			$mampu_bayar = 1;
		}
		//$objResponse->addAlert(print_r($val));
		//$objResponse->addAppend("debug", "innerHTML", $mampu_bayar);
//INSERT UPDATE KARCIS
		for($i=0;$i<sizeof($val[input_karcis]);$i++) {
			$kunci = key($val[input_karcis]);
			//get
/*
			$kon->sql = "SELECT * FROM karcis WHERE id = '".$val[input_karcis][$kunci]."'";
			$kon->execute();
			$data_karcis[$i] = $kon->getOne();

			$jasa_p[$i] = $data_karcis[$i][jasa_p] * $val[input_karcis_bayar][$kunci];
			$jasa_rs[$i] = $data_karcis[$i][jasa_rs] * $val[input_karcis_bayar][$kunci];
			$jasa_rs_op[$i] = $data_karcis[$i][jasa_rs_op] * $val[input_karcis_bayar][$kunci];
			$jasa_rs_kembang[$i] = $data_karcis[$i][jasa_rs_kembang] * $val[input_karcis_bayar][$kunci];
			$jasa_rs_adm[$i] = $data_karcis[$i][jasa_rs_adm] * $val[input_karcis_bayar][$kunci];
			$jasa_rs_sdm[$i] = $data_karcis[$i][jasa_rs_sdm] * $val[input_karcis_bayar][$kunci];
			$spesialis[$i] = $data_karcis[$i][spesialis] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$spesialis_pendamping[$i] = $data_karcis[$i][spesialis_pendamping] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$ugp[$i] = $data_karcis[$i][ugp] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$grabaf[$i] = $data_karcis[$i][grabaf] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$perawat[$i] = $data_karcis[$i][perawat] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$penunjang[$i] = $data_karcis[$i][penunjang] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$zakat[$i] = $data_karcis[$i][zakat] * $val[input_karcis_bayar][$kunci] * $data_karcis[$i][netto];
			$pajak[$i] = $data_karcis[$i][pajak] * ($val[input_karcis_bayar][$kunci] - ($jasa_p[$i] + $jasa_rs_op[$i] + $jasa_rs_kembang[$i] + $jasa_rs_adm[$i] + $jasa_rs_sdm[$i]));
			//$objResponse->addAlert("pajak : " . $pajak[$i]);
*/			
			if(!$val[input_kunjungan_karcis_id][$kunci]) {
				//insert
				$sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						karcis_id, 
						hak_id, 
						biaya,
						jumlah, 
						bayar,
						mampu_bayar,
						jasa_p,
						jasa_rs,
						jasa_rs_op,
						jasa_rs_kembang,
						jasa_rs_adm,
						jasa_rs_sdm,
						spesialis,
						spesialis_pendamping,
						ugp,
						grabaf,
						perawat,
						penunjang,
						zakat,
						pajak
					)	SELECT
							'".$val[input_karcis_nama][$i]."', 
							'".$val[input_id_kunjungan_kamar]."', 
							'".$val[input_karcis][$kunci]."', 
							'".$val[input_karcis_hak][$kunci]."', 
							'".$val[input_karcis_biaya][$kunci]."',
							'".$val[input_karcis_jml][$kunci]."', 
							'".$val[input_karcis_bayar][$kunci]."',
							'".($val[input_karcis_bayar][$kunci]*$mampu_bayar)."',
							jasa_p,
							jasa_rs,
							jasa_rs_op,
							jasa_rs_kembang,
							jasa_rs_adm,
							jasa_rs_sdm,
							spesialis,
							spesialis_pendamping,
							ugp,
							grabaf,
							perawat,
							penunjang,
							zakat,
							pajak 
						FROM
							karcis
						WHERE 
							id = '".$val[input_karcis][$kunci]."'
					";
				$kon->sql = $sql;
				$kon->execute();
			} else {
				//update
				$sql = "
				UPDATE 
					kunjungan_bayar 
				SET 
					hak_id = '".$val[input_karcis_hak][$kunci]."', 
					biaya = '".$val[input_karcis_biaya][$kunci]."', 
					jumlah = '".$val[input_karcis_jml][$kunci]."', 
					bayar = '".$val[input_karcis_bayar][$kunci]."',
					mampu_bayar = '".($val[input_karcis_bayar][$kunci]*$mampu_bayar)."'
				WHERE 
					id = '".$val[input_kunjungan_karcis_id][$kunci]."'";
				$kon->sql = $sql;
				$kon->execute();
				//$objResponse->addAppend("debug", "innerHTML", $sql);
			}
			//$objResponse->addAppend("debug", "innerHTML", $sql);
			next($val[input_karcis]);
		}

//TINDAKAN
		for($i=0;$i<sizeof($val[input_icopim]);$i++) {
			$kunci = key($val[input_icopim]);
			$parent = $val[input_icopim_parent][$i];
			//get
			if(!$val[input_kunjungan_icopim_id][$kunci] && $val[input_icopim][$kunci]) {
				//insert
				$sql = "INSERT INTO kunjungan_kamar_icopim (kunjungan_kamar_id, icopim_id, nama) VALUES ('".$val[input_id_kunjungan_kamar]."', '".$val[input_icopim][$kunci]."', '".$val[input_icopim_nama][$kunci]."')";
				$kon->sql = $sql;
				$kon->execute();
				$id_kki = $kon->last_id;
				//$objResponse->addAppend("debug", "innerHTML", $parent . "<br /><br />");
/*diinsert satu satu*/
				for($j=0;$j<sizeof($val[input_icopim_detil_field][$parent]);$j++) {
					$field = "";
					$field = $val[input_icopim_detil_field][$parent][$j];
/*
					$netto = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_netto][$parent];
					$zakat = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_netto][$parent] * $val[input_icopim_detil_zakat][$parent];
					$pajak = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_pajak][$parent];
*/
					//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $val[input_icopim_detil_bayar][$parent][$field] . "<br />");
					if($field == "jasa_rumah_sakit") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, jasa_p, jasa_rs, jasa_rs_op, jasa_rs_kembang, jasa_rs_adm, jasa_rs_sdm) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."',  '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', jasa_p, jasa_rs, jasa_rs_op, jasa_rs_kembang, jasa_rs_adm, jasa_rs_sdm FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";

					} elseif($field == "spesialis") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, spesialis, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";

					} elseif($field == "spesialis_pendamping") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, spesialis_pendamping, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "perawat_perinatologi") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, perawat_perinatologi, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "dr_umum") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, dr_umum, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "dr_gigi") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, dr_gigi, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "assisten_non_dokter") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, assisten_non_dokter, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "spesialis_anestesi") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, spesialis_anestesi, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "aknest") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, aknest, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "gizi") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, gizi, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "fisioterapi") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, fisioterapi, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "analis_pa") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, analis_pa, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "bidan") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, bidan, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "perawat") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, perawat, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} elseif($field == "penunjang") {
						$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya, sifat, jumlah, bayar, mampu_bayar, penunjang, pajak, zakat) SELECT '".$field."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$parent]."', '".$val[input_icopim_detil_hak][$parent][$j]."', '".$val[input_icopim_detil_biaya][$parent][$j]."', '".$val[input_icopim_detil_sifat][$parent][$j]."', '".$val[input_icopim_detil_jml][$parent][$j]."', '".$val[input_icopim_detil_bayar][$parent][$j]."', '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."', netto, pajak, zakat FROM icopim_detil WHERE id = '".$val[input_icopim_detil][$parent]."'";
					
					} else {
						//lain-lain
					}
					//$objResponse->addAppend("debug", "innerHTML", $sql . "<br /><br />");
					$kon->sql = $sql;
					$kon->execute();
				}

			} else {
				//UPDATE
/*diinsert satu satu*/
				for($j=0;$j<sizeof($val[input_icopim_detil_field][$parent]);$j++) {
					$field = "";
					$field = $val[input_icopim_detil_field][$parent][$j];
					/*
					$netto = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_netto][$parent];
					$zakat = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_netto][$parent] * $val[input_icopim_detil_zakat][$parent];
					$pajak = $val[input_icopim_detil_bayar][$parent][$field] * $val[input_icopim_detil_pajak][$parent];
					*/

					//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $val[input_icopim_detil_bayar][$parent][$field] . "<br />");
					if($field == "jasa_rumah_sakit") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."', jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";

					} elseif($field == "spesialis") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";

					} elseif($field == "spesialis_pendamping") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "perawat_perinatologi") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "dr_umum") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "dr_gigi") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "assisten_non_dokter") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "spesialis_anestesi") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "aknest") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "gizi") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "fisioterapi") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "analis_pa") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "bidan") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "perawat") {
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} elseif($field == "penunjang") {
						//penunjang
						$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_detil_hak][$parent][$j]."', biaya = '".$val[input_icopim_detil_biaya][$parent][$j]."', sifat = '".$val[input_icopim_detil_sifat][$parent][$j]."',jumlah = '".$val[input_icopim_detil_jml][$parent][$j]."', bayar = '".$val[input_icopim_detil_bayar][$parent][$j]."', mampu_bayar = '".($val[input_icopim_detil_bayar][$parent][$j]*$mampu_bayar)."' WHERE id = '".$val[input_kunjungan_icopim_detil_id][$parent][$j]."'";
					
					} else {
						//lain-lain
					}
					//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $sql . "<br /><br />");
					$kon->sql = $sql;
					$kon->execute();
				} //endfor

			}
			next($val[input_icopim]);
		}

//BHP
		for($i=0;$i<sizeof($val[input_bhp]);$i++) {
			$kunci = key($val[input_bhp]);
/*
			//get
			$sql = "SELECT * FROM bhp WHERE id = '".$val[input_bhp][$kunci]."'";
			$kon->sql = $sql;
			$kon->execute();
			$data_bhp[$i] = $kon->getOne();
			
			//$objResponse->addAssign("debug", "innerHTML", $sql);
			
			$bhp_p[$i] = $data_bhp[$i][bhp_p] * $val[input_bhp_bayar][$kunci];
			$bhp_rs[$i] = $data_bhp[$i][bhp_rs] * $val[input_bhp_bayar][$kunci];
			$bhp_rs_adm[$i] = $data_bhp[$i][bhp_rs_adm] * $val[input_bhp_bayar][$kunci];
			$bhp_rs_op[$i] = $data_bhp[$i][bhp_rs_op] * $val[input_bhp_bayar][$kunci];
*/			
			if(!$val[input_kunjungan_bhp_id][$kunci]) {
				//insert
				$sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						bhp_id, 
						hak_id, 
						biaya,
						sifat,
						jumlah, 
						bayar,
						mampu_bayar,
						bhp_p,
						bhp_rs,
						bhp_rs_adm,
						bhp_rs_op
					)	SELECT 
							'".$val[input_bhp_nama][$i]."', 
							'".$val[input_id_kunjungan_kamar]."', 
							'".$val[input_bhp][$kunci]."', 
							'".$val[input_bhp_hak][$kunci]."', 
							'".$val[input_bhp_biaya][$kunci]."',
							'".$val[input_bhp_sifat][$kunci]."', 
							'".$val[input_bhp_jml][$kunci]."', 
							'".$val[input_bhp_bayar][$kunci]."',
							'".($val[input_bhp_bayar][$kunci]*$mampu_bayar)."',
							bhp_p,
							bhp_rs,
							bhp_rs_adm,
							bhp_rs_op
						FROM 
							bhp
						WHERE
							id = '".$val[input_bhp][$kunci]."'
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
					bayar = '".$val[input_bhp_bayar][$kunci]."',
					mampu_bayar = '".($val[input_bhp_bayar][$kunci]*$mampu_bayar)."'
				WHERE 
					id = '".$val[input_kunjungan_bhp_id][$kunci]."'";
				$kon->sql = $sql;
				//$objResponse->addAssign("debug", "innerHTML", $sql);
				$kon->execute();
			}
			next($val[input_bhp]);
		}
		
		if($tutup_modal == true) {
			if($afek < 0) {
				$objResponse->addAlert("Data Kunjungan Tidak Dapat Disimpan\nHubungi Bagian SIM.");
			} else {
				$objResponse->addScriptCall("list_data", "0");
				$objResponse->addScriptCall("tutup_kunjungan");
				$objResponse->addScriptCall("show_status_simpan");
			}
		} else {
			$objResponse->addScriptCall("xajax_buka_kunjungan", $val[input_id_kunjungan_kamar]);
			//$objResponse->addScriptCall("get_total", false);
		}
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
				REPLACE(kode_icd, '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as kode_icd,
				REPLACE(nama, '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as nama,
				REPLACE(gol_sebab_sakit, '".$val[diagnosa]."','<b>".$val[diagnosa]."</b>') as gol_sebab_sakit
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
		$table->tbody_height = 200;
		$table->addTh("No", "Kode", "Nama", "Gol. Sebab Sakit");
		$table->addExtraTh("style=\"width:40px\"", "style=\"width:40px\"", "style=\"width:200px\"");
		
		for($i=0;$i<sizeof($diagnosa_data);$i++) {
			$table->addRow(($diagnosa_no+$i), $diagnosa_data[$i]['kode_icd'], $diagnosa_data[$i]['nama'], $diagnosa_data[$i]['gol_sebab_sakit']);

			$table->addOnclickTd(
				"get_diagnosa(" . $diagnosa_data[$i][id] . ", '" . $diagnosa_data[$i]['kode_icd'] . "-" . addslashes($diagnosa_data[$i]['nama']) . "');",
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

Class Karcis {
	
	function cari_karcis($hal = 0, $val) {
		$val[karcis] = addslashes($val[karcis]);
		$q = " AND nama LIKE '%".$val[karcis]."%' ";
		$paging = new MyPagina;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		
		$paging->sql = "
			SELECT 
				id as id,
				REPLACE(nama, '".$val[karcis]."','<b>".$val[karcis]."</b>') as nama_replace,
				nama as nama,
				biaya as biaya
			FROM 
				karcis
			WHERE
				pelayanan_id = '1' 
				$q
			ORDER BY 
				nama
			";
		
		$paging->onclick_func = "xajax_cari_karcis";
		$paging->setOnclickValue("xajax.getFormValues('cari_karcis')");
		$paging->get_page_result();

		$karcis_data = $paging->data;
		$karcis_no = $paging->start_number();
		$karcis_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "Jasa", "Biaya");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($karcis_data);$i++) {
			$table->addRow(($karcis_no+$i), $karcis_data[$i]['nama_replace'], uangIndo($karcis_data[$i]['biaya']));
			$table->addOnclickTd(
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya'])."');",
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya'])."');",
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya'])."');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("karcis_navi", "innerHTML", $karcis_navi);
		$objResponse->addAssign("list_karcis","innerHTML", $tabel);
		return $objResponse;
	}

	function get_karcis($id, $nama, $biaya) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[igd][hak];
		$opt = "<select name=\"input_karcis_hak[]\" id=\"input_karcis_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_karcis_biaya_".$n."', event, 'input_karcis_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";
		$ret .= "<tr id=\"input_karcis_tr_".$n."\">";
		$ret .= "<td>".$nama."</td>";
		$ret .= "<td style=\"text-align:center;\">".$opt."</td>";
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_karcis_biaya[]\" id=\"input_karcis_biaya_".$n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_karcis_bayar_".$n."', this.value, document.getElementById('input_karcis_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_karcis_jml_".$n."', event, 'input_karcis_hak_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td style=\"text-align:center;\">";
		$ret .= "<input type=\"text\" name=\"input_karcis_jml[]\" id=\"input_karcis_jml_".$n."\" value=\"1\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan('input_karcis_bayar_".$n."', this.value, document.getElementById('input_karcis_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_karcis_bayar_".$n."', event, 'input_karcis_biaya_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_karcis_bayar[]\" id=\"input_karcis_bayar_".$n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_karcis_hak_".$n."', event, 'input_karcis_jml_".$n."', this)\" />";
		$ret .= "</td>";
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('','input_karcis_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_karcis_id[]\" id=\"input_kunjungan_karcis_id_".$n."\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis[]\" id=\"input_karcis_".$n."\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis_nama[]\" value=\"".$nama."\" />";
		$ret .= "</td>";
		$ret .= "<tr>";
		$objResponse = new xajaxResponse;
		$objResponse->addAppend("tbody_input_karcis", "innerHTML", $ret);
		return $objResponse;
	}

	function get_karcis_from_kunjungan($arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$data_hak = $_SESSION[igd][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$hak = "<select name=\"input_karcis_hak[]\" id=\"input_karcis_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_karcis_biaya_".$n."', event, 'input_karcis_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			$ret .= "<tr id=\"input_karcis_tr_".$n."\">";
			$ret .= "<td>".$arr[$j][nama]."</td>";
			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_karcis_biaya[]\" id=\"input_karcis_biaya_".$n."\" value=\"".$arr[$j][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_karcis_bayar_".$n."', this.value, document.getElementById('input_karcis_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_karcis_jml_".$n."', event, 'input_karcis_hak_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td style=\"text-align:center;\">";
			$ret .= "<input type=\"text\" name=\"input_karcis_jml[]\" id=\"input_karcis_jml_".$n."\" value=\"".$arr[$j][jumlah]."\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan('input_karcis_bayar_".$n."', this.value, document.getElementById('input_karcis_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_karcis_bayar_".$n."', event, 'input_karcis_biaya_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_karcis_bayar[]\" id=\"input_karcis_bayar_".$n."\" value=\"".$arr[$j][bayar]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_karcis_hak_".$n."', event, 'input_karcis_jml_".$n."', this)\" />";
			$ret .= "</td>";
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('".$arr[$j][kunjungan_bayar_id]."','input_karcis_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_karcis_id[]\" id=\"input_kunjungan_karcis_id_".$n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis[]\" id=\"input_karcis_".$n."\" value=\"".$arr[$j][karcis_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis_nama[]\" value=\"\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
		}
		$objResponse->addAppend("tbody_input_karcis", "innerHTML", $ret);
		return $objResponse;
	}
}


Class Tindakan {
	
	function cari_icopim($hal = 0, $val) {
		$val[icopim] = addslashes($val[icopim]);
		$q = " AND i.nama LIKE '%".$val[icopim]."%' ";
		$paging = new MyPagina;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		
		$paging->sql = "
			SELECT 
				i.id as id,
				id.id as detil_id,
				REPLACE(i.nama, '".$val[icopim]."','<b>".$val[icopim]."</b>') as nama_replace,
				nama as nama,
				id.kelas as kelas,
				id.biaya as biaya
			FROM 
				icopim i
				JOIN icopim_detil id ON (id.icopim_id = i.id)
			WHERE
				id.kelas IN(NULL, '".$val[icopim_kelas]."')
				$q
			GROUP BY
				i.id
			ORDER BY 
				i.nama
			";
		
		$paging->onclick_func = "xajax_cari_icopim";
		$paging->setOnclickValue("xajax.getFormValues('cari_icopim')");
		$paging->get_page_result();

		$icopim_data = $paging->data;
		$icopim_no = $paging->start_number();
		$icopim_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "Tindakan", "Kelas", "Biaya");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($icopim_data);$i++) {
			$table->addRow(($icopim_no+$i), $icopim_data[$i]['nama_replace'], $icopim_data[$i]['kelas'], uangIndo($icopim_data[$i]['biaya']));
			$table->addOnclickTd(
				"xajax_get_icopim(" . $icopim_data[$i][id] . ", " . $icopim_data[$i][detil_id] . ", '" . addslashes($icopim_data[$i]['nama']) . "', '".($icopim_data[$i]['biaya'])."');",
				"xajax_get_icopim(" . $icopim_data[$i][id] . ", " . $icopim_data[$i][detil_id] . ", '" . addslashes($icopim_data[$i]['nama']) . "', '".($icopim_data[$i]['biaya'])."');",
				"xajax_get_icopim(" . $icopim_data[$i][id] . ", " . $icopim_data[$i][detil_id] . ", '" . addslashes($icopim_data[$i]['nama']) . "', '".($icopim_data[$i]['biaya'])."');",
				"xajax_get_icopim(" . $icopim_data[$i][id] . ", " . $icopim_data[$i][detil_id] . ", '" . addslashes($icopim_data[$i]['nama']) . "', '".($icopim_data[$i]['biaya'])."');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("icopim_navi", "innerHTML", $icopim_navi);
		$objResponse->addAssign("list_icopim","innerHTML", $tabel);
		return $objResponse;
	}

	function get_icopim($id, $detil_id, $nama, $biaya) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$parent = md5(microtime());
		
		//get icopim_detil
		$kon->sql = "SELECT * FROM icopim_detil WHERE id = '".$detil_id."'";
		$kon->execute();
		$data_icopim_detil = $kon->getOne();
		$field_icopim_detil = $kon->getField();

		$ret .= "<tr id=\"input_icopim_tr_".$parent."\" style=\"background-color: #EDEDED;\">";

		//Tindakan
		$ret .= "<td><b>".$nama."</b></td>";
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Tindakan\" onclick=\"hapus_kunjungan_kamar_icopim('','input_icopim_tr_".$parent."','input_icopim_table_".$parent."')\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Tindakan\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_id[".$parent."]\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim[".$parent."]\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim_nama[".$parent."]\" value=\"".$nama."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim_parent[]\" value=\"".$parent."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim_detil[".$parent."]\" value=\"".$data_icopim_detil[id]."\" />";
		$ret .= "</td>";
		$ret .= "<tr id=\"input_icopim_table_".$parent."\"><td colspan=\"2\">";
		$ret .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tabel_biaya\"><tr><th style=\"width:200px;\">Jasa</th><th>Hak</th><th>Biaya</th><th>Sifat</th><th style=\"width:70px;\">Jml</th><th style=\"width:100px;\">Bayar</th><th style=\"width:20px;\">&nbsp;</th></tr>";
		
		//get hak
		$data_hak = $_SESSION[igd][hak];
		$opt_hak = "";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt_hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt_hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}

		//get sifat
		$data_sifat = $_SESSION[igd][sifat];
		$opt_sifat = "";
		for($i=0;$i<sizeof($data_sifat);$i++) {
			$opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\">".$data_sifat[$i][nama]."</option>";
		}

		for($j=11;$j<25;$j++) {
			if($data_icopim_detil[$field_icopim_detil[$j]->name] == "0") continue;
			$n = md5(microtime());
			$nama_baris = ucwords(str_replace("_", " ", $field_icopim_detil[$j]->name));
			$ret .= "<tr id=\"input_icopim_detil_tr_".$n."\">";
			$ret .= "<td>".$nama_baris."</td>";

			//HAK
			$hak = "<select name=\"input_icopim_detil_hak[".$parent."][]\" id=\"input_icopim_detil_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_icopim_detil_biaya_".$n."', event, 'input_icopim_detil_bayar_".$n."', this)\">" . $opt_hak . "</select>";

			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";
			//BIAYA
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_biaya[".$parent."][]\" id=\"input_icopim_detil_biaya_".$n."\" value=\"".$data_icopim_detil[$field_icopim_detil[$j]->name]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_sifat_".$n."').value, document.getElementById('input_icopim_detil_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_sifat_".$n."', event, 'input_icopim_detil_hak_".$n."', this)\" />";
			$ret .= "</td>";

			//SIFAT
			$sifat = "<select name=\"input_icopim_detil_sifat[".$parent."][]\" id=\"input_icopim_detil_sifat_".$n."\" class=\"inputan\" onchange=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_biaya_".$n."').value, document.getElementById('input_icopim_detil_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_jml_".$n."', event, 'input_icopim_detil_biaya_".$n."', this)\">" . $opt_sifat . "</select>";
		
			$ret .= "<td style=\"text-align:center;\">".$sifat."</td>";
			//JUMLAH
			$ret .= "<td style=\"text-align:center;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_jml[".$parent."][]\" id=\"input_icopim_detil_jml_".$n."\" value=\"1\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_sifat_".$n."').value, document.getElementById('input_icopim_detil_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_bayar_".$n."', event, 'input_icopim_detil_sifat_".$n."', this)\" />";
			$ret .= "</td>";

			//BAYAR
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_bayar[".$parent."][]\" id=\"input_icopim_detil_bayar_".$n."\" value=\"".$data_icopim_detil[$field_icopim_detil[$j]->name]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_icopim_detil_hak_".$n."', event, 'input_icopim_detil_jml_".$n."', this)\" />";
			$ret .= "</td>";

			//HAPUS
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus ".$nama_baris."\" onclick=\"hapus_kunjungan_bayar('','input_icopim_detil_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus ".$nama_baris."\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_detil_id[".$parent."][]\" value=\"\" />";
			$ret .= "<input type=\"hidden\" name=\"input_icopim_detil_field[".$parent."][]\" value=\"".$field_icopim_detil[$j]->name."\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
		}
		$ret .= "</table></td></tr>";
		$objResponse->addAppend("tbody_input_icopim", "innerHTML", $ret);
		return $objResponse;
	}

	function get_icopim_from_kunjungan($arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		for($k=0;$k<sizeof($arr);$k++) {
			
			if($arr[$k][kunjungan_icopim_id] != $arr[$k-1][kunjungan_icopim_id]) {
				$parent = md5(microtime());
				if($k !=0) $ret .= "</table></td></tr>";

				//Tindakan
				$ret .= "<tr id=\"input_icopim_tr_".$parent."\" style=\"background-color: #EDEDED;\">";
				$ret .= "<td><b>".$arr[$k][nama]."</b></td>";
				$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Tindakan\" onclick=\"hapus_kunjungan_kamar_icopim('".$arr[$k][kunjungan_icopim_id]."','input_icopim_tr_".$parent."','input_icopim_table_".$parent."')\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Tindakan\" border=\"0\" /></a>";
				$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_id[]\" value=\"".$arr[$k][kunjungan_icopim_id]."\" />";
				$ret .= "<input type=\"hidden\" name=\"input_icopim[]\" value=\"".$id."\" />";
				$ret .= "<input type=\"hidden\" name=\"input_icopim_parent[]\" value=\"".$parent."\" />";
				//$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_detil_id[".$parent."][]\" value=\"".$arr[$k][kunjungan_bayar_id]."\" />";
				//$ret .= "<input type=\"hidden\" name=\"input_icopim_detil_field[".$parent."][]\" value=\"".$arr[$k][kolom]."\" />";
				$ret .= "</td>";
				$ret .= "<tr id=\"input_icopim_table_".$parent."\"><td colspan=\"2\">";
				$ret .= "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"tabel_biaya\"><tr><th style=\"width:200px;\">Jasa</th><th>Hak</th><th>Biaya</th><th>Sifat</th><th style=\"width:70px;\">Jml</th><th style=\"width:100px;\">Bayar</th><th style=\"width:20px;\">&nbsp;</th></tr>";
			}
			

			//get hak
			$data_hak = $_SESSION[igd][hak];
			$opt_hak = "";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$k][hak_id]) $opt_hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $opt_hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}

			//get sifat
			$data_sifat = $_SESSION[igd][sifat];
			$opt_sifat = "";
			for($i=0;$i<sizeof($data_sifat);$i++) {
				if($data_sifat[$i][nilai] == $arr[$k][sifat]) $opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\" selected=\"\">".$data_sifat[$i][nama]."</option>";
				else $opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\">".$data_sifat[$i][nama]."</option>";
			}

			//ICOPIM DETIL
			$n = md5(microtime());
			$nama_baris = ucwords(str_replace("_", " ", $arr[$k][kolom]));
			$ret .= "<tr id=\"input_icopim_detil_tr_".$n."\">";
			$ret .= "<td>".$nama_baris."</td>";

			//HAK
			$hak = "<select name=\"input_icopim_detil_hak[".$parent."][]\" id=\"input_icopim_detil_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_icopim_detil_biaya_".$n."', event, 'input_icopim_detil_bayar_".$n."', this)\">" . $opt_hak . "</select>";

			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";
			//BIAYA
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_biaya[".$parent."][]\" id=\"input_icopim_detil_biaya_".$n."\" value=\"".$arr[$k][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_sifat_".$n."').value, document.getElementById('input_icopim_detil_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_sifat_".$n."', event, 'input_icopim_detil_hak_".$n."', this)\" />";
			$ret .= "</td>";

			//SIFAT
			$sifat = "<select name=\"input_icopim_detil_sifat[".$parent."][]\" id=\"input_icopim_detil_sifat_".$n."\" class=\"inputan\" onchange=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_biaya_".$n."').value, document.getElementById('input_icopim_detil_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_jml_".$n."', event, 'input_icopim_detil_biaya_".$n."', this)\">" . $opt_sifat . "</select>";
		
			$ret .= "<td style=\"text-align:center;\">".$sifat."</td>";
			//JUMLAH
			$ret .= "<td style=\"text-align:center;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_jml[".$parent."][]\" id=\"input_icopim_detil_jml_".$n."\" value=\"".$arr[$k][jumlah]."\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan2('input_icopim_detil_bayar_".$n."', this.value, document.getElementById('input_icopim_detil_sifat_".$n."').value, document.getElementById('input_icopim_detil_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_icopim_detil_bayar_".$n."', event, 'input_icopim_detil_sifat_".$n."', this)\" />";
			$ret .= "</td>";

			//BAYAR
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_detil_bayar[".$parent."][]\" id=\"input_icopim_detil_bayar_".$n."\" value=\"".$arr[$k][bayar]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_icopim_detil_hak_".$n."', event, 'input_icopim_detil_jml_".$n."', this)\" />";
			$ret .= "</td>";

			//HAPUS
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus ".$nama_baris."\" onclick=\"hapus_kunjungan_bayar('".$arr[$k][kunjungan_bayar_id]."','input_icopim_detil_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus ".$nama_baris."\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_detil_id[".$parent."][]\" value=\"".$arr[$k][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_icopim_detil_field[".$parent."][]\" value=\"".$arr[$k][kolom]."\" />";
			$ret .= "</td>";
			$ret .= "</tr>";
			if(($k+1) == sizeof($arr)) $ret .= "</table></td></tr>";
		}
		$objResponse->addAppend("tbody_input_icopim", "innerHTML", $ret);
		return $objResponse;
	}

	function hapus_kunjungan_kamar_icopim($id) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "DELETE FROM kunjungan_kamar_icopim WHERE id = '".$id."'";
		$kon->execute();
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
		
		$paging->sql = "
			SELECT 
				id as id,
				REPLACE(nama, '".$val[bhp]."','<b>".$val[bhp]."</b>') as nama_replace,
				nama as nama,
				biaya as biaya
			FROM 
				bhp
			WHERE
				1=1
				$q
			ORDER BY 
				nama
			";
		
		$paging->onclick_func = "xajax_cari_bhp";
		$paging->setOnclickValue("xajax.getFormValues('cari_bhp')");
		$paging->get_page_result();

		$bhp_data = $paging->data;
		$bhp_no = $paging->start_number();
		$bhp_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "BHP", "Biaya");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($bhp_data);$i++) {
			$table->addRow(($bhp_no+$i), $bhp_data[$i]['nama_replace'], uangIndo($bhp_data[$i]['biaya']));
			$table->addOnclickTd(
				"xajax_get_bhp(" . $bhp_data[$i][id] . ", '" . addslashes($bhp_data[$i]['nama']) . "', '".($bhp_data[$i]['biaya'])."');",
				"xajax_get_bhp(" . $bhp_data[$i][id] . ", '" . addslashes($bhp_data[$i]['nama']) . "', '".($bhp_data[$i]['biaya'])."');",
				"xajax_get_bhp(" . $bhp_data[$i][id] . ", '" . addslashes($bhp_data[$i]['nama']) . "', '".($bhp_data[$i]['biaya'])."');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("bhp_navi", "innerHTML", $bhp_navi);
		$objResponse->addAssign("list_bhp","innerHTML", $tabel);
		return $objResponse;
	}

	function get_bhp($id, $nama, $biaya) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[igd][hak];
		$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";

		//get sifat
		$data_sifat = $_SESSION[igd][sifat];
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
		$data_hak = $_SESSION[igd][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			
			//get sifat
			$data_sifat = $_SESSION[igd][sifat];
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
	function get_total($val = array(), $simpan_dulu = true) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		//disimpan dulu jika 
		//$objResponse->addScriptCall("xajax_buka_kunjungan", $val[input_id_kunjungan_kamar]);
		if($simpan_dulu == true) {
			//$objResponse->addScriptCall("xajax_simpan_kunjungan", $val, false);
		}
		/*
		$kon->sql = "SELECT kwitansi_id, SUM(bayar) as bayar, SUM(mampu_bayar) as mampu_bayar FROM kunjungan_bayar WHERE kunjungan_kamar_id = '".$val[input_id_kunjungan_kamar]."' GROUP BY id";
		
		$kon->execute();
		$data = $kon->getAll();
		for($i=0;$i<sizeof($data);$i++) {
			if(!$data[$i][kwitansi_id]) {
				//belum dibayar
				$belum += $data[$i][bayar];
			} else {
				//sudah dibayar
				$sudah += $data[$i][bayar];
			}
		}
		*/
		$kon->sql = "SELECT SUM(bayar) as bayar, SUM(mampu_bayar) as mampu_bayar FROM kunjungan_bayar WHERE kunjungan_kamar_id = '".$val[input_id_kunjungan_kamar]."' GROUP BY kunjungan_kamar_id";
		$kon->execute();
		$data = $kon->getOne();
		$total = $data[bayar];
		$sudah_dibayar = $data[mampu_bayar];
		$belum_dibayar = $data[bayar] - $data[mampu_bayar];
		$objResponse->addAssign("total", "value", ($total));
		$objResponse->addAssign("total_terbilang", "innerHTML", terbilang($total));
		$objResponse->addAssign("sudah", "value", ($sudah_dibayar));
		$objResponse->addAssign("sudah_terbilang", "innerHTML", terbilang($sudah_dibayar));
		$objResponse->addAssign("belum", "value", ($belum_dibayar));
		$objResponse->addAssign("belum_terbilang", "innerHTML", terbilang($belum_dibayar));
		$objResponse->addAssign("mampu", "value", $total);
		$objResponse->addAssign("mampu_terbilang", "innerHTML", terbilang($total));
		return $objResponse;
	}

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
$_xajax->registerFunction(array("get_total", "Kunjungan_Modal", "get_total"));

//diagnosa
$_xajax->registerFunction(array("cari_diagnosa", "Diagnosa", "cari_diagnosa"));

//karcis
$_xajax->registerFunction(array("cari_karcis", "Karcis", "cari_karcis"));
$_xajax->registerFunction(array("get_karcis", "Karcis", "get_karcis"));
$_xajax->registerFunction(array("get_karcis_from_kunjungan", "Karcis", "get_karcis_from_kunjungan"));

//icopim
$_xajax->registerFunction(array("cari_icopim", "Tindakan", "cari_icopim"));
$_xajax->registerFunction(array("get_icopim", "Tindakan", "get_icopim"));
$_xajax->registerFunction(array("get_icopim_from_kunjungan", "Tindakan", "get_icopim_from_kunjungan"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_icopim", "Tindakan", "hapus_kunjungan_kamar_icopim"));

//bhp
$_xajax->registerFunction(array("cari_bhp", "BHP", "cari_bhp"));
$_xajax->registerFunction(array("get_bhp", "BHP", "get_bhp"));
$_xajax->registerFunction(array("get_bhp_from_kunjungan", "BHP", "get_bhp_from_kunjungan"));

$_xajax->registerFunction(array("get_total", "Kunjungan_Bayar", "get_total"));
$_xajax->registerFunction(array("hapus_kunjungan_bayar", "Kunjungan_Bayar", "hapus_kunjungan_bayar"));

?>