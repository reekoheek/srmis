<?
$_TITLE = "Pendaftaran Rawat Inap : Data Kunjungan";
Class Kunjungan {

	function list_data($hal=0, $val="") {	  
	   $kon = new konek;
       	if($val[pasien_id]) {
			$q = " p.no_rm = '".$val[pasien_id]."' ";
		} elseif($val[nama]) {
			$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl]; 
			$q = " p.nama LIKE '%".$val[nama]."%' AND DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."' ";
		} elseif ($val[pilih]){
			$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
			$q = " DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."' ";
        }elseif ($val[telp]){
            $q = " p.telp LIKE '%".$val[telp]."%' ";
		}
		//$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
		//$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
		$paging = new MyPagina;
		$paging->setOnclickValue("xajax.getFormValues('form_kunjungan')");
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				k.kunjungan_ke as kunjungan_ke,
				kk.no_antrian as no_antrian,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				pel.nama as pelayanan,
				kmr.nama as kamar,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				d.nama as dokter,
				kk.kelanjutan as kelanjutan,
				pel.jenis as jenis
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
				k.id DESC, kk.id ASC
		";
		$paging->sql = $sql;
		$paging->rows_on_page = 20;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[hal] = $hal;

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 310;
		$table->anime_bg_color = "";
		$table->addTh(
			"No", 
			"No.<br />Kjg",
			"No. RM", 
			"Pasien", 
			"Kjg<br />Ke", 
			"No<br />Antri", 
			"Pelayanan", 
			"Dokter", 
			"Tgl<br />Daftar",
			"Tgl<br />Periksa",
            "Kunjungan <br/>Terakhir",
			"Kelanjutan",
			"Hapus"
		);
		$table->addExtraTh("style=\"width:30px;\"","style=\"width:30px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","","","","","style=\"width:70px;\"");
		for($i=0;$i<sizeof($data);$i++) {
		     $kunj_sbl = $data[$i][kunjungan_ke]-1 ; 
            $sql_kunjungan = "select kk.tgl_daftar as tgl_daftar from kunjungan k,pasien p, kunjungan_kamar kk
                             where p.id = k.pasien_id 
                             and k.id = kk.kunjungan_id
                             and p.id = '".$data[$i][pasien_id]."'
                             and LAST_INSERT_ID(k.id) 
                             and k.kunjungan_ke ='".$kunj_sbl."'
                             ORDER BY k.id DESC LIMIT 1";
            $kon->sql = $sql_kunjungan;
            $kon->execute();
            $k = $kon->getOne();
            
            if (empty($k[tgl_daftar])):
               $tgl_daftar = '-';
            else:
               $tgl_daftar = $k[tgl_daftar];
            endif;
            
			if($data[$i][jenis] == 'RAWAT INAP') {
				$table->addExtraTr("style=\"background-color:#dcdcdc\"");
			} else $table->addExtraTr();
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kunjungan_ke], 
				$data[$i][no_antrian], 
				$data[$i][kamar], 
				$data[$i][dokter], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y'), 
				tanggalIndo($data[$i][tgl_periksa], 'j M Y'), 
                $tgl_daftar,
				$data[$i][kelanjutan], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_kunjungan_kamar('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");
			if($data[$i][jenis] == 'RAWAT INAP') {
				//jika rawat inap, maka diedit
				$table->addOnclickTd(
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')",
					"xajax_buka_edit_ranap('".$data[$i][id_kunjungan_kamar]."', '".$data[$i-1][id_kunjungan_kamar]."')"
				);

			} elseif($data[$i][kelanjutan] == "DIRAWAT" && $data[$i][pasien_id] == $data[$i+1][pasien_id] && $data[$i+1][jenis] == 'RAWAT INAP') {
				$table->addOnclickTd(
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')",
					"alert('Pasien sudah mendaftar rawat inap')"
				);
			} else {
				$table->addOnclickTd(
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_ranap('".$data[$i][id_kunjungan_kamar]."')"
				);
			}
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
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

$kon = new Konek;
$kon->sql = "SELECT * FROM pelayanan WHERE jenis = 'RAWAT INAP' ORDER BY nama";
$kon->execute();
$_data_pel = $kon->getAll();

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));
	
include "ranap.daftar_ranap.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>