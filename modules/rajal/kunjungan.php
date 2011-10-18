<?

   $_TITLE = "Daftar Kunjungan";
   class Kunjungan {
      function list_data($hal = 0, $val = "") {
        //if($_SESSION[pelayanan_id]) $s .= " AND pel.id = '".$_SESSION[pelayanan_id]."'";
         //		$tgl_periksa_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
         //		$tgl_periksa_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
       	if($val[pasien_id]) {
			$s = " AND p.id = '".$val[pasien_id]."'";
		} elseif($val[nama]) {
			$tgl_daftar_dari = $val[tgl_mulai_thn] ."-". $val[tgl_mulai_bln] ."-". $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] ."-". $val[tgl_selesai_bln] ."-". $val[tgl_selesai_tgl];
			$s = " AND p.nama LIKE '%".$val[nama]."%' AND DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."'";
		} elseif ($val[pilih]){
			$tgl_daftar_dari = $val[tgl_mulai_thn] ."-". $val[tgl_mulai_bln] ."-". $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] ."-". $val[tgl_selesai_bln] ."-". $val[tgl_selesai_tgl];
			$s = " AND DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."'";
		}elseif($tgl_lahir){
			if ($val[tgl_lahir_thn] == "" && $val[tgl_lahir_bln] == "" && $val[tgl_lahir_tgl] == ""){
				$tgl_lahir = "";
				}
			else {
				$tgl_lahir = $val[tgl_lahir_thn] . "-" . $val[tgl_lahir_bln] . "-" . $val[tgl_lahir_tgl];   
				$s .= " AND DATE(p.tgl_lahir) = '".$tgl_lahir."' AND DATE(kk.tgl_daftar) = now()"; 
		/*}elseif($tgl_lahir){
			$s = " AND DATE(p.tgl_lahir) = '".$tgl_lahir."'";*/
        }
		}elseif ($val[telp]){
            $s = " AND p.telp LIKE '%".$val[telp]."%'";
		}else{
			$s = " AND pel.id = '" .$_SESSION[pelayanan_id]. "'";
		}
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
					kk.status_periksa as periksa,
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.id as pasien_id,
					p.nama as nama,
					pel.nama as pelayanan,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
					k.resep as resep,
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
					pel.jenis = 'RAWAT JALAN' and kk.kelanjutan is null
			 		$s
				ORDER BY
					kmr.nama, d.nama, kk.no_antrian
			";
         $paging->sql = $sql;
         $temp=$sql;
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
            "Kjg<br />Sebelumnya", "Daftar<br />Penunjang", "Diberi<br />Resep", "Status<br />Periksa", "Status Bayar" /*,"Hapus"*/ );
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
			
			
		if($data[$i][periksa]=='1'){
				$stat_periksa="SUDAH";
				}else{
				$stat_periksa="BELUM";
				} 
				
				//$stat_periksa=$data[$i][periksa];
            
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
			   $data[$i][resep],
			   $stat_periksa,
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

         //$objResponse->addAssign("debug", "innerHTML", $s);
         $objResponse->addAssign("navi", "innerHTML", $navi);
         $objResponse->addAssign("list_data", "innerHTML", $ret);
         return $objResponse;
      }
      

      /*
      * function hapus_kunjungan_kamar($kunjungan_id, $kunjungan_kamar_id) {
      * $kon = new Konek;
      * //jika row kunjungan_kamar = 1, hapus kunjungan juga
      * $kon->sql = "SELECT COUNT(*) as jml FROM kunjungan_kamar WHERE kunjungan_id = '".$kunjungan_id."'";
      * $kon->execute();
      * $data = $kon->getOne();
      * if($data[jml] > 1) {
      * $kon->sql = "DELETE FROM kunjungan_kamar WHERE id = '".$kunjungan_kamar_id."'";
      * } else {
      * $kon->sql = "DELETE FROM kunjungan WHERE id = '".$kunjungan_id."'";
      * }
      * $kon->execute();
      * $ret = $kon->affected_rows;
      * $objResponse = new xajaxResponse();
      * if($ret<0) {
      * $objResponse->addAlert("Data Tidak Dapat Dihapus.");
      * } else {
      * $objResponse->addScriptCall("list_data", $_SESSION[rajal][list_data]);
      * $objResponse->addScriptCall("fokus");
      * }
      * return $objResponse;
      * }
      *
      * function hapus_kunjungan_kamar_confirm($kunjungan_id, $kunjungan_kamar_id, $obj) {
      * $objResponse = new xajaxResponse();
      * $objResponse->addConfirmCommands(1, "Yakin akan menghapus data kunjungan ini?");
      * $objResponse->addScriptCall("xajax_hapus_kunjungan_kamar", $kunjungan_id, $kunjungan_kamar_id);
      * return $objResponse;
      * }
      */
      /*
      * function buka_tbi($idkk) {
      * unset($_SESSION[rajal][kunjungan][jasa_cetak]);
      * $kon = new Konek;
      * //$kon->debug = 1;
      * $objResponse = new xajaxResponse;
      * //get data pasien
      * $kon->sql = "
      * SELECT
      * CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
      * p.nama as nama,
      * p.tgl_lahir as tgl_lahir,
      * CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
      * kk.tgl_periksa as tgl_periksa,
      * pel.nama as nama_pelayanan,
      * p.sex as jk,
      * kk.cara_bayar as cara_bayar,
      * kk.jenis_askes as jenis_askes,
      * kk.nomor as nomor
      * FROM
      * kunjungan_kamar kk
      * JOIN kunjungan k ON (k.id = kk.kunjungan_id)
      * JOIN pasien p ON (p.id = k.pasien_id)
      * JOIN kamar kmr ON (kmr.id = kk.kamar_id)
      * JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
      * JOIN ref_desa des ON (des.id = p.desa_id)
      * JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
      * JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
      * JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
      * WHERE
      * kk.id = '".$idkk."'
      * GROUP BY
      * p.id
      * ";
      * $kon->execute();
      * $data_pasien = $kon->getOne();
      * $arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
      * $usia = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
      * $usia .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
      * $usia .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";
      *
      * $tabel = new Table;
      * $tabel->scroll = false;
      * $tabel->css_table = "";
      * $tabel->cellspacing = "5";
      * $tabel->anime_bg_color = "";
      * $tabel->extra_table = "style=\"width:10cm;\"";
      * $tabel->addRow("Poliklinik", $data_pasien[nama_pelayanan]);
      * $tabel->addExtraTd("style=\"width:3cm\"");
      * $tabel->addRow("No. RM", $data_pasien[id_display]);
      * $tabel->addRow("Nama", $data_pasien[nama]);
      * $tabel->addRow("Usia", $usia);
      * $tabel->addRow("Jenis Kelamin", $data_pasien[jk]);
      * $tabel->addRow("Alamat", $data_pasien[alamat]);
      * $tabel->addRow("Tgl Periksa", tanggalIndo($data_pasien[tgl_periksa], 'j F Y'));
      * $tabel->addRow("Cara Pembayaran", $data_pasien[cara_bayar]);
      * $tabel->addRow("Jenis Askes", empty($data_pasien[jenis_askes])?"-":$data_pasien[jenis_askes]);
      * $tabel->addRow("Nomor", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);
      * $tabel_pasien = $tabel->build();
      *
      * $tabel = new Table;
      * $tabel->scroll = false;
      * $tabel->extra_table = "style=\"width:10cm;\"";
      * $tabel->addTh("No", "Jasa", "Harga");
      * $tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "");
      * //get data tindakan
      * $kon->sql = "
      * SELECT
      * CONCAT(i.kode, ' - ', i.nama) as nama
      * FROM
      * icopim i
      * JOIN kunjungan_kamar_icopim kki ON (kki.icopim_id = i.id)
      * JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
      * WHERE
      * kk.id = '".$idkk."'
      * GROUP BY
      * kki.id
      * ";
      * $kon->execute();
      * $data_tindakan = $kon->getAll();
      * if(!empty($data_tindakan)) {
      * $tabel->addRow("","<b>Tindakan</b>","");
      * for($i=0;$i<sizeof($data_tindakan);$i++) {
      * $tabel->addRow(
      * ($i+1),
      * " - " . $data_tindakan[$i][nama],
      * ""
      * );
      * }
      * }
      *
      *
      * //get data bhp
      * $kon->sql = "
      * SELECT
      * b.nama as nama
      * FROM
      * bhp b
      * JOIN kunjungan_kamar_bhp kkb ON (kkb.bhp_id = b.id)
      * JOIN kunjungan_kamar kk ON (kk.id = kkb.kunjungan_kamar_id)
      * WHERE
      * kk.id = '".$idkk."'
      * GROUP BY
      * kkb.id
      * ";
      * $kon->execute();
      * $data_bhp = $kon->getAll();
      * if(!empty($data_bhp)) {
      * $tabel->addRow("","<b>Bahan Habis Pakai</b>","");
      * for($i=0;$i<sizeof($data_bhp);$i++) {
      * $tabel->addRow(
      * ($i+1),
      * " - " . $data_bhp[$i][nama],
      * ""
      * );
      * }
      * }
      *
      * //get data imunisasi
      * $kon->sql = "
      * SELECT
      * im.nama as nama
      * FROM
      * imunisasi im
      * JOIN kunjungan_kamar_imunisasi kkim ON (kkim.imunisasi_id = im.id)
      * JOIN kunjungan_kamar kk ON (kk.id = kkim.kunjungan_kamar_id)
      * WHERE
      * kk.id = '".$idkk."'
      * GROUP BY
      * kkim.id
      * ";
      * $kon->execute();
      * $data_imunisasi = $kon->getAll();
      * if(!empty($data_imunisasi)) {
      * $tabel->addRow("","<b>Imunisasi</b>","");
      * for($i=0;$i<sizeof($data_imunisasi);$i++) {
      * $tabel->addRow(
      * ($i+1),
      * " - " . $data_imunisasi[$i][nama],
      * ""
      * );
      * }
      * }
      * $tabel->addRow("","<b>Total</b>","");
      * $tabel_jasa = $tabel->build();
      *
      * $modal = new Modal;
      * $modal->cetak_lebar = 400;
      * $modal->cetak_tinggi = 600;
      * $modal->setTitle("Daftar Pemberian Tindakan, BHP, dan Imunisasi");
      * $modal->setContent($tabel_pasien);
      * $modal->setContent($tabel_jasa);
      * $modal->setCloseButtonOnclick("tutup_daftar_tbi()");
      * $modal->setPrintButtonUrl(URL . "rajal/kunjungan_jasa_cetak/");
      * $modal_cnt = $modal->build();
      * $_SESSION[rajal][kunjungan][jasa_cetak] = $tabel_pasien . $tabel_jasa;
      * $objResponse->addClear("list_daftar_tbi", "style.display");
      * $objResponse->addAssign("list_daftar_tbi", "innerHTML", $modal_cnt);
      * return $objResponse;
      * }*/
   }

   class Buka_List_Kunjungan_Sebelumnya {

      function buka_list_kunjungan($hal = 0, $pasien_id) {
         $paging = new MyPagina;
         $paging->onclick_func = "xajax_buka_list_kunjungan";
         $paging->setOnclickValue("'".$pasien_id."'");
         $paging->rows_on_page = 5;
         $paging->hal = $hal;
         $sql = "
				SELECT
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.nama as nama,
                    p.id as pasien_id,
					p.sex as sex,
					k.id as id_kunjungan,
					kk.id as id_kunjungan_kamar,
					k.kunjungan_ke as kunjungan_ke,
					pel.jenis as jenis_pelayanan,
					pel.nama as pelayanan,
					kmr.nama as kamar,
					kk.tgl_periksa as tgl_periksa,
                    kk.tgl_daftar as tgl_daftar,
					CONCAT(i.kode_icd,' - ', i.nama) as diagnosa,
					d.nama as dokter
				FROM
					kunjungan k
					JOIN pasien p ON (p.id = k.pasien_id)
					JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
					JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
					LEFT JOIN icd i ON (i.id = kk.diagnosa_utama_id)
					LEFT JOIN dokter d ON (d.id = kk.dokter_id)
				WHERE
					p.id = '".$pasien_id."'
				GROUP BY
					kk.id
				ORDER BY
					kk.id
			";
         $paging->sql = $sql;
         $paging->get_page_result();

         $data = $paging->data;
         $no = $paging->start_number();
         $navi = $paging->navi();

         $table = new Table;
         $table->tbody_height = 300;
         $table->addTh("No", "Kunjungan Ke/<br />Tanggal Kunjung", "Pemeriksaan");
         $table->addExtraTh("style=\"width:30px;\"", "style=\"width:90px;\"", "");
         $kon = new Konek;
         for($i = 0; $i < sizeof($data); $i++) {

            //get data tindakan
            $kon->sql = "
					SELECT
						kkic.id as kunjungan_tindakan_id,
						ic.id as tindakan_id,
						ic.nama as tindakan_nama
					FROM
						kunjungan_kamar_icopim kkic
						JOIN icopim ic ON (ic.id = kkic.icopim_id)
					WHERE
						kkic.kunjungan_kamar_id = '".$data[$i][id_kunjungan_kamar]."'
					GROUP BY
						kkic.id
				";
            $kon->execute();
            $data_ic = $kon->getAll();
            //bln/tgl/thn
            $temp_tgl ="";
            $temp_tgl = explode('/',DATE($data[$i][tgl_periksa]));
            $tgl_obat =$temp_tgl[2].$temp_tgl[0].$temp_tgl[1];
            
            $kon->sql = "SELECT db_apotek.ms_barang.nama as nama,db_apotek.resep_head.no_resep as no_resep 
                         FROM db_apotek.resep,db_apotek.resep_head,simrs.pasien,db_apotek.ms_barang 
                         WHERE db_apotek.resep.no_resep = db_apotek.resep_head.no_resep 
                         AND simrs.pasien.id = db_apotek.resep_head.pasien_id 
                         AND db_apotek.ms_barang.kd_barang = resep.kode_obat
                          AND DATE(db_apotek.resep_head.created_datetime)='".$tgl_obat."'
                         AND db_apotek.resep.pasien_id='".$data[$i][pasien_id]."'";
                         
            $kon->execute();
			$data_bhp = $kon->getAll();             
            
            //get data bhp
            //get obat
			/*$kon->sql = "
				SELECT
					kkbhp.id as kunjungan_bhp_id,
					kkbhp.bhp_id as bhp_id,
					db_apotek.ms_barang.nama as bhp_nama,
                    db_apotek.ms_barang.stok,
                    kkbhp.no_resep as resep
				FROM
					kunjungan_bayar kkbhp,
					db_apotek.ms_barang
				WHERE
					kkbhp.kunjungan_kamar_id = '".$data[$i][id_kunjungan_kamar]."'
                    and kkbhp.bhp_id = db_apotek.ms_barang.id
				GROUP BY 
					kkbhp.id
			";
			$kon->execute();
			$data_bhp = $kon->getAll();*/
            
            
            //get data specimen
    		$kon->sql = "
    			SELECT
    				kb.nama as nama
    			FROM
    				kunjungan_bayar kb
    				JOIN lab_kunjungan lk ON (lk.id = kb.lab_kunjungan_id)
    				JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)				
    			WHERE
    				kb.lab_specimen_id IS NOT NULL
                   	AND kk.id = '".$data[$i][id_kunjungan_kamar]."'
    			GROUP BY
    				kb.id
    			ORDER BY kb.id
    		";
    		$kon->execute();
    		$data_s = $kon->getAll();
    	
            	//get data radio	
        
            $kon->sql = "
			SELECT
				kb.nama as nama
			FROM
				kunjungan_bayar kb
				JOIN radio_kunjungan lk ON (lk.id = kb.radio_kunjungan_id)
                JOIN kunjungan_kamar kk ON (kk.id = lk.kunjungan_kamar_id)				
			WHERE
				kb.radio_pemeriksaan_id IS NOT NULL               
				AND kk.id = '".$data[$i][id_kunjungan_kamar]."'
			GROUP BY
				kb.id
			ORDER BY kb.id
		";
        
		$kon->execute();
		$data_radio = $kon->getAll();
            /*
            * //get data im
            * $kon->sql = "
            * SELECT
            * kki.id as kunjungan_imunisasi_id,
            * im.id as imunisasi_id,
            * im.nama as imunisasi_nama
            * FROM
            * kunjungan_kamar_imunisasi kki
            * JOIN imunisasi im ON (im.id = kki.imunisasi_id)
            * WHERE
            * kki.kunjungan_kamar_id = '".$data[$i][id_kunjungan_kamar]."'
            * GROUP BY
            * kki.id
            * ";
            * $kon->execute();
            * $data_im = $kon->getAll();
            */
            $pem = "<ul>";

            $pem .= "<li><b>Pelayanan :</b> ".$data[$i][jenis_pelayanan]." - ".$data[$i][kamar].
               "</li>";
            $pem .= "<li><b>Dokter :</b> ".(empty($data[$i][dokter])?"-":$data[$i][dokter]).
               "</li>";
            $pem .= "<li><b>Diagnosa :</b> ".(empty($data[$i][diagnosa])?"-":"<br />".$data[$i][diagnosa]).
               "</li>";
            $pem .= "<li><b>Tindakan :</b> ";
            if(!empty($data_ic)) {
               $pem .= "<ol>";
               for($j = 0; $j < sizeof($data_ic); $j++) {
                  $pem .= "<li>".$data_ic[$j][tindakan_nama]."</li>";
               }
               $pem .= "</ol>";
            } else $pem .= "-";
            $pem .= "</li>";
            
            $pem .= "<li><b>BHP (OBAT):</b> ";
            if(!empty($data_bhp)) {
               $pem .= "<ol>";
               for($j = 0; $j < sizeof($data_bhp); $j++) {
                  $pem .= "<li>".$data_bhp[$j][no_resep]." ".$data_bhp[$j][nama]."</li>";
               }
               $pem .= "</ol>";
            } else $pem .= "-";
            $pem .= "</li>";
            
            $pem .= "<li><b>Laboratorium:</b> ";
              if(!empty($data_s)) {
               $pem .= "<ol>";
               for($j = 0; $j < sizeof($data_s); $j++) {
                  $pem .= "<li>".$data_s[$j][nama]."</li>";
               }
               $pem .= "</ol>";
            } else $pem .= "-";
            $pem .= "</li>";
            
            $pem .= "<li><b>Radiologi</b> ";
              if(!empty($data_s)) {
               $pem .= "<ol>";
               for($j = 0; $j < sizeof($data_radio); $j++) {
                  $pem .= "<li>".$data_radio[$j][nama]."</li>";
               }
               $pem .= "</ol>";
            } else $pem .= "-";
            $pem .= "</li>";
            /*
            * $pem .= "<li><b>Imunisasi :</b> ";
            * if(!empty($data_im)) {
            * $pem .= "<ol>";
            * for($j=0;$j<sizeof($data_im);$j++) {
            * $pem .= "<li>" . $data_im[$j][imunisasi_nama] . "</li>";
            * }
            * $pem .= "</ol>";
            * } else $pem .= "-";
            * $pem .= "</li>";
            */
            $pem .= "</ul>";
            $table->addRow(($no + $i), $data[$i][kunjungan_ke]."<hr />".tanggalIndo($data[$i][tgl_periksa],
               'j M Y'), $pem);
            /*
            * $table->addOnclickTd(
            * "xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
            * "xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
            * "xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')"
            * );
            */
         }
         $ret = $table->build();
         $objResponse = new xajaxResponse();
         $objResponse->addAssign("debug", "innerHTML", $tgl_obat);
         $objResponse->addAssign("modal_list_kunjungan", "style.display", "");
         $objResponse->addAssign("tab_list_semua_kunjungan_navi", "innerHTML", $navi);
         $objResponse->addAssign("mlk_no_rm", "innerHTML", $data[0][no_rm]);
         $objResponse->addAssign("mlk_nama", "innerHTML", $data[0][nama]);
         $objResponse->addAssign("mlk_sex", "innerHTML", $data[0][sex]);
         $objResponse->addAssign("tab_list_semua_kunjungan", "innerHTML", $ret);
         $objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
         return $objResponse;
      }

      function tutup_list_kunjungan() {
         $objResponse = new xajaxResponse;
         $objResponse->addAssign("modal_list_kunjungan", "style.display", "none");
         $objResponse->addClear("tab_list_semua_kunjungan_navi", "innerHTML");
         $objResponse->addClear("tab_list_semua_kunjungan", "innerHTML");
         $objResponse->addScriptCall("enable_mainbar");
         return $objResponse;
      }

   }

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
         if($val[dp_lab] == "1") {
            $sql = "
					INSERT INTO lab_kunjungan(
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
         }
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
         if($val[dp_vk] == "1") {
            $sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, '62', NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".
               $val[dp_idkk]."' ";
            $kon->sql = $sql;
            $kon->execute();
         }
         if($val[dp_anestesi] == "1") {
            $sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, '82', NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".
               $val[dp_idkk]."' ";
            $kon->sql = $sql;
            $kon->execute();
         }
         if($val[dp_roperasi] == "1") {
            $sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, '72', NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".
               $val[dp_idkk]."' ";
            $kon->sql = $sql;
            $kon->execute();
         }
         //$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
         $objResponse->addScriptCall("show_status_simpan");
         $objResponse->addScriptCall("tutup_daftar_penunjang");
         return $objResponse;
      }
   }
   
   
   //Class Kunjungan
   $_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
   $_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan",
      "hapus_kunjungan_kamar"));
   $_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Kunjungan",
      "hapus_kunjungan_kamar_confirm"));
   $_xajax->registerFunction(array("buka_tbi", "Kunjungan", "buka_tbi"));
   //BLK
   $_xajax->registerFunction(array("buka_list_kunjungan",
      "Buka_List_Kunjungan_Sebelumnya", "buka_list_kunjungan"));
   $_xajax->registerFunction(array("tutup_list_kunjungan",
      "Buka_List_Kunjungan_Sebelumnya", "tutup_list_kunjungan"));

   //PENUNJANG
   $_xajax->registerFunction(array("buka_daftar_penunjang", "DaftarPenunjang",
      "buka_daftar_penunjang"));
   $_xajax->registerFunction(array("daftar_penunjang", "DaftarPenunjang",
      "daftar_penunjang"));

   include "kunjungan.modal.php";
   include "langsung_bayar.modal.php";
   include AJAX_REF_DIR."kunjungan.php";
   include AJAX_REF_DIR."form.php";
?>