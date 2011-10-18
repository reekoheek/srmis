<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM ms_barang,satuan WHERE ms_barang.satuan = satuan.kd_satuan AND ms_barang.status = 'Aktif' AND ms_barang.nama LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["nama"].'\',\''.$ra["deskripsi"].'\',\''.$ra["expire_date"].'\',\''.$ra["stok"].'\',\''.$ra["kd_barang"].'\',\''.$ra["id"].'\');">'.$ra["kd_barang"]. " | " .$ra["nama"]. ", Stok : " .$ra['stok'].'</li>';
}
?>
