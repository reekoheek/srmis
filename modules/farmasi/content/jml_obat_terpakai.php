<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
<!--
.style1 {
	font-size: 12px;
	font-weight: bold;
}
.style2 {
	font-size: 10px;
	border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #000000;
}
-->
@media print {
input.noPrint { display: none; }
}
.borbor {
	border: 1px solid #BBBBBB;
	font-style: italic;
}
.style4 {font-size: xx-small}
</style>
</head>

<body>
<?php
include "../include/koneksi.php";
include "../include/fungsi_rp.php";

$dd=substr($_GET['tgl1'],0,2);
$mm=substr($_GET['tgl1'],3,2);
$yy=substr($_GET['tgl1'],6,4);
$tgl=$yy."-".$mm."-".$dd;
//$tgl="2011-08-02";
?>
<table border="0">
<tr>
	<td colspan="2" align="center">Bhineka Bakti Husada</td>
</tr>
<tr>
	<td colspan="2" align="center">Laporan Pemakaian Obat per <?php echo $_GET['tgl1']; ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
</tr>
<tr>
	<td bgcolor="#111111" align="center"><font color="#EEEEEE">Nama Obat</font></td>
	<td bgcolor="#111111" align="center"><font color="#EEEEEE">Jumlah</font></td>
</tr>

<?php
$jumlah=0;
$q1=mysql_query("select * from barang_unit where unit_id='2'");
while($r1=mysql_fetch_array($q1))
{
	$q2=mysql_query("select * from ms_barang where id='$r1[barang_id]'");
	$r2=mysql_fetch_array($q2);
	
	$q3=mysql_query("select SUM(diberi) AS jml1 FROM penjualan WHERE obat_id='$r2[kd_barang]' AND tgl='$tgl'");
	$r3=mysql_fetch_array($q3);
	
	$jumlah=$jumlah+$r3['jml1'];
	$q4=mysql_query("select * from penjualan where racikan='YA' AND tgl='$tgl'");
	while($r4=mysql_fetch_array($q4))
	{
		$q5=mysql_query("select SUM(Qty) AS jml2 FROM racik_detail WHERE kode_obat='$r2[kd_barang]' AND no_racik='$r4[fld03]'");
		$r5=mysql_fetch_array($q5);
		$jumlah=$jumlah+$r5['jml2'];
	}
	
	if($jumlah>0)
	{
		echo"<tr>
			<td>$r2[nama]</td>
			<td align=center>$jumlah</td></tr>";
	}
	$jumlah=0;
}
?>

</table>

</body>
</html>
