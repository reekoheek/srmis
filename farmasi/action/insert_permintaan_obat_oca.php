<?php
	$date = date("d/m/Y");
	$no_SPP = $_POST['no_SPP'];
	$tgl=$_POST['tgl'];
	if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_permintaan_obat_oca&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
	}
	elseif ($_POST['jumlah'] == "")
	{
		print "<script>alert('Jumlah Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_permintaan_obat_oca&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
	} 

	else
	{
	$kd_barang = $_POST['kd_barang'];
	$qk = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kd_barang'");
	$rk = mysql_fetch_array($qk);
	/* $q2=mysql_query("select * from barang_unit where barang_id='$rk[id]'");
	$r2=mysql_fetch_array($q2); */
	//nanti ini untuk rumus resep nya
		if ($_POST['jumlah'] > $rk['stok'])
		{
			print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/input_permintaan_obat_oca&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
		}
		else
		{
			$date = date("d/m/Y");
			$no_SPP = $_POST['no_SPP'];
	
			$q = "INSERT INTO permintaan_unitdetail (No_SPP, barang_id, Nm_Barang, Satuan, Qty, Keterangan, Tgl_pakai, Qty_sisa,Unit) 
		  		  VALUES ('$no_SPP','".$_POST['kd_barang']."', '".$_POST['nama']."', '".$_POST['satuan']."', '".$_POST['jumlah']."'
		  	 	  , '".$_POST['keterangan']."', '".$_POST['tgl_pakai']."', '$sisa','".$_SESSION['U_SUBUNIT']."')";
			$r = mysql_query($q);
			$id=$_POST['id'];
	//$no_SPP=$_POST['no_SPP'];
			$tgl=$_POST['tgl'];
	/*$q2 = mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
	$r2 = mysql_fetch_array($q2);
	if (!r2)
	{
		$qq="INSERT INTO permintaan_unit (No_SPP,tgl_SPP) VALUES ('$no_SPP','$date')";
		echo "hai insert";
	}
	else
	{
		echo "NOT insert";
	}*/
	
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
			print "<script>alert('Data Telah Di Simpan .');location.href='home.php?hal=content/Permintaan_Obat_oca&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
		}
	}
?>