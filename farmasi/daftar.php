<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Login Apotek</title>
<link rel="shortcut icon" href="logo.ico">
</head>
<link rel="stylesheet" type="text/css" href="include/style.css">

<body>
<table border="0" cellpadding="0" cellspacing="0" width="365px" align="center">
	<tr>
		<td colspan="3"><img src="images/login.png"></td>
	</tr>
	<tr>
		<td width="26px">&nbsp;</td>
		<td>
		<form method="post" action="insert_daftar.php" enctype="multipart/form-data" name="form1" id="form1">
		<table border="0" cellpadding="4" cellspacing="2" width="100%" bgcolor="#fefafa">
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS;font-size:12px; ">Username :</font></td>
				<td><input type="text" name="username" size="21" id="textfield"></td>
			</tr>
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS;font-size:12px; ">Nama Lengkap :</font></td>
				<td><input type="text" name="fullname" size="21" id="textfield"></td>
			</tr>
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS; font-size:12px; ">Password :</font></td>
				<td><input type="password" name="password" size="21" id="textfield2"></td>
			</tr>
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS; font-size:12px; ">Re - Password :</font></td>
				<td><input type="password" name="re_password" size="21" id="textfield2"></td>
			</tr>
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS;font-size:12px; ">Jenis Kelamin :</font></td>
				<td>
				<select name="jns_kel">
					<option value="L">Laki-laki</option>
					<option value="P">Perempuan</option>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right"><font color="#565957" style="font-family:Trebuchet MS;font-size:12px; ">Jabatan :</font></td>
				<td>
				<select name="kode">
					<option value="2">Apoteker</option>
					<option value="3">Kasir</option>
				</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td align="right"><input type="submit" value="Daftar">&nbsp;</td>
			</tr>
		</table>
		</form>
		</td>
		<td width="23px">&nbsp;</td>
	</tr>
</table>
<table border="0" cellpadding="6" cellspacing="0" width="365px" align="center">
	<tr>
		<td align="center"><font style="font-size:11px; ">CopyRight &copy; 2011 | All Right Reserved</font></td>
	</tr>
</table> 
</body>
</html>
