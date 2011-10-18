<?
$_TITLE = "Daftar Kunjungan Ruang Tindakan";
Class Kunjungan {

	function list_data($hal=0, $val="") {
		if($_SESSION[pelayanan_id]) $s .= " AND pel.id = '" .$_SESSION[pelayanan_id]. "'";
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
				DATE(kk.tgl_periksa) BETWEEN '".$tgl_periksa_dari."' AND '".$tgl_periksa_sampai."'
				AND pel.jenis = 'RUANG TINDAKAN'
				$s
			ORDER BY 
				kk.id DESC
		";
		$paging->sql = $sql;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[rtindakan_kunjungan][hal] = $hal;

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
			"Kjg<br />Ke", 
			"Pelayanan", 
			"Tgl<br />Periksa",
			"Kjg<br />Sebelumnya"/*,
			"Daftar<br />Penunjang",
			/*,"Hapus"*/
		);
		//$table->addExtraTh("style=\"width:50px;\"","style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","","","","style=\"width:70px;\"");
		$table->addExtraTh(
			"style=\"width:50px;\"",
			"style=\"width:50px;\"",
			"style=\"width:80px;\"",
			"style=\"width:200px;\"",
			"",
			"",
			"",
			"style=\"width:80px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kunjungan_ke], 
				$data[$i][pelayanan], 
				tanggalIndo($data[$i][tgl_periksa], 'j M Y'), 
				"<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Kunjungan Sebelumnya\" onclick=\"xajax_buka_list_kunjungan('0','".$data[$i][pasien_id]."')\"><img src=\"".IMAGES_URL."kunjungan24.png\" alt=\"Kunjungan Sebelumnya\" border=\"0\" /></a>"/*, 
				"<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Daftar Penunjang\" onclick=\"buka_daftar_penunjang('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][kelas]."')\"><img src=\"".IMAGES_URL."edu_science.png\" alt=\"Daftar Penunjang\" border=\"0\" /></a>"
				,"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
				);
			$table->addOnclickTd(
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
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
/*
BIKIN SESSION HAK DAN SIFAT, AGAR NGIRIT MEMORI DI MODAL KUNJUNGAN
*/
		$kon = new Konek;
		$kon->sql = "SELECT id, nama FROM hak ORDER BY nama";
		$kon->execute();
		$_SESSION[rtindakan][hak] = $kon->getAll();

		$kon->sql = "SELECT * FROM sifat";
		$kon->execute();
		$_SESSION[rtindakan][sifat] = $kon->getAll();


		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}
}

