<?php

	$my = date("m/Y");
	$thn= date("Y");
	$bln = date("m") + 0;
	$bln_1 =date("m") - 1;
	$bln_2  =  date("m") - 2;
	//echo $bln_2;
	$my_1 = date($bln_1."/Y");
	$my_2 = date ($bln_2."/Y");
	
//	$q = mysql_query("SELECT DISTINCT(kode_obat) FROM resep WHERE (tgl LIKE '%$my' OR tgl LIKE '%$my_1' OR tgl LIKE '%$my_2') AND (flags = '1' OR flags ='0') AND kode_obat <> '' ORDER BY kode_obat ASC");
	$q = mysql_query("select DISTINCT(kode_obat) from resep WHERE (flags = '1' OR flags ='0') AND kode_obat <> '' ORDER BY kode_obat ASC");
	while ($r = mysql_fetch_array($q))
	{
		
		$q_resep_b = mysql_query("select SUM(diberi) from resep where tgl LIKE '%$my' AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r[kode_obat]' ORDER BY kode_obat ASC");
		$r_resep_b = mysql_fetch_array($q_resep_b);
		
		if ($r_resep_b['SUM(diberi)'])
		{
			$n = 1;
			$diberi_b = $r_resep_b['SUM(diberi)'];
		}
		else
		{
			$n = 0;
			$diberi_b = 0;
		}
		
		
		
		$q_resep_b_1 = mysql_query("select SUM(diberi) from resep where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-1 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r[kode_obat]' ORDER BY kode_obat ASC");
		$r_resep_b_1 = mysql_fetch_array($q_resep_b_1);
		if ($r_resep_b_1['SUM(diberi)'])
		{
			$n_1 = 1;
			$diberi_b_1 = $r_resep_b_1['SUM(diberi)'];
		}
		else
		{
			$n_1 = 0;
			$diberi_b_1 = 0;
		}
		
		
		$q_resep_b_2 = mysql_query("select SUM(diberi) from resep where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-2 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r[kode_obat]' ORDER BY kode_obat ASC");
		$r_resep_b_2 = mysql_fetch_array($q_resep_b_2);
		if ($r_resep_b_2['SUM(diberi)'])
		{
			$n_2 = 1;
			$diberi_b_2 = $r_resep_b_2['SUM(diberi)'];
		}
		else
		{
			$n_2 = 0;
			$diberi_b_2 = 0;
		}
		
		
		
		
		$j_n = $n + $n_1 + $n_2;
		$rata = ceil(($diberi_b + $diberi_b_1 + $diberi_b_2) / 3);
		
		$q_amc = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$r[kode_obat]' AND tahun ='$thn'");
		$r_amc = mysql_fetch_array ($q_amc);
		if (!$r_amc)
		{
			//$bulan = "b".$bln;
			$q_masuk = "INSERT INTO amc2 (barang_id, b1, b_1, b_2, tahun, rata_rata) VALUES ('$r[kode_obat]', '$diberi_b', '$diberi_b_1', '$diberi_b_2','$thn', '$rata')";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{	
			
			$q_masuk = mysql_query ("UPDATE amc2 SET b1 = '$diberi_b',
													b_1 = '$diberi_b_1',
													b_2 = '$diberi_b_2', 
													rata_rata = '$rata'
													WHERE barang_id = '$r_amc[barang_id]' AND tahun = '$r_amc[tahun]'"); 
		}
		
	$q_amc22 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$r[kode_obat]' AND tahun ='$thn'");
	$r_amc22 = mysql_fetch_array ($q_amc22);
	
	if ((($r_amc22['b1']==0) AND ($r_amc22['b_1']==0)) OR (($r_amc22['b1']==0) AND ($r_amc22['b_2']==0)) OR (($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0)))
		{
			$jj =1;
		}
	
	elseif (($r_amc22['b1']==0) OR ($r_amc22['b_1']==0) OR ($r_amc22['b_2']==0))
	{
		$jj =2;
	}
		elseif (($r_amc22['b1']==0) AND ($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0))
		{
		//	$jj=0;
		}
		else
		{
			$jj=3;
		}
		
		$rata2 = ceil(($diberi_b + $diberi_b_1 + $diberi_b_2) / $jj);
		$q_masuk = mysql_query ("UPDATE amc2 SET rata_rata = '$rata2'
													WHERE barang_id = '$r_amc22[barang_id]' AND tahun = '$r_amc22[tahun]'");	
	
	
	}
	
	
	
	
	
	
	
	
	//query racik detail
	
	$qr = mysql_query ("select DISTINCT(kode_obat) from racik_detail where flags = '1' OR flags ='0' ORDER BY kode_obat ASC");
	while ($rr = mysql_fetch_array($qr))
	{
		//$q_racik = mysql_query("SELECT SUM(qty) FROM racik_detail WHERE kode_obat = '$rr[kode_obat]' AND flags <> 4 AND flags <> 3 AND tgl LIKE '%$my'");
		//$r_racik = mysql_fetch_array($q_racik);
			
		$q_racik_b = mysql_query("select SUM(qty) from racik_detail where tgl LIKE '%$my' AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$rr[kode_obat]' ORDER BY kode_obat ASC");
		$r_racik_b = mysql_fetch_array($q_racik_b);
		if ($r_racik_b['SUM(qty)'])
		{
			$qty_b = $r_racik_b['SUM(qty)'];
			$n = 1;
		}
		else
		{
			$qty_b = 0;
			$n = 0;
		}
		
		
		
		$q_racik_b_1 = mysql_query("select SUM(qty) from racik_detail where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-1 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$rr[kode_obat]' ORDER BY kode_obat ASC");
		$r_racik_b_1 = mysql_fetch_array($q_racik_b_1);
		if ($r_racik_b_1['SUM(qty)'])
		{
			$qty_b_1 = $r_racik_b_1['SUM(qty)'];
			$n_1 = 1;
		}
		else
		{
			$qty_b_1 = 0;
			$n_1= 0;
		}
		
		
		$q_racik_b_2 = mysql_query("select SUM(qty) from racik_detail where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-2 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$rr[kode_obat]' ORDER BY kode_obat ASC");
		$r_racik_b_2 = mysql_fetch_array($q_racik_b_2);
		if ($r_racik_b_2['SUM(qty)'])
		{
			$qty_b_2 = $r_racik_b_2['SUM(qty)'];
			$n_2 = 1;
		}
		else
		{
			$qty_b_2 = 0;
			$n_2= 0;
		}
		
		
		
		//$j_b = $r_amc['b'.$bln];
		
		
		$q_gabung = mysql_query ("SELECT * FROM amc2 WHERE barang_id='$rr[kode_obat]'");
		$r_gabung = mysql_fetch_array($q_gabung);
		
		
		
		
		if (!$r_gabung['barang_id'])
		{
			$t_b = $qty_b;
			$t_b_1 = $qty_b_1;
			$t_b_2 = $qty_b_2;
		}
		
		$q_a = mysql_query ("SELECT * FROM amc2,resep WHERE amc2.barang_id = resep.kode_obat AND resep.kode_obat = '$rr[kode_obat]'");
		$r_a = mysql_fetch_array ($q_a);
		if ($r_a)
		{
			$t_b = $qty_b + $r_gabung['b1'];
			$t_b_1 = $qty_b_1 + $r_gabung['b_1'];
			$t_b_2 = $qty_b_2 + $r_gabung['b_2'];
		}
		else
		{
			$t_b = $qty_b;
			$t_b_1 = $qty_b_1;
			$t_b_2 = $qty_b_2;
		}
		//echo $r_amc['barang_id'] . " jumlah: ".$j_b ." + " .$r_racik['SUM(qty)']. "= " .$qty."<br>";
		$j_n2 = $n + $n_1 + $n_2;
		$rata2 = ceil(($t_b + $t_b_1 + $t_b_2) / 3);
		//echo $rr['kode_obat'] . " N :".$j_n2 ." Rata - rata  " .$rata2."<br>";
		$q_amc2 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$rr[kode_obat]' AND tahun ='$thn'");
		$r_amc2 = mysql_fetch_array ($q_amc2);
		
		if (!$r_amc2)
		{
			
			$q_masuk = "INSERT INTO amc2 (barang_id, b1, b_1, b_2, tahun, rata_rata) VALUES ('$rr[kode_obat]', '$t_b', '$t_b_1', '$t_b_2', '$thn', '$rata2')";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{
			 
			$q_masuk = mysql_query ("UPDATE amc2 SET b1 = '$t_b',
													 b_1 = '$t_b_1',
													 b_2 = '$t_b_2',
													 rata_rata = '$rata2'
													WHERE barang_id = '$r_amc2[barang_id]' AND tahun = '$r_amc2[tahun]'");
		}
	$q_amc22 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$rr[kode_obat]' AND tahun ='$thn'");
	$r_amc22 = mysql_fetch_array ($q_amc22);
	
	if ((($r_amc22['b1']==0) AND ($r_amc22['b_1']==0)) OR (($r_amc22['b1']==0) AND ($r_amc22['b_2']==0)) OR (($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0)))
		{
			$jj =1;
		}
	
	elseif (($r_amc22['b1']==0) OR ($r_amc22['b_1']==0) OR ($r_amc22['b_2']==0))
	{
		$jj =2;
	}
		elseif (($r_amc22['b1']==0) AND ($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0))
		{
			$jj=0;
		}
		else
		{
			$jj=3;
		}
		
		$rata2 = ceil(($t_b + $t_b_1 + $t_b_2) / $jj);
		$q_masuk = mysql_query ("UPDATE amc2 SET rata_rata = '$rata2'
													WHERE barang_id = '$r_amc22[barang_id]' AND tahun = '$r_amc22[tahun]'");	
		
													
	}
	
	
	
	
	
	
	
	
	//query distribusi obat
	
	$qro = mysql_query ("select DISTINCT(barang_id) from permintaan_unitdetail where status_detail = '9' ORDER BY barang_id ASC");
	while ($rro = mysql_fetch_array($qro))
	{
				
		$q_permintaan_b = mysql_query ("select SUM(Qty_diberi) from permintaan_unitdetail where tgl_terima LIKE '%$my' AND status_detail = '9' AND barang_id = '$rro[barang_id]' ORDER BY barang_id ASC");
		$r_permintaan_b = mysql_fetch_array($q_permintaan_b);
	
		if ($r_permintaan_b['SUM(Qty_diberi)'])
		{
			$qty_b = $r_permintaan_b['SUM(Qty_diberi)'];
			$n = 1;
		}
		else
		{
			$qty_b = 0;
			$n = 0;
		}
		
		
		$q_permintaan_b_1 = mysql_query ("select SUM(Qty_diberi) from permintaan_unitdetail where month(str_to_date(tgl_terima,'%d/%m/%Y')) between month(str_to_date(tgl_terima,'%d/%m/%Y'))-3 and month(now())-1 AND barang_id ='$rro[barang_id]' AND status_detail = '9' ORDER BY barang_id ASC");
		$r_permintaan_b_1 = mysql_fetch_array($q_permintaan_b_1);
		if ($r_permintaan_b_1['SUM(Qty_diberi)'])
		{
			$qty_b_1 = $r_permintaan_b_1['SUM(Qty_diberi)'];
			$n_1 = 1;
		}
		else
		{
			$qty_b_1 = 0;
			$n_1 = 0;
		}
		
		
		
		$q_permintaan_b_2 = mysql_query ("select SUM(Qty_diberi) from permintaan_unitdetail where month(str_to_date(tgl_terima,'%d/%m/%Y')) between month(str_to_date(tgl_terima,'%d/%m/%Y'))-3 and month(now())-2 AND barang_id ='$rro[barang_id]' AND status_detail = '9' ORDER BY barang_id ASC");
		$r_permintaan_b_2 = mysql_fetch_array($q_permintaan_b_2);
		if ($r_permintaan_b_2['SUM(Qty_diberi)'])
		{
			$qty_b_2 = $r_permintaan_b_2['SUM(Qty_diberi)'];
			$n_2 = 1;
		}
		else
		{
			$qty_b_2 = 0;
			$n_2 = 0;
		}
		//$j_b = $r_amc['b'.$bln];
		
		$q_ms = mysql_query ("SELECT * FROM ms_barang WHERE id = '$rro[barang_id]'");
		$r_ms = mysql_fetch_array ($q_ms);
		
		$q_amc = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$r_ms[kd_barang]' AND tahun='$thn'");
		$r_amc = mysql_fetch_array ($q_amc);
		
		if (!$r_amc['barang_id'])
		{
			$t_b = $qty_b;
			$t_b_1 = $qty_b_1;
			$t_b_2 = $qty_b_2;
		}
		else
		{
			/*$s_b = abs($qty - $r_amc['b1']);
			$s_b = abs($qty - $r_amc['b_1']);
			$s_b = abs($qty - $r_amc['b_2']);*/
			
		//untuk parameter
		$q_resep_b = mysql_query("select SUM(diberi) from resep where tgl LIKE '%$my' AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_resep_b = mysql_fetch_array($q_resep_b);
		
		if ($r_resep_b['SUM(diberi)'])
		{
			$n = 1;
			$diberi_b = $r_resep_b['SUM(diberi)'];
		}
		else
		{
			$n = 0;
			$diberi_b = 0;
		}
		
		
		
		$q_resep_b_1 = mysql_query("select SUM(diberi) from resep where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-1 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_resep_b_1 = mysql_fetch_array($q_resep_b_1);
		if ($r_resep_b_1['SUM(diberi)'])
		{
			$n_1 = 1;
			$diberi_b_1 = $r_resep_b_1['SUM(diberi)'];
		}
		else
		{
			$n_1 = 0;
			$diberi_b_1 = 0;
		}
		
		
		$q_resep_b_2 = mysql_query("select SUM(diberi) from resep where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-2 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_resep_b_2 = mysql_fetch_array($q_resep_b_2);
		if ($r_resep_b_2['SUM(diberi)'])
		{
			$n_2 = 1;
			$diberi_b_2 = $r_resep_b_2['SUM(diberi)'];
		}
		else
		{
			$n_2 = 0;
			$diberi_b_2 = 0;
		}	
			
			
			//untuk parameter lagi
		$q_racik_b = mysql_query("select SUM(qty) from racik_detail where tgl LIKE '%$my' AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_racik_b = mysql_fetch_array($q_racik_b);
		if ($r_racik_b['SUM(qty)'])
		{
			$qty_racik_b = $r_racik_b['SUM(qty)'];
			$n = 1;
		}
		else
		{
			$qty_racik_b = 0;
			$n = 0;
		}
		
		
		
		$q_racik_b_1 = mysql_query("select SUM(qty) from racik_detail where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-1 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_racik_b_1 = mysql_fetch_array($q_racik_b_1);
		
		if ($r_racik_b_1['SUM(qty)'])
		{
			$qty_racik_b_1 = $r_racik_b_1['SUM(qty)'];
			$n_1 = 1;
		}
		else
		{
			$qty_racik_b_1 = 0;
			$n_1= 0;
		}
		
		
		$q_racik_b_2 = mysql_query("select SUM(qty) from racik_detail where month(str_to_date(tgl,'%d/%m/%Y')) between month(str_to_date(tgl,'%d/%m/%Y'))-3 and month(now())-2 AND (flags = '1' OR flags ='0') AND kode_obat <> '' AND kode_obat = '$r_ms[kd_barang]' ORDER BY kode_obat ASC");
		$r_racik_b_2 = mysql_fetch_array($q_racik_b_2);
		
		if ($r_racik_b_2['SUM(qty)'])
		{
			$qty_racik_b_2 = $r_racik_b_2['SUM(qty)'];
			$n_2 = 1;
		}
		else
		{
			$qty_racik_b_2 = 0;
			$n_2= 0;
		}

			
			
			
			$selisih = $r_amc['b1'] - ($diberi_b + $qty_racik_b);
			$h_selisih_b = abs($qty_b - $selisih);
			
			$selisih_b_1 = $r_amc['b_1'] - ($diberi_b_1 + $qty_racik_b_1);
			$h_selisih_b_1 = abs($qty_b_1 - $selisih_b_1);
			
			$selisih_b_2 = $r_amc['b_2'] - ($diberi_b_2 + $qty_racik_b_2);
			$h_selisih_b_2 = abs($qty_b_2 - $selisih_b_2);
			
			$t_b = $h_selisih_b + $r_amc['b1'];
			$t_b_1 = $h_selisih_b_1 + $r_amc['b_1'];
			$t_b_2 = $h_selisih_b_2 + $r_amc['b_2'];
			
		}
			
	//	echo $r_amc['b_1'] ."diberi " .$qty_racik_b_1."<br>";
		/*$q_gabung = mysql_query ("SELECT DISTINCT(kode_obat) FROM resep,amc2 WHERE resep.kode_obat = amc2.barang_id AND resep.kode_obat='$r_ms[kd_barang]' AND (resep.flags <> '4' OR resep.flags <>'3')");
		$r_gabung = mysql_fetch_array($q_gabung);
		
		if (!$r_gabung['kode_obat'])
		{
			$t_b = $qty_b;
			$t_b_1 = $qty_b_1;
			$t_b_2 = $qty_b_2;
		}
		else
		{
			$t_b = $qty_b + $r_gabung['b1'];
			$t_b_1 = $qty_b_1 + $r_gabung['b_1'];
			$t_b_2 = $qty_b_2 + $r_gabung['b_2'];
		}*/
		//echo $r_amc['barang_id'] . " jumlah: ".$j_b ." + " .$r_racik['SUM(qty)']. "= " .$qty."<br>";
		$j_n2 = $n + $n_1 + $n_2;
		$rata2 = ceil(($t_b + $t_b_1 + $t_b_2) / 3);
		
		$q_amc2 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$r_ms[kd_barang]' AND tahun ='$thn'");
		$r_amc2 = mysql_fetch_array ($q_amc2);
		
		if (!$r_amc2)
		{
			
			$q_masuk = "INSERT INTO amc2 (barang_id, b1, b_1, b_2, tahun, rata_rata) VALUES ('$r_ms[kd_barang]', '$t_b', '$t_b_1', '$t_b_2', '$thn', '$rata2')";
			$r_masuk = mysql_query($q_masuk);
		}
		else
		{
			 
			$q_masuk = mysql_query ("UPDATE amc2 SET b1 = '$t_b',
												 b_1 = '$t_b_1',
											 b_2 = '$t_b_2',
										 rata_rata = '$rata2'
										WHERE barang_id = '$r_amc2[barang_id]' AND tahun = '$r_amc2[tahun]'");
		}
		
		
	//$q_amc22 = mysql_query ("SELECT * FROM amc2,ms_barang WHERE amc2.barang_id = ms_barang.kd_barang AND ms_barang.id='$rro[barang_id]' AND amc2.tahun ='$thn'");
	$q_amc22 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$r_ms[kd_barang]' AND tahun ='$thn'");
	$r_amc22 = mysql_fetch_array ($q_amc22);
	
	if ((($r_amc22['b1']==0) AND ($r_amc22['b_1']==0)) OR (($r_amc22['b1']==0) AND ($r_amc22['b_2']==0)) OR (($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0)))
		{
			$jj =1;
		}
	
	elseif (($r_amc22['b1']==0) OR ($r_amc22['b_1']==0) OR ($r_amc22['b_2']==0))
	{
		$jj =2;
	}
		elseif (($r_amc22['b1']==0) AND ($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0))
		{
			$jj=0;
		}
		else
		{
			$jj=3;
		}
		
		$rata2 = ceil(($t_b + $t_b_1 + $t_b_2) / $jj);
		$q_masuk = mysql_query ("UPDATE amc2 SET rata_rata = '$rata2'
													WHERE barang_id = '$r_amc22[barang_id]' AND tahun = '$r_amc22[tahun]'");
	}
	
	
	
	
	
	
	
	
	
	
	/*
	$q_amc22 = mysql_query ("SELECT * FROM amc2 WHERE barang_id = '$rr[kode_obat]' AND tahun ='$thn'");
	$r_amc22 = mysql_fetch_array ($q_amc22);
		
	if (($r_amc22['b1']==0) OR ($r_amc22['b_1']==0) OR ($r_amc22['b_2']==0))
		{
			$jj =2;
		}
		elseif ( (($r_amc22['b1']==0) AND ($r_amc22['b_1']==0)) OR (($r_amc22['b1']==0) AND ($r_amc22['b_2']==0)) OR (($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0)))
		{
			$jj =1;
		}
		elseif (($r_amc22['b1']==0) AND ($r_amc22['b_1']==0) AND ($r_amc22['b_2']==0))
		{
			$jj=0;
		}
		else
		{
			$jj=3;
		}
		
		$rata2 = ceil(($t_b + $t_b_1 + $t_b_2) / $jj);
		$q_masuk = mysql_query ("UPDATE amc2 SET rata_rata = '$rata2'
													WHERE barang_id = '$r_amc22[barang_id]' AND tahun = '$r_amc22[tahun]'");*/
		
?>