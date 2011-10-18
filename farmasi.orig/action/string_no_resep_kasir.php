<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT * FROM resep_head,simrs.pasien WHERE resep_head.flags='1' AND resep_head.pasien_id=pasien.id AND resep_head.status_bayar = '0' AND resep_head.no_resep LIKE '$mysearchString%' ORDER by tgl LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	echo '<li onClick="fill(\''.$ra["no_resep"].'\');">'.$ra["no_resep"]. " | " .$ra["nama"].'</li>';
}
?>