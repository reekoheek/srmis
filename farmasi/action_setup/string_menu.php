<?php
include "../include/koneksi.php";

$qa = mysql_query("SELECT * FROM tbl_menu WHERE name_menu LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["name_menu"].'\');">'.$ra["code"]. " | " .$ra["name_menu"].'</li>';
}
?>
