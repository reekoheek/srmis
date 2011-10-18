<?
$_TITLE = "Data Sepuluh Besar Penyakit IGD";
$judul = nl2br($_SESSION[rekmed][statistik_penyakit_igd][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
$cetak->addTh("1", "2", "3", "4", "5");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_penyakit_igd][graph]);
$cetak->addLastRow("", "<b>Total</b>", "", $_SESSION[rekmed][statistik_penyakit_igd][total],$_SESSION[rekmed][statistik_penyakit_igd][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_penyakit_igd][no], $_SESSION[rekmed][statistik_penyakit_igd][kode], $_SESSION[rekmed][statistik_penyakit_igd][nama], $_SESSION[rekmed][statistik_penyakit_igd][jml], $_SESSION[rekmed][statistik_penyakit_igd][persen]);
?>