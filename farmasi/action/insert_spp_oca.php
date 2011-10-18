<?php
$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$tahun = date("Y");
$qp= mysql_query("SELECT * FROM permintaan_unit WHERE LAST_INSERT_ID(param_no) ORDER BY ID DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['Tgl_SPP'],6,4);
if ($tgl == $tahun)
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
$no_SPP = "SPP/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;



	$user = $_SESSION['U_USER'];
	$qe=mysql_query("SELECT * FROM permintaan_unit WHERE UsrBuat='$user' ORDER BY ID DESC LIMIT 1");
	$re=mysql_fetch_array($qe);
	if (!$re)
	{
		$q = "INSERT INTO permintaan_unit (No_SPP, param_no, tgl_SPP,UsrBuat,Unit) 
				  VALUES ('$no_SPP','$param_no', '$date','".$_SESSION['U_USER']."','".$_SESSION['U_SUBUNIT']."')";
		$r = mysql_query($q);
		print "<script>location.href='home.php?hal=content/Permintaan_Obat_oca&No_SPP=$no_SPP&Tgl_SPP=$date'</script>";
	}
	else
	{
		
		if($re['status']==5)
		{
		$qe2=mysql_query("SELECT * FROM permintaan_unit WHERE UsrBuat='$user' AND status ='5' ORDER BY ID DESC LIMIT 1");
		
		$re2=mysql_fetch_array($qe2);
				$no=$re['No_SPP'];
				$tgl=$re['Tgl_SPP'];
				print "<script>location.href='home.php?hal=content/Permintaan_Obat_oca&No_SPP=$no&Tgl_SPP=$tgl' </script>";
		}
		else
		{
				$q = "INSERT INTO permintaan_unit (No_SPP, param_no, tgl_SPP,UsrBuat,Unit) 
				  VALUES ('$no_SPP','$param_no', '$date','".$_SESSION['U_USER']."','".$_SESSION['U_SUBUNIT']."')";
				$r = mysql_query($q);
				print "<script>location.href='home.php?hal=content/Permintaan_Obat_oca&No_SPP=$no_SPP&Tgl_SPP=$date' </script>";
		}
	}	
?>