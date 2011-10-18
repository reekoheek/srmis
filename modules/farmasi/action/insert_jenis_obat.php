<?php
	if ($_POST['kd_jenis_obat'] == "")
	{
		print "<script>alert('Kode Jenis Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/jenis_obat'</script>";
	}
	else
	{
	$q = "INSERT INTO jenis_obat (kd_jenis_obat, deskripsi) VALUES ('".$_POST['kd_jenis_obat']."', '".$_POST['deskripsi']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/jenis_obat'>";
	}
?>