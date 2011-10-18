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
$no_resep=$_POST['no_resep'];
$nama=$_POST['nama'];
$pasien_id=$_POST['pasien_id'];
$grand=$_POST['grand'];
$q = mysql_query("UPDATE resep_head SET flags='1',grand_total = '$grand' WHERE no_resep='$no_resep'");

?>
<script>PopupCenter('content/cetak_resep_rawat_jalan.php?no_resep=<? echo $no_resep; ?>&pasien_id=<? echo $pasien_id; ?>&nama=<? echo $nama; ?>','myPop1',800,800);</script>
<script>location.href='home.php?hal=content/resep_reg_rawat_jalan'</script>
</body >
</html>