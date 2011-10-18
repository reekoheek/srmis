<?php
// get value of id that sent from address bar 
$id=$_GET['id'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM user WHERE id='$id'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=setup/user_access_level'</script>";
}

else {
echo "ERROR";
}


?>