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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Supplier</b></font></td>
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
						$q= mysql_query("SELECT * FROM supplier WHERE kode_supplier = '$_GET[kode_supplier]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_supplier enctype=multipart/form-data>';
							echo "<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr valign=top>
										<td align=right>Kode Supplier: </td>
										<td><input type=text name=kode_supplier size=10 value='$r[kode_supplier]' readonly=true style=background-color:#CCCCCC></td>
									</tr>";
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_supplier enctype=multipart/form-data>';
							echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr valign=top>
										<td align=right>Kode Supplier: </td>
										<td><input type=text name=kode_supplier size=10></td>
									</tr>';
						}
					?>
						<tr valign="top">
							<td align="right">Nama : </td>
							<td><input type="text" name="nama" size="35" value="<?= $r['nama']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Alamat: </td>
							<td><textarea name="alamat" style="width:183px; height:70px; "><?=$r['alamat']?></textarea></td>
						</tr>
						<tr valign="top">
							<td align="right">No Telepon: </td>
							<td><input type="text" name="no_telp" size="20" value="<?= $r['no_telp']?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp;<input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
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

									$query  = mysql_query ("SELECT * FROM supplier ORDER BY kode_supplier ASC
											   LIMIT $offset, $rowsPerPage");
									//$result = mysql_query($query) or die('Error, query failed');

									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Nama Supplier</font></td>
												<td><font color=#FFFFFF>Alamat</font></td>
												<td><font color=#FFFFFF>No. Telepon</font></td>
												<td><font color=#FFFFFF>Action</font></td>
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
										echo "<td>$result[kode_supplier]</td>
											<td>$result[nama]</td>
											<td>$result[alamat]</td>
											<td>$result[no_telp]</td>
											<td align=center>
											<a href=home.php?hal=content/supplier&kode_supplier=$result[kode_supplier]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_supplier&kode_supplier=$result[kode_supplier]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(kode_supplier) AS numrows FROM supplier ORDER BY kode_supplier ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/supplier\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/supplier\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/supplier\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/supplier\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
