<?
$_TITLE = "Distribusi Pasien Menurut Pekerjaan";
$judul = nl2br($_SESSION[rekmed][statistik_pasien_semua_pekerjaan][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Pekerjaan", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_pasien_semua_pekerjaan][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_semua_pekerjaan][total],$_SESSION[rekmed][statistik_pasien_semua_pekerjaan][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_pasien_semua_pekerjaan][no], $_SESSION[rekmed][statistik_pasien_semua_pekerjaan][nama], $_SESSION[rekmed][statistik_pasien_semua_pekerjaan][jml], $_SESSION[rekmed][statistik_pasien_semua_pekerjaan][persen]);
?>