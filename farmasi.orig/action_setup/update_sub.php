<?php
$Master = $_POST['Master'];
$child1 = $_POST['Child1'];
$id = $_POST['id'];
$menus = $_POST['menus'];
if ($id == "")
{
	print "<script>alert('ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/user'</script>";
}
else
{
	if ($Master)
	{
		$q = mysql_query ("Update tbl_menu set fld02='".$Master."',fld01='1' where id=".$id.""); 
		if ($Child1)
		{
			$q = mysql_query ("Update tbl_menu set fld03='".$Child1."',fld01='1',fld02='".$Master."' where id=".$id.""); 
		}
	}
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/tbl_menu'>";
	//echo "Update tbl_menu set fld02='".$Master."' and fld01='".$menus."' where id=".$id."";
}
?>