<?php
$id = $_POST['id'];
if ($id == "")
{
	print "<script>alert('ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/user_access_level'</script>";
}
else
{
$qq=mysql_query("SELECT * FROM user_type WHERE id='".$_POST['type_id']."'");
$rq=mysql_fetch_array($qq);
	
$q = mysql_query ("Update user set group_id='".$_POST['Group_id']."', nm_user='".$_POST['nm_user']."',type_id='".$_POST['type_id']."',ket ='".$rq['name_access']."',status_aktifasi='".$_POST['flags']."',update_datetime=now(), update_user='".$_SESSION['U_USER']."',jns_kel='".$_POST['jns_kel']."',fullname='".$_POST['fullname']."' where id=".$id."");  
}
//echo $q;
echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/user_access_level'>";
?>