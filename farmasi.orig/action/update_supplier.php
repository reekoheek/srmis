<?php
	$q = mysql_query ("UPDATE supplier SET nama = '$_POST[nama]', 
										   alamat = '$_POST[alamat]',
										   no_telp = '$_POST[no_telp]' 
										   WHERE kode_supplier = '$_POST[kode_supplier]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/supplier'</script>";
?>