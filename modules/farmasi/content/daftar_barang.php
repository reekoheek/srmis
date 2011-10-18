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
							<td align="Left">
								<div id="container">
								<form method="post" action="home.php?hal=content/daftar_barang" enctype="multipart/form-data">
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
							<form method="post" enctype="multipart/form-data" action="content/lap_ms_barang_pdf.php">
								<input type="submit" value="Laporan PDF">
							</form>
							</td>
							<td align="right" width="100px">
							<form method="post" enctype="multipart/form-data" action="content/lap_ms_barang.php">
								<input type="submit" value="Laporan Excel">
							</form>
							</td>
							
							<td align="right" width="106px">
							
							<?php
									echo '<form method=post action=home.php?hal=content/input_daftar_barang enctype=multipart/form-data>';
									echo "<input type=submit value='Tambah Barang'>";
									
									echo '</form>';
							?>
							</td>
						</tr>
						<tr>
							<td colspan="4"><hr></td>
						</tr>
						<tr>
						<?php
							
							if ($cari)
							{
								$query_rec  = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang LIKE '$cari%' AND flags <> '9' ORDER BY ex_year,ex_month,ex_date ASC");
							}
							else
							{
								$query_rec  = mysql_query ("SELECT * FROM ms_barang WHERE flags <> '9' ORDER BY ex_year,ex_month,ex_date ASC");
							}
							$rec=0;
							
							while ($result_rec=mysql_fetch_array($query_rec))
							{
								$rec++;
							}
						?>
							<td align="right" colspan="4"><? echo "Jumlah Record : ".$rec ?>&nbsp;</td>

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
									$query  = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang LIKE '$cari%' AND flags <> '9' ORDER BY ex_year,ex_month,ex_date ASC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM ms_barang WHERE flags <> '9' ORDER BY ex_year,ex_month,ex_date ASC
											   LIMIT $offset, $rowsPerPage");
									}
									echo '<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">';
									echo '<table cellpadding=2 cellspacing=2 width=800px >
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF width=180px>Nama</font></td>
												<td><font color=#FFFFFF width=60px>Stok</font></td>
												<td><font color=#FFFFFF width=80px>H Beli</font></td>
												<td><font color=#FFFFFF width=70px>Expired</font></td>
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
											<td width=180px>$result[nama]</td>
											<td width=60px align=right>$result[stok]</td>
											<td align=right width=80px>";
											rupiah($result[harga_dosp]);
											echo "</td>";
											if (($pmonth == $result['ex_month']) AND ($pyear == $result['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
											}
											else if ((($ppmonth > $result['ex_month']) AND ($pyear >= $result['ex_year']) AND ($pdate > $result['ex_date'])) OR 
											(($ppmonth > $result['ex_month']) AND ($pyear >= $result['ex_year'])))
											{
												//$qy = mysql_query("UPDATE ms_barang SET flags='9', status='Non-Aktif' WHERE id='$result[id]'"); 
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
											echo "<td align=center width=200px>
											<a href=home.php?hal=content/add_daftar_barang&id=$result[id]>
											<font style=font-size:12px;>ADD STOCK</font></a> | 
											<a href=home.php?hal=content/input_daftar_barang&id=$result[id]>
											<font style=font-size:12px;>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_barang&id=$result[id]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $result[nama] ?')\">
											<font style=font-size:12px;>HAPUS</font></a> |
											<a href=home.php?hal=content/detail_barang&barang_id=$result[id]><font style=font-size:12px;>DETAIL</font></a>
											</td>
											</tr>";
											
										$no++;
									}
									echo '</table></div><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM ms_barang WHERE flags<>'9' ORDER BY ex_year,ex_month,ex_date ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_barang\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_barang\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_barang\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_barang\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
