<?
$_TITLE = "Pembuatan Tracer";
Class Buat_Tracer {

	function simpan_tracer($val, $arr) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
		for($i=0;$i<sizeof($arr);$i++) {
			$ins[$i] = "";
			$kon->sql = "INSERT INTO tracer (pasien_id, keperluan, peminjam, tgl_keluar, cetak) VALUES ('".$arr[$i]."', '".$val[keperluan]."', '".$val[peminjam]."', '".$val[tgl_keluar_thn]."-".$val[tgl_keluar_bln]."-".$val[tgl_keluar_tgl]."', 'BELUM')";
			$kon->execute();
			$trcid[] = $kon->last_id;
		}
		$id_tracer = implode("|", $trcid);
		$objResponse->addScriptCall("cetak_tracer", URL . "filing/cetak_tracer_cetak/?trcid=" . $id_tracer, 350, 600);
		return $objResponse;
	}

	function simpan_tracer_check($value) {
		$cleaner = new FormCleaner;
		$cleaner->setValue($value);
		$cleaner->clean();
		$val = $cleaner->getValue();

		$objResponse = new xajaxResponse;

		if(!$val[no_rm]) {
			$objResponse->addAlert("Silakan Isi Nomor Rekam Medis");
			$objResponse->addScriptCall("fokus", "no_rm");
		} elseif(!$val[peminjam]) {
			$objResponse->addAlert("Silakan Isi Peminjam");
			$objResponse->addScriptCall("fokus", "peminjam");
		} else {
			$kon = new Konek;
			$arr_no_rm = explode("\n", $val[no_rm]);
			$str_no_rm = str_replace("\n", ", ", $val[no_rm]);
			//$objResponse->addAlert($str_no_rm);
			$kon->sql = "
				SELECT 
					CONCAT_WS('-', SUBSTRING(trc.pasien_id, 1,2), SUBSTRING(trc.pasien_id, 3,2), SUBSTRING(trc.pasien_id, 5,2), SUBSTRING(trc.pasien_id, 7,2)) as no_rm,
					kmr.nama as nama_kamar, 
					trc.peminjam as peminjam,
					DATE_FORMAT(trc.tgl_keluar, '%d/%m/%y') as tgl_keluar,
					p.nama as nama
				FROM 
					tracer trc
					LEFT JOIN kunjungan_kamar kk ON (kk.id = trc.kunjungan_kamar_id)
					LEFT JOIN kamar kmr ON (kmr.id = kk.kamar_id)
					JOIN pasien p ON (p.id = trc.pasien_id)
				WHERE
					trc.pasien_id IN (".$str_no_rm.")
					AND trc.tgl_kembali IS NULL
			";
			$kon->execute();
			$data = $kon->getAll();
			if(!empty($data)) {
				$str = "\n";
				for($i=0;$i<sizeof($data);$i++) {
					$str .= "---------------------------------------\n";
					$str .= "No RM : " . $data[$i][no_rm] . "\n";
					$str .= "Pasien : " . $data[$i][nama] . "\n";
					$str .= "Tgl Keluar : " . $data[$i][tgl_keluar] . "\n";
					if( $data[$i][peminjam]) $str .= "Peminjam : " . $data[$i][peminjam] . "\n";
					if( $data[$i][nama_kamar]) $str .= "Pelayanan : " . $data[$i][nama_kamar] . "\n";
					$str .= "---------------------------------------\n";
				}
				$objResponse->addAlert("Data Tidak Dapat Disimpan.\nNomor Rekam Medis Berikut Belum Kembali Ke Rak Penyimpanan :\n" . $str);
				$objResponse->addScriptCall("fokus", "no_rm");
			} else {
				$objResponse->addScriptCall("xajax_simpan_tracer", $val, $arr_no_rm);
			}
		}
		return $objResponse;
	}

}


//Class Kunjungan
$_xajax->registerFunction(array("simpan_tracer", "Buat_Tracer", "simpan_tracer"));
$_xajax->registerFunction(array("simpan_tracer_check", "Buat_Tracer", "simpan_tracer_check"));

?>