<?php
	$q = mysql_query ("UPDATE pasien SET nama = '$_POST[nama]',
										 jns_kel = '$_POST[jns_kel]',
										 ttl = '$_POST[ttl]', 
										   alamat = '$_POST[alamat]',
										   no_telp = '$_POST[no_telp]',
										   pekerjaan = '$_POST[pekerjaan]' 
										   WHERE no_rm = '$_POST[no_rm]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/pasien'</script>";
?>