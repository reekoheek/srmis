<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Data Copy Resep Pasien</b></font></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td></td>
					<td>
					<font style="font-size:12px;">
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
	$no_rm = $_POST['no_rm'];
	$cari = $_POST['cari'];
	$id_audit = $_SESSION['U_ID'];
	
	
		$q = "INSERT INTO lunas (transaksi, param_no, kode_obat, jumlah, jumlah_harga, no_rm, date, month, year, id_audit) VALUES ('$transaksi',
			 '$param_no','$kode_obat','$jumlah','$jumlah_harga','$no_rm','$date','$month','$year','$id_audit')";
		$r = mysql_query($q);
	
	// Delete data in mysql from row that has this id 
	$sql="DELETE FROM copy_resep WHERE id='$id'";
	$result=mysql_query($sql);

	// if successfully deleted
	if($result){
	?>
		<!--print "<script>alert('Barang telah Di Bayar.');location.href='home.php?hal=content/copy_resep'</script>"; -->
		<form method="post" action="home.php?hal=content/search_copy_resep" enctype="multipart/form-data">
			<input type="hidden" name="cari" value="<?=$cari?>">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barang Telah DI Bayar,.....!!! <input type="submit" value="Kembali">
		</form>
	<?php
	}

	else {
		echo "ERROR";
	}

?>
		
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>