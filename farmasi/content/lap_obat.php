<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type=”text/css”>
@media print {
input.noPrint { display: none; }
}
</style>
</head>
<?php
	include "./../include/fungsi_rp.php";
	include "./../include/koneksi.php";
?>

<body>
<table border="0" cellpadding="2" cellspacing="2" width="1024px" align="center">
	<tr>
		<td align="center" colspan="4"><font color="#000000" size="+1"><strong>LAPORAN DATA OBAT<br></strong></font></td>
	</tr>
	<tr>
		<td colspan="4" align="right"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
	</tr>
	<tr>
		<td colspan="4" align="center">
			<?php
			$q2 = mysql_query("SELECT * FROM obat");
										echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Jenis</font></td>
												<td><font color=#FFFFFF>Status</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>ket</font></td>
												<td><font color=#FFFFFF>Harga Beli</font></td>
											</tr>';
									$no = 1;
									while ($r2 = mysql_fetch_array($q2))
									{
										
										echo "<tr valign=top>";
										
										echo "<td>$r2[kode_obat]</td>
											<td>$r2[nama_obat]</td>";
										$qr = mysql_query("SELECT jenis_obat FROM jenis_obat WHERE id = '$r2[kode_jenis]'");
										$rr = mysql_fetch_array($qr);
										echo "<td>$rr[jenis_obat]</td>
											<td>$r2[status_obat]</td>
											<td>";
											rupiah($r2[harga_jual]);
										echo "</td>
											<td>$r2[jumlah]</td>
											<td>$r2[ket]</td>
											<td>";
											rupiah($r2[harga_beli]);
										echo "</td>
											</tr>";
										
									}
									echo '</table><br>';
			
			?>
	<tr>
		<td colspan="2">&nbsp;</td>
		<td colspan="2" align="right"></td>
	</tr>
</table>
</body>
</html>
