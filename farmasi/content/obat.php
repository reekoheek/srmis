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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Obat</b></font></td>
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
						$cari = $_POST['cari'];
					?>
					<font style="font-size:12px;">
					<form method="post" action="home.php?hal=content/obat" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr align="right">
							<td align="right" width="580px">Masukan Kode Obat :</td>
							<td align="right"><input type="text" name="cari" size="8"></td>
							<td align="right"><input type="submit" value="Cari"></td>
						</tr>
					</table>
					</form>
					</td>
					<td></td>
				</tr>
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					<?php
						$q= mysql_query("SELECT * FROM obat WHERE kode_obat = '$_GET[kode_obat]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
					?>
						<form method="post" action="home.php?hal=action/update_obat" enctype="multipart/form-data">
						<table border="0" cellpadding="2" cellspacing="2" width="100%">
									<tr valign="top">
										<td align="right">Kode obat: </td>
										<td><input type="text" name="kode_obat" size="10" value="<?=$r['kode_obat']?>" readonly="true" style="background-color:#CCCCCC"></td>
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
								<?php
								if ($r['status_obat']=="")
								{
									echo "<option value='' selected>-Pilih-</option>";
									echo "<option value=Resep>Resep</option>";
									echo "<option value=Non-Resep>Non-Resep</option>";
								}
								else
								if ($r['status_obat']=="Resep")
								{
									echo "<option value='' >-Pilih-</option>";
									echo "<option value=Resep selected>Resep</option>";
									echo "<option value=Non-Resep>Non-Resep</option>";
								}
								else
								{
									echo "<option value=''>-Pilih-</option>";
									echo "<option value=Resep>Resep</option>";
									echo "<option value=Non-Resep selected>Non-Resep</option>";
								}
								?>
							</select>
							</td>
						</tr>
						<tr valign="top">
							<td align="right">Harga Jual @ Rp : </td>
							<td><input type="text" name="harga_jual" size="10" value="<?= $r['harga_jual']?>" onKeyPress='return numbersonly()'></td>
						</tr>
						<tr valign="top">
							<td align="right">Jumlah Stock : </td>
							<td><input type="text" name="jumlah" size="4" value="<?= $r['jumlah']?>" onKeyPress='return numbersonly()'></td>
						</tr>
						<tr valign="top">
							<td align="right">Keterangan : </td>
							<td><textarea name="ket" style="width:140px; height:50px"><?= $r['ket']?></textarea></td>
						</tr>
						<tr valign="top">
							<td align="right">Harga Beli @ Rp : </td>
							<td><input type="text" name="harga_beli" value="<?= $r['harga_beli']?>" size="10"></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp;<input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					<?php
					}
					?>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									if ($cari)
									{
										$q2 = mysql_query("SELECT * FROM obat WHERE kode_obat LIKE '$cari%'");
										echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Jenis</font></td>
												<td><font color=#FFFFFF>Status</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>ket</font></td>
												<td><font color=#FFFFFF>Harga Beli</font></td>
												<td><font color=#FFFFFF>Action</font></td>
											</tr>';
									$no = 1;
									while ($r2 = mysql_fetch_array($q2))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$r2[kode_obat]</td>
											<td>$r2[nama_obat]</td>";
										$qr = mysql_query("SELECT jenis_obat FROM jenis_obat WHERE id = '$r2[kode_jenis]'");
										$rr = mysql_fetch_array($qr);
										echo "<td>$rr[jenis_obat]</td>
											<td>$r2[status_obat]</td>
											<td>";
											rupiah($r2[harga_jual]);
										echo "</td>
											<td>$r2[jumlah]</td>
											<td>$r2[ket]</td>
											<td>";
											rupiah($r2[harga_beli]);
										echo "</td>
											<td align=center width=90px>
											<a href=home.php?hal=content/obat&kode_obat=$r2[kode_obat]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_obat&kode_obat=$result[kode_obat]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';
									}
									
									
									else
									{
									$rowsPerPage = 20;

									$pageNum = 1;

									if(isset($_GET['page']))
									{
    									$pageNum = $_GET['page'];
									}

									$offset = ($pageNum - 1) * $rowsPerPage;

									$query  = mysql_query ("SELECT * FROM obat ORDER BY kode_obat ASC
											   LIMIT $offset, $rowsPerPage");
									//$result = mysql_query($query) or die('Error, query failed');

									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Jenis</font></td>
												<td><font color=#FFFFFF>Status</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>ket</font></td>
												<td><font color=#FFFFFF>Harga Beli</font></td>
												<td><font color=#FFFFFF>Action</font></td>
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
											<td>$result[nama_obat]</td>";
										$qr = mysql_query("SELECT jenis_obat FROM jenis_obat WHERE id = '$result[kode_jenis]'");
										$rr = mysql_fetch_array($qr);
										echo "<td>$rr[jenis_obat]</td>
											<td>$result[status_obat]</td>
											<td>";
											rupiah($result[harga_jual]);
										echo "</td>
											<td>$result[jumlah]</td>
											<td>$result[ket]</td>
											<td>";
											rupiah($result[harga_beli]);
										echo "</td>
											<td align=center width=90px>
											<a href=home.php?hal=content/obat&kode_obat=$result[kode_obat]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_obat&kode_obat=$result[kode_obat]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(kode_obat) AS numrows FROM obat ORDER BY kode_obat ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/obat\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/obat\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/obat\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/obat\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';
									}
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
