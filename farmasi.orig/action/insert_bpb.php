<?php
$date = $_GET['Tgl_SPP'];
$No_SPP = $_GET['No_SPP'];
	//$no_SPP = $_POST['no_SPP'];	
$tahun = date("Y");
$qp= mysql_query("SELECT * FROM permintaan_unit WHERE LAST_INSERT_ID(param_bpb) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);
$tgl = substr($rp['tgl_bpb'],6,4);
if ($tgl == $tahun)
{
	$temp = $rp['param_bpb'];
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
$no_BPB = "BPB/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_bpb = $count;



	$user = $_SESSION['U_USER'];
	$qe=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$No_SPP' ORDER BY id DESC LIMIT 1");
	$re=mysql_fetch_array($qe);
	//echo $qe;
	
	$qssp=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$No_SPP'");
	$rspp=mysql_fetch_array($qssp);
	if (!$re['No_BPB'])
	{
	$q = "Update permintaan_unit set No_BPB='$no_BPB', param_bpb='$param_bpb', UsrApprove='".$_SESSION['U_USER']."', tgl_bpb='$date' where No_SPP='$No_SPP'";
	$r = mysql_query($q);
	$qud = "Update permintaan_unitdetail set No_BPB='$no_BPB' where No_SPP='$No_SPP";
	$rud = mysql_query($qud);
	print "<script>location.href='home.php?hal=content/distribusi_kontrol&No_BPB=$no_BPB&No_SPP=$No_SPP&Tgl=$date'</script>";
	}
	else
	{
	$qq=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$re[No_SPP]'");
	$rr=mysql_fetch_array($qq);
		if(($rr['status']==1) OR ($rr['status']==3))
		{
			$qe2=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP ='$rr[No_SPP]' ORDER BY ID DESC LIMIT 1");
		
			$re2=mysql_fetch_array($qe2);
			$no=$re2['No_BPB'];
			//echo "sama dengan 1";
			//$tgl=$re['Tgl'];
			print "<script>location.href='home.php?hal=content/distribusi_kontrol&No_BPB=$no_BPB&No_SPP=$rr[No_SPP]&Tgl=$rr[Tgl_SPP]'</script>";
				
		}
		else
		{
			$qssp=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$No_SPP'");
			$rspp=mysql_fetch_array($qssp);
			$userMinta = $rspp['UsrBuat'];
		
			$q = "Update permintaan_unit set No_BPB='$no_BPB', param_bpb='$param_bpb', UsrApprove='".$_SESSION['U_USER']."', tgl_bpb='$date' where No_SPP='$No_SPP";
			$r = mysql_query($q);
			$qud = "Update permintaan_unitdetail set No_BPB='$no_BPB' where No_SPP='$No_SPP";
			$rud = mysql_query($qud);
			//echo "TIDAK sama dengan 1";
			print "<script>location.href='home.php?hal=content/distribusi_kontrol&No_BPB=$no_BPB&No_SPP=$No_SPP&Tgl=$date'</script>";
		}
	}	
?>