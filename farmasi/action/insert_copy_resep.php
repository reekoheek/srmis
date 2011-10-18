<?php
	$date = date("d");
	$month = date("m");
	$year = date("Y");
	$transaksi = $_POST['transaksi'];
	$id = $_POST['id'];
	$param_no = $_POST['param_no'];
	$kode_obat = $_POST['kode_obat'];
	$jumlah = $_POST['jumlah'];
	$jumlah_harga = $_POST['jumlah_harga'];
	$id_audit = $_SESSION['U_ID'];
	$no_rm = $_POST['no_rm'];
	
	
		$q = "INSERT INTO copy_resep (transaksi, param_no, kode_obat, jumlah, jumlah_harga, no_rm, date, month, year, id_audit) VALUES ('$transaksi',
			 '$param_no','$kode_obat','$jumlah','$jumlah_harga','$no_rm','$date','$month','$year','$id_audit')";
		$r = mysql_query($q);
	
	// Delete data in mysql from row that has this id 
	$sql="DELETE FROM penjualan WHERE id='$id'";
	$result=mysql_query($sql);

	// if successfully deleted
	if($result){
		print "<script>alert('Data Berhasil di Copy Resep.');location.href='home.php?hal=content/penjualan'</script>";
	}

	else {
		echo "ERROR";
	}

?>