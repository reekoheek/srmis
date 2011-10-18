<?php

$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$month = date("m");
$qp= mysql_query("SELECT * FROM racik_head WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['tgl'],3,2);
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
$no_racik = "RCK/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;





$no_resep=$_POST['no_resep'];
$pasien_id=$_POST['pasien_id'];
$sub_margin=$_POST['sub_margin'];

$nama=$_POST['nama_pas'];

$q="INSERT INTO racik_head(no_racik, param_no, no_resep, created_datetime, created_user, tgl) VALUES('$no_racik','$param_no',
'$no_resep', now(), '".$_SESSION['U_USER']."','$date')";
$r=mysql_query($q);

print "<script>location.href='home.php?hal=content/racik_obat_igd&no_resep=$no_resep&pasien_id=$pasien_id&no_racik=$no_racik&param_no=$param_no&nama=$nama&sub_margin=$sub_margin'</script>";
?>