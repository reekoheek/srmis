<?
session_start();
include "../include/koneksi.php";
include "../include/fungsi_rp.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<!-- pop up jquery -->
<link rel="stylesheet" href="include/general.css" type="text/css" media="screen" />
<script src="include/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="include/popup.js" type="text/javascript"></script>
<script src="include/popup2.js" type="text/javascript"></script>
<!-- end pop up jquery-->


<!-- pop up windows-->
<script>
function PopupCenter(pageURL, title,w,h) {
//var left = (screen.width/2)-(w/2);
//var top = (screen.height/2)-(h/2);
var targetWin = window.open 
//(pageURL, title, 'toolbar=no, alwaysraised=yes, fullscreen=true location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top='+top+', left='+left);
(pageURL, title, 'toolbar=no, alwaysraised='+1+', fullScreen=no, locationbar=no, location=0, directories=no, status=no, menubar=0, scrollbars=yes, resizable=0, copyhistory=0, width=600, height=500, top=100, left=400');
this.targetWin.focus();
}
</script>

<!-- suggestion -->


<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_pasien.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue,thisValue2) {
		$('#inputString').val(thisValue);
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->
<link rel="stylesheet" type="text/css" href="../include/style.css">
<style>
.suggestionsBox {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}

</style>


</head>
<body>
<?php
//if(!$_GET['no_resep'])
//{
//awal insert no resep
// 50=rawat inap
// 51=igd
// 52=oca
// 4=rawat jalan


//$qp= mysql_query("SELECT * FROM resep_head WHERE LAST_INSERT_ID(param_no) and no_resep like 'IGD%' ORDER BY id DESC LIMIT 1");
//$rp = mysql_fetch_array($qp);


/* $tanggal_sekarang=date("d/m/Y");
//$month=substr($rp['tgl'],3,2);
$date=date("m");

$tgl = substr($rp['tgl'],3,2);


if ($tgl == $date)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

//cek untuk ketersediaan record
if (!$rp)
{
	$temp = 1;
	$count = $temp;
}


$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);



$kd="IGD/";
	
$no_resep = $kd . date("dmy")."$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;

*/

//}
//akhir counter
//else
//{
	$id_p = $_GET['id_pasien'];
	$qar = mysql_query("SELECT * FROM simrs.pasien WHERE id='$id_p'");
	$rar = mysql_fetch_array($qar);
	$namapasien=$_GET['namapasien'];

	$no_resep=$_GET['no_resep'];
	$param_no=$_GET['param_no'];


	$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$id_p' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	$re=mysql_fetch_array($qe);
//}					

	//untuk biaya pembayaran

	$qq=mysql_query("SELECT * FROM margin WHERE klasifikasi_pasien='$re[cara_bayar]'");
	$rq=mysql_fetch_array($qq);
	if ($rq)
	{
		$margin=$rq['margin'] / 100;
		$tampil=$margin;
	}
	else
	{
		$margin=30/100;
		$tampil=30;
	}
					
	$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$no_resep'");
	$r3=mysql_fetch_array($q3);
	//$sub = $r3['SUM(sub_total)'];
	

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px"></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<font style="font-size:12px;">
					<fieldset><legend><strong> [ Resep Pasien ] </strong></legend>
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td width="100">No Resep </td>
							<td><input type="text" name="no_resep" value="<?=$no_resep?>" readonly="true" size="17" style="background-color:#CCCFFF;"></td>
							<td width="80"></td>
						</tr>
						<tr>
							
							<td>No. RM</td>
							<td>
				<div id="container">			<? if(!$_GET['id_pasien']){ ?> <input type="text" align="center" name="no_rm" size="18" value="-" readonly="true"><? }else{ ?>
							<input type="text" name="no_rm" readonly="true" size="17" style="background-color:#CCCFFF; " value="<? echo $id_p; ?>"></div>
							<? } ?></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><?php
							if ($_GET['id_pasien'])
							{
							?>
							  
                              <input type="text" name="nama_pasien" value="<?= $rar['nama'] ?>" readonly="true" size="40" style="background-color:#CCCFFF; ">
                              <?php
							}
							else
							{
							?>
                              <input type="text" name="nama_pasien" value="<?=$namapasien?>"  size="40" readonly="true" style="background-color:#CCCFFF; ">
                              <?php
							}
							?>
                          </td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
						  <td>Jenis Pembayaran </td>
						  <td><?php
							if ($_GET['id_pasien'])
							{
							?>
                            <input type="text" name="jenis" value="<?= $re['cara_bayar'] ?>" readonly="true" size="30" style="background-color:#CCCFFF;" readonly="true">
                            <?php
							}
							else
							{
							?>
                            <input type="text" name="jenis" value="Tunai" readonly="true" size="30" style="background-color:#CCCFFF; ">
                            <?php
							}
							?></td>
							</tr>
						
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$stot=0;
									$q = mysql_query ("SELECT * FROM resep WHERE no_resep = '$no_resep'");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=550px>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=60px>Kode</font></td>
												<td><font color=#FFFFFF width=120px>Obat</font></td>
												<td><font color=#FFFFFF width=20px>Racikan</font></td>
												<td><font color=#FFFFFF width=80px>Dosis</font></td>
												<td><font color=#FFFFFF width=30px>Jml</font></td>
												<td><font color=#FFFFFF width=100px>Harga</font></td>
												<td><font color=#FFFFFF width=100px>Subtotal</font></td>		

											</tr>';
									$no = 1;
									while ($r = mysql_fetch_array($q))
									{
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
										$qbu = mysql_query("select * from barang_unit where barang_id='$ro[id] and unit_id=2'");
										$rbu = mysql_fetch_array($qbu);
										
										$qd = mysql_query ("SELECT * FROM dosis WHERE id = '$r[dosis_id]'");
										$rd = mysql_fetch_array($qd);
										
										$q2 = mysql_query ("SELECT * FROM racik_head WHERE no_racik = '$r[fld02]'");
										$r2 = mysql_fetch_array($q2);
										
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>";
											if ($r['racikan']=='YA')
											{
												echo "$r2[no_racik]";
											}
											else
											{
												echo "$ro[kd_barang]";
											}
											echo "</td>";
											if($r['racikan']=='YA')
											{
												echo "<td><a href='javascript:void(0);' onClick=\"PopupCenter('daftar_racik.php?no_racik=$r2[no_racik]&no_resep=$r2[no_resep]', 'myPop1',800,400);\">$r2[nama]</a></td>";
											}
											else
											{
												echo "<td>$ro[nama]</td>";
											}
											echo "<td>";
											if ($r['racikan']=='YA')
											{
												echo "$r[racikan]";
											}
											else
											{
												echo "-";
											}
											echo "</td>
											<td>$rd[deskripsi] ($r[ket])</td>
											<td>";
											if ($r['racikan']=='YA')
											{
												echo "-";
											}
											else
											{
												echo "$r[diminta]";
											}
											
										echo "</td>
										
										<td align=right>";
												if ($r['racikan']=='YA')
												{
													echo "-";
												}
												else
												{
											 		rupiah($rbu['fld02']);
												}
										echo "</td>";
										if ($r['racikan']=='YA')
											{
											echo"<td align=right>";
												$tot=$r2['total'];
											 	rupiah($tot);
										echo "</td>";
											}else
											{
											echo"<td align=right>";
												$tot=($rbu['fld02']*$r['diminta'])+500;
											 	rupiah($tot);
										echo "</td>";
											}
											
											echo"</tr>";
											$stot=$stot+$tot;
										$no++;
									}
									echo '</table>';
									$potongan = $margin * $stot;
									$tampil=$margin*100;
									//$grand = $sub + $potongan;
									$grand = $stot + $potongan;
								?>
								
							</td>
						</tr>
					</table>
					<hr>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
					<tr>
							<td align="right"><font size="-2">Sub Total : <input type="text" name="sub_tot" size="16" value="<?php rupiah($stot)?>"></font></td>
					</tr>
					<tr>
							<td align="right"><font size="-2">Margin : <input type="text" name="potongan" size="20" value="<?= $tampil."%" ?> (<?php rupiah($potongan)?>)"></font></td>
					</tr>
					<tr>
							<td align="right"><font size="-2">Grand Total : <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>"></font></td>
						</tr>
					<tr>
						<td><hr></td>
					</tr>
					<tr>
					<td colspan="5" align="right"><form method="post" action="../action/insert_app_from_unit.php">
					<input type="hidden" name="no_resep" value="<?=$no_resep?>">
					<input type="submit" name="app" value="Approve"></form></td>
					</tr>
	
							
					</table>
					</font>
					
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table></fieldset>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>