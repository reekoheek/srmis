<?php

/**
 * @author yudasy
 * @copyright 2011
 */

Class ref_kamar {
    
    	function get_nama_kamar($inputId, $id, $id_sel = NULL) {
            $kon = new Konek;		
    		$kon->sql = "SELECT id,nama FROM kamar WHERE pelayanan_id = '".$id."' ORDER BY nama";
    		$kon->execute();
    		$data = $kon->getAll();
    		$objResponse = new xajaxResponse();
    		$objResponse->addAssign($inputId, "options.length", "1");
    		for($i=0;$i<sizeof($data);$i++) {
    			if($data[$i][id] == $id_sel) {
    				$objResponse->addScript("addOption('".$inputId."','" .$inputId. "kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");	
    			} else {
    				$objResponse->addScript("addOption('".$inputId."','".$inputId."_kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
    			}
    		}    	
    		return $objResponse;
	}
    
    
    function get_bed($inputId, $id, $id_sel = NULL) {
		$objResponse = new xajaxResponse();
		$kon = new Konek;
		$kon->sql = "SELECT id,nomor FROM ref_kamar WHERE pelayanan_id = '".$id."' AND status=0 ORDER BY nomor";
		$kon->execute();
		$data = $kon->getAll();	
		$objResponse->addAssign($inputId, "options.length", "1");
		for($i=0;$i<sizeof($data);$i++) {
			if($data[$i][id] == $id_sel)
				$objResponse->addScript("addOption('".$inputId."','".$inputId."kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,true);");
			else
				$objResponse->addScript("addOption('".$inputId."','".$inputId."_kamar_".$data[$i][id]."','".$data[$i][nama]."','".$data[$i][id]."',false,false);");
		}
		//$objResponse->addScript("addOption('".$inputId."','".$inputId."_tidak_ada_dokter','Dokter Lain','',false,false);");
		return $objResponse;
	}    			
    
}
$_xajax->registerFunction(array("ref_get_nama_kamar", "ref_kamar", "get_nama_kamar"));
$_xajax->registerFunction(array("ref_get_bed", "ref_kamar", "get_bed"));
?>