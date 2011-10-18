<?php
	
	session_start();
	include "include/koneksi.php";
	$qq = mysql_query ("update user set f_login='0' WHERE id = '".$_SESSION['U_ID']."'");
	$rr = mysql_query($qq);
	session_destroy();
	
	header("location:../index.html");
?>