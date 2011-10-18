<?php
//$date = $_GET['Tgl_SPP'];
//$No_SPP = $_GET['No_SPP'];
//$no_SPP = $_POST['no_SPP'];	



	$no_SPP = $_POST['no_SPP'];
	$tgl = $_POST['tgl'];
	$no_BPB = $_POST['no_BPB'];

$qna = mysql_query("select * from permintaan_unitdetail where No_SPP='$no_SPP' and status_detail='1'");
$rna = mysql_fetch_array($qna);

if ($rna)
	{
	print "<script>alert('Maaf data barang harus di APPROVE.');location.href='home.php?hal=content/Distribusi_Obat&id=$id&No_SPP=$no_SPP&Tgl_SPP=$tgl&No_BPB=&no_BPB'</script>";	
	}
else
	{
	
	$qa = mysql_query("select * from permintaan_unitdetail where No_SPP='$no_SPP' AND status_detail='9' ORDER BY id");
	$countrec=0;
	while($rc = mysql_fetch_array($qa))
	{
		$countrec++;
	}

	
	$qa = mysql_query("select * from permintaan_unitdetail where No_SPP='$no_SPP' AND status_detail <> '0' ORDER BY id");
	$countall=0;
	while($rc = mysql_fetch_array($qa))
	{
		$countall++;
	}
	//$countall = count($rc);
	
	$qaap = mysql_query("select * from permintaan_unitdetail where status_detail='2' and No_SPP='$no_SPP' ORDER BY id");
	$countapp=0;
	while($rcapp = mysql_fetch_array($qaap))
	{
		$countapp++;
	}
	//$countapp = count($rcapp);
	
	$qapd = mysql_query("select * from permintaan_unitdetail where status_detail='3' and  No_SPP='$no_SPP' ORDER BY id");
	$countapd=0;
	while($rcapd = mysql_fetch_array($qapd))
	{
		$countapd++;
	}
	//$countapd = count($rcapd);
	
	//echo $countall."==".$countapd. "==". $countapp;
	if (($countall == $countapp) OR (($countall - $countrec) == $countapp))
		{
			$q=mysql_query("UPDATE permintaan_unit SET status='2', UsrApprove='".$_SESSION['U_USER']."' WHERE No_SPP='$no_SPP'");
		print "<script>alert('Data dengan No.SPP=$no_SPP Sudah di APPROVE.');location.href='home.php?hal=content/Distribusi_Obat&id=$id&No_SPP=$no_SPP&Tgl_SPP=$tgl&No_BPB=&no_BPB'</script>";		
		}			
	else if (($countall == $countapd) OR (($countall - $countrec) == $countapp))
		{
			$q=mysql_query("UPDATE permintaan_unit SET status='3', UsrApprove='".$_SESSION['U_USER']."' WHERE No_SPP='$no_SPP'");
		print "<script>alert('Data dengan No.SPP=$no_SPP Sudah di PENDING.');location.href='home.php?hal=content/Distribusi_Obat&id=$id&No_SPP=$no_SPP&Tgl_SPP=$tgl&No_BPB=&no_BPB'</script>";	
		}
	else if (($countall <> $countapd) or ($countall <> $countapp))
		{
		$qgridpd = "select * from permintaan_unitdetail where No_SPP='$no_SPP' and status_detail=3";
		$rgridpd = mysql_query($qgridpd);
		if ($rgridpd)
			{
			$q=mysql_query("UPDATE permintaan_unit SET status='8', UsrApprove='".$_SESSION['U_USER']."' WHERE No_SPP='$no_SPP'");
			print "<script>alert('Data dengan No.SPP=$no_SPP belum di APPROVE.');location.href='home.php?hal=content/Distribusi_Obat&id=$id&No_SPP=$no_SPP&Tgl_SPP=$tgl&No_BPB=&no_BPB'</script>";	
			}
		else
			{
			$q=mysql_query("UPDATE permintaan_unit SET status='8', UsrApprove='".$_SESSION['U_USER']."' WHERE No_SPP='$no_SPP'");
			print "<script>alert('Data dengan No.SPP=$no_SPP belum di APPROVE.');location.href='home.php?hal=content/Distribusi_Obat&id=$id&No_SPP=$no_SPP&Tgl_SPP=$tgl&No_BPB=&no_BPB'</script>";	
			}
		}
	}
?>