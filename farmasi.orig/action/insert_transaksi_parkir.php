<?php
$no_trans=$_POST['nomor_trans'];
$tgl=$_POST['tanggal'];
$dd=substr($tgl,0,2);
$mm=substr($tgl,3,2);
$yy=substr($tgl,6,4);
$tanggal=$yy."-".$mm."-".$dd;
$motor=$_POST['motor'];
$mobil=$_POST['mobil'];
$total=$_POST['total'];
$param_no=$_POST['param_no'];

/* echo $no_trans." ".$tgl." ".$tanggal." ".$motor." ".$mobil." ".$total." ".$param_no; */

if($_POST['nomor_trans']=="")
{
  print"<script>alert('Nomor Transaksi harus diisi');location.href='home.php?hal=content/transaksi_parkir'</script>";
}else
if($_POST['motor']=="")
{
  print"<script>alert('Jumlah harus diisi');location.href='home.php?hal=content/transaksi_parkir'</script>";
}else
if($_POST['mobil']=="")
{
  print"<script>alert('Jumlah mobil harus diisi');location.href='home.php?hal=content/transaksi_parkir'</script>";
}else
{

 		$qq=mysql_query("insert into parkir 	(no_trans,tgl,param_no,created_user,created_datetime,motor,mobil,total) values 	('$no_trans','$tanggal','$param_no','".$_SESSION['U_USER']."',now(),'$motor','$mobil','$total')");
		if($qq)
		{
 		print"<script>alert('Data Transaksi Tersimpan');location.href='home.php?hal=content/transaksi_parkir'</script>";
		}else
		{
		 print"<script>alert('Data Transaksi Gagal Tersimpan');location.href='home.php?hal=content/transaksi_parkir'</script>";
		}
}
?>