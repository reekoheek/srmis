<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Transaksi pembelian</b></font></td>
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
					<font style="font-size:12px;">
					<?php
						$q= mysql_query("SELECT * FROM pembelian WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
						$r = mysql_fetch_array($q);
						$temp = $r['param_no'];
						$count = $temp;
						$digit1 = (int) ($count % 10);
						$digit2 = (int) (($count % 100) / 10);
						$digit3 = (int) (($count % 1000) / 100);
						$digit4 = (int) (($count % 10000) / 1000);
						$digit5 = (int) (($count % 100000) / 10000);
						$digit6 = (int) (($count % 1000000) / 100000);
						$digit7 = (int) (($count % 10000000) / 1000000);
						$transaksi = "PB-" . "$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
						$param_no = $count;
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td><td align="left">Kode Transaksi :&nbsp;<input type="text" readonly="true" value="<?=$transaksi?>" name="transaksi"></td></td>
							<td></td>
							<td align="right"></td>
							<td align="right" width="100px">
							<table border="0" cellpadding="0" cellspacing="0" width="200px">
								<tr>
									<td width="right">
									<form method="post" enctype="multipart/form-data" action="home.php?hal=content/add_beli">
									<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
									<input type="hidden" readonly="true" value="<?=$transaksi?>" name="transaksi">
									<input type="Submit" value="Tambah Barang">
									</form>
									</td>
									
									<td align="right" width="100px">
									<form method="post" action="home.php?hal=content/transaksi_pembelian_stock">	
									<input type="submit" value="Transaksi Baru">
									</form>
									</td>
								</tr>
							</table>
							</td>
						</tr>
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$query = mysql_query("SELECT * FROM pembelian,obat WHERE pembelian.kode_obat = obat.kode_obat AND pembelian.transaksi = '$transaksi'"); 
									//$r=mysql_fetch_array($query);
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode Obat</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF width=70px>Jumlah Beli</font></td>
												<td><font color=#FFFFFF width=70px>Harga Beli @</font></td>
												<td><font color=#FFFFFF width=300px>Jumlah Harga</font></td>
											</tr>';
									$no = 1;
									while ($result = mysql_fetch_array($query))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$result[kode_obat]</td>
											  <td>$result[nama_obat]</td>
											  <td align=right>$result[5]</td>
										<td align=right>";
											 	rupiah($result[harga_beli]);
										echo "</td>
											  <td align=right>";
											 	rupiah($result[jumlah_harga]);
										echo "</td>
											</tr>";
										$no++;
									}
									$q3=mysql_query("SELECT SUM(jumlah_harga) FROM pembelian WHERE transaksi = '$transaksi'");
									$r3=mysql_fetch_array($q3);
									echo "<tr>
									<td colspan=5 align=right>
									<hr>Total :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									rupiah($r3['SUM(jumlah_harga)']);
									echo "</td>
			  						</tr>";
									//echo "</td></tr>";
									echo '</table><br>';
								?>
							</td>
						</tr>
					</table>
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
