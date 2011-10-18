<?php

//koneksi ke database
include "../include/koneksi.php";
#ambil data di tabel dan masukkan ke array
#
$tgl = date ("d/m/Y");
$query = "SELECT ms_barang.kd_barang,ms_barang.nama, stok_level.min_stock_lv, stok_level.max_stock_lv FROM ms_barang,stok_level WHERE stok_level.barang_id = ms_barang.id ORDER BY stok_level.barang_id ASC";
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
$judul = "MIN-MAX STOCK LEVEL Tertanggal $tgl";
#
$header = array(
#
array("label"=>"KODE", "length"=>20, "align"=>"L"),
array("label"=>"NAMA", "length"=>100, "align"=>"L"),
#
array("label"=>"MIN STOCK LV", "length"=>30, "align"=>"L"),
#
array("label"=>"MAX STOCK LV", "length"=>30, "align"=>"L")

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
$pdf->SetFont('Arial','B','16');
#
$pdf->Cell(0,20, $judul, '0', 1, 'C');
#
 
#
#buat header tabel
#
$pdf->SetFont('Arial','','10');
#
$pdf->SetFillColor(65,65,65);
#
$pdf->SetTextColor(255);
#
$pdf->SetDrawColor(128,0,0);
#
$pdf->Cell(10, 5, 'NO', 1, '0', 'C', true); 
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
$pdf->Cell(10, 5, $no, 1, '0', 'L', $fill);
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