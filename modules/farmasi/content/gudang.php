<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Gudang</b></font></td>
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
					<td></td>
					<td>
					<?php
						$cari = $_POST['cari'];
					?>
					<font style="font-size:12px;">
					<form method="post" action="home.php?hal=content/gudang" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr align="right">
							<td align="right" width="580px">Masukan Nama Barang :</td>
							<td align="right"><input type="text" name="cari" size="40"></td>
							<td align="right"><input type="submit" value="Cari"></td>
						</tr>
					</table>
					</form>
					</td>
					<td></td>
				</tr>
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									if ($cari)
									{
										$q2 = mysql_query("SELECT * FROM ms_barang WHERE nama_barang LIKE '$cari%'");
										echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Nama Barang</font></td>
												<td><font color=#FFFFFF>Satuan</font></td>
												<td><font color=#FFFFFF>Jumlah</font></td>
												<td><font color=#FFFFFF>Kapasitas</font></td>
												<td><font color=#FFFFFF>Baik</font></td>
												<td><font color=#FFFFFF>Rusak Ringan</font></td>
												<td><font color=#FFFFFF>Rusak Berat</font></td>
											</tr>';
									$no = 1;
									while ($r2 = mysql_fetch_array($q2))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$r2[nama_barang]</td>
											<td>$r2[satuan]</td>";
										echo "<td>$r2[jumlah]</td>
											<td>$r2[kapasitas]</td>
											<td>$r2[kondisi_baik]</td>
											<td>$r2[kondisi_rsk_ringan]</td>
											<td>$r2[kondisi_rsk_berat]</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';
									}
									
									
									else
									{
									$rowsPerPage = 20;

									$pageNum = 1;

									if(isset($_GET['page']))
									{
    									$pageNum = $_GET['page'];
									}

									$offset = ($pageNum - 1) * $rowsPerPage;

									$query  = mysql_query ("SELECT * FROM ms_barang ORDER BY id_barang ASC
											   LIMIT $offset, $rowsPerPage");
									//$result = mysql_query($query) or die('Error, query failed');

									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Nama Barang</font></td>
												<td><font color=#FFFFFF>Satuan</font></td>
												<td><font color=#FFFFFF>Jumlah</font></td>
												<td><font color=#FFFFFF>Kapasitas</font></td>
												<td><font color=#FFFFFF>Baik</font></td>
												<td><font color=#FFFFFF>Rusak Ringan</font></td>
												<td><font color=#FFFFFF>Rusak Berat</font></td>
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
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$result[nama_barang]</td>
											<td>$result[satuan]</td>";
										echo "<td>$result[jumlah]</td>
											<td>$result[kapasitas]</td>
											<td>$result[kondisi_baik]</td>
											<td>$result[kondisi_rsk_ringan]</td>
											<td>$result[kondisi_rsk_berat]</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id_barang) AS numrows FROM ms_barang ORDER BY id_barang ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/gudang\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/gudang\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/gudang\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/gudang\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';
									
									}
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
