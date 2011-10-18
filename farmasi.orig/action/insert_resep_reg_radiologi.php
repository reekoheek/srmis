<?php
	$pasien_id=$_POST['pasien_id'];
	$param_no=$_POST['param_no'];
	$no_resep=$_POST['no_resep'];

	$nama_pas=$_POST['nama_pas'];
	

	//$q2=mysql_query("SELECT * FROM pasien, kunjungan, kunjungan_kamar WHERE pasien.id= '$id_p' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	//$r2=mysql_fetch_array($q2);
	
	

	if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_radiologi&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_radiologi&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_radiologi&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else
	{
	$kode_obat = $_POST['kd_obatt'];
	
	$qk2 = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kode_obat'");
	$rk2 = mysql_fetch_array($qk2);
	
	$q_stok_resep=mysql_query ("SELECT * FROM resep WHERE kode_obat = '$rk2[kd_barang]' AND flags='3'");
	$minta_stok_resep=0;
	while ($r_stok_resep=mysql_fetch_array($q_stok_resep))
	{
		$minta_stok_resep = $minta_stok_resep + $r_stok_resep['diminta'];
	}
	
	$q_stok_racik=mysql_query ("SELECT * FROM racik_detail WHERE kode_obat = '$rk2[kd_barang]' AND flags='3'");
	$minta_racik=0;
	while ($r_stok_racik=mysql_fetch_array($q_stok_racik))
	{
		$minta_racik = $minta_racik + $r_stok_racik['qty'];
	}
	
	$minta_resep = $minta_racik + $minta_stok_resep;
	
	$stok_ms = $rk2['stok'] - $minta_resep;
	//$qk = mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$rk2[id]' AND unit_id='51'");
	//$rk = mysql_fetch_array($qk);
	
	$id_obat = $rk2['barang_id'];
	//$id_obat = $rk['barang_id'];
	//echo $id_obat;
	//$harga_dosp=$rk2['harga_dosp'];
	//$harga_sekarang = $rk['fld02'];
	$harga_sekarang = $rk2['harga_dosp'];
	//nanti ini untuk rumus resep nya
	//if ($_POST['jumlah'] > $rk['stok'])
	
	//if ($_POST['jumlah'] > $rk2['stok'])
	if ($_POST['jumlah'] > $stok_ms)
	{
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/input_obat_radiologi&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else
	{
	//ini baru rumus
	//$tusla=500 * $_POST['jumlah'];	
	//$diberi = $_POST['jumlah'];
	//$sisa = $rk['stok'] - $diberi;
	//$sub_total = ($diberi * $harga_dosp) + $tusla;
	//$harga_sekarang = $rk['fld02']; 
	//$sub_total =  ($harga_sekarang * $diberi)+500;
	//$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE barang_id = '$id_obat' AND unit_id='91'");
	
	
	$date = date("d/m/Y");
	$q = "INSERT INTO resep (no_resep, pasien_id, kode_obat, tgl, dosis_id, diminta, ket, racikan, ket_banyak,flags) 
		  VALUES ('".$_POST['no_resep']."','".$_POST['pasien_id']."', '".$_POST['kd_obatt']."', '$date', '".$_POST['dosis_id']."'
		  , '".$_POST['jumlah']."', '".$_POST['ket']."', '".$_POST['racikan']."', '".$_POST['ket_banyak']."','3')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg_radiologi'>";
	
	//echo $id_p;
	}
	
	$qpk=mysql_query("SELECT * FROM simrs.pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);

print "<script>alert('Data Telah Di Simpan dengan Jumlah Obat yang diberikan sebanyak $_POST[jumlah] .');location.href='home.php?hal=content/resep_reg_radiologi&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>"; 
	}
?>