<?php
// get value of id that sent from address bar 
$id=$_GET['id'];
$pasien_id=$_GET['pasien_id'];
$no_racik=$_GET['no_racik'];
$qty = $_GET['qty'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$fld02=$_GET['fld02'];
$namapas=$_GET['namapas'];
$cara_bayar=$_GET['cara_bayar'];

// Delete data in mysql from row that has this id 

$qu=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='".$_GET['kd_barang']."'");
$ru=mysql_fetch_array($qu);
$q22=mysql_query("select * from barang_unit where barang_id='$ru[id]' AND unit_id='2'");
$r22=mysql_fetch_array($q22);
$jml=$qty + $r22['stok'];
$qq=mysql_query("UPDATE barang_unit SET stok='$jml' WHERE barang_id='$r22[barang_id]' and unit_id='2'");
$sql="DELETE FROM racik_detail WHERE id='$id'";
$result=mysql_query($sql);

//$q=mysql_query("SELECT pasien_id FROM resep WHERE pasien_id='$pasien_id'");
//$r=mysql_fetch_array($q);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/racik_obat&fld02=$fld02&no_racik=$no_racik&pasien_id=$pasien_id&id=$id&no_resep=$no_resep&namapas=$namapas&cara_bayar=$cara_bayar'</script>";
}

else {
echo "ERROR";
}


?>