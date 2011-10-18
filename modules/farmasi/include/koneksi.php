<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$db = "db_apotek";
	$koneksi = mysql_connect ($host, $user, $pass) or die (mysql_error());
	mysql_select_db ($db, $koneksi) or die (mysql_error());
?>