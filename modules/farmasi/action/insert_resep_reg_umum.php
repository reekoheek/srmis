<?php
	
	$param_no=$_POST['param_no'];
	$no_resep=$_POST['no_resep'];
	$rs_asal=$_POST['rs_asal'];
	$nama_pas=$_POST['nama_pas'];
	$jenis_ket=$_POST['jenis_ket'];
	$no_ket=$_POST['no_ket'];	

	//$q2=mysql_query("SELECT * FROM pasien, kunjungan, kunjungan_kamar WHERE pasien.id= '$id_p' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	//$r2=mysql_fetch_array($q2);
	
	

	if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_igd&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas&no_ket=$no_ket&jenis_ket=$jenis_ket'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_igd&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas&no_ket=$no_ket&jenis_ket=$jenis_ket'</script>";
	}
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_igd&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas&no_ket=$no_ket&jenis_ket=$jenis_ket'</script>";
	}

	else
	{
	$kode_obat = $_POST['kd_obatt'];
	
	$qk2 = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kode_obat'");
	$rk2 = mysql_fetch_array($qk2);

	$qk = mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$rk2[id]' AND unit_id='2'");
	$rk = mysql_fetch_array($qk);
	
	$id_obat = $rk['barang_id'];
	//echo $id_obat;
	//$harga_dosp=$rk2['harga_dosp'];
	$harga_sekarang = $rk['fld02'];
	//nanti ini untuk rumus resep nya
	if ($_POST['jumlah'] > $rk['stok'])
	{
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/input_obat_umum&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas&no_ket=$no_ket&jenis_ket=$jenis_ket'</script>";
	}
	else
	{
	//ini baru rumus
	//$tusla=500 * $_POST['jumlah'];		
	$diberi = $_POST['jumlah'];
	$sisa = $rk['stok'] - $diberi;
	$sub_total = ($harga_sekarang * $diberi)+500;
	$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE barang_id = '$id_obat' AND unit_id='2'");
	
	
	$date = date("d/m/Y");
	$q = "INSERT INTO resep (no_resep, pasien_id, kode_obat, tgl, dosis_id, diminta, diberi, ket, racikan, ket_banyak, harga, sub_total) 
		  VALUES ('".$_POST['no_resep']."','".$_POST['pasien_id']."', '".$_POST['kd_obatt']."', '$date', '".$_POST['dosis_id']."'
		  , '".$_POST['jumlah']."', '$diberi', '".$_POST['ket']."', '".$_POST['racikan']."', '".$_POST['ket_banyak']."', '$harga_sekarang', '$sub_total')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	
	//echo $id_p;
	}
	
	$qpk=mysql_query("SELECT * FROM simrs.pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);

print "<script>alert('Data Telah Di Simpan dengan Jumlah Obat yang diberikan sebanyak $_POST[jumlah] .');location.href='home.php?hal=content/resep_reg_umum&param_no=$param_no&no_resep=$no_resep&nama=$nama_pas&rs_asal=$rs_asal&no_ket=$no_ket&jenis_ket=$jenis_ket'</script>"; 
	}
?>