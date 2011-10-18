<?php

$id=$_POST['id'];
$nama=$_POST['nama'];
$masuk=$_POST['jam_masuk'];
$keluar=$_POST['jam_keluar'];
$qedit=mysql_query("UPDATE shift_karyawan SET nama='$nama',masuk='$masuk',keluar='$keluar' WHERE id='$id'"); 

if($qedit)
{
	echo"<script>alert('Data berhasil di update');location.href='home.php?hal=content/shift_karyawan'</script>";
}else
{
	echo"<script>alert('Data gagal dihapus');location.href='home.php?hal=content/shift_karyawan'</script>";
}

?>