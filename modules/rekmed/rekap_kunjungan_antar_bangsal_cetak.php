<?
$_TITLE = "Perbandingan Jml Pasien Dirawat Antar Bangsal";
$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 2;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][th_0]);
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][th_1]);
$cetak->addLastRowFromArray($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][last_row]);
$cetak->addRowFromArray($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][title]));
$cetak->setContentBefore($_SESSION[rekmed][rekap_kunjungan_antar_bangsal][graph]);
$ret = $cetak->build();


?>