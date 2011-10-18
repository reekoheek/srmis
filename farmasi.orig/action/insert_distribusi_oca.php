<?php
	$no_SPP = $_POST['no_SPP'];
	$tgl = $_POST['tgl'];
	$id=$_POST['id'];
	//$qq="INSERT INTO permintaan_unit (No_SPP,Tgl_SPP) VALUES ('$no_SPP','$tgl')";
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	//echo $qq;
	$q=mysql_query("UPDATE permintaan_unit SET status='1',ket_status='1' WHERE No_SPP='$no_SPP'" );
	print "<script>alert('Data Telah Di Simpan Ke Distribusi Stok.');location.href='home.php?hal=content/list_spp_oca&id=$id'</script>";
?>