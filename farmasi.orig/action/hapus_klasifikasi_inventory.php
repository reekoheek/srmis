<?php
// get value of id that sent from address bar 
$kd_klasifikasi_inventory=$_GET['kd_klasifikasi_inventory'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM klasifikasi_inventory WHERE kd_klasifikasi_inventory='$kd_klasifikasi_inventory'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/klasifikasi_inventory'</script>";
}

else {
echo "ERROR";
}


?>