<?php

$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$month = date("m");
$qp= mysql_query("SELECT * FROM racik_head WHERE LAST_INSERT_ID(param_no) and no_racik like 'RCU%' ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['tgl'],3,2);
//echo $tgl;
if ($tgl == $month)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_racik = "RCU/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;


$no_resep=$_POST['no_resep'];
$nama_pas=$_POST['nama'];
$rs_asal=$_POST['rs_asal'];
$jenis_ket=$_POST['jenis_ket'];
$no_ket=$_POST['no_ket'];


$q="INSERT INTO racik_head(no_racik, param_no,  created_datetime, created_user, tgl) VALUES('$no_racik','$param_no', now(), '".$_SESSION['U_USER']."','$date')";
$r=mysql_query($q);


/* echo $param_no;
echo $no_racik; */
print "<script>location.href='home.php?hal=content/racik_obat_umum&no_racik=$no_racik&jenis_ket=$jenis_ket&no_ket=$no_ket&param_no=$param_no&no_resep=$no_resep&nama_pas=$nama_pas&rs_asal=$rs_asal'</script>"; 
?>