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
			$.post("action/string_obat_rawat_jalan.php", {mysearchString: ""+inputString+""}, function(data){
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
									if ($_POST['no_racik'])
									{
									$id = $_POST['id'];
									$pasien_id = $_POST['pasien_id'];
									$param_no = $_POST['param_no'];
									$no_resep = $_POST['no_resep'];
									$no_racik = $_POST['no_racik'];
									$nama = $_POST['nama_racikan'];
									$ket =$_POST['ket'];
									$ket = $_POST['ket'];
									$fld02 = $_POST['fld02'];
									}
									else
									{
										if ($_POST['nama_racikan'])
										{
											$id = $_POST['id'];
											$pasien_id = $_POST['pasien_id'];
											$param_no = $_POST['param_no'];
											$no_resep = $_POST['no_resep'];
											$no_racik = $_POST['no_racik'];
											$nama_racikan = $_POST['nama_racikan'];
											$ket =$_POST['ket'];
											$fld02 = $_POST['fld02'];
											$nama=$_GET['nama'];
										}
										else
										{
											$nama_racikan = $_GET['nama_racikan'];
											$nama=$_GET['nama'];
											$id = $_GET['id'];
											$pasien_id = $_GET['pasien_id'];
											$param_no = $_GET['param_no'];
											$no_resep = $_GET['no_resep'];
											$no_racik = $_GET['no_racik'];
											$ket = $_GET['ket'];
											$fld02 = $_GET['fld02'];
										}
									
									}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar Obat</b></font></td>
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
								<form method="post" action="home.php?hal=content/daftar_racik_obat_rawat_jalan" enctype="multipart/form-data">
								Cari Kode Obat : <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="15">
								<?php
								echo "<input type=hidden name=nama_racikan value='".$_POST['nama_racikan']."'>
										<input type=hidden name=nama_racikan value='$nama'>
										<input type=hidden name=ket value='$ket'>
											<input type=hidden name=ket value='".$_POST['ket']."'>
											<input type=hidden name=kd_barang value='$result[kd_barang]'>
											<input type=hidden name=id value='$id'>
											<input type=hidden readonly=true value='$no_resep' name=no_resep>
											<input type=hidden readonly=true value='$no_racik' name=no_racik>
											<input type=hidden readonly=true value='$param_no' name=param_no>
											<input type=hidden name=pasien_id value='$pasien_id' readonly=true>
											<input type=hidden name=fld02 value='$fld02'>";
								?>
								&nbsp;<input type="submit" value="Cari"> &nbsp;
								</form>
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 150px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
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
									
									if ($cari)
									{
									$query  = mysql_query ("SELECT * FROM ms_barang,barang_unit WHERE barang_unit.flags='1' AND ms_barang.id=barang_unit.barang_id AND 
									barang_unit.unit_id='51' AND ms_barang.kd_barang LIKE '$cari%' ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
									}
									else
									{
									$query  = mysql_query ("SELECT * FROM ms_barang,barang_unit WHERE barang_unit.flags='1' AND ms_barang.id=barang_unit.barang_id AND 
									barang_unit.unit_id='51' ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC
											   LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Kode</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Stok</font></td>
												<td><font color=#FFFFFF width=60px>Action</font></td>
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
										
										
										echo "<td width=70px>$result[kd_barang]</td>
											<td>$result[nama]</td>
											<td align=right>";
											rupiah($result[harga_dosp]);
											echo "</td>
											<td align=right>$result[stok]</td>
											<td align=center width=60px>
											<form method=post action='home.php?hal=content/input_racik_obat_rawat_jalan' enctype=multipart/form-data>
											<input type=hidden name=nama_racikan value='$nama_racikan'>
											<input type=hidden name=ket value='$ket'>
											<input type=hidden name=kd_barang value='$result[kd_barang]'>
											<input type=hidden name=id value='$id'>
											<input type=hidden readonly=true value='$no_resep' name=no_resep>
											<input type=hidden readonly=true value='$no_racik' name=no_racik>
											<input type=hidden readonly=true value='$param_no' name=param_no>
											<input type=hidden name=pasien_id value='$pasien_id' readonly=true>
											<input type=hidden name=nama value='$nama' readonly=true>
											<input type=hidden name=fld02 value='$fld02'>
											<input type=Submit value=Pilih>
											</form>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';
									

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(ms_barang.kd_barang) AS numrows FROM ms_barang, barang_unit WHERE barang_unit.flags='1' AND ms_barang.id=barang_unit.barang_id AND 
									barang_unit.unit_id='".$_SESSION['U_UNITID']."' ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC";

									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_racik_obat_rawat_jalan&nama=$nama&ket=$ket&id=$id&no_resep=$no_resep&no_racik=$no_racik&param_no=$param_no&pasien_id=$pasien_id&nama_racikan=$nama_racikan\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_racik_obat_rawat_jalan&nama=$nama&ket=$ket&id=$id&no_resep=$no_resep&no_racik=$no_racik&param_no=$param_no&pasien_id=$pasien_id&nama_racikan=$nama_racikan\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_racik_obat_rawat_jalan&nama=$nama&ket=$ket&id=$id&no_resep=$no_resep&no_racik=$no_racik&param_no=$param_no&pasien_id=$pasien_id&nama_racikan=$nama_racikan\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_racik_obat_rawat_jalan&nama=$nama&ket=$ket&id=$id&no_resep=$no_resep&no_racik=$no_racik&param_no=$param_no&pasien_id=$pasien_id&nama_racikan=$nama_racikan\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
