<?php
	if ($_POST['kd_guna_obat'] == "")
	{
		print "<script>alert('Kode Jenis Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/guna_obat'</script>";
	}
	else
	{
	$q = "INSERT INTO guna_obat (kd_guna_obat, nama_guna_obat) VALUES ('".$_POST['kd_guna_obat']."', '".$_POST['nama_guna_obat']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/guna_obat'>";
	}
?>