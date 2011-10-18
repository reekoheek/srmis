<?
$_TITLE = "Rekap Kunjungan Antar Poliklinik";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_antar_poli][th_0]);
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_antar_poli][th_1]);
$cetak->addLastRowFromArray($_SESSION[rekmed][rekap_kunjungan_antar_poli][last_row]);
$cetak->addRowFromArray($_SESSION[rekmed][rekap_kunjungan_antar_poli][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][rekap_kunjungan_antar_poli][title]));
$cetak->setContentBefore($_SESSION[rekmed][rekap_kunjungan_antar_poli][graph]);
$ret = $cetak->build();
?>