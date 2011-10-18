<?php
	if ($_POST['kode_supplier']=="")
	{
		print "<script>alert('Kode Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/supplier'</script>";
	}
	else
	{
		$q = "INSERT INTO supplier (kode_supplier, nama, alamat, no_telp) VALUE ('".$_POST['kode_supplier']."','".$_POST['nama']."','".$_POST['alamat']."',
			  '".$_POST['no_telp']."')";
		$r = mysql_query ($q);
		if ($r) 
		{
			print "<script>alert('Data Berhasil di Simpan.');location.href='home.php?hal=content/supplier'</script>";
		}
		else
		{
			print "<script>alert('Kode Supplier Sudah Ada, Silahkan Ganti!');location.href='home.php?hal=content/supplier'</script>";
		}
	}
?>