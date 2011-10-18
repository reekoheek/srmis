<?php
$no_rek=$_POST['no_rek'];
$nama_rek=$_POST['nama_rek'];
$kategori=$_POST['kategori'];
$saldo_awal=$_POST['saldo_awal'];

$q1=mysql_query("update daftar_akun set nama_rek='$nama_rek',kategori='$kategori',saldo_awal='$saldo_awal' where no_rek='$no_rek'");
if($q1)
{
 echo"<script>alert('Rekening Akun Berhasil di Update');location.href='home.php?hal=content/daftar_akun'</script>";
}else{
 echo"<script>alert('Rekening Akun Gagal di Update');location.href='home.php?hal=content/daftar_akun'</script>";
}
?>