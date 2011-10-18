<?
$_TITLE = "Administrasi Data Dasar Rumah Sakit";
Class Aplikasi {
	function get_setting() {
		$kon = new Konek;
		$kon->sql = "SELECT * FROM setting";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();

		$objResponse->addAssign("app_name", "value", $data[app_name]);
		$objResponse->addAssign("app_name_pendek", "value", $data[app_name_pendek]);
		$objResponse->addAssign("app_version", "value", $data[app_version]);
		$objResponse->addAssign("owner_nama", "value", $data[owner_nama]);
		$objResponse->addAssign("owner_nama", "value", $data[owner_nama]);
		$objResponse->addAssign("rs_nama", "value", $data[rs_nama]);
		$objResponse->addAssign("rs_kode", "value", $data[rs_kode]);
		$objResponse->addAssign("rs_jenis", "value", $data[rs_jenis]);
		$objResponse->addAssign("rs_kelas", "value", $data[rs_kelas]);
		$objResponse->addAssign("rs_alamat", "value", $data[rs_alamat]);
		$objResponse->addAssign("rs_kabupaten", "value", $data[rs_kabupaten]);
		$objResponse->addAssign("rs_kode_pos", "value", $data[rs_kode_pos]);
		$objResponse->addAssign("rs_telp", "value", $data[rs_telp]);
		$objResponse->addAssign("rs_fax", "value", $data[rs_fax]);
		$objResponse->addAssign("rs_email", "value", $data[rs_email]);
		$objResponse->addAssign("rs_agama", "value", $data[rs_agama]);
		$objResponse->addAssign("dir_nama", "value", $data[dir_nama]);

		$objResponse->addAssign("si_nomor", "value", $data[si_nomor]);
		$objResponse->addAssign("si_tanggal", "value", $data[si_tanggal]);
		$objResponse->addAssign("si_oleh", "value", $data[si_oleh]);
		$objResponse->addAssign("si_sifat", "value", $data[si_sifat]);
		$objResponse->addAssign("si_berlaku_sampai", "value", $data[si_berlaku_sampai]);

		$objResponse->addAssign("milik_nama", "value", $data[milik_nama]);
		$objResponse->addAssign("milik_status", "value", $data[milik_status]);

		$objResponse->addAssign("akr_tahap", "value", $data[akr_tahap]);
		$objResponse->addAssign("akr_status", "value", $data[akr_status]);

		$objResponse->addAssign("cetak_header", "value", $data[cetak_header]);
		$objResponse->addAssign("cetak_tanda_tangan", "value", $data[cetak_tanda_tangan]);
		$objResponse->addAssign("cetak_footer", "value", $data[cetak_footer]);

		$objResponse->addScriptCall("fokus", "app_name");
		return $objResponse;
	}

	function simpan_setting($value) {
		$kon = new Konek;
		$kon->sql = "
			UPDATE 
				setting 
			SET 
				app_name = '".$value[app_name]."',
				app_name_pendek = '".$value[app_name_pendek]."',
				app_version = '".$value[app_version]."',
				owner_nama = '".$value[owner_nama]."',
				owner_nama = '".$value[owner_nama]."',

				rs_nama = '".$value[rs_nama]."',
				rs_kode = '".$value[rs_kode]."',
				rs_jenis = '".$value[rs_jenis]."',
				rs_kelas = '".$value[rs_kelas]."',
				rs_alamat = '".$value[rs_alamat]."',
				rs_kabupaten = '".$value[rs_kabupaten]."',
				rs_kode_pos = '".$value[rs_kode_pos]."',
				rs_telp = '".$value[rs_telp]."',
				rs_fax = '".$value[rs_fax]."',
				rs_email = '".$value[rs_email]."',
				rs_agama = '".$value[rs_agama]."',
				dir_nama = '".$value[dir_nama]."',

				si_nomor = '".$value[si_nomor]."',
				si_tanggal = '".$value[si_tanggal]."',
				si_oleh = '".$value[si_oleh]."',
				si_sifat = '".$value[si_sifat]."',
				si_berlaku_sampai = '".$value[si_berlaku_sampai]."',

				milik_nama = '".$value[milik_nama]."',
				milik_status = '".$value[milik_status]."',

				akr_tahap = '".$value[akr_tahap]."',
				akr_status = '".$value[akr_status]."',

				cetak_header = '".$value[cetak_header]."',
				cetak_tanda_tangan = '".$value[cetak_tanda_tangan]."',
				cetak_footer = '".$value[cetak_footer]."'
			WHERE 
				id=1

		";
		$kon->execute();
		$afek = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($afek < 0) {
			$objResponse->addAlert("Data Tidak Dapat Disimpan.\nHubungi Bagian SIM");
		} else {
			$kon->sql = "SELECT * FROM setting";
			$kon->execute();
			$_SESSION[setting] = $kon->getOne();
			
			$objResponse->addScriptCall("show_status_simpan");
			$objResponse->addScriptCall("xajax_get_setting");
		}
		$objResponse->addScriptCall("fokus", "app_name");
		return $objResponse;
	}

	function simpan_setting_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$new_value = $cleaner->getValue();
		
		$objResponse = new xajaxResponse();
		if(!$new_value[app_name])
			$objResponse->addAlert("Silakan Isi Nama Aplikasi.");
		else 
			$objResponse->addScriptCall("xajax_simpan_setting", $new_value);
		$objResponse->addScriptCall("fokus", "app_name");
		return $objResponse;
	}
}


//$_xajax->debugOn();
$_xajax->registerFunction(array("get_setting", "Aplikasi", "get_setting"));
$_xajax->registerFunction(array("hapus_setting", "Aplikasi", "hapus_setting"));
$_xajax->registerFunction(array("hapus_setting_confirm", "Aplikasi", "hapus_setting_confirm"));
$_xajax->registerFunction(array("simpan_setting", "Aplikasi", "simpan_setting"));
$_xajax->registerFunction(array("simpan_setting_check", "Aplikasi", "simpan_setting_check"));
$_xajax->registerFunction(array("reset_setting", "Aplikasi", "reset_setting"));


?>