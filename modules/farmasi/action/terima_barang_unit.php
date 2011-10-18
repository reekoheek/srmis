<?php
	$No_BTB2=$_POST['No_BTB'];
	$No_BPB2=$_POST['No_BPB'];
	$No_SPP2=$_POST['No_SPP'];
	$barang_id2=$_POST['barang_id'];
	
	$No_BTB=$_POST['No_BTB'];
	$No_BPB=$_POST['No_BPB'];
	$No_SPP=$_POST['No_SPP'];
	//$barang_id=$_POST['barang_id'];

	
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
			/*print "<script>alert('Barang dengan No SPP $No_SPP2 Telah diterima.');location.href='home.php?hal=content/list_BTB'</script>";*/
		}
		
		else
		{
		$qaap=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP = '$No_SPP2' and status_detail <> '6' and status_detail <> '9'");
		$rapp = mysql_fetch_array($qaap);
		if ($rapp)
			{
		/*print "<script>alert('Masih Ada Item yang belum di Received...Harap Received');location.href='home.php?hal=content/lihat_status_spp&No_SPP=$No_SPP2'</script>";*/
	    	}
		else 
			{
						$tgl=date("d/m/Y");
			$qq=mysql_query("UPDATE permintaan_unit SET status='7', UsrReceived='".$_SESSION['U_USER']."', Tgl_Received='$tgl' WHERE No_SPP='$No_SPP2' ");
			/*print "<script>alert('Barang dengan No SPP $No_SPP2 Telah diterima.');location.href='home.php?hal=content/list_BTB'</script>";*/
			}
		}
		
		
		
		
		
		//UPDATE DI UNIT BARANG
		$q=mysql_query("SELECT * FROM permintaan_unitdetail WHERE No_SPP='$No_SPP'");
		while ($r=mysql_fetch_array($q))
		{
			//disini diisi dengan if dngan unit sbg parameter
			$q2=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$r[barang_id]' AND unit_id='".$_SESSION['U_UNITID']."'");
			$r2=mysql_fetch_array($q2);
			$tgl=date("d/m/Y");
		
			$qqq=mysql_query("SELECT * FROM ms_barang WHERE id = '$r[barang_id]'");
			$rrr=mysql_fetch_array($qqq);
		
			if(!$r2)
			{
			
				$jml=$r['Qty_diberi'];
				$harga_sekarang = $rrr['harga_dosp'];
				$q4="INSERT INTO barang_unit (barang_id, unit_id, stok, min_stok, max_stok, flags, created_datetime,created_user,fld01,fld02) VALUES 
				('$r[barang_id]','".$_SESSION['U_UNITID']."','$jml','".$rrr['stok_min']."','".$rrr['stok_max']."','1',now(),'".$_SESSION['U_USER']."','".$rrr['harga_dosp']."','$harga_sekarang')";
				$r4=mysql_query($q4);
				
				$qq4=mysql_query("UPDATE permintaan_unitdetail SET No_BTB='$No_BTB', tgl_terima='$tgl', status_detail='9', flags='1', UsrReceived='".$_SESSION['U_USER']."' WHERE id='$r[id]'");
			}
			else
			{
				$jml=$r['Qty_diberi'];
			
				$stok_unit=$r2['stok'];
				$tambah=$jml+$stok_unit; //tambah di ubarang_unit
				$date=date("d/m/Y");
				$harga_sekarang = $rrr['harga_dosp'] + 500;
				$q4=mysql_query("UPDATE barang_unit SET flags = '1', stok='$tambah', update_datetime=now(), update_user='".$_SESSION['U_USER']."',fld01='".$rrr['harga_dosp']."',fld02='$harga_sekarang' WHERE barang_id='$r[barang_id]' AND unit_id = '".$_SESSION['U_UNITID']."'");
				$qq4=mysql_query("UPDATE permintaan_unitdetail SET No_BTB='$No_BTB', tgl_terima='$tgl', status_detail='9', flags='1', tgl_terima='$tgl', UsrReceived='".$_SESSION['U_USER']."' WHERE id='$r[id]'");
			}
		}
		
		$qqw=mysql_query("UPDATE permintaan_unit SET status='9', UsrReceived='".$_SESSION['U_USER']."', Tgl_Received='$tgl' WHERE No_SPP='$No_SPP2' ");
		print "<script>alert('Barang dengan No SPP $No_SPP2 Telah diterima.');location.href='home.php?hal=content/list_BTB'</script>";

?>