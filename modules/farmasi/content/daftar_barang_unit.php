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
			$.post("action/string_daftar_barang.php", {mysearchString: ""+inputString+""}, function(data){
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

<style>
.suggestionsBox2 {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 10px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}


.suggestionsBox3 {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 10px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}

</style>

</head>
<body>
<?php
	$cari = $_POST['cari'];
	//$cari2 = $_POST['cari2'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar Barang</b></font></td>
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
					<font style="font-size:12px;"><br>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr valign="top">
							<td align="Left" height="27px">
								<div id="container">
								<form method="post" action="home.php?hal=content/daftar_barang_unit" enctype="multipart/form-data">
								Cari Kode Barang : <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="15">
								&nbsp;<input type="submit" value="Cari"> &nbsp;
								</form>
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox2" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 100px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
					          <!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								--></td>
							<td align="right">
							<?php
								if ($_GET['f']=='1')
								{
									echo "";
								}
								else
								{
									echo '<form method=post action=home.php?hal=action/insert_spp enctype=multipart/form-data>';
									echo "<input type=submit value='Buat Request'>";
									
									echo '</form>';
								}
							?>	
							
							</td>

						</tr>
						<tr>
							<td colspan="2"><hr></td>
						</tr>
						<tr>
						<?php
							
							if ($cari)
							{
								$query_rec  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE ms_barang.kd_barang LIKE '$cari%' AND barang_unit.barang_id=ms_barang.id AND barang_unit.stok <= barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
							}
							else
							{
								$query_rec  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id  AND barang_unit.stok <= barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
							}
							$rec=0;
							
							while ($result_rec=mysql_fetch_array($query_rec))
							{
								$rec++;
							}
						?>
							<td><br>&nbsp;<strong>Min Stock</strong></td>
							<td align="right"><br /><? echo "Jumlah Record : ".$rec ?>&nbsp;</td>

						</tr>
					</table>

					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
								
									$rowsPerPage = 15;


									$pageNum = 1;

									if(isset($_GET['page']))
									{
    									$pageNum = $_GET['page'];
									}

									$offset = ($pageNum - 1) * $rowsPerPage;
									
									if ($cari)
									{
									$query  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE ms_barang.kd_barang LIKE '$cari%' AND barang_unit.barang_id=ms_barang.id AND barang_unit.stok <= barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id  AND barang_unit.stok <= barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC
											   LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF width=180px>Nama</font></td>
												<td><font color=#FFFFFF width=60px>Stok</font></td>
												<td><font color=#FFFFFF width=80px>H Beli</font></td>
												<td><font color=#FFFFFF width=70px>Expired</font></td>
												<td><font color=#FFFFFF width=100px>Unit</font></td>
												<td><font color=#FFFFFF width=140px>Action</font></td>
											</tr>';
									$no = 1;
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 4;
									$ppmonth = date ("m") + 3;
									$pyear = date("Y") + 0;
									while ($result = mysql_fetch_array($query))
									{
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										
										
										echo "<td width=70px>$result[kd_barang]</td>
											<td width=180px>$result[nama]</td>";
											if ($result[3] == 0)
											{
												echo "<td align=right width=60px><font color=red>$result[3]</font></td>";
											}
											else if ($result['min_stok'] >= $result[3])
											{
												echo "<td align=right width=60px><font color=blue>$result[3]</font></td>";
											}
											else
											{
												echo "<td align=right width=60px>$result[3]</td>";
											}
											echo "<td align=right width=80px>";
											rupiah($result[harga_dosp]);
											echo "</td>";
											if (($pmonth == $result['ex_month']) AND ($pyear == $result['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
											}
											else if ((($ppmonth > $result['ex_month']) AND ($pyear >= $result['ex_year']) AND ($pdate > $result['ex_date'])) OR 
											(($ppmonth > $result['ex_month']) AND ($pyear >= $result['ex_year'])))
											{
												//$qy = mysql_query("UPDATE barang_unit SET flags='0' WHERE barang_id='$result[barang_id]'"); 
												echo "<td width=70px align=center><font color=red>$result[expire_date]</font></td>";
											}
											else if (($ppmonth == $result['ex_month']) AND ($pyear == $result['ex_year']))
											{
												echo "<td width=70px align=center><font color=red>$result[expire_date]</font></td>";
											}
											else
											{
											 	echo "<td width=70px align=center>$result[expire_date]</td>";
											}
											$q_unit = mysql_query("SELECT * FROM pelayanan WHERE unit_id = '$result[unit_id]'");
											$r_unit = mysql_fetch_array($q_unit);
											
											echo "<td align=left width=100px>$r_unit[jenis]</td>
											<td align=center width=70px>";
											/*<a href=home.php?hal=content/input_daftar_barang&barang_id=$result[barang_id]>
											<font style=font-size:12px;>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_barang&barang_id=$result[barang_id]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $result[nama] ?')\">
											<font style=font-size:12px;>HAPUS</font></a> |*/ 
											echo "<a href=home.php?hal=content/detail_barang_unit&barang_id=$result[barang_id]><font style=font-size:12px;>DETAIL</font></a>
											</td>
											</tr>";
											
										$no++;
									}
									echo '</table><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(barang_unit.id) AS numrows FROM barang_unit WHERE stok <= min_stok ORDER BY ex_year,ex_month,ex_date ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
					
					<br>
					<br>
					
					
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
						<?php
							
							if ($cari)
							{
								$query_rec2  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE ms_barang.kd_barang LIKE '$cari%' AND barang_unit.barang_id=ms_barang.id AND barang_unit.stok > barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
							}
							else
							{
								$query_rec2  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id  AND barang_unit.stok > barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
							}
							$rec2=0;
							
							while ($result_rec2=mysql_fetch_array($query_rec2))
							{
								$rec2++;
							}
						?>
							<td><br>&nbsp;<strong>Max Stock</strong></td>
							<td align="right"><br /><? echo "Jumlah Record : ".$rec2 ?>&nbsp;</td>

						</tr>
					</table>

					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
								
									$rowsPerPage2 = 15;


									$pageNum2 = 1;

									if(isset($_GET['page']))
									{
    									$pageNum2 = $_GET['page'];
									}

									$offset2 = ($pageNum2 - 1) * $rowsPerPage2;
									
									if ($cari)
									{
									$query2  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE ms_barang.kd_barang LIKE '$cari%' AND barang_unit.barang_id=ms_barang.id AND barang_unit.stok > barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
									}
									else
									{
									$query2  = mysql_query ("SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id  AND barang_unit.stok > barang_unit.min_stok ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC
											   LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF width=180px>Nama</font></td>
												<td><font color=#FFFFFF width=60px>Stok</font></td>
												<td><font color=#FFFFFF width=80px>H Beli</font></td>
												<td><font color=#FFFFFF width=70px>Expired</font></td>
												<td><font color=#FFFFFF width=100px>Unit</font></td>
												<td><font color=#FFFFFF width=140px>Action</font></td>
											</tr>';
									$no2 = 1;
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 4;
									$ppmonth = date ("m") + 3;
									$pyear = date("Y") + 0;
									while ($result2 = mysql_fetch_array($query2))
									{
										if ($no2%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										
										
										echo "<td width=70px>$result2[kd_barang]</td>
											<td width=180px>$result2[nama]</td>";
											if ($result2[3] == 0)
											{
												echo "<td align=right width=60px><font color=red>$result2[3]</font></td>";
											}
											else if ($result2['min_stok'] >= $result2[3])
											{
												echo "<td align=right width=60px><font color=blue>$result2[3]</font></td>";
											}
											else
											{
												echo "<td align=right width=60px>$result2[3]</td>";
											}
											echo "<td align=right width=80px>";
											rupiah($result2[harga_dosp]);
											echo "</td>";
											if (($pmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
											}
											else if ((($ppmonth > $result2['ex_month']) AND ($pyear >= $result2['ex_year']) AND ($pdate > $result2['ex_date'])) OR 
											(($ppmonth > $result2['ex_month']) AND ($pyear >= $result2['ex_year'])))
											{
												//$qy = mysql_query("UPDATE barang_unit SET flags='0' WHERE barang_id='$result[barang_id]'"); 
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}
											else if (($ppmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}
											else
											{
											 	echo "<td width=70px align=center>$result2[expire_date]</td>";
											}
											$q_unit2 = mysql_query("SELECT * FROM pelayanan WHERE unit_id = '$result2[unit_id]'");
											$r_unit2 = mysql_fetch_array($q_unit2);
											
											echo "<td align=left width=100px>$r_unit2[jenis]</td>
											<td align=center width=70px> 
											<a href=home.php?hal=content/detail_barang_unit&barang_id=$result2[barang_id]>
											<font style=font-size:12px;>DETAIL</font></a>
											</td>
											</tr>";
										$no2++;
									}
									echo '</table><br>';
									

									echo '<div align=center><br>';

									$query2   = "SELECT COUNT(id) AS numrows FROM barang_unit WHERE stok > min_stok ORDER BY ex_year,ex_month,ex_date ASC";
									$result2  = mysql_query($query2) or die('Error, query failed');
									$row2     = mysql_fetch_array($result2, MYSQL_ASSOC);
									$numrows2 = $row2['numrows'];

									$maxPage2 = ceil($numrows2/$rowsPerPage2);

									$self2 = $_SERVER['PHP_SELF'];

									if ($pageNum2 > 1)
									{
   										$page2 = $pageNum2 - 1;
   								   	 	$prev2 = " <a href=\"$self2?page=$page2&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first2 = " <a href=\"$self2?page=1&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev2  = ' [&laquo;] ';
										$first2 = ' [&laquo;&laquo;] ';
									}

									if ($pageNum2 < $maxPage2)
									{
    									$page2 = $pageNum2 + 1;
    									$next2 = " <a href=\"$self2?page=$page2&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last2 = " <a href=\"$self2?page=$maxPage2&hal=content/daftar_barang_unit\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next2 = ' [&raquo;] ';
    									$last2 = ' [&raquo;&raquo;] ';
									}

										echo $first2 . $prev2 . "Halaman <strong>$pageNum2</strong> dari <strong>$maxPage2</strong> " . $next2 . $last2;
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
