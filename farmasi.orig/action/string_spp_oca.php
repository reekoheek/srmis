<?php
session_start();
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP LIKE '$mysearchString%' AND Unit='".$_SESSION['U_SUBUNIT']."' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["No_SPP"].'\');">'.$ra["No_SPP"]. " | Tertanggal : " .$ra["Tgl_SPP"].'</li>';
}
?>
