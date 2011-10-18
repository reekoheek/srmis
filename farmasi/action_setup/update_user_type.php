<?php
$id = $_POST['id'];
if ($id == "")
{
	print "<script>alert('ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/user'</script>";
}
else
{
	$q = mysql_query ("Update user_type set type_code='".$_POST['type_code']."',name_access='".$_POST['name_access']."',description='".$_POST['description']."',
	update_datetime=now(),update_user='".$_SESSION['U_USER']."' WHERE id='$id'");
}
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user_type'>";
?>