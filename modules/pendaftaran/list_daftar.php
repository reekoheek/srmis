<?
$_TITLE = "List Pendaftaran : Data Kunjungan";
Class List_Daftar {

	function list_data($hal=0, $val="") {	  
	   $kon = new konek;
       	if($val[petugas_id]) {
			$q = " k.id_petugas = '".$val[petugas_id]."' ";
            $tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
			$q .= " AND DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."' ";
		} 
		//$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
		//$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
                   
		 $paging = new MyPagina;
         $kon = new Konek;
         $objResponse = new xajaxResponse();
         $paging->setOnclickValue("xajax.getFormValues('form_kunjungan')");
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
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					d.nama as dokter,
					kk.kelanjutan as kelanjutan
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					$q
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
			";
         $paging->sql = $sql;
         $paging->rows_on_page = 10;
         $paging->hal = $hal;
         $paging->get_page_result();

         $_SESSION[rajal][list_data] = $hal;

         $data = $paging->data;
         $no = $paging->start_number();
         $navi = $paging->navi();

         $table = new Table;
         $table->addTh("No", "No.<br />Kjg", "No. RM", "Pasien", "Kjg<br />Ke",
            "No<br />Antri", "Poliklinik", "Dokter", "Tgl<br />Periksa", "Kunjungan<br />Terakhir", "Kelanjutan",
            "Kjg<br />Sebelumnya", "Daftar<br />Penunjang", "Status Bayar" /*,"Hapus"*/ );
         $table->addExtraTh("style=\"width:50px;\"", "style=\"width:50px;\"", "style=\"width:80px;\"",
            "style=\"width:200px;\"", "", "", "", "", "", "", "", "", "", "style=\"width:80px;\"");
         for($i = 0; $i < sizeof($data); $i++) {
            //status bayar
            $kon->sql = "
                		SELECT
                				kb.nama as nama,
                				kb.bayar_bhp+kb.bayar_jasa as bayar,
                				kb.mampu_bayar_bhp+kb.mampu_bayar_jasa as mampu_bayar,
                				kwd.kwitansi_id as kwitansi_id,
                				kw.status as status
                			FROM
                				kunjungan_bayar kb
                				JOIN pelayanan pel ON (pel.id = kb.poli_id)
                				JOIN kunjungan_kamar kk ON (kk.id = kb.kunjungan_kamar_id)
                				LEFT JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
                                LEFT JOIN kwitansi kw ON  (kw.id = kwd.kwitansi_id)
                			WHERE
                				kb.poli_id IS NOT NULL
                				AND kk.kunjungan_id = '".$data[$i][kunjungan_id]."'
                			GROUP BY
                				kb.id
                			ORDER BY kb.id";            
        		$kon->execute();
        		$data_poli = $kon->getOne();
                if(!empty($data_poli)){
                    if (!empty($data_poli[status])){
                        $status_bayar = "<font color = blue><b>LUNAS</b></font>";
                    }    
                    else {
                        $status_bayar = "<font color = red><b>BELUM LUNAS</b></font>";                        
                    }        
                }else 
                {$status_bayar = "<font color = red><b>BELUM LUNAS</b></font>";}
                
            //$objResponse->addAlert($data_poli[status]);
			$kunj_terakhir = $data[$i][kunjungan_ke]-1;
			
			//untuk mendapatkan tgl_kunjungan_terakhir
			$sql_kunjungan = "select kk.tgl_daftar as tgl_daftar from kunjungan k,pasien p, kunjungan_kamar kk
                             where p.id = k.pasien_id 
                             and k.id = kk.kunjungan_id
                             and p.id = '".$data[$i][pasien_id]."'
                             and LAST_INSERT_ID(k.id) 
                             and k.kunjungan_ke ='".$kunj_terakhir."'
                             ORDER BY k.id DESC LIMIT 1";
            $kon->sql = $sql_kunjungan;
            $kon->execute();
            $k = $kon->getOne();
            
            if (empty($k[tgl_daftar])):
               $tgl_daftar = '-';
            else:
               $tgl_daftar = $k[tgl_daftar];
            endif;
			
            $table->addRow(($no + $i), $data[$i][id_kunjungan], $data[$i][no_rm], $data[$i][nama],
               $data[$i][kunjungan_ke], $data[$i][no_antrian], $data[$i][kamar], $data[$i][dokter],
               tanggalIndo($data[$i][tgl_periksa], 'j M Y'), $tgl_daftar, $data[$i][kelanjutan], "<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Kunjungan Sebelumnya\" onclick=\"xajax_buka_list_kunjungan('0','".
               $data[$i][pasien_id]."')\"><img src=\"".IMAGES_URL."kunjungan24.png\" alt=\"Kunjungan Sebelumnya\" border=\"0\" /></a>",
               "<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Daftar Penunjang\" onclick=\"buka_daftar_penunjang('".
               $data[$i][id_kunjungan_kamar]."')\"><img src=\"".IMAGES_URL."edu_science.png\" alt=\"Daftar Penunjang\" border=\"0\" /></a>",
               $status_bayar."");
               /*,
               * "<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Cetak Tindakan, BHP, dan Imunisasi\" onclick=\"xajax_buka_tbi('".$data[$i][id_kunjungan_kamar]."')\"><img src=\"".IMAGES_URL."pengobatan.png\" alt=\"Cetak Tindakan, BHP, dan Imunisasi\" border=\"0\" /></a>"
               * ,"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
            $table->addOnclickTd("xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar].
               "')", "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
               "xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')");
         }
         $ret = $table->build();
         
         /*
         * BIKIN SESSION HAK DAN SIFAT, AGAR NGIRIT MEMORI DI MODAL KUNJUNGAN
         */
         $kon = new Konek;
         $kon->sql = "SELECT id, nama FROM hak ORDER BY nama";
         $kon->execute();
         $_SESSION[rajal][hak] = $kon->getAll();

         $kon->sql = "SELECT * FROM sifat";
         $kon->execute();
         $_SESSION[rajal][sifat] = $kon->getAll();

         //$objResponse->addAssign("debug", "innerHTML", $sql);
         $objResponse->addAssign("navi", "innerHTML", $navi);
         $objResponse->addAssign("list_data", "innerHTML", $ret);
         return $objResponse;
	}

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
}    
$kon = new konek;
$kon->sql = "SELECT id,nama FROM petugas";
$kon->execute();
$data_petugas = $kon->getAll();


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "List_Daftar", "list_data"));
	
include AJAX_REF_DIR . "form.php";

?>