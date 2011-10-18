<?
	$_TITLE = "Distribusi Pasien Menurut Daerah";
	$cetak = new Cetak;
	$cetak->setSubTitle(nl2br($_SESSION[rekmed][statistik_pasien_per_daerah][list_pasien][title]));
	$ret = $cetak->buildPage($_SESSION[rekmed][statistik_pasien_per_daerah][list_pasien][content], false, $_SESSION[rekmed][statistik_pasien_per_daerah][list_pasien][is_last_page], false, $_SESSION[rekmed][statistik_pasien_per_daerah][list_pasien][ket_hal]);
?>