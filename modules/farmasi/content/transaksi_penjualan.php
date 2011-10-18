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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Transaksi Penjualan</b></font></td>
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
					<?php
						$q= mysql_query("SELECT * FROM penjualan WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
						$r = mysql_fetch_array($q);
						$temp = $r['param_no'];
						$count = $temp + 1;
						$digit1 = (int) ($count % 10);
						$digit2 = (int) (($count % 100) / 10);
						$digit3 = (int) (($count % 1000) / 100);
						$digit4 = (int) (($count % 10000) / 1000);
						$digit5 = (int) (($count % 100000) / 10000);
						$digit6 = (int) (($count % 1000000) / 100000);
						$digit7 = (int) (($count % 10000000) / 1000000);
						$transaksi = "TR-" . "$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
						$param_no = $count;
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<form method="post" enctype="multipart/form-data" action="home.php?hal=content/add">
						<tr>
							
							<td align="left">Kode Transaksi </td><td>:&nbsp;<input type="text" readonly="true" value="<?=$transaksi?>" name="transaksi"></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td align="left" width="120px">No Rekam Medik </td><td>:&nbsp;<input type="text" name="no_rm"></td>
							<td></td>
							<td align="right"></td>
							<td align="right" width="100px">
							
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								
								<input type="Submit" value="Tambah Barang">
							
							</td>
						</tr>
						</form>
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$query = mysql_query("SELECT * FROM penjualan,obat WHERE penjualan.kode_obat = obat.kode_obat AND penjualan.transaksi = '$transaksi'"); 
									//$r=mysql_fetch_array($query);
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF width=70px>Jumlah</font></td>
												<td><font color=#FFFFFF width=300px>Jumlah Harga</font></td>
												<td><font color=#FFFFFF>Action</font></td>
											</tr>';
									$no = 1;
									while ($result = mysql_fetch_array($query))
									{
										echo '<form method=post action=home.php?hal=action/insert_copy_resep entype=multipart/form-data>';
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$result[nama_obat]</td>
											  <td align=right>$result[4]</td>
											  <td align=right>";
											 	rupiah($result[jumlah_harga]);
										echo "</td>
												<td align=center width=120px>
												<input type=hidden name=no_rm value=$r[no_rm]>
												<input type=hidden name=id value=$result[id]>
												<input type=hidden name=param_no value=$result[param_no]>
												<input type=hidden name=transaksi value=$result[transaksi]>
												<input type=hidden name=kode_obat value=$result[kode_obat]>
												<input type=hidden name=jumlah value=$result[jumlah]>
												<input type=hidden name=jumlah_harga value=$result[jumlah_harga]>
											  	<input type=submit value='COPY RESEP'>
											  </td>
											</tr>";
										$no++;
										echo '</form>';
									}
									$q3=mysql_query("SELECT SUM(jumlah_harga) FROM penjualan WHERE transaksi = '$transaksi'");
									$r3=mysql_fetch_array($q3);
									echo "<tr>
									<td colspan=3 align=right>
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
