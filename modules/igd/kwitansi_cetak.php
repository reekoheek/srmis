<?
$_TITLE = "Kwitansi-" . $_GET[id_kwitansi];
$tabel = new Table;
$tabel->cellspacing = "0";
$tabel->scroll = false;
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
		kb.karcis_id IS NOT NULL
		AND kwd.kwitansi_id = '".$no_kwitansi."'
	GROUP BY kb.id
";
$kon->execute();
$data_karcis = $kon->getAll();
if(!empty($data_karcis)) {
	$tabel->addRow("","<b>Karcis</b>","");
	for($i=0;$i<sizeof($data_karcis);$i++) {
		$tabel->addRow(
			($i+1),
			$data_karcis[$i][nama],
			uangIndo($data_karcis[$i][bayar])
		);
		$total += $data_karcis[$i][bayar];
		$mampu_bayar += $data_karcis[$i][mampu_bayar];
	}
}

//get data tindakan
$kon->sql = "
	SELECT
		kki.nama as nama,
		SUM(kb.bayar_jasa) as bayar,
		SUM(kb.mampu_bayar_jasa) as mampu_bayar
	FROM
		kunjungan_kamar_icopim kki 
		JOIN kunjungan_bayar kb ON (kb.kunjungan_kamar_icopim_id = kki.id)
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kb.icopim_detil_id IS NOT NULL
		AND kwd.kwitansi_id= '".$no_kwitansi."'
	GROUP BY
		kki.id
";
$kon->execute();
$data_tindakan = $kon->getAll();
if(!empty($data_tindakan)) {
	$tabel->addRow("","<b>Tindakan</b>","");
	for($i=0;$i<sizeof($data_tindakan);$i++) {
		$tabel->addRow(
			($i+1),
			$data_tindakan[$i][nama],
			uangIndo($data_tindakan[$i][bayar])
		);
		$total += $data_tindakan[$i][bayar];
		$mampu_bayar += $data_tindakan[$i][mampu_bayar];
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

//get data kendaraan
$kon->sql = "
	SELECT
		kkd.nama as nama,
		SUM(kb.bayar_bhp+kb.bayar_jasa) as bayar,
		SUM(kb.mampu_bayar_bhp+kb.mampu_bayar_jasa) as mampu_bayar
	FROM
		kunjungan_kendaraan kkd 
		JOIN kunjungan_bayar kb ON (kb.kunjungan_kendaraan_id = kkd.id)
		JOIN kwitansi_detil kwd ON (kwd.kunjungan_bayar_id = kb.id)
	WHERE
		kwd.kwitansi_id= '".$no_kwitansi."'
	GROUP BY
		kkd.id
";
$kon->execute();
$data_kendaraan = $kon->getAll();
if(!empty($data_kendaraan)) {
	$tabel->addRow("","<b>Sewa Kendaraan</b>","");
	for($i=0;$i<sizeof($data_kendaraan);$i++) {
		$tabel->addRow(
			($i+1),
			$data_kendaraan[$i][nama],
			uangIndo($data_kendaraan[$i][bayar])
		);
		$total += $data_kendaraan[$i][bayar];
		$mampu_bayar += $data_kendaraan[$i][mampu_bayar];
	}
}

$tabel->addRow("","<b>Total</b>", uangIndo($total));
$tabel->addRow("","<b>Dibayar</b>", uangIndo($mampu_bayar));
//param u/ HTML
//$_SESSION[igd][langsung_bayar][data_px]
$tabel_jasa = $tabel->build();
?>