<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Laporan Transaksi Kasir - Harian</title>
<style type="text/css">
<!--
.style1 {font-size: 18pt}
-->
</style>
</head>

<body>
<?
include("../include/koneksi.php");
include("../include/fungsi_rp.php");
if($_GET['tgl1'])
{
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

$bulan=date("i");
$skrg=date("F Y");
$user=$_SESSION['U_USER'];

?>
<table width="700" border="0">
  <tr>
    <td colspan="2"><div align="center" class="style1">LAPORAN TRANSAKSI KASIR </div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">Periode : <? echo $tgl1; ?> - <? echo $tgl2; ?></div></td>
  </tr>
  <tr>
    <td height="47" colspan="2"><div align="right"><input class="noPrint" type="button" value="Print" onclick="window.print()"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
	<table border="1" align="center"><font size="-1" style="font-style:inherit">
		<tr>
			<td align="center"><font size="-1">No.</font></td>
			<td align="center"><font size="-1">No. Transaksi</font></td>
			<td align="center"><font size="-1">Jenis Transaksi</font></td>
			<td align="center"><font size="-1">No. Resep</font></td>
			<td align="center"><font size="-1">Total</font></td>
		</tr>
		<?
			$no=1;
			$tot=0;
			$q1=mysql_query("select * from penjualan_head where tgl between '$t1' and '$t2' order by id ASC") or die;
		
			while($r1=mysql_fetch_array($q1))
			{
			 echo"<tr>
			 		<td align=right><font size=-1>$no</font></td>
					<td align=center><font size=-1>$r1[no_trans]</font></td>";
					if($r1[flags]==1)
						{
						 $jenis='RRI';
						 }else if($r1[flags]==3)
						 		{
								 $jenis='RPU';
								 }
								 else if($r1[flags]==4)
								 		{
											$jenis='RPL';
											}
											else
											{
											$jenis='-';
									}
					echo"<td align=center><font size=-1>$jenis</font></td>
						<td align=center><font size=-1>$r1[no_resep]</font></td>
						<td align=right><font size=-1>";rupiah($r1[total]);echo"</font></td>
						</tr>";
					$no++;
					$tot=$tot+$r1['total'];
					}
					$q3=mysql_query("SELECT SUM(total) FROM penjualan_head WHERE tgl = '$sekarang'");
					$r3=mysql_fetch_array($q3);
					
					
					$sub = $tot;
					echo"<tr>
						<td colspan=4 align=right><font size=-1>Subtotal </font></td>
						<td align=right><font size=-1>";rupiah($sub);echo"</font></td>
						</tr>";
				
		?>
		</font>
		</table>
		</div></td>
  </tr>
  <tr>
  	<td height="44">&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><font size="-2" style="font-style:italic"><div align="right">Date Printed : <? echo $hari; ?> Nama Petugas: <? echo $user; ?></div></font></td>
  </tr>
</table>
<?
}
?>
</body>
</html>
