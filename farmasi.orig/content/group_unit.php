<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

</head>
<body>
<?php
	$cari=$_POST['cari'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Group Unit </font></b></td>
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
						$q= mysql_query("SELECT * FROM group_unit WHERE group_id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_group_unit enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_group_unit enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
							<td align="right">Nama : </td>
							<td><input type="text" name="nama" size="20" value="<?= $r['name_group']?>"></td>
						</tr>
						<tr>
							<td align="right">Aktifasi : </td>
							<td>
							<select name="flags">
							<?php
								if($r['f_aktifasi']==1)
								{
									echo "<option value=''>--Pilih--</option>
										  <option value=1 selected>Aktif</option>
										  <option value=0>Non-Aktif</option>";
								}
								elseif($r['f_aktifasi']==0)
								{
									echo "<option value=''>--Pilih--</option>
										  <option value=1>Aktif</option>
										  <option value=0 selected>Non-Aktif</option>";
								}
								else
								{
									echo "<option value='' selected>--Pilih--</option>
										  <option value=1>Aktif</option>
										  <option value=0>Non-Aktif</option>";
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
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:100%; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									if ($cari)
									{
										$q = mysql_query ("SELECT * FROM group_unit WHERE name_group LIKE '$cari%' ORDER BY id desc");
									}
									else
									{
										$q = mysql_query ("SELECT * FROM group_unit order by id desc");
									}
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>No.</font></td>
												<td><font color=#FFFFFF>Group id</font></td>
												<td><font color=#FFFFFF width=100px>Nama Group</font></td>
												<td><font color=#FFFFFF width=210px>Created</font></td>
												<td><font color=#FFFFFF width=210>Update</font></td>
												<td><font color=#FFFFFF>Status Aktif</font></td>
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
											<td width=100px>$r[group_id]</td>
											<td width=100px>$r[name_group]</td>
											<td width=210px>$r[created_datetime] ($r[created_user])</td>
											<td width=210px>$r[update_datetime] ($r[update_user])</td>";
											if ($r['f_aktifasi']==1)
											{
												echo "<td>Aktif</td>";
											}
											else
											{
												echo "<td>Non-Aktif</td>";
											}
											echo"<td align=center width=120px>
											<a href=home.php?hal=content/group_unit&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_group_unit&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
