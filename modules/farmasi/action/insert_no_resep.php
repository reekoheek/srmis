<?php
// 50=rawat inap
// 51=igd
// 52=oca
// 4=rawat jalan

$nama_pasien=$_POST['nama'];
$id_pasien = $_POST['id'];
$id = $_GET['id'];

$q2=mysql_query("SELECT * FROM simrs.pasien,simrs.radio_kunjungan WHERE pasien.id=radio_kunjungan.pasien_id AND pasien.id='$id'");
$r2=mysql_fetch_array($q2);

$cara_masuk=$r2['cara_masuk'];

$qp= mysql_query("SELECT * FROM resep_head WHERE LAST_INSERT_ID(param_no)  AND cara_masuk='$cara_masuk' ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);


$tanggal_sekarang=date("d/m/Y");
//$month=substr($rp['tgl'],3,2);
$date=date("m");

$tgl = substr($rp['tgl'],3,2);


if ($tgl == $date)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

//cek untuk ketersediaan record
if (!$rp)
{
	$temp = 1;
	$count = $temp;
}


$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);



if($cara_masuk=="IGD")
{
	$kd="IGD/";
}
elseif($cara_masuk=="RAWAT JALAN")
{
	$kd="RRJ/";
}
elseif($cara_masuk=="RAWAT INAP")
{
	$kd="RRI/";
}
elseif($cara_masuk=="PASIEN LUAR")
{
	$kd="RPU/";
	$cara_masuk = "UMUM";
}
else
{
	$kd="OKA/";
}

$no_resep = $kd . date("dmy")."$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;

$q="INSERT INTO resep_head(no_resep, param_no, pasien_id, created_datetime, created_user,tgl,cara_masuk) VALUES('$no_resep', '$param_no', '$id_pasien', now(), 
	'".$_SESSION['U_USER']."','$tanggal_sekarang','$cara_masuk')";
$r=mysql_query($q); 

print "<script>location.href='home.php?hal=content/resep_reg&&id=$id_pasien&pasien_id=$id_pasien&nama=$nama_pasien&no_resep=$no_resep&param_no=$param_no'</script>";
?>