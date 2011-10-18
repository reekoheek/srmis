<?php
	$id = $_POST['id'];
	$q = mysql_query ("Update group_unit set name_group='".$_POST['nama']."',f_aktifasi='".$_POST['flags']."',
		 update_datetime=now(),update_user='".$_SESSION['U_USER']."' where id=".$id.""); 

	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/group_unit'>";
?>