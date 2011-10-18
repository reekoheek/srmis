<?php
	$q = mysql_query ("UPDATE pabrik SET nama = '$_POST[nama]' WHERE kd_pabrik = '$_POST[kd_pabrik]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/pabrik'</script>";
?>