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
			$.post("action/string_unit.php", {mysearchString: ""+inputString+""}, function(data){
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Unit</b></font></td>
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
						$q= mysql_query("SELECT * FROM pelayanan WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_unit enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_unit enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
                          <td align="right">Group Unit : </td>
						  <td><select name="Group_id" onChange="window.location='home.php?hal=content/unit&id=<?=$r['id']?>&xGU='+this.options[this.selectedIndex].value">
                              <option value="">--Pilih--</option>
                              <?php
								  	if ($_GET['xGU'])
										{$Gr = $_GET['xGU'];}
						  			else
							 			{$Gr = $r['group_id'];}
									$qj=mysql_query("SELECT * FROM group_unit where f_aktifasi='1'");
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
                            </select>                          </td>
					  </tr>
						<tr>
                          <td align="right"> Unit : </td>
						  <td><select name="Unit_id" >
                              <option value="">--Pilih--</option>
                              <?php
							  		if ($_GET['xGU'])
									{
									$Group = "and group_id = ".$_GET['xGU']."";
									}
									else
									{
									$Group = "and group_id = ".$r['group_id']."";
									}
									$qj=mysql_query("SELECT * FROM tbl_menu where menu='1' ".$Group." and f_aktif='1'");
									while($rj=mysql_fetch_array($qj))
									{
										if($r['unit_id']==$rj['id'])
										{
											echo "<option value='$rj[id]' selected>$rj[name_menu]</option>";
										}
										else
										{
											echo "<option value='$rj[id]'>$rj[name_menu]</option>";
										}
									}
								?>
                            </select>                          </td>
					  </tr>
						<tr>
                          <td align="right">Nama : </td>
						  <td><input type="text" name="nama" size="20" value="<?= $r['nama']?>"></td>
					  </tr>
						<tr>
                          <td align="right">Nama Lain : </td>
						  <td><input type="text" name="nama_lain" size="20" value="<?= $r['nama_lain']?>"></td>
					  </tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<form method="post" action="home.php?hal=content/unit" enctype="multipart/form-data">
							<td align="right">
								<div id="container">
								
								Cari Nama Unit : 
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
						<td><font color=#FFFFFF width=30px>ID</font></td>
						<td><font color=#FFFFFF width=110px>Nama</font></td>
						<td><font color=#FFFFFF width=110>Nama Lain</font></td>
						<td><font color=#FFFFFF>Jenis</font></td>
						<td><font color=#FFFFFF width=120px>Action</font></td>
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
										$q = mysql_query ("SELECT * FROM pelayanan WHERE nama LIKE '$cari%' ORDER BY id desc");
									}
									else
									{
										$q = mysql_query ("SELECT * FROM pelayanan order by id desc");
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
											<td width=30px>$r[id]</td>
											<td width=160px>$r[nama]</td>
											<td width=160px>$r[nama_lain]</td>
											<td>$r[jenis]</td>
											<td align=center width=120px>
											<a href=home.php?hal=content/unit&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_unit&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
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
