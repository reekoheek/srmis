<?php

// nama file
include "../include/koneksi.php";
$namaFile = "lap_stok_opname.xls";
$tgl=$_POST['tgl'];
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
xlsWriteLabel(0,0,"STOK OPNAME, Tertanggal : $tgl")->MergeCells = True;  
xlsWriteLabel(1,0,"NO");               

// mengisi pada cell A2 (baris ke-0, kolom ke-1)
xlsWriteLabel(1,1,"KODE");              

// mengisi pada cell A3 (baris ke-0, kolom ke-2)
xlsWriteLabel(1,2,"NAMA");

// mengisi pada cell A4 (baris ke-0, kolom ke-3)
xlsWriteLabel(1,3,"EXP");   

// mengisi pada cell A5 (baris ke-0, kolom ke-4)
xlsWriteLabel(1,4,"HARGA"); 
xlsWriteLabel(1,5,"MS"); 
xlsWriteLabel(1,6,"APT"); 
xlsWriteLabel(1,7,"RJ"); 
xlsWriteLabel(1,8,"RI"); 
xlsWriteLabel(1,9,"IGD"); 
xlsWriteLabel(1,10,"OCA"); 
xlsWriteLabel(1,11,"LAB"); 
xlsWriteLabel(1,12,"RAD"); 
xlsWriteLabel(1,13,"JUMLAH"); 
// -------- menampilkan data --------- //

// koneksi ke mysql

// query menampilkan semua data

$query = "SELECT * FROM stok_opname,ms_barang WHERE stok_opname.barang_id=ms_barang.id AND stok_opname.tgl='$tgl' ORDER BY nama ASC";
$hasil = mysql_query($query);

// nilai awal untuk baris cell
$noBarisCell = 1;

// nilai awal untuk nomor urut data
$noData = 1;

while ($data = mysql_fetch_array($hasil))
{
   // menampilkan no. urut data
   xlsWriteNumber($noBarisCell,0,$noData);

   // menampilkan data nim
   xlsWriteLabel($noBarisCell,1,$data['kd_barang']);

   // menampilkan data nama mahasiswa
   xlsWriteLabel($noBarisCell,2,$data['nama']);

   // menampilkan data nilai
   xlsWriteLabel($noBarisCell,3,$data['expire_date']);

   // menentukan status kelulusan
   //if ($data['nilai'] >= 60) $status = "LULUS";
   //else $status = "TIDAK LULUS";

   // menampilkan status kelulusan
   xlsWriteNumber($noBarisCell,4,$data['harga_dosp']);
   xlsWriteNumber($noBarisCell,5,$data['stok_ms']);
   xlsWriteNumber($noBarisCell,6,$data['stok_apt']);
   xlsWriteNumber($noBarisCell,7,$data['stok_rj']);
   xlsWriteNumber($noBarisCell,8,$data['stok_ri']);
   xlsWriteNumber($noBarisCell,9,$data['stok_igd']);
   xlsWriteNumber($noBarisCell,10,$data['stok_oca']);
    xlsWriteNumber($noBarisCell,11,$data['stok_lab']);
	 xlsWriteNumber($noBarisCell,12,$data['stok_rad']);
   xlsWriteNumber($noBarisCell,13,$data['jumlah']);
   // increment untuk no. baris cell dan no. urut data
   $noBarisCell++;
   $noData++;
}

// memanggil function penanda akhir file excel
xlsEOF();
exit();

?>
