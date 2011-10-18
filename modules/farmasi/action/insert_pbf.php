<?php
	if ($_POST['kd_rekaan'] == "")
	{
		print "<script>alert('Kode Rekanan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/pbf'</script>";
	}
	else
	{
	$q = "INSERT INTO pbf (kd_rekanan, nama, alamat, kota, telepon, fax, kontak, no_rek) VALUES ('".$_POST['kd_rekanan']."', '".$_POST['nama']."', '".$_POST['alamat']."'
		  , '".$_POST['kota']."', '".$_POST['telepon']."', '".$_POST['fax']."', '".$_POST['kontak']."', '".$_POST['no_rek']."')";
	$r = mysql_query($q);
	if ($r)
	{
		echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/pbf'>";
	}
	else
	{
		print "<script>alert('Kode Rekanan Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/pbf'</script>";
	}
	}
?>