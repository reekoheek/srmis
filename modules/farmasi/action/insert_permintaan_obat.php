<?php
	$date = date("d/m/Y");
	$no_SPP = $_POST['no_SPP'];
	$tgl=$_POST['tgl'];
	if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_permintaan_obat&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
	}
	elseif ($_POST['jumlah'] == "")
	{
		print "<script>alert('Jumlah Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_permintaan_obat&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
	} 

	else
	{
	$kd_barang = $_POST['kd_barang'];
	$id_ms = $_POST['id_ms'];
	$qk = mysql_query ("SELECT * FROM ms_barang WHERE id = '$id_ms'");
	$rk = mysql_fetch_array($qk);
	
	//nanti ini untuk rumus resep nya
		if ($_POST['jumlah'] > $rk['stok'])
		{
			print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/input_permintaan_obat&no_SPP=$no_SPP&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
		}
		else
		{
			$date = date("d/m/Y");
			$no_SPP = $_POST['no_SPP'];
	
			$q = "INSERT INTO permintaan_unitdetail (No_SPP, barang_id, Nm_Barang, Satuan, Qty, Keterangan, Tgl_pakai, Qty_sisa,Unit) 
		  		  VALUES ('$no_SPP','$id_ms', '".$_POST['nama']."', '".$_POST['satuan']."', '".$_POST['jumlah']."'
		  	 	  , '".$_POST['keterangan']."', '".$_POST['tgl_pakai']."', '$sisa','".$_SESSION['U_SUBUNIT']."')";
			$r = mysql_query($q);
			$id=$_POST['id'];
			$tgl=$_POST['tgl'];
			print "<script>alert('Data Telah Di Simpan .');location.href='home.php?hal=content/Permintaan_Obat&No_SPP=$no_SPP&Tgl_SPP=$tgl'</script>";
		}
	}
?>