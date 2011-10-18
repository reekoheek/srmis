<?php
	if ($_POST['id_user'] == "")
	{
		print "<script>alert('ID User Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/user_access_level'</script>";
	}
	else
	{
	//$datetime=date("Y-m-d h:i:s");
	$pwd=md5($_POST['pwd']);
	
	$qq=mysql_query("SELECT * FROM user_type WHERE id='".$_POST['type_id']."'");
	$rq=mysql_fetch_array($qq);
	
		$q = "INSERT INTO user (type_id, ket, status_aktifasi, created_datetime, created_user, id_user, nm_user, pwd,fullname, jns_kel, group_id, param_no) 
			  VALUES ('".$_POST['type_id']."','".$rq['name_access']."','".$_POST['flags']."', now(), '".$_SESSION['U_USER']."', '".$_POST['id_user']."', '".$_POST['nm_user']."', '$pwd','".$_POST['fullname']."','".$_POST['jns_kel']."','".$_POST['Group_id']."','".$_POST['param_no']."')";
		$r = mysql_query($q);
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user_access_level'>";
	}
?>