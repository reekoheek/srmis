<?php
	if ($_POST['type_code'] == "")
	{
		print "<script>alert('Type Code Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/user_type'</script>";
	}
	else
	{
	//$datetime=date("Y-m-d h:i:s");
	$q = "INSERT INTO user_type (type_code, name_access, description, flags, created_datetime,created_user) 
		  VALUES ('".$_POST['type_code']."', '".$_POST['name_access']."', '".$_POST['description']."', '1', now(),'".$_SESSION['U_USER']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user_type'>";
	}
?>