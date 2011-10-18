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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Transaksi Pembelian Barang Baru</b></font></td>
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
						$count = $temp + 1;
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
					<form method="post" action="home.php?hal=action/insert_pembelian" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr valign="top">
							<td align=right width="200px">Kode Transaksi : </td>
							<td><input type="text" readonly="true" value="<?=$transaksi?>" name="transaksi"></td>
						</tr>
						<tr valign="top">
							<td align=right>Kode Obat: </td>
							<td><input type=text name=kode_obat size=10></td>
						</tr>
						<tr valign="top">
							<td align="right">Nama Obat: </td>
							<td><input type="text" name="nama_obat" size="50" value="<?= $r['nama_obat']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Jenis Obat: </td>
							<td>
							<select name="kode_jenis">
							<option value="">--Pilih--</option>
							<?php
							$q1=mysql_query("SELECT * FROM jenis_obat ORDER BY id");
							while ($r1=mysql_fetch_array($q1))
							{
								if ($r1['id']==$r['kode_jenis'])
								{
									echo "<option value='$r1[id]' selected>$r1[jenis_obat]</option>";
								}	
								else
								{
									echo "<option value='$r1[id]'>$r1[jenis_obat]</option>";
								}
							}
							?>
							</select>
							</td>
						</tr>
						<tr valign="top">
							<td align="right">Status Obat : </td>
							<td>
							<select name="status_obat">
								<option value="">-Pilih</option>
								<option value="Resep">Resep</option>
								<option value="Non-Resep">Non-Resep</option>
							</select>
							</td>
						</tr>
						<tr valign="top">
							<td align="right">Harga Jual @ Rp : </td>
							<td><input type="text" name="harga_jual" size="10" onKeyPress='return numbersonly()'></td>
						</tr>
						<tr valign="top">
							<td align="right">Jumlah Pembelian : </td>
							<td><input type="text" name="jumlah_beli" size="4" onKeyPress='return numbersonly()'></td>
						</tr>
						<tr valign="top">
							<td align="right">Keterangan : </td>
							<td><textarea name="ket" style="width:140px; height:50px"></textarea></td>
						</tr>
						<tr valign="top">
							<td align="right">Harga Pembelian : </td>
							<td><input type="text" name="harga_beli" size="12"></td>
						</tr>
						<tr valign="top">
							<td align="right">Supplier: </td>
							<td>
							<select name="kode_supplier">
							<option value="">--Pilih--</option>
							<?php
							$q1=mysql_query("SELECT * FROM supplier ORDER BY kode_supplier");
							while ($r1=mysql_fetch_array($q1))
							{
									echo "<option value='$r1[kode_supplier]'>$r1[nama]</option>";
							}
							?>
							</select>
							</td>
						</tr>
							<td align="right"></td>
							<td align="center" width="100px">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								<input type="Submit" value="Tambah Barang">
							</td>
						</tr>
					</table>
					</form>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$query = mysql_query("SELECT * FROM pembelian,obat WHERE pembelian.kode_obat = obat.kode_obat AND pembelian.transaksi = '$transaksi'"); 
									//$r=mysql_fetch_array($query);
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF width=70px>Jumlah</font></td>
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
										echo "<td>$result[nama_obat]</td>
											  <td align=right>$result[5]</td>
											  <td align=right>";
											 	rupiah($result[jumlah_harga]);
										echo "</td>
											</tr>";
										$no++;
									}
									$q3=mysql_query("SELECT SUM(jumlah_harga) FROM pembelian WHERE transaksi = '$transaksi'");
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
