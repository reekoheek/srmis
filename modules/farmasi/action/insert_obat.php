<?php
	if ($_POST['kode_obat']=="")
	{
		print "<script>alert('Kode Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/obat'</script>";
	}
	else
	{
		$q = "INSERT INTO obat (kode_obat, kode_jenis, nama_obat, harga_jual, jumlah, status_obat, ket, harga_beli) VALUE ('".$_POST['kode_obat']."','".$_POST['kode_jenis']."',
			 '".$_POST['nama_obat']."','".$_POST['harga_jual']."','".$_POST['jumlah']."','".$_POST['status_obat']."','".$_POST['ket']."','".$_POST['harga_beli']."')";
		$r = mysql_query ($q);
		if ($r) 
		{
			print "<script>alert('Data Berhasil di Simpan.');location.href='home.php?hal=content/obat'</script>";
		}
		else
		{
			print "<script>alert('Kode obat Sudah Ada, Silahkan Ganti!');location.href='home.php?hal=content/obat'</script>";
		}
	}
?>