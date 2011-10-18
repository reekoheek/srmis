<?
$_TITLE = "Performance Rumah Sakit";

$cetak = new Cetak;
$cetak->page_one = 10;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][performance][th_0]);
$cetak->addRowFromArray($_SESSION[rekmed][performance][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][performance][title]));
$cetak->setContentBefore($_SESSION[rekmed][performance][graph_resize]);
$ret = $cetak->build();

?>