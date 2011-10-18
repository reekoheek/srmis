<?
   $_TITLE = "Pendaftaran Pasien IRD";
   class IRD {
      function get_pasien($id) {
         $kon = new Konek;
         //$kon->sql = "SELECT p.id as id, p.nama as nama, p.tempat_lahir as tempat_lahir, p.tgl_lahir as tgl_lahir, p.gol_darah as gol_darah, p.alamat as alamat, p.rt as rt, p.rw as rw, p.desa_id as des_id, kec.id as kec_id, kab.id as kab_id, prop.id as prop_id, p.telp as telp, p.agama as agama, p.sex as sex, p.pendidikan_id as pendidikan_id, p.pekerjaan_id as pekerjaan_id, p.status_nikah as status_nikah, p.tgl_daftar as tgl_daftar FROM pasien p JOIN ref_desa des ON (des.id = p.desa_id) JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id) JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id) JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id) WHERE p.id = '".$id."'";
         $kon->sql = "CALL pendaftaran_get_pasien('".$id."')";
         $kon->execute();
         $data = $kon->getOne();

         $objResponse = new xajaxResponse();
         $objResponse->addScriptCall("show_hide_form", "form_tambah");
         $objResponse->addAssign("propinsi_id", "value", $data[prop_id]);
         $objResponse->addScriptCall("xajax_ref_get_kabupaten", "kabupaten_id", $data[prop_id],
            $data[kab_id], true);
         $objResponse->addScriptCall("xajax_ref_get_kecamatan", "kecamatan_id", $data[kab_id],
            $data[kec_id], true);
         $objResponse->addScriptCall("xajax_ref_get_desa", "desa_id", $data[kec_id], $data[des_id], true);

         $tgl_lahir = explode("-", $data[tgl_lahir]);
         $skr = date("Y-m-d");
         $usia = hitungUmur($data[tgl_lahir], $skr);
         //$objResponse->addAssign("debug", "innerHTML", $tgl_lahir[2] . ":" . $tgl_lahir[1] . ":" . $tgl_lahir[0]);

         //jika data ditemukan
         if(!empty($data)) {
            $objResponse->addAssign("id", "value", $data[id]);
            $objResponse->addAssign("id_pasien", "value", $data[id]);
            $objResponse->addAssign("nama", "value", $data[nama]);
            $objResponse->addAssign("usia_tahun", "value", $usia[tahun]);
            $objResponse->addAssign("usia_bulan", "value", $usia[bulan]);
            $objResponse->addAssign("usia_hari", "value", $usia[hari]);
            $objResponse->addAssign("tempat_lahir", "value", $data[tempat_lahir]);
            $objResponse->addAssign("tgl_lahir_tgl", "value", $tgl_lahir[2]);
            $objResponse->addAssign("tgl_lahir_bln", "value", $tgl_lahir[1]);
            $objResponse->addAssign("tgl_lahir_thn", "value", $tgl_lahir[0]);
            $objResponse->addAssign("gol_darah_id", "value", $data[gol_darah]);
            $objResponse->addAssign("alamat", "value", $data[alamat]);
            $objResponse->addAssign("rt", "value", $data[rt]);
            $objResponse->addAssign("rw", "value", $data[rw]);
            $objResponse->addAssign("telp", "value", $data[telp]);
            $objResponse->addAssign("agama", "value", $data[agama]);
            $objResponse->addAssign("sex", "value", $data[sex]);
            $objResponse->addAssign("pendidikan_id", "value", $data[pendidikan_id]);
            $objResponse->addAssign("pekerjaan_id", "value", $data[pekerjaan_id]);
            $objResponse->addAssign("status_nikah", "value", $data[status_nikah]);
            $objResponse->addAssign("nama_ayah", "value", $data[nama_ayah]);
            $objResponse->addAssign("nama_ibu", "value", $data[nama_ibu]);
            $objResponse->addAssign("nama_suami", "value", $data[nama_suami]);
            $objResponse->addAssign("nama_istri", "value", $data[nama_istri]);
            $objResponse->addAssign("no_ktp_sim", "value", $data[no_ktp_sim]);
            
            /*
            get data kunjungan sebelumnya
            untuk mendapatkan data penanggung jawab
            dan nomor askes
            */
            $kon = new Konek;
            $kon->sql = "
					SELECT
						kk.id,
						kk.cara_bayar,
						kk.jenis_askes,
						kk.perusahaan_id,
						kk.nomor,
						kk.pj_nama,
						kk.pj_alamat,
						kk.pj_telp,
						kk.pj_hubungan_keluarga
					FROM
						kunjungan k
						JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					WHERE
						k.pasien_id = '".$data[id]."'
						AND kk.pj_nama <>''
					GROUP BY kk.id
					ORDER BY kk.id DESC
					LIMIT 1
				";
            $kon->execute();
            $pj = $kon->getOne();
            $objResponse->addScriptCall("showNomor", $pj[cara_bayar]);
            $objResponse->addScriptCall("xajax_ref_get_jenis_askes", "jenis_askes", $pj[cara_bayar],
               $pj[jenis_askes]);
            $objResponse->addScriptCall("xajax_ref_get_perusahaan", "perusahaan_id", $pj[cara_bayar],
               $pj[perusahaan_id]);
            $objResponse->addAssign("cara_bayar", "value", $pj[cara_bayar]);
            $objResponse->addAssign("nomor", "value", $pj[nomor]);
            $objResponse->addAssign("pj_nama", "value", $pj[pj_nama]);
            $objResponse->addAssign("pj_alamat", "value", $pj[pj_alamat]);
            $objResponse->addAssign("pj_telp", "value", $pj[pj_telp]);
            $objResponse->addAssign("pj_hubungan_keluarga", "value", $pj[pj_hubungan_keluarga]);
            $objResponse->addScriptCall("fokus", "cara_masuk");
         } else {
            //jika tidak ada data pasien dengan no rm $id
            $id = (int)$id;
            if($id) $no = tambahNol($id, 8);
            $objResponse->addScript("document.tambah_pasien.reset()");
            $objResponse->addAssign("id", "value", $no);
            $objResponse->addScriptCall("fokus", "nama");
         }
         return $objResponse;
      }
	  function cetak_form() {
	  	$objResponse = new xajaxResponse();
		$objResponse->addConfirmCommands(1,"Cetak Form?");	
		$objResponse->addScriptCall("cetak", URL."pendaftaran/igd_cetak", 900, 760);
		return $objResponse;
	  }
      function simpan_pasien($value) {
      	 global $last_id;
         $objResponse = new xajaxResponse();
         $kon = new Konek;
         if(!$value['id_pasien']) {
            if(!$value['id']) {
               $sql = "
						INSERT INTO pasien(
							nama,
							tempat_lahir,
							tgl_lahir,
							gol_darah,
							sex,
							agama,
							pendidikan_id,
							pekerjaan_id,
							status_nikah,
							alamat,
							rt,
							rw,
							desa_id,
							telp,
							tgl_daftar,
                            nama_ayah,
                            nama_ibu,
                            nama_suami,
                            nama_istri,
                            no_ktp_sim,
                            created_datetime,
                            created_user,                           
                            kode_petugas
							)
						VALUES (
							'".$value[nama]."',
							'".$value[tempat_lahir]."',
							'".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl].
                  "',
							NULLIF('".$value[gol_darah_id]."',''),
							'".$value[sex]."',
							'".$value[agama]."',
							'".$value[pendidikan_id]."',
							'".$value[pekerjaan_id]."',
							'".$value[status_nikah]."',
							'".$value[alamat]."',
							'".$value[rt]."',
							'".$value[rw]."',
							'".$value[desa_id]."',
							'".$value[telp]."',
							NOW(),
                            '".$value[nama_ayah]."',
                            '".$value[nama_ibu]."',
                            '".$value[nama_suami]."',
                            '".$value[nama_istri]."',
                            '".$value[no_ktp_sim]."',
                             NOW(),
                            '".$_SESSION[username]."',
                            '".$value[nama_petugas]."'
						)";
						$kon->sql = $sql;
						$kon->execute();
						$afek = $kon->affected_rows;
						$last_id = $kon->last_id;
						
						//update no rekam medis
						$sql = "
			 					SELECT p.id as id, CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display FROM pasien p WHERE id='".$last_id."'";
            			$kon->sql = $sql;
            			$kon->execute();
            			$data = $kon->getOne();             
            
             
            			$sql = "UPDATE pasien SET no_rm ='".$data[id_display]."' WHERE id = '".$last_id."'";
            			$kon->sql = $sql;
            			$kon->execute();

            } else {
               $sql = "
						INSERT INTO pasien(
							id,
							nama,
							tempat_lahir,
							tgl_lahir,
							gol_darah,
							sex,
							agama,
							pendidikan_id,
							pekerjaan_id,
							status_nikah,
							alamat,
							rt,
							rw,
							desa_id,
							telp,
							tgl_daftar,
                            nama_ayah,
                            nama_ibu,
                            nama_suami,
                            nama_istri,
                            no_ktp_sim,
                            created_datetime,
                            created_user,
                            kode_petugas
							)
						VALUES (
							'".$value[id]."',
							'".$value[nama]."',
							'".$value[tempat_lahir]."',
							'".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl].
                  "',
							NULLIF('".$value[gol_darah_id]."',''),
							'".$value[sex]."',
							'".$value[agama]."',
							'".$value[pendidikan_id]."',
							'".$value[pekerjaan_id]."',
							'".$value[status_nikah]."',
							'".$value[alamat]."',
							'".$value[rt]."',
							'".$value[rw]."',
							'".$value[desa_id]."',
							'".$value[telp]."',
							NOW(),
                            '".$value[nama_ayah]."',
                            '".$value[nama_ibu]."',
                            '".$value[nama_suami]."',
                            '".$value[nama_istri]."',
                            '".$value[no_ktp_sim]."',
                            NOW(),
                            '".$_SESSION[username]."',
                            '".$value[nama_petugas]."'
						)";
				$kon->sql = $sql;
            	$kon->execute();
            	$afek = $kon->affected_rows;
            	$last_id = $kon->last_id;
				$_SESSION[id] = $kon->last_id;
            }
            
			
			//update no rekam medis
             $sql = "
			 SELECT p.id as id, CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display
FROM pasien p WHERE id='".$last_id."'";
            $kon->sql = $sql;
            $kon->execute();
            $data = $kon->getOne();             
            
             
            $sql = "UPDATE pasien SET no_rm ='".$data[id_display]."' WHERE id = '".$last_id."'";
            $kon->sql = $sql;
            $kon->execute();
         } else {
            $sql1 = "
					UPDATE pasien SET
						id = '".$value[id]."',
						nama= '".$value[nama]."',
						tempat_lahir = '".$value[tempat_lahir]."',
						tgl_lahir= '".$value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl].
               "',
						gol_darah = NULLIF('".$value[gol_darah_id]."', ''),
						sex= '".$value[sex]."',
						agama= '".$value[agama]."',
						pendidikan_id= '".$value[pendidikan_id]."',
						pekerjaan_id= '".$value[pekerjaan_id]."',
						status_nikah= '".$value[status_nikah]."',
						alamat= '".$value[alamat]."',
						rt= '".$value[rt]."',
						rw= '".$value[rw]."',
						desa_id= '".$value[desa_id]."',
						telp= '".$value[telp]."',
                        nama_ayah= '".$value[nama_ayah]."',
                        nama_ibu= '".$value[nama_ibu]."',
                        nama_suami= '".$value[nama_suami]."',
                        nama_istri= '".$value[nama_istri]."',
                        no_ktp_sim= '".$value[no_ktp_sim]."',
                        update_time=NOW(),
                        update_user='".$_SESSION[username]."',
                        kode_petugas='".$value[nama_petugas]."'
					WHERE
						id = '".$value[id_pasien]."'";
            $kon->sql = $sql1;
            $kon->execute();
            //$afek = $kon->affected_rows;
            $afek = $kon->getJml();
            $last_id = $value[id];
            //$last_id = $kon->last_id;
            //$_SESSION[id] = $kon->last_id;


			 //update no rekam medis
             $sql = "
			 SELECT p.id as id, CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display
FROM pasien p WHERE id='".$value[id_pasien]."'";
            $kon->sql = $sql;
            $kon->execute();
            $data = $kon->getOne();             
            
             
            $sql = "UPDATE pasien SET no_rm ='".$data[id_display]."' WHERE id = '".$value[id_pasien]."'";
            $kon->sql = $sql;
            $kon->execute();
            $id_pasien = $last_id;
         }

         if($afek < 0) {
            $objResponse->addAlert("ewe");
            //$objResponse->addAssign("debug", "innerHTML", $sql);
            $objResponse->addScriptCall("fokus", "id");
         } else {
            //$objResponse->addAssign("debug", "innerHTML", $sql);
            /*
            tambah data kunjungan
            */
            $sql_kunjungan_ke = "
					SELECT
						CASE
							WHEN (MAX(kunjungan_ke) IS NULL) THEN '1'
							ELSE (MAX(kunjungan_ke) + 1)
						END AS kunjungan_ke
					FROM
						kunjungan
					WHERE
						pasien_id = '".$last_id."'
				";
            $kon->sql = $sql_kunjungan_ke;
            $kon->execute();
            $kunjungan_ke = $kon->getOne();
            $sql_kunjungan = "
					INSERT INTO
						kunjungan(
							kunjungan_ke,
							pasien_id,
							perujuk_id,
							cara_masuk
						) VALUES(
							'".$kunjungan_ke[kunjungan_ke]."',
							'".$last_id."',
							NULLIF('".$value[perujuk_id]."', ''),
							'".$value[cara_masuk]."'
					)";
            $kon->sql = $sql_kunjungan;
            $kon->execute();
            //$id_kunjungan = $kon->last_id;
            
            $sql_last = "SELECT * FROM kunjungan WHERE LAST_INSERT_ID(id) ORDER BY id DESC LIMIT 1";
            $kon->sql = $sql_last;
            $kon->execute();
            $idk = $kon->getOne();
            $id_kunjungan = $idk[id];
            
            //$objResponse->addAssign("debug", "innerHTML", $sql_kunjungan);
            /*
            masuk IGD
            */
            $sql_kamar = "
					INSERT INTO
						kunjungan_kamar(
							kunjungan_id,
							kamar_id,
							tgl_daftar,
							tgl_periksa,
							tgl_keluar,
							cara_bayar,
							jenis_askes,
							perusahaan_id,
							nomor,
							pj_nama,
							pj_alamat,
							pj_telp,
							pj_hubungan_keluarga
						) VALUES (
							'".$id_kunjungan."',
							1,
							NOW(),
							NOW(),
							NOW(),
							'".$value[cara_bayar]."',
							NULLIF('".$value[jenis_askes]."',''),
							NULLIF('".$value[perusahaan_id]."',''),
							NULLIF('".$value[nomor]."',''),
							'".$value[pj_nama]."',
							'".$value[pj_alamat]."',
							'".$value[pj_telp]."',
							NULLIF('".$value[pj_hubungan_keluarga]."', '')
					)
				";
            $kon->sql = $sql_kamar;
            $kon->execute();
            $objResponse->addAlert("'".$sql_kamar."'");
            //$id_kunjungan_kamar = $kon->last_id;
            $sql_last = "select * from kunjungan_kamar where LAST_INSERT_ID(id) ORDER BY id DESC LIMIT 1";
            $kon->sql = $sql_last;
            $kon->execute();
            $id_kamar = $kon->getOne();
            $id_kunjungan_kamar = $id_kamar[id];
            
            $kon->sql = "INSERT INTO tracer (kunjungan_kamar_id, pasien_id, keperluan, tgl_keluar, cetak) VALUES ('".
               $id_kunjungan_kamar."', '".$last_id."', 'PEMERIKSAAN', NOW(), 'BELUM')";
            $kon->execute();

            $afek_kunjungan = $kon->affected_rows;
            //$objResponse->addAppend("debug", "innerHTML", $sql_kamar);
            if($afek_kunjungan < 0) {
               $objResponse->addAlert("Data Kunjungan Tidak Dapat Disimpan.\nCek kembali.");
               //$objResponse->addAssign("debug", "innerHTML", $sql);
               $objResponse->addScriptCall("fokus", "id");
            } else {
               if($value[bayar_karcis] == "1") {
                  $kon->sql = "SELECT biaya_jasa FROM karcis WHERE id='34'";
                  $kon->execute();
                  $bayar = $kon->getOne();
                  //$id_kwitansi = bikinKwitansi("IRD", $bayar[biaya_jasa], "LUNAS");
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
									bayar_jasa,
									mampu_bayar_bhp,
									mampu_bayar_jasa,
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
									kwid
								) SELECT
									nama,
									'".$id_kunjungan_kamar."',
									'34',
									'25',
									biaya_bhp,
									biaya_jasa,
									'1',
									biaya_bhp,
									biaya_jasa,
									biaya_bhp,
									biaya_jasa,
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
									'".$id_kwitansi."'
								FROM
									karcis
								WHERE
									id = '34'
						";
                  $kon->sql = $sql;
                  //$objResponse->addAppend("debug", "innerHTML", $sql);
                  $kon->execute();
                  
				  /*$idkb = $kon->last_id;
                  $kon->sql = "INSERT INTO kwitansi_detil(kunjungan_bayar_id, kwitansi_id, angsuran_bhp, angsuran_jasa) SELECT '".
                     $idkb."', '".$id_kwitansi."', biaya_bhp, biaya_jasa FROM karcis WHERE id='34'";
                  $kon->execute();*/
               }
               $objResponse->addConfirmCommands(1, "Cetak Kartu Periksa?");
               $objResponse->addScriptCall("cetak", URL."pendaftaran/kartu_periksa_cetak/?id=".
                  $last_id, 350, 210);
               $objResponse->addScriptCall("show_status_simpan");
               $objResponse->addScriptCall("xajax_reset_pasien");
               $objResponse->addScriptCall("get_sidebar_content");
               $objResponse->addScriptCall("fokus", "id");
            }
         }
         //$objResponse->addScriptCall("xajax_list_data_dua", $_SESSION[hal], $_SESSION[val]);
         return $objResponse;
      }
	  
	  function cetak_bayar(){
		$objResponse = new xajaxResponse;
		$objResponse->addConfirmCommands(1, "Cetak Form?");
		$objResponse->addScriptCall("cetak", URL."pendaftaran/igd_cetak", 900, 760);
		return $objResponse;	
	  }
	  
      function simpan_pasien_check($value) {
         $objResponse = new xajaxResponse();
         $cleaner = new FormCleaner;
         $cleaner->setValue($value);
         $cleaner->clean();
         $new_value = $cleaner->getValue();

         if(!$new_value[nama]) {
            $objResponse->addAlert("Silakan Isi Nama Pasien.");
            $objResponse->addScriptCall("fokus", "nama");
         } elseif(!checkdate($new_value[tgl_lahir_bln], $new_value[tgl_lahir_tgl], $new_value[tgl_lahir_thn])) {
            $objResponse->addAlert("Tanggal Lahir Tidak Valid.");
            $objResponse->addScriptCall("fokus", "tgl_lahir_tgl");
         } elseif(!$new_value[sex]) {
            $objResponse->addAlert("Silakan Isi Jenis Kelamin Pasien.");
            $objResponse->addScriptCall("fokus", "sex");
         } elseif(!$new_value[agama]) {
            $objResponse->addAlert("Silakan Isi Agama Pasien.");
            $objResponse->addScriptCall("fokus", "agama");
         } elseif(!$new_value[pendidikan_id]) {
            $objResponse->addAlert("Silakan Isi Pendidikan Pasien.");
            $objResponse->addScriptCall("fokus", "pendidikan_id");
         } elseif(!$new_value[pekerjaan_id]) {
            $objResponse->addAlert("Silakan Isi Pekerjaan Pasien.");
            $objResponse->addScriptCall("fokus", "pekerjaan_id");
         } elseif(!$new_value[status_nikah]) {
            $objResponse->addAlert("Silakan Isi Status Nikah Pasien.");
            $objResponse->addScriptCall("fokus", "status_nikah");
         } elseif(!$new_value[alamat]) {
            $objResponse->addAlert("Silakan Isi Alamat Pasien.");
            $objResponse->addScriptCall("fokus", "alamat");
         } elseif(!$new_value[propinsi_id]) {
            $objResponse->addAlert("Silakan Isi Propinsi Pasien.");
            $objResponse->addScriptCall("fokus", "propinsi_id");
         } elseif(!$new_value[kabupaten_id]) {
            $objResponse->addAlert("Silakan Isi Kabupaten Pasien.");
            $objResponse->addScriptCall("fokus", "kabupaten_id");
         } elseif(!$new_value[kecamatan_id]) {
            $objResponse->addAlert("Silakan Isi Kecamatan Pasien.");
            $objResponse->addScriptCall("fokus", "kecamatan_id");
         } elseif(!$new_value[desa_id]) {
            $objResponse->addAlert("Silakan Isi Kelurahan Pasien.");
            $objResponse->addScriptCall("fokus", "desa_id");
         } elseif(!$new_value[cara_masuk]) {
            $objResponse->addAlert("Silakan Isi Cara Masuk.");
            $objResponse->addScriptCall("fokus", "cara_masuk");
         } elseif($new_value[cara_masuk] == "RUJUKAN" && !$new_value[perujuk_id]) {
            $objResponse->addAlert("Silakan Isi Perujuk.");
            $objResponse->addScriptCall("fokus", "perujuk_id");
         } elseif(!$new_value[cara_bayar]) {
            $objResponse->addAlert("Silakan Isi Cara Bayar.");
            $objResponse->addScriptCall("fokus", "cara_bayar");
          } elseif(!$new_value[nama_ayah]) {
            $objResponse->addAlert("Silakan Isi Nama Ayah.");
            $objResponse->addScriptCall("fokus", "nama_ayah"); 
         } elseif(!$new_value[nama_ibu]) {
            $objResponse->addAlert("Silakan Isi Nama Ibu.");
            $objResponse->addScriptCall("fokus", "nama_ibu");
         } elseif(!$new_value[no_ktp_sim]) {
            $objResponse->addAlert("Silakan Isi No KTP/SIM.");
            $objResponse->addScriptCall("fokus", "no_ktp_sim");                    
         } else {
            /*
            for($i=0;$i<sizeof($new_value);$i++) {
            $kunci = key($new_value);
            $objResponse->addAppend("debug", "innerHTML", $kunci . "=>" . $new_value[$kunci] . "<br />");
            next($new_value);
            }
            */
            $objResponse->addScriptCall("xajax_simpan_pasien", $new_value);
         }
         return $objResponse;
      }

      function reset_pasien() {
         $objResponse = new xajaxResponse();
         $objResponse->addScript("document.tambah_pasien.reset()");
         $objResponse->addClear("id_pasien", "value");
         $objResponse->addAssign("list_tombol_besar_kunjungan", "style.display", "none");
         //$objResponse->addClear("list_kunjungan", "innerHTML");
         //$objResponse->addScriptCall("fokus", "id");
         return $objResponse;
      }

      function get_tgl_lahir($value) {
         $tgl_skr = date("Y-m-d");
         $arr_tgl_skr = explode("-", $tgl_skr);

         $ret = @date("Y-m-d", @mktime(0, 0, 0, $arr_tgl_skr[1] - $value[usia_bulan], $arr_tgl_skr[2] -
            $value[usia_hari], $arr_tgl_skr[0] - $value[usia_tahun]));
         $arr_ret = explode("-", $ret);
         $objResponse = new xajaxResponse();
         $objResponse->addAssign("tgl_lahir_tgl", "value", $arr_ret[2]);
         $objResponse->addAssign("tgl_lahir_bln", "value", $arr_ret[1]);
         $objResponse->addAssign("tgl_lahir_thn", "value", $arr_ret[0]);
         return $objResponse;
      }

      function hitung_umur($value) {
         $tgl_lahir = $value[tgl_lahir_thn]."-".$value[tgl_lahir_bln]."-".$value[tgl_lahir_tgl];
         $skr = date("Y-m-d");
         $usia = hitungUmur($tgl_lahir, $skr);

         $objResponse = new xajaxResponse();
         $objResponse->addAssign("usia_tahun", "value", $usia[tahun]);
         $objResponse->addAssign("usia_bulan", "value", $usia[bulan]);
         $objResponse->addAssign("usia_hari", "value", $usia[hari]);
         return $objResponse;
      }
   }

   $kon = new Konek;
   $kon->sql = "SELECT id, nama FROM ref_pendidikan";
   $kon->execute();
   $data_pendidikan = $kon->getAll();

   $kon->sql = "SELECT id, nama FROM ref_pekerjaan";
   $kon->execute();
   $data_pekerjaan = $kon->getAll();

   $kon->sql = "SELECT id, nama FROM ref_propinsi";
   $kon->execute();
   $data_propinsi = $kon->getAll();

   $kon->sql = "SELECT id, nama FROM dokter WHERE aktif = '1'";
   $kon->execute();
   $data_dokter = $kon->getAll();

   //$_xajax->debugOn();
   $_xajax->registerFunction(array("get_pasien", "IRD", "get_pasien"));
   $_xajax->registerFunction(array("simpan_pasien", "IRD", "simpan_pasien"));
   $_xajax->registerFunction(array("simpan_pasien_check", "IRD",
      "simpan_pasien_check"));
   $_xajax->registerFunction(array("reset_pasien", "IRD", "reset_pasien"));
   $_xajax->registerFunction(array("get_tgl_lahir", "IRD", "get_tgl_lahir"));
   $_xajax->registerFunction(array("hitung_umur", "IRD", "hitung_umur"));
   $_xajax->registerFunction(array("cetak_form", "IRD", "cetak_form"));
   $_xajax->registerFunction(array("get_no_antrian", "IRD", "get_no_antrian"));
   include "sub.pencarian.php";
   include AJAX_REF_DIR."daerah.php";
   include AJAX_REF_DIR."kunjungan.php";
?>