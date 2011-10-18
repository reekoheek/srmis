<?
$_TITLE = "Distribusi Pasien Menurut Tingkat Pendidikan";
$judul = nl2br($_SESSION[rekmed][statistik_pasien_semua_pendidikan][title]);

$cetak = new Cetak;
$cetak->page_one = 20;
$cetak->page_other = 30;
$cetak->addTh("No", "Tingkat Pendidikan", "Jumlah", "%");
$cetak->addTh("1", "2", "3", "4");
$cetak->setSubTitle($judul);
$cetak->setContentBefore($_SESSION[rekmed][statistik_pasien_semua_pendidikan][graph]);
$cetak->addLastRow("", "<b>Total</b>", $_SESSION[rekmed][statistik_pasien_semua_pendidikan][total],$_SESSION[rekmed][statistik_pasien_semua_pendidikan][persen_total]);
$ret = $cetak->build($_SESSION[rekmed][statistik_pasien_semua_pendidikan][no], $_SESSION[rekmed][statistik_pasien_semua_pendidikan][nama], $_SESSION[rekmed][statistik_pasien_semua_pendidikan][jml], $_SESSION[rekmed][statistik_pasien_semua_pendidikan][persen]);
?>