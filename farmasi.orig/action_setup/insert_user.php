<?php
	if ($_POST['type_id'] == "")
	{
		print "<script>alert('Type ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/user'</script>";
	}
	else
	{
	$datetime=date("Y-m-d h:i:s");
	$q = "INSERT INTO user (type_id, group_id, flags, created_datetime) 
		  VALUES ('".$_POST['type_id']."', '".$_POST['group_id']."', '1', '$datetime')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user'>";
	}
?>