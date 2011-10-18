<?php
	
	$query = mysql_query ("SELECT * FROM ms_barang");
	while ($result=mysql_fetch_array($query))
	{
		$my = date("d/m/Y");
		$thn= date("Y");
		$bln = date("m") + 0;
		$param_spb = date ("Y-m");
		
		$query_param_resep = mysql_query("SELECT DISTINCT(kode_obat) FROM resep WHERE tgl LIKE '%$my' AND flags <> 4 AND flags <> 3 AND kode_obat <> '' AND kode_obat = '$result[kd_barang]' ORDER BY kode_obat ASC");	
		$result_param_resep = mysql_fetch_array($query_param_resep);
		
		//jika ada maka safety stock di hitung berdasarkan penjualan, jika tidak maka default
		if ($result_param_resep)
		{
			$q = mysql_query("SELECT DISTINCT(kode_obat) FROM resep WHERE tgl LIKE '%$my' AND flags <> 4 AND flags <> 3 AND kode_obat <> '' AND kode_obat = '$result[kd_barang]' ORDER BY kode_obat ASC");
			
			while ($r = mysql_fetch_array($q))
			{
				$q_resep = mysql_query("SELECT SUM(diberi) FROM resep WHERE kode_obat = '$r[kode_obat]' AND flags <> 4 AND flags <> 3 AND kode_obat <> '' AND tgl LIKE '%$my'");
				$r_resep = mysql_fetch_array($q_resep);
		
				$diberi = $r_resep['SUM(diberi)'];
		
				//$q_ms = myql_query ("SELECT * FROM ms_barang FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
				//$r_ms = mysql_fetch_array ($q_ms);
				
				$q_spb = mysql_query("SELECT * FROM detail_spb WHERE LAST_INSERT_ID(barang_id) AND barang_id = '$result[id]'");		
				$r_spb = mysql_fetch_array($q_spb);
				
				if ($r_spb)
				{
					$pesan = strtotime($r_spb['created_datetime']);
					$diterima = strtotime($r_spb['update_datetime']);
					$diff = abs($diterima - $pesan);
					$hari = ceil($diff/86400);
					$safety_hari = $hari;
					$jumlah_safety = $hari * $diberi;
				
				}
				else
				{
					//default safety
					$jumlah_sefety = ceil((40/100) * $result['stok']);
					$safety_hari = 1;
					$hari = 1;
				}
		
				$q_safety = mysql_query ("SELECT * FROM safety_stock WHERE barang_id = '$result[id]' AND tahun ='$thn'");
				$r_safety = mysql_fetch_array ($q_safety);
				if (!$r_safety)
				{
					
					$bulan = "b".$bln;
					$sh = "sh".$bln;
					$lt = "lt".$bln;
					$q_masuk = "INSERT INTO safety_stock (barang_id, $bulan, $sh, tahun, $lt) VALUES ('$result[id]', '$jumlah_safety', '$safety_hari', '$thn', '$hari')";
					$r_masuk = mysql_query($q_masuk);
				}
				else
				{
					
					$bulan = "b".$bln;
					$sh = "sh".$bln;
					$lt = "lt".$bln;
					$q_masuk = mysql_query ("UPDATE safety_stock SET $bulan = '$jumlah_safety',
																	 $sh = '$safety_hari',
																	 $lt = '$hari'
																	 WHERE barang_id = '$r_safety[barang_id]' AND tahun = '$r_safety[tahun]'"); 
				}

			}

		}	
		//jika tidak ada di penjualan
		else
		{
			$q_spb = mysql_query("SELECT * FROM detail_spb WHERE LAST_INSERT_ID(barang_id) AND barang_id = '$result[id]' ORDER BY barang_id DESC LIMIT 1");		
			$r_spb = mysql_fetch_array($q_spb);
				
		/*	if ($r_spb)
			{
				$pesan = strtotime($r_spb['created_datetime']);
				
				$diterima = strtotime($r_spb['update_datetime']);
				
				
				$diff = abs($diterima - $pesan);
				$hari = ceil($diff/86400);
				$safety_hari = $hari;	
				$jumlah_safety = $hari * ceil((40/100) * $result['stok']);
			}
			else
			{*/
				//default safety
				$jumlah_safety = ceil((40/100) * $result['stok']);
				$safety_hari = 1;
				$hari = 1;
			//}
		
			$q_safety = mysql_query ("SELECT * FROM safety_stock WHERE barang_id = '$result[id]' AND tahun ='$thn'");
			$r_safety = mysql_fetch_array ($q_safety);
			if (!$r_safety)
			{
					
				$bulan = "b".$bln;
				$sh = "sh".$bln;
				$lt = "lt".$bln;
				$q_masuk = "INSERT INTO safety_stock (barang_id, $bulan, $sh, tahun, $lt) VALUES ('$result[id]', '$jumlah_safety', '$safety_hari', '$thn', '$hari')";
				$r_masuk = mysql_query($q_masuk);
			}
			else
			{	
				
				$bulan = "b".$bln;
				$sh = "sh".$bln;
				$lt = "lt".$bln;
				$q_masuk = mysql_query ("UPDATE safety_stock SET $bulan = '$jumlah_safety',
																 $sh = '$safety_hari',
																 $lt = '$hari'
																 WHERE barang_id = '$r_safety[barang_id]' AND tahun = '$r_safety[tahun]'"); 
			}
				
		}	
			
	}
	
	
	
	
	//query racik detail
	/*
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
	*/
?>