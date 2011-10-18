<?php
	$no_transaksi=$_POST['no_transaksi'];
	


?>
<form method="post" action="home.php?hal=content/kasir&no_transaksi=<? $no_traksaksi; ?>">
<input type="hidden" name="no_trans" value="<? echo $no_transaksi; ?>" />
</form>
<?php
	if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_bebas&no_transaksi=$no_transaksi'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_obat_bebas&no_transaksi=$no_transaksi'</script>";
	}

	else
	{
	$kode_obat = $_POST['kode_obat'];
	$qk = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kode_obat'");

	
	$rk = mysql_fetch_array($qk);
	$iddms=$rk['id'];
	$q1k=mysql_query("select * from barang_unit where barang_id='$iddms'");
	$r1k=mysql_fetch_array($q1k);
	//nanti ini untuk rumus resep nya
	if ($_POST['jumlah'] > $r1k['stok'])
	{
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/input_obat_bebas&no_transaksi=$no_transaksi'</script>";
	}
	else
	{
	//ini baru rumus
	
	//nyari param_no
	$qp= mysql_query("SELECT * FROM penjualan WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);
	$p_no=$rp['param_no'];
	
	$diberi = $_POST['jumlah'];
	$sisa = $r1k['stok'] - $diberi;
	$sub_total = $diberi * $rk['harga_dosp'];
	$qu = mysql_query ("UPDATE barang_unit SET stok = '$sisa' WHERE barang_id = '$iddms'");
	}
	$sql_ed="select * from ms_barang where kd_barang='$kode_obat'";
	$ed=mysql_query($sql_ed);
	$row=mysql_fetch_array($ed);
	$date = date("d/m/Y");
	$sql_pjl="select * from penjualan_head where no_trans='$no_transaksi'";
	$pjl_q=mysql_query($sql_pjl);
	$row_pjl=mysql_fetch_array($pjl_q);
		$sql_ed1="select * from barang_unit where barang_id='$iddms'";
		$ed1=mysql_query($sql_ed1);
		$row1=mysql_fetch_array($ed1);
	$no_resep=$row_pjl["no_resep"];
	$q = "INSERT INTO penjualan (no_trans,no_resep,obat_id,tgl_expire,dosis_id, diminta, diberi, ket, racikan, ket_banyak, sub_total,param_no) 
		  VALUES ('$no_transaksi','$no_resep','$kode_obat','".$row1['expire_date']."','".$_POST['dosis_id']."'
		  , '".$_POST['jumlah']."', '$diberi', '".$_POST['ket']."', '".$_POST['racikan']."', '".$_POST['ket_banyak']."', '$sub_total','$p_no')";
		  
mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	
	//echo $id_p;
	
	
	print "<script>alert('Data Telah Di Simpan dengan Jumlah Obat yang diberikan sebanyak $diberi .');location.href='home.php?hal=content/kasir&no_transaksi=$no_transaksi'</script>";
	}
?>