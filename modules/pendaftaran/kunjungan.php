<?
$_TITLE = "Ubah Data Pendaftaran Pasien IRD";
Class Kunjungan {

	function list_data($hal=0, $val="") {
		if($val[jenis]) $s .= " AND pel.jenis = '" .$val[jenis]. "'";
		if($val[pelayanan_id]) $s .= " AND pel.id = '" .$val[pelayanan_id]. "'";
		$tgl_periksa_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
		$tgl_periksa_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
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
				pel.jenis as jenis_pelayanan,
				pel.nama as pelayanan,
				kmr.nama as kamar,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				kk.tgl_keluar as tgl_keluar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
			WHERE
				DATE(kk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
				AND pel.jenis = 'IGD' 
				$s
			ORDER BY 
				k.id DESC, kk.id ASC
		";
		$paging->sql = $sql;
		$paging->rows_on_page = 20;
		$paging->hal = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 300;
		$table->addTh(
			"No", 
			"No.<br />Kjg",
			"No. RM", 
			"Pasien", 
			"Tgl<br />Daftar",
			"Tgl<br />Keluar",
			"Hapus"
		);
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:400px;\"","","","style=\"width:70px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y') . "<br />" . tanggalIndo($data[$i][tgl_daftar], 'H:i'), 
				tanggalIndo($data[$i][tgl_keluar], 'j M Y') . "<br />" . tanggalIndo($data[$i][tgl_keluar], 'H:i'), 
				"<a href=\"javascript:void(0)\" title=\"Hapus Kunjungan\" onclick=\"hapus_kunjungan_kamar('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus Kunjungan\" border=\"0\" /></a>");
			$table->addOnclickTd(
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')"
			);
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
			$objResponse->addScriptCall("list_data");
			$objResponse->addScriptCall("fokus", "jenis");
		}
		return $objResponse;
	}

}
//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));

include "kunjungan.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>