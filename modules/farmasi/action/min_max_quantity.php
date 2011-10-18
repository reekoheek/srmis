<?php
	$thn = date("Y");
	$bln = date ("m");
	$rbulan = "rb".$bulan;
	/*$q = mysql_query ("SELECT * FROM amc,ms_barang WHERE amc.barang_id = ms_barang.kd_barang AND amc.tahun = '$tahun'");
	while ($r=mysql_fetch_array($q))
	{
		$min = $r['stok_min'] * $r['rata_rata'];
		$max = $r['stok_max'] * $r['rata_rata'];
		//echo "min nya :". $min .", max nya : ". $max . "<br>";
		//echo $r['id'];
		$q_qty = mysql_query ("SELECT * FROM quantity WHERE barang_id = '$r[id]'");
		$r_qty = mysql_fetch_array ($q_qty);
		if (!$r_qty)
		{
			$q_masuk = "INSERT INTO quantity (barang_id, min_qty, max_qty) VALUES ('$r[id]', '$min', '$max')";
			$r_masuk = mysql_query($q_masuk);
		} 
		else
		{
			$q_masuk = mysql_query("UPDATE quantity SET min_qty = '$min', max_qty = '$max' WHERE barang_id = '$r[id]'");
		}
	}*/
	
	$q = mysql_query ("SELECT * FROM stok_level");
	while ($r=mysql_fetch_array($q))
	{
		$q_ms = mysql_query ("SELECT * FROM ms_barang WHERE id = '$r[barang_id]'");
		$r_ms = mysql_fetch_array ($q_ms);
		
		$q_amc = mysql_query ("SELECT * FROM amc WHERE barang_id = '$r_ms[kd_barang]' AND tahun = '$thn'");
		$r_amc = mysql_fetch_array ($q_amc);
		
		//$q_amc = mysql_query ("SELECT * FROM adc WHERE barang_id = '$r_ms[kd_barang]' AND tahun = '$thn'");
		//$r_amc = mysql_fetch_array ($q_amc);
		if ($r_amc)
		{
			$rata = $r_amc['rata_rata'];
			//$rata = $r_amc[$bulan];
		}
		else
		{
			$rata = 1;
		}
		$min = $r['min_stock_lv'] * $rata;
		$max = $r['max_stock_lv'] * $rata;
		//echo "min nya :". $min .", max nya : ". $max . "<br>";
		//echo $r['id'];
		$q_qty = mysql_query ("SELECT * FROM quantity WHERE barang_id = '$r[barang_id]'");
		$r_qty = mysql_fetch_array ($q_qty);
		if (!$r_qty)
		{
			$q_masuk = "INSERT INTO quantity (barang_id, min_qty, max_qty) VALUES ('$r[barang_id]', '$min', '$max')";
			$r_masuk = mysql_query($q_masuk);
		} 
		else
		{
			$q_masuk = mysql_query("UPDATE quantity SET min_qty = '$min', max_qty = '$max' WHERE barang_id = '$r[barang_id]'");
		}
	}
?>