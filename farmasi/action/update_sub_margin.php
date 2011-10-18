<?php
	/*$q = mysql_query ("UPDATE margin SET jenis = '$_POST[jenis]', 
										 kode = '$_POST[kode]',
										 klasifikasi_pasien = '$_POST[klasifikasi_pasien]',
										 margin = '$_POST[margin]'
										 WHERE id = '$_POST[id]'");*/
										 
	$q = mysql_query ("UPDATE sub_margin2 SET margin_id = '$_POST[klasifikasi]',
											  sub_klasifikasi = '$_POST[sub_klasifikasi]',
											  margin = '$_POST[margin]' WHERE id = '$_POST[id]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/sub_margin'</script>";
?>