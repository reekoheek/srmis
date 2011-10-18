<?
$_TITLE = "Administrasi Data User";
Class Pengguna {

	function list_data($hal = 0) {
		$paging = new MyPagina;
		$paging->rows_on_page = 20;
		$paging->sql = "SELECT 
			p.id as id, 
			p.nama as nama,
			p.username as username,
			pg.nama as `group`,
			pel.nama as pelayanan
		FROM 
			pengguna p
			JOIN pengguna_group pg ON (pg.id = p.pengguna_group_id)
			LEFT JOIN pelayanan pel ON (pel.id = p.pelayanan_id)
		WHERE pg.id <> 1
		ORDER BY 
			pg.nama,
			p.nama";

		$paging->get_page_result();
		$paging->hal = $hal;
		$_SESSION[hal] = $hal;
		$paging->get_page_result();

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 300;
		$table->addTh("No", "Nama", "Username", "Group", "Bangsal/<br />Klinik", "Hapus");
		$table->addExtraTh(" style=\"width: 50px;\"", "", "", "", "", " style=\"width: 70px;\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i), 
				$data[$i][nama], 
				$data[$i][username], 
				$data[$i][group], 
				$data[$i][pelayanan], 
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_pengguna('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>");

			$table->addOnclickTd(
				"xajax_get_pengguna('".$data[$i][id]."')", 
				"xajax_get_pengguna('".$data[$i][id]."')", 
				"xajax_get_pengguna('".$data[$i][id]."')", 
				"xajax_get_pengguna('".$data[$i][id]."')", 
				"xajax_get_pengguna('".$data[$i][id]."')"
			);
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function get_pengguna($id) {
		$kon = new Konek;
		$kon->sql = "
		SELECT 
			p.id as id, 
			p.nama as nama,
			p.username as username, 
			pg.id as pgid,
			p.pelayanan_id as pid
		FROM 
			pengguna p
			JOIN pengguna_group pg ON (pg.id = p.pengguna_group_id)
		WHERE 
			p.id = '".$id."'";
		$kon->execute();
		$data = $kon->getOne();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pengguna", "value", $data[id]);
		$objResponse->addAssign("nama", "value", $data[nama]);
		$objResponse->addAssign("username", "value", $data[username]);
		$objResponse->addAssign("pengguna_group_id", "value", $data[pgid]);
		if($data[pgid] == "7") $objResponse->addScriptCall("xajax_ref_get_pelayanan", "pelayanan_id", "RAWAT INAP", $data[pid]);
		elseif($data[pgid] == "8") $objResponse->addScriptCall("xajax_ref_get_pelayanan", "pelayanan_id", "RAWAT JALAN", $data[pid]);
		elseif($data[pgid] == "12") $objResponse->addScriptCall("xajax_ref_get_pelayanan", "pelayanan_id", "RUANG TINDAKAN", $data[pid]);
		elseif($data[pgid] == "9") $objResponse->addScriptCall("get_pelayanan", '9');
		else $objResponse->addScriptCall("get_pelayanan", '0');
		$objResponse->addAssign("msg_pwd", "innerHTML", "Kosongkan jika password tidak dirubah");
		$objResponse->addAssign("msg_pwd2", "innerHTML", "Kosongkan jika password tidak dirubah");
		$objResponse->addScriptCall("fokus", "nama");;
		return $objResponse;
	}

	function hapus_pengguna($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM pengguna WHERE id = '".$id."'";
		$kon->execute();
		$ret = $kon->affected_rows;
		$objResponse = new xajaxResponse();
		if($ret<0) {
			$objResponse->addAlert("Data Tidak Dapat Dihapus.");
		} else {
			$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal]);
			$objResponse->addScriptCall("fokus", "nama");
		}
		return $objResponse;
	}

	function simpan_pengguna($value) {
		$kon = new Konek;
		if(!$value['id_pengguna']) {
			$sql = "
				INSERT INTO pengguna(
					nama,
					pengguna_group_id,
					pelayanan_id,
					username,
					pwd
					
				) VALUES (
					'".$value[nama]."',
					'".$value[pengguna_group_id]."',
					NULLIF('".$value[pelayanan_id]."', ''),
					'".$value[username]."',
					MD5('".$value[pwd]."')
				)";
		} else {
			if($value[pwd]) $q_pwd = " pwd = MD5('".$value[pwd]."'), ";
			$sql = "
				UPDATE 
					pengguna 
				SET 
					nama = '".$value[nama]."',
					pengguna_group_id = '".$value[pengguna_group_id]."',
					username = '".$value[username]."',
					$q_pwd
					pelayanan_id = NULLIF('".$value[pelayanan_id]."', '')
				WHERE 
					id = '".$value[id_pengguna]."'";
		}
		$kon->sql = $sql;
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("show_status_simpan");
		$objResponse->addScriptCall("xajax_reset_pengguna");
		$objResponse->addScriptCall("xajax_list_data");
		return $objResponse;
	}

	function simpan_pengguna_check($value) {
		$kon = new Konek;
		$kon->sql = "SELECT username FROM pengguna WHERE LOWER(username) = LOWER('".$value[username]."') AND id <> '".$value[id_pengguna]."'";
		$kon->execute();
		$data_user = $kon->getOne();
		
		$objResponse = new xajaxResponse();
		$value[nama] = addslashes(trim($value[nama]));
		if(!$value[nama]) {
			$objResponse->addAlert("Silakan Isi Nama User.");
			$objResponse->addScriptCall("fokus", "nama");
		} elseif(!$value[username]) {
			$objResponse->addAlert("Silakan Isi Username.");
			$objResponse->addScriptCall("fokus", "username");
		} elseif($value[username] == $data_user[username]) {
			$objResponse->addAlert("Username sudah dipakai.");
			$objResponse->addScriptCall("fokus", "username");
		} elseif(!$value[pengguna_group_id]) {
			$objResponse->addAlert("Group harus diisi");
			$objResponse->addScriptCall("fokus", "pengguna_group_id");
		} else {
			if($value[id_pengguna]) {
				if(($value[pwd] || $value[pwd2]) && (md5($value[pwd]) != md5($value[pwd2]))) {
					$objResponse->addAlert("Password harus sama");
					$objResponse->addScriptCall("fokus", "pwd");
				} else {
					$objResponse->addScriptCall("xajax_simpan_pengguna", $value);
					$objResponse->addScriptCall("fokus", "nama");
				}
			} elseif(!$value[id_pengguna]) {
				if(!$value[pwd]) {
					$objResponse->addAlert("Password harus diisi");
					$objResponse->addScriptCall("fokus", "pwd");
				} elseif(md5($value[pwd]) != md5($value[pwd2])) {
					$objResponse->addAlert("Password harus sama");
					$objResponse->addScriptCall("fokus", "pwd");
				} else {
					$objResponse->addScriptCall("xajax_simpan_pengguna", $value);
					$objResponse->addScriptCall("fokus", "nama");
				}
			}
		}
		return $objResponse;
	}

	function reset_pengguna () {
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("id_pengguna", "value", "");
		$objResponse->addAssign("nama", "value", "");
		$objResponse->addAssign("pengguna_group_id", "value", "");
		$objResponse->addAssign("username", "value", "");
		$objResponse->addAssign("pwd", "value", "");
		$objResponse->addAssign("pwd2", "value", "");
		$objResponse->addAssign("msg_pwd", "innerHTML", "");
		$objResponse->addAssign("msg_pwd2", "innerHTML", "");
		$objResponse->addScriptCall("fokus", "nama");;
		return $objResponse;
	}

}
$kon = new Konek;
$kon->sql = "SELECT * FROM pengguna_group WHERE id <> 1 ORDER BY nama";
$kon->execute();
$data_group = $kon->getAll();


//$_xajax->debugOn();
$_xajax->registerFunction(array("list_data", "Pengguna", "list_data"));
$_xajax->registerFunction(array("get_pengguna", "Pengguna", "get_pengguna"));
$_xajax->registerFunction(array("hapus_pengguna", "Pengguna", "hapus_pengguna"));
$_xajax->registerFunction(array("simpan_pengguna", "Pengguna", "simpan_pengguna"));
$_xajax->registerFunction(array("simpan_pengguna_check", "Pengguna", "simpan_pengguna_check"));
$_xajax->registerFunction(array("reset_pengguna", "Pengguna", "reset_pengguna"));

include AJAX_REF_DIR . "kunjungan.php";

?>