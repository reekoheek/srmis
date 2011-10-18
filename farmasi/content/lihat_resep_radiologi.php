<?php
//$tgl=date("Y/m/d");
$tgl=date("d/m/Y");
$no_trans=$_GET['no_trans'];
$param_no=$_GET['param_no'];
?>

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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> DAFTAR RESEP RAWAT INAP </font></b></td>
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
							<td align="center">
							<table border="0" width="100%">
							<tr align="right">
									<td><a href="home.php?hal=content/kasir_tes">[ Kembali ]</a> &nbsp;</td>
								</tr>
								<tr align="center">
									<td>DAFTAR RESEP RAWAT RADIOLOGI</td>
								</tr>
								<tr align="center">
									<td>BHINEKA BAKTI HUSADA</td>
								</tr>
								
								<tr align="center">
									<td>
								<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">
							<table align="center" width="100%">
								<tr align="center" bgcolor="#414141">
								<td width="100px"><font color="#FFFFFF">Tanggal</font></td>
								<td width="120px"><font color="#FFFFFF">No. Resep</font></td>
								<td width="150px"><font color="#FFFFFF">Nama Pasien</font></td>
								<td width="80px"><font color="#FFFFFF">Action</font></td>
								</tr>
							<?
							$rowsPerPage = 20;


							$pageNum = 1;

							if(isset($_GET['page']))
							{
    							$pageNum = $_GET['page'];
							}

							$offset = ($pageNum - 1) * $rowsPerPage;
							
							
							$q1=mysql_query("select * from resep_head where no_resep like 'RAD/%' and status_bayar=0 AND flags=1 OR no_resep like 'RAD/%' and status_bayar=0 AND flags=4 order by tgl desc LIMIT $offset, $rowsPerPage");
							

							$no = 1;
							while($r1=mysql_fetch_array($q1))
							{
								 if ($no%2)
								{
								echo "<tr valign=top>";
								}
								else
								{
								echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
								}
								echo"<td align=center>$r1[tgl]</td>";
							 echo" 	<td align=center><a href='home.php?hal=action/to_preview_resep_radiologi&no_resep=$r1[no_resep]&no_trans=$no_trans&param_no=$param_no'>$r1[no_resep]</a></td>";
							 	$q2=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
								$r2=mysql_fetch_array($q2);
							 echo"	<td align=left>$r2[nama]</td>
									<td align=center><a href='home.php?hal=action/insert_resep_to_kasir&no_resep=$r1[no_resep]&no_trans=$no_trans&param_no=$param_no&pasien_id=$r1[pasien_id]&namapas=$r2[nama]'>Bayar</a></td>
									</tr>";
									$no++;
							}
							echo"</table>
							</div>";
							
							echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM resep_head WHERE no_resep like 'RAD/%' and status_bayar=0 order by tgl desc ";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/lihat_resep_radiologi&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/lihat_resep_radiologi&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/lihat_resep_radiologi&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/lihat_resep_radiologi&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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
							</td>
						</tr>
						<tr>
							<td align="center">
							
							</td>
						</tr>
					</table>
					</div>
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