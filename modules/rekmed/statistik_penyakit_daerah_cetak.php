<?
$_TITLE = "Data Sepuluh Besar Penyakit";
$judul = nl2br($_SESSION[rekmed][statistik_penyakit_daerah][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
$cetak->addTh("1", "2", "3", "4", "5");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_penyakit_daerah][graph]);
$cetak->addLastRow("", "<b>Total</b>", "", $_SESSION[rekmed][statistik_penyakit_daerah][total],$_SESSION[rekmed][statistik_penyakit_daerah][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_penyakit_daerah][no], $_SESSION[rekmed][statistik_penyakit_daerah][kode], $_SESSION[rekmed][statistik_penyakit_daerah][nama], $_SESSION[rekmed][statistik_penyakit_daerah][jml], $_SESSION[rekmed][statistik_penyakit_daerah][persen]);
?>