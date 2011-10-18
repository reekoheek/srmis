<?php
	$q = mysql_query ("UPDATE obat SET nama_obat = '$_POST[nama_obat]', 
										   kode_jenis = '$_POST[kode_jenis]',
										   status_obat = '$_POST[status_obat]',
										   harga_jual = '$_POST[harga_jual]',
										   jumlah = '$_POST[jumlah]',
										   ket = '$_POST[ket]',
										   harga_beli = '$_POST[harga_beli]' 
										   WHERE kode_obat = '$_POST[kode_obat]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/obat'</script>";
?>