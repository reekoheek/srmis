<?php
	include "include/koneksi.php";
	
	if ($_POST['kode'] == "2")
	{
		$ket = "Apoteker";
	}
	if ($_POST['kode'] == "3")
	{
		$ket = "Kasir";
	}
	$q2 = mysql_query ("SELECT * FROM admin WHERE username = '$_POST[username]'");
	$r2 = mysql_fetch_array($q2);
	if ((!$_POST['username']) || (!$_POST['password']))
	{
		print "<script>alert('Username dan Password Harus di Isi');location.href='daftar.php'</script>";
	}
	elseif ($r2['username'])
	{
		print "<script>alert('Username Sudah Ada,. Silahkan Ganti');location.href='daftar.php'</script>";
	}
	elseif ($_POST['re_password'] == $_POST['password'])
	{
		$status_aktivasi = "0";
		$pass = md5($_POST['password']);
		$q = "INSERT INTO admin (username, fullname, password, jns_kel, kode, ket, status_aktivasi) VALUES ('".$_POST['username']."','".$_POST['fullname']."','$pass',
		  	  '".$_POST['jns_kel']."','".$_POST['kode']."','$ket','$status_aktivasi')";
		$r = mysql_query($q);
		print "<script>alert('Daftar Berhasil,. Silahkan Hubungi Admin Untuk Aktivasi Akun Anda.');location.href='index.php'</script>";
	}
	else
	{
		print "<script>alert('Input Re - Password Tidak Sesuai Input Dengan Password, Coba Ulangi Lagi.');location.href='daftar.php'</script>";
	}
?>