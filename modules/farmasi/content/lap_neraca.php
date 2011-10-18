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
	{
		$jsal2=$r2["saldo_awal"]+$r2["saldo"];
			$subtot2=$jsal2;
			$beban=$beban+abs($subtot2);
	}
		//Laba-Rugi
		$totallaba=$pend-$beban;

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

//modal awal
	$modal=0;
  	$q3=mysql_query("select * from daftar_akun where type='Modal' and `group` like '311%'");
	while($r3=mysql_fetch_array($q3))
	{
		$jsal3=$r3["saldo_awal"]+$r3["saldo"];
			$subtot3=$jsal3;
			$modal=$modal+abs($subtot3);
			
	}
	
		
		//perubahan modal
		$q4=mysql_query("select * from daftar_akun where type='Modal' and `group` like '321%'");
	$pmodal=0;
	while($r4=mysql_fetch_array($q4))
	{
		$jsal4=$r4["saldo_awal"]+$r4["saldo"];
			$subtot4=$jsal4;
			$pmodal=$pmodal+abs($subtot4);
			
	}
	$rmo=$totallaba-$pmodal;
	
		//Modal Akhir		
		$gtotal=$modal+$rmo;

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
<table border="0" width="600">
<tr><td>&nbsp;</td></tr>
<tr>
	<td colspan="4" align="center"><strong>LAPORAN NERACA</strong></td>
</tr>
<tr>
	<td colspan="4" align="center"><strong>BHINEKA BAKTI HUSADA</strong></td>
</tr>
<tr>
	<td colspan="4" align="center"><strong>per <? echo $bulan." ".$thn; ?></strong></td>
</tr>

<tr>
<td colspan="4" align="right"><hr /><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
</tr>
<tr>
	<td colspan="2" align="center" width="300px"><strong>AKTIVA</strong></td>
	<td colspan="2" align="center" width="300px"><strong>PASIVA</strong></td>
