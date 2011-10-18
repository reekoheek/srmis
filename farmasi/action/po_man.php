<?php
	function createPO($postatus, $potanggal, $lyidsupp, $pocreated){
	  if(empty($poNo)){
	  	$poNo = reserveNo("PO","content/po_man.php");
	  	$poStatus = $postatus; 
	  	$poReqNo = "POM/" . date("dmy") ;
	  	$poDate = $potanggal;
	  	$poSupplier = $lyidsupp;
	  	$poCreator = $pocreated;
	  	
	  	$strSQLPoMan = "Insert into purchase_order 
	  					(`po_no`, `tgl_po`, `request_no`, `id_supplier`, `flags`, 
	  					`total_price`, `percent_discount`, `discount_amount`, `after_discount`,
	  					`ppn_amount`, `grand_total` , `total_items`,
	  					`created_datetime`, `created_user`, `updated_datetime`, `updated_user`)
	  					VALUES 
	  					('$poNo', '$poDate', '$poReqNo', '$poSupplier', 2,
	  					'0', '0', '0', '0', 
	  					'0','0','0', 
	  					now(), '$poCreator', now(),'$poCreator')";
	  	//$execGo = execSQL($strSQLPoMan);
	  	$retCreate = array("$poNo", "$poReqNo", "$poDate", "$poSupplier", "$poCreator");
	  	return($retCreate);
	  }
	  else{

	  }	  
	}
	function loadPO($poNo){
		$strSQLLoad= "SELECT * FROM `purchase_order` where `po_no`  = '". $poNo . "' ";
		$execGo = execSQL($strSQLLoad);
		$retCreate = array ($execGo['po_no'], $execGo['request_no'], $execGo['tgl_po'], $execGo['id_supplier'], $execGo['created_user']);
		return($retCreate);
	}
?>