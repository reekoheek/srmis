<?php
	$q = mysql_query ("UPDATE pbf SET nama = '$_POST[nama]', alamat = '$_POST[alamat]', kota = '$_POST[kota]'
					   , telepon = '$_POST[telepon]', fax = '$_POST[fax]', kontak = '$_POST[kontak]', no_rek = '$_POST[no_rek]' WHERE kd_rekaan = '$_POST[kd_rekaan]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/pbf'</script>";
?>