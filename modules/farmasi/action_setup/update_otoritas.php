<?php
$id = $_POST['id'];
if ($id == "")
{
	print "<script>alert('ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/Otoritas_Menu'</script>";
}
else
{
	$q = mysql_query ("Update user set group_id='".$_POST['Group_id']."',unit_id='".$_POST['unit_id']."',sub_unit ='".$_POST['Sub_Unit']."' where id=".$id."");  
}
echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/Otoritas_Menu'>";
?>