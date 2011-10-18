<?php
	if ($_POST['kd_spesialis'] == "")
	{
		print "<script>alert('Kode Spesialis Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/spesialis'</script>";
	}
	else
	{
	$q = "INSERT INTO spesialis (kd_spesialis, deskripsi) VALUES ('".$_POST['kd_spesialis']."', '".$_POST['deskripsi']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/spesialis'>";
	}
	else
	{
		print "<script>alert('Kode Spesialis Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/spesialis'</script>";
	}
	}
?>