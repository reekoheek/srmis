<?php
	$jumlah = $_POST['jumlah'];
	$jumlah_jual = $_POST['jumlah_jual'];
	$harga_jual = $_POST['harga_jual'];
	$kode_obat = $_POST['kode_obat'];
	$transaksi = $_POST['transaksi'];
	$no_rm = $_POST['no_rm'];
	$param_no = $_POST['param_no'];
	$id_audit = $_SESSION['U_ID'];
	$date = date("d");
	$month = date("m");
	$year = date("Y");
	
	if ($jumlah < $jumlah_jual)
	{
		print "<script>alert('Stock Obat Tidak Mencukupi Untuk Melakukan Transaksi.');location.href='home.php?hal=content/penjualan'</script>";
	}
	elseif ($jumlah=="0")
	{
		print "<script>alert('Maaf,...Stock Obat Habis.');location.href='home.php?hal=content/penjualan'</script>";
	} 
	else
	{
		$jumlah_harga = $jumlah_jual * $harga_jual;
		$sisa = $jumlah - $jumlah_jual;
		
		$q = "INSERT INTO penjualan (transaksi, param_no, kode_obat, jumlah, jumlah_harga, no_rm, date, month, year, id_audit) VALUES ('$transaksi',
		     '$param_no','$kode_obat','$jumlah_jual','$jumlah_harga','$no_rm','$date','$month','$year','$id_audit')";
		$r = mysql_query($q);
		
		$q2 = mysql_query ("UPDATE obat SET jumlah = '$sisa' WHERE kode_obat = '$kode_obat'");
		
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/penjualan'>";
		
	}
?>