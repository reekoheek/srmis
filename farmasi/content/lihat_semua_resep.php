<?php

$cari = $_POST['resep_cari'];
//$cari2 = $_POST['cari2'];	
$tgl=date("Y/m/d");

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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> DAFTAR RESEP  </font></b></td>
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
								<tr align="center">
									<td><strong>DAFTAR RESEP PER <?=$tgl?></strong></td>
								</tr>
								<tr align="center">
									<td><strong>BHINEKA BAKTI HUSADA</strong></td>
								</tr>
								<tr align="right">
									<td><form method="post" action="home.php?hal=content/lihat_semua_resep">
									Cari Resep : 
									<input type="text" name="resep_cari">&nbsp;<input type="submit" name="cari" value="Cari">
									</form></td>
								</tr>
								<tr align="center">
									<td><hr></td>
								</tr>
								
								<tr align="center">
									<td>
							<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">
							<table align="center" width="100%">
								<tr align="center" bgcolor="#414141">
								<td width="120px"><font color="#FFFFFF">Tanggal</font></td>
								<td width="120px"><font color="#FFFFFF">No. Resep</font></td>
								<td width="150px"><font color="#FFFFFF">Nama Pasien</font></td>
								<td width="120px"><font color="#FFFFFF">Unit</font></td>
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
							
							if($cari)
							{
							$q1=mysql_query("select * from resep_head where status_bayar=0 and flags='3' and no_resep='$cari' LIMIT 1");
							}else{
							$q1=mysql_query("select * from resep_head where status_bayar=0 and flags='3' order by tgl desc LIMIT $offset, $rowsPerPage");
							}

							$no = 1;
							while($r1=mysql_fetch_array($q1))
							{
								$k_unit=substr($r1['no_resep'],0,3);
								if($k_unit=='IGD')
								{
								 $nama_unit='IGD';
								}else
								if($k_unit=='OKA')
								{
								 $nama_unit='OKA';
								}else
								if($k_unit=='LAB')
								{
								 $nama_unit='LABORATORIUM';
								}else
								if($k_unit=='RAD')
								{
								 $nama_unit='RADIOLOGI';
								}else
								if($k_unit=='RRI')
								{
								 $nama_unit='RAWAT INAP';
								}else 
								if($k_unit=='RRJ')
								{
								 $nama_unit='RAWAT JALAN';
								}else
								{
								 $nama_unit='UMUM';
								}
								
								 if ($no%2)
								{
								echo "<tr valign=top>";
								}
								else
								{
								echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
								}
							 echo"<td align=center>$r1[tgl]</td>
							 <td align=center>$r1[no_resep]</td>";
							 if($k_unit=='RPU'){
							 		echo"<td align=left>$r1[fld02]</td>
									<td align=center>$nama_unit</td>
									<td align=center><a href='javascript:void(0);' onClick=\"PopupCenter('content/pengambilan_resep.php?no_resep=$r1[no_resep]&namapasien=$r1[fld02]','Pengambilan Resep',600,600);\">Ambil Resep</a></td>";
									}else{
								$q2=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
								$r2=mysql_fetch_array($q2);
							 echo"	<td align=left>$r2[nama]</td>
							 		<td align=center>$nama_unit</td>
									<td align=center><a href='javascript:void(0);' onClick=\"PopupCenter('content/pengambilan_resep.php?no_resep=$r1[no_resep]&namapasien=$r2[nama]&id_pasien=$r1[pasien_id]','Pengambilan Resep',600,600);\">Ambil Resep</a></td>";
									}
									
							echo"
									</tr>";
									$no++;
							}
							echo"</table>
							</div>";
							
							echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM resep_head WHERE status_bayar=0 order by tgl desc ";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/lihat_semua_resep&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/lihat_semua_resep&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/lihat_semua_resep&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/lihat_semua_resep&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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