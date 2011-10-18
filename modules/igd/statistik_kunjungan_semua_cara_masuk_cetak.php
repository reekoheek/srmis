<?
$_TITLE = "Statistik Kunjungan IRD Berdasar Cara Masuk";
$judul = nl2br($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Cara Masuk", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[igd][statistik_kunjungan_semua_cara_masuk][total],$_SESSION[igd][statistik_kunjungan_semua_cara_masuk][persen_total]);
$ret = $cetak->build($_SESSION[igd][statistik_kunjungan_semua_cara_masuk][no], $_SESSION[igd][statistik_kunjungan_semua_cara_masuk][nama], $_SESSION[igd][statistik_kunjungan_semua_cara_masuk][jml], $_SESSION[igd][statistik_kunjungan_semua_cara_masuk][persen]);
?>