<?php
	if ($_POST['Grunit'] or $_POST['Master'])
	{
	$q = mysql_query("update tbl_menu set code='".$_POST['code']."', 
									  name_menu='".$_POST['name_menu']."', 
									  Menu='".$_POST['Master']."',
									  group_id='".$_POST['Grunit']."',
									  description='".$_POST['description']."', 
									  update_datetime= now(), 
									  Link='".$_POST['Link']."', 
									  f_aktif='".$_POST['fld10']."' where id='".$_POST['id']."'");
	}
	else
	{
		print "<script>alert('Master Menu dan Group Unit Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=setup/tbl_menu'</script>";
	}
	print "<meta http-equiv='refresh' content='0;url=home.php?hal=setup/tbl_menu'>";
?>