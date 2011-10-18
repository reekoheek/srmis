<?php

$id=$_GET['id'];
$qhapus=mysql_query("delete from shift_karyawan where id='$id'");

if($qhapus)
{
	echo"<script>alert('Data berhasil dihapus');location.href='home.php?hal=content/shift_karyawan'</script>";
}else
{
	echo"<script>alert('Data gagal dihapus');location.href='home.php?hal=content/shift_karyawan'</script>";
}

?>