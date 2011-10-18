<?
$_TITLE = "Pembayaran Angsuran";
Class Kunjungan {

	function list_data($hal=0, $val="") {
		if($val[cara_bayar]) $q = " AND kk.cara_bayar = '".$val[cara_bayar]."' ";
		if($val[pasien_id]) {
			$q .= " AND p.id = '".$val[pasien_id]."' ";
		} elseif($val[nama]) {
			$q .= " AND p.nama LIKE '%".$val[nama]."%' ";
		} elseif($val[kwitansi_id]) {
			$q .= " AND kw.id = '".$val[kwitansi_id]."' ";
		} else {
			$tgl_daftar_dari = $val[tgl_mulai_thn] . "-" . $val[tgl_mulai_bln] . "-" . $val[tgl_mulai_tgl];
			$tgl_daftar_sampai = $val[tgl_selesai_thn] . "-" . $val[tgl_selesai_bln] . "-" . $val[tgl_selesai_tgl];
			$q .= " AND DATE(kk.tgl_keluar) BETWEEN '".$tgl_daftar_dari."' AND '".$tgl_daftar_sampai."' ";
		}
		if(!$val[semua]) $q .= " AND kw.status = 'ANGSUR' ";
		$paging = new MyPagina;
		$paging->setOnclickValue("xajax.getFormValues('form_kunjungan')");
		$sql = "
			SELECT 
				k.id as id_kunjungan,
				kk.id as id_kunjungan_kamar,
				CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
				p.id as pasien_id,
				REPLACE((p.nama), ('".$val[nama]."'), ('<b>".$val[nama]."</b>')) as nama,
				kk.cara_bayar as cara_bayar,
				CONCAT(p.alamat, ' ', 'RT ', p.rt, '/ RW ', p.rw, '<br />',des.nama, ', ', kec.nama, ', ', kab.nama, '<br />', prop.nama) as alamat,
				CONCAT_WS('-', kw.tempat_pembayaran, kw.id) as no_kwitansi,
				kw.id as kwitansi_id,
				kw.bayar as bayar,
				SUM(kb.bayar_bhp+kb.bayar_jasa)-kw.bayar as kurang,
				kw.tgl as tgl
			FROM 
				kunjungan k
				JOIN pasien p ON (p.id = k.pasien_id)
				JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
				JOIN kamar kmr ON (kmr.id = kk.kamar_id)
				JOIN pelayanan pel ON (pel.id = kmr.pelayanan_id)
				JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_id = kk.id)
				JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
				JOIN kwitansi kw ON (kw.id = kwd.kwitansi_id)
				JOIN ref_desa des ON (des.id = p.desa_id)
				JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
			WHERE
				1=1
				$q
			GROUP BY
				kw.id
			ORDER BY 
				kw.id
		";
		$paging->sql = $sql;
		$paging->rows_on_page = 20;
		$paging->hal = $hal;
		$paging->get_page_result();

		$_SESSION[keuangan_kunjungan][hal] = $hal;

		$data = $paging->data;
		$no = $paging->start_number();
		$navi = $paging->navi();

		$table = new Table;
		$table->tbody_height = 310;
		$table->addTh(
			"No", 
			"No. RM", 
			"Nama Pasien", 
			"Alamat", 
			"Cara Bayar", 
			"Nomor Kwitansi", 
			"Bayar",
			"Kurang"
		);
		$table->addExtraTh("style=\"width:20px;\"","style=\"width:100px;\"","","","","","","");
		for($i=0;$i<sizeof($data);$i++) {
			//if(!empty($baru[$i][kamar])) $kamar = implode("<br />", $baru[$i][kamar]);
			//else $kamar = $baru[$i][kamar][0];
			$table->addRow(
				($no+$i), 
				$data[$i][no_rm], 
				$data[$i][nama], 
				$data[$i][alamat], 
				$data[$i][cara_bayar], 
				$data[$i][no_kwitansi],
				uangIndo($data[$i][bayar]),
				uangIndo($data[$i][kurang])
				);
			$table->addOnclickTd(
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')",
				"xajax_buka_langsung_bayar('".$data[$i][kwitansi_id]."')"
			);
		}
		$ret = $table->build();
		$objResponse = new xajaxResponse();
		//$objResponse->addAssign("debug", "innerHTML", $val[semua]);
		$objResponse->addAssign("navi", "innerHTML", $navi);
		$objResponse->addAssign("list_data", "innerHTML", $ret);
		return $objResponse;
	}

}


//Class Kunjungan
$_xajax->registerFunction(array("list_data", "Kunjungan", "list_data"));

//include "kunjungan.modal.php";
include "langsung_bayar_angsuran.modal.php";
include AJAX_REF_DIR . "kunjungan.php";
include AJAX_REF_DIR . "form.php";

?>