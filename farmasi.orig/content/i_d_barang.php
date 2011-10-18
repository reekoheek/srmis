<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<!--setting untuk calendar-->  
		<SCRIPT type="text/javascript" src="../calendar/firebug.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="../calendar/jquery.min.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="../calendar/date.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="../calendar/jquery.datePicker.js"></SCRIPT>
		<LINK rel="stylesheet" type="text/css" media="screen" href="../calendar/datePicker.css">
		<LINK rel="stylesheet" type="text/css" media="screen" href="../calendar/demo.css">
		<SCRIPT type="text/javascript" charset="utf-8">
            $(function()
            {
				//$('.date-pick').datePicker().val(new Date().asString()).trigger('change');
				$('.date-pick').datePicker({startDate:'01/01/1901'});
            });
		</SCRIPT>
<!-- end calendar-->

</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar Barang</b></font></td>
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
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
					<font style="font-size:12px; ">
					<form method="post" action="home.php?hal=action/insert_barang" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="right"><font color="#FF0000" >Group Obat*</font> : </td>
							<td>
							<select name="group_b">
							<option value="">--Pilih--</option>
							<?php
								$qg=mysql_query ("SELECT * FROM group_barang");
								while ($rg=mysql_fetch_array($qg))
								{
									if ($r['group'] == $rg['kd_group_barang'])
									{
										echo "<option value='$rg[kd_group_barang]' selected>$rg[deskripsi] ($rg[kd_group_barang])</option>";
									}
									else
									{
										echo "<option value='$rg[kd_group_barang]'>$rg[deskripsi] ($rg[kd_group_barang])</option>";
									}
								}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td align="right"><font color="#FF0000" >Kode Barang*</font> : </td>
							<td>
							<input type="text" name="kd_barang" size="10" value="<?= $r['kd_barang']?>">
							</td>
						</tr>
						<tr>
							<td align="right"><font color="#FF0000" >Nama Barang*</font> : </td>
							<td><input type="text" name="nama" size="35" value="<?= $r['nama']?>"></td>
						</tr>
						<tr>
							<td align="right"><font color="#FF0000" >Kategori Obat*</font> : </td>
							<td>
							<select name="kategori_obat">
							<?php
								if ($r['kategori_obat']=="Obat Bebas")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Obat Bebas' selected>Obat Bebas</option>";
									echo "<option value='Obat Keras'>Obat Keras</option>";
								}
								else if ($r['kategori_obat']=="Obat Keras")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Obat Bebas'>Obat Bebas</option>";
									echo "<option value='Obat Keras' selected>Obat Keras</option>";
								}
								else
								{
									echo "<option value='' selected>--Pilih--</option>";
									echo "<option value='Obat Bebas'>Obat Bebas</option>";
									echo "<option value='Obat Keras'>Obat Keras</option>";
								}

							?>
							</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
										
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
