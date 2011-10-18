<?php

//koneksi ke database
include "../include/koneksi.php";
#ambil data di tabel dan masukkan ke array
#
$tahun = $_POST['tahun'];
$query = "SELECT ms_barang.nama, amc2.b_2, amc2.b_1, amc2.b1, amc2.rata_rata FROM ms_barang,amc2 WHERE amc2.barang_id = ms_barang.kd_barang AND amc2.tahun = '$tahun' ORDER BY amc2.barang_id ASC";
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
$judul = "AMC OBAT PER 3 BULAN TERAKHIR / TAHUN $tahun";
#
$header = array(
#
array("label"=>"NAMA", "length"=>60, "align"=>"L"),
#
array("label"=>"B-2", "length"=>25, "align"=>"L"),
#
array("label"=>"B-1", "length"=>25, "align"=>"L"),
array("label"=>"B", "length"=>25, "align"=>"L"),
array("label"=>"RATA-RATA", "length"=>35, "align"=>"L")

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