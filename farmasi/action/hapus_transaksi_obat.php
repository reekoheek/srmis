<?php
// get value of id that sent from address bar 
$id=$_GET['id'];
$diberi = $_GET['diberi'];
$no_trans=$_GET['no_transaksi'];

// Delete data in mysql from row that has this id 

$qu=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='".$_GET['kd_barang']."'");
$ru=mysql_fetch_array($qu);
$jml=$diberi + $ru['stok'];
$qq=mysql_query("UPDATE ms_barang SET stok='$jml' WHERE kd_barang='".$_GET['kd_barang']."'");

$sql="DELETE FROM penjualan WHERE id='$id'";
$result=mysql_query($sql);

//$q=mysql_query("SELECT pasien_id FROM resep WHERE pasien_id='$pasien_id'");
//$r=mysql_fetch_array($q);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/kasir&no_transaksi=$no_trans'</script>";
}

else {
echo "ERROR";
}


?>