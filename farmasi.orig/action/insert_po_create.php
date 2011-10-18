<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */

/****************************/
/*  GET POSTED VARIABLES   */
/**************************/
$noPO = $_POST[no_po];
$noReq = $_POST[no_req];
$tglPO = $_POST[tgl_req];
$param = $_POST[param];
$flags = $_POST[flags];
/** 
* flags 
* 1 = insert
* 2 = update
* 3 = cancel 
*/

$getDbPO = getSingleData("Select * from purchase_order where po_no ='$noPO'");
if ((!empty($getDbPO)) || ($getDbPO="")){
    if ($flags == 2 ){
        /* UPDATE */
    }
    elseif($flags==3){
        /* DELETE */
    }
    
}else{    
    if ($flags==1){
      /* INSERT */
      $strSQL = "insert into head_spb(
      po_no, tgl_po, request_no, id_supplier, is_approved, po_approved_by, btb_no,
      total_price, percent_discount, discount_amount, after_discount, ppn_amount, grand_total,
      total_items, remark, is_revisi, usr_revisi, tgl_revisi, usr_cancel, tgl_cancel,  
      created_datetime, created_user, update_datetime, update_user)";
      $strSQL .= " VALUES (
      $noPO, $tglPO, $noReq, 
      ";  
    }
}

?>