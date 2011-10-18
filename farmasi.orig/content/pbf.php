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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Perusahaan</b></font></td>
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
						$q= mysql_query("SELECT * FROM pbf WHERE kd_rekanan = '$_GET[kd_rekanan]'");
						$r = mysql_query($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_pbf enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_pbf enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						
						<tr>
							<td align="right">Kode Rekanan : </td>
							<td>
							<?php
							if ($r)
							{
								echo "<input type=text name=kd_rekanan size=10 value=$r[kd_rekanan] readonly=true>";
							}
							else
							{
								echo "<input type=text name=kd_rekaan size=10>";
							}
							?></td>
						</tr>
						<tr>
							<td align="right">Nama : </td>
							<td><input type="text" name="nama" size="30" value="<?= $r['nama']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Alamat : </td>
							<td><textarea name="alamat" style="width:200px; height:70px; "><?= $r['alamat']?></textarea></td>
						</tr>
						<tr>
							<td align="right">Kota : </td>
							<td><input type="text" name="kota" size="30" value="<?= $r['kota']?>"></td>
						</tr>
						<tr>
							<td align="right">Telepon : </td>
							<td><input type="text" name="telepon" size="20" value="<?= $r['telepon']?>"></td>
						</tr>
						<tr>
							<td align="right">FAX : </td>
							<td><input type="text" name="fax" size="20" value="<?= $r['fax']?>"></td>
						</tr>
						<tr>
							<td align="right">Kontak : </td>
							<td><input type="text" name="kontak" size="30" value="<?= $r['kontak']?>"></td>
						</tr>
						<tr>
							<td align="right">No Rekening : </td>
							<td><input type="text" name="no_rek" size="30" value="<?= $r['no_rek']?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM pbf");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=1100px>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF>Kode Rekanan</font></td>
												<td><font color=#FFFFFF>Nama</font></td>
												<td><font color=#FFFFFF>Alamat</font></td>
												<td><font color=#FFFFFF>Kota</font></td>
												<td><font color=#FFFFFF>Telepon</font></td>
												<td><font color=#FFFFFF>FAX</font></td>
												<td><font color=#FFFFFF>Kontak</font></td>
												<td><font color=#FFFFFF>No Rekening</font></td>
												<td><font color=#FFFFFF width=120px>Action</font></td>
											</tr>';
									$no = 1;
									while ($r = mysql_fetch_array($q))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td align = center>$no</td>
											<td>$r[kd_rekanan]</td>
											<td>$r[nama]</td>
											<td>$r[alamat]</td>
											<td>$r[kota]</td>
											<td>$r[telepon]</td>
											<td>$r[fax]</td>
											<td>$r[kontak]</td>
											<td>$r[no_rek]</td>
											<td align=center width=120px>
											<a href=home.php?hal=content/pbf&kd_rekanan=$r[kd_rekanan]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_pbf&kd_rekaan=$r[kd_rekaan]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table>';
								?>
							</td>
						</tr>
					</table>
					</div>
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
