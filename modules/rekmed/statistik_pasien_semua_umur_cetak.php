<?
$_TITLE = "Distribusi Pasien Menurut Golongan Umur";
$judul = nl2br($_SESSION[rekmed][statistik_pasien_semua_umur][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Golongan Umur", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_pasien_semua_umur][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_semua_umur][total],$_SESSION[rekmed][statistik_pasien_semua_umur][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_pasien_semua_umur][no], $_SESSION[rekmed][statistik_pasien_semua_umur][nama], $_SESSION[rekmed][statistik_pasien_semua_umur][jml], $_SESSION[rekmed][statistik_pasien_semua_umur][persen]);
?>