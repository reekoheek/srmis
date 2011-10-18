<?
/* tampilan tracer yg dicetak*/
$kon = new Konek;
if($_GET[kkid]) {
/* cuma 1 pasien */
	$sql = "
		SELECT 
			kk.id as kkid,
			k.kunjungan_ke as kunjungan_ke,
			kk.no_antrian as no_antrian,
			CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
			p.nama as nama,
			kmr.id as kmrid,
			kmr.nama as klinik,
			kk.tgl_periksa as tgl_periksa,
			d.nama as dokter,
			trc.id as trcid,
			trc.keperluan as keperluan
		FROM 
			kunjungan k
			JOIN pasien p ON (p.id = k.pasien_id)
			JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
			JOIN kamar kmr ON (kmr.id = kk.kamar_id)
			JOIN tracer trc ON (trc.kunjungan_kamar_id = kk.id)
			LEFT JOIN dokter d ON (d.id = kk.dokter_id)
		WHERE
			kk.id = '".$_GET[kkid]."'
	";
} elseif($_GET[trcid]) {
	$trcid = str_replace("|", ",", $_GET[trcid]);
	$sql = "
		SELECT 
			CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
			p.nama as nama,
			trc.tgl_keluar as tgl_keluar,
			trc.id as trcid,
			trc.keperluan as keperluan,
			trc.peminjam as peminjam
		FROM 
			tracer trc
			JOIN pasien p ON (p.id = trc.pasien_id)
		WHERE
			trc.id IN (".$trcid.")
	";
} else {
	if($_GET[jenis] == "BELUM") $s .= " AND trc.cetak = 'BELUM' ";
	elseif($_GET[jenis] == "SUDAH") $s .= " AND trc.cetak = 'SUDAH' ";
	if($_GET[tgl]) {
		$tgl = str_replace("|", "-", $_GET[tgl]);
		$s .= " AND DATE(trc.tgl_keluar) = '".$tgl."' ";
	}
	$sql = "
		SELECT 
			kk.id as kkid,
			k.kunjungan_ke as kunjungan_ke,
			kk.no_antrian as no_antrian,
			CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
			p.nama as nama,
			kmr.nama as klinik,
			kmr.id as kmrid,
			kk.tgl_periksa as tgl_periksa,
			d.nama as dokter,
			trc.id as trcid,
			trc.keperluan as keperluan
		FROM 
			kunjungan k
			JOIN pasien p ON (p.id = k.pasien_id)
			JOIN kunjungan_kamar kk ON (kk.kunjungan_id = k.id)
			JOIN kamar kmr ON (kmr.id = kk.kamar_id)
			JOIN tracer trc ON (trc.kunjungan_kamar_id = kk.id)
			LEFT JOIN dokter d ON (d.id = kk.dokter_id)
		WHERE
			trc.cetak IS NOT NULL
			$s
		ORDER BY 
			kk.id ASC
		LIMIT 0, ".$_GET[limit]."
	";
}
$kon->sql = $sql;
$kon->execute();
$data = $kon->getAll();
$arr = array();
for($i=0;$i<sizeof($data);$i++) {
	if($data[$i][kmrid] != 1 && $data[$i][kmrid]) $poli[$i] = "POLIKLINIK&nbsp;" . $data[$i][klinik];
	elseif($data[$i][kmrid]) $poli[$i] = $data[$i][klinik];
	else $poli[$i] = "";

	$arr[] = $data[$i][trcid];
}
$str = implode(", ", $arr);
$kon->sql = "UPDATE tracer SET cetak = 'SUDAH' WHERE id IN (".$str.")";
$kon->execute();
?>