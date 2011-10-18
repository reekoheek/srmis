<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<?php
	include "../include/koneksi.php";
    include ("../include/fungsi_rp.php");
	
	
	$kd_barang=$_GET['kd_barang'];
	$id=$_GET['id'];
	$No_SPP=$_GET['No_SPP'];
	$status=$_GET['status'];
	$No_BPB=$_GET['No_BPB'];
	$id_ms=$_GET['id_ms'];
	$no_SPP=$_POST['no_SPP'];
	$stat=$_POST['stat'];
	
	if ($_GET['hehe']=='1')
	{
		echo "</script><script language=javascript>window.opener.location.reload();window.close();</script><script runat=server>";
	}
	
	if ($_POST['in']==1)
	{
		if ($_POST['Qty_diberi']=="")
		{
			print "<script>alert('Harap Isi Jumlahh yang diberi.');location.href='input_distribusi_kontrol.php?id_ms=$id_ms&id=$id&No_SPP=$No_SPP&No_BPB=$No_BPB'</script>";
		}
		else
		{
			$qq=mysql_query("SELECT * FROM ms_barang WHERE id='$id_ms'");
			$rq=mysql_fetch_array($qq);
			$stok_ms=$rq['stok'];
	
			$qu=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id='$id'");
			$ru=mysql_fetch_array($qu);
			$Qty_diberi=$_POST['Qty_diberi'];
			//$qty=$ru['Qty'];
	
			$jml_sisa=$stok_ms-$Qty_diberi;
	
			$q=mysql_query("UPDATE permintaan_unitdetail SET Qty_diberi='$Qty_diberi', status_detail='2',No_BPB='$No_BPB' WHERE id='$id'");
			$qr2=mysql_query("UPDATE ms_barang SET stok='$jml_sisa' WHERE id='$id_ms'");
			
			$hehe=1;
			print "<script>alert('Data Berhasil di APPROVE.');location.href='input_distribusi_kontrol.php?No_SPP=$No_SPP&No_BPB=$No_BPB&hehe=$hehe'</script>";
		}
	}
	
?>

</head>
<body>
<?php


		$qar=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
		$rar=mysql_fetch_array($qar);
		
		$qar2=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id = '$id'");
		$rar2=mysql_fetch_array($qar2);

?>

<link rel="stylesheet" type="text/css" href="../include/style.css">
<center><fieldset style="width:60%;"><legend style="background-color:#9b9999;"><b><font color="#fefafa" style="font-size:14px;">&nbsp;&nbsp;Input Approval&nbsp;&nbsp;</font></b></legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="post" name="form" action="input_distribusi_kontrol.php?No_SPP=<?=$rar2['No_SPP']?>&id=<?=$rar2['id']?>&in=1&id_ms=<?=$id_ms?>">
<input type="hidden" name="in" value="1"/>
<input type="hidden" name="id" value="<?=$rar2['id']?>"/>
<input type="hidden" name="id_ms" value="<?=$id_ms?>"/>
<input type="hidden" name="UsrRetur" value="<?= $UsrRetur?>"/>
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
                          <td align="left" width="100">No SPP </td>
							<td><input type="text" size="20" name="No_SPP" value="<?= $_GET['No_SPP']?>" style="background-color:#CCCFFF; " readonly="true">
							<input type="hidden" size="20" name="id" value="<?= $id?>">							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					  <tr>
					  	<td>Nama Barang</td>
						<td><input type="text" name="nama_barang" value="<?= $rar2['Nm_Barang']?>" readonly="true" style="background-color:#CCCFFF; " size="20"></td>
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr valign="top">
					  	<td>Stok</td>
						<?php
						$qq2=mysql_query("SELECT * FROM ms_barang WHERE id='$id_ms'");
						$rq2=mysql_fetch_array($qq2);

						?>
						<td valign="top"><input type="text" name="stok" value="<?=$rq2['stok']?>" size="8" disabled></td>
                        
						<td width="70px" align="right">
						</td>
					  </tr>

					  <tr valign="top">
					  	<td>Jml Permintaan</td>
						<td valign="top"><input type="text" name="Qty" value="<?=$rar2['Qty']?>" size="8"></td>
                        
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr valign="top">
					  	<td>Jml Diberi</td>
						<td valign="top"><input type="text" name="Qty_diberi" value=""  size="8"></td>
                        
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr>
					  	<td></td>
						<td><input type="submit" value="Simpan" /></td>
						<td></td>
					  </tr>
					</form>	
					</table>
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							
							</td>
						</tr>
						<tr>
							<td>
								
								
									</td>
									<td align="right" valign="top">
										
									</td>
									</tr>
							  </table>	
							</td>
						</tr>
						
					</table>
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
