<?
$_TITLE = "Rata-rata Pasien Dirawat per Dokter";
$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][th_0]);
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][th_1]);
$cetak->addLastRowFromArray($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][last_row]);
$cetak->addRowFromArray($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][title]));
$cetak->setContentBefore($_SESSION[rekmed][rekap_kunjungan_ranap_per_dokter][graph]);
$ret = $cetak->build();

?>