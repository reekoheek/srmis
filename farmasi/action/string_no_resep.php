<?php
include "../include/koneksi.php";
$qa = mysql_query("SELECT DISTINCT(no_resep),pasien_id FROM resep WHERE no_resep LIKE '$mysearchString%' LIMIT 10"); // limits our results list to 10.
while ($ra = mysql_fetch_array($qa)) 
{
	$qq=mysql_query("SELECT * FROM pasien WHERE id = '$ra[pasien_id]'");
	$rq=mysql_fetch_array($qq);
	echo '<li onClick="fill(\''.$ra["no_resep"].'\');">'.$ra["no_resep"]. " | " .$rq["nama"].'</li>';
}
?>
