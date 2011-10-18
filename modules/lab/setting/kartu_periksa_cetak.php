<?
$_TITLE = "Kartu Periksa";
$kon = new Konek;
$sql = "
SELECT 
	p.id as pasien_id,
	CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
	p.nama as nama,
	p.sex as jk,
	CONCAT(p.alamat, ' ', IF(p.rt = '','',CONCAT('RT ', p.rt)), IF(p.rw = '','',CONCAT('RW ', p.rw)), des.nama, ', ', kec.nama, ', ', kab.nama) as alamat
FROM
	pasien p
	JOIN ref_desa des ON (des.id = p.desa_id)
	JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
	JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
WHERE
	p.id = '".$_GET[id]."'
";
//echo $sql;
$kon->sql = $sql;
$kon->execute();
$data = $kon->getOne();
?>