<?php

//koneksi ke database
include "../include/koneksi.php";
#ambil data di tabel dan masukkan ke array
#
$tgl=$_POST['tgl'];
$query = "SELECT ms_barang.kd_barang, ms_barang.nama, ms_barang.expire_date, ms_barang.harga_dosp, stok_opname.stok_ms, stok_opname.stok_apt
	      , stok_opname.stok_rj, stok_opname.stok_ri, stok_opname.stok_igd, stok_opname.stok_oca, stok_opname.stok_lab, stok_opname.stok_rad, 
		  stok_opname.jumlah FROM stok_opname,ms_barang WHERE stok_opname.barang_id=ms_barang.id AND stok_opname.tgl='$tgl' 
		  ORDER BY ms_barang.ex_year,ms_barang.ex_month,ms_barang.ex_year ASC";
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
$judul = "LAPORAN STOK OPNAME Tertanggal $tgl";
#
$header = array(
array("label"=>"KODE", "length"=>15, "align"=>"L"),
#
array("label"=>"NAMA", "length"=>30, "align"=>"L"),
#
array("label"=>"EXPIRE", "length"=>15, "align"=>"L"),
array("label"=>"HARGA", "length"=>16, "align"=>"L"),
array("label"=>"MS", "length"=>12, "align"=>"L"),
array("label"=>"APT", "length"=>12, "align"=>"L"),
array("label"=>"RJ", "length"=>12, "align"=>"L"),
array("label"=>"RI", "length"=>12, "align"=>"L"),
array("label"=>"IGD", "length"=>12, "align"=>"L"),
array("label"=>"OCA", "length"=>12, "align"=>"L"),
array("label"=>"LAB", "length"=>12, "align"=>"L"),
array("label"=>"RAD", "length"=>12, "align"=>"L"),
array("label"=>"JUMLAH", "length"=>16, "align"=>"L"),
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
$pdf->SetFont('Arial','','6');
#
$pdf->SetFillColor(65,65,65);
#
$pdf->SetTextColor(255);
#
$pdf->SetDrawColor(255,255,255);
#
$pdf->Cell(7, 5, 'NO', 1, '0', 'C', true); 
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
$pdf->Cell(7, 5, $no, 1, '0', 'L', $fill);
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