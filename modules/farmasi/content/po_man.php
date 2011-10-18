<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PO Approval</title>
<!-- ALWAYS ON TOP FLOATING LAYER POP-UP -->

<script language="JavaScript" type="text/javascript">
    <!-- Copyright 2003, Sandeep Gangadharan -->
    <!-- For more free scripts go to http://sivamdesign.com/scripts/ -->
    <!--
    var y1 = 100;   // change the # on the left to adjuct the Y co-ordinate
    var y2 = 400;
    (document.getElementById) ? dom = true : dom = false;    
    function hideItSupplier(id, myname) {
      if (dom) {
        var isi = myname;
        document.getElementById("lySupplier").style.visibility='hidden';
        document.getElementById("lysupp").value = isi ;
        document.getElementById("lyidsupp").value = id ;
//        document.getElementById("addDetail").enabled;
        }
    }
    function showItSupplier() {
      if (dom) {document.getElementById("lySupplier").style.visibility='visible';}
    }
    function enablingElement(element){
        if (dom) {document.getElementById(element).style.visibility='visible';}
    }    
    function disablingElement (element){
        if (dom) {document.getElementById(element).style.visibility= 'hidden';}
    }
    function placeItSupplier() {
      if (dom && !document.all) {document.getElementById("lySupplier").style.top = window.pageYOffset + (window.innerHeight - (window.innerHeight-y1)) + "px";}
      if (document.all) {
            document.all["lySupplier"].style.top = document.documentElement.scrollTop + (document.documentElement.clientHeight - (document.documentElement.clientHeight-y1)) + "px";
        }
            window.setTimeout("placeItSupplier()", 10);
      }
    // -->
</script>

</head>
<body onload="placeItSupplier();" >
<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 * @link home.php?hal=content/po_processing
 * @todo ALL QUERY SHALL CONVERT TO STORED PROCEDURES, 
 *       FOR IT'S WILL EASIER TO MAINTAINCE.
 */

/* ################################# */
/*   CATCHING NEEDED PARAMETERS      */
/* ################################# */


?>
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
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
                    <form method="post" action="home.php?hal=boo" enctype="multipart/form-data" id="frmPOMan" name="frmPOMan">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td align="left" width="100px"> No PO  </td>
                            <td>
                                : <input type="text" size="20" name="pono" value="<?php echo 'Auto' ; ?> " style="background-color:#CCCFFF;" readonly="true"/> 
                            </td>
                            <td align="left" width="100px"> Status </td>
                            <td>
                                : <input type="text" size="20" name="postatus" value="<?php echo 'Open';?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
                        </tr>
						<tr>
							<td align="left" width="100px"> No Request </td>
							<td>
    							: <input type="text" size="20" name="no_req" value="<?php echo 'MANUAL' ;?>" style="background-color:#CCCFFF; " readonly="true" />
                                <input type="hidden" size="20" name="param_no" value="<?php $param_no ; ?>" />
                                <input type="hidden" name="lastno" value="<?php $rp['full_no'] ; ?>" />
							</td>
                            <td align="left" width="100px"> Created By </td>
                            <td>
                                : <input type="text" size="20" name="pocreated" value="<?php echo $userLoged ; ?>" style="background-color:#CCCFFF;" readonly="true" />
                            </td>
						</tr>
						<tr>
							<td align="left" width="100px" > Tanggal </td>
							<td>
								: <input type="text" size="12" name="potanggal" value="<?php echo date('d/m/Y') ; ?>" style="background-color:#CCCFFF; " readonly="true" />
							</td>
                            <td align="left" width="100px"> Supplier </td>
                            <td>
                                : <input type="text" size="20" name="posupplier" style="background-color:#CCCFFF;" readonly="true" onclick="showItSupplier();" id="lysupp" />
                                <input type="hidden" id="lyidsupp" />
                                <input type="button" value="..." onclick="showItSupplier()" />

<div id="lySupplier" style="position:absolute; left:20; width:410px; visibility:hidden"> 
<font face="verdana, arial, helvetica, sans-serif" size="1">
<div style="float:left; background-color:yellow; padding:3px; border:1px solid black">
<span style="float:right; background-color:gray; color:white; font-weight:bold; width='20px'; text-align:center; cursor:pointer" onclick="javascript:hideItSupplier()">
<b>X</b>
</span>
<table border="0" cellpadding="0" cellspacing="0" width="100%" id="lySupplier">
  <tr>
    <td>
      <table border=0 cellpadding=2 cellspacing=2 width=400px>
		<tr bgcolor=#414141 align=center>
			<td><font color=#FFFFFF>#</font></td>
			<td><font color=#FFFFFF>Kode Rekanan</font></td>
			<td><font color=#FFFFFF>Nama</font></td>
		</tr>
    	<?php
    		$q = mysql_query ("SELECT * FROM pbf");
    		$no = 1;
    		while ($r = mysql_fetch_array($q))
    		{
    		  $idme = $r['id'];
              $nameme= $r['nama'];
    			if ($no%2){
	   ?>
    			     <tr valign=top onclick="hideItSupplier(<?= $idme ?>,'<?= $nameme ?>'); enablingElement('addDetail');"> 
       <?php   }else{
       ?>
    			     <tr bgcolor=#CCCCCC valign=top onclick="hideItSupplier(<?= $idme ?>,'<?= $nameme ?>') ; enablingElement('addDetail');">
       <?php    }

                    echo "<td align = center>$no";
       ?>
                      <input type='hidden' name='idme' value='<?php echo $r[id] ; ?>' />
       <?php
                    echo "</td>
    				<td>$r[kd_rekanan]</td>
    				<td>$r[nama]</td>
    				</tr>";
    			$no++;
    		}
    	?>
       </table>
     </td>
  </tr>
</table>
</div>        
</font>
</div>



                            </td>
						</tr>
                        <tr>

					</table>
                    <br />
                        <div>
                        <form id="getDetail" name="getDetail" method="post" action="home.php?hal=content/listbarang" enctype="multipart/form-data">
                            <input type="submit" id="addDetail" value="Add Detail" style="visibility: hidden;" />
                        </form>
                        </div>
                    </td>
                    <tr>
                    <td> &nbsp;</td>
                    <td>
<!-- END HEADER  -->
<!-- **********  -->
<!-- START GRID  -->
                    <hr width="97%" align="left" size="3" />
					<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
                    <form method="post" action="home.php?hal=action/update_po" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
                        <form method="post" action="home.php?hal=action/generate_po" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
                          <table border="0" cellpadding="3" cellspacing="3" width="100%">
                            <tr>
                                <td>
                                    <table cellpadding='2' cellspacing='2' width='800px' style="border:1px  solid  #CCCCCC;">
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
                                   </table>
                                </td>
                            	</tr>
                                <tr>
                                <td>
                                    <hr width="75%" size="3" />
                                    <hr width="50%" size="3" />
                                    <hr width="35%" size="3" />
                                </td>                        
                                </tr>                                             
                                <tr>
                                    <td align="right" >
                                        <input type="submit" name="submitPP" id="submitPP" value="Create PO" style="visibility: hidden;" onclick="enablingElement('submitPP')"/>
                                    </td>
                                </tr>
                        </table>
                      </form>
                    </div>
<!--   END GRID   -->
<!-- ************ -->
<!-- START FOOTER -->
                    </td>
                </tr>
           </table>
           </font>           
        </td>
     </tr>
     <tr>
        <td colspan="5"><img src="images/bawah_isi.png" /></td>
     </tr>
</table>

