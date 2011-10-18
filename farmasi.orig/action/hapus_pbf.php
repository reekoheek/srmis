<?php
// get value of id that sent from address bar 
$kd_rekaan=$_GET['kd_rekaan'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM pbf WHERE kd_rekaan='$kd_rekaan'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/pbf'</script>";
}

else {
echo "ERROR";
}


?>