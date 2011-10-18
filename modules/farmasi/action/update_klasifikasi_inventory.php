<?php
	$q = mysql_query ("UPDATE klasifikasi_inventory SET deskripsi = '$_POST[deskripsi]' WHERE kd_klasifikasi_inventory = '$_POST[kd_klasifikasi_inventory]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/klasifikasi_inventory'</script>";
?>