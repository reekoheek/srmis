<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
include "../include/fungsi_rp.php";
include '../action/po_man.php';

?>
<html>
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>PO Approval</title>
	<!-- ALWAYS ON TOP FLOATING LAYER POP-UP -->
	<script language="JavaScript" type="text/javascript">
		<!-- Copyright 2003, Sandeep Gangadharan -->
		<!-- For more free scripts go to http://sivamdesign.com/scripts/ -->
		<!-- Modified 2011, Jalu Ahmad Pambudi -->
		<!--
		var y1 = 100;   // change the # on the left to adjuct the Y co-ordinate
		var y2 = 400;
		(document.getElementById) ? dom = true : dom = false;
		function listPost(no, req, tgl, supp, idsupp, creator){
			if (dom) {
				document.getElementById('pono').value = no;
				document.getElementById('req_no').value= req;
				document.getElementById('potanggal').value= tgl;
				document.getElementById('posupplier').value=supp;
				document.getElementById('lyidsupp').value = idsupp;
				document.getElementById('pocreated').value=creator;
			}
		}    
		function hideItSupplier(id, myname) {
		  if (dom) {
			var isi = myname;
			document.getElementById("lySupplier").style.visibility='hidden';
			document.getElementById("lysupp").value = isi ;
			document.getElementById("lyidsupp").value = id ;
	  //        document.getElementById("addDetail").enabled;
	  		
			}
		}
		function hideItBarang(id, myname, harga, sat, stok) {
		  if (dom) {
			var isi = myname;
			document.getElementById("lyBarang").style.visibility='hidden';
			//document.getElementById("lybar").value = isi ;
			document.getElementById("lybar1").value= isi;
			document.getElementById("lyidBarang").value = id ;
			document.getElementById("lySat").value = sat ;
			document.getElementById("lyHarga").value = harga;
			//document.getElementById("lyStok").value= stok;
	  //        document.getElementById("addDetail").enabled;
		  }
		}
		function showItSupplier() {
		  if (dom) {document.getElementById("lySupplier").style.visibility='visible';}
		}
		function showItBarang() {
		  if (dom) {document.getElementById("lyBarang").style.visibility='visible' ;}
		}
		function showInput() {
		  if (dom) {
			//document.getElementById("lybar").style.visibility='visible';
			document.getElementById("lybar1").style.visibility='visible';
			//document.getElementById("lyStok").style.visibility='visible';
			document.getElementById("lyLabqty").style.visibility='visible';
			document.getElementById("lyLabsat").style.visibility='visible';
			document.getElementById("lyLabharga").style.visibility='visible';
			document.getElementById("lyLabdisc").style.visibility='visible';
			document.getElementById("lyQty").style.visibility='visible';
			document.getElementById("lySat").style.visibility='visible';
			document.getElementById("lyHarga").style.visibility='visible';
			document.getElementById("lyDisc").style.visibility='visible';
			//document.getElementById("lyidBarang").style.visibility='visible';
			document.getElementById("addMore").style.visibility='visible';
			document.getElementById("lyQty").focus();
		  }
		}
		function hideInput() {
		  if (dom) {
			//document.getElementById("lybar").style.visibility='hidden';
			document.getElementById("lybar1").style.visibility='hidden';
			document.getElementById("lyStok").style.visibility='hidden';
			document.getElementById("lyLabqty").style.visibility='hidden';
			document.getElementById("lyLabsat").style.visibility='hidden';
			document.getElementById("lyLabharga").style.visibility='hidden';
			document.getElementById("lyLabdisc").style.visibility='hidden';
			document.getElementById("lyQty").style.visibility='hidden';
			document.getElementById("lySat").style.visibility='hidden';
			document.getElementById("lyHarga").style.visibility = 'hidden';
			document.getElementById("lyDisc").style.visibility='hidden';
			document.getElementById("addMore").style.visibility='hidden';
		  }
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
		function placeItBarang() {

		  if (dom && !document.all) {document.getElementById("lyBarang").style.top = window.pageYOffset + (window.innerHeight - (window.innerHeight-y1)) + "px";}
		  if (document.all) {
			document.all["lyBarang"].style.top = document.documentElement.scrollTop + (document.documentElement.clientHeight - (document.documentElement.clientHeight-y1)) + "px";
		  }
		  window.setTimeout("placeItBarang()", 10);
		}     
		function addToGrid(){
		  var g1= "kodeGrid"+countval;
		  var g2= "namaGrid"+countval;
		  var g3= "satuanGrid"+countval;
		  var g4= "qtyGrid"+countval;
		  var g5= "hargaGrid"+countval;
		  var g6= "discGrid"+countval;
		  var g7= "subGrid"+countval;
		  document.getElementById(g1).style.visibility='visible';
		  document.getElementById(g2).style.visibility='visible';
		  document.getElementById(g3).style.visibility='visible';
		  document.getElementById(g4).style.visibility='visible';
		  document.getElementById(g5).style.visibility='visible';
		  document.getElementById(g6).style.visibility='visible';
		  document.getElementById(g7).style.visibility='visible';
		}
		// -->
	</script>

  </head>
  <body onload="placeItSupplier();placeItBarang();" >
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
	-			<form method="post" action="<?php $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data" id="frmPOManHead" name="frmPOManHead"> 
				<table border="0" cellpadding="2" cellspacing="2" width="100%">
				  <tr>
					<td align="left" width="100px"> No PO  </td>
					<td>
					: <input type="text" size="20" id="pono" name="pono" value="<?php echo 'Auto' ; ?> " style="background-color:#CCCFFF;" readonly="true"/> 
					</td>
					<td align="left" width="100px"> Status </td>
					<td>
					: <input type="text" size="20" id="postatus" name="postatus" value="<?php echo 'Open';?>" style="background-color:#CCCFFF;" readonly="true" />
					</td>
					</tr>
					<tr>
					<td align="left" width="100px"> No Request </td>
					<td>: <input type="text" size="20" id="no_req" name="no_req" value="<?php echo 'MANUAL' ;?>" style="background-color:#CCCFFF; " readonly="true" />
<!--					<input type="hidden" size="20" name="param_no" value="<?php $param_no ; ?>" />
					<input type="hidden" name="lastno" value="<?php $rp['full_no'] ; ?>" />							</td>
-->					<td align="left" width="100px"> Created By </td>
					<td>
					: <input type="text" size="20" id="pocreated" name="pocreated" value="<?php echo $userLoged ; ?>" style="background-color:#CCCFFF;" readonly="true" />
					</td>
				  </tr>
				  <tr>
					<td align="left" width="100px" > Tanggal </td>
					<td>
					: <input type="text" size="12" id="potanggal" name="potanggal" value="<?php echo date('d/m/Y') ; ?>" style="background-color:#CCCFFF; " readonly="true" />
					</td>
					<td align="left" width="100px"> Supplier </td>
					<td>
					  : <input type="text" size="20" id="posupplier" name="posupplier" style="background-color:#CCCFFF;" readonly="true" onclick="showItSupplier();" id="lysupp" />
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
									  <td width=100px><font color=#FFFFFF>Kode Rekanan</font></td>
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
									  <?php	  }else{ ?>
									  <tr bgcolor=#CCCCCC valign=top onclick="hideItSupplier(<?= $idme ?>,'<?= $nameme ?>') ; enablingElement('addDetail'); ">
									  <?php	  } echo "<td align = center>$no"; ?>
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
				  </table>
	<!--			<tr> -->
				<br />
					<!-- LYBARANG -->
					<div id="lyBarang" style="position:absolute; left:20; top:15; width:410px; visibility:hidden"> 
					  <font face="verdana, arial, helvetica, sans-serif" size="1">
						<div style="float:left; background-color:yellow; padding:3px; border:1px solid black">
						 <form id="getDetail" name="getDetail" method="post" action="<?$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
						  <span style="float:right; background-color:gray; color:white; font-weight:bold; width='20px'; text-align:center; cursor:pointer" onclick="javascript:hideItBarang()">
							<b>X</b>
						  </span>
						  <table border="0" cellpadding="0" cellspacing="0" width="100%" id="lyBarang">
							<tr>
							  <td>
								<table border=0 cellpadding=2 cellspacing=2 width=400px>
								  <tr bgcolor=#414141 align=center>
									<td><font color=#FFFFFF>#</font></td>
									<td width=50px><font color=#FFFFFF>Kode Barang</font></td>
									<td><font color=#FFFFFF>Nama</font></td>
									<td width=35px><font color=#FFFFFF>Stock</font></td>
								  </tr>
								  <?php
									$strQBarang = mysql_query ("select * from v_ps where stok_min >= stok and flags <> 9");
									$no = 1;
									while ($result = mysql_fetch_array($strQBarang))
									{
									$idme = $result['id'];
									$nameme= $result['kd_barang']." - ".$result['nama']. "\\nStok: " . $result['stok'];
									$harga = $result['harga_dosp'];
									$satuan = getSingleData("select satuan from ms_barang where id=". $idme);
									$stok = $result['stok'];
									if ($no%2){
								  ?>
								  <tr valign=top onclick="hideItBarang(<?= $idme ?>,'<?= $nameme ?>', '<?= $harga ?>', '<?= $satuan ?>', '<?= $stok ?>'); showInput(); submit();"> 
									<?php	  }else{ ?>
								  <tr bgcolor=#CCCCCC valign=top onclick="hideItBarang(<?= $idme ?>,'<?= $nameme ?>', '<?= $harga ?>', '<?= $satuan ?>', '<?= $stok ?>'); showInput(); submit();">
									<?php  } echo "<td align = center>$no"; ?>
									<input type='hidden' id='idme' value='<?php echo $result['id'] ; ?>' />
									<input type='hidden' id='kode' value='<?php echo $result['kd_barang']; ?>'  />
									<input type='hidden' id='nama' value='<?php echo $result['nama']; ?>'  />																		
									<?php
									echo "</td>
									<td>$result[kd_barang]</td>
									<td>$result[nama]</td>
									<td>$result[stok]</td>
									</tr>";
									$no++;
									}
									?>
							  </table>
							</td>
						  </tr>
						  </table>
						  </form>
						</div>        
					  </font>
					</div>
					<!-- END LYBARANG -->
				<div>
				  <form id="getDetail" name="getDetail" method="post" action="<?$_SERVER['PHP_SELF']?>" enctype="multipart/form-data">
					<input type="button" id="addDetail" value="Add Detail" style="visibility: hidden;" onclick="showItBarang();"/>
					<input type="text" id="lyidBarang" style="visibility: hidden ;" /> &nbsp;<br />					
					<!--<input type="text" id="lybar" readonly="true" size="20" style="visibility: hidden;" /> &nbsp; &nbsp; 
					--><textarea id="lybar1" readonly="true" size="15" style="visibility: hidden; " >  </textarea> 
					<!--<input type="text" id="lyStok" readonly="true" size="5" style="visibility: hidden;" />
					-->&nbsp; <label id="lyLabqty" style="visibility: hidden;"> Qty :</label> <input type="text" id="lyQty" size="4" maxlength="4" style="visibility: hidden;" /> &nbsp; 
					<label id="lyLabsat" style="visibility: hidden;"> Sat :</label> <input type="text" id="lySat" size="4" maxlength="10" style="visibility: hidden;" /> &nbsp;
					<label id="lyLabharga" style="visibility: hidden;"> Harga :</label> <input type="text" id="lyHarga" size="6" maxlength="12" style="visibility: hidden;" /> &nbsp;
					<label id="lyLabdisc" style="visibility: hidden;"> Disc(Rp) :</label> <input type="text" id="lyDisc" size="5" maxlength="5" style="visibility: hidden;" />
					<input type="submit" id="addMore" value="+" style="visibility:hidden;" onclick="enablingElement('submitPP');"/>
				  </form>
				</div>
			  </td>
			</tr>
			<tr>
			  <td> &nbsp;</td>
			  <td>
				<!-- END HEADER  -->
				<!-- **********  -->
				<!-- START GRID  -->
				<form method="post" action="home.php?hal=action/update_po" enctype="multipart/form-data" id="frmPOMan" name="frmPOMan">
				  <hr width="97%" align="left" size="3" />
				  <div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
					<table border="0" cellpadding="3" cellspacing="3" width="100%">
					  <tr>
						<td>                    
						  <table cellpadding='2' cellspacing='2' width='640px' style="border:1px  solid  #CCCCCC;">
							<tr bgcolor="#414141" align='center'>
							  <th width ="70px"><font color="#FFFFFF" >Kode</font></th>
							  <th><font color="#FFFFFF">Nama</font></th>
							  <th width="80px"><font color="#FFFFFF">Satuan</font></th>
							  <th width='50px'><font color="#FFFFFF" >PO Qty</font></th>
							  <th width="90px"><font color="#FFFFFF">Harga</font></th>
							  <th width='85px'><font color="#FFFFFF" >Disc(Rp)</font></th>
							  <th width='105px'><font color="#FFFFFF" >Sub Total </font></th>
							</tr>
							<?php
							  for($i=0;$i<100;$i++){
								$counter= $i+1;
								echo "<tr>
								  <td align='center'>
									<input type='text' id='kodeGrid.$i' readonly='true' size='8' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='namaGrid.$i' readonly='true' size='13' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='satuanGrid.$i' readonly='true' size='9' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='qtyGrid.$i' readonly='true' size ='5' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='hargaGrid.$i' readonly='true' size='10' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='discGrid.$i' readonly='true' size='9' style='visibility: hidden;' />
								  </td>
								  <td align='center'>
									<input type='text' id='subGrid.$i' readonly='true' size= '13' style='visibility: hidden;' />
									<input type='hidden' id='counter' value= '$counter'>
								  </td>
								</tr>";
							  }
							?>
						  </table>
						</td>
					  </tr>
