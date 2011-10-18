<?php
	$q = "INSERT INTO margin (jenis, kode, klasifikasi_pasien, margin) VALUES ('".$_POST['jenis']."', '".$_POST['kode']."'
		  , '".$_POST['klasifikasi_pasien']."', '".$_POST['margin']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/margin'>";
?>