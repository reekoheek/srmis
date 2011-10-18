<?php
// get value of id that sent from address bar 
$kd_pabrik=$_GET['kd_pabrik'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM pabrik WHERE kd_pabrik='$kd_pabrik'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/pabrik'</script>";
}

else {
echo "ERROR";
}


?>