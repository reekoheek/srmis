<?php
	//$datetime=date("Y-m-d h:i:s");
	$q = "INSERT INTO leveling_akses (akses_lvl, akses_va, akses_vae, akses_vaed, akses_ve, flags, created_datetime, created_user) 
		  VALUES ('".$_POST['akses_lvl']."', '".$_POST['akses_va']."', '".$_POST['akses_vae']."', '".$_POST['akses_vaed']."',
		   '".$_POST['akses_ve']."', '1', now(), '".$_SESSION['U_USER']."')";
	$r = mysql_query($q);
	//echo $q;
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/leveling_akses'>";
?>