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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>User Group</b></font></td>
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
						$q= mysql_query("SELECT * FROM user_group WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action_setup/update_user_group enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action_setup/insert_user_group enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
							<td align="right">Group Code : </td>
							<td><input type="text" name="group_code" size="8" value="<?= $r['group_code']?>"></td>
						</tr>
						<tr>
							<td align="right">Name Group : </td>
							<td><input type="text" name="name_group" size="30" value="<?= $r['name_group']?>"></td>
						</tr>
						<tr>
							<td align="right">Description : </td>
							<td><input type="text" name="description" size="30" value="<?= $r['description']?>"></td>
						</tr>
						<tr>
							<td align="right">Type ID : </td>
							<td>
							<select name="type_id">
							<option value="">--Pilih--</option>
							<?php
								$qq=mysql_query("SELECT * FROM user_type");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($r['type_id']==$rq['type_code'])
									{
										echo "<option value='$rq[type_code]' selected>$rq[type_code]</option>";
									}
									else
									{
										echo "<option value='$rq[type_code]'>$rq[type_code]</option>";
									}
								}
							?>
							</select>
							</td>
						</tr>
						<tr>
							<td align="right">Leveling ID : </td>
							<td>
							<select name="lv_id">
							<option value="">--Pilih--</option>
							<?php
								$qq2=mysql_query("SELECT * FROM leveling_akses");
								while ($rq2=mysql_fetch_array($qq2))
								{
									if ($r['lv_id']==$rq2['id'])
									{
										echo "<option value='$rq2[id]' selected>$rq2[id]</option>";
									}
									else
									{
										echo "<option value='$rq2[id]'>$rq2[id]</option>";
									}
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
									$q = mysql_query ("SELECT * FROM user_group");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF width=100px>Group Code</font></td>
												<td><font color=#FFFFFF>Name Group</font></td>
												<td><font color=#FFFFFF>Description</font></td>
												<td><font color=#FFFFFF>Type ID</font></td>
												<td><font color=#FFFFFF>Lv ID</font></td>
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
										echo "<td align = center>$no</td>
											<td width=100px>$r[group_code]</td>
											<td>$r[name_group]</td>
											<td>$r[description]</td>
											<td>$r[type_id]</td>
											<td>$r[lv_id]</td>
											<td>$r[created_datetime] ($r[created_user])</td>
											<td>$r[update_datetime] ($r[update_user])</td>
											<td align=center width=120px>
											<a href=home.php?hal=setup/user_group&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action_setup/hapus_user_group&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
