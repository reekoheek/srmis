<?
$_TITLE = "Kwitansi-" . $_GET[id_kwitansi];
$tabel = new Table;
$tabel->scroll = false;
$tabel->cellspacing = "0";
$tabel->extra_table = "style=\"width:100%;\"";
$tabel->addTh("No", "Jasa", "Biaya");
$tabel->addExtraTh("style=\"width:0.7cm;\"", "style=\"width:6cm;\"", "");

$id_kwitansi = explode("-", $_GET[id_kwitansi]);
$tempat_pembayaran = $id_kwitansi[0];
$no_kwitansi = $id_kwitansi[1];

$kon = new Konek;
//get data kwitansi
$kon->sql = "SELECT tgl FROM  kwitansi WHERE  id = '".$no_kwitansi."'";
$kon->execute();
$data_kw = $kon->getOne();

$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp + kb.bayar_jasa as bayar,
		kb.mampu_bayar_bhp + kb.mampu_bayar_jasa as mampu_bayar
	FROM
		kunjungan_bayar kb
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		radio_pemeriksaan_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id
";
$kon->execute();
$data_pemeriksaan = $kon->getAll();
if(!empty($data_pemeriksaan)) {
	$tabel->addRow("","<b>Pemeriksaan Specimen</b>","");
	for($i=0;$i<sizeof($data_pemeriksaan);$i++) {
		$tabel->addRow(
			($i+1),
			$data_pemeriksaan[$i][nama],
			uangIndo($data_pemeriksaan[$i][bayar])
		);
		$total += $data_pemeriksaan[$i][bayar];
		$mampu_bayar += $data_pemeriksaan[$i][mampu_bayar];
	}
}

//get data bhp
$kon->sql = "
	SELECT
		kb.nama as nama,
		kb.bayar_bhp as bayar,
		kb.mampu_bayar_bhp as mampu_bayar
	FROM
		kunjungan_bayar kb 
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.bhp_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY
		kb.id
";
$kon->execute();
$data_bhp = $kon->getAll();
if(!empty($data_bhp)) {
	$tabel->addRow("","<b>Bahan Habis Pakai</b>","");
	for($i=0;$i<sizeof($data_bhp);$i++) {
		$tabel->addRow(
			($i+1),
			$data_bhp[$i][nama],
			uangIndo($data_bhp[$i][bayar])
		);
		$total += $data_bhp[$i][bayar];
		$mampu_bayar += $data_bhp[$i][mampu_bayar];
	}
}
$tabel->addRow("","<b>Total</b>", uangIndo($total));
$tabel->addRow("","<b>Dibayar</b>", uangIndo($mampu_bayar));
//param u/ HTML
//$_SESSION[radio][langsung_bayar][data_px]
$tabel_jasa = $tabel->build();
?>