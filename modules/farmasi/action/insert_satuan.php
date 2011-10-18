<?php
	if ($_POST['kd_satuan'] == "")
	{
		print "<script>alert('Kode satuan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/satuan'</script>";
	}
	else
	{
	$q = "INSERT INTO satuan (kd_satuan, deskripsi) VALUES ('".$_POST['kd_satuan']."', '".$_POST['deskripsi']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/satuan'>";
	}
	else
	{
		print "<script>alert('Kode satuan Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/satuan'</script>";
	}
	}
?>