<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?

$no_rek=$_POST['no_rek'];
$nama_rek=$_POST['nama_rek'];
$kategori=$_POST['kategori'];
$saldo_awal=$_POST['saldo_awal'];
$subkat=substr($no_rek,1,1);

if($_POST['no_rek']=="")
{
 echo"<script>alert('No. Rek harus diisi');location.href='home.php?hal=content/daftar_akun'</script>";
}
else if($_POST['nama_rek']=="")
{
 echo"<script>alert('Nama Rekening harus diisi');location.href='home.php?hal=content/daftar_akun'</script>";
}
else if($_POST['kategori']=="")
{
 echo"<script>alert('No. Rek harus diisi');location.href='home.php?hal=content/daftar_akun'</script>";
}
else
{
 $sql="insert into daftar_akun (no_rek,nama_rek,kategori,subkategori,saldo_awal) values ('$no_rek','$nama_rek','$kategori','$subkat','$saldo_awal')";
 $q_sql=mysql_query($sql);
 echo"<script>alert('Data rekening telah disimpan');location.href='home.php?hal=content/daftar_akun'</script>";
}
?>
</body>
</html>
