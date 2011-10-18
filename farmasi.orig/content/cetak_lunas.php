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
	error_reporting(E_ERROR);
	session_start();
	include "./../include/fungsi_rp.php";
	include "./../include/koneksi.php";
	$q = mysql_query ("SELECT * FROM lunas WHERE param_no = '$_POST[param_no]'");
	$r = mysql_fetch_array ($q);
	$q2 = mysql_query ("SELECT * FROM pasien WHERE no_rm = '$_POST[cari]'");
	$r2 = mysql_fetch_array ($q2);
	
?>

<body>
<table border="0" cellpadding="2" cellspacing="2" width="650px" align="center">
	<tr>
		<td align="center" colspan="6"><font color="#000000" size="+1"><strong>APOTEK<br>
	  </strong></font></td>
	</tr>
	
	<tr>
		<td colspan="6">
			<table cellspacing="2" cellpadding="2" width="100%" border="0">
				<tr>
		<td><font style="font-size:12px ">No. RM</font></td>
		<td><font style="font-size:12px "><?=": ". $r2['no_rm']?> </font></td>
		<td></td>
		<td width="10">&nbsp;</td>
		<td colspan="2"><font style="font-size:12px ">Transaksi </font></td>
		<td><font style="font-size:12px "><?=": " .$r['transaksi']?> </font></td>
	</tr>
	<tr>
		<td><font style="font-size:12px ">Nama</font></td>
		<td><font style="font-size:12px "><?=": ". $r2['nama']?></font></td>
		<td></td>
		<td width="240">&nbsp;</td>
		<td colspan="2"><font style="font-size:12px ">Tanggal </font></td>
		<td><font style="font-size:12px "><?=": " . date("d"). "-" .date("m"). "-" .date("Y"); ?></font></td>
	</tr>
			</table>
		</td>
	</tr>
	
	
	
	<tr>
		<td colspan="6" align="center">
			<?php
			$query = mysql_query("SELECT * FROM lunas,obat WHERE lunas.kode_obat = obat.kode_obat AND lunas.param_no = '$r[param_no]'");
			echo '<table border=1 cellpadding=2 cellspacing=2 width=100% bordercolor=#FF9933>
					<tr bgcolor=#FEFAFA align=center>
						<td><font color=#000000 width=10px>No</font></td>
						<td><font color=#000000 width=10px>Tanggal Copy Resep</font></td>
						<td><font color=#000000 width=250px>Nama Obat</font></td>
						<td><font color=#000000 width=50px>Jumlah</font></td>
						<td><font color=#000000>Jumlah Harga</font></td>
					</tr>';
			$no = 1;
			while ($result = mysql_fetch_array($query))
			{
				echo "<tr><td align=center>$no</td>
				<td>$result[date] - $result[month] - $result[year]</td>
				<td>$result[nama_obat]</td>
				<td align=right>$result[4]</td>
				<td align=right>";
					rupiah($result[jumlah_harga]);
				echo "</td>
				</tr>";
				$no++;
			}
			$q3=mysql_query("SELECT SUM(jumlah_harga) FROM lunas WHERE param_no = '$r[param_no]'");
			$r3=mysql_fetch_array($q3);
			echo "<tr>
			<td colspan=4 align=right>
			Total :</td><td align=right>";
			rupiah($r3['SUM(jumlah_harga)']);
			echo "</td>
			</tr>";
			echo '</table></td></tr>';
			
			?>
	<tr>
		<td colspan="4" width="350px">&nbsp;</td>
		<td colspan="2" align="center">Terima kasih,<br><br><br></td>
	</tr>
	<tr>
		<td colspan="4">&nbsp;</td>
		<td colspan="2" align="center"><?= $_SESSION['U_NAME']?></td>
	</tr>
	<tr>
		<td colspan="6">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td align="right" width="50px"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
					<td align="left">
					<form action="../home.php" enctype="multipart/form-data">
						<input class="noPrint" type="submit" value="Kembali">
					</form>
				</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
