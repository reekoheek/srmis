<?php
	if ($_POST['kd_group_barang'] == "")
	{
		print "<script>alert('Kode Jenis Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/group_barang'</script>";
	}
	else
	{
	$q = "INSERT INTO group_barang (kd_group_barang, deskripsi) VALUES ('".$_POST['kd_group_barang']."', '".$_POST['deskripsi']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/group_barang'>";
	}
?>