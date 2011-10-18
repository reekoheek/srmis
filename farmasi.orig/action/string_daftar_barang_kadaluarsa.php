<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM ms_barang WHERE status = 'Non-Aktif' AND kd_barang LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["kd_barang"].'\');">'.$ra["kd_barang"]. " | " .$ra["nama"].'</li>';
}
?>
