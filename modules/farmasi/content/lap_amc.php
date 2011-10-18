<?php

// nama file
include "../include/koneksi.php";
$namaFile = "lap_amc.xls";
$tahun = $_POST['tahun'];
// Function penanda awal file (Begin Of File) Excel

function xlsBOF() {
echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
return;
}

// Function penanda akhir file (End Of File) Excel

function xlsEOF() {
echo pack("ss", 0x0A, 0x00);
return;
}

// Function untuk menulis data (angka) ke cell excel

function xlsWriteNumber($Row, $Col, $Value) {
echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
echo pack("d", $Value);
return;
}

// Function untuk menulis data (text) ke cell excel

function xlsWriteLabel($Row, $Col, $Value ) {
$L = strlen($Value);
echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
echo $Value;
return;
}

// header file excel

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0,
        pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");

// header untuk nama file
header("Content-Disposition: attachment;
        filename=".$namaFile."");

header("Content-Transfer-Encoding: binary ");

// memanggil function penanda awal file excel
xlsBOF();

// ------ membuat kolom pada excel --- //

// mengisi pada cell A1 (baris ke-0, kolom ke-0)
xlsWriteLabel(0,0,"AMC OBAT PER 3 BULAN TERAKHIR / TAHUN $tahun");
xlsWriteLabel(1,0,"NO");               

// mengisi pada cell A2 (baris ke-0, kolom ke-1)
xlsWriteLabel(1,1,"KODE");              

// mengisi pada cell A3 (baris ke-0, kolom ke-2)
xlsWriteLabel(1,2,"NAMA");

// mengisi pada cell A4 (baris ke-0, kolom ke-3)
xlsWriteLabel(1,3,"B-2");   

// mengisi pada cell A5 (baris ke-0, kolom ke-4)
xlsWriteLabel(1,4,"B-1"); 
xlsWriteLabel(1,5,"B");
xlsWriteLabel(1,6,"RATA-RATA");  

// -------- menampilkan data --------- //

// koneksi ke mysql

// query menampilkan semua data

$query = "SELECT * FROM amc2,ms_barang WHERE amc2.barang_id = ms_barang.kd_barang AND amc2.tahun='$tahun' ORDER BY amc2.barang_id ASC";
$hasil = mysql_query($query);

// nilai awal untuk baris cell
$noBarisCell = 2;

// nilai awal untuk nomor urut data
$noData = 1;

while ($data = mysql_fetch_array($hasil))
{
   // menampilkan no. urut data
   xlsWriteNumber($noBarisCell,0,$noData);

   // menampilkan data nim
   xlsWriteLabel($noBarisCell,1,$data['barang_id']);

   // menampilkan data nama mahasiswa
   xlsWriteLabel($noBarisCell,2,$data['nama']);

   // menampilkan data nilai
   xlsWriteNumber($noBarisCell,3,$data['b_2']);
   xlsWriteNumber($noBarisCell,4,$data['b_1']);
   xlsWriteNumber($noBarisCell,5,$data['b1']);
   xlsWriteNumber($noBarisCell,6,$data['rata_rata']);
   // menentukan status kelulusan
   //if ($data['nilai'] >= 60) $status = "LULUS";
   //else $status = "TIDAK LULUS";

  
   // increment untuk no. baris cell dan no. urut data
   $noBarisCell++;
   $noData++;
}

// memanggil function penanda akhir file excel
xlsEOF();
exit();

?>
