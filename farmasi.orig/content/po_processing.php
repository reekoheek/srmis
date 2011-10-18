<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PO Approval</title>
<!-- pop up jquery -->
<script src="include/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="include/popup.js" type="text/javascript"></script>
<script src="include/popup2.js" type="text/javascript"></script>
<!-- end pop up jquery-->
<!-- pop up windows-->
<script>
function PopupCenter(pageURL, title, w, h) {
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var targetWin = window.open 
    (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<!--end pop up windows -->
<script type="text/javascript"><!--
var records = 0 ;
function getSubtotal ()
{    
    var dump = 0;
    var qty = 0 ;
    var harga = 0;
    var subtotal = 0;
    var grand = 0;
    for(var i=0;i<=parseInt(records);i++)
    {
        var name1 = "txtSubtotal"+i;
        var name2 = "txtQty"+i;
        var name3 = "txtHarga"+i;
        name1
        qty = parseInt(document.forms['frmPOCreate'].txtQty+i.value);
        harga = parseInt(document.forms['frmPOCreate'].elements[txtHarga+i].value);
        subtotal = qty * harga;
        document.forms['frmPOCreate'].elements[txtSubtotal+i].value = subtotal.toFixed(2);
        dump+= parseInt(subtotal);
    }
        document.forms['frmPOCreate'].txtHTotal.value = dump.toFixed(2);
        grand = dump * 0.1;        
        document.forms['frmPOCreate'].txtHGrandTotal.value = grand.toFixed(2);
        
        
}
function setCount ( rcd ) 
{ 
    records = rcd;
    getSubtotal();
}

--></script>

</head>
<body  >
<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 * @link home.php?hal=content/po_processing
 * @todo ALL QUERY SHALL CONVERT TO STORED PROCEDURES, 
 *       FOR IT'S WILL EASIER TO MAINTAINCE.
 */

/* ################################# */
/*          ACCESS LEVELING...       */
/* ################################# */
global $userDept;
global $userType;
$userDept       = $_SESSION['U_UNITID'];
$userType       = $_SESSION['U_KODE'];

/* ################################# */
/*   CATCHING NEEDED PARAMETERS      */
/* ################################# */
$idPO = $_POST['stream'];
$isManual = $_POST['man_po'];
//print ("$idPO <br />");
if (($idPO == 0) || (empty($idPO))){
        $idPO = $_GET[stream];
        $isManual=0; }
if (($idPO == 0) || ($isManual==1)){die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/po_man' /> ");
}else{    
}
//print $idPO;
$strSQLHeader = "SELECT 
                a.po_no , a.request_no as po_reqno, (date_format(a.tgl_po, '%d/%m/%Y')) as po_tgl, b.nama as supplier,
                (case a.flags when 1 then 'Closed' when 2 then 'Receiving'
                when 3 then 'Approved' when 4 then 'Open' when 5 then 'Generated' when 6 then 'Canceled' END) as status, 
                a.created_user as creator, a.flags as flags, a.btb_no, a.penerima, a.total_price, a.percent_discount,
                a.discount_amount, a.ppn_amount, a.grand_total 
               FROM purchase_order a 
               INNER JOIN pbf b ON 
                a.id_supplier = b.id
               ";
if (!empty($idPO)){$strSQLHeader    .= "WHERE a.id = $idPO"; }
$resHeader = execSQLReturn($strSQLHeader);
global $poSTBNo;
global $poSTBUser;
global $poTotPrice;
global $poTotDisc;
global $poTotADisc;
global $poTotPPN;
global $poTotGrand;
global $poStatus;
$poNO       = $resHeader[po_no];
$poReqNo    = $resHeader[po_reqno];
$poDate     = $resHeader[po_tgl];
$poCreator  = $resHeader[creator];
$poStatus   = $resHeader[status];
$poSupplier = $resHeader[supplier];
$flags      = $resHeader[flags];
$poSTBNo    = $resHeader[btb_no];
$poSTBUser  = $resHeader[penerima];
$poTotPrice = $resHeader[total_header];
$poTotDisc  = $resHeader[percent_discount];
$poTotADisc = $resHeader[discount_amount];
$poTotPPN   = $resHeader[ppn_amount];
$poTotGrand = $resHeader[grand_total];

if ($poStatus='Open'){
    $unitPO = 'Farmasi';
} else if ($poStatus = 'Generated'){
    $unitPO = 'Farmasi';
} else if ($poStatus='Approved'){
    $unitPO = 'Accounting' ;
} else if ($poStatus = 'Receiving'){
    $unitPO = 'Farmasi';
} else if ($poStatus = 'Closed'){
    $unitPO = 'Farmasi' ;
} else {$unitPO = 'Farmasi' ; }
//print_r ($resHeader[po_no]);
//die();
?>

<!-- START HEADER  -->
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Create PO </b></font></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png" /></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
		<font style="font-size:12px;">
			<form method="post" action="home.php?hal=action/generate_po" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td align="left" width="100px"> No PO  </td>
                            <td>
                                : <input type="text" size="20" name="pono" value="<?=$poNO ?> " style="background-color:#CCCFFF;" readonly="true"/> 
                            </td>
                            <td align="left" width="100px"> Status </td>
                            <td>
                                : <input type="text" size="20" name="postatus" value="<?php echo ($poStatus . " - " . $unitPO) ;?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
                        </tr>
						<tr>
							<td align="left" width="100px"> No Request </td>
							<td>
    							: <input type="text" size="20" name="no_req" value="<?php echo $poReqNo ;?>" style="background-color:#CCCFFF; " readonly="true" />
                                <input type="hidden" size="20" name="param_no" value="<?php $param_no ; ?>" />
                                <input type="hidden" name="lastno" value="<?php $rp['full_no'] ; ?>" />
							</td>
                            <td align="left" width="100px"> Created By </td>
                            <td>
                                : <input type="text" size="20" name="pocreated" value="<?php echo $poCreator ; ?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
						</tr>
						<tr>
							<td align="left" width="100px" > Tanggal </td>
							<td>
								: <input type="text" size="12" name="potanggal" value="<?php echo $poDate ; ?>" style="background-color:#CCCFFF; " readonly="true" />
							</td>
                            <td align="left" width="100px"> Supplier </td>
                            <td>
                                : <input type="text" size="20" name="posupplier" value="<?php echo $poSupplier ; ?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
                            <td> <input type="button" onclick="PopupCenter('content/po_print.php?stream=<?=$idPO?>', 'popPO',600,300);"/></td>
						</tr>
					</table>
                        <br />
                    </td>
                    <tr>
                    <td> &nbsp;</td>
                    <td>
<!-- END HEADER  -->
<!-- **********  -->
<!-- START GRID  -->
                    <hr width="97%" align="left" size="3" />
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
                     
                    <?php                     
                     if ($flags==2){
                        include ('content/po_receiving_grid.php');
                     }elseif($flags==1){                        
                        include ('content/po_processing_grid_closed.php');
                     }else{
                        include('content/po_processing_grid.php') ;
                     } 
                     ?>
                    </div>
<!--   END GRID   -->
<!-- ************ -->
<!-- START FOOTER -->
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td align="left" colspan="2">
                    <table style="padding-right: 13px;" width="100%">
                        <tr>
                            <td align='right' colspan="3">Total Price(Rp )</td>
                            <td>:</td>
                            <td align='right'><input type ='text' name='txtHTotal' readonly="true" style="width: 100px; background-color:#CCCFFF; " value="<?=$poTotPrice?>" /></td>
                        </tr>
                        <tr>
                            <td align='right' colspan="3">Total Discount( %)</td>
                            <td>:</td>
                            <td align='right'><input type ='text'  name='txtHDisc' readonly="true" style="width: 100px; background-color:#CCCFFF; " value="<?=$poTotDisc?>"/></td>
                        </tr>
                        <tr>
                            <td align='right' colspan="3">Total Discount(Rp )</td>
                            <td>:</td>
                            <td align='right'><input type ='text'  name='txtHADisc' readonly="true" style="width: 100px; background-color:#CCCFFF; " value="<?=$poTotADisc?>" /></td>
                        </tr>
                        <tr>
                            <td align="left" width="10%">BTB No</td>
                            <td align="left" width="45%">: <input type="text" name="poSTBNo" readonly="true" value="<?= $poSTBNo ?>" style="width: 100px; background-color:#CCCFFF; "/></td>
                            <td align='right'>PPN(10% ) <input type="hidden" name="ppn" value="0.1"/></td>
                            <td>:</td>
                            <td align='right' width="15%"><input type ='text'  name='txtPPN' readonly="true" style="width: 100px; background-color:#CCCFFF; " value="<?=$poTotPPN?>" /></td>
                        </tr>
                        <tr>
                            <td width="10%">Penerima </td>
                            <td align="left" width="45%">: <input type="text" name="poSTBUser" readonly="true" value="<?= $poSTBUser ?>" style="width: 100px; background-color:#CCCFFF; "/></td>                        
                            <td align='right'>Grand Total(Rp )</td>
                            <td>:</td>
                            <td align='right'><input type ='text' name='txtHGrand' readonly="true" style="width: 100px; background-color:#CCCFFF; " value="<?=$poTotGrand?>" /></td>
                        </tr>
                        <tr>
                            <td colspan="5">
                            <hr />
                            </td>
                        </tr>
                        <tr>
                            <td align="right" colspan="5">
                            <?php
                                if (($userDept==5)||(empty($userDept))||($userDept==0)){
                                    print("<input type='submit' name='submitPP' value='Proses PO' id='submit' />");
                                }else{
                                    print("<input type='submit' name='submitPP' value='Proses PO'  id='submit' style='visibility: hidden;'/>");
                                }
                            ?>
                            </td>
                        </tr>
                    </table>
                    </td>
                </tr>                
           </table>
           </form>
           </font>           
        </td>
     </tr>
     <tr>
        <td><img src="images/bawah_isi.png" /></td>
     </tr>
</table>
                                        