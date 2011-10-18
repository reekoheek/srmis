<?php
	/*if (($_POST['nama_racikan']=="") OR ($_POST['ket']==""))
	{
		$no_resep=$_POST['no_resep'];
		print "<script>alert('Nama Racikan dan Keterangan Harus Di Isi.');location.href='home.php?hal=content/racik_obat&no_resep=$no_resep'</script>";
	}*/
	
	if($_POST['no_racik'])
	{
	$no_racik = $_POST['no_racik'];
	$id = $_POST['id'];
	$param_no = $_POST['param_no'];
	$no_resep = $_POST['no_resep'];
	$kd_barang = $_POST['kd_barang'];
	$nama_racikan=$_POST['nama_racikan'];
	$nama_pas = $_POST['nama_pas'];
	$rs_asal=$_POST['rs_asal'];
	$biaya_racik=$_POST['biaya_racik'];
	$deskripsi=$_POST['deskripsi'];
	$ket=$_POST['ket'];
	$jenis_ket=$_POST['jenis_ket'];
	$no_ket=$_POST['no_ket'];
	}
	else if($_GET['no_racik'])
	{
	$no_racik = $_GET['no_racik'];
	$id = $_GET['id'];
	$param_no = $_GET['param_no'];
	$no_resep = $_GET['no_resep'];
	$kd_barang = $_GET['kd_barang'];
	$nama_racikan=$_GET['nama_racikan'];
	$biaya_racik=$_GET['biaya_racik'];
	$nama_pas = $_GET['nama_pas'];
	$rs_asal=$_GET['rs_asal'];
	$deskripsi=$_GET['deskripsi'];
	$ket=$_GET['ket'];
	$jenis_ket=$_GET['jenis_ket'];
	$no_ket=$_GET['no_ket'];
	} 
	
	$qb = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kd_barang'");
	$rb = mysql_fetch_array($qb);
	$qq2=mysql_query("SELECT * FROM racik_head WHERE no_racik='$no_racik'");
	$rq2=mysql_fetch_array($qq2);
	$cek=mysql_num_rows($qq2);
	
/*	if($cek<1){
		$simrac="insert into racik_head (no_racik,param_no,no_resep,nama,dosis_id,ket,deskripsi,biaya_racik,created_datetime,created_user) values('$no_racik','$param_no','$no_resep','$nama_racikan','".$_POST['dosis_id']."','".$_POST['ket']."','".$_POST['deskripsi']."','".$_POST['biaya_racik']."',now(),'".$_SESSION['U_USER']."')";
		mysql_query($simrac);
	}
	else */
	if (!$rq2['nama'])
	{
		$query3=mysql_query("UPDATE racik_head SET no_resep='".$_POST['no_resep']."',nama='".$_POST['nama_racikan']."', dosis_id='".$_POST['dosis_id']."', ket='".$_POST['ket']."'
				, deskripsi='".$_POST['deskripsi']."', biaya_racik='".$_POST['biaya_racik']."' WHERE no_racik='$no_racik'");
	}
	
	print "<script>location:PopupCenter('content/input_racik_obat_umum.php?jenis_ket=$jenis_ket&no_ket=$no_ket&nama_pas=$nama_pas&rs_asal=$rs_asal&no_racik=$no_racik&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&fld02=$fld02&nama=$nama&pop=0', 'myPop1',800,400);</script>";

	print "<script>location='home.php?hal=content/racik_obat_umum&jenis_ket=$jenis_ket&no_ket=$no_ket&nama_pas=$nama_pas&rs_asal=$rs_asal&no_racik=$no_racik&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&fld02=$fld02&nama=$nama&pop=$pop'</script>";
?>