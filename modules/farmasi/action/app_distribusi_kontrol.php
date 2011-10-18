<?php


	
	
	$kd_barang=$_GET['kd_barang'];
	$id=$_GET['id'];
	$No_SPP=$_GET['No_SPP'];
	$status=$_GET['status'];
	$No_BPB=$_GET['No_BPB'];
	$id_ms=$_GET['id_ms'];
	$no_SPP=$_GET['no_SPP'];
	$stat=$_GET['stat'];
	$Tgl_SPP=$_GET['Tgl_SPP'];


	$qq=mysql_query("SELECT * FROM ms_barang WHERE id='$id_ms'");
			$rq=mysql_fetch_array($qq);
			$stok_ms=$rq['stok'];
	
			$qu=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id='$id'");
			$ru=mysql_fetch_array($qu);
			$Qty_diberi=$_GET['diberi'];
			//$qty=$ru['Qty'];
	
			$jml_sisa=$stok_ms-$Qty_diberi;
	
			$q=mysql_query("UPDATE permintaan_unitdetail SET Qty_diberi='$Qty_diberi', status_detail='2',No_BPB='$No_BPB' WHERE id='$id'");
			$qr2=mysql_query("UPDATE ms_barang SET stok='$jml_sisa' WHERE id='$id_ms'");
			
			$hehe=1;
			print "<script>alert('Data Berhasil di APPROVE.');location.href='home.php?hal=content/distribusi_kontrol&No_SPP=$No_SPP&No_BPB=$No_BPB&Tgl_SPP=$Tgl_SPP'</script>";

?>