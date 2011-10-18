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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Resep Pasien Registrasi</b></font></td>
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
									$tgl = $_POST['tgl'];
								?>
								<form method="post" action="home.php?hal=content/resep_pasien_reg" enctype="multipart/form-data">

							<td width="100px">
								
								<INPUT name="tgl" id="date1" class="date-pick" readonly="true" value="<?= $tgl?>">
							</td>
							<td>
								&nbsp;<input type="submit" value="Cari"> &nbsp;
							</td>
								</form>
							
							<td width="80px">
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
							    <a href="home.php?hal=content/menu_kasir">Menu Kasir</a> </td>
						</tr>
					</table>
					<hr/>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
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
									$query  = mysql_query ("SELECT DISTINCT(no_resep),tgl,pasien_id FROM resep WHERE tgl LIKE '$tgl%'");
									}
									else
									{
									$date = date("d/m/Y");
									$query  = mysql_query ("SELECT DISTINCT(no_resep),tgl,pasien_id FROM resep WHERE tgl = '$date'
											   LIMIT $offset, $rowsPerPage");
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=1100px>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Tanggal Resep</font></td>
												<td><font color=#FFFFFF>No Resep</font></td>
												<td><font color=#FFFFFF>No RM</font></td>
												<td><font color=#FFFFFF>Nama Pasien</font></td>
												<td><font color=#FFFFFF>Nama Dokter</font></td>
												<td><font color=#FFFFFF>Poliklinik</font></td>
												<td><font color=#FFFFFF>Biaya Resep</font></td>
												<td><font color=#FFFFFF>Status</font></td>
												<td><font color=#FFFFFF>Jenis</font></td>
												<td colspan=2><font color=#FFFFFF>Action</font></td>
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
										
										$qp=mysql_query("SELECT * FROM pasien WHERE id='$result[pasien_id]'");
										$rp=mysql_fetch_array($qp);
										
										$qj = mysql_query("SELECT * FROM kunjungan,kunjungan_kamar
											  WHERE pasien_id='$rp[id]' AND kunjungan.id=kunjungan_kamar.kunjungan_id");
										$rj = mysql_fetch_array($qj);
										
										$qd = mysql_query("SELECT * FROM dokter WHERE id = '$rj[dokter_id]'");
										$rd = mysql_fetch_array ($qd);
										
										$qss = mysql_query ("SELECT * FROM subspesialisasi WHERE id='$rd[subspesialisasi_id]'");
										$rss = mysql_fetch_array ($qss);
										
										$qs = mysql_query("SELECT * FROM spesialisasi WHERE id = '$rss[spesialisasi_id]'");
										$rs = mysql_fetch_array($qs);
										
										echo "<td width=70px>$result[tgl]</td>
											<td>$result[no_resep]</td>
											<td align=center>$result[pasien_id]</td>
											<td align=left>$rp[nama]</td>
											<td align=left>$rd[nama]</td>
											<td align=left>$rs[nama]</td>";
											
											$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$result[no_resep]'");
											$r3=mysql_fetch_array($q3);
											echo "<td align=right>";
											$q4=mysql_query("select * from resep_head where no_resep='$result[no_resep]'");
											$r4=mysql_fetch_array($q4);
											rupiah($r3['SUM(sub_total)']);
											echo "</td>";
											if ($r4['status_bayar']=='Sudah Dilayani')
											{
												echo "<td align=center>Sudah Dilayani</td>";
											}
											else
											{
												echo "<td align=center>Belum Dilayani</td>";
											}
											echo "<td align=center></td>";
											echo "<td align=center><a href=home.php?hal=content/detail_resep_pasien&noresep=$result[no_resep]&id=$result[pasien_id]&nama=$rp[nama]>DETAIL</a></td>";
											if ($r4['status_bayar']!='Sudah Dilayani')
											{
												echo"<td align=center><a href=home.php?hal=content/pembayaran_resep_pasien&noresep=$result[no_resep]&id=$result[pasien_id]&nama=$rp[nama]>BAYAR</a></td>
											</tr>";
											}
											else
											{
												echo "<td>&nbsp;</td>";
											}
												
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

									$query   = "SELECT COUNT(kd_barang) AS numrows FROM ms_barang ORDER BY ex_year,ex_month,ex_date ASC";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/ms_barang\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/ms_barang\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/ms_barang\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/ms_barang\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
