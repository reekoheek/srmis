<?php
	//$datetime=date("Y-m-d h:i:s");
	//--------Buat Counter Group_id--------//
	$qp= mysql_query("SELECT * FROM group_unit WHERE LAST_INSERT_ID(group_id) ORDER BY group_id DESC LIMIT 1");
	$rp = mysql_fetch_array($qp);
	
	if ($rp)
	{
		$temp = $rp['group_id'];
		$count = $temp + 1;
	}
	else
	{
		$temp = 1;
		$count = $temp;
	}
		
	$digit1 = (int) ($count % 10);
			
	$id_group = "$digit1";
	$group_id = $count;

	$q = "INSERT INTO group_unit (group_id,name_group, created_datetime, created_user, f_status,f_aktifasi) 
		  VALUES ('".$group_id."','".$_POST['nama']."', now(),'".$_SESSION['U_USER']."','-','".$_POST['flags']."')";
	$r = mysql_query($q);

	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/group_unit'>";
?>