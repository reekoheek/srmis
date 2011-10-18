<?php
	$jumlah = $_POST['jumlah'];
	$jumlah_beli = $_POST['jumlah_beli'];
	$harga_jual = $_POST['harga_jual'];
	$kode_obat = $_POST['kode_obat'];
	$transaksi = $_POST['transaksi'];
	$param_no = $_POST['param_no'];
	$kode_supplier = $_POST['kode_supplier'];
	$id_audit = $_SESSION['U_ID'];
	$date = date("d");
	$month = date("m");
	$year = date("Y");
	
	
		$jumlah_harga = $jumlah_beli * $harga_beli;
		$jml = $jumlah + $jumlah_beli;
		
		$q = "INSERT INTO pembelian (transaksi, param_no, kode_obat, harga_beli, jumlah, jumlah_harga, kode_supplier, date, month, year, id_audit) VALUES ('$transaksi','$param_no',
		     '$kode_obat', '$harga_beli','$jumlah_beli', '$jumlah_harga', '$kode_supplier', '$date', '$month', '$year', '$id_audit')";
		$r = mysql_query($q);
		
		$q2 = mysql_query ("UPDATE obat SET jumlah = '$jml' WHERE kode_obat = '$kode_obat'");
		
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/pembelian_stock'>";
		
	
?>