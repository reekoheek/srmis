<?php
	$q = mysql_query ("UPDATE group_barang SET kd_group_barang = '$_POST[kd_group_barang]', deskripsi = '$_POST[deskripsi]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/group_barang'</script>";
?>