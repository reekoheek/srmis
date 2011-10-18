<?php 
session_start();
 include("../include/koneksi.php");
 
 
 if($_GET['tgl1'])
{
$tgl1=$_GET['tgl1'];
$tgl2=$_GET['tgl2'];
$d1=substr($tgl1,0,2);
$d2=substr($tgl2,0,2);
$m1=substr($tgl1,3,2);
$m2=substr($tgl2,3,2);
$y1=substr($tgl1,6,4);
$y2=substr($tgl2,6,4);
$t1=$y1."-".$m1."-".$d1;
$t2=$y2."-".$m2."-".$d2;

$bulan=date("i");
$skrg=date("F Y");
$user=$_SESSION['U_USER'];

 }
 
#ambil data di tabel dan masukkan ke array 
$query = "SELECT no_trans,no_resep,fld01,total FROM penjualan_head where tgl between '$t1' and '$t2' order by id ASC "; 
$sql = mysql_query ($query); 
$subt=mysql_query("select sum(total) as subtotal from penjualan_head where tgl between '$t1' and '$t2' order by id ASC ");
$ds=mysql_fetch_array($subt);
$subtotal=$ds['subtotal'];
$data = array(); 
while ($row = mysql_fetch_assoc($sql)) { 
 array_push($data, $row);  
} 
 
#setting judul laporan dan header tabel 
$judul = "LAPORAN TRANSAKSI KASIR"; 
$header = array( 
  array("label"=>"NO TRANSAKSI", "length"=>40, "align"=>"C"), 
  array("label"=>"NO RESEP", "length"=>40, "align"=>"C"), 
  array("label"=>"NAMA PASIEN", "length"=>70, "align"=>"C"), 
  array("label"=>"TOTAL", "length"=>30, "align"=>"C") 
 ); 
 
#sertakan library FPDF dan bentuk objek 
require("../include/fpdf16/fpdf.php"); 
$pdf = new FPDF(); 
$pdf->AddPage(); 
 
#tampilkan judul laporan 
$subjudul="Tanggal ".$t1." - ".$t2;
$pdf->SetFont('Courier','B','16'); 
$pdf->Cell(0,7, $judul, '0', 1, 'C'); 

$pdf->SetFont('Courier','B','12'); 
$pdf->Cell(0,20, $subjudul, '0', 1, 'C');
 
#buat header tabel 
$pdf->SetFont('Courier','','10'); 
$pdf->SetFillColor(65,65,65); 
$pdf->SetTextColor(255); 
$pdf->SetDrawColor(204,204,204);
$pdf->Cell(10, 5, 'NO', 1, '0', 
'L', true); 
foreach ($header as $kolom) { 

 $pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', 
$kolom['align'], true); 
} 
$pdf->Ln(); 
 
#tampilkan data tabelnya 
$pdf->SetFillColor(224,235,255); 
$pdf->SetTextColor(0); 
$pdf->SetFont(''); 
$fill=false;
$no=1; 
foreach ($data as $baris) { 
 $pdf->Cell(10, 5, $no, 1, '0', 
'L', $fill);
 $i = 0; 
 foreach ($baris as $cell) { 
  $pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', 
$kolom['align'], $fill); 
  $i++; 
 } 
 $no++;
 $fill = !$fill; 
 $pdf->Ln(); 
} 
$pdf->Cell(160, 5, 'Subtotal', 1, '0', 
'R', $fill); 
$pdf->Cell(30, 5, $subtotal, 1, '0', 
'R', $fill); 

$ddd=date("d - m - Y");
$dd="Dicetak oleh ".$user." pada ".$ddd;
$pdf->SetFont('Courier','I','8'); 
$pdf->Cell(0,20, $dd, '0', 1, 'R');

#output file PDF 
$pdf->Output(); 
?> 