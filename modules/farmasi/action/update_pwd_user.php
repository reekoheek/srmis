<?php


$username=$_POST['username'];
$pass_baru=md5($_POST['pass_baru']);


$query=mysql_query("update user set pwd='$pass_baru' where nm_user='$username'");
if($query)
{
 print"<script>alert('Password telah diubah');location.href='home.php?hal=content/ubah_pwd_user'</script>";
}else
{
 print"<script>alert('Password gagal diubah');location.href='home.php?hal=content/ubah_pwd_user'</script>";
}
?>