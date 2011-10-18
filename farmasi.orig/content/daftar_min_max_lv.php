<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<?php
	include "action/amc.php";
	include "action/adc.php";
	include "action/safety_stock.php";
	include "action/lv_stock.php";
	include "action/min_max_quantity.php";
	include "action/order_quantity.php";
?>
<!-- suggestion -->
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_min_max_lv.php", {mysearchString: ""+inputString+""}, function(data){
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Min-Max Stock Level</b></font></td>
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
								<form method="post" action="home.php?hal=content/daftar_min_max_lv" enctype="multipart/form-data">
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
							<form method="post" enctype="multipart/form-data" action="content/lap_min_max_lv_pdf.php">
								<input type="submit" value="Laporan PDF">
							</form>
							</td>
							<td align="right" width="100px">
							<form method="post" enctype="multipart/form-data" action="content/lap_min_max_lv.php">
								<input type="submit" value="Laporan Excel">
							</form>
							</td>
						</tr>
						<tr>
							<td colspan="3"><hr></td>
						</tr>
						<tr>
						<?php
							
							if ($cari)
							{
								$query_rec  = mysql_query ("SELECT * FROM stok_level,ms_barang WHERE stok_level.barang_id = ms_barang.kd_barang AND ms_barang.kd_barang LIKE '$cari%' AND ms_barang.flags <> '9' ORDER BY stok_level.barang_id ASC");
							}
							else
							{
								$query_rec  = mysql_query ("SELECT * FROM stok_level,ms_barang WHERE stok_level.barang_id = ms_barang.kd_barang AND ms_barang.flags <> '9' ORDER BY stok_level.barang_id ASC");
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
									$query  = mysql_query ("SELECT * FROM stok_level,ms_barang WHERE stok_level.barang_id = ms_barang.kd_barang AND ms_barang.kd_barang LIKE '$cari%' AND ms_barang.flags <> '9' ORDER BY stok_level.barang_id ASC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM stok_level,ms_barang WHERE stok_level.barang_id = ms_barang.kd_barang AND ms_barang.flags <> '9' ORDER BY stok_level.barang_id ASC LIMIT $offset, $rowsPerPage");
									}
									echo '<div style="border:1px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">';
									echo '<table cellpadding=2 cellspacing=2 width=100% >
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF width=280px>Nama</font></td>
												<td><font color=#FFFFFF width=80px>Min Stock Level</font></td>
												<td><font color=#FFFFFF width=80px>Max Stock Level</font></td>
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
											<td align=right width=80px>$result[min_stock_lv] Hari</td>
											<td align=right width=80px>$result[max_stock_lv] Hari</td>
											</tr>";
											
										$no++;
									}
									echo '</table></div><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(stok_level.id) AS numrows FROM stok_level,ms_barang WHERE stok_level.barang_id=ms_barang.kd_barang AND ms_barang.flags<>'9' ORDER BY stok_level.barang_id ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_min_max_lv\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_min_max_lv\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_min_max_lv\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_min_max_lv\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
