<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Transaksi</title>
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
$no_trans=$_GET['no_transaksi'];
$q_trh=mysql_query("select * from penjualan_head where no_trans='$no_trans'");
$d_trh=mysql_fetch_array($q_trh);
$tanggal=date("d - M - Y");
$psn_id=$d_trh["pasien_id"];
$s_rsp=$d_trh["no_resep"];
$namapas=$d_trh["fld01"];

$k_unit=substr($s_rsp,0,3);

if($k_unit=='IGD')
{
 $unit_id='51';
}else
if($k_unit=='OKA')
{
 $unit_id='52';
}else
if($k_unit=='LAB')
{
 $unit_id='87';
}else
if($k_unit=='RAD')
{
 $unit_id='91';
}else
if($k_unit=='RRI')
{
 $unit_id='50';
}else 
if($k_unit=='RRJ')
{
 $unit_id='4';
}else
{
 $unit_id='2';
}

if($d_trh["no_resep"]==''){
$s_rsp="-"; }
//if($d_trh["fld01"]==''){
//$psn="-"; }

$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$psn_id' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	$re=mysql_fetch_array($qe);

if($k_unit=='RPU'){
$cara_bayar="Tunai";
}else{
$cara_bayar=$re['cara_bayar'];
}
?>
<table width="390" border="0"><font size="10">
  <tr>
    <td height="54" colspan="3" style="border-bottom-style:solid"><div align="center" class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;">BHINNEKA BAKTI HUSADA </div></td>
  </tr>
  <tr>
    <td width="77"><span class="style2">Tanggal</span></td>
    <td width="10"><font size="1">:</font></td>
    <td width="126"><font size="1"><? echo $tanggal; ?></font></td>
	<td width="93"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
  </tr>
  <tr>
    <td><span class="style2">No. Transaksi </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><?=$no_trans?></font></td>
	<td></td>
  </tr>
  <tr>
    <td><span class="style2">No. Resep </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $s_rsp; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style2">Nama Pasien </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $namapas; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style2">Pembayaran </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $cara_bayar; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr style="border-bottom-style:solid; border-bottom-width:thin">
  <td colspan="4">&nbsp;</td>
  </tr>
  <tr><td colspan="3" align="center">
  <table><tr style="border-bottom-style:solid">
  	<td width="150px"><div align="center" class="style2">NAMA OBAT</div></td>
	<td width="10px"><div align="center" class="style2">QTY</div></td>
  </tr><font size="1">
  <?
  $q_trd=mysql_query("select * from penjualan where no_trans='$no_trans'");
  while ($d_trans = mysql_fetch_row($q_trd))
	{	
		if((($d_trans[7]<>0) AND ($d_trans[9]<>"YA")) OR ($d_trans[9]=="YA"))
		{
		$id=$d_trans[0];
		$k_obat=$d_trans[3];				
		$id_dosis=$d_trans[5];
		$racik=$d_trans[14];
		$jml=$d_trans[7];
		$subtotal=$d_trans[11];
		$ket=$d_trans[8];
		$q_bar=mysql_query("select * from ms_barang where kd_barang='$k_obat'");
			$ro = mysql_fetch_array($q_bar);
			
			$qbu = mysql_query("select * from barang_unit where barang_id='$ro[id]' and unit_id='2'");
			$rbu = mysql_fetch_array($qbu);
			
			$q_dosis = mysql_query ("SELECT * FROM dosis WHERE id = '$id_dosis'");
			$rd = mysql_fetch_array($q_dosis);
			$q_rac=mysql_query("select * from racik_head where no_racik='$racik'");
			$r_rac=mysql_fetch_array($q_rac);
			echo"<tr><td align=center><font size=1>";
					if($d_trans[9]=="YA"){
							echo $r_rac['nama']." (racikan)";
														$jml=1;
							}
						else
							{
								echo $ro["nama"];
							}
					echo "</font></td>
					<td align=center><font size=1>$jml</font></td>";
					/* <td align=right><font size=1>"; if($d_trans[9]=="YA"){ 
							echo "-"; }else{ rupiah($rbu['fld02']); } echo"</font></td>
											<td align=right><font size=1>"; rupiah($subtotal); echo"</font></td></tr>"; */
						}
   }
   $q3=mysql_query("SELECT SUM(sub_total) FROM penjualan WHERE no_trans = '$no_trans'");
					$r3=mysql_fetch_array($q3);
					
					
					$sub = $d_trh['total'];
					$grand = $sub;
					
					$bayar=$d_trh['bayar'];
					
					$kembali=$bayar-$grand;
					
					?></font>
					
					
					</table>
					<tr>
					<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
					</tr>
					</td>
						
							<tr>
							<td>&nbsp;</td>
							<td colspan="2" align="right"><font size="1"><span class="style2">Grand Total : </span><?php rupiah($grand)?></font></td>
							<td>&nbsp;</td>
						     </tr>
						  <tr>
						  <td>&nbsp;</td>
						  <td colspan="2"  align="right"><font size="1"><span class="style2">Bayar : </span><?php rupiah($bayar) ?></font></td>
						  <td>&nbsp;</td>
								<td width="62">&nbsp;</td>
						  </tr>
						  <tr>
						  <td>&nbsp;</td>
						  <td colspan="2" align="right"><font size="1"><span class="style2">Kembali :</span><? rupiah($kembali) ?></font></td>
						  <td>&nbsp;</td>
								<td>&nbsp;</td>
						</tr></font>
						<tr><td colspan="3" align="left"><font size="1">Petugas : <? echo $_SESSION['U_USER']; ?></font></td><td>&nbsp;</td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr><td colspan="3"><div align="center" class="style4">
						  <p>TERIMA KASIH ATAS KUNJUNGANNYA</p>
						  <p>*BHINNEKA BAKTI HUSADA * </p>
						</div></td>
						</tr>
</table>
</body>
</html>