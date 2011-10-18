<?php
//die("Jangan di Buka dong ahh...");
/**
 * @author      Jalu Ahmad Pambudi
 * @copyright   2011
 * @link        http://yoursite.home.php?hal=action/generate_po
 * @param       $noPO
 * @param       $flags
 * @param       $suppID
 * @tutorial        1 : Generate New Purchase Order(s)
 *                  2 : Update Purchase Order's flags : 
 *                          when 1 then 'Closed' 
 *                          when 2 then 'Receiving'
 *                          when 3 then 'Approved' 
 *                          when 4 then 'Generated'
 *                          when 5 then 'Open' 
 *                          when 6 then 'Canceled'
 *                  3 : Canceling Purchase Order
 *                    switch ($toFieldStatus){
 *                       case 1:
 *                           $toFieldStatus = "Closed";
 *                       break;
 *                       case 2:
 *                           $toFieldStatus = "Receiving";
 *                       break;
 *                       case 3:
 *                           $toFieldStatus = "Approved";
 *                       break;
 *                       case 4:
 *                           $toFieldStatus = "Generated";
 *                       break;
 *                       case 5:
 *                           $toFieldStatus = "Open";
 *                        break;
 *                        case 6:
 *                            $toFieldStatus = "Canceled";
 *                       break;
 *                   }
 * @todo    UPDATE SERVER ENGINE WITH PHP 5.3 FOR IT'S SUPPORT (GOTO) COMMAND
 *          TO SIMPLYFIED THIS LACK OF LOOPING ROUTE COMMANDS :P
 * @todo    PLEASE KEEP THIS FILE FREE OF SPACE AND YOU MUST NOT REMOVE ANY 
 *          DEBUGING COMMAND !!
*/
$flags = $_POST[flags];
if (($flags==0) || (empty($flags))){$flags=2;}
//$userLoged = getLoginStatus();
//print ($userLoged);
//global $noPO;
//global $noReq;
//global $suppID;
//global $items;
//global $idPO;
$noPO       = trim($_POST[no_po]);
$noReq      = trim($_POST[no_req]);
$lastNO     = $_POST[lastno];
$items      = $_POST[param];
$suppID     = $_POST[supp_id];
$idPO       = $_POST[id];
$poID       = $_POST[idPO];
//
if(empty($noPO)){$noPO          = $_POST['pono'];}
if(empty($noReq)){$noReq        = $_POST['po_reqno'];}
if(empty($lastNO)){$lastNO      = $noPO; }
if(empty($suppID)){$suppID      = $_POST['posupplier'];}
if(empty($idPO)){$idPO          = $_POST['stream'];}
if(empty($poID)){$poID          = $_POST['idPO'];}
//
$strSQL = "Select base_po_no from generate_po where base_po_no = '$noPO'";
$get= mysql_query($strSQL);
$dbPOArr = mysql_fetch_array($get);
$dbPO = $dbPOArr[0];
//print $flags;
if(empty($dbPO)){
    //goto flagMarch;
    //die (("Failed, cannot find proper table!! <br /> Please contact PT. Priatman --") . mysql_error());
    //$dbPO = reserveNo('PO');
    //$flags= 2;
}else{
    //$flags =2 ;
    //$strSQL = "update mr set full_no = '$noPO' where type='PO'";
    //execSQL($strSQL) or die("failed!! \n Please contact PT. Priatman ");
}
if (empty($lastNO)) {
    $strSQL = "select full_no from mr where type='PO' ";   
    $lastNO = getSingleData($strSQL);
}
//die (print "$noPO   ::   $noReq    ::    $lastNO     ::    $items      ::   $dbPO :: $flags ");
switch ($flags){
    case 1:
        /* NOTHING TODO THIS TRANSACTION ALREADY TERMINATED */
        die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>");
        break;
    case 2:
        //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 2  :: $toDBDetID");    
        /* CHANGED PO STATUS TO (CLOSED) */
        /* IF IT's ALREADY ON (CLOSED) STATUS THEN NOTHING TODO */        
        $items  = $_POST['param'];
        if(empty($noPO))    {$noPO          = $_POST['pono'];}
        if(empty($noReq))   {$noReq         = $_POST['no_req'];}
        if(empty($suppID))  {$suppID        = $_POST['posupplier'];}
        if(empty($noBTB))   {$noBTB         = $_POST['nobtb'];}
        if(empty($poID))    {$poID          = $_POST['idPO'];}
        if(empty($poSTBNo)){
            $poSTBNo= $_POST['poSTBNo'];
            if(empty($poSTBNo)){getNextNo('STB','action/generate_po');}
            }
        if(empty($poSTBUser)){
            $poSTBUser    = $_POST['poSTBUser'];
            if(empty($poSTBUser)){$poSTBUser=$userLoged;}
            }
        for($i=1;$i<=$items;$i++){
            $toDBDetID  = $_POST['po_detid'.$i];
            $exDate     = $_POST['txtExpDate'.$i];
            $strSQLUpdDet = "UPDATE purchase_orderdetail    
                            SET fld02='$poSTBNo', fld03='$poSTBUser', updated_datetime=now(), updated_user='$userLoged',
                            fld05='$exDate' 
                            WHERE no_po= '$noPO' and fld01= $suppID and no_spb= '$noReq' and id = $toDBDetID";
            //(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 2  :: $toDBDetID");
            mysql_query($strSQLUpdDet) or die("FAILED UPPDet.F2!! <br /> Please contact PT. Priatman ");            
            $strSQLUpdHarga = "INSERT INTO set_harga (barang_id, exp_date, po_no, po_date, price_ms_date, 
                              price_ms, price_po, price_now, created_datetime, created_user, updated_datetime, updated_user)
                              SELECT a.barang_id, a.fld05, a.no_po, c.tgl_po, now(), b.harga_dosp, a.harga_po, 0, now(), '$userLoged',
                              now(), '$userLoged' 
                              FROM 
                              purchase_orderdetail a
                              INNER JOIN ms_barang b 
                              ON a.barang_id = b.id
                              INNER JOIN purchase_order c 
                              ON  c.po_no = a.no_po and a.no_spb = c.request_no and c.id_supplier=a.fld01 
                              WHERE a.id = $toDBDetID ";
            execSQL($strSQLUpdHarga);
        }
        //die();
        $strTmp = "Select SUM(subtotal)as subtotal, count(id) as total_items from purchase_orderdetail 
                   WHERE no_po='$noPO' and no_spb= '$noReq' and fld01=$suppID and fld02= '$noBTB' and fld03='' group by no_po";
        $fetchTmp = execSQLReturn($strTmp);
        $subtotalDetail = $fetchTmp['subtotal']; 
        $totalItems = $fetchTmp['total_items'];
        //die(print "$noPO   ::   $noReq    ::    $items   ::   $noBTB  ::   $flags   :: $suppID");
        $strSQLUpd = "UPDATE purchase_order 
                      SET grand_total ='$subtotalDetail', total_items ='$totalItems', flags=1, 
                      btb_no ='$noBTB', penerima = '$userLoged', fld01= now(), 
                      updated_datetime=now(), updated_user='$userLoged'
                      WHERE po_no ='$noPO' and id_supplier=$suppID and request_no ='$noReq' and id=$poID";
        mysql_query($strSQLUpd) or die("FAILED UPPHead.F2!! <br /> Please contact PT. Priatman ");
        $strSQLTmp = "select id from purchase_orderdetail where no_po= '$noPO' and fld01= $suppID and no_spb= '$noReq'";
        $execDech = mysql_query($strSQLTmp);
        while ($execMe = mysql_fetch_assoc($execDech)){
        foreach($execMe as $key=>$val){
/*            $strSQLUpMs = "INSERT INTO ms_barang 
            (group_barang, kd_barang, nama, satuan, pabrik01, satuan_kirim, jenis_obat, 
            kategori_obat, golongan, expire_date, ex_date, ex_month, ex_year, tipe_obat,
            harga_dosp, discount, ppn, stok_max, stok_min, stok, flags, created_datetime, created_user, 
            update_datetime, update_user, fld01, fld02, fld03)
            SELECT a.group_barang, a.kd_barang, a.nama, a.satuan, $suppID, b.satuan_po, a.jenis_obat,
            a.kategori_obat, a.golongan, b.fld05, day(b.fld05), month(b.fld05), year(b.fld05),
            a.tipe_obat, b.harga_po, b.discount, (b.harga_po * 0.1), a.stok_max, a.stok_min, b.qty_po, 1, now(), '$userLoged', 
            now(), '$userLoged', b.no_po,  b.no_spb, b.id
            FROM ms_barang a INNER JOIN purchase_orderdetail b on a.id = b.barang_id where b.id =$val ";
*/
            $strSQLUpMs = "INSERT INTO `ms_barang` (`group_barang`, `kd_barang`, `nama`, `satuan`, `pabrik01`, 
            `pabrik02`, `pabrik03`, `pabrik04`, `pabrik05`, `satuan_kirim`, `jenis_obat`, `kategori_obat`, `golongan`, 
            `kode_guna`, `kode_persediaan`, `kode_pendapatan`, `kode_reduksi`, `kode_biaya`, `kode_ppn_k`, `kode_ppn_m`, 
            `expire_date`, `ex_date`, `ex_month`, `ex_year`, `tipe_obat`, `obat_tunai`, `hna`, `harga_dosp`, `discount`, 
            `ppn`, `averange_sale`, `stok_max`, `stok_min`, `stok`, `isi`, `kemasan`, `status`, `flags`, 
            `created_datetime`, `created_user`, `update_datetime`, `update_user`, `no_batch`, `no_rak`, `fld01`, `fld02`, 
            `fld03`) SELECT a.group_barang, a.kd_barang, a.nama, a.satuan, $suppID, 
            a.pabrik02, a.pabrik03, a.pabrik04, a.pabrik05, b.satuan_po, a.jenis_obat, a.kategori_obat, a.golongan, 
            a.kode_guna, a.kode_persediaan, a.kode_pendapatan, a.kode_reduksi, a.kode_biaya, a.kode_ppn_k, a.kode_ppn_m,
            b.fld05, day(b.fld05), month(b.fld05), year(b.fld05), a.tipe_obat, a.obat_tunai, a.hna, b.harga_po, b.discount,
            (b.harga_po *0.1), a.averange_sale, a.stok_max, a.stok_min, b.qty_po, a.isi, a.kemasan, 'Aktif', 1, 
            now(), '$userLoged', now(), '$userLoged', a.fld06, a.no_rak, b.no_po, b.no_spb, b.id FROM ms_barang a 
            INNER JOIN purchase_orderdetail b on a.id = b.barang_id WHERE b.id =$val  ";
            execSQL($strSQLUpMs);
            //print $strSQLUpMs; 
            $strSQLUpFlags = "UPDATE ms_barang set flags = 1 where id = $val";
            execSQL ($strSQLUpFlags);
            }
        }
        die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>");
    break;
    case 3:
        //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 3");
        /* CHANGED PO STATUS TO (APPROVED) */
        /* IF IT's ALREADY ON (APPROVED) STATUS THEN CHANGED TO (RECEIVING) */
        $items  = $_POST['param'];
        if(empty($noPO)){$noPO              = $_POST['pono'];}
        if(empty($noReq)){$noReq            = $_POST['no_req'];}
        if(empty($suppID)){$suppID          = $_POST['posupplier'];}
        if(empty($poID)){$poID              = $_POST['idPO'];}
        /*for($i=0;$i<=$items;$i++){
            $toDBDetSatuan      = $_POST['txtSat'.$i];
            $toDBDetHarga       = $_POST['txtHarga'.$i];
            $toDBDetQty         = $_POST['txtQty'.$i];
            $toDBDetDisc        = $_POST['txtDisc'.$i];
            $toDBDetADisc       = $_POST['txtADisc'.$i];
            $toDBDetSubtotal    = $_POST['txtSubtotal'.$i];
            $strSQLUpdDet = "UPDATE purchase_orderdetail
                            SET satuan_po='$toDBDetSatuan', harga_po= '$toDBDetHarga', 
                            qty_po= '$toDBDetQty', discount='$toDBDetDisc' , amount_discount='$toDBDetADisc',
                            subtotal= '$toDBDetSubtotal', updated_datetime=now(), updated_user='$userLoged' 
                            WHERE no_po= '$noPO' and fld01= $suppID and no_spb= '$noReq'
                            ";
            execSQL($strSQLUpdDet) or die("FAILED UPPDet.F3!! <br /> Please contact PT. Priatman ");;
        }*/
        $strTmp = "Select SUM(subtotal)as subtotal, count(id) as total_items from purchase_orderdetail 
                   WHERE no_po='$noPO' and no_spb= '$noReq' and fld01=$suppID group by no_po ";
        $fetchTmp = execSQLReturn($strTmp);
        $subtotalDetail = $fetchTmp['subtotal']; 
        $totalItems = $fetchTmp['total_items'];
        //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID");
        $strSQLUpd = "UPDATE purchase_order 
                      SET grand_total ='$subtotalDetail', total_items ='$totalItems', flags=2, 
                      po_approved_by = '$userLoged', updated_datetime=now(), updated_user='$userLoged'
                      WHERE po_no ='$noPO' and id_supplier=$suppID and request_no ='$noReq' and id='$poID'";
        //die($strSQLUpd);
        mysql_query($strSQLUpd) or die("FAILED UPPHead.F3!! <br /> Please contact PT. Priatman " . mysql_error());
        echo "PopupCenter('content/po_print.php&stream=<?=$poID?>', 'popPO',600,300)";
        die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>");
    break;
    case 4:
        /* INSERT INTO PURCHASING DB AND CHANGED PO STATUS TO (GENERATED) */
        /* IF IT's ALREADY ON (GENERATED) STATUS THEN CHANGED IT TO (OPEN)'*/
        //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 4else");
        $strSQLCheck = "SELECT id,po_no FROM purchase_order WHERE po_no = '$noPO'";        
        $resCheck = execSQLReturn($strSQLCheck);
        //print_r ($resCheck);
        //die ($resCheck[id]);
        if(empty($resCheck[id])){
            //die("WTF??");
            for($i = 1; $i <= $items; $i++){
                $xSupp[$i] = array();
                $idPBF = $_POST['pbf'.$i];
                $idBarang = $_POST['idme'.$i];
                $stokReq = $_POST['reqstock'.$i];
                $hargaReq = $_POST['harga'.$i];
                $stok = $_POST['stok'.$i];
                $expireDate = $_POST['exdate'.$i];
                $subTotalReq = ($_POST ['sub_total'.$i]);
                $stokApp = $_POST['stockapp'.$i];
                $subTotalApp = ($stokApp * $hargaReq);
                $strSQL = "
                INSERT INTO generate_po(
                    last_po_no, base_po_no, request_no, supp_id, barang_id,
                    stock_req, harga_req, stok, expired_date,
                    subtotal_req, stok_app, subtotal_app, flags,
                    crtd_datetime, crtd_user, lupd_datetime, lupd_user
                    )VALUES(
                    '$lastNO', '$noPO', '$noReq' , $idPBF, $idBarang,
                    '$stokReq', '$hargaReq', '$stok', '$expireDate',
                    '$subTotalReq','$stokApp', '$subTotalApp', 1,
                    now(), '$userLoged', now(), '$userLoged'
                    ) ";
              //print ($strSQL . '<br />' . '<br />') ;
              mysql_query($strSQL) or die("FAILED GenP!! \n Please contact PT. Priatman ");
            }
    /**
     * NEXT STAGE :: Get Supplier List from po_generate 
     * 
    */
            $strSQL ="SELECT distinct supp_id from generate_po where base_po_no = '$noPO' and request_no='$noReq'";
            $exQueryMe = mysql_query($strSQL);
            $rallyPO = trim($noPO);
            while($fetchSupp = mysql_fetch_array($exQueryMe)){
            /******     START COUNTER     ******/
                    $suppID = $fetchSupp[supp_id];
                    $basePONO = substr($rallyPO,0,-4);
                    $baseCount = substr($rallyPO,-4);        
                    $baseCountZero = (int)$baseCount;
                    $differs =strlen(trim($baseCount)) - strlen($baseCountZero);
                    $zeroMarch="";
                    for ($s=1;$s<=($differs);$s++){
                        $zeroMarch .="0"; 
                    //print ($zeroMarch . "\n");
                    }
                    $baseCountZero += 1;
                    $nextPONO= $basePONO.$zeroMarch.$baseCountZero ;                
                    //print ($baseCount. " :: ". $baseCountZero. " :: ". $differs . "<br />");
            /******      COUNTER END     ******/
            /*******    SECTION HEADER  *******/
                    $strSQL = "INSERT INTO 
                    purchase_order ( 
                    po_no, tgl_po, request_no,
                    id_supplier, flags, 
                    created_datetime, created_user,
                    updated_datetime, updated_user
                    )VALUES (
                    '$rallyPO', now(),'$noReq',
                    $suppID, 4, 
                    now(),'$userLoged',now(),'$userLoged'
                    )";
                    print ($strSQL . '<br />' . '<br />');
                    $exQueryHead  = mysql_query($strSQL) or die("FAILED INPHead!! \n Please contact PT. Priatman ");
                    updateNextNo('PO',$baseCountZero+1,$nextPONO,'action/generate_po');
            /*******     END HEADER     *******/
            /*******    START DETAIL    *******/
/*                $countFetch = getSingleData("SELECT COUNT(ID) FROM generate_po where supp_id=$suppID and request_no='$noReq'");
                print $countFetch ;
                for($i=1;$i<=$countFetch;$i++){
*/                    $strSQL = "SELECT * FROM generate_po where supp_id = '$suppID' and request_no='$noReq'";
                    $exQueryDet = mysql_query($strSQL);
                    print $strSQL . '<br />' . '<br />';
                    while ($fetchDetail = mysql_fetch_array($exQueryDet)){
                        $strSQL = "INSERT INTO 
                        purchase_orderdetail (
                        no_po, no_spb, barang_id, qty_po, harga_po, subtotal,
                        created_datetime, created_user,
                        updated_datetime, updated_user,
                        fld01
                        )VALUES(
                        '$rallyPO', '$noReq', $fetchDetail[barang_id], $fetchDetail[stok_app], '$fetchDetail[harga_req]','$fetchDetail[subtotal_app]',
                         now(),'$userLoged',now(),'$userLoged', $suppID
                        )";
                        $exDetRes = mysql_query($strSQL) or die("FAILED INPDet!! \n Please contact PT. Priatman ");
                        print ($strSQL . '<br />') ;
/*                    } */
                }
                $strTmp = "Select SUM(subtotal)as subtotal, count(id) as total_items from purchase_orderdetail WHERE no_spb='$noReq' and fld01=$suppID group by no_po";
                $fetchTmp = execSQLReturn($strTmp);
                print_r ($fetchTmp);
                $subtotalDetail = $fetchTmp['subtotal']; 
                $totalItems = $fetchTmp['total_items'];
                $strSQLUpd = "UPDATE purchase_order 
                              SET grand_total ='$subtotalDetail', total_items ='$totalItems', flags=5, 
                              updated_datetime=now(), updated_user='$userLoged'
                              WHERE po_no ='$rallyPO' and id_supplier=$suppID and request_no ='$noReq'";
                //die($strSQLUpd);
                mysql_query($strSQLUpd) or die ("FAILED UPPHead !! <br /> Please contact PT. Priatmant ");
                print ($strSQLUpd);
                $strGetPOID= "SELECT id FROM purchase_order WHERE po_no='$rallyPO' and id_supplier= $suppID";
                $poID = getSingleData($strGetPOID);
                print ($poID);
                $strTmp = "DELETE FROM generate_po WHERE supp_id=$suppID and request_no='$noReq'"; 
                mysql_query($strTmp) or die("DELETE TMP Failed!! \n Please contact PT. Priatman ");
                $strUpReqBeli = "UPDATE req_pembelian set aktivasi = 2 where no_req = '$noReq'";
                mysql_query ($strUpReqBeli) or die("UPDATE REQ_P failed!! \n Please contact PT. Priatman ");
                $strHeadSPB = "UPDATE head_spb SET fld00= $suppID, fld01= $poID , fld02= '$rallyPO', update_datetime=now(), update_user='$userLoged' where spb_no = '$noReq' and flags= 1";
                mysql_query ($strHeadSPB) or die("UPDATE HEAD_SP failed!! \n Please contact PT. Priatman ");
                $strDetSPB = "UPDATE detail_spb set is_po = 1 , fld00=$suppID , fld01= $poID, fld02 = '$rallyPO', update_datetime=now(), update_user='$userLoged' where spb_no = '$noReq' and flags=1";
                mysql_query($strDetSPB) or die("UPDATE DET_SP failed!! \n Please contact PT. Priatman ");
                $rallyPO = trim($nextPONO) ;
            }
        }else{
                //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 4else");
                //die($flags);
                //$countFetch = getSingleData("SELECT COUNT(ID) FROM purchase_orderdetail where fld01=$supp_id and no_po = $noPO and request_no='$noReq'");
                $items  = $_POST['param'];
                if(empty($noPO)){$noPO      = $_POST['pono'];}
                if(empty($noReq)){$noReq    = $_POST['no_req'];}
                if(empty($suppID)){$suppID  = $_POST['posupplier'];}
                if(empty($poID)){$poID      = $_POST['idPO'];}
                $strSQLCheck = "select count(id) from purchase_orderdetail where no_po = '$noPO' and fld01=$suppID and no_spb='$noReq'";
                $dbItems = getSingleData($strSQLCheck);
                if($items<>$dbItems) {$items=$dbItems;}
                print($items);
                for($i=1;$i<=$items;$i++){
                    $toDBID             = $_POST['po_detid'.$i];
                    $toDBCount          = 0;
                    $toDBDetSatuan      = $_POST['txtSat'.$i];
                    $toDBDetHarga       = $_POST['txtHarga'.$i];
                    $toDBDetQty         = $_POST['txtQty'.$i];
                    $toDBDetDisc        = $_POST['txtDisc'.$i];
                    $toDBDetADisc       = $_POST['txtADisc'.$i];
                    $toDBDetSubtotal    = $_POST['txtSubtotal'.$i];
                    $toDBexpDate        = $_POST['txtExpDate'.$i];
                    $toDBCount          = ($toDBDetHarga * $toDBDetQty);
                    $toDBDetADisc       = (($toDBDetDisc/100)*$toDBDetHarga);
                    $toDBCount          -= $toDBDetADisc;
                    $strSQLUpdDet = "UPDATE purchase_orderdetail
                                    SET satuan_po='$toDBDetSatuan', harga_po= '$toDBDetHarga', 
                                    qty_po= '$toDBDetQty', discount='$toDBDetDisc' , amount_discount='$toDBDetADisc',
                                    subtotal= '$toDBCount', updated_datetime=now(), updated_user='$userLoged', fld05 = '$expDate'
                                    WHERE no_po= '$noPO' and fld01= $suppID and no_spb= '$noReq' and id= $toDBID 
                                    ";
                    //print "$noPO   ::   $noReq    ::    $toDBCount   ::   $items   ::   $dbPO  ::   $flags   :: $suppID";
                    //print $strSQLUpdDet . "<br />";                    
                    mysql_query($strSQLUpdDet) or die("FAILED UPPDet.F4.Else!! <br /> Please contact PT. Priatman ");;
                }
                $strTmp = "Select sum(harga_po) as total_price, sum(discount) as disc, sum(amount_discount) as adisc,
                           SUM(subtotal)as subtotal, count(id) as total_items from purchase_orderdetail 
                           WHERE no_po='$noPO' and no_spb= '$noReq' and fld01=$suppID group by no_po ";
                $fetchTmp       = execSQLReturn($strTmp);
                $totalPrice     = $fetchTmp['total_price'];
                $totDisc        = $fetchTmp['discount'];
                $totADisc       = $fetchTmp['adisc'];
                $subtotalDetail = $fetchTmp['subtotal']; 
                $totalItems     = $fetchTmp['total_items'];
                $totAfDisc      = ($totalPrice - $totADisc);
                $ppn            = ($subtotalDetail * 0.1);
                //die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID");
                $strSQLUpd = "UPDATE purchase_order 
                              SET total_price= '$totalPrice', percent_discount = '$totDics', discount_amount = '$totADisc', 
                              after_discount='$totAfDisc', ppn_amount='$ppn', grand_total ='$subtotalDetail', 
                              total_items ='$totalItems', flags=5, 
                              updated_datetime=now(), updated_user='$userLoged'
                              WHERE po_no ='$noPO' and id_supplier=$suppID and request_no ='$noReq' and id=$poID";
                mysql_query($strSQLUpd) or die("FAILED UPPHead.F4.Else!! <br /> Please contact PT. Priatman ");
        }
        //updateNextNo('PO',$baseCountZero+1,$rallyPO,'action/generate_po');
        die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>");
    break;
    case 5:
        /* UPDATE PO STATUS TO (OPEN) */
        /* IF IT's ALREADY ON (OPEN) STATUS THEN CHANGED IT TO (APPROVED) */    
