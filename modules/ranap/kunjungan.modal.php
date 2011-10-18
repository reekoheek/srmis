<?
/**
 * @author yudasy
 * @copyright 2011
 */
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
                kk.kamar_id as kamar_id,
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
				biaya_bhp+biaya_jasa as biaya,
				bayar_bhp as bayar_bhp,
				bayar_jasa as bayar_jasa,
				DATE(tgl) as tgl
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
				kby.biaya_jasa as biaya,
				kby.jumlah as jumlah,
				kby.bayar_jasa as bayar,
				DATE(kby.tgl) as tgl
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
				biaya_bhp as biaya,
				bayar_bhp as bayar,
				DATE(tgl) as tgl,
                no_resep as resep,
                bhp_id as bhp_id
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

        //get informasi kamar
        $kon->sql = "
                SELECT kk.kamar_id as kamar_id, k.nama as nama_kamar, k.kelas as kelas, p.nama as bangsal 
                FROM kunjungan_kamar kk, kamar k, pelayanan p
                WHERE kk.kamar_id = k.id AND k.pelayanan_id = p.id
                AND kk.kamar_id ='".$data[kamar_id]."'";

        $kon->execute();
		$data_kamar = $kon->getOne();


        $kon->sql = "SELECT * FROM db_apotek.resep_head WHERE LAST_INSERT_ID(param_no) and no_resep like 'RRI%' ORDER BY id DESC LIMIT 1";
        $kon->execute();
        $data_obat = $kon->getOne();
    
        $tanggal_sekarang=date("d/m/Y");
        //$month=substr($rp['tgl'],3,2);
        $date=date("m");
        
        $tgl = substr($data_obat['tgl'],3,2);
        
        
        if ($tgl == $date)
        {
        	$temp = $data_obat['param_no'];
        	$count = $temp + 1;
        }
        else
        {
        	$temp = 1;
        	$count = $temp;
        }
        
        //cek untuk ketersediaan record
        if (!$data_obat)
        {
        	$temp = 1;
        	$count = $temp;
        }
        
        
        $digit1 = (int) ($count % 10);
        $digit2 = (int) (($count % 100) / 10);
        $digit3 = (int) (($count % 1000) / 100);
        $digit4 = (int) (($count % 10000) / 1000);       
        
        
        $kd="RRI/";
        	
        $no_resep = $kd . date("dmy")."$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
        $param_no = $count;   


		$skr = date("Y-m-d");
		$usia = hitungUmur($data[tgl_lahir], $skr);
		$umur = empty($usia[tahun])?"":$usia[tahun] . "&nbsp;th&nbsp;&nbsp;";
		$umur .= empty($usia[bulan])?"":$usia[bulan] . "&nbsp;bl&nbsp;&nbsp;";
		$umur .= empty($usia[hari])?"":$usia[hari] . "&nbsp;hr&nbsp;&nbsp;";
		
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
        $objResponse->addAssign("input_pasien_id", "value", $data[pasien_id]);
        $objResponse->addAssign("input_param_no", "value", $param_no);
        $objResponse->addAssign("input_no_resep", "value", $no_resep);
        $objResponse->addAssign("no_resep", "innerHTML", $no_resep);
        $objResponse->addAssign("input_bangsal", "innerHTML", $data_kamar[bangsal]);
        $objResponse->addAssign("input_kamar", "innerHTML", $data_kamar[nama_kamar]);
        $objResponse->addAssign("input_kelas", "innerHTML", $data_kamar[kelas]);
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

		if(!empty($data_kc)) $objResponse->addScriptCall("xajax_show_data_pemberian_jasa", $data_kc, $data_ic, $data_bhp);
		//$idkk[input_id_kunjungan_kamar] = $data[id_kunjungan_kamar];
		//$objResponse->addScriptCall("xajax_get_total", $idkk);

		//tampilkan modal window input kunjungan
		$objResponse->addClear("modal_kunjungan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall("fokus", "input_dokter_id");
		return $objResponse;
	}

	function show_data_pemberian_jasa($arr_karcis, $arr_icopim, $arr_bhp) {
		$objResponse = new xajaxResponse;
        
        if (!empty($arr_karcis)) :
		for($i=0;$i<sizeof($arr_karcis);$i++) {
			if($arr_karcis[$i][tgl] == $arr_karcis[$i-1][tgl]) {
				$m++;
				$new[$arr_karcis[$i][tgl]][karcis][$m] = $arr_karcis[$i][nama];
			} else {
				$m=0;
				$new[$arr_karcis[$i][tgl]][tgl] = $arr_karcis[$i][tgl];
				$new[$arr_karcis[$i][tgl]][karcis][$m] = $arr_karcis[$i][nama];
			}
		}
		endif;
        
        if (!empty($arr_icopim)) :
		for($i=0;$i<sizeof($arr_icopim);$i++) {
			if($arr_icopim[$i][kunjungan_icopim_id] == $arr_icopim[$i-1][kunjungan_icopim_id]){
				continue;
			} else {
				if($arr_icopim[$i][tgl] == $arr_icopim[$i-1][tgl]) {
					$m++;
					$new[$arr_icopim[$i][tgl]][icopim][$m] = $arr_icopim[$i][nama];
				} else {
					$m=0;
					$new[$arr_icopim[$i][tgl]][tgl] = $arr_icopim[$i][tgl];
					$new[$arr_icopim[$i][tgl]][icopim][$m] = $arr_icopim[$i][nama];
				}
			}
		}
        endif;
        if (!empty($arr_bhp)) :
		for($i=0;$i<sizeof($arr_bhp);$i++) {
			if($arr_bhp[$i][tgl] == $arr_bhp[$i-1][tgl]) {
				$m++;
				$new[$arr_bhp[$i][tgl]][bhp][$m] = $arr_bhp[$i][nama];                          
			} else {
				$m=0;
				$new[$arr_bhp[$i][tgl]][tgl] = $arr_bhp[$i][tgl];
				$new[$arr_bhp[$i][tgl]][bhp][$m] = $arr_bhp[$i][nama];
                $new[$arr_bhp[$i][tgl]][resep] = $arr_bhp[$i][resep];
              
			}
		}
        endif;
		$ret = "";
        if (!empty($new)) :
		for($i=0;$i<sizeof($new);$i++) {
			$kunci = key($new);
			$ret .= "<br /><b><i>" . tanggalIndo($new[$kunci][tgl], "j F Y"). "</i></b><br />";
			if(!empty($new[$kunci][karcis])) {
				$ret .= "<b>Jasa :</b><br />";
				for($j=0;$j<sizeof($new[$kunci][karcis]);$j++) {
					$ret .= "- " . $new[$kunci][karcis][$j] . "<br />";
				}
			}
			if(!empty($new[$kunci][icopim])) {
				$ret .= "<b>Tindakan :</b><br />";
				for($j=0;$j<sizeof($new[$kunci][icopim]);$j++) {
					$ret .= "- " . $new[$kunci][icopim][$j] . "<br />";
				}
			}
			if(!empty($new[$kunci][bhp])) {
				$ret .= "<b>BHP (Obat) <br><font color=red>No Resep : ".$new[$kunci][resep]." </font></b><br />";
				for($j=0;$j<sizeof($new[$kunci][bhp]);$j++) {				    
					$ret .= "- " . $new[$kunci][bhp][$j] . "<br />";
				}
			}
			next($new);
		}
        endif;
		$objResponse->addAssign("data_pemberian_jasa", "innerHTML", $ret);
		return $objResponse;
	}

	function simpan_kunjungan($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();
		$kon = new Konek;
		if($val[beri_resep]==1){
			$resep="YA";
			}else{
			$resep="TIDAK";
			}
		//update beri resep
		$sql = "
			UPDATE
				kunjungan
			SET
				resep='".$resep."'
			WHERE
				id = '".$val[input_id_kunjungan]."'
		";

		$kon->sql = $sql;
		$kon->execute();
		//update
		$sql = "
			UPDATE
				kunjungan_kamar
			SET
				dokter_id = NULLIF('".$val[input_dokter_id]."', ''),
				diagnosa_utama_id = NULLIF('".$val[input_diagnosa_utama]."', '')
			WHERE
				id = '".$val[input_id_kunjungan_kamar]."'
		";

		$kon->sql = $sql;
		$kon->execute();
		//$afek = $kon->affected_rows;
        $afek = $kon->getJml();
        $temp = $sql;
		$objResponse = new xajaxResponse();
        //$objResponse->addAlert($temp);
		//$objResponse->addAlert(print_r($val));
		//$objResponse->addAppend("debug", "innerHTML", $mampu_bayar);
//INSERT UPDATE KARCIS
		for($i=0;$i<sizeof($val[input_karcis]);$i++) {
			$kunci = key($val[input_karcis]);
			//get
	
/* BAGI BAYAR => BHP+JASA */
$biaya_bhp = 0;
$biaya_jasa = 0;
$selisih_biaya = 0;

$biaya_bhp = round($val[input_karcis_biaya_bhp][$kunci]);
$biaya_jasa = round($val[input_karcis_biaya_jasa][$kunci]);
$selisih_biaya = $val[input_karcis_biaya][$kunci]-$biaya_bhp-$biaya_jasa;
$biaya_jasa += $selisih_biaya;

$bayar_bhp = 0;
$bayar_jasa = 0;
$selisih_bayar = 0;

$bayar_bhp = round($val[input_karcis_biaya_bhp][$kunci]);
$bayar_jasa = round($val[input_karcis_biaya_jasa][$kunci]);
$selisih_bayar = $val[input_karcis_bayar][$kunci]-$bayar_bhp-$bayar_jasa;
$bayar_jasa += $selisih_bayar;

			if(!$val[input_kunjungan_karcis_id][$kunci]) {
				//insert
				$sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						karcis_id, 
						hak_id, 
						biaya_bhp,
						biaya_jasa,
						jumlah, 
						bayar_bhp,
						bhp_p,
						bhp_rs,
						bhp_rs_adm,
						bhp_rs_op,
						bayar_jasa,
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
						pajak,
						tgl
					)	SELECT
							'".$val[input_karcis_nama][$i]."', 
							'".$val[input_id_kunjungan_kamar]."', 
							'".$val[input_karcis][$kunci]."', 
							'".$val[input_karcis_hak][$kunci]."', 
							'".$biaya_bhp."',
							'".$biaya_jasa."',
							'".$val[input_karcis_jml][$kunci]."', 
							'".$bayar_bhp."',
							bhp_p,
							bhp_rs,
							bhp_rs_adm,
							bhp_rs_op,
							'".$bayar_jasa."',
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
							pajak,
							NOW()
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
					jumlah = '".$val[input_karcis_jml][$kunci]."', 
					biaya_bhp = '".$biaya_bhp ."', 
					biaya_jasa = '".$biaya_jasa."', 
					bayar_bhp = '".$bayar_bhp."',
					bayar_jasa = '".$bayar_jasa."'
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
				//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $val[input_icopim_detil_bayar][$parent][$field] . "<br />");
				$sql = "INSERT INTO kunjungan_bayar (nama, kunjungan_kamar_id, kunjungan_kamar_icopim_id, icopim_detil_id, hak_id, biaya_jasa,tgl) 
                        VALUES ('".$val[input_icopim_nama][$kunci]."', '".$val[input_id_kunjungan_kamar]."', '".$id_kki."', '".$val[input_icopim_detil][$kunci]."', '".$val[input_icopim_hak][$kunci]."', '".$val[input_icopim_biaya][$kunci]."', NOW())";
				$kon->sql = $sql;
					$kon->execute();
				

			} else {				//UPDATE
/*diinsert satu satu*/
				$sql = "UPDATE kunjungan_bayar SET hak_id = '".$val[input_icopim_hak][$kunci]."', biaya_jasa = '".$val[input_icopim_biaya][$kunci]."' WHERE id = '".$val[input_kunjungan_icopim_id][$kunci]."'";

								//$objResponse->addAppend("debug", "innerHTML", $field . " => " . $sql . "<br /><br />");
					$kon->sql = $sql;
					$kon->execute();
				} //endfor
			
			next($val[input_icopim]);		}

