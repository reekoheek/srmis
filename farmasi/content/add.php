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
					<font style="font-size:12px;">
					<?php
						$kode_obat = $_POST['kode_obat'];
						$param_no = $_POST['param_no'];
						$transaksi = $_POST['transaksi'];
						$no_rm = $_POST['no_rm'];
					?>
					<form method="post" enctype="multipart/form-data" action="home.php?hal=content/add">
					<input type="hidden" name="param_no" value="<?=$param_no?>">
					<input type="hidden" name="transaksi" value="<?=$transaksi?>">
					<input type="hidden" name="no_rm" value="<?=$no_rm?>">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr align="right">
							<td align="right" width="500px">Masukan Kode Obat :</td>
							<td align="right"><input type="text" name="kode_obat"></td>
							<td align="right"><input type="submit" value="Cari"></td>
						</tr>
					</table>
					</form>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									
									if ($kode_obat)
									{
										$q = mysql_query("SELECT * FROM obat WHERE kode_obat LIKE '$kode_obat%'");
									}
									else
									{
										$q = mysql_query("SELECT * FROM obat");
									}
									 
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode Obat</font></td>
												<td><font color=#FFFFFF width=70px>Nama</font></td>
												<td><font color=#FFFFFF width=300px>Harga</font></td>
												<td><font color=#FFFFFF width=300px>Jml</font></td>
												<td><font color=#FFFFFF width=300px>Action</font></td>
											</tr>';
									$no = 1;
									while ($result = mysql_fetch_array($q))
									{
									echo '<form method=post action=home.php?hal=action/insert_penjualan entype=multipart/form-data>';
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
											  <td>";
											 	rupiah($result[harga_jual]);
										echo "</td>
											  <td>
											  	<input type=hidden name=param_no value='$param_no'>
												<input type=hidden name=transaksi value='$transaksi'>
												<input type=hidden name=no_rm value='$no_rm'>
												<input type=hidden name=jumlah value='$result[jumlah]'>
												<input type=hidden name=harga_jual value='$result[harga_jual]'>
												<input type=hidden name=kode_obat value='$result[kode_obat]'>
											  	<input type=text name=jumlah_jual size=4 value=1>  / $result[jumlah] 
											  </td>
											  <td align=center width=120px>
											  	<input type=submit value='ADD TO CART'>
											  </td>
											</tr>";
										$no++;
										echo '</form>';
									}
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
