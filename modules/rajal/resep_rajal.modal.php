<?php

/**
 * @author yudasy
 * @copyright 2011
 */

Class resep_rawat_jalan
{
  	function buka_resep_rajal($id_kunjungan_kamar) {
		$objResponse = new xajaxResponse;
		$kon = new Konek;
	
		//$objResponse->addAssign("debug", "innerHTML", $sql);
		//info utama
		$objResponse->addAssign("judul_daftar_ranap", "innerHTML", "Pendaftaran Pasien Rawat Inap");
		
        //tampilkan modal window input pesan kamar
		$objResponse->addClear("modal_resep_rawat_jalan", "style.display");
		$objResponse->addScriptCall("disable_mainbar", "#E5E6E1");
		$objResponse->addScriptCall('fokus', 'cara_bayar');
		return $objResponse;  
    }
    
    function tutup_resep_rawat_jalan() {
		$objResponse = new xajaxResponse;
		$objResponse->addScriptCall("enable_mainbar");
		$objResponse->addAssign("modal_resep_rawat_jalan", "style.display", "none");
		$objResponse->addScript("document.getElementById('input_resep_rawat_jalan').reset()");
		
		return $objResponse;
	}    
}
//Class Pesan_Kamar_Modal
//$_xajax->registerFunction(array("buka_daftar_ranap", "Daftar_Ranap", "buka_daftar_ranap"));
//$_xajax->registerFunction(array("buka_edit_ranap", "Daftar_Ranap", "buka_edit_ranap"));
//$_xajax->registerFunction(array("simpan_daftar_ranap", "Daftar_Ranap", "simpan_daftar_ranap"));
//$_xajax->registerFunction(array("simpan_daftar_ranap_check", "Daftar_Ranap", "simpan_daftar_ranap_check"));
$_xajax->registerFunction(array("tutup_resep_rawat_jalan", "resep_rawat_jalan", "tutup_resep_rawat_jalan"));
//$_xajax->registerFunction(array("get_info_kamar", "Daftar_Ranap", "get_info_kamar"));
?>