<?php
include "../include/koneksi.php";

$qa=mysql_query("select * from daftar_akun where no_rek like '$mysearchString%'  ORDER BY no_rek DESC LIMIT 10 ");
while($ra = mysql_fetch_array($qa))
{
 echo '<li onClick="fill(\''.$ra["no_rek"].'\',\''.$ra["nama_rek"].'\');">'.$ra["no_rek"]. " | " .$ra["nama_rek"]. '</li>';
}
?>