<?php
$tgl=date("d/m/Y");
$usercreated=$_SESSION['U_USER'];
$nama_pasien=$_POST['nama_pasien'];
$rs_asal=$_POST['rs_asal'];
$no_resep=$_POST['no_resep'];
$param_no=$_POST['param_no'];
$unit_id=$_SESSION['U_UNITID'];
$jenis_ket=$_POST['jenis_keterangan'];
$no_ket=$_POST['no_ket'];
$sub_margin=$_POST['sub_margin'];
$flags=3;

$kode_obat=$_POST['kd_obatt'];
$nama_obat=$_POST['nama_obat'];
$jumlah=$_POST['jumlah'];
$dosis=$_POST['dosis_id'];
$ket=$_POST['ket'];
$no_resep=$_POST['no_resep'];


/* echo $usercreated;
echo $nama_pasien;
echo $no_resep;
echo $param_no;
echo $rs_asal;
echo $jenis_ket;
echo $no_ket;
echo "<hr> ";
echo $kode_obat;
echo $nama_obat;
echo $jumlah;
echo $dosis;
echo $ket; */


$cari=mysql_query("select * from resep_head where no_resep='".$_POST['no_resep']."'");
$num_cari=mysql_num_rows($cari);
if ($num_cari<1)
{
$sql="insert into resep_head (no_resep,param_no,fld02,created_datetime,created_user,tgl,unit_id,flags,fld03,cara_masuk,sub_margin,no_ket) values('$no_resep','$param_no','$nama_pasien',now(),'$usercreated','$tgl','$unit_id','$flags','$rs_asal','$jenis_ket','$sub_margin','$no_ket')";
mysql_query($sql);
}




if ($_POST['nama_obat'] == "")
	{
		print "<script>alert('Nama Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg_umum&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket&sub_margin=$sub_margin'</script>";
	}
	else if ($_POST['ket'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg_umum&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket&sub_margin=$sub_margin'</script>";
	}
	else if ($_POST['jumlah'] == "")
	{
		print "<script>alert('Keterangan Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/resep_reg_umum&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket&sub_margin=$sub_margin'</script>";
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
	//if ($_POST['jumlah'] > $rk['stok'])
	
	//if ($_POST['jumlah'] > $rk2['stok'])
	if ($_POST['jumlah'] > $rk['stok'])
	{
		print "<script>alert('MAAF,..!! Jumlah Obat yang diminta lebih besar dari Stok Obat.');location.href='home.php?hal=content/resep_reg_umum&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket&sub_margin=$sub_margin'</script>";
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
	$q = "INSERT INTO resep (no_resep, pasien_id, kode_obat, tgl, dosis_id, diberi,diminta, ket, racikan, ket_banyak,flags,harga,sub_total) 
		  VALUES ('".$_POST['no_resep']."','".$_POST['pasien_id']."', '".$_POST['kd_obatt']."', '$date', '".$_POST['dosis_id']."'
		  , '".$_POST['jumlah']."','".$_POST['jumlah']."', '".$_POST['ket']."', '".$_POST['racikan']."', '".$_POST['ket_banyak']."','3','$harga_sekarang','$sub_total')";
	$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	
	//echo $id_p;
	}
	
	$qpk=mysql_query("SELECT * FROM simrs.pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);

print "<script>location.href='home.php?hal=content/resep_reg_umum&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket&sub_margin=$sub_margin'</script>"; 
	}
?>

<?	
/* print "<script>location.href='home.php?hal=content/input_obat_umum&no_resep=$no_resep&nama=$nama_pasien&rs_asal=$rs_asal&jenis_ket=$jenis_ket&no_ket=$no_ket'</script>"; */

?>
