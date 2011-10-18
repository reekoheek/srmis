<?php
	if($_POST['status']=='1')
	{
		$aktif="Aktif";
	}
	elseif($_POST['status']=='9')
	{
		$aktif="Non-Aktif";
	}
	
	if ($_POST['group_barang'] == "")
	{
		print "<script>alert('Group ms_barang Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_daftar_barang'</script>";
	}
	else if ($_POST['kd_barang'] == "")
	{
		print "<script>alert('Kode ms_barang Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_daftar_barang'</script>";
	}
	else if ($_POST['nama'] == "")
	{
		print "<script>alert('Nama ms_barang Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_daftar_barang'</script>";
	}
	else if ($_POST['kategori_obat'] == "")
	{
		print "<script>alert('Kategori Obat Harus Di Isi Terlebih Dahulu.');location.href='home.php?hal=content/input_daftar_barang'</script>";
	}
	
	
	else
	{
		$qyu=mysql_query("SELECT * FROM ms_barang WHERE kd_barang='".$_POST['kd_barang']."'");
		$ryu=mysql_fetch_array($qyu);
	
			$date = $_POST['expire_date'];
			$ex_date = substr($date,0,2);
			$ex_month = substr($date,3,2);
			$ex_year = substr($date,6,4);
			$stok = $_POST['stok_max'];
			$q = "INSERT INTO ms_barang (group_barang, kd_barang, nama, satuan, pabrik01, pabrik02, pabrik03, pabrik04, pabrik05, satuan_kirim, jenis_obat, kategori_obat, golongan, kode_guna, kode_persediaan, kode_pendapatan, 
				  kode_reduksi, kode_biaya, kode_ppn_k, kode_ppn_m, expire_date, ex_date, ex_month, ex_year, tipe_obat, obat_tunai, hna, harga_dosp, discount, ppn, averange_sale, stok_max, 
				  stok_min, stok, isi, kemasan, status, flags, created_datetime, created_user, no_batch, no_rak) VALUES ('".$_POST['group_barang']."', '".$_POST['kd_barang']."', '".$_POST['nama']."', '".$_POST['satuan']."', '".$_POST['pabrik01']."'
				  , '".$_POST['pabrik02']."', '".$_POST['pabrik03']."', '".$_POST['pabrik04']."', '".$_POST['pabrik05']."', '".$_POST['satuan_kirim']."', '".$_POST['jenis_obat']."', '".$_POST['kategori_obat']."', '".$_POST['golongan']."', '".$_POST['kode_guna']."'
				  , '".$_POST['kode_persediaan']."', '".$_POST['kode_pendapatan']."', '".$_POST['kode_reduksi']."', '".$_POST['kode_biaya']."', '".$_POST['kode_ppn_k']."'
				  , '".$_POST['kode_ppn_m']."', '".$_POST['expire_date']."', '$ex_date', '$ex_month', '$ex_year', '".$_POST['tipe_obat']."', '".$_POST['obat_tunai']."'
				  , '".$_POST['hna']."', '".$_POST['harga_dosp']."', '".$_POST['discount']."', '".$_POST['ppn']."', '".$_POST['averange_sale']."', '".$_POST['stok_max']."'
				  , '".$_POST['stok_min']."', '$stok', '".$_POST['isi']."', '".$_POST['kemasan']."', '$aktif', '".$_POST['status']."', now(), '".$_SESSION['U_USER']."'
				  , '".$_POST['no_batch']."', '".$_POST['no_rak']."')";
			$r = mysql_query($q);
			if ($r)
			{
				echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/daftar_barang'>";
			}
			else
			{
				print "<script>alert('Kode ms_barang Sudah Ada Harap di Ganti.');location.href='home.php?hal=content/daftar_barang'</script>";
			}
		}
?>