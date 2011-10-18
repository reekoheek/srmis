<html>
<head>
<!-- pop up jquery -->
<link rel="stylesheet" href="include/general.css" type="text/css" media="screen" />
<script src="include/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="include/popup.js" type="text/javascript"></script>
<script src="include/popup2.js" type="text/javascript"></script>
<!-- end pop up jquery-->


<!-- pop up windows-->
<script>
function PopupCenter(pageURL, title,w,h) {
//var left = (screen.width/2)-(w/2);
//var top = (screen.height/2)-(h/2);
var targetWin = window.open 
//(pageURL, title, 'toolbar=no, alwaysraised=yes, fullscreen=true location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top='+top+', left='+left);
(pageURL, title, 'toolbar=no, alwaysraised='+1+', fullScreen=no, locationbar=no, location=0, directories=no, status=no, menubar=0, scrollbars=yes, resizable=0, copyhistory=0, width=300, height=500, top=100, left=400');
this.targetWin.focus();
}
</script>
</head>
<body>

<?
$no_trans=$_GET['no_transaksi'];
$total=$_GET['total'];
$bayar=$_GET['bayar'];
$id_resep=$_GET['no_resep'];
$param=$_GET['paramno'];
$namapas=$_GET['namapas'];


$tgl=date("Y-m-d");
mysql_query("update resep_head set status_bayar='Sudah Dilayani' where no_resep='$id_resep'");
mysql_query("insert into penjualan_head (no_trans,no_resep,tgl,param_no,pasien_id,created_datetime,created_user,flags,fld01,total,bayar) values('$no_trans','$id_resep','$tgl','$param','$namapas',now(),'$_SESSION[U_USER]','1','$namapas','$total','$bayar')");

$sss=mysql_query("select * from resep where no_resep='$id_resep'");
while($d_sss=mysql_fetch_array($sss))
{
	$k_obat=$d_sss['kode_obat'];
	$dosis=$d_sss['dosis_id'];
	$jml=$d_sss['diberi'];
	$kete=$d_sss['ket'];
	$rck=$d_sss['racikan'];
	$kban=$d_sss['ket_banyak'];
	$subt=$d_sss['sub_total'];
	if($rck=='YA')
	{
	 $k_racik=$d_sss['fld02'];
	 }
	 else
	 {
	 $k_racik='-';
	 }
	
$strSQL="insert into penjualan (no_trans,no_resep,obat_id,dosis_id,diberi,ket,racikan,ket_banyak,sub_total,fld01,fld03) values('$no_trans','$id_resep','$k_obat','$dosis','$jml','$kete','$rck','$kban','$subt','$namapas','k_racik')";
mysql_query($strSQL) or die($strSQL);

 }


?>
<script>PopupCenter('content/cetak_struk_penjualan.php?no_transaksi=<? echo $no_trans; ?>','Cetak Struk',200,100);</script>
<script>location.href='home.php?hal=content/menu_kasir'</script>
</body >
</html>