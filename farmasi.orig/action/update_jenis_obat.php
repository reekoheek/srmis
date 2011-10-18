<?php
	$q = mysql_query ("UPDATE jenis_obat SET kd_jenis_obat = '$_POST[kd_jenis_obat]', deskripsi = '$_POST[deskripsi]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/jenis_obat'</script>";
?>