<?
$_TITLE = "Daftar Kunjungan Radiologi";
Class Kunjungan {

	function list_data($hal=0, $val="") {
		if($val[pasien_id]) {
			$s = "p.id = '".$val[pasien_id]."'";
		} elseif($val[nama]) {
			$s = "p.nama LIKE '%".$val[nama]."%'";
		} elseif ($val[telp]){
            $s = "p.telp LIKE '%".$val[telp]."%'";
		}
		
		$tgl_periksa_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
		$tgl_periksa_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
			
		$paging = new MyPagina;
        $kon = new Konek;
		$paging->setOnclickValue("xajax.getFormValues('form_kunjungan')");
		
		
		if ($val[pasien_id]=='' AND $val[nama]=='' AND $val[telp]=='')
		{
		//pemilihan untuk list
		if ($val[cara_masuk_p]=='RAWAT JALAN')
		{
			$sql = "
			SELECT
					k.id as id_kunjungan,
					kk.id as id_kunjungan_kamar,
                    kk.kunjungan_id as kunjungan_id,
					k.kunjungan_ke as kunjungan_ke,
					kk.no_antrian as no_antrian,
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.id as pasien_id,
					p.nama as nama,
					pel.nama as pelayanan,
				CASE 
					WHEN jenis = 'PASIEN LUAR' THEN 'PASIEN LUAR'
					WHEN jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', jenis, kmr.nama)
				END as asal,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					d.nama as pengirim,
					kk.kelanjutan as kelanjutan
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					DATE(kk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
					AND pel.jenis = 'RAWAT JALAN'
			 		
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
		";
		}
		elseif ($val[cara_masuk_p]=='RAWAT INAP')
		{
			$sql = "
			SELECT
					k.id as id_kunjungan,
					kk.id as id_kunjungan_kamar,
                    kk.kunjungan_id as kunjungan_id,
					k.kunjungan_ke as kunjungan_ke,
					kk.no_antrian as no_antrian,
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.id as pasien_id,
					p.nama as nama,
					pel.nama as pelayanan,
				CASE 
					WHEN jenis = 'PASIEN LUAR' THEN 'PASIEN LUAR'
					WHEN jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', jenis, kmr.nama)
				END as asal,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					d.nama as pengirim,
					kk.kelanjutan as kelanjutan
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					DATE(kk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
					AND pel.jenis = 'RAWAT INAP'
			 		
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
		";
		}
		elseif ($val[cara_masuk_p]=='PASIEN LUAR')
		{
			$sql = "
			SELECT 
                kk.kunjungan_id as kunjungan_id,
				rk.id as id_kunjungan_radio,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				CASE 
					WHEN cara_masuk = 'PASIEN LUAR' THEN 'PASIEN LUAR'
					WHEN cara_masuk = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', cara_masuk, kmr.nama)
				END as asal,
				rk.tgl_periksa as tgl_periksa,
				pengirim as pengirim
			FROM 
				radio_kunjungan rk
				JOIN pasien p ON (p.id = rk.pasien_id)
				LEFT JOIN kunjungan_kamar kk ON (kk.id = rk.kunjungan_kamar_id)
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
			WHERE
				DATE(rk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
				AND rk.cara_masuk = 'PASIEN LUAR'
			ORDER BY 
				rk.id DESC
		";
		}
		elseif ($val[cara_masuk_p]=='IGD')
		{
			$sql = "
			SELECT
					k.id as id_kunjungan,
					kk.id as id_kunjungan_kamar,
                    kk.kunjungan_id as kunjungan_id,
					k.kunjungan_ke as kunjungan_ke,
					kk.no_antrian as no_antrian,
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.id as pasien_id,
					p.nama as nama,
					pel.nama as pelayanan,
				CASE 
					WHEN jenis = 'PASIEN LUAR' THEN 'PASIEN LUAR'
					WHEN jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', jenis, kmr.nama)
				END as asal,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					d.nama as pengirim,
					kk.kelanjutan as kelanjutan
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					DATE(kk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
					AND pel.jenis = 'IGD'
			 		
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
		";
		}
		}
		else
		{
			$sql = "
			SELECT
					k.id as id_kunjungan,
					kk.id as id_kunjungan_kamar,
                    kk.kunjungan_id as kunjungan_id,
					k.kunjungan_ke as kunjungan_ke,
					kk.no_antrian as no_antrian,
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.id as pasien_id,
					p.nama as nama,
					pel.nama as pelayanan,
				CASE 
					WHEN jenis = 'PASIEN LUAR' THEN 'PASIEN LUAR'
					WHEN jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', jenis, kmr.nama)
				END as asal,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					d.nama as pengirim,
					kk.kelanjutan as kelanjutan
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					$s
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
		";
		}
		$paging->sql = $sql;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[radio_kunjungan][hal] = $hal;

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 310;
		$table->addTh(
			"No", 
			"No.<br />Kjg",
			"No. RM", 
			"Pasien", 
			"Tgl<br />Periksa",
			"Asal<br />Pasien",
			"Dokter<br />Pengirim", 
			"Status Bayar"
			/*,"Hapus"*/
		);
		//$table->addExtraTh("style=\"width:50px;\"","style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","","","","style=\"width:70px;\"");
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","");
		for($i=0;$i<sizeof($data);$i++) {
		  
                  //get data radio
            	$kon->sql = "
            		SELECT
            			kb.nama as nama,
            			kb.bayar_bhp+kb.bayar_jasa as bayar,
            			kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
            			kwd.kwitansi_id as kwitansi_id,
                        kw.status as status
            		FROM
            			kunjungan_bayar kb
            			JOIN radio_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
            			JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)
            			LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
                        LEFT JOIN kwitansi kw ON  (kw.id = kwd.kwitansi_id)
            		WHERE
            			kb.radio_specimen_id IS NOT NULL
            			AND kk.kunjungan_id = '".$data[$i][kunjungan_id]."'
            		GROUP BY
            			kb.id
            		ORDER BY kb.id
            	";
            	$kon->execute();
        		$data_r = $kon->getOne();
                if(!empty($data_r)){
                    if (!empty($data_r[status])){
                        $status_bayar = "<font color = blue><b>LUNAS</b></font>";
                    }    
                    else {
                        $status_bayar = "<font color = red><b>BELUM LUNAS</b></font>";                        
                    }        
                }else 
                {$status_bayar = "<font color = red><b>BELUM LUNAS</b></font>";}
          
          	$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan_radio], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				tanggalIndo($data[$i][tgl_periksa], 'j M Y'), 
				$data[$i][asal], 
				$data[$i][pengirim], 
				$status_bayar
				/*,"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
				);
			if ($val[cara_masuk_p]=='PASIEN LUAR')
			{
				$table->addOnclickTd(
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')",
					"xajax_buka_kunjungan('".$data[$i][id_kunjungan_radio]."')"
				);
			}
			else
			{
				$table->addOnclickTd(
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')",
					"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."')"
				);	
			}
			
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
/*
BIKIN SESSION HAK DAN SIFAT, AGAR NGIRIT MEMORI DI MODAL KUNJUNGAN
*/
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM hak ORDER BY nama";
		$kon->execute();
		$_SESSION[radio][hak] = $kon->getAll();

		$kon->sql = "SELECT * FROM sifat";
		$kon->execute();
		$_SESSION[radio][sifat] = $kon->getAll();


		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}
/*
	function hapus_kunjungan_kamar($kunjungan_id, $kunjungan_kamar_id) {
		$kon = new Konek;
		//jika row kunjungan_kamar = 1, hapus kunjungan juga
		$kon->sql = "SELECT COUNT(*) as jml FROM kunjungan_kamar WHERE kunjungan_id = '".$kunjungan_id."'";
		$kon->execute();
		$data = $kon->getOne();
		if($data[jml] > 1) {
			$kon->sql = "DELETE FROM kunjungan_kamar WHERE id = '".$kunjungan_kamar_id."'";
		} else {
			$kon->sql = "DELETE FROM kunjungan WHERE id = '".$kunjungan_id."'";
		}
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("list_data", "0");
			$objResponse->addScriptCall("fokus");
		}
		return $objResponse;
	}

	function hapus_kunjungan_kamar_confirm($kunjungan_id, $kunjungan_kamar_id, $obj) {
		$objResponse = new xajaxResponse();
		$objResponse->addConfirmCommands(1, "Yakin akan menghapus data kunjungan ini?");
		$objResponse->addScriptCall("xajax_hapus_kunjungan_kamar", $kunjungan_id, $kunjungan_kamar_id);
		return $objResponse;
	}
*/

}


//class daftar penunjang
	class DaftarPenunjang {
      function buka_daftar_penunjang($idkk) {
         $kon = new Konek;
         $objResponse = new xajaxResponse;
         $kon->sql = "
				SELECT
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.nama as nama,
					p.sex as sex,
					d.nama as dokter
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					kk.id = '".$idkk."'
			";
         $kon->execute();
         $data = $kon->getOne();
         $objResponse->addAssign("dp_no_rm", "innerHTML", $data[no_rm]);
         $objResponse->addAssign("dp_nama", "innerHTML", $data[nama]);
         $objResponse->addAssign("dp_sex", "innerHTML", $data[sex]);
         $objResponse->addAssign("dp_pengirim", "value", $data[dokter]);
         return $objResponse;
      }
      function daftar_penunjang($val) {
         $kon = new Konek;
         $objResponse = new xajaxResponse;
         if($val[dp_radio] == "1") {
            $sql = "
					INSERT INTO radio_kunjungan(
						pasien_id,
						kunjungan_kamar_id,
						kelas,
						tgl_daftar,
						tgl_periksa,
						pengirim,
						cara_masuk,
						cara_bayar,
						jenis_askes,
						perusahaan_id,
						nomor,
						pj_nama,
						pj_alamat,
						pj_telp,
						pj_hubungan_keluarga)
					SELECT
						k.pasien_id,
						kk.id,
						'RAWAT JALAN',
						NOW(),
						NOW(),
						'".$val[dp_pengirim]."',
						'RAWAT JALAN',
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
						JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					WHERE
						kk.id = '".$val[dp_idkk]."'
				";
            $kon->sql = $sql;
            $kon->execute();
            $objResponse->addAlert($sql);
         }
         //$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
         $objResponse->addScriptCall("show_status_simpan");
         $objResponse->addScriptCall("tutup_daftar_penunjang");
         return $objResponse;
      }
      
      
      function ke_kunjungan($val) {
      	 $kon = new Konek;
         $objResponse = new xajaxResponse;
         
         $sql = "
		 	SELECT 
				rk.id
			FROM 
				radio_kunjungan rk
			WHERE
				rk.kunjungan_kamar_id = '".$val[dp_idkk]."'
		 ";
		 $kon->sql = $sql;
         $kon->execute();
         
         $d = $kon->getOne();
         $id_d = $d[id];
         
         $sql = "
			SELECT 
				*
			FROM 
				kunjungan_bayar
			WHERE
				radio_kunjungan_id = '$id_d' AND
				kwid IS NULL				
			";
         $kon->sql = $sql;
         $kon->execute();
         $d = $kon->getOne();
         if (!$d)
         {
         
      	 $sql = "
					INSERT INTO radio_kunjungan(
						pasien_id,
						kunjungan_kamar_id,
						kelas,
						tgl_daftar,
						tgl_periksa,
						pengirim,
						cara_masuk,
						cara_bayar,
						jenis_askes,
						perusahaan_id,
						nomor,
						pj_nama,
						pj_alamat,
						pj_telp,
						pj_hubungan_keluarga)
					SELECT
						k.pasien_id,
						kk.id,
						pel.jenis,
						NOW(),
						NOW(),
						'".$val[dp_pengirim]."',
						pel.jenis,
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
						JOIN kamar kmr ON (kmr.id = kk.kamar_id)
						JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					WHERE
						kk.id = '".$val[dp_idkk]."'
				";
				
			}
			else
			{
				$sql = "
					SELECT
						k.pasien_id,
						kk.id,
						pel.jenis,
						NOW(),
						NOW(),
						'".$val[dp_pengirim]."',
						pel.jenis,
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
						JOIN kamar kmr ON (kmr.id = kk.kamar_id)
						JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					WHERE
						kk.id = '".$val[dp_idkk]."'
				";
			}
			
            $kon->sql = $sql;
            $kon->execute();
            
            //for($i=0;$i<sizeof($data);$i++) {
            	$sql = "
					SELECT 
						rk.id
					FROM 
						radio_kunjungan rk
					WHERE
						rk.kunjungan_kamar_id = '".$val[dp_idkk]."'
					";
				//$objResponse->addAssign("id_kunjungan_lab", "innerHTML", $data[no_rm]);
			
		 		$kon->sql = $sql;
				$kon->execute();
				//$objResponse->addAlert($sql);
				//$id_kunjungan_lab = $kon;
				//$dp_idkk = $val[dp_idkk];
				$data = $kon->getOne();
                //$objResponse->addAssign("dp_no_rm", "innerHTML", $data[no_rm]);
                $id_kunjungan_radio = $data[id];
                //$objResponse->addAlert($id_kunjungan_lab);
			//}
			
         	$objResponse->addScriptCall("tutup_daftar_penunjang");
         	$objResponse->addScriptCall("xajax_buka_kunjungan",$id_kunjungan_radio);
         	return $objResponse;
         	
      }
   }

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Kunjungan", "hapus_kunjungan_kamar_confirm"));

//daftar penunjang
$_xajax->registerFunction(array("buka_daftar_penunjang", "DaftarPenunjang", "buka_daftar_penunjang"));
$_xajax->registerFunction(array("daftar_penunjang", "DaftarPenunjang", "daftar_penunjang"));
$_xajax->registerFunction(array("ke_kunjungan", "DaftarPenunjang", "ke_kunjungan"));
$_xajax->registerFunction(array("tutup_daftar_penunjang", "DaftarPenunjang", "tutup_daftar_penunjang"));

include "kunjungan.modal.php";
include "langsung_bayar.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>