<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<?php
	include "../include/koneksi.php";
    include ("../include/fungsi_rp.php");
	
	$tgl=date("d/m/Y");;
	
	if ($_GET['hehe'])
	{
		
		echo "</script><script language=javascript>window.opener.location.reload();window.close();</script><script runat=server>";
	}
	
	
	if ($_POST['in']==1)
	{
		$q=mysql_query("SELECT * FROM stok_opname WHERE tgl = '$tgl'");
		$r=mysql_fetch_array($q);
		if (!$r)
		{
			$qms_barang=mysql_query("SELECT * FROM ms_barang ORDER BY id ASC");
			while ($rms_barang=mysql_fetch_array($qms_barang))
			{
				$q_apt=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='2'");
				$r_apt=mysql_fetch_array($q_apt);
			
				$q_rj=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='4'");
				$r_rj=mysql_fetch_array($q_rj);
			
				$q_ri=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='50'");
				$r_ri=mysql_fetch_array($q_ri);
			
				$q_igd=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='51'");
				$r_igd=mysql_fetch_array($q_igd);
			
				$q_oca=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='52'");
				$r_oca=mysql_fetch_array($q_oca);

				$q_lab=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='87'");
				$r_lab=mysql_fetch_array($q_lab);

				$q_rad=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$rms_barang[id]' AND unit_id='91'");
				$r_rad=mysql_fetch_array($q_rad);
			
				$stok_ms=$rms_barang['stok'];
				$stok_apt=$r_apt['stok'];
				$stok_rj=$r_rj['stok'];
				$stok_ri=$r_ri['stok'];
				$stok_igd=$r_igd['stok'];
				$stok_oca=$r_oca['stok'];
				$stok_lab=$r_lab['stok'];
				$stok_rad=$r_rad['stok'];
			
				$jumlah = $stok_ms + $stok_apt + $stok_rj + $stok_ri + $stok_igd + $stok_oca + $stok_lab + $stok_rad; 
			
			
				$query = "INSERT INTO stok_opname (barang_id, stok_ms, stok_apt, stok_rj, stok_ri, stok_igd, stok_oca, stok_lab, stok_rad, jumlah, tgl, created_datetime, created_user)
					  	  VALUES ('$rms_barang[id]','$stok_ms','$stok_apt','$stok_rj','$stok_ri','$stok_igd','$stok_oca','$stok_lab','$stok_rad','$jumlah','$tgl',now(),'".$_SESSION['U_USER']."')";
				execSQL($query);
				}
			$hehe=1;
			print "<script>alert('Data Berhasil di Input');location.href='input_stok_opname.php?&hehe=$hehe'</script>";
			}
			else
			{
				$hehe=1;
				print "<script>alert('Stok Opname Tanggal $tgl Sudah ada.');location.href='input_stok_opname.php?&hehe=$hehe'</script>";
			}
		}
?>

</head>
<body>

<link rel="stylesheet" type="text/css" href="../include/style.css">
<center><fieldset style="width:60%;"><legend style="background-color:#9b9999;"><b><font color="#fefafa" style="font-size:14px;">&nbsp;&nbsp;Input Stok Opname&nbsp;&nbsp;</font></b></legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="post" name="form" action="input_stok_opname.php?tgl=<?=$tgl?>&in=1">
<input type="hidden" name="in" value="1"/>
<input type="hidden" name="tgl" value="<?= $tgl?>"/>
	<tr>
		<td><img src="images/#.png"></td>
	</tr>
	<tr>
		<td id="" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
					<tr>
						<td align="left" width="100" colspan="2">Tanggal </td>
						<td width="70px" align="right"></td>
					</tr>
					<tr>
						  <?php
						  	$date=date("d/m/Y");
						  ?>
                          <td align="left" width="100"><INPUT name="tgl" readonly="true" value="<?= $date?>"> </td>
						  <td><input type="submit" value="Buat"></td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right"></td>
					  </tr>
					</table>
					</form>
					</font>
					</td>
					<td width="15px"><p>&nbsp;</p>
				    <p>&nbsp;</p></td>
					
				</tr>
			</table>
			
	</tr>
	<tr>
		<td><img src="#"></td>
	</tr>
</table>
</fieldset></center>
</body>
</html>
