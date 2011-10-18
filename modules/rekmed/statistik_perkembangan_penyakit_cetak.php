<?
$_TITLE = "Statistik Perkembangan Penyakit";
$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][statistik_perkembangan_penyakit][th_0]);
$cetak->addThFromArray($_SESSION[rekmed][statistik_perkembangan_penyakit][th_1]);
$cetak->addRowFromArray($_SESSION[rekmed][statistik_perkembangan_penyakit][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][statistik_perkembangan_penyakit][title]));
$cetak->setContentBefore($_SESSION[rekmed][statistik_perkembangan_penyakit][graph]);
$ret = $cetak->build();

?>