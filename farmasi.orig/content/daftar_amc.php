<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<?php
	include "action/amc2.php";
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
			$.post("action/string_amc.php", {mysearchString: ""+inputString+""}, function(data){
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
	
	if ($_POST['tahun'])
	{
		$tahun = $_POST['tahun'];
	}
	elseif ($_GET['tahun'])
	{
		$tahun = $_GET['tahun'];
	}
	else
	{
		$tahun = date("Y");
	}
								
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Rata-rata Penggunaan Obat Per Bulan</b></font></td>
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
							<form method="post" action="home.php?hal=content/daftar_amc" enctype="multipart/form-data">

							<td width="80px">
								<select name="tahun">
									<option value="">--Pilih--</option>
								<?php
									$q_tahun=mysql_query("SELECT DISTINCT(tahun) FROM amc2");
									while ($r_tahun=mysql_fetch_array($q_tahun))
									{
										echo "<option value='$r_tahun[tahun]'>$r_tahun[tahun]</option>";
									}
								?>
								</select>
							</td>
							<td>
								&nbsp;<input type="submit" value="Cari"> &nbsp;
							</td>
							</form>
							
							<td align="right">
							<form method="post" enctype="multipart/form-data" action="content/lap_amc_pdf.php">
								<input type="hidden" name="tahun" value="<?= $tahun?>" /> 
								<input type="submit" value="Laporan PDF">
							</form>
							</td>
							<td align="right" width="100px">
							<form method="post" enctype="multipart/form-data" action="content/lap_amc.php">
								<input type="hidden" name="tahun" value="<?= $tahun?>" />
								<input type="submit" value="Laporan Excel">
							</form>
							</td>
							</tr>
						<tr>
							<td colspan="4"><hr></td>
						</tr>
						<tr>
						<?php
							
							if ($tahun)
							{
								$query_rec  = mysql_query ("SELECT * FROM amc2 WHERE tahun LIKE '$tahun%' ORDER BY barang_id ASC");
							}
							else
							{
								$query_rec  = mysql_query ("SELECT * FROM amc2 ORDER BY barang_id ASC");
							}
							$rec=0;
							
							while ($result_rec=mysql_fetch_array($query_rec))
							{
								$rec++;
							}
						?>
							<td align="left"><?php echo "Tahun : " .$tahun; ?></td>
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
									$query  = mysql_query ("SELECT * FROM amc2,ms_barang WHERE amc2.barang_id = ms_barang.kd_barang AND amc2.tahun LIKE '$tahun%' ORDER BY amc2.barang_id ASC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM amc2,ms_barang WHERE amc2.tahun = '$tahun' AND amc2.barang_id = ms_barang.kd_barang ORDER BY amc2.barang_id ASC LIMIT $offset, $rowsPerPage");
									}
									echo '<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">';
									echo '<table cellpadding=2 cellspacing=2 width=800px >
											<tr bgcolor=#414141 align=center>
												<td rowspan=2 width=70px><font color=#FFFFFF >Kode</font></td>
												<td rowspan=2  width=280px><font color=#FFFFFF>Nama</font></td>
												<td colspan=3><font color=#FFFFFF >Penggunaan 3 Bulan Terakhir</font></td>
												<td rowspan=2 width=60px><font color=#FFFFFF width=80px>Rata-rata</font></td>
											</tr>
											<tr bgcolor=#414141 align=center>
												<td width=40px><font color=#FFFFFF>B-2</font></td>
												<td width=40px><font color=#FFFFFF>B-1</font></td>
												<td width=40px><font color=#FFFFFF>B</font></td>
											</tr>';
									$no = 1;
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
									

										echo "<td width=70px>$result[barang_id]</td>
											<td width=280px>$result[nama]</td>
											<td width=40px align=right>$result[b_2]</td>
											<td width=40px align=right>$result[b_1]</td>
											<td width=40px align=right>$result[b1]</td>
											<td align=right width=60px>$result[rata_rata]</td>
											</td>
											</tr>";
											
										$no++;
									}
									echo '</table></div><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM amc2 ORDER BY barang_id ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_amc&tahun=$tahun\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_amc&tahun=$tahun\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_amc&tahun=$tahun\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_amc&tahun=$tahun\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
