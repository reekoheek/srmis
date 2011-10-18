<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<?php
	if ($_SESSION["U_KODE"] == "1")
	{
?>
<!-- Menu Untuk Admin-->

<div id="ddsidemenubar" class="markermenu">
<ul>
<li><a href="#" rel="ddsubmenuside1"><img src="images/icon/home.png"> Master</a></li>
<li><a href="home.php?hal=content/#"  rel="ddsubmenuside2"><img src="images/icon/gudang.png"> Gudang Farmasi  </a></li>
<li><a href="home.php?hal=content/#"  rel="ddsubmenuside3"><img src="images/icon/obat2.png"> Apotek </a></li>
<li><a href="home.php?hal=setup/#"  rel="ddsubmenuside4"><img src="images/icon/home.png"> Setup </a></li>
<li><a href="logout.php"><img src="images/icon/logout.png"> Logout</a></li>
</ul>
</div>

<script type="text/javascript">
ddlevelsmenu.setup("ddsidemenubar", "sidebar") //ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
</script>

<!-- START OF MENU -->
<ul id="ddsubmenuside1" class="ddsubmenustyle blackwhite">
<li><a href="home.php?hal=content/#"><img src="images/icon/obat.png"> Kategori Obat</a>
  <ul>
  	<li><a href="home.php?hal=content/jenis_obat"><img src="images/icon/obat.png"> Jenis Obat</a></li>
	<li><a href="home.php?hal=content/tipe_obat"><img src="images/icon/obat.png"> Tipe Obat</a></li>
	<li><a href="home.php?hal=content/golongan_obat"><img src="images/icon/obat.png"> Golongan Obat</a></li>
	<li><a href="home.php?hal=content/guna_obat"><img src="images/icon/obat.png"> Guna Obat</a></li>
  </ul>
</li>
<li><a href="home.php?hal=content/group_barang"><img src="images/icon/group.png"> Group Barang</a></li>
<li><a href="home.php?hal=content/dosis"><img src="images/icon/dosis.png"> Dosis</a></li>
<li><a href="home.php?hal=content/satuan"><img src="images/icon/dosis.png"> Satuan</a></li>
<li><a href="home.php?hal=content/pbf"><img src="images/icon/dosis.png"> PBF</a></li>
<li><a href="home.php?hal=content/pasien"><img src="images/icon/pasien.png"> Data Pasien</a></li>
<li><a href="home.php?hal=content/aktivasi_akun"><img src="images/icon/aktivasi.png"> Aktivasi Akun</a></li>
</ul>

<!--Side Drop Down Menu 2 HTML-->
<ul id="ddsubmenuside2" class="ddsubmenustyle blackwhite">
<li><a href="home.php?hal=content/klasifikasi_inventory"><img src="images/icon/dosis.png"> Klasifikasi Inventory</a></li>
<li><a href="home.php?hal=content/margin"><img src="images/icon/dosis.png"> Margin</a></li>
<li><a href="home.php?hal=content/margin_tunai"><img src="images/icon/dosis.png"> Margin Tunai</a></li>
<li><a href="home.php?hal=content/daftar_barang"><img src="images/icon/stokist.png"> Gudang Farmasi</a></li>
<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Distribusi Stok</a>
	<ul>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Stok Barang Per Klinik</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Stok Barang Per Apotik</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Permintaan Stok</a></li>
	</ul>
</li>
<li><a href="home.php?hal=content/transaksi"><img src="images/icon/group.png"> Transaksi</a>
	<ul>
		<li><a href="home.php?hal=content/ps"><img src="images/icon/dosis.png"> MKS</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> MR</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Daftar MR</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Daftar PO</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Receive Order</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/home.png"> MRS</a></li>
		<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Denda</a></li>
	</ul>
</li>
<li><a href="home.php?hal=content/#"><img src="images/icon/dosis.png"> Stok Opname</a></li>
</ul>

<!--Side Drop Down Menu 3 HTML-->
<ul id="ddsubmenuside3" class="ddsubmenustyle blackwhite">
<li><a href="home.php?hal=content/resep_pasien_reg"><img src="images/icon/penjualan.png"> Resep Pasien Registrasi</a></li>
<li><a href="home.php?hal=content/resep_tunai_non_registrasi"><img src="images/icon/penjualan.png"> Resep Tunai Non - Registrasi</a></li>
<li><a href="home.php?hal=content/penjualan_bebas"><img src="images/icon/penjualan.png"> Penjualan Bebas</a></li>
<li><a href="home.php?hal=content/daftar_obat_farmasi"><img src="images/icon/dosis.png"> Daftar Obat Farmasi</a></li>
</ul>

<!--Side Drop Down Menu 4 HTML-->
<ul id="ddsubmenuside4" class="ddsubmenustyle blackwhite">
<li><a href="home.php?hal=setup/tbl_menu"><img src="images/icon/dosis.png"> Menu</a></li>
<li><a href="home.php?hal=setup/user_type"><img src="images/icon/dosis.png"> User Type</a></li>
<li><a href="home.php?hal=setup/user"><img src="images/icon/dosis.png"> User</a></li>
<li><a href="home.php?hal=setup/user_group"><img src="images/icon/dosis.png"> User Group</a></li>
<li><a href="home.php?hal=setup/leveling_akses"><img src="images/icon/dosis.png"> Leveling Akses</a></li>
</ul>

<?php
}
elseif ($_SESSION["U_KODE"] == "2")
{
?>
 <!-- Menu Untuk Apoteker-->
 <!--
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="">
	<tr valign="top">
		<td>
	<div class="sidebarmenu">
<ul id="sidebarmenu1">
<li><a href="#"><img src="images/icon/home.png"> Master</a>
	<ul>
		<li><a href="home.php?hal=content/jenis_obat"><img src="images/icon/obat.png"> Jenis Obat</a></li>
		<li><a href="home.php?hal=content/obat"><img src="images/icon/obat2.png"> Data Obat</a></li>
		<li><a href="home.php?hal=content/pasien"><img src="images/icon/pasien.png"> Data Pasien</a></li>
		<li><a href="home.php?hal=content/gudang"><img src="images/icon/gudang.png"> Gudang</a></li>
		<li><a href="home.php?hal=content/supplier"><img src="images/icon/supplier.png"> Supplier</a></li>
	</ul>
</li>
<li><a href="home.php?hal=content/#"><img src="images/icon/pembelian.png"> Pembelian</a>
	<ul>
		<li><a href="home.php?hal=content/transaksi_pembelian"><img src="images/icon/obat.png"> Obat Baru</a></li>
		<li><a href="home.php?hal=content/transaksi_pembelian_stock"><img src="images/icon/obat.png"> Tambah Stok Obat</a></li>
	</ul>
</li>
<li><a href="home.php?hal=content/transaksi_penjualan"><img src="images/icon/penjualan.png"> Penjualan</a></li>
<li><a href="home.php?hal=content/copy_resep"><img src="images/icon/copy_resep.png"> Copy Resep</a></li>
<li><a href="#"><img src="images/icon/laporan.png"> Laporan</a>
	<ul>
		<li><a href="home.php?hal=content/lap_penjualan"><img src="images/icon/date.png"> Penjualan Obat</a></li>
		<li><a href="home.php?hal=content/lap_pembelian"><img src="images/icon/date.png"> Pembelian Obat</a></li>
		<li><a href="#"><img src="images/icon/stokist.png"> Data</a>
			<ul>
				<li><a href="content/lap_obat.php" target="_blank"><img src="images/icon/stokist.png"> Obat</a></li>
				<li><a href="content/lap_pasien.php" target="_blank"><img src="images/icon/stokist.png"> Pasien</a></li>
				<li><a href="content/lap_supplier.php" target="_blank"><img src="images/icon/stokist.png"> Supplier</a></li>
			</ul>
		</li>
		<li><a href="home.php?hal=content/lap_copy_resep"><img src="images/icon/date.png"> Copy Resep</a></li>
		<li><a href="home.php?hal=content/lap_pembayaran"><img src="images/icon/date.png"> Pembayaran C. Resep</a></li>
	</ul>
</li>
<li><a href="logout.php"><img src="images/icon/logout.png"> Logout</a></li>
</ul>
</div>
		</td>
	</tr>
</table>

<?php
}
else
{
?>

<!-- Menu Untuk Kasir-->
<!--
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="">
	<tr valign="top">
		<td>
	<div class="sidebarmenu">
<ul id="sidebarmenu1">
<li><a href="home.php?hal=content/transaksi_penjualan"><img src="images/icon/penjualan.png"> Penjualan</a></li>
<li><a href="home.php?hal=content/copy_resep"><img src="images/icon/copy_resep.png"> Copy Resep</a></li>
<li><a href="logout.php"><img src="images/icon/logout.png"> Logout</a></li>
</ul>
</div>
		</td>
	</tr>
</table><?
}
?>
</body>
</html>
