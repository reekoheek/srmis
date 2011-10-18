<?php
$_TITLE = "Kwitansi-" . $_GET[id_kwitansi];
$objResponse = new xajaxResponse;
/* Preparing Detail Transactions */
$tabel = new Table;
$tabel->cellspacing = "0";
$tabel->scroll = false;
$tabel->extra_table = "style=\"width:100%;\"";
$tabel->addTh("No", "Keterangan", "Jumlah Biaya", "Biaya Tagihan");
$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6cm;\"", "");
/* End Detail Prepared */

$id_kwitansi = explode("-", $_GET[id_kwitansi]);
$tempat_pembayaran = $id_kwitansi[0];
$no_kwitansi = $id_kwitansi[1];

$kon = new Konek;
//get data kwitansi
$kon->sql = "SELECT tgl FROM  kwitansi WHERE  id = '".$no_kwitansi."'";
$kon->execute();
$data_kw = $kon->getOne();


$idk  = $_COOKIE[idk];
$lama = $_COOKIE[lama];
$kamar_id = $_COOKIE[kamar_id];
$objResponse->addAlert($kamar_id);
  //bayar kamar
         if ($lama==0) : 
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
        for ($n=1;$n<=$lama;$n++){
            $kon->sql = "
                    SELECT kk.kamar_id as kamar_id, k.nama as nama_kamar, k.kelas as kelas, p.nama as bangsal,
                    k.tarif_umum as tarif_umum, k.tarif_asuransi as tarif_asuransi ,rf.nomor as no_bed
                    FROM kunjungan_kamar kk, kamar k, pelayanan p, ref_kamar rf
                    WHERE kk.kamar_id = k.id AND k.pelayanan_id = p.id
                    AND kk.no_kamar = rf.id
                    AND kk.kamar_id ='".$kamar_id."'";
    
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

$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp + kb.bayar_jasa as bayar,
		kb.mampu_bayar_bhp + kb.mampu_bayar_jasa as mampu_bayar
	FROM
		kunjungan_bayar kb
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.karcis_id IS NOT NULL
        AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id
";
$kon->execute();
$data_karcis = $kon->getAll();
if(!empty($data_karcis)) {
	$tabel->addRow("","<b>Karcis</b>","","");
	for($i=0;$i<sizeof($data_karcis);$i++) {
		$tabel->addRow(
			($i+1),
			$data_karcis[$i][nama],
			uangIndo($data_karcis[$i][bayar]),uangIndo($data_karcis[$i][bayar]." ")
		);
		$total += $data_karcis[$i][bayar];
		$mampu_bayar += $data_karcis[$i][mampu_bayar];
	}
}

//get data poli tarif
		$kon->sql = "
		SELECT
				kb.nama as nama,
				kb.bayar_bhp+kb.biaya_jasa as bayar,
				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar
			FROM
				kunjungan_bayar kb
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.poli_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id";
            
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
		$mampu_bayar += $data_poli[$i][mampu_bayar];
			}
		}


//get data tindakan
$kon->sql = "
	SELECT
		kki.nama as nama,
		SUM(kb.biaya_jasa) as bayar,
		SUM(kb.mampu_bayar_jasa) as mampu_bayar
	FROM
		kunjungan_kamar_icopim kki 
		JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_icopim_id = kki.id)
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.icopim_detil_id IS NOT NULL
		AND kwd.kwitansi_id= '".$no_kwitansi."'
	GROUP BY
		kki.id
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
		$mampu_bayar += $data_tindakan[$i][mampu_bayar];
	}
}

//specimen
$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp + kb.biaya_jasa as bayar,
		kb.mampu_bayar_bhp + kb.mampu_bayar_jasa as mampu_bayar
	FROM
		kunjungan_bayar kb 
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.lab_specimen_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id
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
		$mampu_bayar += $data_specimen[$i][mampu_bayar];
	}
}

//radio
$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp + kb.biaya_jasa as bayar,
		kb.mampu_bayar_bhp + kb.mampu_bayar_jasa as mampu_bayar
	FROM
		kunjungan_bayar kb 
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.radio_pemeriksaan_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id
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
		$mampu_bayar += $data_radio[$i][mampu_bayar];
	}
}

//get data bhp
$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp as bayar,
		kb.mampu_bayar_bhp as mampu_bayar
	FROM
		kunjungan_bayar kb 
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.bhp_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY
		kb.id
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
		$mampu_bayar += $data_bhp[$i][mampu_bayar];
	}
}

//get data kendaraan
$kon->sql = "
	SELECT
		kkd.nama as nama,
		SUM(kb.bayar_bhp+kb.bayar_jasa) as bayar,
		SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as mampu_bayar
	FROM
		kunjungan_kendaraan kkd 
		JOIN kunjungan_bayar kb ON (kb.kunjungan_kendaraan_id = kkd.id)
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kwd.kwitansi_id= '".$no_kwitansi."'
	GROUP BY
		kkd.id
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
		$mampu_bayar += $data_kendaraan[$i][mampu_bayar];
	}
}
$tabel->addRow("","<b>Total</b>", uangIndo($total),uangIndo($total));
$tabel->addRow("","<b>Dibayar</b>", uangIndo($mampu_bayar),uangIndo($mampu_bayar));
//param u/ HTML
//$_SESSION[igd][langsung_bayar][data_px]
$tabel_jasa = $tabel->build();
?>