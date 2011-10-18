<?php
// get value of id that sent from address bar 
$kd_spesialis=$_GET['kd_spesialis'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM spesialis WHERE kd_spesialis='$kd_spesialis'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/spesialis'</script>";
}

else {
echo "ERROR";
}


?>