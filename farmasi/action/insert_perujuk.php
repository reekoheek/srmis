<?php
	if ($_POST['kd_perujuk'] == "")
	{
		print "<script>alert('Kode perujuk Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/perujuk'</script>";
	}
	else
	{
	$q = "INSERT INTO perujuk (kd_perujuk, nama, sex, alamat, spesialis, no_tlp) VALUES ('".$_POST['kd_perujuk']."', '".$_POST['nama']."'
		  , '".$_POST['sex']."', '".$_POST['alamat']."', '".$_POST['spesialis']."', '".$_POST['no_tlp']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/perujuk'>";
	}
	else
	{
		print "<script>alert('Kode perujuk Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/perujuk'</script>";
	}
	}
?>