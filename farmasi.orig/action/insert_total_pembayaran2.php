<?
session_start();

include("../include/koneksi.php");
include("../include/fungsi_rp.php");

?>

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
$tgl=date("Y-m-d");
$usercreated=$_SESSION['U_USER'];
$no_trans=$_GET['no_transaksi'];
$total=$_GET['total'];
$bayar=$_GET['bayar'];
$no_resep=$_GET['no_resep'];
$paramno=$_GET['paramno'];
$namapas=$_GET['namapas'];
$id_pasien=$_GET['id_pasien'];

$cari=mysql_query("select * from penjualan_head where no_trans='$no_trans'");
$num_cari=mysql_num_rows($cari);
/* if ($num_cari<1)
{ 
$sql="insert into penjualan_head (no_trans,no_resep,pasien_id,tgl,created_datetime,created_user,flags,fld01,param_no) values('$no_trans','$no_resep','$id_pasien','".$tgl."',now(),'$usercreated','".$flg."','$namapas','$paramno')";
mysql_query($sql);  */

mysql_query("update penjualan_head set flags='$flg',fld01='$namapas',total='$total',bayar='$bayar',status=1 where no_trans='$no_trans'");

mysql_query("update resep_head set status_bayar=1 where no_resep='$no_resep'");
//}

?>
<script>PopupCenter('../content/cetak_struk_penjualan2.php?no_transaksi=<? echo $no_trans; ?>','myPop1',800,800);</script>
<script>location.href='../content/kasir_tes2.php'</script>
</body >
</html>