<?php
include "../include/koneksi.php";

$qa = mysql_query("SELECT * FROM quantity,ms_barang WHERE quantity.barang_id = ms_barang.id AND ms_barang.kd_barang LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["kd_barang"].'\');">'.$ra["kd_barang"]. " | " .$ra["nama"].'</li>';
}
?>
