<?
$_TITLE = "Statistik Kunjungan Berdasar Cara Masuk";
$judul = nl2br($_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Cara Masuk", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][total],$_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][no], $_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][nama], $_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][jml], $_SESSION[rekmed][statistik_kunjungan_semua_cara_masuk][persen]);
?>