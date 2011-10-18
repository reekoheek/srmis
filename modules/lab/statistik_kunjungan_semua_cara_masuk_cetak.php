<?
$_TITLE = "Statistik Kunjungan Laboratorium";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][th_0]);
$cetak->addExtraThFromArray($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][extra_th_0]);

$cetak->addThFromArray($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][th_1]);
$cetak->addLastRowFromArray($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][row]);
//$cetak->addRowFromArray($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][row]);
$cetak->setSubTitle(nl2br($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][title]));
$cetak->setContentBefore($_SESSION[lab][statistik_kunjungan_semua_cara_masuk][graph]);
$ret = $cetak->build();
?>