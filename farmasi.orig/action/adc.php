<?php
	$my = date("m/Y");
	$thn= date("Y");
	$bln = date("m") + 0;
	$my = date ("m/Y");
	$bulan = "b".$bln;
	$rbulan = "rb".$bln;
	$query = mysql_query ("SELECT * FROM amc WHERE tahun = '$thn' AND $bulan <> '' ORDER BY barang_id ASC");
	while ($result = mysql_fetch_array($query))
	{
		$count_resep = 0;
		$q = mysql_query("SELECT DISTINCT(tgl) FROM resep WHERE kode_obat = '$result[barang_Id]'");
		while ($r = mysql_fetch_array ($q))
		{
			$count_resep++;
		}
		$adc = $result[$bulan];
		
		$jml_rata = ceil($adc/$count_resep);
		
		//echo "Kode : " .$result['barang_id']." Rata-rata : ".$jml_rata."<br>";
		$q_adc = mysql_query ("SELECT * FROM adc WHERE barang_id = '$result[barang_id]'");
		$r_adc = mysql_fetch_array ($q_adc);
		if (!$r_adc)
		{
			$q_masuk = "INSERT INTO adc (barang_id, $rbulan, tahun) VALUES ('$result[barang_id]', '$jml_rata', $thn)";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{
			$q_masuk = mysql_query ("UPDATE adc SET $rbulan = '$jml_rata', tahun = '$thn' WHERE barang_id = '$result[barang_id]'");
		}
	}
?>