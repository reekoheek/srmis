<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<?php
	include "../include/koneksi.php";
    include ("../include/fungsi_rp.php");
	
	if ($_GET['hehe'])
	{
		$q=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP='$No_SPP' AND status_detail = '3'");
		$r=mysql_fetch_array($q);
		
		//echo $q;
		if (!$r)
		{
			$qp=("UPDATE permintaan_unit SET status = '8' WHERE No_SPP='$No_SPP'");
			execSQL($qp);
			//echo "masuk update";
		}
		echo "</script><script language=javascript>window.opener.location.reload();window.close();</script><script runat=server>";
	}
		if ($_POST['in']==1)
	{
		
		$ket=$_POST['ket'];
        if(empty($ket)){$ket=$_GET['ket'];}
		$id=$_POST['id'];		
		$No_SPP=$_GET['No_SPP'];
		$UsrRetur=$_POST['UsrRetur'];
		$tgl=date("d/m/Y");
		$query=("UPDATE permintaan_unitdetail SET tgl_retur='$tgl', UsrRetur='$UsrRetur', ket_retur='$ket', status_detail='3' WHERE id='$id'");
        execSQL($query);
		
		
		
		//echo $count;		
		//$rwt=($query);
		//die($query);
		//$result=mysql_fetch_array($query);
		//echo $ket;
		//echo "dapet";
		$hehe=1;
		print "<script>alert('Data Berhasil di Input');location.href='input_buat_pending.php?No_SPP=$No_SPP&hehe=$hehe'</script>";
		
	}
?>

</head>
<body>
<?php

		$no_SPP = $_GET['No_SPP'];
		$UsrRetur=$_GET['UsrRetur'];
		$id = $_GET['id'];
		$qar=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
		$rar=mysql_fetch_array($qar);
		
		$qyu=mysql_query("SELECT * FROM pelayanan WHERE id='$rar[Unit]'");
		$ryu=mysql_fetch_array($qyu);
		
		$qar2=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id = '$id'");
		$rar2=mysql_fetch_array($qar2);

?>

<link rel="stylesheet" type="text/css" href="../include/style.css">
<center><fieldset style="width:60%;"><legend style="background-color:#1bda01;"><b><font color="#fefafa" style="font-size:14px;">&nbsp;&nbsp;Input Retur&nbsp;&nbsp;</font></b></legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<form method="post" name="form" action="input_buat_retur.php?No_SPP=<?=$rar2['No_SPP']?>&id=<?=$rar2['id']?>&in=1">
<input type="hidden" name="in" value="1"/>
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
                          <td align="left" width="100">No BPB </td>
							<td><input type="text" size="20" name="no_BPB" value="<?= $rar['No_BPB']?>" style="background-color:#CCCFFF; " readonly="true">
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
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
					  	<td>Unit</td>
						<td><input type="text" name="unit" value="<?= $ryu['nama_lain']?>" readonly="true" style="background-color:#CCCFFF; " size="40"></td>
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr>
					  	<td>Kode Barang</td>
						<td><input type="text" name="kd_barang" value="<?= $rar2['barang_id']?>" readonly="true" style="background-color:#CCCFFF; " size="20"></td>
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr>
					  	<td>Nama Barang</td>
						<td><input type="text" name="nama_barang" value="<?= $rar2['Nm_Barang']?>" readonly="true" style="background-color:#CCCFFF; " size="20"></td>
						<td width="70px" align="right">
						</td>
					  </tr>
					  <tr valign="top">
					  	<td>Keterangan Retur</td>
						<td valign="top"><textarea name="ket" style="width:160px; height:60px; "></textarea></td>
                        
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
					<hr>
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							
							</td>
						</tr>
						<tr>
							<td>
								
								<table width="100%">
									<tr>
									<td>
									<table width="100%">
										<tr>
											<td width="100">User Buat</td>
											<td><input type="text" size="30" name="" value="<?=$rar['UsrBuat']?>"  readonly="true" style="background-color:#CCCFFF; "></td>
										</tr>
										<tr>
											<td width="100">User Approve </td>
											<td><input type="text" size="30" name="" value="<?=$rar['UsrApprove']?>"  readonly="true" style="background-color:#CCCFFF; "></td>
										</tr>
									</table>
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
