<?
$_TITLE = "Statistik Kunjungan Radiologi";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[radio][statistik_kunjungan_radio][th_0]);
$cetak->addExtraThFromArray($_SESSION[radio][statistik_kunjungan_radio][extra_th_0]);

$cetak->addThFromArray($_SESSION[radio][statistik_kunjungan_radio][th_1]);
$cetak->addLastRowFromArray($_SESSION[radio][statistik_kunjungan_radio][row]);
//$cetak->addRowFromArray($_SESSION[radio][statistik_kunjungan_radio][row]);
$cetak->setSubTitle(nl2br($_SESSION[radio][statistik_kunjungan_radio][title]));
$cetak->setContentBefore($_SESSION[radio][statistik_kunjungan_radio][graph]);
$ret = $cetak->build();
?>