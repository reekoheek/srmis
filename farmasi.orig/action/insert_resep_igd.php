<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<?
$no_resep=$_GET['no_resep'];
$no_rm=$_POST['no_rm'];
$param_no=$_GET['param_no'];
$q1=mysql_query("select * from simrs.pasien where id='$no_rm'");
$r1=mysql_fetch_array($q1);

if (!$r1)
{
	echo"<script>alert('Tidak Ada Pasien dengan No. RM $no_rm')</script>";
	print "<script>location:PopupCenter('content/no_rm.php?no_resep=$no_resep&param_no=$param_no', 'myPop1',800,400);</script>";
	echo"<script>location.href='home.php?hal=content/resep_reg_igd&pasien_id=$no_rm&nama=$r1[nama]&no_resep=$no_resep&param_no=$param_no'</script>";
}
else
{
	echo"<script>alert('Pasien dengan No. RM $no_rm adalah $r1[nama] , silahkan masukan daftar obat');location.href='home.php?hal=content/resep_reg_igd&pasien_id=$no_rm&nama=$r1[nama]&no_resep=$no_resep&param_no=$param_no'</script>";
}
?>
</body>
</html>
