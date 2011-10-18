<?
$_TITLE = "Pemulangan Pasien";
Class Pemulangan_Pasien {

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
				kk.parent_id as parent_id,
				k.kunjungan_ke as kunjungan_ke,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				pel.nama as pelayanan,
				kmr.nama as kamar,
				kmr.kelas as kelas,
				kk.tgl_daftar as tgl_daftar,
				kk.tgl_periksa as tgl_periksa,
				kk.tgl_keluar as tgl_keluar,
				d.nama as dokter,
				kk.kelanjutan as kelanjutan,
				CASE WHEN (kk.tgl_keluar IS NULL) THEN DATEDIFF(DATE(NOW()), kk.tgl_daftar)
				ELSE DATEDIFF(kk.tgl_keluar, kk.tgl_daftar) END as lama_dirawat
				
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
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
		$paging->rows_on_page = 10;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[hal] = $hal;

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
			"Kamar", 
			"Dokter", 
			"Tgl<br />Masuk",
			"Tgl<br />Keluar",
			"Lama<br />Dirawat<br />(hari)",
			"Kelanjutan"
			/*,"Hapus"*/
		);
		$table->addExtraTh(
			"style=\"width:50px;\"",
			"style=\"width:50px;\"",
			"style=\"width:80px;\"",
			"style=\"width:200px;\"",
			"",
			"",
			"",
			"",
			"",
			"",
			""
			/*,"style=\"width:70px;\""*/
		);
		$x = 0;
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][lama_dirawat] == 0) $lama_dirawat = 1;
			else $lama_dirawat = $data[$i][lama_dirawat];
			$table->addRow(
				($no+$i), 
				$data[$i][id_kunjungan], 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kunjungan_ke], 
				$data[$i][kamar], 
				$data[$i][dokter], 
				tanggalIndo($data[$i][tgl_daftar], 'j M Y') . "<br>" . tanggalIndo($data[$i][tgl_daftar], 'H:i'), 
				tanggalIndo($data[$i][tgl_keluar], 'j M Y') . "<br>" . tanggalIndo($data[$i][tgl_keluar], 'H:i'), 
				$lama_dirawat, 
				$data[$i][kelanjutan]
				/*,"<input type=\"button\" value=\"[  x  ]\" name=\"hapus\" class=\"inputan\" onclick=\"xajax_hapus_kunjungan_kamar_confirm('".$data[$i][id_kunjungan]."','".$data[$i][id_kunjungan_kamar]."', this)\" />"*/
				);
			$table->addOnclickTd(
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')",
				"xajax_buka_kunjungan('".$data[$i][id_kunjungan_kamar]."', '".$data[$i][parent_id]."')"
			);
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
	function buka_tbi($idkk) {
		unset($_SESSION[ranap][kunjungan][jasa_cetak]);
		$kon = new Konek;
		//$kon->debug = 1;
		$objResponse = new xajaxResponse;
		//get data pasien
		$kon->sql = "
			SELECT
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				p.nama as nama,
				p.tgl_lahir as tgl_lahir,
				CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT(' RT ', p.rt)), IF(p.rw = '','',CONCAT(' RW ', p.rw)), ', ', des.nama, ', ', kec.nama, ', ', kab.nama) as alamat,
				kk.tgl_periksa as tgl_periksa,
				pel.nama as nama_pelayanan,
				p.sex as jk,
				kk.cara_bayar as cara_bayar,
				kk.jenis_askes as jenis_askes, 
				kk.nomor as nomor
			FROM
				kunjungan_kamar kk
				JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
			WHERE
				kk.id = '".$idkk."'
			GROUP BY
				p.id
		";
		$kon->execute();
		$data_pasien = $kon->getOne();
		$arr_usia = hitungUmur($data_pasien[tgl_lahir], $data_pasien[tgl_periksa]);
		$usia = empty($arr_usia[tahun])?"":$arr_usia[tahun] . " thn ";
		$usia .= empty($arr_usia[bulan])?"":$arr_usia[bulan] . " bln ";
		$usia .= empty($arr_usia[hari])?"":$arr_usia[hari] . " hr ";

		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->css_table = "";
		$tabel->cellspacing = "5";
		$tabel->anime_bg_color = "";
		$tabel->extra_table = "style=\"width:10cm;\"";
		$tabel->addRow("Bangsal", $data_pasien[nama_pelayanan]);
		$tabel->addExtraTd("style=\"width:3cm\"");
		$tabel->addRow("No. RM", $data_pasien[id_display]);
		$tabel->addRow("Nama", $data_pasien[nama]);
		$tabel->addRow("Usia", $usia);
		$tabel->addRow("Jenis Kelamin", $data_pasien[jk]);
		$tabel->addRow("Alamat", $data_pasien[alamat]);
		$tabel->addRow("Tgl Periksa", tanggalIndo($data_pasien[tgl_periksa], 'j F Y'));
		$tabel->addRow("Cara Pembayaran", $data_pasien[cara_bayar]);
		$tabel->addRow("Jenis Askes", empty($data_pasien[jenis_askes])?"-":$data_pasien[jenis_askes]);
		$tabel->addRow("Nomor", empty($data_pasien[nomor])?"-":$data_pasien[nomor]);
		$tabel_pasien = $tabel->build();
		
		$tabel = new Table;
		$tabel->scroll = false;
		$tabel->extra_table = "style=\"width:10cm;\"";
		$tabel->addTh("No", "Jasa", "Harga");
		$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6.5cm;\"", "");
		//get data tindakan
		$kon->sql = "
			SELECT
				CONCAT(i.kode, ' - ', i.nama) as nama
			FROM
				icopim i 
				JOIN kunjungan_kamar_icopim kki ON (kki.icopim_id = i.id)
				JOIN kunjungan_kamar kk ON (kk.id = kki.kunjungan_kamar_id)
			WHERE
				kk.id = '".$idkk."'
			GROUP BY
				kki.id
		";
		$kon->execute();
		$data_tindakan = $kon->getAll();
		if(!empty($data_tindakan)) {
			$tabel->addRow("","<b>Tindakan</b>","");
			for($i=0;$i<sizeof($data_tindakan);$i++) {
				$tabel->addRow(
					($i+1),
					" - " . $data_tindakan[$i][nama],
					""
				);
			}
		}


		//get data bhp
		$kon->sql = "
			SELECT
				b.nama as nama
			FROM
				bhp b 
				JOIN kunjungan_kamar_bhp kkb ON (kkb.bhp_id = b.id)
				JOIN kunjungan_kamar kk ON (kk.id = kkb.kunjungan_kamar_id)
			WHERE
				kk.id = '".$idkk."'
			GROUP BY
				kkb.id
		";
		$kon->execute();
		$data_bhp = $kon->getAll();
		if(!empty($data_bhp)) {
			$tabel->addRow("","<b>Bahan Habis Pakai</b>","");
			for($i=0;$i<sizeof($data_bhp);$i++) {
				$tabel->addRow(
					($i+1),
					" - " . $data_bhp[$i][nama],
					""
				);
			}
		}

		//get data imunisasi
		$kon->sql = "
			SELECT
				im.nama as nama
			FROM
				imunisasi im 
				JOIN kunjungan_kamar_imunisasi kkim ON (kkim.imunisasi_id = im.id)
				JOIN kunjungan_kamar kk ON (kk.id = kkim.kunjungan_kamar_id)
			WHERE
				kk.id = '".$idkk."'
			GROUP BY
				kkim.id
		";
		$kon->execute();
		$data_imunisasi = $kon->getAll();
		if(!empty($data_imunisasi)) {
			$tabel->addRow("","<b>Imunisasi</b>","");
			for($i=0;$i<sizeof($data_imunisasi);$i++) {
				$tabel->addRow(
					($i+1),
					" - " . $data_imunisasi[$i][nama],
					""
				);
			}
		}
		$tabel->addRow("","<b>Total</b>","");
		$tabel_jasa = $tabel->build();

		$modal = new Modal;
		$modal->cetak_lebar = 400;
		$modal->cetak_tinggi = 600;
		$modal->setTitle("Daftar Pemberian Tindakan, BHP, dan Imunisasi");
		$modal->setContent($tabel_pasien);
		$modal->setContent($tabel_jasa);
		$modal->setCloseButtonOnclick("tutup_daftar_tbi()");
		$modal->setPrintButtonUrl(URL . "ranap/kunjungan_jasa_cetak/");
		$modal_cnt = $modal->build();
		$_SESSION[ranap][kunjungan][jasa_cetak] = $tabel_pasien . $tabel_jasa;
		$objResponse->addClear("list_daftar_tbi", "style.display");
		$objResponse->addAssign("list_daftar_tbi", "innerHTML", $modal_cnt);
		return $objResponse;
	}
}

//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Pemulangan_Pasien", "list_data"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar", "Pemulangan_Pasien", "hapus_kunjungan_kamar"));
$_xajax->registerFunction(array("hapus_kunjungan_kamar_confirm", "Pemulangan_Pasien", "hapus_kunjungan_kamar_confirm"));
$_xajax->registerFunction(array("buka_tbi", "Pemulangan_Pasien", "buka_tbi"));

include "pemulangan.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>