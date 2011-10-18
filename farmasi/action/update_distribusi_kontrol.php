<?php
// get value of id that sent from address bar 
$kd_barang=$_GET['kd_barang'];
$id=$_GET['id'];
$No_SPP=$_GET['No_SPP'];
$status=$_GET['status'];
$No_BPB=$_GET['No_BPB'];
$id_ms=$_GET['id_ms'];
$no_SPP=$_POST['no_SPP'];
$stat=$_POST['stat'];

if($status==4)
{
	$q=mysql_query("UPDATE permintaan_unit SET status=0 WHERE No_SPP='$no_SPP'");
	print "<script>alert('Data Telah di Cancel.');location.href='home.php?hal=content/distribusi_kontrol&No_SPP=$No_SPP&No_BPB=$No_BPB'</script>";

}

else if($status==2)
{
	$qq=mysql_query("SELECT * FROM ms_barang WHERE id='$id_ms'");
	$rq=mysql_fetch_array($qq);
	$stok_ms=$rq['stok'];
	
	$qu=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id='$id'");
	$ru=mysql_fetch_array($qu);
	
	$qty=$ru['Qty'];
	
	$jml=$stok_ms-$qty;
	
	$q=mysql_query("UPDATE permintaan_unitdetail SET status_detail='2',No_BPB='$No_BPB' WHERE id='$id'");
	$q2=mysql_query("UPDATE ms_barang SET stok='$jml' WHERE id='$id_ms'");
	print "<script>alert('Data Berhasil di APPROVE.');location.href='home.php?hal=content/distribusi_kontrol&No_SPP=$No_SPP&No_BPB=$No_BPB'</script>";
}

else if ($status==3)
{
	$q=mysql_query("UPDATE permintaan_unitdetail SET status_detail=3 WHERE id='$id'");
	//$q2=mysql_query("UPDATE permintaan_unit SET status='8' WHERE No_SPP='$no_SPP'");

	print "<script>alert('Data Berhasil di Pending.');location.href='home.php?hal=content/distribusi_kontrol&No_SPP=$No_SPP&No_BPB=$No_BPB'</script>";

}

else
{
$q=mysql_query("SELECT * FROM permintaan_unitdetail WHERE id='$id'");
$r=mysql_fetch_array($q);

//$qty=$r['Qty'];

$q2=mysql_query("SELECT * FROM ms_barang WHERE id='$id_ms'");
$r2=mysql_fetch_array($q2);

//$stok=$r2['stok'];
//$back = $qty + $stok;

//$qu=mysql_query("UPDATE ms_barang SET stok = '$back' WHERE kd_barang='$kd_barang'");
// Delete data in mysql from row that has this id
$sql="UPDATE permintaan_unitdetail SET flags='0' WHERE id='$id'";
$result=mysql_query($sql);

// if successfully deleted
if($result){

print "<script>alert('Data Berhasil di Cancel.');location.href='home.php?hal=content/distribusi_kontrol&No_SPP=$No_SPP&No_BPB=$No_BPB'</script>";
}

else {
echo "ERROR";
}
}

?>