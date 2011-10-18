<?php
	$q = mysql_query ("UPDATE golongan_obat SET kd_golongan_obat = '$_POST[kd_golongan_obat]', deskripsi = '$_POST[deskripsi]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/golongan_obat'</script>";
?>