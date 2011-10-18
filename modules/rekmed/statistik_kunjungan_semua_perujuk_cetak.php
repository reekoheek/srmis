<?
$_TITLE = "Statistik Kunjungan Berdasar Perujuk";
$judul = nl2br($_SESSION[rekmed][statistik_kunjungan_semua_perujuk][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Perujuk", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_kunjungan_semua_perujuk][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_kunjungan_semua_perujuk][total],$_SESSION[rekmed][statistik_kunjungan_semua_perujuk][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_kunjungan_semua_perujuk][no], $_SESSION[rekmed][statistik_kunjungan_semua_perujuk][nama], $_SESSION[rekmed][statistik_kunjungan_semua_perujuk][jml], $_SESSION[rekmed][statistik_kunjungan_semua_perujuk][persen]);
?>