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
$jenis_ket=$_POST['jenis_ket'];
$q22 = mysql_query("UPDATE resep_head SET flags='1', grand_total='$grand' WHERE no_resep='$no_resep'");

/*
$q2=mysql_query("SELECT * FROM simrs.pasien,simrs.radio_kunjungan WHERE pasien.id=radio_kunjungan.pasien_id AND pasien.id='$pasien_id'");
$r2=mysql_fetch_array($q2);

$cara_masuk=$r2['cara_masuk'];

$qp= mysql_query("SELECT * FROM resep_head WHERE LAST_INSERT_ID(param_no)  AND cara_masuk='$cara_masuk' ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);


$tanggal_sekarang=date("d/m/Y");
//$month=substr($rp['tgl'],3,2);
$date=date("m");

$tgl = substr($rp['tgl'],3,2);


if ($tgl == $date)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

//cek untuk ketersediaan record
if (!$rp)
{
	$temp = 1;
	$count = $temp;
}


$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);



if($cara_masuk=="IGD")
{
	$kd="IGD/";
}
elseif($cara_masuk=="RAWAT JALAN")
{
	$kd="RRJ/";
}
elseif($cara_masuk=="RAWAT INAP")
{
	$kd="RRI/";
}
elseif($cara_masuk=="PASIEN LUAR")
{
	$kd="RPU/";
}
else
{
	$kd="OCA/";
}

$no_resep = $kd . date("dmy")."$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;


$q="INSERT INTO resep_head(no_resep, param_no, pasien_id, created_datetime, created_user,tgl,cara_masuk) VALUES('$no_resep', '$param_no', '$id_pasien', now(), 
	'".$_SESSION['U_USER']."','$tanggal_sekarang','$cara_masuk')";
$r=mysql_query($q);
*/
?>
<script>PopupCenter('content/cetak_resep_apt.php?no_resep=<? echo $no_resep; ?>&pasien_id=<? echo $pasien_id; ?>&nama=<? echo $nama; ?>','myPop1',800,800);</script>
<script>location.href='home.php?hal=content/pasien'</script>
</body >
</html>