<?php
$ket=$_GET['ket'];
$id=$_GET['id'];
//echo $ket;
$query=mysql_query("UPDATE permintaan_unitdetail SET f2='$ket', status_detail='6' WHERE id='$id'");
echo "<script>window.close()</script>";
?>
