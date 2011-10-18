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
					<?php
						
						$qw= mysql_query("SELECT * FROM pasien WHERE LAST_INSERT_ID(param_no)");
						$rw = mysql_fetch_array($qw);
						$temp = $rw['param_no'];
						$count = $temp;
						$digit1 = (int) ($count % 10);
						$digit2 = (int) (($count % 100) / 10);
						$digit3 = (int) (($count % 1000) / 100);
						$digit4 = (int) (($count % 10000) / 1000);
						$digit5 = (int) (($count % 100000) / 10000);
						$digit6 = (int) (($count % 1000000) / 100000);
						$digit7 = (int) (($count % 10000000) / 1000000);
						$transaksi = "RM-" . "$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
						$param_no = $count;
						
						$q= mysql_query("SELECT * FROM pasien WHERE no_rm = '$_GET[no_rm]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_pasien enctype=multipart/form-data>';
							echo "<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr valign=top>
										<td align=right>No RM: </td>
										<td><input type=text name=no_rm size=12 value=".$transaksi." readonly=true style=background-color:#CCCCCC></td>
									</tr>";
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_pasien enctype=multipart/form-data>';
							echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr valign=top>
										<td align=right>No RM: </td>
										<td><input type=text name=no_rm size=12 value='.$transaksi.'></td>
									</tr>';
						}
					?>
						<tr valign="top">
							<td align="right">Nama : </td>
							<td><input type="hidden" name="param_no" value="<?=$param_no?>">
							<input type="text" name="nama" size="35" value="<?= $r['nama']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Jenis Kelamin : </td>
							<td>
							<select name="jns_kel">
								<?php
								if ($r['jns_kel']=="")
								{
									echo "<option value='' selected>-Pilih-</option>";
									echo "<option value=L>Laki-laki</option>";
									echo "<option value=P>Perempuan</option>";
								}
								else
								if ($r['jns_kel']=="L")
								{
									echo "<option value='' >-Pilih-</option>";
									echo "<option value=L selected>Laki-laki</option>";
									echo "<option value=P>Perempuan</option>";								}
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
							<td align="right">Tempat, Tgl Lahir : </td>
							<td><input type="text" name="ttl" size="40" value="<?= $r['ttl']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Alamat: </td>
							<td><textarea name="alamat" style="width:183px; height:70px; "><?=$r['alamat']?></textarea></td>
						</tr>
						<tr valign="top">
							<td align="right">No Telepon: </td>
							<td><input type="text" name="no_telp" size="20" value="<?= $r['no_telp']?>"></td>
						</tr>
						<tr valign="top">
							<td align="right">Pekerjaan : </td>
							<td><input type="text" name="pekerjaan" size="35" value="<?= $r['pekerjaan']?>"></td>
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

									$query  = mysql_query ("SELECT * FROM pasien ORDER BY id ASC
											   LIMIT $offset, $rowsPerPage");
									//$result = mysql_query($query) or die('Error, query failed');

									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>No RM</font></td>
												<td><font color=#FFFFFF>Nama pasien</font></td>
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
										echo "<td>$result[no_rm]</td>
											<td>$result[nama]</td>
											<td>$result[alamat]</td>
											<td>$result[no_telp]</td>
											<td align=center>
											<a href=home.php?hal=content/pasien&no_rm=$result[no_rm]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_pasien&no_rm=$result[no_rm]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';

									echo '<div align=center><br>';

									$query   = "SELECT COUNT(no_rm) AS numrows FROM pasien ORDER BY id ASC";
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
