<?php
	
	
	if ($_POST['no_racik'])
	{
	$no_racik = $_POST['no_racik'];
	$id = $_POST['id'];
	$pasien_id = $_POST['pasien_id'];
	$param_no = $_POST['param_no'];
	$no_resep = $_POST['no_resep'];
	$kd_barang = $_POST['kd_barang'];
	$fld02 = $_POST['fld02'];
	$nama=$_POST['nama'];
	$sub_margin=$_POST['sub_margin'];
	
	}
	
	elseif ($_GET['no_racik'])
	{
	$no_racik = $_GET['no_racik'];
	
	$pasien_id = $_GET['pasien_id'];
	$param_no = $_GET['param_no'];
	$no_resep = $_GET['no_resep'];
	$kd_barang = $_GET['kd_barang'];
	$fld02 = $_GET['fld02'];
	$nama=$_GET['nama'];
	$sub_margin=$_GET['sub_margin'];
	}
	
	$qb = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kd_barang'");
	$rb = mysql_fetch_array($qb);
	$qq2=mysql_query("SELECT * FROM racik_head WHERE no_racik='$no_racik'");
	$rq2=mysql_fetch_array($qq2);
	
	if (!$rq2['nama'])
	{
		$query3=mysql_query("UPDATE racik_head SET nama='".$_POST['nama_racikan']."', dosis_id='".$_POST['dosis_id']."', ket='".$_POST['ket']."'
				, deskripsi='".$_POST['deskripsi']."', biaya_racik='".$_POST['biaya_racik']."' WHERE no_racik='$no_racik'");
	}
	
	print "<script>location:PopupCenter('content/input_racik_obat_lab.php?no_racik=$no_racik&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&fld02=$fld02&nama=$nama&sub_margin=$sub_margin&pop=0', 'myPop1',800,400);</script>";

	print "<script>location='home.php?hal=content/racik_obat_lab&no_racik=$no_racik&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&fld02=$fld02&nama=$nama&sub_margin=$sub_margin&pop=$pop'</script>";
?>