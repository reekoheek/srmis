<?php

//koneksi ke database
include "../include/koneksi.php";
#ambil data di tabel dan masukkan ke array
#
$tgl_mulai=$_POST['tgl_mulai'];
$tgl_selesai=$_POST['tgl_selesai'];
$d1=substr($tgl_mulai,0,2);
$m1=substr($tgl_mulai,3,2);
$y1=substr($tgl_mulai,6,4);
$d2=substr($tgl_selesai,0,2);
$m2=substr($tgl_selesai,3,2);
$y2=substr($tgl_selesai,6,4);

$tanggal_start=$y1."-".$m1."-".$d1;
$tanggal_end=$y2."-".$m2."-".$d2;
$unit = $_POST['unit'];
if ($unit=="2")
{
	$nama ="Apotik";
}
elseif ($unit=="87")
{
	$nama ="Laboratorium";
}
elseif ($unit=="91")
{
	$nama ="Radiologi";
}
elseif ($unit=="51")
{
	$nama ="IGD";
}
elseif ($unit=="4")
{
	$nama ="Rawat Jalan";
}
elseif ($unit=="50")
{
	$nama ="Rawat Inap";
}
else
{
	$nama ="OK (Ruang Tindakan)";
}
$jenis = $nama;
$query = "SELECT permintaan_unitdetail.No_SPP,permintaan_unit.No_BPB,permintaan_unit.No_BTB,permintaan_unitdetail.Nm_Barang,permintaan_unitdetail.Qty
		  ,permintaan_unitdetail.Qty_diberi
		  FROM permintaan_unitdetail,permintaan_unit,pelayanan WHERE permintaan_unit.No_SPP=permintaan_unitdetail.No_SPP AND 
		  permintaan_unitdetail.Unit=pelayanan.id AND permintaan_unitdetail.status_detail <> '0' 
		  AND permintaan_unit.create_date BETWEEN '$tanggal_start' AND '$tanggal_end' AND pelayanan.unit_id = '".$_POST['unit']."'
		  ORDER BY permintaan_unitdetail.No_SPP ASC";
#
$sql = mysql_query ($query);
#
$data = array();
#

while ($row = mysql_fetch_assoc($sql)) {
#

array_push($data,$row);

#
}
#
 
#
#setting judul laporan dan header tabel
#
$judul = "LAPORAN DISTRIBUSI UNIT $jenis Tertanggal $tgl_mulai - $tgl_selesai";
#
$header = array(
array("label"=>"NO SPP", "length"=>27, "align"=>"L"),
#
array("label"=>"NO BPB", "length"=>27, "align"=>"L"),
#
array("label"=>"NO BTB", "length"=>27, "align"=>"L"),
array("label"=>"NAMA", "length"=>50, "align"=>"L"),
array("label"=>"DIMINTA", "length"=>25, "align"=>"L"),
array("label"=>"DIBERI", "length"=>25, "align"=>"L")
#
);
#
 
#
#sertakan library FPDF dan bentuk objek
#
require_once ("../fpdf16/fpdf.php");
#
$pdf = new FPDF();
#
$pdf->AddPage();
#
 
#
#tampilkan judul laporan
#
$pdf->SetFont('Arial','B','12');
#
$pdf->Cell(0,20, $judul, '0', 1, 'C');
#
 
#
#buat header tabel
#
$pdf->SetFont('Arial','','9');
#
$pdf->SetFillColor(65,65,65);
#
$pdf->SetTextColor(255);
#
$pdf->SetDrawColor(128,0,0);
#
$pdf->Cell(8, 5, 'NO', 1, '0', 'C', true); 
#
foreach ($header as $kolom) {
#
$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
#
}
#
$pdf->Ln();
#
$no2=1;
#
#tampilkan data tabelnya
#
$pdf->SetFillColor(204,204,204);
#
$pdf->SetTextColor(0);
#
$pdf->SetFont('');
#
$fill=false;
#
$no=1;
foreach ($data as $baris) {
#
$i = 0;
#
$pdf->Cell(8, 5, $no, 1, '0', 'L', $fill);
$i = 0; 
foreach ($baris as $cell) {
#
$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
#
$i++;
#
}
$no++;
#
$fill = !$fill;
#
$pdf->Ln();
$no2++;
#
}
#
 
#
#output file PDF
#
$pdf->Output();
#
?> 