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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Leveling Akses</b></font></td>
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
						$q= mysql_query("SELECT * FROM leveling_akses WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action_setup/update_leveling_akses enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action_setup/insert_leveling_akses enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						
						<tr>
							<td align="left"><div align="right">Akses Level : </div></td>
							<td>
							<select name="akses_lvl">
							<option value="">--Pilih--</option>
							<?php
								$qq=mysql_query("SELECT * FROM user_type");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($r['akses_lvl']==$rq['id'])
									{
										echo "<option value='$rq[id]' selected>$rq[name_access]</option>";
									}
									else
									{
										echo "<option value='$rq[id]'>$rq[name_access]</option>";
									}
								}
							?>
							</select>							
							</td>
						</tr>
						<tr>
							<td align="left"><div align="right">Akses VA : </div></td>
							<td>
							<select name="akses_va">
								<?php
									if ($r['akses_va']=="1")
									{
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}
									else
									{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-AKtif</option>";
									}
								?>
							</select>							</td>
						</tr>
						<tr>
							<td align="left"><div align="right">Akses VAE : </div></td>
							<td>
							<select name="akses_vae">
								<?php
									if ($r['akses_vae']=="1")
									{
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}
									else
									{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-AKtif</option>";
									}
								?>
							</select>							</td>
						</tr>

						<tr>
							<td align="left"><div align="right">Akses VAED : </div></td>
							<td>
							<select name="akses_vaed">
								<?php
									if ($r['akses_vaed']=="1")
									{
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}
									else
									{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-AKtif</option>";
									}
								?>
							</select>							</td>
						</tr>

						<tr>
							<td align="left"><div align="right">Akses VE : </div></td>
							<td>
							<select name="akses_ve">
								<?php
									if ($r['akses_ve']=="1")
									{
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}
									else
									{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-AKtif</option>";
									}
								?>
							</select>							</td>
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
									$q = mysql_query ("SELECT * FROM leveling_akses");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF>Akses Lv</font></td>
												<td><font color=#FFFFFF>Created</font></td>
												<td><font color=#FFFFFF>Last Update</font></td>
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
										$qq=mysql_query("SELECT * FROM user_type where id ='".$r['akses_lvl']."'");
										$rq=mysql_fetch_array($qq);
										echo "<td align = center>$no</td>
											<td>$rq[name_access]</td>
											<td>$r[created_datetime] ($r[created_user])</td>
											<td>$r[update_datetime] ($r[update_user])</td>
											<td align=center width=120px>
											<a href=home.php?hal=setup/leveling_akses&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action_setup/hapus_leveling_akses&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
