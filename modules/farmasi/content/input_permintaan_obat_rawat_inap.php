<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
	if(($_GET['No_SPP']) OR ($_GET['no_SPP']))
	{
		if ($_GET['No_SPP'])
		{
		$no_SPP = $_GET['No_SPP'];
		}
		else
		{
		$no_SPP = $_GET['no_SPP'];
		}
		$date = $_GET['date'];
		$id = $_GET['id'];
		$tgl=$_GET['Tgl_SPP'];
	
	}
	if ($_POST['no_SPP'])
	{
		$no_SPP = $_POST['no_SPP'];
		$date = $_POST['date'];
		$id = $_POST['id'];
		$tgl=$_POST['tgl'];
	}
	$kd_barang = $_POST['kd_barang'];
	
	$qms=mysql_query("select * from ms_barang where kd_barang='$kd_barang'");
	$rms=mysql_fetch_array($qms);
	$qb = mysql_query ("SELECT * FROM barang_unit WHERE barang_id = '$rms[id]'");
	$rb = mysql_fetch_array($qb);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:13px; " color="#fefafa"><b>Input Permintaan Pemakaian Obat</b></font></td>
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
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top">
					<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="70%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					
					<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_permintaan_obat_rawat_inap">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="no_SPP" value="<?=$no_SPP?>">
						<input type="hidden" readonly="true" value="<?=$id?>" name="id">
						<input type="hidden" name="tgl" value="<?= $tgl?>" readonly="true">
						<input type="hidden" name="kd_barang" value="<?=$rms['kd_barang']?>">
						
						<tr>
							<td align="left" width="200"><font color="#FF0000">Nama Obat* :</font> </td>
							<td><input type="text" name="nama" value="<?=$rms['nama']?>" size="40" readonly="true"></td>
						</tr>
						<tr>
							<?php
								$qs = mysql_query("SELECT * FROM satuan WHERE kd_satuan = '$rms[satuan]'");
								$rs = mysql_fetch_array($qs);
							?>
							<td align="left" width="200">Satuan :</td>
							<td><input type="text" name="satuan" value="<?=$rs['deskripsi']?>" size="15" readonly="true"></td>
						</tr>
						<tr>
							<td align="left" width="200">Expired :</td>
							<td><input type="text" name="expired" value="<?=$rms['expire_date']?>" size="12" readonly="true"></td>
						</tr>
						<tr>
							<td align="left" width="200">Stok Gudang Apotek :</td>
							<td><input type="text" name="Stokgudang" value="<?=$rms['stok']?>" size="5" readonly="true" disabled="disabled"></td>
						</tr>
						<tr>
							<td align="left">Jumlah Permintaan: </td>
							<td><input type="text" name="jumlah" size="5" value=""></td>
						</tr>
						<tr>
							<td align="left" valign="top">Keterangan : </td>
							<td><textarea name="keterangan" style="width:210px; height:60px; "></textarea>                            </td>
						</tr>
						<tr>
							<td align="left">Tanggal Pakai : </td>
							<td><INPUT name="tgl_pakai" id="date1" class="date-pick" readonly="true"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan">&nbsp;<input type="reset" value="Reset">&nbsp;&nbsp;<input type="button" onClick="javascript:history.go(-1)" value="Back"></td>
						</tr>
					</table>
					</form>
					
					</td>
					<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:1px;"></td>
						</tr>
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=content/daftar_permintaan_obat_rawat_inap">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_SPP?>" name="no_SPP">
								<input type="hidden" readonly="true" value="<?=$tgl?>" name="tgl">
								
								&nbsp;<input type="submit" value="Pilih"> &nbsp;
								</form>
							</td>
						</tr>
					</table>
					</td>
				</tr>
			</table>
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>