<!--					  <tr>
						<td>
						<hr width="75%" size="3" />
						<hr width="50%" size="3" />
						<hr width="35%" size="3" />
						</td>                        
					  </tr>-->                                             
					  <tr>
						<td align="right" ></td>
					  </tr>
					</table>
				  </div>
				  <br />
				  <!--   END GRID   -->
				  <!-- ************ -->
				  <!-- START FOOTER -->                    
				  <input type="submit" name="submitPP" id="submitPP" value="Create PO" style="visibility: hidden;" />
				</form>
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
<?php
$poNo = $_POST['po_no'];
if (empty($_POST['pono'])){
		echo $_POST['po_no']. "<br /> TOOOOOOOOOOOOOOOOOOOOOOOOOOT";
	}elseif (substr($poNo,0,3) = "PO/"){
		$myPoNow = loadPO($poNo);
		echo $_POST['po_no']. "<br /> TOOOOOOOOOOOOOOOOOOOOOOOOOOT";
	}else {
		$clsMe = new PoMan();		
		if ($_POST['pono'] = 'Auto'){
		$poStatus 		= $_POST['postatus'];
		$poDate			= $_POST['potanggal'];
		$poSupplier		= $_POST['lyidsupp'];
		$poCreator 		= $_POST['pocreated'];
		$myNewPo 		= createPO($poStatus, $poDate, $poSupplier, $poCreator);
		$postedPoNo 	= $myNewPo['pono'];
		$postedReqNo 	= $myNewPo['poReqNo'];
		$postedPoDate 	= $myNewPo['poDate'];
		$postedSuppID 	= $myNewPo['poSupplier'];
		$postedCreator 	= $myNewPo['poCreator'];
		$postedNameSupp = getSingleData("select nama from pbf where id=$postedSuppID");	
		echo "<script type='text/javascript' languange='javascript'> 
		listPost($postedPoNo,$postedReqNo,$postedPoDate,$postedSuppID,$postedNameSupp, $postedCreator); 
		showItBarang();</script>";
		echo $_POST['po_no']. "<br /> TOOOOOOOOOOOOOOOOOOOOOOOOOOT";
	}
}
?>