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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Copy Resep Pasien</b></font></td>
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
					<td></td>
					<td>
					<?php
						$q= mysql_query("SELECT * FROM lunas WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
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
						$transaksi = "CPR-" . "$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
						$param_no = $count;
						
						$cari = $_POST['cari'];
					?>
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr align="right">
						<form method="post" action="home.php?hal=content/copy_resep" enctype="multipart/form-data">
							<td align="right" width="580px">Masukan No RM :</td>
							<td align="right"><input type="text" name="cari" size="14"></td>
							<td align="right"><input type="submit" value="Cari"></td>
						</form>
							<td>
							<form method="post" action="content/cetak_lunas.php" enctype="multipart/form-data">
								<input type="hidden" value="<?= $param_no?>" name="param_no">
								<input type="hidden" value="<?= $cari?>" name="cari">
								<input type="submit" value="Cetak">
							</form>
							</td>
						</tr>
					</table>
					
					</td>
					<td></td>
				</tr>
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$query = mysql_query("SELECT * FROM obat,copy_resep 
									WHERE copy_resep.kode_obat = obat.kode_obat AND copy_resep.no_rm LIKE '$cari%'");
									
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Tanggal</font></td>
												<td><font color=#FFFFFF>No RM</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Jumlah</font></td>
												<td><font color=#FFFFFF>Jumlah Harga</font></td>';
										
												echo'<td><font color=#FFFFFF>Action</font></td>';
												
										
											echo'</tr>';
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
										echo "<td>$result[date] - $result[month] - $result[year]</td>
											<td>$result[no_rm]</td>
											<td>$result[nama_obat]</td>
											<td>$result[jumlah]</td><td>";
											rupiah($result[jumlah_harga]);
										
										echo "</td>";
									
										echo '<form method=post action=home.php?hal=action/insert_lunas enctype=multipart/form-data>';
										echo "<td align=center>
											<input type=hidden name=no_rm value=$result[no_rm]>
												<input type=hidden name=id value=$result[id]>
												<input type=hidden name=param_no value=$param_no>
												<input type=hidden name=transaksi value=$transaksi>
												<input type=hidden name=kode_obat value=$result[kode_obat]>
												<input type=hidden name=jumlah value=$result[jumlah]>
												<input type=hidden name=jumlah_harga value=$result[jumlah_harga]>
												<input type=hidden name=cari value='$cari'>
											<input type=submit value=Bayar>
											</td>";
										echo '</form>';
										echo "	</tr>";
										$no++;
									}
									$q3=mysql_query("SELECT SUM(jumlah_harga) FROM copy_resep WHERE no_rm = '$cari'");
									$r3=mysql_fetch_array($q3);
									echo "<tr>
									<td colspan=5 align=right>
									<hr>Total :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
									rupiah($r3['SUM(jumlah_harga)']);
									echo "</td>
			  						</tr>";
									echo '</table><br>';
								?>
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
