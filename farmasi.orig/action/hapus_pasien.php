<?php
// get value of id that sent from address bar 
$no_rm=$_GET['no_rm'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM pasien WHERE no_rm='$no_rm'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/pasien'</script>";
}

else {
echo "ERROR";
}


?>