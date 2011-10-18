<?php
	$q = mysql_query ("UPDATE margin_tunai SET kategori_obat = '$_POST[kategori_obat]', margin = '$_POST[margin]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/margin_tunai'</script>";
?>