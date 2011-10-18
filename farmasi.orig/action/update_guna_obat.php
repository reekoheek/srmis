<?php
	$q = mysql_query ("UPDATE guna_obat SET kd_guna_obat = '$_POST[kd_guna_obat]', nama_guna_obat = '$_POST[nama_guna_obat]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/guna_obat'</script>";
?>