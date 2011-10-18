<?php
session_start();
include "../include/koneksi.php";
include "../include/fungsi_rp.php";

$no_trans=$_POST['nomor_trans'];
$tgl=$_POST['tanggal'];
$dd=substr($tgl,0,2);
$mm=substr($tgl,3,2);
$yy=substr($tgl,6,4);
$tanggal=$yy."-".$mm."-".$dd;
$motor=$_POST['motor'];
$mobil=$_POST['mobil'];
$total=$_POST['total'];

$q4=mysql_query("update parkir set motor='$motor',mobil='$mobil',total='$total' where no_trans='$no_trans'");

if($q4)
{
 print "<script>window.opener.location.reload();window.close();pop=0;</script>";

}else
{
 print "<script>window.opener.location.reload();window.close();pop=0;</script>";

}
?>