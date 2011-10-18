<?php
	include "../include/koneksi.php";
	$pasien_id=$_POST['pasien_id'];
	$param_no=$_POST['param_no'];
	$no_resep=$_POST['no_resep'];
	$no_racik=$_POST['no_racik'];
	$nama_racikan=$_POST['nama_racikan'];
	$nama_obat=$_POST['nama_obat'];
	$nama=$_POST['nama'];
	$ket=$_POST['ket'];
	$id_p=$_POST['id'];
	$fld02=$_POST['fld02'];
	$kode_obat = $_POST['kd_obatt'];
	
	if ($_POST['nama_obat'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='../content/input_racik_obat_igd.php?fld02=$fld02&no_racik=$no_racik&id=$pasien_id&ket_$ket&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama=$nama'</script>";
	}
	
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='../content/input_racik_obat_igd.php?fld02=$fld02&no_racik=$no_racik&id=$pasien_id&ket_$ket&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama=$nama'</script>";
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
	$harga_sekarang = $rk2['harga_dosp'] + 500;
	//nanti ini untuk rumus resep nya
	//if ($_POST['jumlah'] > $rk['stok'])
	
	//if ($_POST['jumlah'] > $rk2['stok'])
	if ($_POST['jumlah'] > $stok_ms)
	{
		$nama_racikan=$_POST['nama_racikan'];
		$ket=$_POST['ket'];
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');
		location.href='../content/input_racik_obat_igd.php?fld02=$fld02&no_racik=$no_racik&id=$pasien_id&ket_$ket&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama=$nama'</script>";
	}
	else
	{
	//ini baru rumus
	//$tusla=500 * $_POST['jumlah'];
	
	//$diberi = $_POST['jumlah'];
	//$sisa = $rk['stok'] - $diberi;
	$sub_total = $harga_sekarang * $_POST['jumlah'];
	$grand = $sub_total;
	//$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE barang_id = '$id_obat'  and unit_id='51'");
	
	
	$date = date("d/m/Y");
	//$diberi = $_POST['jumlah'];
	//$harga = $harga_dosp;
	//$sub_total=$diberi * $harga;
	$q = "INSERT INTO racik_detail (no_racik, no_resep, kode_obat, qty, harga, subtotal,flags,tgl) 
		  VALUES ('".$_POST['no_racik']."','".$_POST['no_resep']."', '$kode_obat', '".$_POST['jumlah']."', '$harga_sekarang', '$grand','3','$date')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	}
	
	//echo $id_p;
	
	$qpk=mysql_query("SELECT * FROM simrs.pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);
	$nama_pas=$rpk['nama'];
	//print "<script>alert('Data Telah Di Simpan dengan Jumlah Obat yang diberikan sebanyak $diberi .');location.href='home.php?hal=content/racik_obat_igd&fld02=$fld02&no_racik=$no_racik&id=$pasien_id&ket_$ket&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama=$nama'</script>";
	}
	
	echo "</script><script language=javascript>window.opener.location.reload();window.close();pop=0;</script><script runat=server>";
?>