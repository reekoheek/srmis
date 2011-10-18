<?php
	$id= $_POST['id'];
	$status_aktivasi = $_POST['status_aktivasi'];
	
	$q = mysql_query ("UPDATE admin SET status_aktivasi = '$status_aktivasi' WHERE id = '$id'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/aktivasi_akun'</script>";
?>