<?php
// get value of id that sent from address bar 
$kd_satuan=$_GET['kd_satuan'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM satuan WHERE kd_satuan='$kd_satuan'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/satuan'</script>";
}

else {
echo "ERROR";
}


?>