<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
(pageURL, title, 'toolbar=no, alwaysraised='+1+', fullScreen=0, locationbar=no, location=0, directories=0, status=no, menubar=0, scrollbars=yes, resizable=0, copyhistory=0, width=600, height=screen.availHeight.MAX_VALUE, top=0, left=200');
this.targetWin.focus();
}
</script>

<title>Untitled Document</title>
</head>
<?php

$tgl1=$_POST['tgl1'];
$tgl2=$_POST['tgl2'];
$shift=$_POST['shifting'];
?>
<body>
<script>PopupCenter('content/lap_kasir_pdf.php?tgl1=<? echo $tgl1; ?>&tgl2=<? echo $tgl2; ?>&shift=<? echo $shift; ?>','Laporan Transaksi',600,600);</script>
<script>alert('Kembali ke Halaman Menu Laporan Kasir');location.href='home.php?hal=content/lap_kasir&tgl=<? echo $tgl1; ?>'</script>
</body>
</html>
