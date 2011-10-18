<?
session_start();

include("../include/koneksi.php");
include("../include/fungsi_rp.php");
$no_trans=$_POST['no_trans'];
$no_resep=$_POST['no_resep'];
$param_no=$_POST['param_no'];

$q1=mysql_query("select * from resep_head where no_resep='$no_resep'");
$r1=mysql_num_rows($q1);

if($r1>0)
{
 /* print"<script>location:PopupCenter('content/lihat_pencarian_resep.php?no_resep=$no_resep&no_trans=$no_trans&param_no=$param_no&pop=0','Pencarian Resep',670,400);</script>"; */
 
 print"<script>location.href='../content/lihat_pencarian_resep2.php?no_trans=$no_trans&param_no=$param_no&no_resep=$no_resep'</script>";
 }else
 {
print"<script>alert('Resep Tidak Ditemukan');location.href='../content/kasir_tes2.php?no_trans=$no_trans&param_no=$param_no'</script>";
}

?>
