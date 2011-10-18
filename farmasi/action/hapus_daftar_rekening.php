<?
$no_rek=$_GET['no_rek'];
$q1=mysql_query("delete from daftar_akun where no_rek='$no_rek'");
if($q1)
{
 echo"<script>alert('Rekening Akun Berhasil di Hapus');location.href='home.php?hal=content/daftar_akun'</script>";
}else{
 echo"<script>alert('Rekening Akun Gagal di Hapus');location.href='home.php?hal=content/daftar_akun'</script>";
}
?>