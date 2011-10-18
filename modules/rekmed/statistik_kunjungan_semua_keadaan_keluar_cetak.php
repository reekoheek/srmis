<?
$_TITLE = "Statistik Kunjungan Berdasar Keadaan Keluar";
$judul = nl2br($_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Keadaan Keluar", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][total],$_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][no], $_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][nama], $_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][jml], $_SESSION[rekmed][statistik_kunjungan_semua_keadaan_keluar][persen]);
?>