<?php
// get value of id that sent from address bar 
$id=$_GET['id'];
$nama_pasien=$_GET['nama'];
$diberi = $_GET['diberi'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$jenis_ket=$_GET['jenis_ket'];
$no_ket=$_GET['no_ket'];

// Delete data in mysql from row that has this id 

$qu=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='".$_GET['kd_barang']."'");
$ru=mysql_fetch_array($qu);
$barang_id=$ru['id'];
$qbu=mysql_query("select * from barang_unit where barang_id='$barang_id'");
$rbu=mysql_fetch_array($qbu);
$jml=$diberi + $rbu['stok'];
$qq=mysql_query("UPDATE barang_unit SET stok='$jml' WHERE barang_id='".$_GET['kd_barang']."'");

$sql="DELETE FROM resep WHERE id='$id'";
$result=mysql_query($sql);

//$q=mysql_query("SELECT pasien_id FROM resep WHERE pasien_id='$pasien_id'");
//$r=mysql_fetch_array($q);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/resep_reg_umum&nama=$nama_pasien&no_ket=$no_ket&jenis_ket=$jenis_ket&no_resep=$no_resep&param_no=$param_no'</script>";
}

else {
echo "ERROR";
}


?>