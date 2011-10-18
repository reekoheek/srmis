<?php
	$nama=$_POST['nama'];
	$jammasuk=$_POST['jam_masuk'];
	$jamkeluar=$_POST['jam_keluar'];
	
	if($_POST['nama']=="")
	{
		echo "<script>alert('Nama Shift harus diisi!');location.href='home.php?hal=content/shift_karyawan'</script>";
	}else
	if($_POST['jam_masuk']=="")
	{
		echo "<script>alert('Jam Masuk harus diisi!');location.href='home.php?hal=content/shift_karyawan'</script>";
	}else
	if($_POST['jam_keluar']=="")
	{
		echo "<script>alert('Jam Keluar harus diisi!');location.href='home.php?hal=content/shift_karyawan'</script>";
	}else
	{
		mysql_query("insert into shift_karyawan(nama,masuk,keluar,created_user) VALUES('$nama','$jammasuk','$jamkeluar','$_SESSION[U_USER]')");
		echo "<script>alert('Data Telah Tersimpan');location.href='home.php?hal=content/shift_karyawan'</script>";
	}
?>