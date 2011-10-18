<?php
	$jumlah_beli = $_POST['jumlah_beli'];
	$nama_obat = $_POST['nama_obat'];
	$jenis_obat = $_POST['jenis_obat'];
	$ket = $_POST['ket'];
	$harga_jual = $_POST['harga_jual'];
	$harga_beli = $_POST['harga_beli'];
	$status_obat = $_POST['status_obat'];
	$kode_obat = $_POST['kode_obat'];
	$transaksi = $_POST['transaksi'];
	$param_no = $_POST['param_no'];
	$kode_supplier = $_POST['kode_supplier'];
	$id_audit = $_SESSION['U_ID'];
	$date = date("d");
	$month = date("m");
	$year = date("Y");
	if ($_POST['kode_obat']=="")
	{
		print "<script>alert('Kode Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/transaksi_pembelian'</script>";
	}
	else
	{
		$jumlah_harga = $harga_beli * $jumlah_beli;
		$q2 = "INSERT INTO obat (kode_obat, kode_jenis, nama_obat, harga_jual, jumlah, status_obat, ket, harga_beli) VALUE ('".$_POST['kode_obat']."','".$_POST['kode_jenis']."',
			   '".$_POST['nama_obat']."','".$_POST['harga_jual']."','".$_POST['jumlah_beli']."','".$_POST['status_obat']."','".$_POST['ket']."','".$_POST['harga_beli']."')";
		$r2 = mysql_query ($q2);
		if ($r2) 
		{
			$q = "INSERT INTO pembelian (transaksi, param_no, kode_obat, harga_beli, jumlah, jumlah_harga, kode_supplier, date, month, year, id_audit) VALUES ('$transaksi',
				 '$param_no','$kode_obat', '$harga_beli','$jumlah_beli', '$jumlah_harga', '$kode_supplier', '$date', '$month', '$year','$id_audit')";
			$r = mysql_query($q);
			echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/pembelian'>";
		}
		else
		{
			print "<script>alert('Kode obat Sudah Ada, Silahkan Ganti!');location.href='home.php?hal=content/transaksi_pembelian'</script>";
		}
	}
?>