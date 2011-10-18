<?php
	if ($_POST['kd_klasifikasi_inventory'] == "")
	{
		print "<script>alert('Kode klasifikasi_inventory Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/klasifikasi_inventory'</script>";
	}
	else
	{
	$q = "INSERT INTO klasifikasi_inventory (kd_klasifikasi_inventory, deskripsi) VALUES ('".$_POST['kd_klasifikasi_inventory']."', '".$_POST['deskripsi']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/klasifikasi_inventory'>";
	}
	else
	{
		print "<script>alert('Kode klasifikasi_inventory Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/klasifikasi_inventory'</script>";
	}
	}
?>