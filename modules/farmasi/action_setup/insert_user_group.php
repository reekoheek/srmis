<?php
	$datetime=date("Y-m-d h:i:s");
	$q = "INSERT INTO user_group (group_code, name_group, description, flags, created_datetime, type_id, lv_id) 
		  VALUES ('".$_POST['group_code']."', '".$_POST['name_group']."', '".$_POST['description']."', '1', '$datetime', '".$_POST['type_id']."', '".$_POST['lv_id']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user_group'>";
?>