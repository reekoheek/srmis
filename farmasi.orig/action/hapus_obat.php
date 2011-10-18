<?php
// get value of id that sent from address bar 
$kode_obat=$_GET['kode_obat'];

// Delete data in mysql from row that has this id 
$sql="DELETE FROM obat WHERE kode_obat='$kode_obat'";
$result=mysql_query($sql);

// if successfully deleted
if($result){
print "<script>alert('Data Berhasil di Hapus.');location.href='home.php?hal=content/obat'</script>";
}

else {
echo "ERROR";
}


?>