<?php

	$my = date("m/Y");
	$thn= date("Y");
	$bln = date("m") + 0;
	$q = mysql_query("SELECT DISTINCT(kode_obat) FROM resep WHERE tgl LIKE '%$my' AND flags <> 4 AND flags <> 3 AND kode_obat <> '' ORDER BY kode_obat ASC");
	while ($r = mysql_fetch_array($q))
	{
		$q_resep = mysql_query("SELECT SUM(diberi) FROM resep WHERE kode_obat = '$r[kode_obat]' AND flags <> 4 AND flags <> 3 AND kode_obat <> '' AND tgl LIKE '%$my'");
		$r_resep = mysql_fetch_array($q_resep);
		
		$diberi = $r_resep['SUM(diberi)'];
		
		//$q_ms = myql_query ("SELECT * FROM ms_barang FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
		//$r_ms = mysql_fetch_array ($q_ms);
		
		$q_amc = mysql_query ("SELECT * FROM amc WHERE barang_id = '$r[kode_obat]' AND tahun ='$thn'");
		$r_amc = mysql_fetch_array ($q_amc);
		if (!$r_amc)
		{
			$bulan = "b".$bln;
			$q_masuk = "INSERT INTO amc (barang_id, $bulan, tahun, rata_rata) VALUES ('$r[kode_obat]', '$diberi', '$thn', '$diberi')";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{
			$n = 0;
			$jml = 0;
			for($i=1;$i<=12;$i++)
			{
				if ($r_amc['b'.$i]==null)
				{
					echo "";
				}
				else
				{
					$jml = $jml + $r_amc['b'.$i];
					$n++;
				}
			}	
			
			$rata = $jml / $n;
			$rata2 = ceil($rata);
			$bulan = "b".$bln;
			$q_masuk = mysql_query ("UPDATE amc SET $bulan = '$diberi', 
													rata_rata = '$rata2'
													WHERE barang_id = '$r_amc[barang_id]' AND tahun = '$r_amc[tahun]'"); 
		}
		
		
	}
	
	
	//query racik detail
	
	$qr = mysql_query ("SELECT DISTINCT(kode_obat) FROM racik_detail WHERE tgl LIKE '%$my' AND flags <> 3 AND flags <> 4 ORDER BY kode_obat ASC");
	while ($rr = mysql_fetch_array($qr))
	{
		$q_racik = mysql_query("SELECT SUM(qty) FROM racik_detail WHERE kode_obat = '$rr[kode_obat]' AND flags <> 4 AND flags <> 3 AND tgl LIKE '%$my'");
		$r_racik = mysql_fetch_array($q_racik);
		
		
		$q_amc = mysql_query ("SELECT * FROM amc WHERE barang_id = '$rr[kode_obat]' AND tahun ='$thn'");
		$r_amc = mysql_fetch_array ($q_amc);
		$j_b = $r_amc['b'.$bln];
		
		
		$q_gabung = mysql_query ("SELECT DISTINCT(kode_obat) FROM resep WHERE kode_obat='$rr[kode_obat]' AND flags<>4 AND flags <>3 AND tgl LIKE '%$my' ORDER BY kode_obat ASC");
		$r_gabung = mysql_fetch_array($q_gabung);
		
		if (!$r_gabung['kode_obat'])
		{
			$qty = $r_racik['SUM(qty)'];
		}
		else
		{
			$qty = $r_racik['SUM(qty)'] + $j_b;
		}
		//echo $r_amc['barang_id'] . " jumlah: ".$j_b ." + " .$r_racik['SUM(qty)']. "= " .$qty."<br>";
		
		
		if (!$r_amc)
		{
			$bulan = "b".$bln;
			$q_masuk = "INSERT INTO amc (barang_id, $bulan, tahun, rata_rata) VALUES ('$rr[kode_obat]', '$qty', '$thn', '$qty')";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{
			$bulan = "b".$bln; 
			$q_masuk = mysql_query ("UPDATE amc SET $bulan = '$qty'
													WHERE barang_id = '$r_amc[barang_id]' AND tahun = '$r_amc[tahun]'");
			
			
			$q_amc2 = mysql_query ("SELECT * FROM amc WHERE barang_id = '$rr[kode_obat]' AND tahun ='$thn'");
			$r_amc2 = mysql_fetch_array ($q_amc2);
													
			$n = 0;
			$jml = 0;
			for($i=1;$i<=12;$i++)
			{
				if ($r_amc2['b'.$i]==null)
				{
					echo "";
				}
				else
				{
					$jml = $jml + $r_amc2['b'.$i];
					$n++;
				}	
			}
			
			$rata = $jml / $n;
			$rata2 = ceil($rata);
			
			
			$q_masuk2 = mysql_query ("UPDATE amc SET rata_rata = '$rata2'
													WHERE barang_id = '$r_amc2[barang_id]' AND tahun = '$r_amc2[tahun]'");
			
		}
	}
?>