<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM perujuk,spesialis WHERE perujuk.spesialis = spesialis.kd_spesialis AND nama LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["nama"].'\');">'.$ra["nama"]. " (" .$ra["deskripsi"].")".'</li>';
}
?>
