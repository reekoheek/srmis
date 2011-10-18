<?php
// get value of id that sent from address bar 
$id=$_GET['id'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM group_barang WHERE id='$id'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/group_barang'</script>";
}

else {
echo "ERROR";
}


?>