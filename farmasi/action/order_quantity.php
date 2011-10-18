<?php

	$q = mysql_query ("SELECT * FROM ms_barang,quantity WHERE ms_barang.kd_barang=quantity.barang_id");
	while ($r=mysql_fetch_array($q))
	{
		//$q_qty = mysql_query ("SELECT * FROM quantity WHERE barang_id = '$r[id]'");
		//$r_qty = mysql_fetch_array($q_qty);
		
		$max_qty = $r['max_qty'];
		$stock_on_hand = $r['stok'];
		//echo $r['0']."<br>";
		$q_spb = mysql_query("SELECT * FROM detail_spb WHERE LAST_INSERT_ID(barang_id) AND barang_id = '$r[0]' ORDER BY barang_id DESC LIMIT 1");		
		$r_spb = mysql_fetch_array($q_spb);
				
		if ($r_spb)
		{
			/*$pesan = strtotime($r_spb['created_datetime']);
			
			$diterima = strtotime($r_spb['update_datetime']);
				
				
			$diff = abs($diterima - $pesan);
			$hari = ceil($diff/86400);
			$safety_hari = $hari;	
			$jumlah_safety = $hari * ceil((40/100) * $result['stok']);*/
			$stock_on_order = $r_spb['req_stock'];
		}
		else
		{
			//default safety
			//$jumlah_safety = ceil((40/100) * $result['stok']);
			//$safety_hari = 1;
			//$hari = 1;
			$stock_on_order = 0;
		}
		
		$order_qty = abs($max_qty - $stock_on_hand);
		//echo $order_qty . "<br>";
		
		$q_masuk = mysql_query ("UPDATE quantity SET order_qty = '$order_qty', stock_on_order = '$stock_on_order' WHERE barang_id = '$r[barang_id]'");
	} 

?>