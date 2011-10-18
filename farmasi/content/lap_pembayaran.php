<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
	$year = date("Y");
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Laporan Pembayaran Copy Resep</b></font></td>
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
					<td valign="top"><br>
					<font style="font-size:12px; ">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>Laporan Pembayaran Copy Resep Per Hari</td>
						</tr>
						<tr>
							<td>
							<form method="post" action="content/cetak_lap_pembayaran_hari.php" target="_blank" enctype="multipart/form-data">
							<select name="date">
								<?php
									$i=1;
									while ($i <= 31)
									{
										echo "<option value=$i>$i</option>";
										$i++;
									}
								?>
							</select> &nbsp; - &nbsp;
							
							<select name="month">
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select> &nbsp; - &nbsp;
								
							<select name="year">
								<?php
									$thn=2009;
									while ($thn <= $year)
									{
										echo "<option value=$thn>$thn</option>";
										$thn++;
									}
								?>
							</select> &nbsp;&nbsp;
							<input type="submit" value="Lihat">
							</form>
							</td>
						</tr>
					</table>
					<br><hr><br>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>Laporan Pembayaran Copy Resep Per Bulan</td>
						</tr>
						<tr>
							<td>
							<form method="post" action="content/cetak_lap_pembayaran_bulan.php" target="_blank" enctype="multipart/form-data">
							<select name="month">
								<option value="01">Januari</option>
								<option value="02">Februari</option>
								<option value="03">Maret</option>
								<option value="04">April</option>
								<option value="05">Mei</option>
								<option value="06">Juni</option>
								<option value="07">Juli</option>
								<option value="08">Agustus</option>
								<option value="09">September</option>
								<option value="10">Oktober</option>
								<option value="11">November</option>
								<option value="12">Desember</option>
							</select> &nbsp; - &nbsp;
								
							<select name="year">
								<?php
									$thn=2009;
									while ($thn <= $year)
									{
										echo "<option value=$thn>$thn</option>";
										$thn++;
									}
								?>
							</select> &nbsp;&nbsp;
							<input type="submit" value="Lihat">
							</form>
							</td>
						</tr>
					</table>
					<br><hr><br>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>Laporan Pembayaran Copy Resep Per Tahun</td>
						</tr>
						<tr>
							<td>
							<form method="post" action="content/cetak_lap_pembayaran_tahun.php" target="_blank" enctype="multipart/form-data">
							<select name="year">
								<?php
									$thn=2009;
									while ($thn <= $year)
									{
										echo "<option value=$thn>$thn</option>";
										$thn++;
									}
								?>
							</select> &nbsp;&nbsp;
							<input type="submit" value="Lihat">
							</form>
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
