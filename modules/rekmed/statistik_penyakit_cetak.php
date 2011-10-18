<?
$_TITLE = "Data Sepuluh Besar Penyakit";
$judul = nl2br($_SESSION[rekmed][statistik_penyakit][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
$cetak->addTh("1", "2", "3", "4", "5");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_penyakit][graph]);
$cetak->addLastRow("", "<b>Total</b>", "", $_SESSION[rekmed][statistik_penyakit][total],$_SESSION[rekmed][statistik_penyakit][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_penyakit][no], $_SESSION[rekmed][statistik_penyakit][kode], $_SESSION[rekmed][statistik_penyakit][nama], $_SESSION[rekmed][statistik_penyakit][jml], $_SESSION[rekmed][statistik_penyakit][persen]);
?>