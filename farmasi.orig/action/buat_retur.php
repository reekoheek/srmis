<?php
	$id=$_GET['id'];
	$No_SPP=$_GET['No_SPP'];
	$q=mysql_query("UPDATE permintaan_unitdetail SET status_detail='6' WHERE id='$id'");
	//$r=mysql_fetch_array($q);
	print "<script>alert('Retur Berhasil.');location.href='home.php?hal=content/lihat_status_spp&No_SPP=$No_SPP'</script>";
?>