//        die(print "$noPO   ::   $noReq    ::    $lastNO   ::   $items   ::   $dbPO  ::   $flags   :: $suppID  :: 5");
        $items  = $_POST['param'];
        if(empty($noPO)){$noPO      = $_POST['pono'];}
        if(empty($noReq)){$noReq    = $_POST['no_req'];}
        if(empty($suppID)){$suppID  = $_POST['posupplier'];}
        if(empty($poID)){$poID      = $_POST['idPO'];}
        for($i=1;$i<=$items;$i++){
            $toDBDetSatuan      = $_POST['txtSat'.$i];
            $toDBDetHarga       = $_POST['txtHarga'.$i];
            $toDBDetQty         = $_POST['txtQty'.$i];
            $toDBDetDisc        = $_POST['txtDisc'.$i];
            $toDBDetADisc       = $_POST['txtADisc'.$i];
            $toDBDetSubtotal    = $_POST['txtSubtotal'.$i];
            $toDBDetID          = $_POST['po_detid'.$i];
            $strSQLUpdDet = "UPDATE purchase_orderdetail
                            SET satuan_po='$toDBDetSatuan', harga_po= '$toDBDetHarga', 
                            qty_po= '$toDBDetQty', discount='$toDBDetDisc' , amount_discount='$toDBDetADisc',
                            subtotal= '$toDBDetSubtotal', updated_datetime=now(), updated_user='$userLoged' 
                            WHERE no_po= '$noPO' and fld01= $suppID and no_spb= '$noReq' and id = $toDBDetID
                            ";
            mysql_query($strSQLUpdDet) or die("FAILED UPPDet.F5!! <br /> Please contact PT. Priatman ");;
          //  print($items. "::" . $strSQLUpdDet . "<br />");
        }
        //die ();
        $strTmp = "Select SUM(subtotal)as subtotal, count(id) as total_items from purchase_orderdetail 
                   WHERE no_po='$noPO' and no_spb= '$noReq' and fld01=$suppID group by no_po ";
        $fetchTmp = execSQLReturn($strTmp);
        $subtotalDetail = $fetchTmp['subtotal']; 
        $totalItems = $fetchTmp['total_items'];
        //die(print "$noPO   ::   $noReq    ::    $subtotalDetail   ::   $items   ::   $dbPO  ::   $flags   :: $suppID");
        $strSQLUpd = "UPDATE purchase_order 
                      SET grand_total ='$subtotalDetail', total_items ='$totalItems', flags=3, 
                      updated_datetime=now(), updated_user='$userLoged'
                      WHERE po_no ='$noPO' and id_supplier='$suppID' and request_no ='$noReq' and id='$poID' ";
