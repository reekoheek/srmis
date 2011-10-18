<?php
	include "../include/koneksi.php";
	if($_POST['no_racik']){
	$param_no=$_POST['param_no'];
	$no_resep=$_POST['no_resep'];
	$no_racik=$_POST['no_racik'];
	$nama_pas=$_POST['nama_pas'];
	$nama_racikan=$_POST['nama_racikan'];
	$nama_obat=$_POST['nama_obat'];
	$rs_asal=$_POST['rs_asal'];
	$deskripsi=$_POST['deskripsi'];
	$ket=$_POST['ket'];
	$id_p=$_POST['id'];
	$biaya_racik=$_POST['biaya_racik'];
	$fld02=$_POST['fld02'];
	$kode_obat = $_POST['kd_obatt'];
	}
	if ($_POST['nama_obat'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='../content/input_racik_obat_umum.php?no_racik=$no_racik&ket=$ket&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama_pas=$nama_pas&rs_asal=$rs_asal&kd_barang=$kode_obat&biaya_racik=$biaya_racik'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='../content/input_racik_obat_umum.php?no_racik=$no_racik&ket=$ket&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama_pas=$nama_pas&rs_asal=$rs_asal&kd_barang=$kode_obat&biaya_racik=$biaya_racik'</script>";
	}
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='../content/input_racik_obat_umum.php?no_racik=$no_racik&ket=$ket&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama_pas=$nama_pas&rs_asal=$rs_asal&kd_barang=$kode_obat&biaya_racik=$biaya_racik'</script>";
	}
	else
	{
	
	$qk = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kode_obat'");
	$rk = mysql_fetch_array($qk);
	$idbarangms=$rk['id'];
	$q1k=mysql_query("select * from barang_unit where barang_id='$idbarangms'  and unit_id='2'");
	$r1k=mysql_fetch_array($q1k);
	
	$harga_sekarang = $r1k['fld02'];
	//nanti ini untuk rumus resep nya
	if ($_POST['jumlah'] > $r1k['stok'])
	{
		$nama_racikan=$_POST['nama_racikan'];
		$ket=$_POST['ket'];
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');
		location.href='../content/input_racik_obat_umum.php?no_racik=$no_racik&ket=$ket&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama_pas=$nama_pas&rs_asal=$rs_asal&kd_barang=$kode_obat&biaya_racik=$biaya_racik'</script>";
	}
	else
	{
	//ini baru rumus
	//$tusla=500 * $_POST['jumlah'];
	$diberi = $_POST['jumlah'];
	$sisa = $r1k['stok'] - $diberi;
	$sub_total = $harga_sekarang * $diberi;
	$grand = $sub_total;
	$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE barang_id = '$idbarangms'  and unit_id='2'");
	
	
	$date = date("d/m/Y");
	$diberi = $_POST['jumlah'];
	$harga = $rk['harga_dosp'];
	$sub_total=$diberi * $harga;
	$q = "INSERT INTO racik_detail (no_racik, no_resep, kode_obat, qty, harga, subtotal) 
		  VALUES ('".$_POST['no_racik']."','".$_POST['no_resep']."', '".$_POST['kd_obatt']."', '".$_POST['jumlah']."', '$harga_sekarang', '$grand')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	}
	
	//echo $id_p;
	
//print "<script>alert('Data Telah Di Simpan dengan Jumlah Obat yang diberikan sebanyak $diberi .');location.href='home.php?hal=content/racik_obat_umum&no_racik=$no_racik&ket=$ket&param_no=$param_no&no_resep=$no_resep&nama_racikan=$nama_racikan&nama_obat=$nama_obat&biaya_racik=$biaya_racik&deskripsi=$deskripsi&ket=$ket&nama_pas=$nama_pas&rs_asal=$rs_asal'</script>";
	}
	
	echo "</script><script language=javascript>window.opener.location.reload();window.close();pop=0;</script><script runat=server>";
?>