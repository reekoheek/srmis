<?
$_TITLE = "Sewa Kendaraan : Daftar Pasien yang berkunjung ke Rumah Sakit";
Class Kunjungan {

	function list_data($hal=0, $val="") {
		$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
		$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
		$paging = new MyPagina;
		$paging->setOnclickValue("xajax.getFormValues('form_kunjungan')");
		$sql = "
			(SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				k.kunjungan_ke as kunjungan_ke,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				CASE 
					WHEN pel.jenis = 'IGD' THEN 'IRD'
					ELSE CONCAT_WS(' - ', pel.jenis, kmr.nama) 
				END as kamar,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_keluar as tgl_keluar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
			WHERE
				DATE(kk.tgl_keluar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."')
			UNION
			(SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				k.kunjungan_ke as kunjungan_ke,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				CONCAT_WS(' - ', pel.jenis, kmr.nama) as kamar,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_keluar as tgl_keluar
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
			WHERE
				pel.jenis = 'RAWAT INAP'
				AND (DATE(kk.tgl_keluar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."' OR kk.tgl_keluar IS NULL)
			ORDER BY 
				kk.id DESC)
		";
		$paging->sql = $sql;
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[igd_kunjungan][hal] = $hal;

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
			"Tgl<br />Masuk",
			"Tgl<br />Keluar",
			"Pelayanan",
			"Kjg<br />Sebelumnya",
			"Lsg<br />Bayar"
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
			"",
			"style=\"width:80px;\"",
			"style=\"width:80px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kunjungan_ke], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y'), 
				tanggalIndo($data[$i][tgl_keluar], 'j M Y'), 
				$data[$i][kamar], 
				"<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Kunjungan Sebelumnya\" onclick=\"xajax_buka_list_kunjungan('0','".$data[$i][pasien_id]."')\"><img src=\"".IMAGES_URL."kunjungan24.png\" alt=\"Kunjungan Sebelumnya\" border=\"0\" /></a>", 
				"<a href=\"javascript:void(0)\" style=\"display:block;\" title=\"Langsung Bayar\" onclick=\"xajax_buka_langsung_bayar('".$data[$i][id_kunjungan_kamar]."')\"><img src=\"".IMAGES_URL."uang.png\" alt=\"Langsung Bayar\" border=\"0\" /></a>"
				/*,"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
				);
			$table->addOnclickTd(
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."')",
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
		$_SESSION[igd][hak] = $kon->getAll();

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

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Kunjungan", "hapus_kunjungan_kamar"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Kunjungan", "hapus_kunjungan_kamar_confirm"));

//BLK
$_xajax->registerFunction(array("buka_list_kunjungan", "Buka_List_Kunjungan_Sebelumnya", "buka_list_kunjungan"));
$_xajax->registerFunction(array("tutup_list_kunjungan", "Buka_List_Kunjungan_Sebelumnya", "tutup_list_kunjungan"));

include "kendaraan.modal.php";
include "kendaraan_langsung_bayar.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>