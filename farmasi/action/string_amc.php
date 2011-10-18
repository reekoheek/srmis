<?php
include "../include/koneksi.php";

$qa = mysql_query("SELECT DISTINCT(barang_id),nama FROM amc2,ms_barang WHERE amc2.barang_id = ms_barang.kd_barang AND amc2.barang_id LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["barang_id"].'\');">'.$ra["barang_id"]. " | " .$ra["nama"].'</li>';
}
?>