</tr>
<tr>
	<td colspan="2">
	<table border="0">
			<?php
				echo"
				<tr><td>&nbsp;</td></tr><tr><td colspan=2 width=300px><strong>Harta Lancar</strong></td></tr>";
				$j_aktiva1=0;
				$query1=mysql_query("select * from daftar_akun where type='Aktiva' and `group` like '111%' or type='Aktiva' and `group` like '112%'");
				while($result1=mysql_fetch_array($query1))
				{
				 $jjsal1=$result1["saldo_awal"]+$result1["saldo"];
				 echo"<tr><td width=180px>$result1[nama_rek]</td>";
				 $aktiva1=$jjsal1;
				 $j_aktiva1=$j_aktiva1+abs($aktiva1);
				 echo"<td align=right>"; 
				 if($aktiva1<0){
				 	$r_aktiva1=str_replace("-","",$aktiva1);
					rupiah($r_aktiva1);
					}else{
					rupiah($aktiva1);
					}
					echo"</td></tr>";
				}
				echo"<tr><td width=160px align=right>Jumlah</td><td align=right style='border-top-style:solid; border-top-width:thin'>"; 
					if($j_aktiva1<0){
				 	$sub_aktiva1=str_replace("-","",$j_aktiva1);
					rupiah($sub_aktiva1);
					}else{
					rupiah($j_aktiva1);
					}
				echo"</td></tr><tr><td>&nbsp;</td></tr>";
				
				echo"<tr><td width=160px><strong>Harta Tetap<strong></td></tr>";
				$j_aktiva2=0;
				$query2=mysql_query("select * from daftar_akun where type='Aktiva' and `group` like '113%' or  type=1 and `group` like '114%'");
				while($result2=mysql_fetch_array($query2))
				{
				 $jjsal2=$result2["saldo_awal"]+$result2["saldo"];
				 echo"<tr><td width=160px>$result1[nama_rek]</td>";
				 $aktiva2=$result2['saldo'];
				 $j_aktiva2=$j_aktiva2+abs($aktiva2);
				 echo"<tr><td align=right>"; 
				 if($aktiva2<0){
				 	$r_aktiva2=str_replace("-","",$aktiva2);
					rupiah($r_aktiva2);
					}else{
					rupiah($aktiva2);
					}
					echo"</td></tr><tr><td>&nbsp;</td></tr>";
				}
				echo"<tr><td width=160px align=right>Jumlah</td><td align=right style='border-top-style:solid; border-top-width:thin'>"; 
					if($j_aktiva2<0){
				 	$sub_aktiva2=str_replace("-","",$j_aktiva2);
					rupiah($sub_aktiva2);
					}else{
					rupiah($j_aktiva2);
					}
				echo"</td></tr>";
				
				$j_aktiva3=0;
				$query3=mysql_query("select * from daftar_akun where type='Aktiva' and `group` like '115%'");
				while($result3=mysql_fetch_array($query3))
				{
				 $jjsal3=$result3["saldo_awal"]+$result3["saldo"];
				 echo"<tr><td>$result3[nama_rek]</td>";
				 $aktiva3=abs($jjsal3);
				 $j_aktiva3=$j_aktiva3+$aktiva3;
				 echo"<tr><td align=right>"; 
				 if($aktiva3<0){
				 	$r_aktiva3=str_replace("-","",$aktiva3);
					rupiah($r_aktiva3);
					}else{
					rupiah($aktiva3);
					}
					echo"</td></tr>";
				}
				echo"<tr><td align=right><strong>Jumlah</strong></td><td align=right style='border-top-style:solid; border-top-width:thin'><strong>"; 
					$subtotal_aktiva=$j_aktiva1+$j_aktiva2-$j_aktiva3;
					if($subtotal_aktiva<0){
				 	$subtotal_aktiva1=str_replace("-","",$subtotal_aktiva);
					rupiah($subtotal_aktiva1);
					}else{
					rupiah($subtotal_aktiva);
					}
				echo"</strong></td></tr>";
			?>
	</table>
	</td>
	<td colspan="2" valign="top">
	<table border="0">
		<tr><td>&nbsp;</td></tr>
		<tr><td><strong>Kewajiban</strong></td></tr>
		
		<?
		$j_kwj=0;
		$q_kew=mysql_query("select * from daftar_akun where type='Pasiva'");
		while($r_kew=mysql_fetch_array($q_kew))
		{
		 $jjsalkew=$r_kew["saldo_awal"]+$r_kew["saldo"];
		 echo"<tr><td width=160px>$r_kew[nama_rek]</td><td align=right>";
		 $kewajiban=abs($jjsalkew)+abs($r_kew['saldo_penyesuaian']);
		 $j_kwj=$j_kwj+$kewajiban;
				 if($kewajiban<0){
				 	$r_kewajiban=str_replace("-","",$kewajiban);
					rupiah($r_kewajiban);
					}else{
					rupiah($kewajiban);
					}
					echo"</td></tr>";
		}
				echo"<tr><td align=right>Jumlah</td><td align=right style='border-top-style:solid; border-top-width:thin'>"; 
					if($j_kwj<0){
				 	$sub_kwj=str_replace("-","",$j_kwj);
					rupiah($sub_kwj);
					}else{
					rupiah($j_kwj);
					}
				echo"</td></tr><tr><td>&nbsp;</td></tr>";
				
				echo"<tr><td><strong>Modal</strong></td></tr>";
				echo"<tr><td>Modal Akhir</td><td>"; rupiah(abs($gtotal));  echo"</td></tr>
				<tr><td>&nbsp;</td></tr>
				<tr><td align=right ><strong>Jumlah</strong></td><td align=right style='border-top-style:solid; border-top-width:thin'><strong>"; 
				$totalsemua=$j_kwj+$gtotal;
				rupiah($totalsemua);
				echo"</strong></td></tr>
			</table></td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>";
		?>
			
			
		
	</table>
	</td>
</tr>
	
</table>
</font>
</body>
</html>
