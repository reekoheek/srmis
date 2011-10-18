<?
session_start();
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

include "../include/koneksi.php";
include "../include/fungsi_rp.php";
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
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>LAPORAN LABA/RUGI</strong> </div></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>BHINNEKA BAKTI HUSADA</strong></div></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><div align="center" style="font-size:14px;"><strong>per <? echo $bulan." ".$thn; ?> </strong></div></td>
  </tr>
  <tr><td colspan="4"><hr /></td></tr>
  <tr>
  	<td colspan="3">&nbsp;</td>
	<td><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
  </tr>

  <?
  	//pendapatan
	
  	$q1=mysql_query("select * from daftar_akun where type='Pendapatan' order by no_rek asc");
	$pend=0;
	while($r1=mysql_fetch_array($q1))
	{
		$jsal1=$r1["saldo_awal"]+$r1["saldo"];
	 echo"<tr><td align=center>$r1[no_rek]</td>
	 		<td align=left>$r1[nama_rek]</td>";
			$subtot=$jsal1;
			$pend=$pend+abs($subtot);
			if($subtot<0)
			{
			 $jml4=str_replace("-","",$subtot);
			 echo"<td align=right>"; rupiah($jml4); echo"</td>";
			}else
			{ echo"<td align=right>"; rupiah($subtot); echo"</td>";
			}
			echo"<td>&nbsp;</td></tr>";
	}
	echo"<tr><td colspan=2>&nbsp;</td>
			<td>&nbsp;</td>
		<td align=right  style=' border-top-style:solid;  border-top-width:thin' width=120px>"; if($pend<0){
		 			$pend1=str_replace("-","",$pend);
					rupiah($pend1); }else
				{ rupiah($pend); } echo"</td></tr><tr><td>&nbsp;</td></tr>";
		
		//beban
		
		$q2=mysql_query("select * from daftar_akun where type='Beban'");
	$beban=0;
	while($r2=mysql_fetch_array($q2))
	{
	$jsal2=$r2["saldo_awal"]+$r2["saldo"];
	 echo"<tr><td align=center>$r2[no_rek]</td>
	 		<td align=left>$r2[nama_rek]</td>";
			$subtot2=$jsal2;
			$beban=$beban+abs($subtot2);
			if($subtot2<0)
			{
			 $jml5=str_replace("-","",$subtot2);
			 echo"<td align=right>"; rupiah($jml5); echo"</td>";
			}else
			{ echo"<td align=right>"; rupiah($subtot2); echo"</td>";
			}
			echo"<td>&nbsp;</td></tr>";
	}
	echo"<tr><td colspan=2>&nbsp;</td>
		<td style=' border-top-style:solid;  border-top-width:thin'>&nbsp;</td>
		<td align=right>"; if($beban<0){
		 			$beban1=str_replace("-","",$pend);
					rupiah($beban1); }else
				{ rupiah($beban); } echo"</td></tr><tr><td>&nbsp;</td></tr>";
		
		$total=$pend-$beban;
	echo"<tr><td colspan=3 align=right><strong>Laba/Rugi</strong></td>
		<td align=right style=' border-top-style:solid;  border-top-width:thin'><strong>"; if($total<0){
		 			$total1=str_replace("-","",$total);
					rupiah($total1); }else
				{ rupiah($total); } echo"</strong></td></tr><tr><td>&nbsp;</td></tr>";
  ?>
</div>
</table>
</body>
</html>
