<?php
	if ($_POST['no_rm']=="")
	{
		print "<script>alert('No Rekam Medik Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/pasien'</script>";
	}
	else
	{
		$q = "INSERT INTO pasien (no_rm, param_no, nama, jns_kel, ttl, alamat, no_telp, pekerjaan) VALUE ('".$_POST['no_rm']."',
			  '".$_POST['param_no']."','".$_POST['nama']."','".$_POST['jns_kel']."','".$_POST['ttl']."','".$_POST['alamat']."',
			  '".$_POST['no_telp']."','".$_POST['pekerjaan']."')";
		$r = mysql_query ($q);
		if ($r) 
		{
			print "<script>alert('Data Berhasil di Simpan.');location.href='home.php?hal=content/pasien'</script>";
		}
		else
		{
			print "<script>alert('No Rekam Medik pasien Sudah Ada, Silahkan Ganti!');location.href='home.php?hal=content/pasien'</script>";
		}
	}
?>