<?
Class Cari_Pasien {

	function list_data($hal = 0, $val) {
		$paging = new MyPagina;
		$paging->rows_on_page=100;
		$objResponse = new xajaxResponse();

		if($val[is_cari] == "1") {
			if($val[cari_id]) {
				$q = " AND p.id = '".$val[cari_id]."' ";
			} else {
				if($val[cari_nama]) $q .= " AND p.nama LIKE '%".$val[cari_nama]."%' ";
				if($val[cari_sex]) $q .= " AND p.sex = '".$val[cari_sex]."' ";
				if($val[cari_alamat]) $q .= " AND p.alamat LIKE '%".$val[cari_alamat]."%' ";
				if($val[cari_rt]) $q .= " AND p.rt LIKE '%".$val[cari_rt]."%' ";
				if($val[cari_rw]) $q .= " AND p.rw LIKE '%".$val[cari_rw]."%' ";

				if($val[cari_desa_id]) $q .= " AND des.id = '".$val[cari_desa_id]."' ";
				elseif($val[cari_kecamatan_id]) $q .= " AND kec.id = '".$val[cari_kecamatan_id]."' ";
				elseif($val[cari_kabupaten_id]) $q .= " AND kab.id = '".$val[cari_kabupaten_id]."' ";
				elseif($val[cari_propinsi_id]) $q .= " AND prop.id = '".$val[cari_propinsi_id]."' ";
			}
		}
		$sql = "
			SELECT
				p.id as id,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as id_display,
				REPLACE(UPPER(p.nama), UPPER('".$val[cari_nama]."'), UPPER('<b>".$val[cari_nama]."</b>')) as nama,
				CONCAT(p.alamat, ' ', 'RT ', p.rt, '/ RW ', p.rw, '<br />',des.nama, ', ', kec.nama, ', ', kab.nama, '<br />', prop.nama) as alamat
			FROM
				pasien p
				LEFT OUTER JOIN ref_desa des ON (des.id = p.desa_id)
				LEFT OUTER JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				LEFT OUTER JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				LEFT OUTER JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
			WHERE
				1=1
				$q
			ORDER BY p.nama
			";
			//echo $sql;
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		$paging->hal = $hal;
		$paging->sql = $sql;
		$paging->setOnclickValue("xajax.getFormValues('cari_pasien')");
		$paging->get_page_result();
		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 270;
		$table->addTh("No", "No. RM", "NAMA", "ALAMAT", "HAPUS");
		$table->addExtraTh(" style=\"width:40px\" ", " style=\"width:100px\" ", " style=\"width:200px\" ", "", " style=\"width:70px\" ");
		for($i=0;$i<sizeof($data);$i++) {
			$table->addRow(
				($no+$i),
				$data[$i][id_display],
				$data[$i][nama],
				$data[$i][alamat],
				"<a href=\"javascript:void(0)\" title=\"Hapus\" onclick=\"hapus_pasien('".$data[$i][id]."', this)\" class=\"tombol_hapus\"><img src=\"".IMAGES_URL."remove.png\" alt=\"Hapus\" border=\"0\" /></a>"
			);

			$table->addOnclickTd(
				"xajax_get_pasien('".$data[$i][id]."')",
				"xajax_get_pasien('".$data[$i][id]."')",
				"xajax_get_pasien('".$data[$i][id]."')",
				"xajax_get_pasien('".$data[$i][id]."')"
			);
		}
		$ret = $table->build();
		$objResponse->addAssign("cari_navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

	function hapus_pasien($id) {
		$kon = new Konek;
		$kon->sql = "DELETE FROM pasien WHERE id = '".$id."'";
		$kon->execute();
		$objResponse = new xajaxResponse();
		$objResponse->addScriptCall("xajax_list_data", $_SESSION[hal], $_SESSION[val]);
		$objResponse->addScriptCall("fokus", "id");
		return $objResponse;
	}

	function daftar_dari_cari($value) {
		$objResponse = new xajaxResponse();
		$objResponse->addScript("document.tambah_pasien.reset()");
		$objResponse->addScriptCall("show_hide_form", "form_tambah");
		$objResponse->addClear("id_pasien", "value");
		$objResponse->addAssign("id", "value", $value[cari_id]);
		$objResponse->addAssign("nama", "value", $value[cari_nama]);
		$objResponse->addAssign("alamat", "value", $value[cari_alamat]);
		$objResponse->addAssign("rt", "value", $value[cari_rt]);
		$objResponse->addAssign("rw", "value", $value[cari_rw]);
		$objResponse->addAssign("propinsi_id", "value", $value[cari_propinsi_id]);
		$objResponse->addAssign("sex", "value", $value[cari_sex]);

		$objResponse->addScriptCall("xajax_get_kabupaten", $value[cari_propinsi_id], $value[cari_kabupaten_id]);
		$objResponse->addScriptCall("xajax_get_kecamatan", $value[cari_kabupaten_id], $value[cari_kecamatan_id]);
		$objResponse->addScriptCall("xajax_get_desa", $value[cari_kecamatan_id], $value[cari_desa_id]);
		$objResponse->addScriptCall("fokus", "nama");
		return $objResponse;
	}

	function get_kabupaten($id_propinsi, $id_sel = NULL) {
		$kon = new Konek;
		$kon->sql = "
			SELECT
				id,
				nama
			FROM
				ref_kabupaten
			WHERE
				propinsi_id = '".$id_propinsi."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("cari_kabupaten_id", "options.length","1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('cari_kabupaten_id','kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			} else {
				$objResponse->addScript("addOption('cari_kabupaten_id','kabupaten_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		//$objResponse->addScript("addOption('cari_kabupaten_id','add_kabupaten','--- TAMBAH KABUPATEN ---','add_kabupaten');");
		return $objResponse;
	}

	function get_kecamatan($id_kabupaten, $id_sel = NULL) {
		$kon = new Konek;
		$kon->sql = "
			SELECT
				id,
				nama
			FROM
				ref_kecamatan
			WHERE
				kabupaten_id = '".$id_kabupaten."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("cari_kecamatan_id", "options.length","1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('cari_kecamatan_id','kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			} else {
				$objResponse->addScript("addOption('cari_kecamatan_id','kecamatan_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}

		}
		//$objResponse->addScript("addOption('kecamatan_id','add_kecamatan','--- TAMBAH KECAMATAN ---','add_kecamatan');");
		return $objResponse;
	}

	function get_desa($id_kecamatan, $id_sel = NULL) {
		$kon = new Konek;
		$kon->sql = "
			SELECT
				id,
				nama
			FROM
				ref_desa
			WHERE
				kecamatan_id = '".$id_kecamatan."'
			ORDER BY
				nama
		";
		$kon->execute();
		$data = $kon->getAll();
		$objResponse = new xajaxResponse();
		$objResponse->addAssign("cari_desa_id", "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel) {
				$objResponse->addScript("addOption('cari_desa_id','desa_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			} else {
				$objResponse->addScript("addOption('cari_desa_id','desa_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
			}
		}
		//$objResponse->addScript("addOption('desa_id','add_desa','--- TAMBAH KELURAHAN ---','add_desa');");
		return $objResponse;
	}

}
$_xajax->registerFunction(array("list_data", "Cari_Pasien", "list_data"));
$_xajax->registerFunction(array("hapus_pasien", "Cari_Pasien", "hapus_pasien"));
$_xajax->registerFunction(array("daftar_dari_cari", "Cari_Pasien", "daftar_dari_cari"));
$_xajax->registerFunction(array("cari_get_kabupaten", "Cari_Pasien", "get_kabupaten"));
$_xajax->registerFunction(array("cari_get_kecamatan", "Cari_Pasien", "get_kecamatan"));
$_xajax->registerFunction(array("cari_get_desa", "Cari_Pasien", "get_desa"));

?>