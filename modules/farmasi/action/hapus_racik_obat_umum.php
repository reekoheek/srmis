<?php
// get value of id that sent from address bar 
$id=$_GET['id'];
$pasien_id=$_GET['pasien_id'];
$no_racik=$_GET['no_racik'];
$qty = $_GET['qty'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$fld02=$_GET['fld02'];
$nama=$_GET['nama'];
$jenis_ket=$_GET['jenis_ket'];
$no_ket=$_GET['no_ket'];

// Delete data in mysql from row that has this id 

$qu=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='".$_GET['kd_barang']."'");
$ru=mysql_fetch_array($qu);
$jml=$qty + $ru['stok'];
$qq=mysql_query("UPDATE ms_barang SET stok='$jml' WHERE kd_barang='".$_GET['kd_barang']."'");

$sql="DELETE FROM racik_detail WHERE id='$id'";
$result=mysql_query($sql);

//$q=mysql_query("SELECT pasien_id FROM resep WHERE pasien_id='$pasien_id'");
//$r=mysql_fetch_array($q);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/racik_obat_umum&jenis_ket=$jenis_ket&no_ket=$no_ket&fld02=$fld02&no_racik=$no_racik&pasien_id=$pasien_id&id=$id&no_resep=$no_resep&nama=$nama'</script>";
}

else {
echo "ERROR";
}


?>