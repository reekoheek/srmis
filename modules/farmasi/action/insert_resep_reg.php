<?php
	$pasien_id=$_POST['pasien_id'];
	$param_no=$_POST['param_no'];
	$no_resep=$_POST['no_resep'];
	$id_p=$_POST['id'];

	//$q2=mysql_query("SELECT * FROM pasien, kunjungan, kunjungan_kamar WHERE pasien.id= '$id_p' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	//$r2=mysql_fetch_array($q2);
	
	

	if ($_POST['nama_obat'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else
	{
	$kode_obat = $_POST['kd_obatt'];
	$nama_obat = $_POST['nama_obat'];
	
	$qk2 = mysql_query ("SELECT * FROM ms_barang WHERE nama = '$nama_obat'");
	$rk2 = mysql_fetch_array($qk2);
	
	$qk = mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$rk2[id]' AND unit_id='2'");
	$rk = mysql_fetch_array($qk);
	
	$id_obat = $rk['barang_id'];
	//echo $id_obat;
	//$harga_dosp=$rk2['harga_dosp'];
	//nanti ini untuk rumus resep nya
	if ($_POST['jumlah'] > $rk['stok'])
	{
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/resep_reg&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
	else
	{
	//ini baru rumus
	//$tusla=500 * $_POST['jumlah'];	
	$diberi = $_POST['jumlah'];
	$sisa = $rk['stok'] - $diberi;
	//$sub_total = ($diberi * $harga_dosp) + $tusla;
	$harga_sekarang = $rk['fld02']; 
	$sub_total =  ($harga_sekarang * $diberi)+500;
	$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE id = '$rk[id]' AND unit_id='2'");
	
	
	$date = date("d/m/Y");
	$q = "INSERT INTO resep (no_resep, pasien_id, kode_obat, tgl, dosis_id, diminta, diberi, ket, racikan, ket_banyak, harga, sub_total) 
		  VALUES ('".$_POST['no_resep']."','".$_POST['pasien_id']."', '$rk2[kd_barang]', '$date', '".$_POST['dosis_id']."'
		  , '".$_POST['jumlah']."', '$diberi', '".$_POST['ket']."', '".$_POST['racikan']."', '".$_POST['ket_banyak']."', '$harga_sekarang', '$sub_total')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	
	//echo $id_p;
	}
	
	$qpk=mysql_query("SELECT * FROM simrs.pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);
	$nama_pas=$rpk['nama'];
	print "<script>location.href='home.php?hal=content/resep_reg&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas'</script>";
	}
?>