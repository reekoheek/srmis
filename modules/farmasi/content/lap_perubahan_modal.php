<?
session_start();

include "../include/koneksi.php";
include "../include/fungsi_rp.php";

  	//pendapatan
  	$q1=mysql_query("select * from daftar_akun where type='Pendapatan'");
	$pend=0;
	while($r1=mysql_fetch_array($q1))
	{
		$jsal1=$r1["saldo_awal"]+$r1["saldo"];
			$subtot=$jsal1;
			$pend=$pend+abs($subtot);
	}
		
		//beban
		$q2=mysql_query("select * from daftar_akun where type='Beban'");
	$beban=0;
	while($r2=mysql_fetch_array($q2))
	{	$jsal2=$r2["saldo_awal"]+$r2["saldo"];
			$subtot2=$jsal2;
			$beban=$beban+abs($subtot2);
	}
		//Laba-Rugi
		$total=$pend-$beban;

$bln=$_GET['bln'];
$thn=$_GET['thn'];
if($bln=="01"){
		$bulan="Januari";
		}else
	if($bln=="02"){
		$bulan="Februari";
		}else
	if($bln=="03"){
		$bulan="Maret";
		}else
	if($bln=="04"){
		$bulan="April";
		}else
	if($bln=="05"){
		$bulan="Mei";
		}else
	if($bln=="06"){
		$bulan="Juni";
		}else
	if($bln=="07"){
		$bulan="Juli";
		}else
	if($bln=="08"){
		$bulan="Agustus";
		}else
	if($bln=="09"){
		$bulan="September";
		}else
	if($bln=="10"){
		$bulan="Oktober";
		}else
	if($bln=="11"){
		$bulan="November";
		}else
	if($bln=="12"){
		$bulan="Desember";
		}


?>

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
<div align="center" style="font-size:14px; border-top-style:solid; border-bottom-style:solid; border-left-style:solid; border-right-style:solid">
<table width="600px" border="0" align="center">

  <tr>
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>LAPORAN PERUBAHAN MODAL</strong> </div></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>BHINNEKA BAKTI HUSADA</strong></div></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>per <? echo $bulan." ".$thn; ?> </strong></div></td>
  </tr>
  <tr>
  	<td colspan="3">&nbsp;</td>
	<td><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
  </tr>
  <tr><td colspan="4"><hr /></td></tr>
  <?
  	//modal awal
	$modal=0;
  	$q3=mysql_query("select * from daftar_akun where type='Modal' and `group` like '311%'");
	while($r3=mysql_fetch_array($q3))
	{
	 $jsal3=$r3["saldo_awal"]+$r3["saldo"];
	 echo"<tr><td align=center width=80px>$r3[no_rek]</td>
	 		<td align=left width=250px>$r3[nama_rek]</td><td width=100px>&nbsp;</td>";
			$subtot3=$jsal3;
			$modal=$modal+abs($subtot3);
			if($subtot3<0)
			{
			 $jml3=str_replace("-","",$subtot3);
			 echo"<td align=right width=100px>"; rupiah($jml3); echo"</td>";
			}else
			{ echo"<td align=right widht=100px>"; rupiah($subtot3); echo"</td>";
			}
			echo"<td>&nbsp;</td></tr>";
	}
	
	//Laba-Rugi
	echo"<tr><td>&nbsp;</td><td align=right>Laba/Rugi</td>
		<td align=right style=' border-top-style:solid;  border-top-width:thin'>"; if($total<0){
		 			$total1=str_replace("-","",$total);
					rupiah($total1); }else
				{ rupiah($total); } echo"</td>
				<td>&nbsp;</td></tr>";
		
		//perubahan modal
		$q4=mysql_query("select * from daftar_akun where type='Modal' and `group` like '321%'");
	$pmodal=0;
	while($r4=mysql_fetch_array($q4))
	{
	 $jsal4=$r4["saldo_awal"]+$r4["saldo"];
	 echo"<tr><td align=center>$r4[no_rek]</td>
	 		<td align=left>$r4[nama_rek]</td>";
			$subtot4=$jsal4;
			$pmodal=$pmodal+$subtot4;
			if($subtot4<0)
			{
			 $jml5=str_replace("-","",$subtot4);
			 echo"<td align=right>"; rupiah($jml5); echo"</td>";
			}else
			{ echo"<td align=right>"; rupiah($subtot4); echo"</td>";
			}
			echo"<td>&nbsp;</td></tr>";
	}
	$rmo=$total-$pmodal;
	echo"<tr><td colspan=2 align=right>Perubahan Modal</td>
		<td style=' border-top-style:solid;  border-top-width:thin'>&nbsp;</td>
		<td align=right>"; if($rmo<0){
		 			$pmod1=str_replace("-","",$rmo);
					rupiah($pmod1); }else
				{ rupiah($rmo); } echo"</td></tr><tr><td>&nbsp;</td></tr>";
		
		$gtotal=$modal+$rmo;
	echo"<tr><td colspan=3 align=right><strong>Modal Akhir</strong></td>
		<td align=right style=' border-top-style:solid;  border-top-width:thin'><strong>"; if($total<0){
		 			$total1=str_replace("-","",$gtotal);
					rupiah($total1); }else
				{ rupiah($gtotal); } echo"</strong></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>";
  ?>
</div>  
</table>
<hr />
</body>
</html>