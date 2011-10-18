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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Aktivasi Akun</b></font></td>
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
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM admin");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF>Username</font></td>
												<td><font color=#FFFFFF>Nama Lengkap</font></td>
												<td><font color=#FFFFFF>J. Kelamin</font></td>
												<td><font color=#FFFFFF>Keterangan</font></td>
												<td><font color=#FFFFFF>Aktivasi Akun</font></td>
												<td><font color=#FFFFFF>Action</font></td>
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
											<td>$r[username]</td>
											<td>$r[fullname]</td>
											<td>$r[jns_kel]</td>
											<td>$r[ket]</td>
											<form method='post' enctype='multipart/form-data' action='home.php?hal=action/update_aktivasi'>
											<input type='hidden' name='id' value='$r[id]'>
											<td align=center>
											<select name='status_aktivasi'>";
										if ($r['status_aktivasi'] == "1")
										{
											echo "<option value=1 selected>Aktif</option>";
											echo "<option value=0>Non - Aktif</option>";
										}
										else
										{
											echo "<option value=1>Aktif</option>";
											echo "<option value=0 selected>Non - Aktif</option>";
										}	
										echo "</select>
											</td>
											<td align=center><input type='submit' value='Ubah'></td>
											</form>
										</tr>";
										$no++;
									}
									echo '</table>';
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