Class Buka_List_Kunjungan_Sebelumnya {

	function buka_list_kunjungan($hal=0, $pasien_id) {
		$paging = new MyPagina;
		$paging->onclick_func = "xajax_buka_list_kunjungan";
		$paging->setOnclickValue("'".$pasien_id."'");
		$paging->rows_on_page = 5;
		$paging->hal = $hal;
		$sql = "
			SELECT 
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.nama as nama,
				p.sex as sex,
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				k.kunjungan_ke as kunjungan_ke,
				pel.jenis as jenis_pelayanan,
				pel.nama as pelayanan,
				kmr.nama as kamar,
				kk.tgl_periksa as tgl_periksa,
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
		$table->addTh(
			"No", 
			"Kunjungan Ke/<br />Tanggal Kunjung", 
			"Pemeriksaan"
		);	
		$table->addExtraTh(
			"style=\"width:30px;\"",
			"style=\"width:90px;\"",
			""
		);
		$kon = new Konek;
		for($i=0;$i<sizeof($data);$i++) {
		
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

		
			//get data bhp
			$kon->sql = "
				SELECT
					kkbhp.id as kunjungan_bhp_id,
					bhp.id as bhp_id,
					bhp.nama as bhp_nama
				FROM
					kunjungan_bayar kkbhp
					JOIN bhp ON (bhp.id = kkbhp.bhp_id)
				WHERE
					kkbhp.kunjungan_kamar_id = '".$data[$i][id_kunjungan_kamar]."'
				GROUP BY 
					kkbhp.id
			";
			$kon->execute();
			$data_bhp = $kon->getAll();
/*
			//get data im
			$kon->sql = "
				SELECT
					kki.id as kunjungan_imunisasi_id,
					im.id as imunisasi_id,
					im.nama as imunisasi_nama
				FROM
					kunjungan_kamar_imunisasi kki
					JOIN imunisasi im ON (im.id = kki.imunisasi_id)
				WHERE
					kki.kunjungan_kamar_id = '".$data[$i][id_kunjungan_kamar]."'
				GROUP BY
					kki.id
			";
			$kon->execute();
			$data_im = $kon->getAll();
			*/
			$pem = "<ul>";
			
			$pem .= "<li><b>Pelayanan :</b> " . $data[$i][jenis_pelayanan] . " - " . $data[$i][kamar] . "</li>";
			$pem .= "<li><b>Dokter :</b> " . (empty($data[$i][dokter])?"-":$data[$i][dokter]) . "</li>";
			$pem .= "<li><b>Diagnosa :</b> " . (empty($data[$i][diagnosa])?"-":"<br />".$data[$i][diagnosa]) . "</li>";
			$pem .= "<li><b>Tindakan :</b> ";
				if(!empty($data_ic)) {
					$pem .= "<ol>";
					for($j=0;$j<sizeof($data_ic);$j++) {
						$pem .= "<li>" . $data_ic[$j][tindakan_nama] . "</li>";
					}
					$pem .= "</ol>";
				} else $pem .= "-";
			$pem .= "</li>";
			$pem .= "<li><b>BHP :</b> ";
				if(!empty($data_bhp)) {
					$pem .= "<ol>";
					for($j=0;$j<sizeof($data_bhp);$j++) {
						$pem .= "<li>" . $data_bhp[$j][bhp_nama] . "</li>";
					}
					$pem .= "</ol>";
				} else $pem .= "-";
			$pem .= "</li>";
			/*
			$pem .= "<li><b>Imunisasi :</b> ";
				if(!empty($data_im)) {
					$pem .= "<ol>";
					for($j=0;$j<sizeof($data_im);$j++) {
						$pem .= "<li>" . $data_im[$j][imunisasi_nama] . "</li>";
					}
					$pem .= "</ol>";
				} else $pem .= "-";
			$pem .= "</li>";
			*/
			$pem .= "</ul>";
			$table->addRow(
				($no+$i), 
				$data[$i][kunjungan_ke] . "<hr />" . tanggalIndo($data[$i][tgl_periksa], 'j M Y'),
				$pem
				);
			/*
			$table->addOnclickTd(
				"xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
				"xajax_tab_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')"
			);
			*/
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $sql);
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

Class DaftarPenunjang {
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
				kmr.kelas,
				NOW(),
				NOW(),
				'".$val[dp_pengirim]."',
				'RAWAT INAP',
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
				kmr.kelas,
				NOW(),
				NOW(),
				'".$val[dp_pengirim]."',
				'RAWAT INAP',
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
		if($val[dp_vk] == "1") {
			$sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, (SELECT id FROM kamar WHERE nama = 'VK' AND kelas = '".$val[dp_kelas]."'), NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".$val[dp_idkk]."' "; 
			$kon->sql = $sql; $kon->execute(); 		
		}
		if($val[dp_anestesi] == "1") {
			$sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, (SELECT id FROM kamar WHERE nama = 'ANESTESI' AND kelas = '".$val[dp_kelas]."'), NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".$val[dp_idkk]."' "; 
			$kon->sql = $sql; $kon->execute(); 		
		}
		if($val[dp_roperasi] == "1") {
			$sql = "INSERT INTO kunjungan_kamar( parent_id, kunjungan_id, kamar_id, tgl_daftar, tgl_periksa, cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga ) SELECT id, kunjungan_id, (SELECT id FROM kamar WHERE nama = 'RUANG OPERASI' AND kelas = '".$val[dp_kelas]."'), NOW(), NOW(), cara_bayar, jenis_askes, perusahaan_id, nomor, pj_nama, pj_alamat, pj_telp, pj_hubungan_keluarga FROM kunjungan_kamar WHERE id = '".$val[dp_idkk]."' "; 
			$kon->sql = $sql; $kon->execute(); 		
		}
		//$objResponse->addAssign("debug", "innerHTML", nl2br($sql));
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("tutup_daftar_penunjang");
		return $objResponse;
	}
}

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Kunjungan", "hapus_kunjungan_kamar_confirm"));

//BLK
$_xajax->registerFunction(array("buka_list_kunjungan", "Buka_List_Kunjungan_Sebelumnya", "buka_list_kunjungan"));
$_xajax->registerFunction(array("tutup_list_kunjungan", "Buka_List_Kunjungan_Sebelumnya", "tutup_list_kunjungan"));

//PENUNJANG
$_xajax->registerFunction(array("buka_daftar_penunjang", "DaftarPenunjang", "buka_daftar_penunjang"));
$_xajax->registerFunction(array("daftar_penunjang", "DaftarPenunjang", "daftar_penunjang"));

include "kunjungan.modal.php";
//include "langsung_bayar.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>