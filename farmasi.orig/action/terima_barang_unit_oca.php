<?php
	$No_BTB2=$_POST['No_BTB'];
	$No_BPB2=$_POST['No_BPB'];
	$No_SPP2=$_POST['No_SPP'];
	$barang_id2=$_POST['barang_id'];

	$qo=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP = '$No_SPP2' AND status_detail=9");
	$countud=0;
	while($ro=mysql_fetch_array($qo))
	{
		$countud++;
	}
	//echo $countud;
	$qo2=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP = '$No_SPP2'");
	$countall=0;
	while($ro2=mysql_fetch_array($qo2))
	{
		$countall++;
	}
	//echo $countall;
		if ($countud == $countall)
		{
			$tgl=date("d/m/Y");
			$qq=mysql_query("UPDATE permintaan_unit SET status='9', UsrReceived='".$_SESSION['U_USER']."', Tgl_Received='$tgl' WHERE No_SPP='$No_SPP2' ");
			print "<script>alert('Barang dengan No SPP $No_SPP2 Telah diterima.');location.href='home.php?hal=content/list_BTB_oca'</script>";
		}
		
		else
		{
		$qaap=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP = '$No_SPP2' and status_detail <> '6' and status_detail <> '9'");
		$rapp = mysql_fetch_array($qaap);
		if ($rapp)
			{
		print "<script>alert('Masih Ada Item yang belum di Received...Harap Received');location.href='home.php?hal=content/lihat_status_spp_oca&No_SPP=$No_SPP2'</script>";
	    	}
		else 
			{
						$tgl=date("d/m/Y");
			$qq=mysql_query("UPDATE permintaan_unit SET status='7', UsrReceived='".$_SESSION['U_USER']."', Tgl_Received='$tgl' WHERE No_SPP='$No_SPP2' ");
			print "<script>alert('Barang dengan No SPP $No_SPP2 Telah diterima.');location.href='home.php?hal=content/list_BTB_oca'</script>";
			}
		}
		
?>