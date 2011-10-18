<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<!-- suggestion -->

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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Stok Opname</b></font></td>
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
								<?php
									if ($_POST['tgl'])
									{
										$tgl = $_POST['tgl'];
									}
									elseif ($_GET['tgl'])
									{
										$tgl = $_GET['tgl'];
									}
									else
									{
										$tgl = date("d/m/Y");
									}
								?>
							<form method="post" action="home.php?hal=content/stok_opname" enctype="multipart/form-data">

							<td width="80px">
								<select name="tgl">
									<option value="">--Pilih--</option>
								<?php
									$q_tgl=mysql_query("SELECT DISTINCT(tgl) FROM stok_opname");
									while ($r_tgl=mysql_fetch_array($q_tgl))
									{
										echo "<option value='$r_tgl[tgl]'>$r_tgl[tgl]</option>";
									}
								?>
								</select>
							</td>
							<td>
								&nbsp;<input type="submit" value="Cari"> &nbsp;
							</td>
							</form>
							
							<td align="right">
							<form method="post" enctype="multipart/form-data" action="content/lap_stok_opname_pdf.php">
								<input type="hidden" name="tgl" value="<?= $tgl?>">
								<input type="submit" value="Laporan PDF">
							</form>
							</td>
							<td align="right" width="90px">
							<form method="post" enctype="multipart/form-data" action="content/lap_stok_opname.php">
								<input type="hidden" name="tgl" value="<?= $tgl?>">
								<input type="submit" value="Laporan Excel">
							</form>
							</td>

							
							<td width="80px">
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
							    <input type="button" src="javascript:void(0);" value="Buat Stok Opname" onClick="PopupCenter('content/input_stok_opname.php', 'myPop1',400,200);">
							</td>
						</tr>
					</table>
					<hr/>
					<?php
						if ($tgl)
						{
							$query_rec  = mysql_query ("SELECT * FROM stok_opname,ms_barang WHERE stok_opname.tgl LIKE '$tgl%'
									  AND stok_opname.barang_id=ms_barang.id ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
						}
						else
						{
							$date = date("d/m/Y");
							$query_rec  = mysql_query ("SELECT * FROM stok_opname,ms_barang WHERE stok_opname.tgl = '$date' 
										  AND stok_opname.barang_id=ms_barang.id ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC");
						}
						$rec=0;
						while ($result_rec=mysql_fetch_array($query_rec))
						{
							$rec++;
						}
						
					?>
					<table border="0" cellspacing="2" cellpadding="2" width="100%">
						<tr>
							<td align="left"><?php echo "Tertanggal :" .$tgl; ?></td>
							<td align="right"><?php echo "Jumlah Record :" .$rec; ?></td>
						</tr>
					</table>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">
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
									
									if ($tgl)
									{
									$query  = mysql_query ("SELECT * FROM stok_opname,ms_barang WHERE stok_opname.tgl LIKE '$tgl%'
											  AND stok_opname.barang_id=ms_barang.id ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC
											  LIMIT $offset, $rowsPerPage");
									}
									else
									{
									$date = date("d/m/Y");
									$query  = mysql_query ("SELECT * FROM stok_opname,ms_barang WHERE stok_opname.tgl = '$date' 
											  AND stok_opname.barang_id=ms_barang.id ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC 
											  LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=1100px>
											<tr bgcolor=#414141 align=center>
												<td rowspan=2><font color=#FFFFFF width=70px>Kode</font></td>
												<td rowspan=2><font color=#FFFFFF>Nama</font></td>
												<td rowspan=2><font color=#FFFFFF>Exp</font></td>
												<td rowspan=2><font color=#FFFFFF>Harga</font></td>
												<td colspan=8><font color=#FFFFFF>Stok</font></td>
												<td rowspan=2><font color=#FFFFFF>Jumlah</font></td>
											</tr>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>MS</font></td>
												<td><font color=#FFFFFF>APT</font></td>
												<td><font color=#FFFFFF>RJ</font></td>
												<td><font color=#FFFFFF>RI</font></td>
												<td><font color=#FFFFFF>IGD</font></td>
												<td><font color=#FFFFFF>OCA</font></td>
												<td><font color=#FFFFFF>LAB</font></td>
												<td><font color=#FFFFFF>RAD</font></td>
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
											<td>$result[nama]</td>";
										
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
											
										echo "<td align=right>";rupiah($result[harga_dosp]); echo"</td>
											<td align=right>$result[stok_ms]</td>
											<td align=right>$result[stok_apt]</td>
											<td align=right>$result[stok_rj]</td>
											<td align=right>$result[stok_ri]</td>
											<td align=right>$result[stok_igd]</td>
											<td align=right>$result[stok_oca]</td>
											<td align=right>$result[stok_lab]</td>
											<td align=right>$result[stok_rad]</td>
											<td align=right>$result[jumlah]</td>";
										$no++;
										
									}
									echo '</table><br>';
									?>
							</td>
						</tr>
					</table>
					</div>
					
					<?php
					echo '<div align=center><br>';

									$query   = "SELECT COUNT(stok_opname.id) AS numrows FROM stok_opname,ms_barang WHERE stok_opname.tgl='$tgl' 
										  	 	AND stok_opname.barang_id=ms_barang.id ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_date ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/stok_opname&tgl=$tgl\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/stok_opname&tgl=$tgl\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/stok_opname&tgl=$tgl\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/stok_opname&tgl=$tgl\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';
					?>
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
