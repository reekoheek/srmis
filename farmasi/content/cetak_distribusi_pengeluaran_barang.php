<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
	if ($_POST['tgl'])
	{
		$tgl = $_POST['tgl'];
		$unit = $_POST['unit'];
		print "<script>location:PopupCenter('content/cetak_distribusi_pengeluaran.php?tgl=$tgl&unit=$unit', 'myPop1',800,600);</script>";
	}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;
					<font style="font-size:14px; " color="#fefafa"><b>Cetak Bukti Pengeluaran Barang</b></font>
				</td>
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
					<font style="font-size:12px; ">
					<form method="post" action="home.php?hal=content/cetak_distribusi_pengeluaran_barang">
					<table width="50%" align="center">
						<tr>
							<td>Tertanggal</td>
							<td width="100px"><input name="tgl" id="date1" class="date-pick" readonly="true"/></td>
							<td align="left" width="150px"></td>
						</tr>
						<tr>
							<td>Unit</td>
							<td width="100px">
								<select name="unit">
									<option value="">Semua Unit</option>
									<option value="2">Apotik</option>
									<option value="51">IGD</option>
									<option value="52">OKA</option>
									<option value="4">Rawat Jalan</option>
									<option value="50">Rawat Inap</option>
									<option value="87">Laboratorium</option>
									<option value="91">Radiologi</option>
								</select></td>
							<td align="left" width="150px"><input type="submit" value="cari"/></td>
						</tr>
					</table>
					</form>
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
