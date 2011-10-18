<?php
//session_start();
include "../include/koneksi.php";

$qa = mysql_query("SELECT * FROM barang_unit,ms_barang WHERE barang_unit.barang_id=ms_barang.id AND barang_unit.unit_id='2' AND ms_barang.status = 'Aktif' AND ms_barang.nama LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.


while ($rc = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$rc["nama"].'\',\''.$rc["3"].'\',\''.$rc["kd_barang"].'\');">'.$rc["kd_barang"]. " | " .$rc["nama"]. " , Stok :" .$rc["3"].'</li>';
}
?>
