<?
session_start();
include "../include/koneksi.php";
include "../include/fungsi_rp.php";
if($_POST['no_resep'])
{
$no_trans=$_POST['no_trans'];
$no_resep=$_POST['no_resep'];
$param_no=$_POST['param_no'];
$kd_obat=$_POST['kd_obat'];
$namapas=$_POST['namapas'];
$pasien_id=$_POST['pasien_id'];
$tgl=date("Y-m-d");
$jml=$_POST['jml'];
}else if($_GET['no_resep'])
{
$no_trans=$_GET['no_trans'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$kd_obat=$_GET['kd_obat'];
$namapas=$_GET['namapas'];
$pasien_id=$_GET['pasien_id'];
$tgl=date("Y-m-d");
$jml=$_GET['jml'];
}

$k_unit=substr($no_resep,0,3);

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

$q1=mysql_query("select * from resep where no_resep='$no_resep' AND kode_obat='$kd_obat'");
$r1=mysql_fetch_array($q1);
$q2=mysql_query("select * from ms_barang where kd_barang='$kd_obat'");
$r2=mysql_fetch_array($q2);
$qqq=mysql_query("select * from barang_unit where unit_id='2' and barang_id='$r2[id]'");
$rrr=mysql_fetch_array($qqq);

$selisih=$r1['diberi']-$jml;
if($jml<>0){
$subtotal=($rrr['fld02']*$jml)+500;
}else
{
 $subtotal=0;
}


if($kode=='IGD')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='OKA')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='LAB')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='RAD')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='RRI')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='RRJ')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else if($kode=='RPU')
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}else
{
 $q3=mysql_query("select * from barang_unit where barang_id='$r2[id]' and unit_id='2'");
 $r3=mysql_fetch_array($q3);
 $jumbaru=$r3['stok']+$selisih;
 mysql_query("update barang_unit set stok='$jumbaru' where barang_id='$r2[id]' and unit_id='2'");
 mysql_query("update penjualan set diberi='$jml',sub_total='$subtotal' where no_trans='$no_trans' and no_resep='$no_resep' and obat_id='$kd_obat'");
}

$q4=mysql_query("update resep set diberi='$jml',sub_total='$subtotal' where no_resep='$no_resep' AND kode_obat='$kd_obat'");

if($q4)
{
 print "<script>window.opener.location.reload();window.close();pop=0;</script>";
 /* location.href='home.php?hal=content/kasir_tes&no_trans=$no_trans&no_resep=$no_resep&namapas=$namapas&param_no=$param_no&pasien_id=$p_id';window.close()</script>"; */
}else
{
 print "<script>window.opener.location.reload();window.close();pop=0;</script>";
 /* <script>location.href='home.php?hal=content/kasir_tes&no_trans=$no_trans&no_resep=$no_resep&namapas=$namapas&param_no=$param_no&pasien_id=$pasien_id';window.close()</script>"; */
}
 
?>