<?
$_TITLE = "Statistik Kunjungan Laboratorium";

$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][th_0]);
$cetak->addExtraThFromArray($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][extra_th_0]);

$cetak->addThFromArray($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][th_1]);
$cetak->addLastRowFromArray($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][row]);
//$cetak->addRowFromArray($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][title]));
$cetak->setContentBefore($_SESSION[rekmed][statistik_kunjungan_lab_semua_cara_masuk][graph]);
$ret = $cetak->build();
?>