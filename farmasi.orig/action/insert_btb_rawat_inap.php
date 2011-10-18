<?php
$no_SPP = $_GET['No_SPP'];
$user = $_GET['UsrBuat'];

$date = date("d/m/Y");
$tahun = date("Y");
$qp= mysql_query("SELECT * FROM permintaan_unit WHERE LAST_INSERT_ID(param_btb) ORDER BY ID DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl2 = substr($date,6,4);
if (trim($tgl2) == trim($tahun))
{
	$temp = $rp['param_btb'];
	$count = $temp + 1;
	echo $count;
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
$No_BTB = "BTB/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_btb = $count;


$q=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$No_SPP' AND status = '7'");
$r=mysql_fetch_array($q);
if ($r['No_BTB'])
{
print "<script>alert('Data dengan No SPP $no_SPP telah di CLOSE.');location.href='home.php?hal=content/list_BTB_rawat_inap'</script>";
}
else
{
$qbtb=mysql_query("Update permintaan_unit set No_BTB='$No_BTB', param_btb='$param_btb', tgl_received='$date' where No_SPP = '$no_SPP'");
print "<script>location.href='home.php?hal=content/lihat_status_spp_rawat_inap&No_BTB=$No_BTB&No_SPP=$No_SPP&Tgl=$date&UsrBuat=".$_SESSION['U_USER']."'</script>";
}
?>