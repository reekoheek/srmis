<?php
	$thn = date ("Y");
	$bln = date("m") + 0;
	$my = date ("m/Y");
	$bulan = "b".$bln;
	
	/*$q = mysql_query ("SELECT * FROM safety_stock WHERE tahun = '$thn'");
	while ($r = mysql_fetch_array ($q))
	{
		
		$q_ms = mysql_query ("SELECT * FROM ms_barang WHERE id = '$r[barang_id]'");
		$r_ms = mysql_fetch_array($q_ms);
		//echo $r_ms['kd_barang'];
		
		$q_adc = mysql_query ("SELECT * FROM adc WHERE barang_id = '".$r_ms['kd_barang']."'");
		$r_adc = mysql_fetch_array ($q_adc);
		echo $r_adc['barang_id'];
	}*/
	
	$q2 = mysql_query ("SELECT * FROM adc WHERE tahun = '$thn'");
	while ($r2 = mysql_fetch_array ($q2))
	{
		//echo $r2['barang_id'];
		$q_ms = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$r2[barang_id]'");
		$r_ms = mysql_fetch_array($q_ms);
		
		echo $r_ms['id'];
		$q_adc = mysql_query ("SELECT * FROM safety_stock WHERE barang_id = '".$r_ms['id']."'");
		$r_adc = mysql_fetch_array ($q_adc);
		echo $r_adc['barang_id'];
	}
	
?>