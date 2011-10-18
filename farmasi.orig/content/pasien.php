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
			$.post("action/string_pasien.php", {mysearchString: ""+inputString+""}, function(data){
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
	$cari = $_POST['cari'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Pasien</b></font></td>
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
							<td width="130px">
							</td>
							<td align="right">
								<div id="container">
								<form method="post" action="home.php?hal=content/pasien" enctype="multipart/form-data">
								Cari Pasien : 
								  <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="15">
								&nbsp;<input type="submit" value="Cari"> &nbsp;
								</form>
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 100px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
							</td>		
						</tr>
					</table>
					<hr>
					<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<?php
							
							if ($cari)
							{
								$query_rec  = mysql_query ("SELECT * FROM simrs.pasien WHERE id LIKE '$cari%' or nama like '$cari%' ORDER BY id DESC limit 100");
							}
							else
							{
								$query_rec  = mysql_query ("SELECT * FROM simrs.pasien ORDER BY id DESC limit 100");
							}
							$rec=0;
							
							while ($result_rec=mysql_fetch_array($query_rec))
							{
								$rec++;
							}
						?>
							<td align="right"><? echo "Jumlah Record : ".$rec ?>&nbsp;</td>

						</tr>

					</table>
					
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
									
									if ($cari)
									{
									$query  = mysql_query ("SELECT * FROM simrs.pasien WHERE id LIKE '$cari%' or nama like '$cari%' ORDER BY id DESC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM simrs.pasien ORDER BY id DESC
											   LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100% style="border:1px  solid; border-color:#CCCCCC; ">
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>No RM</font></td>
												<td><font color=#FFFFFF>Nama</font></td>
												<td><font color=#FFFFFF>Poliklinik</font></td>
												<td><font color=#FFFFFF>Dokter</font></td>
												<td colspan=2><font color=#FFFFFF width=120px>Action</font></td>
											</tr>';
									$no = 1;
									while ($result = mysql_fetch_array($query))
									{
										$qj = mysql_query("SELECT * FROM simrs.kunjungan,simrs.kunjungan_kamar
											  WHERE pasien_id='$result[id]' AND kunjungan.id=kunjungan_kamar.kunjungan_id");
										$rj = mysql_fetch_array($qj);
										
										$qd = mysql_query("SELECT * FROM simrs.dokter WHERE id = '$rj[dokter_id]'");
										$rd = mysql_fetch_array ($qd);
										
										$qss = mysql_query ("SELECT * FROM simrs.subspesialisasi WHERE id='$rd[subspesialisasi_id]'");
										$rss = mysql_fetch_array ($qss);
										
										$qs = mysql_query("SELECT * FROM simrs.spesialisasi WHERE id = '$rss[spesialisasi_id]'");
										$rs = mysql_fetch_array($qs);
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										
										
										echo "<td width=70px>$result[id]</td>
											<td>$result[nama]</td>
											<td>$rs[nama]</td>
											<td>$rd[nama]</td>
											<td align=center width=60px>
											<form method=post action='home.php?hal=content/history_resep&id=$result[id]&nama=$result[nama]' enctype=multipart/form-data>
												<input type=hidden name=id value='$result[id]'>
												<input type=hidden name=nama value='$result[nama]'>
												<input type=submit value='History'>
											</form>
											</td>
											<td align=center width=60px>
											<form method=post action='home.php?hal=action/insert_no_resep&id=$result[id]' enctype=multipart/form-data>
												<input type=hidden name=id value='$result[id]'>
												<input type=hidden name=nama value='$result[nama]'>
												<input type=submit value='Input Resep'>
											</form>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM simrs.pasien ORDER BY id ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/pasien\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/pasien\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/pasien\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/pasien\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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