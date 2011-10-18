<?php

// nama file
include "../include/koneksi.php";
$namaFile = "lap_distribusi_unit.xls";
$tgl_mulai=$_POST['tgl_mulai'];
$tgl_selesai=$_POST['tgl_selesai'];

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
$d1=substr($tgl_mulai,0,2);
$m1=substr($tgl_mulai,3,2);
$y1=substr($tgl_mulai,6,4);
$d2=substr($tgl_selesai,0,2);
$m2=substr($tgl_selesai,3,2);
$y2=substr($tgl_selesai,6,4);

$tanggal_start=$y1."-".$m1."-".$d1;
$tanggal_end=$y2."-".$m2."-".$d2;
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
xlsWriteLabel(0,0,"DISTRIBUSI UNIT $jenis, Tertanggal : $tgl_mulai - $tgl_selesai")->MergeCells = True;  
xlsWriteLabel(1,0,"NO");               

// mengisi pada cell A2 (baris ke-0, kolom ke-1)
xlsWriteLabel(1,1,"NO SPP");              

// mengisi pada cell A3 (baris ke-0, kolom ke-2)
xlsWriteLabel(1,2,"NO BPB");

// mengisi pada cell A4 (baris ke-0, kolom ke-3)
xlsWriteLabel(1,3,"NO BTB");   

// mengisi pada cell A5 (baris ke-0, kolom ke-4)
xlsWriteLabel(1,4,"NAMA"); 
xlsWriteLabel(1,5,"DIMINTA"); 
xlsWriteLabel(1,6,"DIBERI"); 
//xlsWriteLabel(1,7,"UNIT"); 
/*xlsWriteLabel(2,8,"RI"); 
xlsWriteLabel(2,9,"IGD"); 
xlsWriteLabel(2,10,"OCA"); 
xlsWriteLabel(2,11,"JUMLAH"); */
// -------- menampilkan data --------- //

// koneksi ke mysql

// query menampilkan semua data

$query = "SELECT * FROM permintaan_unitdetail,permintaan_unit,pelayanan WHERE permintaan_unit.No_SPP=permintaan_unitdetail.No_SPP AND 
		  permintaan_unitdetail.Unit=pelayanan.id AND permintaan_unitdetail.status_detail <> '0' AND permintaan_unit.create_date BETWEEN '$tanggal_start' AND '$tanggal_end'  AND pelayanan.unit_id = '".$_POST['unit']."'
		  ORDER BY permintaan_unitdetail.No_SPP ASC";
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
   xlsWriteLabel($noBarisCell,1,$data['No_SPP']);

   // menampilkan data nama mahasiswa
   xlsWriteLabel($noBarisCell,2,$data['No_BPB']);

   // menampilkan data nilai
   xlsWriteLabel($noBarisCell,3,$data['No_BTB']);
   xlsWriteLabel($noBarisCell,4,$data['Nm_Barang']);
   xlsWriteNumber($noBarisCell,5,$data['Qty']);
   xlsWriteNumber($noBarisCell,6,$data['Qty_diberi']);
   //xlsWriteLabel($noBarisCell,7,$data['jenis']);
   // menentukan status kelulusan
   //if ($data['nilai'] >= 60) $status = "LULUS";
   //else $status = "TIDAK LULUS";

   // menampilkan status kelulusan
  /* xlsWriteNumber($noBarisCell,4,$data['harga_dosp']);
   xlsWriteNumber($noBarisCell,5,$data['stok_ms']);
   xlsWriteNumber($noBarisCell,6,$data['stok_apt']);
   xlsWriteNumber($noBarisCell,7,$data['stok_rj']);
   xlsWriteNumber($noBarisCell,8,$data['stok_ri']);
   xlsWriteNumber($noBarisCell,9,$data['stok_igd']);
   xlsWriteNumber($noBarisCell,10,$data['stok_oca']);
   xlsWriteNumber($noBarisCell,11,$data['jumlah']);*/
   // increment untuk no. baris cell dan no. urut data
   $noBarisCell++;
   $noData++;
}

// memanggil function penanda akhir file excel
xlsEOF();
exit();

?>
