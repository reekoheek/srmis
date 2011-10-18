<?php
	$id = $_POST['id'];
	$qj=mysql_query("SELECT * FROM tbl_menu where id=".$_POST['Unit_id']." and f_aktif='1'");
	$rj=mysql_fetch_array($qj);
	$q = mysql_query("Update pelayanan set nama='".$_POST['nama']."',nama_lain='".$_POST['nama_lain']."',group_id = '".$_POST['Group_id']."',unit_id='".$_POST['Unit_id']."',jenis='".$rj['name_menu']."' where id=".$id.""); 
	//echo $q
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/unit'>";
?>