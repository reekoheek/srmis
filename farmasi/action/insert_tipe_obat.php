<?php
	if ($_POST['kd_tipe_obat'] == "")
	{
		print "<script>alert('Kode Tipe Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/tipe_obat'</script>";
	}
	else
	{
	$q = "INSERT INTO tipe_obat (kd_tipe_obat, nama_tipe_obat) VALUES ('".$_POST['kd_tipe_obat']."', '".$_POST['nama_tipe_obat']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/tipe_obat'>";
	}
	else
	{
		print "<script>alert('Kode Tipe Obat Sudah Ada. Harap di Ganti');location.href='home.php?hal=content/tipe_obat'</script>";
	}
	}
?>