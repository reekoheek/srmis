<?
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cetak Resep</title>
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
.style5 {font-size: 9px}
</style>
</head>





<body>
<?php

include "../include/koneksi.php";
include "../include/fungsi_rp.php";
$no_resep=$_GET['no_resep'];
$nama=$_GET['nama'];
$pasien_id=$_GET['pasien_id'];

$tanggal=date("d - M - Y");

$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$pasien_id' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	$re=mysql_fetch_array($qe);
	$qdok=mysql_query("select * from simrs.dokter where id=$re[dokter_id]");
	$rdok=mysql_fetch_array($qdok);
	
								$que1=mysql_query("select * from simrs.kunjungan where LAST_INSERT_ID(simrs.kunjungan.kunjungan_ke) AND simrs.kunjungan.pasien_id='$pasien_id' ORDER BY simrs.kunjungan.kunjungan_ke DESC LIMIT 1");
								$rue1=mysql_fetch_array($que1);
								
								$que2=mysql_query("select * from simrs.kunjungan_kamar where LAST_INSERT_ID(simrs.kunjungan_kamar.kunjungan_id) AND simrs.kunjungan_kamar.kunjungan_id='$rue1[id]' ORDER BY simrs.kunjungan_kamar.id DESC LIMIT 1");
								$rue2=mysql_fetch_array($que2);
	
	$qkam=mysql_query("select * from simrs.kamar where id='$rue2[kamar_id]'");
	$rkam=mysql_fetch_array($qkam);
?>
<table width="500" border="0">
  <tr>
    <td height="29" colspan="3" style=""><div align="center" class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;"><font size="10"><span class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;"><br />
    </span></font><span class="style5" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;">INSTALASI FARMASI</span><font size="10"><span class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;"> <br />
    RS. BHINEKA BAKTI HUSADA <br />
    </span><span class="style5" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;">Jl. Cabe Raya No.17 Telp. 7490018 - 7490829 FAX. 7499157 <br />
PONDOK CABE - TANGERANG </span><span class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;"><br />
    </span><span class="style5" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;">Apoteker : Bambang Tri Sasongko, Ssi. Apt. <br />
SIK : KP 01.01.1.3.13059</span></font></div></td>
  </tr>
  <font size="10">
  </font><tr>
    <td height="20" colspan="3" style="border-bottom-style:solid"><div align="center" class="style1" style="font:Verdana, Arial, Helvetica, sans-serif;font-style:oblique;">SALINAN RESEP </div></td>
  </tr><font size="10">

  <tr>
    <td width="77"><span class="style2">Tanggal</span></td>
    <td width="10"><font size="1">:</font></td>
    <td width="126"><font size="1"><? echo $tanggal; ?></font></td>
	<td width="93"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
  </tr>
  
  <tr>
    <td><span class="style2">No. Resep </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $no_resep; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style2">Nama Pasien </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $re['nama']; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="style2">Nama Dokter </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $rdok['nama']; ?></font></td>
	<td>&nbsp;</td>
  </tr>
   <tr>
    <td><span class="style2">No Kamar </span></td>
    <td><font size="1">:</font></td>
    <td><font size="1"><? echo $rkam['nama']; ?></font></td>
	<td>&nbsp;</td>
  </tr>
  <tr style="border-bottom-style:solid; border-bottom-width:thin">
  <td colspan="4">&nbsp;</td>
  </tr>
  <tr><td colspan="3" align="center">
  <table><tr style="border-bottom-style:solid">
  	<td width="100px"><div align="center" class="style2">KODE OBAT</div></td>
	<td width="10px"><div align="center" class="style2">NAMA OBAT</div></td>
	<td width="70px"><div align="center" class="style2">DOSIS</div></td>
	<td width="70px"><div align="center" class="style2">QTY</div></td>
	<td width="70px"><div align="center" class="style2">KETERANGAN</div></td>
  </tr><font size="1">
  <?
  	$q_trh=mysql_query("select * from resep where no_resep='$no_resep'");
  	
  while ($d_trans = mysql_fetch_array($q_trh))
	{
		if($d_trans['racikan']=='YA')
		{
		 $kd_obat=$d_trans['fld02'];
		 echo "<td><font size=1>$kd_obat</font></td>";
		 $rckk="select * from racik_head where no_racik='$d_trans[fld02]'";
		 $drck=mysql_query($rckk);
		 $r_rck=mysql_fetch_array($drck);
		 $nama_obt=$r_rck['nama'];
		 echo "<td><font size=1>$nama_obt</font></td>";
		 echo "<td>&nbsp;</td>";
		 echo "<td>&nbsp;</td>";
		 echo "<td>&nbsp;</td>";
		 $t_rck=mysql_query("select * from racik_detail where no_racik='$d_trans[fld02]'");
		 while($dtr=mysql_fetch_array($t_rck))
		 {
		  echo"<tr>
		  		<td align=right><font size=1>$dtr[kode_obat]</font></td>";
				$qms=mysql_query("select * from ms_barang where kd_barang='$dtr[kode_obat]'"); 
				$rms=mysql_fetch_array($qms);
		echo   "<td><font size=1>$rms[nama]</font></td>";
				$qdo=mysql_query("select * from dosis where id='$rckk[dosis_id]'");
				$rdo=mysql_fetch_array($qdo);
		echo   "<td><font size=1>$rdo[deskripsi]</font></td>
				<td><font size=1>$dtr[qty]</font></td>
				<td>&nbsp;</td></tr>";
		 }
		 
		 
		 }else
		 {
		$kd_obat=$d_trans['kode_obat'];
		echo "<tr><td><font size=1>$kd_obat</font></td>";
			$q_obt=mysql_query("select * from ms_barang where kd_barang='$kd_obat'");
			$d_obt=mysql_fetch_array($q_obt);				
			$nama_obt=$d_obt['nama'];
		echo "<td><font size=1>$nama_obt</font></td>";
		$iddos=$d_trans['dosis_id'];
			$dos_id=mysql_query("select * from dosis where id='$iddos'");
			$d_dosis=mysql_fetch_array($dos_id);
			$dosis=$d_dosis['deskripsi'];
		echo "<td><font size=1>$dosis</font></td>";
 		 $jml=$d_trans['diminta'];
		echo "<td><font size=1>$jml</font></td>";
		$ket=$d_trans['ket'];
		echo "<td><font size=1>$ket</font></td>";
	echo"</tr>";
	}
}
?>
	</table></font>
	<tr>
	<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
	</tr>
	</td>
	
	<tr><td colspan="3" align="left"><font size="1">Petugas : <? echo $_SESSION['U_USER']; ?></font></td><td>&nbsp;</td></tr>
						<tr><td colspan="3">&nbsp;</td></tr>
						<tr><td colspan="3"><div align="center" class="style4">
						  <p>SILAHKAN BAYAR OBAT ANDA DI APOTIK</p>
						  <p>*BHINNEKA BAKTI HUSADA * </p>
						</div></td>
						</tr>
</table>
</body>
</html>