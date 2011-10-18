<?php
	if ($_POST['deskripsi'] == "")
	{
		print "<script>alert('Deskripsi Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/dosis'</script>";
	}
	else
	{
	$q = "INSERT INTO dosis (deskripsi, obat_per_hari) VALUES ('".$_POST['deskripsi']."', '".$_POST['obat_per_hari']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/dosis'>";
	}
?>