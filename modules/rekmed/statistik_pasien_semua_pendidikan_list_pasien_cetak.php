<?
	$_TITLE = "Distribusi Pasien Menurut Tingkat Pendidikan";
	$cetak = new Cetak;
	$cetak->setSubTitle(nl2br($_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][title]));
	$ret = $cetak->buildPage($_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][content], false, $_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][is_last_page], false, $_SESSION[rekmed][statistik_pasien_semua_pendidikan][list_pasien][ket_hal]);
?>