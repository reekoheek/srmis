<?
$_TITLE = "Pindah Kamar Rawat Inap : Data Kunjungan";
Class Kunjungan {

	function list_data($hal=0, $semua_pasien = "0", $val="") {
		if($_SESSION[pelayanan_id]) $s = " AND pel.id = '" .$_SESSION[pelayanan_id]. "'";
		if($semua_pasien == "0") $s .= " AND kk.kelanjutan IS NULL";
		else {
			$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
			$s .= "AND DATE(kk.tgl_daftar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."'";
		}
		
		$paging = new MyPagina;
		$paging->setOnclickValue("'".$semua_pasien."'", "xajax.getFormValues('form_kunjungan')");
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
				kmr.kelas as kelas,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_keluar as tgl_keluar,
				d.nama as dokter,
				kk.kelanjutan as kelanjutan,
				rk.nomor as no_kamar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN ref_kamar rk ON (rk.id = kk.no_kamar)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				LEFT JOIN dokter d ON (d.id = kk.dokter_id)
			WHERE
				pel.jenis = 'RAWAT INAP' 
		 		$s
			ORDER BY 
				kmr.nama, d.nama, kk.no_antrian
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
		$table->tbody_height = 270;
		//$table->anime_bg_color = "";
		$table->addTh(
			"No", 
			"No.<br />Kjg",
			"No. RM", 
			"Pasien", 
			"Kamar", 
			"Dokter", 
			"Tgl<br />Masuk",
			"Tgl<br />Keluar",
			"Kelanjutan"
			/*,"Hapus"*/
		);
		$table->addExtraTh("style=\"width:30px;\"","style=\"width:30px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","","",""/*,"style=\"width:70px;\""*/);
		$kon = new Konek;
		for($i=0;$i<sizeof($data);$i++) {
			/*
				id kelanjutan == 'PINDAH KAMAR' adalah kelanjutan pindah kamar
				jika id kelanjutan == 'PINDAH KAMAR' maka diedit, jika diedit, maka harus membawa id child yang merupakan pindahan dari kamar tersebut
				jika id kelanjutan != 'PINDAH KAMAR' maka ditambah
			*/
			if($data[$i][kelanjutan] == "PINDAH KAMAR") {
				$table->addExtraTr();
				$table->extra_td[$i][] = "";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
				$table->extra_td[$i][] = "style=\"background-color:#dcdcdc\"";
			} else $table->addExtraTr();
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kamar], 
				$data[$i][dokter], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y') . "<br>" . tanggalIndo($data[$i][tgl_daftar], 'H:i'), 
				tanggalIndo($data[$i][tgl_keluar], 'j M Y') . "<br>" . tanggalIndo($data[$i][tgl_keluar], 'H:i'), 
				$data[$i][kelanjutan] 
				/*"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
			);
			if($data[$i][kelanjutan] == "PINDAH KAMAR") {
				//maka diedit
				/*
					mendapatkan kunjungan kamar setelah dipindah dengan parent id = id_kunjungan_kamar
					untuk diedit
				*/
				$kon->sql = "
					SELECT
						id
					FROM
						kunjungan_kamar
					WHERE
						parent_id = '".$data[$i][id_kunjungan_kamar]."'
				";
				$kon->execute();
				$stl_pindah = $kon->getOne();
				$table->addOnclickTd(
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')",
					"xajax_buka_edit_pindah_kamar('".$data[$i][id_kunjungan_kamar]."', '".$stl_pindah[id]."')"
				);

			} else {
				$table->addOnclickTd(
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')",
					"xajax_buka_daftar_pindah_kamar('".$data[$i][id_kunjungan_kamar]."')"
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

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Kunjungan", "hapus_kunjungan_kamar_confirm"));
$_xajax->registerFunction(array("buka_tbi", "Kunjungan", "buka_tbi"));

include "pindah_kamar.daftar_pindah_kamar.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>