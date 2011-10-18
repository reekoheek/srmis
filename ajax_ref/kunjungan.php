<?
Class Ref_Kunjungan {

	function get_pelayanan($inputId, $jenis, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				id, 
				nama
			FROM 
				pelayanan
			WHERE
				jenis = '".$jenis."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_pelayanan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_pelayanan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		return $objResponse;
	}

	function get_kamar($inputId, $pelayanan_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				id, 
				nama
			FROM 
				kamar
			WHERE
				pelayanan_id = '".$pelayanan_id."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "0");
		$objResponse->addScript("addOption('".$inputId."','','--- PILIH ---','',false,true);");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
			{
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			}
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		return $objResponse;
	}

    function get_info_no_kamar($inputId, $pelayanan_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
        $kon->sql = " 
        SELECT 
				rf.id, 
				rf.nomor
			FROM 
				kamar k, ref_kamar rf, pelayanan p
			WHERE
				k.pelayanan_id = '".$pelayanan_id."'
                and p.id = k.pelayanan_id
                and k.id = rf.kamar_id
                and rf.status <> 1 
			ORDER BY
				rf.nomor
		";
	
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "0");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_no_kamar_".$data[$i][id]."','".$data[$i][nomor]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_no_kamar_".$data[$i][id]."','".$data[$i][nomor]."','".$data[$i][id]."',false,false);");
		}
		return $objResponse;
	}
    function get_no_kamar($inputId, $kamar_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				id, 
				nomor
			FROM 
				ref_kamar
			WHERE
				kamar_id = '".$kamar_id."'
                and status <> 1
			ORDER BY
				nomor
		";
     /* $kon->sql = " 
        SELECT 
				rf.id, 
				rf.nomor
			FROM 
				kamar k, ref_kamar rf, pelayanan p
			WHERE
				k.pelayanan_id = '".$pelayanan_id."'
                and rf.kamar_id ='".$kamar_id."'
                and p.id = k.pelayanan_id
                and k.id = rf.kamar_id
                and rf.status <> 1 
			ORDER BY
				rf.nomor
		";*/
	
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "0");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_no_kamar_".$data[$i][id]."','".$data[$i][nomor]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_no_kamar_".$data[$i][id]."','".$data[$i][nomor]."','".$data[$i][id]."',false,false);");
		}
		return $objResponse;
	}

	function get_perujuk($inputId, $cara_masuk_id, $id_sel = NULL, $add_perujuk = false) {
		$objResponse = new xajaxResponse();
		if($cara_masuk_id == "RUJUKAN") {
			$kon = new Konek;
			$kon->sql = "
				SELECT 
					id, 
					nama
				FROM 
					ref_perujuk
				ORDER BY
					nama
			";
			$kon->execute();
			$data = $kon->getAll();	
			$objResponse->addAssign($inputId, "options.length", "1");
			for($i=0;$i<sizeof($data);$i++) {
				if($data[$i][id] == $id_sel)
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_perujuk_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
				else
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_perujuk_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
			if($add_perujuk == true)
				$objResponse->addScript("addOption('".$inputId."','add_perujuk','--- TAMBAH PERUJUK ---','add_perujuk');");
		} else {
			$objResponse->addAssign($inputId, "options.length", "1");
			$objResponse->addScript("addOption('".$inputId."','".$inputId."_bukan_rujukan','Bukan Pasien Rujukan','',false,true);");
		}
		return $objResponse;
	}


	function add_perujuk_check($nama, $alamat) {
		$objResponse = new xajaxResponse();
		$nama = addslashes($nama);
		$alamat = addslashes($alamat);
		$kon = new Konek;
		$kon->sql = "
			SELECT
				id,
				nama,
				alamat
			FROM 
				ref_perujuk
			WHERE 
				TRIM(LOWER(nama)) = TRIM(LOWER('".$nama."')) 
			";
		$kon->execute();
		$data = $kon->getOne();
		if($data[id]) {
			$objResponse->addConfirmCommands(2, "Nama Perujuk\n " . $nama . "\n mirip dengan Perujuk\n" . $data[nama] . "\n dengan Alamat " . $data[alamat] . "\nKlik Ok untuk menambah perujuk baru\n Klik Cancel untuk menggunakan perujuk yang telah ada");
			$objResponse->addScriptCall("xajax_ref_add_perujuk", $nama, $alamat);
			$objResponse->addScriptCall("fokus", "perujuk_id");
			$objResponse->addAssign("perujuk_id", "value", $data[id]);
			$objResponse->addScriptCall("fokus", "perujuk_id");
		} else {
			$objResponse->addScriptCall("xajax_ref_add_perujuk", $nama, $alamat);
			$objResponse->addScriptCall("fokus", "perujuk_id");
		}
		return $objResponse;
	}

	function add_perujuk($nama, $alamat) {
		$kon = new Konek;
		$kon->sql = "
			INSERT INTO ref_perujuk(
				nama, 
				alamat
			)
			VALUES(
				'".$nama."',
				'".$alamat."'
			)
			";
		$kon->execute();
		$last_id = $kon->last_id;
		$objResponse = new xajaxResponse();
		$objResponse->addScript("addOption('perujuk_id','perujuk_".$last_id."','".$nama."','".$last_id."', false, true);");
		return $objResponse;
	}

	function get_dokter($inputId, $pelayanan_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				d.id as id, 
				d.nama as nama
			FROM 
				dokter d 
				JOIN subspesialisasi sub ON (sub.id = d.subspesialisasi_id)
				JOIN spesialisasi spc ON (spc.id = sub.spesialisasi_id)
				JOIN pelayanan pel ON (pel.spesialisasi_id = spc.id)
			WHERE
				d.aktif = '1'
				AND pel.id = '".$pelayanan_id."'
			ORDER BY
				d.nama
		";
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_dokter_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_dokter_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		//$objResponse->addScript("addOption('".$inputId."','".$inputId."_tidak_ada_dokter','Dokter Lain','',false,false);");
		return $objResponse;
	}

	function get_dokter_from_kamar($inputId, $kamar_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				d.id as id, 
				d.nama as nama
			FROM 
				dokter d 
				JOIN subspesialisasi sub ON (sub.id = d.subspesialisasi_id)
				JOIN spesialisasi spc ON (spc.id = sub.spesialisasi_id)
				JOIN pelayanan pel ON (pel.spesialisasi_id = spc.id)
				JOIN kamar kmr ON (kmr.pelayanan_id = pel.id)
			WHERE
				d.aktif = '1'
				AND kmr.id = '".$kamar_id."'
			ORDER BY
				d.nama
		";
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_dokter_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_dokter_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		//$objResponse->addScript("addOption('".$inputId."','".$inputId."_tidak_ada_dokter','Dokter Lain','',false,false);");
		return $objResponse;
	}

	function get_info_jadwal_dokter($inputId, $kamar_id, $tgl, $bln, $thn, $dokterInputId = "dokter_id") {
		$objResponse = new xajaxResponse();
		if(!$kamar_id) {
			$ret = "Klinik belum dipilih";
		} else {
			$hari = date("l", mktime(1, 1, 1, $bln, $tgl, $thn));
			$nama_hari = tanggalIndo($thn . "-" . $bln . "-" . $tgl, "l");
			
			$kon = new Konek;
			$sql = "
				SELECT 
					d.id as id,
					d.nama as nama, 
					CONCAT('&nbsp;&nbsp;&nbsp;:&nbsp;',DATE_FORMAT(j.jam_mulai, '%H:%i'), ' - ', DATE_FORMAT(j.jam_selesai, '%H:%i')) as jadwal
				FROM
					jadwal_dokter j 
					JOIN dokter d ON (d.id = j.dokter_id)
					JOIN pelayanan pel ON (pel.id = j.pelayanan_id)
					JOIN kamar kmr ON (kmr.pelayanan_id = pel.id)
				WHERE
					d.aktif = '1'
					AND kmr.id = '".$kamar_id."'
					AND j.hari = '".$hari."'
				GROUP BY
					j.id
				ORDER BY
					j.jam_mulai, d.nama
			";
			$kon->sql = $sql;
			$kon->execute();
			$data = $kon->getAll();
			if(!empty($data)) {
				$ret = "Jadwal dokter hari " . $nama_hari . " :";
				$ret .= "<ol>";
				for($i=0;$i<sizeof($data);$i++) {
					$ret .= "<li style=\"margin-bottom:5px;\">";
					if($dokterInputId) {
						$ret .= "<a href=\"javascript:void(0)\" title=\"pilih dokter ini\" onclick=\"javascript:document.getElementById('".$dokterInputId."').value='".$data[$i][id]."';javascript:fokus('".$dokterInputId."')\">" . $data[$i][nama] . "<em><b>" . $data[$i][jadwal] . "</b></em></a>";
					} else {
						$ret .= $data[$i][nama] . "<em><b>" . $data[$i][jadwal] . "</b></em>";
					}
					$ret .= "</li>";
				}
				$ret .= "</ol>";
			} else {
				$ret = "Tidak Ada jadwal dokter pada hari " . $nama_hari;
			}
		}
		$objResponse->addAssign($inputId, "innerHTML", $ret);
		return $objResponse;
	}

	function get_subspesialisasi($inputId, $spesialisasi_id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "
			SELECT 
				sub.id as id, 
				sub.nama as nama
			FROM 
				subspesialisasi sub
				JOIN spesialisasi spc ON (spc.id = sub.spesialisasi_id)
			WHERE
				spc.id = '".$spesialisasi_id."'
			ORDER BY
				sub.nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		$objResponse->addScript("addOption('".$inputId."','".$inputId."_tidak_ada_sub','Tidak Ada Sub Spesialisasi','',false,false);");
		return $objResponse;
	}

	function get_jenis_askes($inputId, $cara_bayar, $sel = NULL) {
		$objResponse = new xajaxResponse;
		$data = array('Askes Alba','Askes Blue','Askes Diamond','Askes Gold','Askes Platinum','Askes Silver','Askes Kin','Askes Sosial');
		$objResponse->addAssign($inputId, "options.length", "1");
		if($cara_bayar == "ASURANSI") {
			$objResponse->addScriptCall("setBgColor2", $inputId, '#EEEEEE');
			for($i=0;$i<sizeof($data);$i++) {
				if($data[$i] == $sel) {
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i]."','".$data[$i]."','".$data[$i]."',false,true);");
				} else {
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i]."','".$data[$i]."','".$data[$i]."',false,false);");
				}
			}
		} else {
			$objResponse->addScript("addOption('".$inputId."','".$inputId."_bukan_askes','Bukan Pasien Askes','',false,true);");
			$objResponse->addScriptCall("setBgColor2", $inputId, '#F8F9F5');
		}
		return $objResponse;
	}

	function get_perusahaan($inputId, $cara_bayar, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$arr = array('PERUSAHAAN', 'KARYAWAN', 'KONTRAK');
		$objResponse->addAssign($inputId, "options.length", "1");
		if(in_array($cara_bayar, $arr)) {
			$objResponse->addScriptCall("setBgColor2", $inputId, '#EEEEEE');
			$kon = new Konek;
			$kon->sql = "
				SELECT 
					id as id, 
					nama as nama
				FROM 
					ref_perusahaan
				ORDER BY
					nama
			";
			$kon->execute();
			$data = $kon->getAll();

			for($i=0;$i<sizeof($data);$i++) {
				if($data[$i][id] == $id_sel) {
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
				} else {
					$objResponse->addScript("addOption('".$inputId."','".$inputId."_sub_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
				}
			}
		} else {
			$objResponse->addScript("addOption('".$inputId."','".$inputId."_bukan','Tidak Dijamin Perusahaan','',false,true);");
			$objResponse->addScriptCall("setBgColor2", $inputId, '#F8F9F5');
		}
		return $objResponse;
	}
	
	
	function get_status($inputId, $input_keadaan_keluar, $id_sel = NULL) {
		$objResponse = new xajaxResponse();	
		$objResponse->addAssign($inputId, "options.length", "1");		
			if ($input_keadaan_keluar == 'DIRAWAT' || $input_keadaan_keluar == 'DIRUJUK')
			{
				
				$objResponse->addScript("addOption('".$inputId."','','BELUM SEMBUH','BELUM SEMBUH',false,true);");
				$objResponse->addScript("addOption('".$inputId."','','SEMBUH','SEMBUH',false,false);");
				$objResponse->addScript("addOption('".$inputId."','','MATI < 48 JAM','MATI < 48 JAM',false,false);");
				$objResponse->addScript("addOption('".$inputId."','','MATI > 48 JAM','MATI > 48 JAM',false,false);");
			}
			elseif ($input_keadaan_keluar == 'PULANG') 
			{
				$objResponse->addScript("addOption('".$inputId."','','BELUM SEMBUH','BELUM SEMBUH',false,false);");
				$objResponse->addScript("addOption('".$inputId."','','SEMBUH','SEMBUH',false,true);");
				$objResponse->addScript("addOption('".$inputId."','','MATI < 48 JAM','MATI < 48 JAM',false,false);");
				$objResponse->addScript("addOption('".$inputId."','','MATI > 48 JAM','MATI > 48 JAM',false,false);");
			}
			/*elseif ($input_keadaan_keluar == 'DIRUJUK') 
			{
					$kon = new Konek;
					$kon->sql = "
						SELECT 
							nama
						FROM 
							pelayanan
						WHERE
							nama_lain IS NULL
						ORDER BY
							nama 
					";
					$kon->execute();
					$data = $kon->getAll();
					for($i=0;$i<sizeof($data);$i++) {
						if($data[$i][id] == $id_sel)
							$objResponse->addScript("addOption('".$inputId."','".$inputId."_namar_".$data[$i][nama]."','".$data[$i][nama]."','".$data[$i][nama]."',false,false);");
						else
							$objResponse->addScript("addOption('".$inputId."','".$inputId."_nama_".$data[$i][nama]."','".$data[$i][nama]."','".$data[$i][nama]."',false,true);");
			}
		}*/
			return $objResponse;
		}
		
		function get_status_poli($inputId, $input_poli, $id_sel = NULL) {
		$objResponse = new xajaxResponse();	
		$objResponse->addAssign($inputId, "options.length", "1");		
					$kon = new Konek;
					$kon->sql = "
						SELECT 
							id,nama
						FROM 
							pelayanan
						WHERE
							nama_lain IS NULL
						ORDER BY
							nama 
					";
					$kon->execute();
					$data = $kon->getAll();
					for($i=0;$i<sizeof($data);$i++) {
						if($data[$i][id] == $id_sel)
							$objResponse->addScript("addOption('".$inputId."','".$inputId."_namar_".$data[$i][nama]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
						else
							$objResponse->addScript("addOption('".$inputId."','".$inputId."_nama_".$data[$i][nama]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			}
			return $objResponse;
		}
		
}
$_xajax->registerFunction(array("ref_get_pelayanan", "Ref_Kunjungan", "get_pelayanan"));
$_xajax->registerFunction(array("ref_get_perujuk", "Ref_Kunjungan", "get_perujuk"));
$_xajax->registerFunction(array("ref_add_perujuk_check", "Ref_Kunjungan", "add_perujuk_check"));
$_xajax->registerFunction(array("ref_add_perujuk", "Ref_Kunjungan", "add_perujuk"));
$_xajax->registerFunction(array("ref_get_kamar", "Ref_Kunjungan", "get_kamar"));
$_xajax->registerFunction(array("ref_get_no_kamar", "Ref_Kunjungan", "get_no_kamar"));
$_xajax->registerFunction(array("ref_get_info_no_kamar", "Ref_Kunjungan", "get_info_no_kamar"));
$_xajax->registerFunction(array("ref_get_dokter", "Ref_Kunjungan", "get_dokter"));
$_xajax->registerFunction(array("ref_get_dokter_from_kamar", "Ref_Kunjungan", "get_dokter_from_kamar"));
$_xajax->registerFunction(array("ref_get_info_jadwal_dokter", "Ref_Kunjungan", "get_info_jadwal_dokter"));
$_xajax->registerFunction(array("ref_get_subspesialisasi", "Ref_Kunjungan", "get_subspesialisasi"));
$_xajax->registerFunction(array("ref_get_jenis_askes", "Ref_Kunjungan", "get_jenis_askes"));
$_xajax->registerFunction(array("ref_get_perusahaan", "Ref_Kunjungan", "get_perusahaan"));
$_xajax->registerFunction(array("ref_get_status", "Ref_Kunjungan", "get_status"));
$_xajax->registerFunction(array("ref_get_status_poli", "Ref_Kunjungan", "get_status_poli"));
?>