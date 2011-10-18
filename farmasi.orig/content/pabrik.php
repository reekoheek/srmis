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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Pabrik</b></font></td>
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
						$q= mysql_query("SELECT * FROM pabrik WHERE kd_pabrik = '$_GET[kd_pabrik]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_pabrik enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_pabrik enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="right">Kode pabrik : </td>
							<td>
							<?php
								if ($r) 
								{
							?>
							<input type="text" name="kd_pabrik" size="10" value="<?= $r['kd_pabrik']?>" readonly="true"></td>
							<?php
							}
							else
							{
							?>
							<input type="text" name="kd_pabrik" size="10"></td>
							<?php
							}
							?>
						</tr>
						<tr>
							<td align="right">Nama Pabrik : </td>
							<td><input type="text" name="nama" size="30" value="<?= $r['nama']?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:100%; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM pabrik");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=10px>#</font></td>
												<td><font color=#FFFFFF width=110px>Kode pabrik</font></td>
												<td><font color=#FFFFFF>Nama</font></td>
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
										echo "<td align = center width=10px>$no</td>
											<td width=110px>$r[kd_pabrik]</td>
											<td>$r[nama]</td>
											<td align=center width=120px>
											<a href=home.php?hal=content/pabrik&kd_pabrik=$r[kd_pabrik]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_pabrik&kd_pabrik=$r[kd_pabrik]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
