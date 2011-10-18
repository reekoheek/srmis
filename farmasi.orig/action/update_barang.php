<?php
	$date = $_POST['expire_date'];
	$ex_date = substr($date,0,2);
	$ex_month = substr($date,3,2);
	$ex_year = substr($date,6,4);
	$stok = $_POST['stok'];
	
	if($_POST['status']=='1')
	{
		$aktif="Aktif";
	}
	elseif($_POST['status']=='9')
	{
		$aktif="Non-Aktif";
	}
	
	$q = mysql_query ("UPDATE ms_barang SET group_barang = '$_POST[group_barang]',
										 nama = '$_POST[nama]',
										 satuan = '$_POST[satuan]',
										 satuan_kirim = '$_POST[satuan_kirim]',
										 jenis_obat = '$_POST[jenis_obat]',
										 kategori_obat = '$_POST[kategori_obat]',
										 golongan = '$_POST[golongan]',
										 kode_guna = '$_POST[kode_guna]',
										 kode_persediaan = '$_POST[kode_persediaan]',
										 kode_pendapatan = '$_POST[kode_pendapatan]',
										 kode_reduksi = '$_POST[kode_reduksi]',
										 kode_biaya = '$_POST[kode_biaya]',
										 kode_ppn_k = '$_POST[kode_ppn_k]',
										 kode_ppn_m = '$_POST[kode_ppn_m]',
										 expire_date = '$_POST[expire_date]',
										 pabrik01 = '$_POST[pabrik01]',
										 pabrik02 = '$_POST[pabrik02]',
										 pabrik03 = '$_POST[pabrik03]',
										 pabrik04 = '$_POST[pabrik04]',
										 pabrik05 = '$_POST[pabrik05]',
										 ex_date = '$ex_date',
										 ex_month = '$ex_month',
										 ex_year = '$ex_year',
										 tipe_obat = '$_POST[tipe_obat]',
										 obat_tunai = '$_POST[obat_tunai]',
										 hna = '$_POST[hna]',
										 harga_dosp = '$_POST[harga_dosp]',
										 discount = '$_POST[discount]',
										 ppn = '$_POST[ppn]',
										 averange_sale = '$_POST[averange_sale]',
										 stok_max = '$_POST[stok_max]',
										 stok_min = '$_POST[stok_min]',
										 stok = '$stok',
										 isi = '$_POST[isi]',
										 kemasan = '$_POST[kemasan]',
										 status = '$aktif',
										 no_batch = '$_POST[no_batch]',
										 no_rak = '$_POST[no_rak]',
										 pabrik_obat = '$_POST[pabrik_obat]',
										 flags = '$_POST[status]',
										 status = '$aktif' WHERE kd_barang = '$_POST[kd_barang]'");
	print "<script>alert('Data Telah Di Update.');location.href='home.php?hal=content/daftar_barang'</script>";
?>