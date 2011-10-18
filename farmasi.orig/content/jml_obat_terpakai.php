<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>

<style type="text/css">
<!--
-->
@media print {
input.noPrint { display: none; }
}
.borbor {
	border: 1px solid #BBBBBB;
	font-style: italic;
}
</style>
</head>

<body>
<?php
include "../include/koneksi.php";
include "../include/fungsi_rp.php";

$shift=$_GET['shift'];
$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
$d1=substr($tgl1,0,2);
$d2=substr($tgl2,0,2);
$m1=substr($tgl1,3,2);
$m2=substr($tgl2,3,2);
$y1=substr($tgl1,6,4);
$y2=substr($tgl2,6,4);
$t1=$y1."-".$m1."-".$d1;
$t2=$y2."-".$m2."-".$d2;
//$tgl="2011-08-02";

//pemilihan shift
if($shift<>0){
	$qshift=mysql_query("select * from shift_karyawan where id='$shift'");
	$rshift=mysql_fetch_array($qshift);
 	$ta1=$t1." ".$rshift['masuk'];
	$ta2=$t2." ".$rshift['keluar'];
	$nama_shift=$rshift['nama'];	/* }else 
	if($shift==2){
		$ta1=$t1." 14:00:01";
		$ta2=$t2." 20:59:59";
		$namashift="SIANG";
	}else
	if($shift==3){
		$ta1=$t1." 21:00:01";
		$da2=$d2+1;
		$t2=$y2."-".$m2."-".$da2;
		$ta2=$t2." 06:59:59";
		$namashift="MALAM"; */
	}else
	{
		$ta1=$y1."-".$m1."-".$d1;
		$ta2=$y2."-".$m2."-".$d2;
	}
?>
<table border="0" width="350px">
<tr>
	<td colspan="3" align="center"><strong>Bhineka Bakti Husada</strong></td>
</tr>
<tr>
	<td colspan="3" align="center">Laporan Pemakaian Obat per <?php echo $_GET['tgl1']." - ".$namashift; ?></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
</tr>
<tr>
	<td bgcolor="#111111" align="center"><font color="#EEEEEE">Nama Obat</font></td>
	<td bgcolor="#111111" align="center"><font color="#EEEEEE">Jumlah</font></td>
	<td bgcolor="#111111" align="center"><font color="#EEEEEE">Harga/item</font></td>
</tr>

<?php
$jumlah=0;
$q1=mysql_query("select * from barang_unit where unit_id='2'");
while($r1=mysql_fetch_array($q1))
{
	$q2=mysql_query("select * from ms_barang where id='$r1[barang_id]'");
	$r2=mysql_fetch_array($q2);
	
	
		$query = "SELECT * FROM penjualan_head where created_datetime between '$ta1' and '$ta2'"; 
		$sql = mysql_query ($query); 
		while($data=mysql_fetch_array($sql))
		{
		$q3=mysql_query("select SUM(diberi) AS jml1 FROM penjualan WHERE no_trans='$data[no_trans]' AND no_resep='$data[no_resep]' AND obat_id='$r2[kd_barang]'");
		$r3=mysql_fetch_array($q3);
	
		$jumlah=$jumlah+$r3['jml1'];
		$q4=mysql_query("select * from penjualan where no_trans='$data[no_trans]' AND no_resep='$data[no_resep]' AND racikan='YA'");
	while($r4=mysql_fetch_array($q4))
	{
		$q5=mysql_query("select SUM(Qty) AS jml2 FROM racik_detail WHERE kode_obat='$r2[kd_barang]' AND no_racik='$r4[fld03]'");
		$r5=mysql_fetch_array($q5);
		$jumlah=$jumlah+$r5['jml2'];
	}
	}
	
	if($jumlah>0)
	{
		echo"<tr>
			<td>$r2[nama]</td>
			<td align=center>$jumlah</td>
			<td align=right>"; rupiah($r1[fld02]); echo"</td></tr>";
	}
	$jumlah=0;
}
?>

</table>

</body>
</html>