//        die($strSQLUpd);
        mysql_query($strSQLUpd) or die("FAILED UPPHead.F5!! <br /> Please contact PT. Priatman ".mysql_error());
        die("<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>");
    break;
}
/********************************* IGNORE THIS PLEASE **************************************\
        $noPO = $_POST['no_po'];
        $noReq = $_POST['po_reqno'];
        if ((empty($noPO)) || (empty($noReq))){
            echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>";
        }elseif (($noPO ="") || ($noReq="")){
            echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_po'>";
        }else{
            $noPO = $_POST['no_po'];
            $noReq = $_POST['po_reqno'];
//================================      START UPDATING PO       ================================//
//            $strSQL = "SELECT * FROM purchase_order WHERE po_no = $noPO and request_no= $noReq";
            $strSQL = "
            select
                  a.kd_barang as kode, a.nama as nama, b.qty_po as po_qty, b.satuan_po as po_satuan,  
                  b.harga_po as po_harga, b.discount as po_discount, b.amount_discount as po_discammount,
                  b.subtotal as po_subtotal,b.id as po_detid, b.no_po as po_no, b.no_spb as po_reqno, b.fld01, 
                  a.stok as curstok, a.id as id, d.nama as supplier, c.tgl_po, c.flags as po_status, c.updated_user as creator
            from
                  ms_barang a
            inner join
                  purchase_orderdetail b
            on
                  a.id = b.barang_id
            left outer join
                  purchase_order c
            on
                  b.no_po = c.po_no and b.no_spb = c.request_no and b.fld01 = c.id_supplier
            inner join 
                  pbf d 
            on
                  b.`fld01` = d.`id` 
            ";
            $strSQLHeader       = $strSQL . " where b.no_po = '".$noPO."' and b.no_spb='$noReq'  group by b.id " ;
            $fetchHeader        = execSQLReturn($strSQLHeader);
            $toFieldNoPO        = $fetchHeader['no_po'];
            $toFieldNoReq       = $fetchHeader['request_no'];
            $toFieldTglPO       = $fetchHeader['tgl_po'];
            $toFieldStatus      = $fetchHeader['po_status'];
            $toFieldCreator     = $fetchHeader['creator'];
            $toFieldSupplier    = $fetchHeader['supplier'];            
            $strSQLDetail = "SELECT sum(harga_po) as harga, sum(amount_discount) as adiscount, 
            sum(subtotal)as subtotal, no_po , no_spb, fld01 as supp_id
            FROM purchase_orderdetail where no_po ='$noPO' and no_spb = '$noReq' group by no_po";
            $fetchTmp       = execSQLReturn($strSQLDetail);
            $toDBHarga      = $fetchTmp[harga];
            $toDBADisc      = $fetchTmp[adiscount];
            $toDBSubtotal   = $fetchTmp[subtotal];
            $toDBNoPO       = $fetchTmp[no_po];
            $toDBNoSPB      = $fetchTmp[no_spb];
            $toDBIDSupplier = $fetchTmp[supp_id];
            $toDBTotal      = ($toDBHarga - $toDBADisc);
            $toDBPPN        = ($toDBTotal * 0.1);
            $toDBGrandTotal = ($toDBTotal - $toDBPPN);
        }
//            print $strSQLHeader;
//            print_r($fetchTmp);
//            print("<br />" );
//            print_r ($fetchHeader);
//            print ("<br />" );
//            $strSQLUpd = "
            UPDATE purchase_order SET
                flags=3, po_approved_by = '$userLoged', total_price='$toDBHarga', 
                discount_amount='$toDBADisc', after_discount = '$toDBTotal',
                ppn_amount = '$toDBPPN', grand_total ='$toDBGrandTotal', updated_datetime = now(), 
                updated_user ='$userLoaged' 
            WHERE id_supplier = $toDBIDSupplier and po_no = '$toDBNoPO' and request_no = '$toDBNoSPB'";
            execSQL($strSQLUpd) or die("FAILED UPPHead.F5!! <br /> Please contact PT. Priatman ");
 
\******************************** END OF IGNORE **************************************/
?>