//BHP
		for($i=0;$i<sizeof($val[input_bhp]);$i++) {
			$kunci = key($val[input_bhp]);

			if(!$val[input_kunjungan_bhp_id][$kunci]) {
				//insert
			    $sql = "
				INSERT INTO 
					kunjungan_bayar (
						nama,
						kunjungan_kamar_id, 
						bhp_id, 
						hak_id, 
						biaya_bhp,
						sifat,
						jumlah, 
						bayar_bhp,
						tgl,
                        no_resep
					)	VALUES ( 
							'".$val[input_bhp_nama][$i]."', 
							'".$val[input_id_kunjungan_kamar]."', 
							'".$val[input_bhp][$kunci]."', 
							'".$val[input_bhp_hak][$kunci]."', 
							'".$val[input_bhp_biaya][$kunci]."',
							'".$val[input_bhp_sifat][$kunci]."', 
							'".$val[input_bhp_jml][$kunci]."', 
							'".$val[input_bhp_bayar][$kunci]."',
							NOW(),
                            '".$val[input_no_resep]."')
					";    
				$kon->sql = $sql;
				$kon->execute();
                $temp .= $sql;
			} else {
				//update
				$sql = "
				UPDATE 
					kunjungan_bayar 
				SET 
					hak_id = '".$val[input_bhp_hak][$kunci]."', 
					biaya_bhp = '".$val[input_bhp_biaya][$kunci]."', 
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
		}
		// $objResponse->addAlert($temp);
         //simpan di database apotek
         //pasien id
         $usercreated = $_SESSION["username"];
         $unit_id = 4;
         $tgl=date("d/m/Y");
        
         $sql="insert into db_apotek.resep_head (no_resep,param_no,pasien_id,created_datetime,created_user,tgl,unit_id,cara_masuk,flags) 
             values('".$val[input_no_resep]."','".$val[input_param_no]."','".$val[input_pasien_id]."',now(),'$usercreated','$tgl','$unit_id','RAWAT INAP',3)";
         $kon->sql = $sql;
         $kon->execute();
           
         
         //BHP
         for($i = 0; $i < sizeof($val[input_bhp]); $i++) {
            $kunci = key($val[input_bhp]);
         
          //ambil kode barang
          $sql = "select db_apotek.ms_barang.id as id, db_apotek.ms_barang.kd_barang as kd_barang,db_apotek.ms_barang.nama as nama
          from db_apotek.ms_barang where db_apotek.ms_barang.id ='".$val[input_bhp][$i]."'";
 
         $kon->sql = $sql;
         $kon->execute();
         $ref = $kon->getOne(); //ambil data kd_barang
                 
         $date = date("d/m/Y");      
            
              
         $sql =  "INSERT INTO db_apotek.resep (no_resep, pasien_id, kode_obat, tgl, diminta,dosis_id,ket,racikan,flags) 
		         VALUES ('".$val[input_no_resep]."','".$val[input_pasien_id]."', '".$ref[kd_barang].
                 "', '$date','".$val[input_bhp_jml][$i]."','".$val[input_dosis][$i]."','".$val[input_ket][$i]."','-',3)";
         
         $kon->sql = $sql;
         $kon->execute();                 
              
           next($val[input_bhp]);
         }    
        
        
        
		if($afek < 0) {
			$objResponse->addAlert("Data Kunjungan Tidak Dapat Disimpan\nHubungi Bagian SIM.");
		} else {
		     $objResponse->addScriptCall("show_status_simpan"); 
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("tutup_kunjungan");
			
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

    function get_diagnosa($id, $nama) {	
        $n = md5(microtime());
        $ret .="<tr id=\"input_diagnosa_tr_".$n."\">";
        $ret .="<td><a href=javascript:void(0) title='Hapus Diagnosa Utama' onclick=\"hapus_kunjungan_bayar('','input_diagnosa_tr_".$n."')\"/>";
        $ret .= "<img src=".IMAGES_URL."remove.png alt='' border=0 /></a>&nbsp;&nbsp;&nbsp;";
        $ret .= "<span id='input_diagnosa_utama_nama'>&nbsp;".$nama."</span>";
        $ret .= "<input type=\"hidden\" name=\"input_diagnosa_utama[]\" id=\"input_diagnosa_utama_".$n."\" value=\"".$id."\" /><br>";
        $ret .= "</td>";
        $ret .= "</tr>";

		
		$objResponse = new xajaxResponse;
		$objResponse->addAppend("tbody_diagnosa", "innerHTML", $ret);
		return $objResponse;
	}

}

Class Karcis {
	
	function cari_karcis($hal = 0, $val, $kelas) {
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
				biaya_bhp as biaya_bhp,
				biaya_jasa as biaya_jasa,
                kelas as kelas
			FROM 
				karcis
			WHERE
				jenis = 'RAWAT INAP'				
				$q
			ORDER BY 
				nama
			";
		
		$paging->onclick_func = "xajax_cari_karcis";
		$paging->setOnclickValue("xajax.getFormValues('cari_karcis')", $kelas);
		$paging->get_page_result();

		$karcis_data = $paging->data;
		$karcis_no = $paging->start_number();
		$karcis_navi = $paging->navi();
		
		$objResponse = new xajaxResponse();
		
		$table = new Table;
		$table->tbody_height = 200;
		$table->addTh("No", "Jasa", "Kelas","Biaya");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($karcis_data);$i++) {
			$table->addRow(($karcis_no+$i), $karcis_data[$i]['nama_replace'], $karcis_data[$i]['kelas'] ,uangIndo($karcis_data[$i]['biaya_bhp'] + $karcis_data[$i]['biaya_jasa']));
			$table->addOnclickTd(
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya_bhp'])."', '".($karcis_data[$i]['biaya_jasa'])."');",
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya_bhp'])."', '".($karcis_data[$i]['biaya_jasa'])."');",
				"xajax_get_karcis(" . $karcis_data[$i][id] . ", '" . addslashes($karcis_data[$i]['nama']) . "', '".($karcis_data[$i]['biaya_bhp'])."', '".($karcis_data[$i]['biaya_jasa'])."');"
			);
		}
		$tabel = $table->build();
		$objResponse->addAssign("karcis_navi", "innerHTML", $karcis_navi);
		$objResponse->addAssign("list_karcis","innerHTML", $tabel);
		return $objResponse;
	}

	function get_karcis($id, $nama, $biaya_bhp, $biaya_jasa) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[ranap][hak];
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
		$ret .= "<input type=\"text\" name=\"input_karcis_biaya[]\" id=\"input_karcis_biaya_".$n."\" value=\"".($biaya_bhp+$biaya_jasa)."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan('input_karcis_bayar_".$n."', this.value, document.getElementById('input_karcis_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_karcis_jml_".$n."', event, 'input_karcis_hak_".$n."', this)\" />";
		$ret .= "</td>";		
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('','input_karcis_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_karcis_id[]\" id=\"input_kunjungan_karcis_id_".$n."\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis[]\" id=\"input_karcis_".$n."\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis_nama[]\" value=\"".$nama."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_bhp[]\" value=\"".$biaya_bhp."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_jasa[]\" value=\"".$biaya_jasa."\" />";
		$ret .= "</td>";
		$ret .= "<tr>";
		$objResponse = new xajaxResponse;
		$objResponse->addAppend("tbody_input_karcis", "innerHTML", $ret);
		return $objResponse;
	}

	function get_karcis_from_kunjungan($arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		$data_hak = $_SESSION[ranap][hak];

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
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('".$arr[$j][kunjungan_bayar_id]."','input_karcis_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_karcis_id[]\" id=\"input_kunjungan_karcis_id_".$n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis[]\" id=\"input_karcis_".$n."\" value=\"".$arr[$j][karcis_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis_nama[]\" value=\"\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_bhp[]\" value=\"".$arr[$j][bayar_bhp]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_jasa[]\" value=\"".$arr[$j][bayar_jasa]."\" />";
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
         $q = " i.nama LIKE '%".$val[icopim]."%' ";
         $paging = new MyPagina;
         $paging->rows_on_page = 10;
         $paging->hal = $hal;

         $paging->sql = "
			SELECT
				i.id as id,
				id.id as detil_id,
				REPLACE(i.nama, '".$val[icopim]."','<b>".$val[icopim].
            "</b>') as nama_replace,
				nama as nama,
				id.kelas as kelas,
				id.biaya as biaya
			FROM
				icopim i
				JOIN icopim_detil id ON (id.tingkat = i.tingkat)
			WHERE				
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
         for($i = 0; $i < sizeof($icopim_data); $i++) {
            $table->addRow(($icopim_no + $i), $icopim_data[$i]['nama_replace'], $icopim_data[$i]['kelas'],
               uangIndo($icopim_data[$i]['biaya']));
            $table->addOnclickTd("xajax_get_icopim(".$icopim_data[$i][id].", ".$icopim_data[$i][detil_id].
               ", '".addslashes($icopim_data[$i]['nama'])."', '".($icopim_data[$i]['biaya']).
               "', '".($icopim_data[$i]['kelas']).
               "');", "xajax_get_icopim(".$icopim_data[$i][id].", ".$icopim_data[$i][detil_id].
               ", '".addslashes($icopim_data[$i]['nama'])."', '".($icopim_data[$i]['biaya']).
               "', '".($icopim_data[$i]['kelas']).
               "');", "xajax_get_icopim(".$icopim_data[$i][id].", ".$icopim_data[$i][detil_id].
               ", '".addslashes($icopim_data[$i]['nama'])."', '".($icopim_data[$i]['biaya']).
               "', '".($icopim_data[$i]['kelas']).
               "');", "xajax_get_icopim(".$icopim_data[$i][id].", ".$icopim_data[$i][detil_id].
               ", '".addslashes($icopim_data[$i]['nama'])."', '".($icopim_data[$i]['biaya']).
               "', '".($icopim_data[$i]['kelas']).
               "');");
         }
         $tabel = $table->build();
         $objResponse->addAssign("icopim_navi", "innerHTML", $icopim_navi);
         $objResponse->addAssign("list_icopim", "innerHTML", $tabel);
         return $objResponse;
      }

	function get_icopim($id, $detil_id, $nama, $biaya,$kelas) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$parent = md5(microtime());		
		//get icopim_detil
		$kon->sql = "SELECT * FROM icopim_detil WHERE id = '".$detil_id."' AND kelas ='".$kelas."'";
		$kon->execute();
		$data_icopim_detil = $kon->getOne();
		//$field_icopim_detil = $kon->getField();

        $n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[ranap][hak];
		$opt = "<select name=\"input_icopim_hak[]\" id=\"input_icopim_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_icopim_biaya_".$n."', event, 'input_icopim_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";
		$ret .= "<tr id=\"input_icopim_tr_".$n."\">";
		$ret .= "<td>".$nama."</td>";
		$ret .= "<td style=\"text-align:center;\">".$opt."</td>";
		$ret .= "<td style=\"text-align:right;\">";
		$ret .= "<input type=\"text\" name=\"input_icopim_biaya[]\" id=\"input_icopim_biaya_".$n."\" value=\"".($biaya)."\" class=\"inputan_angka\" size=\"10\"  />";
		$ret .= "</td>";		
		$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kunjungan_bayar('','input_icopim_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
		$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_id[]\" id=\"input_kunjungan_icopim_id_".$n."\" value=\"\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim[]\" id=\"input_icopim_".$n."\" value=\"".$id."\" />";
		$ret .= "<input type=\"hidden\" name=\"input_icopim_nama[]\" value=\"".$nama."\" />";
	//	$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_bhp[]\" value=\"".$biaya_bhp."\" />";
	//	$ret .= "<input type=\"hidden\" name=\"input_karcis_biaya_jasa[]\" value=\"".$biaya_jasa."\" />";
		$ret .= "</td>";
		$ret .= "<tr>";
        
        

		$objResponse->addAppend("tbody_input_icopim", "innerHTML", $ret);
		return $objResponse;
	}

	function get_icopim_from_kunjungan($arr) {
	   
       	$objResponse = new xajaxResponse;
		$kon = new Konek;
		$data_hak = $_SESSION[ranap][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$hak = "<select name=\"input_icopim_hak[]\" id=\"input_icopim_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_karcis_biaya_".$n."', event, 'input_karcis_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $hak .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $hak .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			$ret .= "<tr id=\"input_icopim_tr_".$n."\">";
			$ret .= "<td>".$arr[$j][nama]."</td>";
			$ret .= "<td style=\"text-align:center;\">".$hak."</td>";
			$ret .= "<td style=\"text-align:right;\">";
			$ret .= "<input type=\"text\" name=\"input_icopim_biaya[]\" id=\"input_icopim_biaya_".$n."\" value=\"".$arr[$j][biaya]."\" class=\"inputan_angka\" size=\"10\" />";
			$ret .= "</td>";			
			$ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus Karcis\" onclick=\"hapus_kunjungan_bayar('".$arr[$j][kunjungan_bayar_id]."','input_icopim_tr_".$n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Karcis\" border=\"0\" /></a>";
			$ret .= "<input type=\"hidden\" name=\"input_kunjungan_icopim_id[]\" id=\"input_kunjungan_icopim_id_".$n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
			$ret .= "<input type=\"hidden\" name=\"input_icopim[]\" id=\"input_icopim_".$n."\" value=\"".$arr[$j][kunjungan_icopim_id]."\" />";
            $ret .= "<input type=\"hidden\" name=\"input_icopim_nama[]\" value=\"".$nama."\" />";			
			$ret .= "</td>";
			$ret .= "</tr>";
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
				biaya as biaya,stok as stok
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
		$table->tbody_height = 50;
		$table->addTh("No", "Obat", "Biaya", "Stok");
		$table->addExtraTh("style=\"width:30px\"", "", "");
		for($i=0;$i<sizeof($bhp_data);$i++) {
			$table->addRow(($bhp_no+$i), $bhp_data[$i]['nama_replace'], uangIndo($bhp_data[$i]['biaya']),$bhp_data[$i]['stok']);
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

    //function cari obat
       function cari_obat($hal = 0, $val) {
         $val[obat] = addslashes($val[obat]);
         $q = " AND nama LIKE '%".$val[obat]."%' ";
         $paging = new MyPagina;
         $paging->rows_on_page = 10;
         $paging->hal = $hal;

        /*$paging->sql = "
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
			";*/

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
            $table->addOnclickTd("xajax_get_obat(".$bhp_data[$i]['id'].", '".addslashes($bhp_data[$i]['nama']).
               "', '".($bhp_data[$i]['biaya'])."');", "xajax_get_obat(".$bhp_data[$i]['id'].", '".
               addslashes($bhp_data[$i]['nama'])."', '".($bhp_data[$i]['biaya'])."');",
               "xajax_get_obat(".$bhp_data[$i]['id'].", '".addslashes($bhp_data[$i]['nama']).
               "', '".($bhp_data[$i]['biaya'])."');");
         }
         $tabel = $table->build();
         $objResponse->addAssign("bhp_navi", "innerHTML", $bhp_navi);
         $objResponse->addAssign("list_bhp", "innerHTML", $tabel);
         return $objResponse;
      }

    //function get Obat
      function get_obat($id, $nama, $biaya) {
         $kon = new Konek;
         $n = md5(microtime());
         //get hak
         $data_hak = $_SESSION[ranap][hak];
         $opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".
            $n."', event, 'input_bhp_bayar_".$n."', this)\">";
         for($i = 0; $i < sizeof($data_hak); $i++) {
            if($data_hak[$i][id] == 25) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".
                  $data_hak[$i][nama]."</option>";
            else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama].
                  "</option>";
         }
         $opt .= "</select>";
         
         //dosis
         $sql = "select * from db_apotek.dosis";
         $kon->sql = $sql;
         $kon->execute(); 
         $rs_dosis = $kon->getAll();
         
         $opt_dosis = "<select name=\"input_dosis[]\" id=\"input_dosis_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".
            $n."', event, 'input_bhp_bayar_".$n."', this)\">";
         for($i = 0; $i < sizeof($rs_dosis); $i++) {
            if($rs_dosis[$i][id] == 1){ $opt_dosis .= "<option value=\"".$rs_dosis[$i][id]."\" selected=\"\">".
                  $rs_dosen[$i][deskripsi]."</option>";
            }      
            else { $opt_dosis .= "<option value=\"".$rs_dosis[$i][id]."\">".$rs_dosis[$i][deskripsi].
                  "</option>";
             }     
         }
         $opt_dosis .= "</select>"; 
            
         //get sifat
         //$data_sifat = $_SESSION[rajal][sifat];
         //$opt_sifat = "<select name=\"input_bhp_sifat[]\" id=\"input_bhp_sifat_".$n."\" class=\"inputan\" onchange=\"kaliKan2('input_bhp_bayar_".
         //   $n."', this.value, document.getElementById('input_bhp_biaya_".$n.
          //  "').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_jml_".
          //  $n."', event, 'input_bhp_biaya_".$n."', this)\">";
         //for($i = 0; $i < sizeof($data_sifat); $i++) {
         //   $opt_sifat .= "<option value=\"".$data_sifat[$i][nilai]."\">".$data_sifat[$i][nama].
         //      "</option>";
         //}
         //$opt_sifat .= "</select>";
         
         //$opt_sifat = "<select name=\"input_bhp_sifat[]\" id=\"input_bhp_sifat_".$n."\" class=\"inputan\" >";
         //$opt_sifat .= "<option value='YA'>YA</option>";
         //$opt_sifat .= "<option value=''>TIDAK</option>";
         //$opt_sifat .= "</select>";
         
         $ret .= "<tr id=\"input_bhp_tr_".$n."\">";
         //BHP
         $ret .= "<td>".$nama."</td>";
         //HAK
         $ret .= "<td style=\"text-align:center;\">".$opt."</td>";
         //BIAYA
         $ret .= "<td style=\"text-align:right;\">";
         $ret .= "<input type=\"text\" name=\"input_bhp_biaya[]\" id=\"input_bhp_biaya_".
            $n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan2('input_bhp_bayar_".
            $n."', this.value, document.getElementById('input_bhp_sifat_".$n.
            "').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_sifat_".
            $n."', event, 'input_bhp_hak_".$n."', this)\" />";
         $ret .= "</td>";
         //SIFAT
         //$ret .= "<td style=\"text-align:center;\">".$opt_sifat."</td>";         
         //Dosis
         $ret .= "<td style=\"text-align:center;\">".$opt_dosis."</td>";         
         //keterangan
         $ret .= "<td style=\"text-align:center;\">";
         $ret .= "<textarea name=\"input_ket[]\" id=\"input_ket_".$n.
            "\" class=\"inputan\" /></textarea>";
         $ret .= "</td>";
         //JUMLAH
         $ret .= "<td style=\"text-align:center;\">";
         $ret .= "<input type=\"text\" name=\"input_bhp_jml[]\" id=\"input_bhp_jml_".$n.
            "\" value=\"1\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan3('input_bhp_bayar_".
            $n."', this.value, document.getElementById('input_bhp_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_bayar_".
            $n."', event, 'input_bhp_sifat_".$n."', this)\" />";
         $ret .= "</td>";
         $ret .= "<td style=\"text-align:right;\">";
         $ret .= "<input type=\"text\" name=\"input_bhp_bayar[]\" id=\"input_bhp_bayar_".
            $n."\" value=\"".$biaya."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_bhp_hak_".
            $n."', event, 'input_bhp_jml_".$n."', this)\" />";
         $ret .= "</td>";
         $ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus BHP\" onclick=\"hapus_kunjungan_bayar('','input_bhp_tr_".
            $n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus BHP\" border=\"0\" /></a>";
         $ret .= "<input type=\"hidden\" name=\"input_kunjungan_bhp_id[]\" id=\"input_kunjungan_bhp_id_".
            $n."\" value=\"\" />";
         $ret .= "<input type=\"hidden\" name=\"input_bhp[]\" id=\"input_bhp_".$n."\" value=\"".
            $id."\" />";
         $ret .= "<input type=\"hidden\" name=\"input_bhp_nama[]\" value=\"".$nama."\" />";
         $ret .= "</td>";
         $ret .= "<tr>";
         $objResponse = new xajaxResponse;
         $objResponse->addAppend("tbody_input_bhp", "innerHTML", $ret);
        
         return $objResponse;
      }
    

	function get_bhp($id, $nama, $biaya) {
		$kon = new Konek;
		$n = md5(microtime());
		//get hak
		$data_hak = $_SESSION[ranap][hak];
		$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
		for($i=0;$i<sizeof($data_hak);$i++) {
			if($data_hak[$i][id] == 25) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
			else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
		}
		$opt .= "</select>";

		//get sifat
		$data_sifat = $_SESSION[ranap][sifat];
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
		$data_hak = $_SESSION[ranap][hak];

		for($j=0;$j<sizeof($arr);$j++) {
			$n = md5(microtime());
			$opt = "<select name=\"input_bhp_hak[]\" id=\"input_bhp_hak_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".$n."', event, 'input_bhp_bayar_".$n."', this)\">";
			for($i=0;$i<sizeof($data_hak);$i++) {
				if($data_hak[$i][id] == $arr[$j][hak_id]) $opt .= "<option value=\"".$data_hak[$i][id]."\" selected=\"\">".$data_hak[$i][nama]."</option>";
				else $opt .= "<option value=\"".$data_hak[$i][id]."\">".$data_hak[$i][nama]."</option>";
			}
			$opt .= "</select>";
			
            //ambil data di ms barang untuk obat
            $sql = "select db_apotek.ms_barang.id as id, db_apotek.ms_barang.kd_barang as kd_barang,db_apotek.resep.no_resep, db_apotek.resep.pasien_id, db_apotek.resep.diminta as jml,db_apotek.resep.dosis_id as dosis_id,db_apotek.resep.ket as ket, " ;
            $sql.= "db_apotek.resep.racikan from db_apotek.ms_barang, db_apotek.resep where db_apotek.ms_barang.kd_barang = db_apotek.resep.kode_obat and db_apotek.ms_barang.id ='".$arr[$j][bhp_id]."' ";
            $sql.= "and db_apotek.resep.no_resep ='".$arr[$j][resep]."'";
            
            $kon->sql = $sql;            
            $kon->execute(); 
            $rs_obat1 = $kon->getOne();
            //$temp .= $rs_obat1[racikan]." ".$rs_obat1[ket]."<br>";
            
                                  
            $sql = "select * from db_apotek.dosis";
            $kon->sql = $sql;
            $kon->execute(); 
            $rs_dosis = $kon->getAll();
             
            $opt_dosis = "<select name=\"input_dosis[]\" id=\"input_dosis_".$n."\" class=\"inputan\" onkeypress=\"focusNext( 'input_bhp_biaya_".
               $n."', event, 'input_bhp_bayar_".$n."', this)\">";
            for($i = 0; $i < sizeof($rs_dosis); $i++) {
               if($rs_dosis[$i][id] == $rs_obat1[dosis_id]){ $opt_dosis .= "<option value=\"".$rs_dosis[$i][id]."\" selected=\"\">".
                     $rs_dosis[$i][deskripsi]."</option>";
               }      
               else { $opt_dosis .= "<option value=\"".$rs_dosis[$i][id]."\">".$rs_dosis[$i][deskripsi].
                     "</option>";
               }     
             }
             $opt_dosis .= "</select>";
           
           	$ret .= "<tr id=\"input_bhp_tr_".$n."\">";
			$ret .= "<td>".$arr[$j][nama]."</td>";
            
             //HAK
             $ret .= "<td style=\"text-align:center;\">".$opt."</td>";
             //BIAYA
             $ret .= "<td style=\"text-align:right;\">";
             $ret .= "<input type=\"text\" name=\"input_bhp_biaya[]\" id=\"input_bhp_biaya_".
                $n."\" value=\"".$arr[$j][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeyup=\"kaliKan2('input_bhp_bayar_".
                $n."', this.value, document.getElementById('input_bhp_sifat_".$n.
                "').value, document.getElementById('input_bhp_jml_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_sifat_".
                $n."', event, 'input_bhp_hak_".$n."', this)\" />";
             $ret .= "</td>";
             //SIFAT
             //$ret .= "<td style=\"text-align:center;\">".$opt_sifat."</td>";         
             //Dosis
             $ret .= "<td style=\"text-align:center;\">".$opt_dosis."</td>";         
             //keterangan
             $ret .= "<td style=\"text-align:center;\">";
             $ret .= "<textarea name=\"input_ket[]\" id=\"input_ket_".$n.
                "\" class=\"inputan\" />".$rs_obat1[ket]."</textarea>";
             $ret .= "</td>";
             //JUMLAH
             $ret .= "<td style=\"text-align:center;\">";
             $ret .= "<input type=\"text\" name=\"input_bhp_jml[]\" id=\"input_bhp_jml_".$n.
                "\" value=\"".$rs_obat1[jml]."\" class=\"inputan_angka\" size=\"3\" onkeyup=\"kaliKan3('input_bhp_bayar_".
                $n."', this.value, document.getElementById('input_bhp_biaya_".$n."').value);\" onkeypress=\"focusNext( 'input_bhp_bayar_".
                $n."', event, 'input_bhp_sifat_".$n."', this)\" />";
             $ret .= "</td>";
             $ret .= "<td style=\"text-align:right;\">";
             $ret .= "<input type=\"text\" name=\"input_bhp_bayar[]\" id=\"input_bhp_bayar_".
                $n."\" value=\"".$arr[$j][biaya]."\" class=\"inputan_angka\" size=\"10\" onkeypress=\"focusNext( 'input_bhp_hak_".
                $n."', event, 'input_bhp_jml_".$n."', this)\" />";
             $ret .= "</td>";
             $ret .= "<td><a href=\"javascript:void(0)\" title=\"Hapus BHP\" onclick=\"hapus_kunjungan_bayar('','input_bhp_tr_".
                $n."')\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus BHP\" border=\"0\" /></a>";
             $ret .= "<input type=\"hidden\" name=\"input_kunjungan_bhp_id[]\" id=\"input_kunjungan_bhp_id_".
                $n."\" value=\"".$arr[$j][kunjungan_bayar_id]."\" />";
             $ret .= "<input type=\"hidden\" name=\"input_bhp[]\" id=\"input_bhp_".$n."\" value=\"".
                $arr[$j][bhp_id]."\" />";
             $ret .= "<input type=\"hidden\" name=\"input_bhp_nama[]\" value=\"".$nama."\" />";
             $ret .= "</td>";
             $ret .= "<tr>";
            
   }
        
         $objResponse = new xajaxResponse;
         //$objResponse->addAlert($temp);
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
$_xajax->registerFunction(array("show_data_pemberian_jasa", "Kunjungan_Modal", "show_data_pemberian_jasa"));

//diagnosa
$_xajax->registerFunction(array("cari_diagnosa", "Diagnosa", "cari_diagnosa"));
$_xajax->registerFunction(array("get_diagnosa", "Diagnosa", "get_diagnosa"));

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
$_xajax->registerFunction(array("cari_obat", "BHP", "cari_obat"));
$_xajax->registerFunction(array("get_obat", "BHP", "get_obat"));
$_xajax->registerFunction(array("get_bhp_from_kunjungan", "BHP", "get_bhp_from_kunjungan"));

$_xajax->registerFunction(array("get_total", "Kunjungan_Bayar", "get_total"));
$_xajax->registerFunction(array("hapus_kunjungan_bayar", "Kunjungan_Bayar", "hapus_kunjungan_bayar"));

?>