<?
	$_TITLE = "Pasien Penderita";
	$cetak = new Cetak;
	$cetak->setSubTitle(nl2br($_SESSION[statistik][penyakit][list_pasien][cetak][title]));
	$ret = $cetak->buildPage($_SESSION[statistik][penyakit][list_pasien][cetak][content], false, $_SESSION[statistik][penyakit][list_pasien][cetak][is_last_page], false, $_SESSION[statistik][penyakit][list_pasien][cetak][ket_hal]);
?>