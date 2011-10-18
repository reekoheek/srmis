<?php

/**
 * @author Richard
 * @copyright 2011
 * @internal purchase order retur processor.
 */
if(isset($_GET[stream])){
    $detID=$_GET[stream];
    if (empty($detID)){
        echo("<script language='javascript'>window.opener.location.reload();window.close();</script>");
    }else{
     $poRetNo   = getNextNo('RPO','action/po_receive_go');
     $poNoRet   = getNextNo('PO', 'action/po_receive_go');
     $strSQLGet = "SELECT * FROM purchase_orderdetail WHERE id=$detID";
     $fetchTmp  = execSQLReturn($strSQLGet);
     $rtrPONO   = $fetchTmp['no_po'];
     $rtrNoReq  = $fetchTmp['no_spb'];
     $rtrSuppID = $fetchTmp['fld01'];
     $rtrQty    = $fetchTmp['qty_po'];
     $rtrHarga  = $fetchTmp['harga_po'];
     $rtrDisc   = $fetchTmp['discount'];
     $rtrADisc  = $fetchTmp['amount_discount'];
     $rtrSubTot = $fetchTmp['subtotal'];
     $rtrBarID  = $fetchTmp['barang_id'];
     $strGetMs  = "Select kd_barang from ms_barang where id= $rtrBarID";
     $rtrBarName= getSingleData($strGetMs);
     $remarks   = "Item Retur: $rtrBarName \n Retur No: $poRetNo";
     $strSQLUpd = "UPDATE purchase_order SET remark='$remarks', fld03='$poRetNo', fld04= now(), 
                   updated_datetime=now(), updated_user='$userLoged'
                   where po_no = '$rtrONO' and request_no= '$rtrNoReq' and id_supplier= $rtrSuppID ";
     $strSQLGo  = "UPDATE purchase_orderdetail SET f_revisi=1 where id=$detID";
     $strSQlPut = "INSERT INTO 
                   purchase_order( 
                   po_no, tgl_po, request_no,
                   id_supplier, flags,
                   created_datetime, created_user,
                   updated_datetime, updated_user
                   )VALUES (
                   '$poNoRet', now(),'$poRetNo',
                   $rtrSuppID, 3, 
                   now(),'$userLoged',now(),'$userLoged')";
     $strSQLDet = "INSERT INTO
                   purchase_orderdetail(
                   no_po, no_spb, barang_id, qty_po, harga_po, 
                   discount, amount_discount, subtotal,
                   created_datetime, created_user,
                   updated_datetime, updated_user,
                   fld01)VALUES ('$poNoRet', '$poRetNo', $rtrBarID,
                   $rtrQty, '$rtrHarga', '$rtrDisc', '$rtrADisc', 
                   '$rtrSubTot', now(), '$userLoged', now(), '$userLoged', $rtrSuppID)";
     $strSQLLock ="UPDATE ms_barang set flags=5 where id = $rtrBarID";
     
     if(!execSQL($strSQLUpd))   {die("Retur Failed!! ");}
     if(!execSQL($strSQLGo))    {die("Update PO Detail Failed !!!");}
     if(!execSQL($strSQLDet))   {die("Insert Retur Failed !!");}
     if(!execSQL($strSQlPut))   {die("Insert Retur Detail Failed !!");}
     if(!execSQL($strSQLLock))  {die("Update Data Failed !!");}
     echo "Retur Pembelian";
     echo("<script language:'javascript'>window.opener.location.reload();window.close();</script>");
    }
}else{ echo("<script language:'javascript'>window.opener.location.reload();window.close();</script>"); }
?>