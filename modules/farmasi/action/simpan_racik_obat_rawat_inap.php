<?php
	$no_resep=$_POST['no_resep'];
	$no_racik=$_POST['no_racik'];
	$grand=$_POST['grand']+500;
	$q = mysql_query("UPDATE racik_head SET total='$grand' WHERE no_racik='$no_racik'");
	//$r = mysql_query($q);
	//echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/resep_reg'>";
	$pasien_id=$_POST['pasien_id'];
	$param_no=$_POST['param_no'];
	$id_p=$_POST['id'];
	$nama=$_POST['nama'];
	
	$q2=mysql_query("SELECT * FROM racik_head WHERE no_racik='$no_racik'");
	$r2=mysql_fetch_array($q2);
	
	
	if ($_POST['fld02'])
	{
		$q=mysql_query("UPDATE resep SET sub_total='$grand' WHERE fld02 = '$no_racik'");
	}
	else
	{
	$date = date("d/m/Y");
	$q = "INSERT INTO resep (no_resep, pasien_id, tgl, dosis_id, ket, racikan, ket_banyak, sub_total,fld01,fld02,flags) 
		  VALUES ('$no_resep', '".$_POST['pasien_id']."',  '$date', '$r2[dosis_id]', '$r2[ket]', 'YA', '$r2[deskripsi]', '$grand', '$r2[nama]','$no_racik','3')";
	$r = mysql_query($q);
	
	$qpk=mysql_query("SELECT * FROM pasien WHERE id='$pasien_id'");
	$rpk=mysql_fetch_array($qpk);
	$nama_pas=$rpk['nama'];
	}
	print "<script>alert('Data Telah Di Simpan .');location.href='home.php?hal=content/resep_reg_rawat_inap&no_racik=$no_racik&id=$pasien_id&pasien_id=$pasien_id&param_no=$param_no&no_resep=$no_resep&nama=$nama'</script>";
?>