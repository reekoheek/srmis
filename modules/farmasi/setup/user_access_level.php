<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
$qp= mysql_query("SELECT * FROM user WHERE LAST_INSERT_ID(param_no) ORDER BY ID DESC LIMIT 1");
$rp = mysql_fetch_array($qp);
	$temp = $rp['param_no'];
	$count = $temp + 1;
$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_user = "USR" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>User Accsess Level </b></font></td>
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
						$q= mysql_query("SELECT * FROM user WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=POST action=home.php?hal=action_setup/update_user_al enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=POST action=home.php?hal=action_setup/insert_user_al enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<input type="hidden" name="param_no" value="<?=$param_no;?>">
						<tr>
							<td align="right">User ID : </td>
							<td>
							<?php
							if ($r)
							{
							?>
							<input type="text" name="id_user" size="8" value="<?= $r['id_user']?>" style="background-color:#CCCFFF" readonly="true">
							<?php
							}
							else
							{
							?>
							<input type="text" name="id_user" size="8" value="<?= $no_user?>">
							<?php
							}
							?>							</td>
						</tr>
						<tr>
							<td align="right">User Name : </td>
							<td><input type="text" name="nm_user" size="20" value="<?= $r['nm_user']?>"></td>
						</tr>
						<tr>
                          <td align="right">Full Name : </td>
						  <td><input type="text" name="fullname" size="20" value="<?= $r['fullname']?>"></td>
					  </tr>
						<tr>
                          <td align="right">Group Unit : </td>
						  <td><select name="Group_id">
                              <option value="">--Pilih--</option>
                              <?php
									$qj=mysql_query("SELECT * FROM group_unit where f_aktifasi='1'");
									while($rj=mysql_fetch_array($qj))
									{
										if($r['group_id']==$rj['group_id'])
										{
											echo "<option value='$rj[group_id]' selected>$rj[name_group]</option>";
										}
										else
										{
											echo "<option value='$rj[group_id]'>$rj[name_group]</option>";
										}
									}
								?>
                            </select>    
						</td>
					  </tr>					  
						<tr>
						  <td align="right">Jenis Kelamin  : </td>
						  <td><select name="jns_kel">
						  <?php
									if ($r['jns_kel']=="L")
									{
										echo "<option>--Pilih--</option>";
										echo "<option value='L' selected>Laki-Laki</option>";
										echo "<option value='P'>Perempuan</option>";
									}
									else if($r['jns_kel']=="P")
									{
										echo "<option>--Pilih--</option>";
										echo "<option value='L'>Laki-Laki</option>";
										echo "<option value='P' selected>Perempuan</option>";
									}
									else
									{
										echo "<option selected>--Pilih--</option>";
										echo "<option value='L'>Laki-Laki</option>";
										echo "<option value='P'>Perempuan</option>";
									}
								?>
                          </select></td>
					  </tr>
						<tr>
							<td align="right">Type Access : </td>
							<td>
							<select name="type_id">
							<option value="">--Pilih--</option>
							<?php
								$qq=mysql_query("SELECT * FROM user_type");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($r['type_id']==$rq['id'])
									{
										echo "<option value='$rq[id]' selected>$rq[name_access]</option>";
									}
									else
									{
										echo "<option value='$rq[id]'>$rq[name_access]</option>";
									}
								}
							?>
							</select>							</td>
						</tr>
						<tr>
							<td align="right">Password : </td>
							<td><input type="text" name="pwd" size="20" value="12345678"></td>
						</tr>
						<tr>
							<td align="right">Status : </td>
							<td>
							<select name="flags">
								<?php
									if ($r['status_aktifasi']==1)
									{
										echo "<option>--Pilih--</option>";
										echo "<option value=1 selected>Aktif</option>";
										echo "<option value=2>Non-Aktif</option>";
									}
									else if($r['status_aktifasi']==0)
									{
										echo "<option>--Pilih--</option>";
										echo "<option value=1>Aktif</option>";
										echo "<option value=2 selected>Non-Aktif</option>";
									}
									else
									{
										echo "<option selected>--Pilih--</option>";
										echo "<option value=1>Aktif</option>";
										echo "<option value=2>Non-Aktif</option>";
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
									$q = mysql_query ("SELECT * FROM user");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF width=40px>User ID</font></td>
												<td><font color=#FFFFFF>Nama User</font></td>
												<td><font color=#FFFFFF>Created</font></td>
												<td><font color=#FFFFFF>Last Update</font></td>
												<td><font color=#FFFFFF>Status</font></td>
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
											<td width=40px>$r[id_user]</td>
											<td>$r[nm_user]</td>
											<td>$r[created_datetime] ($r[created_user])</td>
											<td>$r[update_datetime] ($r[update_user])</td>
											<td>";
											if ($r['status_aktifasi']==1)
											{
												echo "Aktif";
											}
											else
											{
												echo "Non-Aktif";
											}
											echo "</td>
											<td align=center width=120px>
											<a href=home.php?hal=setup/user_access_level&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action_setup/hapus_user_al&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
