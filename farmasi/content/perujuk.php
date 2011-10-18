<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_perujuk.php", {mysearchString: ""+inputString+""}, function(data){
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
</head>
<?php
$q= mysql_query("SELECT * FROM perujuk WHERE kd_perujuk = '$_GET[kd_perujuk]'");
$r = mysql_fetch_array($q);
?>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Dokter Perujuk</b></font></td>
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
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="right">
								<div id="container">
								<form method="post" action="home.php?hal=#" enctype="multipart/form-data">
								Cari Nama Perujuk : <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="30">
								&nbsp;<input type="submit" value="Cari"> &nbsp;
								</form>
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 100px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
							</td>
							<td width="80px" align="right">
								<input id="button"  type="submit" value="Tambah Data" name="button" >
								<div id="popupContact" >
								<a id="popupContactClose" style="text-decoration:none; "><img src="images/icon/close.png" title="Close">&nbsp;</a>
								<h1>&nbsp;Data Perujuk AJAH</h1>
									<div style="overflow:auto; height:320px;"> 
									<p id="contactArea">
									<?php
									if ($r) 
									{
										echo '<form method=post action=home.php?hal=action/update_perujuk enctype=multipart/form-data>';
									}
									else
									{
										echo '<form method=post action=home.php?hal=action/insert_perujuk enctype=multipart/form-data>';
									}
									?>
									
									<table border="0" cellpadding="2" cellspacing="2" width="380px" align="center" bgcolor="#FFFFFF">
										<tr>
											<td >Kode Perujuk </td>
											<td> : </td>
											<td><input type="text" name="kd_perujuk" size="15" value="<?= $r['kd_perujuk']?>"></td>
										</tr>
										<tr>
											<td>Nama </td>
											<td> : </td>
											<td><input type="text" name="nama" size="30" value="<?= $r['nama']?>"></td>
										</tr>
										<tr>
											<td>SEX </td>
											<td> : </td>
											<td><select name="sex">
													<?php
													if ($r['sex']=="")
													{
														echo "<option value='' selected>--Pilih--</option>";
														echo "<option value=L>Laki-laki</option>";
														echo "<option value=P>Perempuan</option>";
													}
													else
													if ($r['sex']=="L")
													{
														echo "<option value='' >-Pilih-</option>";
														echo "<option value=L selected>Laki-laki</option>";
														echo "<option value=P>Perempuan</option>";								
													}
													else
													{
														echo "<option value=''>-Pilih-</option>";
														echo "<option value=L>Laki-laki</option>";
														echo "<option value=P selected>Perempuan</option>";
													}
													?>
												  </select>
											</td>
										</tr>
										<tr valign="top">
											<td>Alamat </td>
											<td> : </td>
											<td valign="top"><textarea name="alamat" style="width:180px; height:80px; "><?= $r['alamat']?></textarea></td>
										</tr>
										<tr>
											<td>Spesialis </td>
											<td> : </td>
											<td>
											<select name="spesialis">
											<option value="">--Pilih--</option>
											<?php
												$qt=mysql_query("SELECT * FROM spesialis");
												while ($rt=mysql_fetch_array($qt))
												{
													if ($rt['kd_spesialis']==$r['spesialis'])
													{
														echo "<option value='$rt[kd_spesialis]' selected>$rt[deskripsi]</option>";
													}
													else
													{
														echo "<option value='$rt[kd_spesialis]'>$rt[deskripsi]</option>";
													}
												}
											?>
											</select>
											</td>
										</tr>
										<tr>
											<td>No Telepon </td>
											<td> : </td>
											<td><input type="text" name="no_tlp" size="15" value="<?= $r['no_tlp']?>"></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td><input type="submit" value="Simpan"></td>
										</tr>
									</table>
									</form>
									</p>
									</div>
								</div>
							</td>
						</tr>
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
								
									$rowsPerPage = 20;


									$pageNum = 1;

									if(isset($_GET['page']))
									{
    									$pageNum = $_GET['page'];
									}

									$offset = ($pageNum - 1) * $rowsPerPage;

									$query  = mysql_query ("SELECT * FROM perujuk ORDER BY kd_perujuk ASC
											   LIMIT $offset, $rowsPerPage");
									//$result = mysql_query($query) or die('Error, query failed');
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF>Nama</font></td>
												<td><font color=#FFFFFF>Spesialis</font></td>
												<td><font color=#FFFFFF width=160px>Action</font></td>
											</tr>';
									$no = 1;
									while ($result = mysql_fetch_array($query))
									{
										$qs=mysql_query("SELECT * FROM spesialis WHERE kd_spesialis = '$result[spesialis]'");
										$rs=mysql_fetch_array($qs);
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td width=70px>$result[kd_perujuk]</td>
											<td>$result[nama]</td>
											<td>$rs[deskripsi]</td>
											<td align=center width=160px><a href=#&kd_perujuk=$result[kd_perujuk] id=button2>
											<font size=-1>EDIT</font></a>"; ?>
											
											<div id="popupContact2">
								<a id="popupContactClose2" style="text-decoration:none; "><img src="images/icon/close.png" title="Close">&nbsp;</a>
								<h1>&nbsp;Edit Data Perujuk</h1>
									<div style="overflow:auto; height:320px;"> 
									<p id="contactArea2">
									<?php
										echo '<form method=post action=home.php?hal=action/update_perujuk enctype=multipart/form-data>';

										
									?>
									
									<table border="0" cellpadding="2" cellspacing="2" width="380px" align="center" bgcolor="#FFFFFF">
										<tr>
											<td >Kode Perujuk </td>
											<td> : </td>
											<td><input type="text" name="kd_perujuk" size="15" value="<?= $r['kd_perujuk']?>"></td>
										</tr>
										<tr>
											<td>Nama </td>
											<td> : </td>
											<td><input type="text" name="nama" size="30" value="<?= $r['nama']?>"></td>
										</tr>
										<tr>
											<td>SEX </td>
											<td> : </td>
											<td><select name="sex">
													<?php
													if ($r['sex']=="")
													{
														echo "<option value='' selected>--Pilih--</option>";
														echo "<option value=L>Laki-laki</option>";
														echo "<option value=P>Perempuan</option>";
													}
													else
													if ($r['sex']=="L")
													{
														echo "<option value='' >-Pilih-</option>";
														echo "<option value=L selected>Laki-laki</option>";
														echo "<option value=P>Perempuan</option>";								
													}
													else
													{
														echo "<option value=''>-Pilih-</option>";
														echo "<option value=L>Laki-laki</option>";
														echo "<option value=P selected>Perempuan</option>";
													}
													?>
												  </select>
											</td>
										</tr>
										<tr valign="top">
											<td>Alamat </td>
											<td> : </td>
											<td valign="top"><textarea name="alamat" style="width:180px; height:80px; "><?= $r['alamat']?></textarea></td>
										</tr>
										<tr>
											<td>Spesialis </td>
											<td> : </td>
											<td>
											<select name="spesialis">
											<option value="">--Pilih--</option>
											<?php
												$qt=mysql_query("SELECT * FROM spesialis");
												while ($rt=mysql_fetch_array($qt))
												{
													if ($rt['kd_spesialis']==$r['spesialis'])
													{
														echo "<option value='$rt[kd_spesialis]' selected>$rt[deskripsi]</option>";
													}
													else
													{
														echo "<option value='$rt[kd_spesialis]'>$rt[deskripsi]</option>";
													}
												}
											?>
											</select>
											</td>
										</tr>
										<tr>
											<td>No Telepon </td>
											<td> : </td>
											<td><input type="text" name="no_tlp" size="15" value="<?= $r['no_tlp']?>"></td>
										</tr>
										<tr>
											<td></td>
											<td></td>
											<td><input type="submit" value="Simpan"></td>
										</tr>
									</table>
									</form>
									</p>
									</div>
								</div>
											
											
											<?php echo " | 
											<a href=\"home.php?hal=action/hapus_perujuk&kd_perujuk=$result[kd_perujuk]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a> | <a href=home.php?hal=content/detail_perujuk&kd_perujuk=$result[kd_perujuk]><font size=-1>DETAIL</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(kd_perujuk) AS numrows FROM perujuk ORDER BY kd_perujuk ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/perujuk\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/perujuk\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/perujuk\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/perujuk\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';

								?>
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
