<?
$_TITLE = "Statistik Kunjungan Rawat Jalan";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rajal][statistik_kunjungan_rajal][th_0]);
$cetak->addExtraThFromArray($_SESSION[rajal][statistik_kunjungan_rajal][extra_th_0]);

$cetak->addThFromArray($_SESSION[rajal][statistik_kunjungan_rajal][th_1]);
$cetak->addLastRowFromArray($_SESSION[rajal][statistik_kunjungan_rajal][row]);
//$cetak->addRowFromArray($_SESSION[rajal][statistik_kunjungan_rajal][row]);
$cetak->setSubTitle(nl2br($_SESSION[rajal][statistik_kunjungan_rajal][title]));
$cetak->setContentBefore($_SESSION[rajal][statistik_kunjungan_rajal][graph]);
$ret = $cetak->build();
?>