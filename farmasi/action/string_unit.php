<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM pelayanan WHERE nama LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["nama"].'\');">'.$ra["nama"]. " | " .$ra["jenis"].'</li>';
}
?>
