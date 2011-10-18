<?
$_TITLE = "Pengembalian Berkas ke Rak Penyimpanan";
Class Kembalikan_Berkas {

	function list_data($val, $check = '0') {
		if($check == '1') $str = "AND DATE(trc.tgl_keluar) = '".$val[tgl_keluar_thn]."-".$val[tgl_keluar_bln]."-".$val[tgl_keluar_tgl]."'";
		$kon = new Konek;
		$sql = "
			SELECT 
				kk.id as kkid,
				trc.id as trcid,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				p.nama as nama,
				kmr.nama as kamar,
				trc.peminjam as peminjam,
				trc.keperluan as keperluan,
				trc.tgl_keluar as tgl_keluar
			FROM 
				tracer trc
				JOIN pasien p ON (p.id = trc.pasien_id)
				LEFT JOIN kunjungan_kamar kk ON (kk.id = trc.kunjungan_kamar_id)
				LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
			WHERE
				trc.tgl_kembali IS NULL
				$str
			ORDER BY 
				trc.id
		";
		$kon->sql = $sql;
		$kon->execute();
		$data = $kon->getAll();

		$table = new Table;
		$table->tbody_height = 340;
		$table->anime_bg_color = "";
		$table->addTh(
			"No", 
			"No. RM", 
			"Pasien", 
			"Pelayanan/<br />Peminjam", 
			"Keperluan", 
			"Tgl<br />Berkas Keluar",
			"Kembalikan",
			"Cetak<br />Tracer"
		);
		$table->addExtraTh("style=\"width:50px;\"","style=\"width:80px;\"","style=\"width:200px;\"","","","","style=\"width:50px;\"","style=\"width:50px;\"");
		for($i=0;$i<sizeof($data);$i++) {
			if(($i+1) == sizeof($data)) $cekbox = "<input type=\"checkbox\" name=\"kembalikan[]\" id=\"kembalikan_".$i."\" class=\"inputan\" onkeypress=\"focusNext('tgl_kembali_tgl', event, 'kembalikan_".($i-1)."', this)\" onclick=\"setKembalikan('tr_".$i."', this)\" value=\"".$data[$i][trcid]."\" />";

			elseif($i==0) $cekbox = "<input type=\"checkbox\" name=\"kembalikan[]\" id=\"kembalikan_".$i."\" class=\"inputan\" onkeypress=\"focusNext('kembalikan_".($i+1)."', event, 'simpan', this)\" onclick=\"setKembalikan('tr_".$i."', this)\" value=\"".$data[$i][trcid]."\" />";

			else $cekbox = "<input type=\"checkbox\" name=\"kembalikan[]\" id=\"kembalikan_".$i."\" class=\"inputan\" onkeypress=\"focusNext('kembalikan_".($i+1)."', event, 'kembalikan_".($i-1)."', this)\" onclick=\"setKembalikan('tr_".$i."', this)\" value=\"".$data[$i][trcid]."\" />";

			if($data[$i][kkid]) $link = "<a href=\"javascript:void(0)\" title=\"Cetak ini saja\" style=\"display:block;\" onclick=\"cetak('".URL."filing/cetak_tracer_cetak/?kkid=".$data[$i][kkid]."',350,300)\"><img src=\"".IMAGES_URL."printer_hitam.png\" alt=\"Cetak\" border=\"0\" /></a>";
			else $link = "<a href=\"javascript:void(0)\" title=\"Cetak ini saja\" style=\"display:block;\" onclick=\"cetak('".URL."filing/cetak_tracer_cetak/?trcid=".$data[$i][trcid]."',350,300)\"><img src=\"".IMAGES_URL."printer_hitam.png\" alt=\"Cetak\" border=\"0\" /></a>";
			$table->addRow(
				($i+1), 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][kamar] . $data[$i][peminjam], 
				$data[$i][keperluan], 
				tanggalIndo($data[$i][tgl_keluar], 'j M Y'), 
				$cekbox,
				$link);
			/*
			$table->addOnclickTd(
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')",
				"xajax_list_semua_kunjungan('0', '".$data[$i][pasien_id]."')"
			);
			*/
			$table->addExtraTr("id=\"tr_".$i."\"");
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $auto);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		$objResponse->addAssign("jml_baris", "value", $i);
		return $objResponse;
	}

	function simpan_kembalikan_berkas_check($val) {
		$objResponse = new xajaxResponse;
		if(empty($val[kembalikan])) {
			$objResponse->addAlert("Tidak Ada Berkas Yang Dikembalikan");
		} else {
			$kon = new Konek;
			$str_trcid = implode(", ", $val[kembalikan]);
			$kon->sql = "
				SELECT 
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					p.nama as nama
				FROM
					pasien p 
					JOIN tracer trc ON (trc.pasien_id = p.id)
				WHERE
					trc.id IN (".$str_trcid.")
			";
			$kon->execute();
			$data = $kon->getAll();
			$str = "";
			for($i=0;$i<sizeof($data);$i++) {
				$str .= $data[$i][no_rm] . " : " . $data[$i][nama] . "\n";
			}
			$objResponse->addConfirmCommands(1, "Yakin Akan Mengembalikan Berkas Pasien berikut ? :\n" . $str);
			$objResponse->addScriptCall("xajax_simpan_kembalikan_berkas", $val);
		}
		return $objResponse;
	}

	function simpan_kembalikan_berkas($val) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		for($i=0;$i<sizeof($val[kembalikan]);$i++) {
			$kon->sql = "UPDATE tracer SET tgl_kembali = '".$val[tgl_kembali_thn]."-".$val[tgl_kembali_bln]."-".$val[tgl_kembali_tgl]."' WHERE id = '".$val[kembalikan][$i]."'";
			$kon->execute();
		}
		$objResponse->addAlert(($i) . " berkas dikembalikan.");
		$objResponse->addScriptCall("list_data");
		return $objResponse;
	}
}


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kembalikan_Berkas", "list_data"));
$_xajax->registerFunction(array("simpan_kembalikan_berkas_check", "Kembalikan_Berkas", "simpan_kembalikan_berkas_check"));
$_xajax->registerFunction(array("simpan_kembalikan_berkas", "Kembalikan_Berkas", "simpan_kembalikan_berkas"));

?>