<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<!-- suggestion -->
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action_setup/string_menu.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->

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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Menu</b></font></td>
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
						$q= mysql_query("SELECT * FROM tbl_menu WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action_setup/update_tbl_menu enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action_setup/insert_tbl_menu enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
							<td align="right">Code : </td>
							<td><input type="text" name="code" size="8" value="<?= $r['code']?>"></td>
						</tr>
						<tr>
							<td align="right">Name Menu : </td>
							<td><input type="text" name="name_menu" size="30" value="<?= $r['name_menu']?>"></td>
						</tr>
						<tr>
							<td align="right">Description : </td>
							<td><input type="text" name="description" size="30" value="<?= $r['description']?>"></td>
						</tr>
						<tr>
						  <td align="right">Link : </td>
						  <td><input type="text" name="Link" size="30" value="<?= $r['Link']?>"></td>
					  </tr>
						<tr>
						  <td align="right">Menu Master :</td>
						  <td><select name="Master">
                            <option value="">--Pilih--</option>
                            <?php
								$qq=mysql_query("SELECT * FROM kat_menu where f_status='1'");
								while ($rq=mysql_fetch_array($qq))
								{
									if (trim($r['Menu'])==trim($rq['id']))
									{
										echo "<option value='$rq[id]' selected>$rq[Nm_Type]</option>";
									}
									else
									{
										echo "<option value='$rq[id]'>$rq[Nm_Type]</option>";
									}
								}
							?>
                          </select></td>
					  </tr>
					  <tr>
                          <td align="right">Group Unit  :</td>
						  <td>
						  <select name="Grunit">
                              <option value="">--Pilih--</option>
                              <?php
								$qq=mysql_query("SELECT * FROM group_unit where f_aktifasi ='1'");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($r['group_id']==$rq['group_id'])
									{
										echo "<option value='$rq[group_id]' selected>$rq[name_group]</option>";
									}
									else
									{
										echo "<option value='$rq[group_id]'>$rq[name_group]</option>";
									}
								}
							?>
                          </select></td>
					  </tr>
					   <tr>
                          <td align="right">Aktivasi  :</td>
						  <td>
						  <select name="fld10">
                              <option value="">--Pilih--</option>
                              <?php
									if ($r['f_aktif']==1)
									{
										echo "<option value='1' selected>Aktif</option>";
										echo "<option value='0'>Non-Aktif</option>";
									}
									else
									{
										echo "<option value='1'>Aktif</option>";
										echo "<option value='0' selected>Non-Aktif</option>";
									}
							?>
                          </select></td>
					  </tr>
					  <tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<form method="post" action="home.php?hal=setup/tbl_menu" enctype="multipart/form-data">
							<td align="right">
								<div id="container">
								
								Cari Nama Menu : 
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
					<table width="100%" border="0" height="30%">
  						<tr bgcolor=#414141 align=center>
							<td><font color=#FFFFFF>No.</font></td>
							<td><font color=#FFFFFF width=30px>Code</font></td>
							<td><font color=#FFFFFF width=100px>Name Menu</font></td>
							<td><font color=#FFFFFF>Description</font></td>
							<td><font color=#FFFFFF>Link</font></td>
							<td><font color=#FFFFFF>Created</font></td>
							<td><font color=#FFFFFF>Last Update</font></td>
							<td><font color=#FFFFFF width=120px>Action</font></td>
						</tr>
					</table>


					<hr>
					<div style="border:1px  solid; border-color:#CCCCCC; width:100%; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									if ($cari)
									{
										$q = mysql_query ("SELECT * FROM tbl_menu WHERE name_menu LIKE '$cari%' order by created_datetime desc");
									}
									else
									{
										$q = mysql_query ("SELECT * FROM tbl_menu order by created_datetime desc");
									}
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>';
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
											<td width=30px>$r[code]</td>";
											if ($r['Menu'] <> '1')
											{
											echo "<td width=100px><a href=home.php?hal=setup/Submenu&id=$r[id] enctype=multipart/form-data>$r[name_menu]</a></td>";
											}
											else
											{
											echo "<td width=100px>$r[name_menu]</td>";
											}
											echo "<td>$r[description]</td>
											<td>$r[Link]</td>
											<td>$r[created_datetime] ($r[created_user])</td>
											<td>$r[update_datetime] ($r[update_user])</td>
											<td align=center width=120px>
											<a href=home.php?hal=setup/tbl_menu&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action_setup/hapus_tbl_menu&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
