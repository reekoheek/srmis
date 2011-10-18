<?php
	if ($_POST['kd_pabrik'] == "")
	{
		print "<script>alert('Kode pabrik Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/pabrik'</script>";
	}
	else
	{
	$q = "INSERT INTO pabrik (kd_pabrik, nama) VALUES ('".$_POST['kd_pabrik']."', '".$_POST['nama']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/pabrik'>";
	}
	else
	{
		print "<script>alert('Kode pabrik Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/pabrik'</script>";
	}
	}
?>