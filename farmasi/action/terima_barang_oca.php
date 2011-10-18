<?php
	$No_BTB=$_GET['No_BTB'];
	$No_BPB=$_GET['No_BPB'];
	$No_SPP=$_GET['No_SPP'];
	$barang_id=$_GET['barang_id'];
	$id_ms=$_GET['id_ms'];
	
	$q=mysql_query("SELECT * FROM permintaan_unitdetail WHERE permintaan_unitdetail.No_SPP='$No_SPP'");
	$r=mysql_fetch_array($q);
	//{
		//disini diisi dengan if dngan unit sbg parameter
		$q2=mysql_query("SELECT * FROM barang_unit WHERE barang_id='$id_ms' AND unit_id='".$_SESSION['U_UNITID']."'");
		$r2=mysql_fetch_array($q2);
		$tgl=date("d/m/Y");
		
		$qqq=mysql_query("SELECT * FROM ms_barang WHERE id = '$id_ms'");
		$rrr=mysql_fetch_array($qqq);
		
		if(!$r2)
		{
			
			$jml=$r['Qty'];
			//$stok=$rrr['stok'];
			//$total=$jml;
			$stok=$rrr['stok'];
			$sisa=$stok - $jml;
			$q4="INSERT INTO barang_unit (barang_id, unit_id, stok, min_stok, max_stok, flags, created_datetime,created_user) VALUES 
			('$id_ms','".$_SESSION['U_UNITID']."','$jml','".$rrr['stok_min']."','".$rrr['stok_max']."','1',now(),'".$_SESSION['U_USER']."')";
			$r4=mysql_query($q4);
			$q5=mysql_query("UPDATE ms_barang SET stok='$sisa' WHERE id='$id_ms'");
			$qq4=mysql_query("UPDATE permintaan_unitdetail SET No_BTB='$No_BTB', tgl_terima='$tgl', status_detail='9', flags='1', UsrReceived='".$_SESSION['U_USER']."' WHERE id='$id'");
			//echo $qq4;
			//echo "insert";
		}
		else
		{
			$jml=$r['Qty'];
			$stok_ms=$rrr['stok'];
			$sisa=$stok_ms - $jml; //sisa di ms barang
			
			$stok_unit=$r2['stok'];
			$tambah=$jml+$stok_unit; //tambah di ubarang_unit
			//echo $jml;
			//echo $jml;
			$date=date("d/m/Y");
			
			$q5=mysql_query("UPDATE ms_barang SET stok='$sisa' WHERE id='$id_ms'");
			$q4=mysql_query("UPDATE barang_unit SET flags = '1', unit_id = '".$_SESSION['U_UNITID']."', stok='$tambah', update_datetime=now(), update_user='".$_SESSION['U_USER']."' 
						     WHERE barang_id='$id_ms'");
			$qq4=mysql_query("UPDATE permintaan_unitdetail SET No_BTB='$No_BTB', tgl_terima='$tgl', status_detail='9', flags='1', tgl_terima='$tgl', UsrReceived='".$_SESSION['U_USER']."' WHERE id='$id'");
			//echo $qq4;
		//echo"update";
		}
	//}
print "<script>alert('Barang dengan No SPP $No_SPP Telah diterima.');location.href='home.php?hal=content/lihat_status_spp_oca&No_SPP=$No_SPP'</script>";

?>