<?
$_TITLE = "Distribusi Pasien Menurut Daerah";
$judul = nl2br($_SESSION[rekmed][statistik_pasien_per_daerah][title]);

$cetak = new Cetak;
$cetak->page_one = 15;
$cetak->page_other = 30;
$cetak->addTh("No", "Daerah", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_pasien_per_daerah][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_per_daerah][total],$_SESSION[rekmed][statistik_pasien_per_daerah][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_pasien_per_daerah][no], $_SESSION[rekmed][statistik_pasien_per_daerah][nama], $_SESSION[rekmed][statistik_pasien_per_daerah][jml], $_SESSION[rekmed][statistik_pasien_per_daerah][persen]);
?>