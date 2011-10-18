<?php
	$q = mysql_query ("UPDATE spesialis SET deskripsi = '$_POST[deskripsi]' WHERE kd_spesialis = '$_POST[kd_spesialis]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/spesialis'</script>";
?>