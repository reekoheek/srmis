<?
$_TITLE = "Statistik Kunjungan Rawat Inap";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[ranap][statistik_kunjungan_ranap][th_0]);
$cetak->addExtraThFromArray($_SESSION[ranap][statistik_kunjungan_ranap][extra_th_0]);

$cetak->addThFromArray($_SESSION[ranap][statistik_kunjungan_ranap][th_1]);
$cetak->addLastRowFromArray($_SESSION[ranap][statistik_kunjungan_ranap][row]);
//$cetak->addRowFromArray($_SESSION[ranap][statistik_kunjungan_ranap][row]);
$cetak->setSubTitle(nl2br($_SESSION[ranap][statistik_kunjungan_ranap][title]));
$cetak->setContentBefore($_SESSION[ranap][statistik_kunjungan_ranap][graph]);
$ret = $cetak->build();
?>