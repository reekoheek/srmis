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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Shift Karyawan</font></b></td>
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
						<td align="center">
						<font style="font-size:12px;">
						<?php
							if(!$_GET['edit'])
							{
						?>
						<form method="post" action="home.php?hal=action/simpan_shift_karyawan">
						<table border="0" cellpadding="2" cellpspacing="2" width="40%" align="center">
						<tr><td width="346">Nama Shift</td>
						<td width="230" align="left">: 
						  <input type="text" name="nama" size="25" value=""></td></tr>
						<tr>
							<td>Jam Masuk</td>
							<td>: <input type="text" name="jam_masuk" value=""></td>
						</tr>
						<tr>
							<td>Jam Keluar</td>
							<td>: <input type="text" name="jam_keluar" value=""></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="Simpan" name="simpan">
								&nbsp;
								<input type="reset" value="Reset" name="reset">
							</td>
						</tr>
						</table>
						</form>
						<?php
						}else{
							$qedit=mysql_query("select * from shift_karyawan where id='$_GET[id]'");
							$redit=mysql_fetch_array($qedit);
						?>
						<form method="post" action="home.php?hal=action/update_shift_karyawan">
						<table border="0" cellpadding="2" cellpspacing="2" width="40%" align="center">
						<tr><td width="346">Nama Shift</td>
						<td width="230" align="left">: 
						  <input type="text" name="nama" size="25" value="<?=$redit['nama']?>"></td></tr>
						<tr>
							<td>Jam Masuk</td>
							<td>: <input type="text" name="jam_masuk" value="<?=$redit['masuk']?>"></td>
						</tr>
						<tr>
							<td>Jam Keluar</td>
							<td>: <input type="text" name="jam_keluar" value="<?=$redit['keluar']?>"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<input type="submit" value="Update" name="update">
								&nbsp;
								<input type="hidden" name="id" value="<?=$redit['id']?>">
							</td>
						</tr>
						</table>
						</form>
						<?php
						}
						?>
						</font>
						</td>
						<td>&nbsp;</td>
					</tr>
			
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="70%" align="center">
						<tr bgcolor="#414141" align="center">
							<td><font color="#FFFFFF">No. </font></td>
							<td><font color="#FFFFFF">Nama Shift</font></td>
							<td><font color="#FFFFFF">Jam Masuk</font></td>
							<td><font color="#FFFFFF">Jam Keluar</font></td>
							<td><font color="#FFFFFF">Action</font></td>
						</tr>
						<?
							$query1=mysql_query("select * from shift_karyawan ORDER BY id");
							$no=1;
							while($result1=mysql_fetch_array($query1))
							{
								if (!empty($result1['id']))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										echo"<td align=center width=40px>$no</td>
											<td align=left width=150px>$result1[nama]</td>
											<td align=center width=100px>$result1[masuk]</td>
											<td align=center width=100px>$result1[keluar]</td>
											<td align=center width=80px>
												<a href=home.php?hal=content/shift_karyawan&id=$result1[id]&edit=1>EDIT</a> | 
												<a href=home.php?hal=action/hapus_shift_karyawan&id=$result1[id]>HAPUS</a>
											</td>
											</tr>";
									}
								$no++;
								}
						?>
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