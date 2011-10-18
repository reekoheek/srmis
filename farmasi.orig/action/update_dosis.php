<?php
	$q = mysql_query ("UPDATE dosis SET deskripsi = '$_POST[deskripsi]', obat_per_hari = '$_POST[obat_per_hari]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/dosis'</script>";
?>