<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */
$spb_no = $_POST['no_req'];
$spb_date = $_POST['xdate'];
$items = $_POST['param'];
$strSql =  ("Select spb_no from head_spb where spb_no = '" . $spb_no . "' and flags=1" );
$resQm = mysql_query($strSql);
$resQ = mysql_fetch_row($resQm);
if (!empty($resQ[0])){

}else{
    $strSql = "Insert Into head_spb (spb_no, tgl_req, flags, created_datetime, created_user, 
                update_datetime, update_user) 
                VALUES ('".$spb_no."', now(), 1, now(), '$userLoged', now(),'$userLoged')";
    $resQ1 = mysql_query($strSql) or die( "error..." . mysql_error());
    execSQL("update mr set in_use = 1 where id=1");       
}
//    print_r($resQ);
    $strSql = "Select id from detail_spb where spb_no = '".$spb_no."' and status_approval = 'PR' and is_po='0'";
    $resQ = mysql_query($strSql) or die  (mysql_errno());
    $x = mysql_fetch_array($resQ);    
//    print ('<br /> 00000');
//    print_r ($x);
//    print ($items);
    if (!empty($x)){
        $items = mysql_num_rows($resQ);
    	for($i = 1; $i <= $items; $i++)
    	{
    	  	$id = $_POST['idme'.$i];
            $reqstok = $_POST['ap'.$i];
            $kd= $_POST['ap2'.$i]; 
            $harga= $_POST['harga'.$i];
            $subtotal = (($reqstok) * ($harga)) ;
            $subtotal = ($subtotal);
            $strSql = "update detail_spb set 
                        req_stock = '$reqstok', 
                        harga = '$harga',
                        subtotal = '$subtotal',
                        is_po= 1,
                        update_datetime = now(),
                        update_user = '$userLoged'
                        where 
                        spb_no = '".$spb_no."' and
                        barang_id = $id";
            $resQ = mysql_query($strSql) or die (mysql_error() . 'update detail_spb');
            $upd = execSQL("update req_pembelian set no_req = '$spb_no' , jml = '$reqstok',  aktivasi=2 where kd_barang = '$kd'") ;
//            print($strSql);
        }
    
    
//    print (' ** ' . $id . ' ** <br />');
//    print_r ($resQ1 );
//    print '<br />';
//    print($strSql);
    }else{
    	for($i = 1; $i <= $items; $i++)
    	{
    	  	$id = $_POST['idme'.$i];
            $reqstok = $_POST['ap'.$i];
            $kd= $_POST['ap2'.$i]; 
            $harga= $_POST['harga'.$i];
            $subtotal =(($reqstok) * ($harga)) ;
            
            
//    		print ('---  ' .$id . ' --- ' . '<br />');
//    		$strSql = "SELECT id,kd_barang FROM ms_barang WHERE id='$id'" ;
            $strSql = "SELECT * FROM ms_barang,req_pembelian 
            WHERE ms_barang.kd_barang = req_pembelian.kd_barang 
            and req_pembelian.aktivasi=1 and ms_barang.id = $id";
            $resQ = mysql_query($strSql) or die (mysql_error());
    		$resQ1 = mysql_fetch_array($resQ);    		            
//            print ('this is reqstok ' . $reqstok .'<br /> <br />');   
    		if (!empty($id))
    		{
    			$query=mysql_query("SELECT * FROM detail_spb WHERE spb_no = '$spb_no' and  barang_id='$id'") or die (mysql_error());
    			$rest=mysql_fetch_array($query);
//                print_r ($rest);
    			if (!$rest)
    			{
    			     print ("true ... <br />");
    				$queryGo = "INSERT INTO detail_spb (spb_no, barang_id, req_stock, harga, subtotal, 
                    status_approval, is_po, flags, created_datetime, created_user, update_datetime, update_user)
                    VALUES ('$spb_no', '$id','$reqstok',$harga,$subtotal, 'PR',0,1, now(), '$userLoged', now(),'$userLoged')";
                    print($queryGo . '<br />');                
    				$resQ = mysql_query($queryGo) or die ('insert detail_spb' . mysql_error());
                    $upd = mysql_query("update req_pembelian set no_req = '$spb_no', jml = '$reqstok', aktivasi =2 where kd_barang = '$kd' and aktivasi = 1") or die (mysql_error() . 'update req_pembelian');
                    $get = getSingleData("select sum(b.subtotal) from head_spb a inner join detail_spb b on a.spb_no = b.spb_no ");
                    $goH = mysql_query("update head_spb set fld10='$get' where spb_no='$spb_no' ");
    			}
    		}
//            print (' :: ' . $id . ' :: <br />');
//            print_r ($resQ1 );
    	}
    }
//die();
//	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_spb'>";
    echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_spb_grid'>";


?>