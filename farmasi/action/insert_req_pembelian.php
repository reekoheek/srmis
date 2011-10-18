<?php
	$date = date("d/m/Y");
	$param = $_POST['param'];
//    for ($i =1;$i<=$param; $i++)
//    {
//        $pq = $_POST['pq'.$i];
//        if ($pq='on'){
//            $pq = '1';
//        }else {
//            $pq = '0';
//        }
//        
//        $dumper = $pq;
//        
//        $else = $_POST['ap'.$i];
//        print_r($dumper);
//        print_r ($else);
//        die();
//    }
	for($i = 1; $i <= $param; $i++)
	{
	  	$ap = $_POST['ap'.$i];
        $pq = $_POST['pq'.$i];
        $noReq ;
//        print "<br /> adoas=" . $pq . "<br />";
        if (empty($pq)){
            $pq = '0';
        }else {
            $pq = '1';
        }
//        print $ap . '   pq   = '. $pq . "<br />";
        
		
		$qq = mysql_query("SELECT id, kd_barang FROM ms_barang WHERE id='$ap'");
		$rr = mysql_fetch_array($qq);		
		$kd = $rr['kd_barang'];
        $id = $rr['id'];
//        print ('id === ' . $id);
		if (!empty($kd))
		{
			$q2=mysql_query("SELECT * FROM req_pembelian WHERE kd_barang='$kd'");
			$r2=mysql_fetch_array($q2);
			if (!empty($r2))
			{
//			     print ("update");
//				$q = "INSERT INTO req_pembelian (kd_barang, tgl, aktivasi) VALUES ('$kd', '$date','$pq')";
                $q = "update req_pembelian set `aktivasi` = '$pq' where kd_barang='$kd'";
    			$r = mysql_query($q) or die ("hadoooh ....." . mysql_error());
			}
            else{                
//                print ("insert");
//                $q="update req_pembelian set (aktivasi = $pq) where kd_barang='$kd'";
                $q = "INSERT INTO req_pembelian (kd_barang, tgl, aktivasi) VALUES ('$kd', '$date','$pq')";
                $r=mysql_query($q) or die ("agaainnn ?? " . mysql_error());                  
            }
            if ($pq == 1){
                $upd = mysql_query ("update ms_barang set flags='2', update_datetime=now(), update_user='$userLoged' where id = $id") or die (mysql_error() . "error");                
            }
            else{
                $upd = mysql_query ("update ms_barang set flags='1', update_datetime=now(), update_user='$userLoged' where id = $id " ) or die (mysql_error() . "ERRRRRRRROOOOOOORRRR");                
            }
		//echo $rr['kd_barang'];
		}else{
		  print "nodata";
		}
	}    
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/mr_auto'>";
?>