<?php
	$add_stok=$_POST['add_stok'];
	$stok=$_POST['stok'];
	$jml=$add_stok + $stok;
	$id=$_POST['id'];
	$stok_max=$_POST['stok_max'];
	if ($jml > $stok_max)
	{
		print "<script>alert('Maaf stok barang yang di inputkan lebih besar daripada stok max.');location.href='home.php?hal=content/daftar_barang'</script>";
	}
	else
	{
		$q=mysql_query("UPDATE ms_barang SET stok='$jml' WHERE id = '$id'");
		print "<script>alert('Stok barang telah di tambah.');location.href='home.php?hal=content/daftar_barang'</script>";
	}
?>