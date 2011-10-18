<?
$_TITLE = "Data Sepuluh Besar Penyakit Rawat Jalan";
$judul = nl2br($_SESSION[rekmed][statistik_penyakit_rajal][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
$cetak->addTh("1", "2", "3", "4", "5");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_penyakit_rajal][graph]);
$cetak->addLastRow("", "<b>Total</b>", "", $_SESSION[rekmed][statistik_penyakit_rajal][total],$_SESSION[rekmed][statistik_penyakit_rajal][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_penyakit_rajal][no], $_SESSION[rekmed][statistik_penyakit_rajal][kode], $_SESSION[rekmed][statistik_penyakit_rajal][nama], $_SESSION[rekmed][statistik_penyakit_rajal][jml], $_SESSION[rekmed][statistik_penyakit_rajal][persen]);
?>