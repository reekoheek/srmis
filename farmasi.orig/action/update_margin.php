<?php
	/*$q = mysql_query ("UPDATE margin SET jenis = '$_POST[jenis]', 
										 kode = '$_POST[kode]',
										 klasifikasi_pasien = '$_POST[klasifikasi_pasien]',
										 margin = '$_POST[margin]'
										 WHERE id = '$_POST[id]'");*/
										 
	$q = mysql_query ("UPDATE margin SET klasifikasi = '$_POST[klasifikasi]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/margin'</script>";
?>