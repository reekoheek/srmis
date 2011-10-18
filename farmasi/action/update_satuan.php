<?php
	$q = mysql_query ("UPDATE satuan SET deskripsi = '$_POST[deskripsi]' WHERE kd_satuan = '$_POST[kd_satuan]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/satuan'</script>";
?>