<?php
	$q = mysql_query ("UPDATE tipe_obat SET kd_tipe_obat = '$_POST[kd_tipe_obat]', nama_tipe_obat = '$_POST[nama_tipe_obat]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/tipe_obat'</script>";
?>