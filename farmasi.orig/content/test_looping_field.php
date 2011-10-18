<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
	$cari = $_POST['cari'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Contoh Looping field</b></font></td>
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
			<form method="post" action="home.php?hal=content/input_daftar_barang" enctype="multipart/form-data">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="left">No Request : <input type="text" size="20" name="no_req"></td>
							<td width="180px" align="right">
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
							</td>
						</tr>
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
							$query2  = mysql_query ("SELECT * FROM ms_barang ORDER BY ex_year,ex_month,ex_date ASC");
							$array = mysql_fetch_assoc($query2);											
							echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF>Nama Field</font></td>
										<td><font color=#FFFFFF width=140px>Action</font></td>
									</tr>';
									//for (each ($array) as $key >= $value)
									while (list($key,$value) = each($array))
									{
										echo "<tr>
												<td>$value</td>
												<td><input type=checkbox name='chk$key' value='$value'></td>
											  </tr>";
									}
									echo "<tr><td colspan=2 align=right><input type=submit value='Buat Request'></td></tr>";
									
									echo '</table>';
							?>
							</td>
						</tr>
					</table>
					</font>
					</form>
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
