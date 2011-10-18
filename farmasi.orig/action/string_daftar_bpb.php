<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM permintaan_unit WHERE No_BPB LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["No_BPB"].'\');">'.$ra["No_BPB"].  ", Tertanggal : " .$ra['tgl_bpb']. '</li>';
}
?>
