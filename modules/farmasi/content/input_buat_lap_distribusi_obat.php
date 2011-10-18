<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

</head>
<body>
<?php
	$cari = $_POST['cari'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<?php
					if ($_GET['f']=='1')
					{
						$tampil="Bukti Penerimaan Barang ";
					}
					elseif ($_GET['f']=='2')
					{
						$tampil="Bukti Pengeluaran Barang ";
					}
					else
					{
						$tampil="Distribusi Permintaan Obat ";
					}
				?>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"><?= $tampil?> </font></b></td>
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
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">						<br>	
					<table border="0" cellpadding="0" cellspacing="0" width="60%">
						<tr>
							<td align="right">Dari&nbsp;&nbsp;</td>
							<td align="right">  <INPUT name="tgl_mulai" id="date1" class="date-pick" readonly="true"></td>
							<td align="right">s.d&nbsp;&nbsp;</td>
							<td align="right">  <INPUT name="tgl_selesai" id="date2" class="date-pick" readonly="true"></td>
							<td align="left"><input type="submit" value="Laporan Excel"></td>
						</tr>
					</table><br><hr><br>
					
					<table border="0" cellpadding="0" cellspacing="0" width="60%">
						<tr>
							<td align="right">Dari&nbsp;&nbsp;</td>
							<td align="right">  <INPUT name="tgl_mulai" id="date1" class="date-pick" readonly="true"></td>
							<td align="right">s.d&nbsp;&nbsp;</td>
							<td align="right">  <INPUT name="tgl_selesai" id="date2" class="date-pick" readonly="true"></td>
							<td align="left"><input type="submit" value="Laporan PDF"></td>
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
