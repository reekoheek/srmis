<?php
	//$datetime=date("Y-m-d h:i:s");
	if ($_POST['nama']=="")
	{
		print "<script>alert('ID User Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/unit'</script>";
	}
	else
	{
	$qj=mysql_query("SELECT * FROM tbl_menu where id=".$_POST['Unit_id']." and f_aktif='1'");
	$rj=mysql_fetch_array($qj);
	$q = "INSERT INTO pelayanan (nama, nama_lain, group_id,unit_id,jenis) 
		  VALUES ('".$_POST['nama']."', '".$_POST['nama_lain']."','".$_POST['Group_id']."', '".$_POST['Unit_id']."','".$rj['name_menu']."')";
	$r = mysql_query($q);
	}
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/unit'>";
?>