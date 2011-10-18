<?
Class InfoBar {
	
	function chat_kirim_pesan($val) {
		$kon = new Konek;
		$kon->sql = "
		INSERT INTO 
			pesan (pengirim_id, penerima_id, tgl_kirim, pesan) 
		VALUES (
			'".$_SESSION[pengguna_id]."', 
			NULLIF('".$val[chat_penerima_id]."',''), 
			NOW(), 
			'".$val[chat_pesan]."'
		)";
		$kon->execute();
		//hapus pesan lama
		$kon->sql = "DELETE FROM pesan LIMIT 1";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addClear("chat_pesan", "value");
		$objResponse->addScriptCall("chat_get_pesan", "yes");
		$objResponse->addScriptCall("fokus", "chat_pesan");
		return $objResponse;
	}

	function chat_kirim_pesan_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();

		$objResponse = new xajaxResponse;
		if(!$new_value[chat_pesan]) {
			$objResponse->addScriptCall('fokus', 'chat_pesan');
		} else {
			$objResponse->addScriptCall("xajax_chat_kirim_pesan", $new_value);
		}
		return $objResponse;
	}

	function chat_get_pesan($by_me = "no") {
		$arr_asal = array(	
		":kembang:",
		":melet:",
		":mesum:",
		":mlongo:",
		":mringis:",
		":nangis:",
		":nesu:",
		":ngakak:",
		":ngekek:",
		":ngguyu:",
		":ngikik:",
		":nyosor:",
		":sedih:",
		":setan:",
		":tresno:");

		$arr_smilies = array(
		"<img src='" . IMAGES_URL . "smilies/kembang.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/melet.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/mesum.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/mlongo.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/mringis.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/nangis.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/nesu.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/ngakak.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/ngekek.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/ngguyu.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/ngikik.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/nyosor.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/sedih.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/setan.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />",
		"<img src='" . IMAGES_URL . "smilies/tresno.gif' alt='' onclick='sendSmilies(this.src)'  border='0' />");

		$kon = new Konek;
		$kon->sql = "
			SELECT 
				p.nama as nama,
				CASE 
					WHEN (ps.penerima_id IS NULL) THEN 'Semua'
					ELSE '".$_SESSION[nama]."'
				END as penerima,
				DATE_FORMAT(ps.tgl_kirim, '%d/%m/%y %H:%i:%s') as tgl_kirim,
				ps.pesan as isi,
				MAX(ps.id) as max_id
			FROM
				pesan ps 
				JOIN pengguna p ON (p.id = ps.pengirim_id)
			WHERE
				ps.penerima_id IS NULL 
				OR 
				ps.penerima_id = '".$_SESSION[pengguna_id]."'
			GROUP BY
				ps.id
			ORDER BY
				ps.id DESC
			LIMIT 0,20
		";
		$kon->execute();
		$data = $kon->getAll();
		$ret = "<ol class=\"chat_list_pesan\">";
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][penerima] != "Semua") $bg = "#F8F9F5"; else $bg = "";
			$ret .= "<li style=\"background-color:".$bg."\"><i>" . $data[$i][tgl_kirim] . "</i><br />";
			$ret .= "<b>Dari</b>&nbsp;" . $data[$i][nama] . "<br />";
			$ret .= "<b>Untuk</b>&nbsp;" . $data[$i][penerima] . "<br />";
			$pesan = str_replace($arr_asal, $arr_smilies, $data[$i][isi]);
			$ret .= "<b>Pesan</b><br />" . nl2br($pesan) . "<br />";
			$ret .= "<hr /></li>";
		}
		$ret .= "</ol>";
		$objResponse = new xajaxResponse();

		for($i=0;$i<sizeof($arr_smilies);$i++) {
			$sml .= $arr_smilies[$i];
		}
		$max_id_curr = $_SESSION[chat][max_id];
		if($by_me == "no" && $max_id_curr != $data[0][max_id]) {
			$objResponse->addScriptCall("chat_ganti_button", "chat.png");
		}
		$_SESSION[chat][max_id] = $data[0][max_id];
		$objResponse->addAssign("chat_smilies", "innerHTML", $sml);
		$objResponse->addAssign("chat_list_pesan", "innerHTML", $ret);
		return $objResponse;
	}

	function info_get_jml_pasien() {
		$kon = new Konek;
		$kon->sql = "
			SELECT
				kmr.id as id,
				kmr.nama as nama,
                p.nama as nama_pasien,
				CASE 
					WHEN (kk.dokter_id IS NULL) THEN 'Dokter Lain'
					ELSE d.nama
				END as dokter,
				COUNT(kk.id) as jml
			FROM
				kamar kmr
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN kunjungan_kamar kk ON (kk.kamar_id = kmr.id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
                LEFT JOIN kunjungan k ON (k.id=kk.kunjungan_id)
                LEFT JOIN pasien p ON (p.id=k.pasien_id)
			WHERE
				pel.jenis = '".$_SESSION['status']."'
				AND DATE(kk.tgl_periksa) = DATE(NOW())
			GROUP BY
				kmr.id, d.id
			ORDER BY
				kmr.nama, d.nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse;
		for($i=0;$i<sizeof($data);$i++) {
			$ret .= "<li>";
			if($data[$i][id] != $data[$i-1][id]) {
				if($i!=0) $ret .= "<br />";
				$ret .= "<b>" . $data[$i][nama_pasien] . "</b>";
				$ret .= "<br />";
				$ret .= " -- <i>" . $data[$i][dokter]."</i>";
			//	$ret .= " : ... ".$data[$i][jml];
			} else {
				$ret .= " - " . $data[$i][nama_pasien];
				//$ret .= " : ... ".$data[$i][jml];
			}
			$ret .= "</li>";
			$total += $data[$i][jml];
		}
		$ret .= "<li><hr /></li>";
		$ret .= "<li>TOTAL : ".$total." px</li>";
		$objResponse->addAssign("infobar_tgl", "innerHTML", "&mdash; " . tanggalIndo(date("Y-m-d"), "l, j F Y") . " &mdash;");
		$objResponse->addAssign("infobar_jml_pasien", "innerHTML", $ret);
		return $objResponse;
	}
/*
	function info_get_kamar_kosong() {
		$kon = new Konek;
		$sql = "
			SELECT
				pel.id as id,
				pel.nama as nama,
				SUM(kmr.jml_bed) as jml_bed
			FROM
				pelayanan pel
				JOIN kamar kmr ON (kmr.pelayanan_id = pel.id)
			WHERE 
				pel.jenis = 'RAWAT INAP'
			GROUP BY
				pel.id
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();
		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->addTh("Bangsal", "TT", "Isi", "Kosong");
		for($i=0;$i<sizeof($data);$i++) {
			$kon->sql = "
			SELECT 
				COUNT(kk.id) as terisi
			FROM 
				kunjungan_kamar kk
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
			WHERE 
				kmr.pelayanan_id = '".$data[$i][id]."'
				AND kk.kelanjutan IS NULL
			GROUP BY 
				kmr.pelayanan_id
			";
			$kon->execute();
			$isi = $kon->getOne();
			$kosong = $data[$i][jml_bed] - $isi[terisi];
			$tabel->addRow(
				$data[$i][nama],
				$data[$i][jml_bed],
				empty($isi[terisi])?"0":$isi[terisi],
				$kosong
			);
		}
		$ret = $tabel->build();
		$objResponse = new xajaxResponse;
		//$objResponse->addAssign('debug', 'innerHTML', $sql);
		$objResponse->addAssign("infobar_bangsal", "innerHTML", $ret);
		return $objResponse;
	}
*/
	function infobar_cari_px_cari($objId, $val) {
		$kon = new Konek;
		$objResponse = new xajaxResponse;
        
        if ($_SESSION['status']=="RAWAT INAP") :
		$sql = "
			SELECT
				p.nama as nama,
				CONCAT(p.alamat, ', ', d.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				kmr.nama as ruang,
				CASE 
					WHEN kk.tgl_keluar IS NULL THEN 'Masih Dirawat'
				ELSE 'Sudah Pulang'
				END as status
			FROM
				pasien p
				JOIN kunjungan k ON (k.pasien_id = p.id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN ref_desa d ON (d.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = d.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
			WHERE
				p.nama LIKE '%".$val."%' 
				AND pel.jenis = 'RAWAT INAP'
				AND (kk.tgl_keluar IS NULL OR DATE(kk.tgl_keluar) = DATE(NOW()))
			ORDER BY p.nama
		";   
            $kon->sql = $sql;
    		$kon->execute();
    		$data = $kon->getAll();
    		$table = new Table;
    		$table->scroll = false;
    		$table->addTh("Nama", "Alamat", "Ruang", "Status");
    		for($i=0;$i<sizeof($data);$i++) {
    			$table->addRow($data[$i][nama], $data[$i][alamat], $data[$i][ruang], $data[$i][status]);
    		}     
        else :    
        
        $sql ="	SELECT
				kmr.id as id,
				kmr.nama as nama,
                p.nama as nama_pasien,
                CONCAT(p.alamat, ', ', d.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				CASE 
					WHEN (kk.dokter_id IS NULL) THEN 'Dokter Lain'
					ELSE d.nama
				END as dokter,
				COUNT(kk.id) as jml
			FROM
			    kamar kmr
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN kunjungan_kamar kk ON (kk.kamar_id = kmr.id)			    
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
                LEFT JOIN kunjungan k ON (k.id=kk.kunjungan_id)
                LEFT JOIN pasien p ON (p.id=k.pasien_id)
                LEFT JOIN ref_desa ds ON (ds.id = p.desa_id)
				LEFT JOIN ref_kecamatan kec ON (kec.id = ds.kecamatan_id)
				LEFT JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)       
			WHERE
                p.nama LIKE '%".$val."%'
				AND pel.jenis = '".$_SESSION['status']."'
				AND DATE(kk.tgl_periksa) = DATE(NOW())
			GROUP BY
				kmr.id, d.id
			ORDER BY
				kmr.nama, d.nama";    
                
                
            $kon->sql = $sql;
    		$kon->execute();
           
    		$data = $kon->getAll();
    		$table = new Table;
    		$table->scroll = false;
    		$table->addTh("Nama", "Alamat", "Pelayanan","Dokter");
    		for($i=0;$i<sizeof($data);$i++) {
    			$table->addRow($data[$i][nama_pasien], $data[$i][alamat], $data[$i][nama] ,$data[$i][dokter]);
    		}            
        endif;
	
		$ret = $table->build();
		$objResponse->addAssign($objId, "innerHTML", $ret);
		return $objResponse;
	}

}
$kon = new Konek;
$kon->sql = "SELECT id, nama FROM pengguna WHERE aktif = '1' AND id <> '".$_SESSION[pengguna_id]."' ORDER BY nama";
$kon->execute();
$_chat_pengguna = $kon->getAll();
$_xajax->registerFunction(array("chat_kirim_pesan", "InfoBar", "chat_kirim_pesan"));
$_xajax->registerFunction(array("chat_kirim_pesan_check", "InfoBar", "chat_kirim_pesan_check"));
$_xajax->registerFunction(array("chat_get_pesan", "InfoBar", "chat_get_pesan"));
$_xajax->registerFunction(array("info_get_jml_pasien", "InfoBar", "info_get_jml_pasien"));
//$_xajax->registerFunction(array("info_get_kamar_kosong", "InfoBar", "info_get_kamar_kosong"));
$_xajax->registerFunction(array("infobar_cari_px_cari", "InfoBar", "infobar_cari_px_cari"));
?>