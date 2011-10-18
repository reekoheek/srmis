<?
$_TITLE = "Rekapitulasi Jumlah Cara Pembayaran di Unit Rawat Jalan";
$cetak = new Cetak;
$cetak->layout = "landscape";
$cetak->page_one = 5;
$cetak->page_other = 10;
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][th_0]);
$cetak->addThFromArray($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][th_1]);
$cetak->addRowFromArray($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][row]);
$cetak->setSubTitle(nl2br($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][title]));
$cetak->setContentBefore($_SESSION[rekmed][rekap_kunjungan_rajal_per_cara_bayar][graph]);
$ret = $cetak->build();

?>