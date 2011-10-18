<?
session_start();
include "../include/koneksi.php";
include "../include/fungsi_rp.php";
?>
<html>
<head>
<title>Edit Transaksi Parkir</title>
</head>
<body>
<?
$no_trans=$_GET['no_trans'];
$q1=mysql_query("select * from parkir where no_trans='$no_trans'");
$r1=mysql_fetch_array($q1);
$dd=substr($r1['tgl'],8,2);
$mm=substr($r1['tgl'],5,2);
$yy=substr($r1['tgl'],0,4);
$tanggalstring=$dd."-".$mm."-".$yy;
?>
<form method="post" action="../action/update_parkir.php">
<table border="0">
<tr><td align="center" style="border-bottom-color:#777777; border-left-color:#777777; border-right-color:#777777; border-top-color:#777777; border:solid">
<table border="0" width="">
<tr>
	<td>No. Transaksi Parkir</td>
	<td><input type="text" name="nomor_trans" value="<?=$r1['no_trans']?>"  readonly="true" style="background-color:#BBBBBB"/></td>
</tr>
<tr>
	<td>Tanggal</td>
	<td><input type="text" name="tanggal" readonly="true" value="<?=$tanggalstring?>" style="background-color:#BBBBBB"/></td>
</tr>
<tr>
	<td>Jumlah Motor</td>
	<td><input type="text" size="5" name="motor" value="<?=$r1['motor']?>"></td>
</tr>
<tr>
	<td>Jumlah Mobil</td>
	<td><input type="text" size="5" name="mobil" value="<?=$r1['mobil']?>"></td>
</tr>
<tr>
	<td>Total Harga</td>
	<td><input type="text" size="20" name="total" value="<?=$r1['total']?>"></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="simpan" value="Simpan" /><input type="reset" name="Batal" value="Batal" onClick="window.close()"/>
	</td>
</tr>
</table>
</form>
</td>
</tr>
</table>

</body>
</html>