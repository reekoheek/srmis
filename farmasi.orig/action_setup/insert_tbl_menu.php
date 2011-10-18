<?php
	if ($_POST['code'] == "")
	{
		print "<script>alert('Code Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/tbl_menu'</script>";
	}
	else
	{
	$datetime=date("Y-m-d h:i:s");
	$q = "INSERT INTO tbl_menu (code, name_menu, menu,description, flags, created_datetime, Link, group_id, f_aktif) 
		  VALUES ('".$_POST['code']."','".$_POST['name_menu']."','".$_POST['Master']."', '".$_POST['description']."', '1', '$datetime', 
		  '".$_POST['Link']."','".$_POST['Grunit']."','".$_POST['fld10']."')";
	$r = mysql_query($q);
	//echo $q; 
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/tbl_menu'>";
	}
?>