<?php
$date = date("d/m/Y");	
$No_SPP = $_POST['No_SPP'];
$tahun = date("Y");
$qp= mysql_query("SELECT * FROM permintaan_unit WHERE LAST_INSERT_ID(param_rpb) ORDER BY ID DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['tgl_retur'],6,4);
if ($tgl == $tahun)
{
	$temp = $rp['param_rpb'];
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
$No_RPB = "RPB/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_rpb = $count;

	$user = $_SESSION['U_USER'];
	/*cek Count permintaan_unitdetail retur berdasarkan No_SPP*/
	$qe=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP='$No_SPP' and UsrRetur='".$_SESSION['U_USER']."' and Unit='".$_SESSION['U_SUBUNIT']."' and status_detail='6' ORDER BY ID");
	$countud=0;
	while ($re=mysql_fetch_array($qe))
	{
		$countud++;
	}
	 
	if ($countud > 0)
		{
		$qu = mysql_query("Update permintaan_unit SET No_RPB='$No_RPB', param_rpb='$param_rpb', tgl_retur='$date',UsrRetur='".$_SESSION['U_USER']."' where Unit='".$_SESSION['U_SUBUNIT']."' and No_SPP='$No_SPP'");
		$qed=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP='$No_SPP' and UsrRetur='".$_SESSION['U_USER']."' and Unit='".$_SESSION['U_SUBUNIT']."' and status_detail='6' ORDER BY ID");
		while ($red=mysql_fetch_array($qed))
			{
		$qud =  mysql_query("Update permintaan_unitdetail SET No_RPB='$No_RPB' where UsrRetur='".$_SESSION['U_USER']."' and Unit='".$_SESSION['U_SUBUNIT']."' and No_SPP='$No_SPP' and status_detail='6'");
			}
		print "<script>location.href='home.php?hal=content/bukti_retur&No_RPB=$No_RPB&tgl_retur=$date'</script>";
		}
?>