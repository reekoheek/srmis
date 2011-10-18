<?php
	$no_resep=$_POST['no_resep'];
	$param_no=$_POST['param_no'];
	$pasien_id=$_POST['pasien_id'];
	$id=$_POST['id'];
	$nama=$_POST['nama'];
	$q2=mysql_query("SELECT * FROM resep WHERE no_resep = '$no_resep'");
	$r2=mysql_fetch_array($q2);
	
	if (!$r2)
	{
		print "<script>alert('Resep Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg&no_resep=$no_resep&param_no=$param_no&pasien_id=$pasien_id&id=$id&nama=$nama'</script>";
	}
	else
	{
		$qii="INSERT INTO resep_head(no_resep, param_no, pasien_id, created_datetime, created_user,tgl,cara_masuk) VALUES('$no_resep', '$param_no', '$id_pasien', now(), 
	'".$_SESSION['U_USER']."','$tanggal_sekarang','$cara_masuk')";
$rii=mysql_query($qii);
		$q = mysql_query("UPDATE resep_head SET flags='1' WHERE no_resep='$no_resep'");
		if ($q) 
		{
			print "<script>alert('Resep Berhasil di Simpan.');location.href='home.php?hal=content/pasien'</script>";
		}
		else
		{
			print "<script>alert('Resep Gagal Disimpan!');location.href='home.php?hal=content/pasien'</script>";
		}
	}
?>