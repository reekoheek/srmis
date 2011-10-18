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
		<td align="center" colspan="4"><font color="#000000" size="+1"><strong>LAPORAN DATA PASIEN<br></strong></font></td>
	</tr>
	<tr>
		<td colspan="4" align="right"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
	</tr>
	<tr>
		<td colspan="4" align="center">
			<?php
			$query = mysql_query("SELECT * FROM pasien");
										echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>No RM</font></td>
												<td><font color=#FFFFFF>Nama pasien</font></td>
												<td><font color=#FFFFFF>Jenis Kelamin</font></td>
												<td><font color=#FFFFFF>TTL</font></td>
												<td><font color=#FFFFFF>Alamat</font></td>
												<td><font color=#FFFFFF>No. Telepon</font></td>
												<td><font color=#FFFFFF>Pekerjaan</font></td>
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
											<td>$result[jns_kel]</td>
											<td>$result[ttl]</td>
											<td>$result[alamat]</td>
											<td>$result[no_telp]</td
											<td>$result[pekerjaan]</td>
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
