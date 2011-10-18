<?
$_TITLE = "Data Sepuluh Besar Penyakit Rawat Inap";
$judul = nl2br($_SESSION[rekmed][statistik_penyakit_ranap][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Kode ICD", "Diagnosa", "Kasus", "%");
$cetak->addTh("1", "2", "3", "4", "5");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_penyakit_ranap][graph]);
$cetak->addLastRow("", "<b>Total</b>", "", $_SESSION[rekmed][statistik_penyakit_ranap][total],$_SESSION[rekmed][statistik_penyakit_ranap][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_penyakit_ranap][no], $_SESSION[rekmed][statistik_penyakit_ranap][kode], $_SESSION[rekmed][statistik_penyakit_ranap][nama], $_SESSION[rekmed][statistik_penyakit_ranap][jml], $_SESSION[rekmed][statistik_penyakit_ranap][persen]);
?>