<?
Class Langsung_Bayar {
	function buka_langsung_bayar($idk) {
		unset($_SESSION[kasir][kunjungan][jasa_cetak]);
		$kon = new Konek;
		//$kon->debug = 1;
		$objResponse = new xajaxResponse;
		//get data pasien
		$kon->sql = "
			SELECT
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				pel.nama as nama_pelayanan,
				p.sex as jk,
				CONCAT_WS(' - ', kk.cara_bayar, kk.jenis_askes, rper.nama) as cara_bayar,
				kk.nomor as nomor,
                pel.id as id_pel,
                CASE WHEN (kk.tgl_keluar IS NULL) THEN DATEDIFF(DATE(NOW()), kk.tgl_daftar)
				ELSE DATEDIFF(kk.tgl_keluar, kk.tgl_daftar) END as lama_dirawat,
                kk.kamar_id as kamar_id,
                kk.cara_bayar as jenis_bayar, kk.pj_nama
			FROM
				kunjungan_kamar kk
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				LEFT JOIN ref_perusahaan rper ON (rper.id = kk.perusahaan_id)
			WHERE
				k.id = '".$idk."'
			GROUP BY
				p.id
		";
		$kon->execute();
		$data_pasien = $kon->getOne();
        $id_poli = $data_pasien[id_pel];
		$arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
		$data_pasien[usia] = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
		$data_pasien[usia] .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
		$data_pasien[usia] .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
		$objResponse->addClear("modal_lb", "style.display");
		$objResponse->addAssign("lb_id_kunjungan", "value", $idk);
		$objResponse->addAssign("lb_no_rm", "innerHTML", $data_pasien[id_display]);
		$objResponse->addAssign("lb_pasien", "innerHTML", $data_pasien[nama]);
		$objResponse->addAssign("lb_sex", "innerHTML", $data_pasien[jk]);
		$objResponse->addAssign("lb_usia", "innerHTML", $data_pasien[usia]);
		$objResponse->addAssign("lb_alamat", "innerHTML", $data_pasien[alamat]);
		$objResponse->addAssign("lb_tgl_daftar", "innerHTML", tanggalIndo($data_pasien[tgl_daftar], 'j F Y'));
		$objResponse->addAssign("lb_cara_bayar", "innerHTML", $data_pasien[cara_bayar]);
		$objResponse->addAssign("lb_nomor", "innerHTML", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);
        $objResponse->addAssign("lb_pj_nama","InnerHTML",$data_pasien[pj_nama]);        
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
	
		//BIKIN SESSION UNTUK DICETAK
       
		$_SESSION[igd][langsung_bayar][data_px] = $data_pasien;

		$tabel = new Table;
		$tabel->cellspacing = "0";
		$tabel->scroll = false;
		$tabel->extra_table = "style=\"width:12cm;\"";
		$tabel->addTh("No", "Keterangan", "Jumlah Biaya","Biaya Tagihan");
		$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "","");
        setcookie("idk",$idk);
        setcookie("lama",$data_pasien[lama_dirawat]);
        setcookie("kamar_id",$data_pasien[kamar_id]);
          //bayar kamar
         if ($data_pasien[lama_dirawat]==0) : 
          //cek dulu dikunjungan kamar
          //$objResponse->addAlert($data_pasien[lama_dirawat]);
          $sql = "
        		SELECT
        			kk.id as kunjungan_id,kk.kamar_id as kamar_id,
                    CASE WHEN (kk.tgl_keluar IS NULL) THEN DATEDIFF(DATE(NOW()), kk.tgl_daftar)
        			ELSE DATEDIFF(kk.tgl_keluar, kk.tgl_daftar) END as lama_dirawat,
                    kk.kamar_id as kamar_id,
                    kk.cara_bayar as jenis_bayar
        		FROM
        			kunjungan_kamar kk
        			JOIN kunjungan k ON (k.id = kk.kunjungan_id)				
        		WHERE
        			k.id = '".$idk."'
                    AND kk.parent_id IS NOT NULL
        		GROUP BY
        			kk.id
        	";
           
            $temp = $sql;
            $kon->sql = $sql;
        	$kon->execute();
        	$data_rawat = $kon->getOne();  
         //$objResponse->addAlert($data_rawat[lama_dirawat]);
         //cek lagi bila rawat baru
         if ($data_rawat[lama_dirawat]==0) :
            $lama_rawat = 1;
         else:
            $lama_rawat = $data_rawat[lama_dirawat];
         endif;
         //$objResponse->addAlert($lama_dirawat);
              //get informasi kamar        
        for ($n=1;$n<=$lama_rawat;$n++){
            $sql ="
                    SELECT kk.kamar_id as kamar_id, k.nama as nama_kamar, k.kelas as kelas, p.nama as bangsal,
                    k.tarif_umum as tarif_umum, k.tarif_asuransi as tarif_asuransi ,rf.nomor as no_bed
                    FROM kunjungan_kamar kk, kamar k, pelayanan p, ref_kamar rf
                    WHERE kk.kamar_id = k.id AND k.pelayanan_id = p.id
                    AND kk.no_kamar = rf.id
                    AND kk.kamar_id ='".$data_rawat[kamar_id]."'";
            $kon->sql = $sql;
    
            $kon->execute();
    		$data_kamar = $kon->getAll();
            //$objResponse->addAlert($sql);
        	if(!empty($data_kamar)) {
    		$tabel->addRow("","<b>Ruang dan Akomodasi</b>","","");
               
        		for($i=0;$i<sizeof($data_kamar);$i++) {
        		   if ($data_pasien[jenis_bayar]=='UMUM'):
                        $tarif = $data_kamar[$i][tarif_umum];  
                    else:
                        $tarif = $data_kamar[$i][tarif_asuransi];            
                    endif;
                
        			$tabel->addRow(
        				($i+1),
        				$data_kamar[$i][bangsal]." Kamar ".$data_kamar[$i][nama_kamar]." - No Bed ". $data_kamar[$i][no_bed],         
        				uangIndo($tarif),uangIndo($tarif)               
        			);
        			$total += $tarif;	
                    //$sudah_dibayar += $tarif;	
                    $kurang +=$tarif;	
        		}
    		}
        
        }
        
        else :
        
          //get informasi kamar        
        for ($n=1;$n<=$data_pasien[lama_dirawat];$n++){
            $kon->sql = "
                    SELECT kk.kamar_id as kamar_id, k.nama as nama_kamar, k.kelas as kelas, p.nama as bangsal,
                    k.tarif_umum as tarif_umum, k.tarif_asuransi as tarif_asuransi ,rf.nomor as no_bed
                    FROM kunjungan_kamar kk, kamar k, pelayanan p, ref_kamar rf
                    WHERE kk.kamar_id = k.id AND k.pelayanan_id = p.id
                    AND kk.no_kamar = rf.id
                    AND kk.kamar_id ='".$data_pasien[kamar_id]."'";
    
            $kon->execute();
    		$data_kamar = $kon->getAll();
        
        	if(!empty($data_kamar)) {
    		$tabel->addRow("","<b>Ruang dan Akomodasi</b>","","");
               
        		for($i=0;$i<sizeof($data_kamar);$i++) {
        		   if ($data_pasien[jenis_bayar]=='UMUM'):
                        $tarif = $data_kamar[$i][tarif_umum];  
                    else:
                        $tarif = $data_kamar[$i][tarif_asuransi];            
                    endif;
                
        			$tabel->addRow(
        				($i+1),
        				$data_kamar[$i][bangsal]." Kamar ".$data_kamar[$i][nama_kamar]." - No Bed ". $data_kamar[$i][no_bed],         
        				uangIndo($tarif),uangIndo($tarif)               
        			);
        			$total += $tarif;	
                  // $sudah_dibayar += $tarif;	
                   $kurang +=$tarif;	
        		}
    		}
        
        }
        
        endif;  
       
        
        //get data karcis
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.biaya_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kb.karcis_id IS NOT NULL
                AND kb.kwid IS NULL
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_karcis = $kon->getAll();
		if(!empty($data_karcis)) {
			$tabel->addRow("","<b>Karcis</b>","","");
			for($i=0;$i<sizeof($data_karcis);$i++) {
				$tabel->addRow(
					($i+1),
					$data_karcis[$i][nama],
					uangIndo($data_karcis[$i][bayar]),uangIndo($data_karcis[$i][bayar])
				);
				$total += $data_karcis[$i][bayar];
				$sudah_dibayar += $data_karcis[$i][mampu_bayar];
				//belum bayar
				if(!$data_karcis[$i][kwitansi_id]) $kurang += $data_karcis[$i][bayar];
			}
		}

        //get data poli tarif
		$kon->sql = "
		SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.bayar_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN pelayanan pel ON (pel.id = kb.poli_id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.poli_id IS NOT NULL     
                AND kb.kwid IS NULL           
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kb.id
			ORDER BY kb.id";
            
		$kon->execute();
		$data_poli = $kon->getAll();
		if(!empty($data_poli)) {
			$tabel->addRow("","<b>Kunjungan Poli</b>","","");
			for($i=0;$i<sizeof($data_poli);$i++) {
				$tabel->addRow(
					($i+1),
					$data_poli[$i][nama],
					uangIndo($data_poli[$i][bayar]),uangIndo($data_poli[$i][bayar])
				);
				$total += $data_poli[$i][bayar];
				$sudah_dibayar += $data_poli[$i][mampu_bayar];
				//belum bayar
				if(!$data_poli[$i][kwitansi_id]) $kurang += $data_poli[$i][bayar];
			}
		}
		//get data tindakan
		$kon->sql = "
			SELECT
				kki.nama as nama,
				SUM(kb.biaya_jasa) as bayar,
				SUM(kb.mampu_bayar_jasa) as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_kamar_icopim kki 
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_icopim_id = kki.id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
			WHERE
				kb.icopim_detil_id IS NOT NULL
                AND kb.kwid IS NULL
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kki.id
			ORDER BY kki.id
		";
		$kon->execute();
		$data_tindakan = $kon->getAll();
		if(!empty($data_tindakan)) {
			$tabel->addRow("","<b>Tindakan</b>","","");
			for($i=0;$i<sizeof($data_tindakan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_tindakan[$i][nama],
					uangIndo($data_tindakan[$i][bayar]),uangIndo($data_tindakan[$i][bayar])
				);
				$total += $data_tindakan[$i][bayar];
				$sudah_dibayar += $data_tindakan[$i][mampu_bayar];
				//belum bayar
				if(!$data_tindakan[$i][kwitansi_id]) $kurang += $data_tindakan[$i][bayar];
			}
		}

		//get data specimen
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.biaya_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN lab_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
				JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.lab_specimen_id IS NOT NULL
                AND kb.kwid IS NULL
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_specimen = $kon->getAll();
		if(!empty($data_specimen)) {
			$tabel->addRow("","<b>Pemeriksaan Specimen</b>","","");
			for($i=0;$i<sizeof($data_specimen);$i++) {
				$tabel->addRow(
					($i+1),
					$data_specimen[$i][nama],
					uangIndo($data_specimen[$i][bayar]),uangIndo($data_specimen[$i][bayar])
				);
				$total += $data_specimen[$i][bayar];
				$sudah_dibayar += $data_specimen[$i][mampu_bayar];
				//belum bayar
				if(!$data_specimen[$i][kwitansi_id]) $kurang += $data_specimen[$i][bayar];
			}
		}

		//get data radio	
        
        $kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.biaya_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
                JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.radio_pemeriksaan_id IS NOT NULL
                AND kb.kwid IS NULL
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
        
		$kon->execute();
		$data_radio = $kon->getAll();
		if(!empty($data_radio)) {
			$tabel->addRow("","<b>Pemeriksaan Radiologi</b>","","");
			for($i=0;$i<sizeof($data_radio);$i++) {
				$tabel->addRow(
					($i+1),
					$data_radio[$i][nama],
					uangIndo($data_radio[$i][bayar]),uangIndo($data_radio[$i][bayar])
				);
				$total += $data_radio[$i][bayar];
				$sudah_dibayar += $data_radio[$i][mampu_bayar];
				//belum bayar
				if(!$data_radio[$i][kwitansi_id]) $kurang += $data_radio[$i][bayar];
			}
		}

		//get data bhp
		$kon->sql = "
			SELECT
				kb.nama as nama,
				kb.bayar_bhp as bayar,
				kb.mampu_bayar_bhp as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_bayar kb
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
			WHERE
				kb.bhp_id IS NOT NULL
				AND kk.kunjungan_id = '".$idk."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();
		if(!empty($data_bhp)) {
			$tabel->addRow("","<b>Bahan Habis Pakai</b>","","");
			for($i=0;$i<sizeof($data_bhp);$i++) {
				$tabel->addRow(
					($i+1),
					$data_bhp[$i][nama],
					uangIndo($data_bhp[$i][bayar]),uangIndo($data_bhp[$i][bayar])
				);
				$total += $data_bhp[$i][bayar];
				$sudah_dibayar += $data_bhp[$i][mampu_bayar];
				//belum bayar
				if(!$data_bhp[$i][kwitansi_id]) $kurang += $data_bhp[$i][bayar];
			}
		}

		//get data kendaraan
		$kon->sql = "
			SELECT
				kkd.nama as nama,
				SUM(kb.bayar_bhp+kb.bayar_jasa) as bayar,
				SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as mampu_bayar,
				kwd.kwitansi_id as kwitansi_id
			FROM
				kunjungan_kendaraan kkd 
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kendaraan_id = kkd.id)
				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kk.kunjungan_id = '".$idk."'
                AND kb.kwid IS NULL
			GROUP BY
				kkd.id
			ORDER BY kkd.id
		";
		$kon->execute();
		$data_kendaraan = $kon->getAll();
		if(!empty($data_kendaraan)) {
			$tabel->addRow("","<b>Sewa Kendaraan</b>","","");
			for($i=0;$i<sizeof($data_kendaraan);$i++) {
				$tabel->addRow(
					($i+1),
					$data_kendaraan[$i][nama],
					uangIndo($data_kendaraan[$i][bayar]),uangIndo($data_kendaraan[$i][bayar])
				);
				$total += $data_kendaraan[$i][bayar];
				$sudah_dibayar += $data_kendaraan[$i][mampu_bayar];
				//belum bayar
				if(!$data_kendaraan[$i][kwitansi_id]) $kurang += $data_kendaraan[$i][bayar];
			}
		}

		$tabel->addRow("","<b>Total</b>", uangIndo($total),uangIndo($total));
		$tabel_jasa = $tabel->build();
		$objResponse->addAssign("lb_list_jasa", "innerHTML", $tabel_jasa);

		$objResponse->addAssign("lb_total_display", "value", uangIndo($total));
		$objResponse->addAssign("lb_total_display", "title", terbilang($total));
		$objResponse->addAssign("lb_sudah_dibayar_display", "value", uangIndo($sudah_dibayar));
		$objResponse->addAssign("lb_sudah_dibayar_display", "title", terbilang($sudah_dibayar));
		$objResponse->addAssign("lb_kurang_display", "value", uangIndo($kurang));
		$objResponse->addAssign("lb_kurang", "value", $kurang);
		$objResponse->addAssign("lb_kurang_display", "title", terbilang($kurang));
		$objResponse->addAssign("lb_mampu_bayar", "value", $kurang);
		$objResponse->addAssign("mampu_terbilang", "innerHTML", terbilang($kurang));
		$objResponse->addScriptCall("fokus", "lb_mampu_bayar");


		//get data kwitansi :
		$kon->sql = "
			SELECT
				CONCAT_WS('-', kw.tempat_pembayaran, kw.id) as no_kwitansi,
				kw.bayar as mampu_bayar,
				kw.tgl as tgl
			FROM
				kunjungan_bayar kb
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kwitansi kw ON (kw.id = kwd.kwitansi_id)
				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
			WHERE
				kk.kunjungan_id = '".$idk."'
			GROUP BY
				kw.id
			ORDER BY 
				kw.id
		";
		$kon->execute();
		$data_kw = $kon->getAll();

		if($kurang) {
			//ada yang belum dibayar
			$objResponse->addAssign("lb_simpan", "style.display", "");
		}

		if(!empty($data_kw)) {
			//ada yang sudah dibayar
			for($i=0;$i<sizeof($data_kw);$i++) {
				$kw .= "<br /><input type=\"button\" name=\"lb_cetak\" id=\"lb_cetak\" value=\"Cetak Kwitansi ".$data_kw[$i][no_kwitansi]."\" class=\"inputan\" onclick=\"cetak_kwitansi('".$data_kw[$i][no_kwitansi]."');\" /> <br /> <em>Rp.&nbsp;".uangIndo($data_kw[$i][mampu_bayar])."&nbsp;-&nbsp;".tanggalIndo($data_kw[$i][tgl], "j F Y H:i")."</em><br />";
			}
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "");
			$objResponse->addAssign("lb_button_kwitansi", "innerHTML", $kw);
			if(!$kurang) $objResponse->addAssign("lb_simpan", "style.display", "none");
		} else {
			$objResponse->addAssign("fieldset_lb_button_kwitansi", "style.display", "none");
		}

		return $objResponse;
	}

	function simpan_langsung_bayar($val) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
		$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.biaya_jasa as bayar_jasa FROM kunjungan_bayar kb JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id) LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kk.kunjungan_id = '".$val[lb_id_kunjungan]."' AND kwd.kwitansi_id IS NULL";
        $_SESSION[idkk] = $val[lb_id_kunjungan];
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
			if($val[lb_mampu_bayar] < $val[lb_kurang]) $status = "ANGSUR";
			else $status = "LUNAS";
			$id_kwitansi = bikinKwitansi("KASIR", $val[lb_mampu_bayar], $status);
			$mampu = round($val[lb_mampu_bayar]/$val[lb_kurang], 2);
			$tot = 0;
			for($i=0;$i<sizeof($data);$i++) {
				$data[$i][mampu_bayar_bhp] = round($data[$i][bayar_bhp] * $mampu);
				$data[$i][mampu_bayar_jasa] = round($data[$i][bayar_jasa] * $mampu);
				$tot += $data[$i][mampu_bayar_bhp] + $data[$i][mampu_bayar_jasa];
			}
			$selisih = $val[lb_mampu_bayar] - $tot;
			if($data[0][mampu_bayar_jasa]) $data[0][mampu_bayar_jasa] += $selisih;
			else $data[0][mampu_bayar_bhp] += $selisih;

			for($i=0;$i<sizeof($data);$i++) {
				//$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwitansi_id = '".$id_kwitansi."', tempat_pembayaran = 'KASIR' WHERE id = '".$data[$i][id]."'";
				//$kon->execute();
				$kon->sql = "UPDATE kunjungan_bayar SET mampu_bayar_bhp = '".$data[$i][mampu_bayar_bhp]."', mampu_bayar_jasa = '".$data[$i][mampu_bayar_jasa]."', kwid = '".$id_kwitansi."' WHERE id = '".$data[$i][id]."'";
				$kon->execute();
				//pembayaran angsuran
				$kon->sql = "INSERT INTO kwitansi_detil(kunjungan_bayar_id, kwitansi_id, angsuran_bhp, angsuran_jasa) VALUES ('".$data[$i][id]."', '".$id_kwitansi."', '".$data[$i][mampu_bayar_bhp]."', '".$data[$i][mampu_bayar_jasa]."')";
				$kon->execute();

			}
			$id_kwitansi = tambahNol($id_kwitansi, 20);
			$objResponse->addScriptCall("cetak_kwitansi", "KASIR-" . $id_kwitansi);
			$objResponse->addScriptCall("show_status_simpan");
		} else {
			$objResponse->addAlert("Data Pembayaran Tidak Dapat Dirubah, karena : \n1. Kwitansi Sudah Dibuat atau\n2. Belum Terjadi Transaksi!");
		}
		$objResponse->addScriptCall("tutup_modal_lb");
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		return $objResponse;
	}
    function bayar_uang_muka($val){
        $kon = new Konek;
        $objResponse= new xajaxResponse;
       	$kon->sql = "SELECT kb.id as id, kb.bayar_bhp as bayar_bhp, kb.biaya_jasa as bayar_jasa FROM kunjungan_bayar kb JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id) LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id) WHERE kk.kunjungan_id = '".$val[lb_id_kunjungan]."' AND kwd.kwitansi_id IS NULL";
        $_SESSION[idkk] = $val[lb_id_kunjungan];
		$kon->execute();
		$data = $kon->getAll();
		if(!empty($data)) {
		  for($i=0;$i<sizeof($data);$i++){
		      $kon->sql= "update kunjungan_bayar set uang_muka = '".$data[$i][lb_uang_muka]."' WHERE id = '".$data[$i][id]."'";
              $kon->execute();
		  }
		  $objResponse->addScriptCall("show_status_simpan");
		}
		$objResponse->addScriptCall("tutup_modal_lb");
        return $objResponse;
    }
}

$_xajax->registerFunction(array("buka_langsung_bayar", "Langsung_Bayar", "buka_langsung_bayar"));
$_xajax->registerFunction(array("simpan_langsung_bayar", "Langsung_Bayar", "simpan_langsung_bayar"));
$_xajax->registerFunction(array("bayar_uang_muka", "Langsung_Bayar", "bayar_uang_muka"));

?>