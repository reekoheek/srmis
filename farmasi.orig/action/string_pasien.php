<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM simrs.pasien WHERE id LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["id"].'\',\''.$ra["nama"].'\');">'.$ra["id"]. " | " .$ra["nama"].'</li>';
}
?>