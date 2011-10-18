<?php
$tanggal=$_POST['tanggal'];
$dd=substr($tanggal,0,2);
$mm=substr($tanggal,3,2);
$yy=substr($tanggal,6,4);
$tgl=$yy."-".$mm."-".$dd;
$no_rek=$_POST['no_rek'];
$nama_rek=$_POST['nama_rek'];
$keterangan=$_POST['keterangan'];
$debit=$_POST['debit'];
$kredit=$_POST['kredit'];
if($_POST['debit']=='')
{
 $flags=1;
}
else if($_POST['kredit']=="")
{
 $flags=2;
}

if($_POST['tanggal']=="")
{
 echo"<script>alert('Tanggal harus diisi');location.href='home.php?hal=content/input_jurnal_penyesuaian'</script>";
}
else if($_POST['no_rek']=="")
{
 echo"<script>alert('No. Rek harus diisi');location.href='home.php?hal=content/input_jurnal_penyesuaian'</script>";
}
else if($_POST['nama_rek']=="")
{
 echo"<script>alert('Nama Rekening harus diisi');location.href='home.php?hal=content/input_jurnal_penyesuaian'</script>";
}
else if($_POST['keterangan']=="")
{
 echo"<script>alert('Keterangan harus diisi');location.href='home.php?hal=content/input_jurnal_penyesuaian'</script>";
}
else
{
 $sql="insert into jurnal_penyesuaian (tgl,no_rek,nama_rek,keterangan,debit,kredit,flags) values ('$tgl','$no_rek','$nama_rek','$keterangan','$debit','$kredit','$flags')";
 $q_s=mysql_query($sql);
 echo"<script>alert('Data Transaksi Jurnal Umum telah diisi');location.href='home.php?hal=content/input_jurnal_penyesuaian'</script>";
}
?>