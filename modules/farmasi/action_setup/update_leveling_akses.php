<?php
$id = $_POST['id'];
if ($id == "")
{
	print "<script>alert('ID Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/leveling_akses'</script>";
}
else
{
	$q = mysql_query ("Update akses_leveling set akses_lvl='".$_POST['akses_lvl']."'
		,akses_va='".$_POST['akses_va']."',akses_vae='".$_POST['akses_vae']."',akses_vaed='".$_POST['akses_vaed']."',akses_ve='".$_POST['akses_ve']."'
		,update_datetime=now(), update_user='".$_SESSION['U_USER']."'  where id=".$id.""); 
}
	//echo $q;
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/leveling_akses'>";
?>