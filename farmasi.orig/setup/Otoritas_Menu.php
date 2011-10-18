<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php
$cari=$_POST['cari'];
if ($_GET['xGU'])
	{$Gr = $_GET['xGU'];}
else
	{$Gr = $r['group_id'];}
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
							echo '<form method=POST action=home.php?hal=action_setup/update_otoritas enctype=multipart/form-data>';
						}
					?>
					
										
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
							<td align="right">User ID : </td>
							<td>
							<input type="text" name="id_user" size="8" value="<?= $r['id_user']?>" style="background-color:#CCCFFF" readonly="true">
							</td>
						</tr>
						<tr>
                          <td align="right">Group Unit : </td>
						  <td><select name="Group_id" onChange="window.location='home.php?hal=setup/Otoritas_Menu&id=<?=$r['id']?>&xGU='+this.options[this.selectedIndex].value">
                              <option value="">--Pilih--</option>
                              <?php
									$qj=mysql_query("SELECT * FROM group_unit where ".$Gr." and f_aktifasi='1'");
									while($rj=mysql_fetch_array($qj))
									{
										if($Gr==$rj['group_id'])
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
                          <td align="right"> Unit : </td>
						  <td><select name="unit_id" onChange="window.location='home.php?hal=setup/Otoritas_Menu&id=<?=$r['id']?>&xGU=<?=$_GET['xGU']?>&xU='+this.options[this.selectedIndex].value">
                              <option value="">--Pilih--</option>
                              <?php
							  		if ($_GET['xU'])
									{
									$Group_id = "and group_id=".$_GET['xGU']."";
									$Group = $_GET['xU'];	
									}
									else 
									{
									$Group = $r['unit_id'];
									$Group_id = "and group_id=".$r['group_id']."";
									}
									$qj=mysql_query("SELECT * FROM tbl_menu where menu='1' ".$Group_id." and f_aktif='1'");
									while($rj=mysql_fetch_array($qj))
									{
										if($Group==$rj['id'])
										{
											echo "<option value='$rj[id]' selected>$rj[name_menu]</option>";
										}
										else
										{
											echo "<option value='$rj[id]'>$rj[name_menu]</option>";
										}
									}
									
								?>
                            </select>                          
						</td>
					  </tr>
					  <tr>
                          <td align="right"> Sub Unit : </td>
						  <td><select name="Sub_Unit" >
                              <option value="">--Pilih--</option>
                              <?php
							  		if ($_GET['xU'])
									{
									$unit = $_GET['xU'];
									$Group_unit = "unit_id=".$_GET['xU']."";
									}
									else
									{
									$unit = $r['sub_unit'];
									$Group_unit = "unit_id=".$r['unit_id']."";
									}
									$qj=mysql_query("SELECT * FROM pelayanan where ".$Group_unit." order by id asc");
									while($rj=mysql_fetch_array($qj))
									{
										if($rj['id']==$unit)
										{
											echo "<option value='$rj[id]' selected>$rj[nama]</option>";
										}
										else
										{
											echo "<option value='$rj[id]'>$rj[nama]</option>";
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
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<form method="post" action="home.php?hal=setup/Otoritas_Menu" enctype="multipart/form-data">
							<td align="right">
								<div id="container">
								
								Cari Nama User : 
								  <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="18">
								&nbsp;<input type="submit" value="Cari">
								
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 150px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
								
							</td>
							</form>
						</tr>
					</table>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:100%; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									
									if ($cari)
									{
										$q = mysql_query ("SELECT * FROM user WHERE nm_user LIKE '$cari%' order by created_datetime desc");
									}
									else
									{
										$q = mysql_query ("SELECT * FROM user order by id asc");
									}
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
											<a href=home.php?hal=setup/Otoritas_Menu&id=$r[id]&xGU=$r[group_id]><font size=-1>EDIT</font></a>
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
