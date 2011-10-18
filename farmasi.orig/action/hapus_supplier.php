<?php
// get value of id that sent from address bar 
$kode_supplier=$_GET['kode_supplier'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM supplier WHERE kode_supplier='$kode_supplier'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/supplier'</script>";
}

else {
echo "ERROR";
}


?>