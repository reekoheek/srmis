<?php
// get value of id that sent from address bar 
$kd_barang=$_GET['kd_barang'];
$id=$_GET['id'];
$q=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id='$id'");
$r=mysql_fetch_array($q);

$qty=$r['Qty'];

$q2=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='$kd_barang'");
$r2=mysql_fetch_array($q2);

$sql="UPDATE permintaan_unitdetail SET flags='0' WHERE id='$id'";
$result=mysql_query($sql);


if($result){
$no_SPP=$_GET['No_SPP'];
$tgl=$_GET['Tgl_SPP'];
print "<script>alert('Data Berhasil di Cancel.');location.href='home.php?hal=content/Permintaan_Obat_igd&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
}

else {
echo "ERROR";
}


?>