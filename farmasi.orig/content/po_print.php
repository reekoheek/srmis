<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type="text/css">
@media print {
input.noPrint { display: none; }
}
</style>

</head>
<body>
<?php

/**
 * @author Richard
 * @copyright 2011
 */
include "../include/koneksi.php";
include "../include/fungsi_rp.php";
$idPO = $_GET[stream];

$strPOPrint = "select distinct
              a.kd_barang as kode, a.nama as nama, d.req_stock as req_stock, b.satuan_po as po_satuan, b.qty_po as po_qty,
              b.harga_po as po_harga, b.discount as po_discount, b.amount_discount as po_discammount, b.subtotal as po_subtotal,
              b.id as po_detid, b.no_po as no_po, b.no_spb as po_reqno, a.stok as curstok, a.id as id, c.id_supplier as supp_id,
              b.fld05 as expdate, (case c.flags when 1 then 'Closed' when 2 then 'Receiving'
              when 3 then 'Approved' when 4 then 'Open' when 5 then 'Generated' when 6 then 'Canceled' END) as status, 
              c.created_user as creator, (date_format(c.tgl_po, '%d/%m/%Y')) as po_tgl, e.nama as supplier
        from
              ms_barang a
        inner join
              detail_spb d
        on
              a.id = d.barang_id
        inner join
              purchase_orderdetail b
        on
              a.id = b.barang_id
        left outer join
              purchase_order c
        on
              b.no_po = c.po_no and b.no_spb = c.request_no and b.fld01 = c.id_supplier
        inner join 
              pbf e
        on 
              e.id=c.id_supplier 
        where b.f_revisi =0 and c.id=$idPO";
$fetchPrint = execSQLReturn($strPOPrint);
?>

<link rel="stylesheet" type="text/css" href="../include/style.css"/>
<center><fieldset style="width:90%;"><legend style="background-color:#1bda01;"><b><font color="#fefafa" style="font-size:14px;">&nbsp;&nbsp;PO no <?=$poNO?>&nbsp;&nbsp;</font></b></legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>PURCHASE ORDER </b></font></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/#.png" /></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
		<font style="font-size:12px;">
			<form method="post" action="_SELF" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td align="left" width="100px"> No PO  </td>
                            <td>
                                : <input type="text" size="20" name="pono" value="<?=$fetchPrint['no_po'] ?> " style="background-color:#CCCFFF;" readonly="true"/> 
                            </td>
                            <td align="left" width="100px"> Status </td>
                            <td>
                                : <input type="text" size="20" name="postatus" value="<?=$fetchPrint['status']?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
                        </tr>
						<tr>
							<td align="left" width="100px"> No Request </td>
							<td>
    							: <input type="text" size="20" name="no_req" value="<?=$fetchPrint['po_reqno']?>" style="background-color:#CCCFFF; " readonly="true" />
                                <input type="hidden" size="20" name="param_no" value="<?=$idPO?>" />
                                <input type="hidden" name="lastno" value="<?=$fetchPrint['no_po']?>" />
							</td>
                            <td align="left" width="100px"> Created By </td>
                            <td>
                                : <input type="text" size="20" name="pocreated" value="<?=$fetchPrint['creator']?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
						</tr>
						<tr>
							<td align="left" width="100px" > Tanggal </td>
							<td>
								: <input type="text" size="12" name="potanggal" value="<?=$fetchPrint['po_tgl']?>" style="background-color:#CCCFFF; " readonly="true" />
							</td>
                            <td align="left" width="100px"> Supplier </td>
                            <td>
                                : <input type="text" size="20" name="posupplier" value="<?=$fetchPrint['supplier']?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
                            <td width="70px" align="right"><input class="noPrint" type="button" value="Print" onclick="window.print()"/></td>
						</tr>
					</table>
                        <br />
                    </td>
                    <tr>
                    <td> &nbsp;</td>
                    <td colspan="2">
<!-- END HEADER  -->
<!-- **********  -->
<!-- START GRID  -->
                    <hr width='97%' align='left' size='3' />
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
                    <table border="0" cellpadding="3" cellspacing="3" style="max-width: 600px; width: 100%;">
                    <tr>
                        <td>
                            <table cellpadding='2' cellspacing='2' width='600px' style="border:1px  solid  #CCCCCC;">
                    		<tr bgcolor="#414141" align='center'>
                    			<th width ="70px"><font color="#FFFFFF" >Kode</font></th>
                    			<th><font color="#FFFFFF">Nama</font></th>            
                                <th width="50px"><font color="#FFFFFF">Req.Qty </th>
                    			<th width="80px"><font color="#FFFFFF">Satuan</font></th>
                                <th width='50px'><font color="#FFFFFF" >PO Qty</font></th>
                    			<th width="90px"><font color="#FFFFFF">Harga</font></th>
                    			<th width='50px'><font color="#FFFFFF" >Disc(%)</font></th>
                                <th width='100px'><font color="#FFFFFF" >Disc(Rp)</font></th>
                                <th width='100px'><font color="#FFFFFF" >Sub Total </font></th>
                            </tr>
                            <tr>
                            <?php
                            $no=1;
                            $temp = mysql_query($strPOPrint);
                            while ($exQueryPrint = mysql_fetch_assoc($temp)){
                                if ($no%2){
                                	echo "<tr valign=top>";
                                }else{
                                	echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
                                }
                                $toField = $exQueryPrint ;
                                for ($i=0;$i<11;$i++){array_pop($toField);}                            
                                foreach ($toField as $key => $val){
                                   print "<td align='center'><input type ='text' name='$key$no' align='center' size=15 value='" . $val ."' readonly='true' style='background-color:#CCCFFF;' /></td>";
                                }
                            }
                            ?>
                            </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                     </div>
                    </td>
                  </tr>                
                </table>
              </form>
           </font>           
        </td>
     </tr>
    <tr>
		<td><img src="#"/></td>
	</tr>
</table>
</fieldset></center>
</body>
</html>