<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 * @internal  This is detail container for po_processing.php with closed status
 *
 */
?>
<table border="0" cellpadding="3" cellspacing="3" style="max-width: 600px; width: 100%;">
<tr>
    <td>
        <table cellpadding='2' cellspacing='2' width='600px' style="border:1px  solid  #CCCCCC;">
		<tr bgcolor="#414141" align='center'>
			<th width ="70px"><font color="#FFFFFF" >Kode</font></th>
			<th><font color="#FFFFFF">Nama</font></th>            
            <th width="50px"><font color="#FFFFFF">Req.Qty </th>
			<th width="80px"><font color="#FFFFFF">Satuan</font></th>
            <th width='50px'><font color="#FFFFFF" >PO Qty</font></th>
			<th width="90px"><font color="#FFFFFF">Harga</font></th>
			<th width='50px'><font color="#FFFFFF" >Disc(%)</font></th>
            <th width='100px'><font color="#FFFFFF" >Disc(Rp)</font></th>
            <th width='100px'><font color="#FFFFFF" >Sub Total </font></th>
        </tr>
        <?php
        $strSQLDetail = " 
        select distinct
              a.kd_barang as kode, a.nama as nama, d.req_stock as req_stock, b.satuan_po as po_satuan, b.qty_po as po_qty,
              b.harga_po as po_harga, b.discount as po_discount, b.amount_discount as po_discammount, b.subtotal as po_subtotal,
              b.id as po_detid, b.no_po as no_po, b.no_spb as po_reqno, a.stok as curstok, a.id as id, c.id_supplier as supp_id
        from
              ms_barang a
        inner join
              detail_spb d
        on
              a.id = d.barang_id
        inner join
              purchase_orderdetail b
        on
              a.id = b.barang_id
        left outer join
              purchase_order c
        on
              b.no_po = c.po_no and b.no_spb = c.request_no and b.fld01 = c.id_supplier
        where b.f_revisi=0
        ";
        if(!empty($idPO)){
            $strSQLDetail .= " and c.id= $idPO";            
        }
        //print $strSQLHeader  . '<br />'; 
        //print $strSQLDetail  . '<br />';
        //$toField = array("kode","nama", "po_satuan","po_qty","po_harga","po_discount","po_discammount","po_subtotal");
        $temp = mysql_query($strSQLDetail);
        $records = count($temp);
        //while($exQueryDet = mysql_fetch_array($temp)){
        //    print "<tr>  <td>";
        ////foreach($exQueryDet as $key => $contain){
        ////        print '<td>' . $contain . '</td>';
        ////}
        //    print_r($exQueryDet);
        ////    var_dump($exQueryDet, (print("</tr>")));
        //    print "</td></tr>";
        //}    
        //
        $no=1;
        while ($exQueryDet = mysql_fetch_assoc($temp)){
            if ($no%2){
            	echo "<tr valign=top>";
            }else{
            	echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
            }
            $toField = $exQueryDet ;
            for ($i=0;$i<12;$i++){
                array_pop($toField);
            }
            foreach ($toField as $key => $val){
                print "<td align='center'><input type ='text' name='$key$no' align='center' size=15 value='" . $val ."' readonly='true' style='background-color:#CCCFFF;' /></td>";
            }
                print "<td align='center'>
                       <input type='hidden' name='po_detid$no' value=$exQueryDet[po_detid] />
                      ";
        ?>
                <input type ='text' maxlength='5' size=8 name='txtSat<?=$no?>' value='<?=$exQueryDet[po_satuan]?>' readonly='true' style='background-color:#CCCFFF;'/></td>
                <td align='center'><input type ='text' maxlength='4' size=8 name='txtQty<?=$no?>' readonly='true' value='<?=$exQueryDet[po_qty]?>' style='background-color:#CCCFFF;' /></td>
                <td align='center'><input type ='text' maxlength='9' size=10 name='txtHarga<?=$no?>' readonly='true' value='<?=$exQueryDet[po_harga]?>' style='background-color:#CCCFFF;' /> </td>
                <td align='center'><input type ='text' maxlength='3' size=5 name='txtDisc<?=$no?>' readonly='true' value='<?=$exQueryDet[po_discount]?>' style='background-color:#CCCFFF;' /></td>
                <td align='center'><input type ='text' name='txtADisc<?=$no?>' size=15 readonly='true' value='<?=$exQueryDet[po_discammount]?>' style='background-color:#CCCFFF;' /></td>
                <td align='center'><input type ='text' name='txtSubtotal<?=$no?>' size=15 readonly="true" value='<?=$exQueryDet[po_subtotal]?>' style='background-color:#CCCFFF;' />
                <!-- onblur="document.frmPOCreate.txtSubtotal<?=$no?>.value= (document.frmPOCreate.txtHarga<?=$no?>.value * document.frmPOCreate.txtQty<?=$no?>.value)  ;" 
                onblur="
                document.frmPOCreate.txtSubtotal<?=$no?>.value= (document.frmPOCreate.txtHarga<?=$no?>.value * document.frmPOCreate.txtQty<?=$no?>.value);
                document.frmPOCreate.txtHTotal.value +=parseInt(document.frmPOCreate.txtSubtotal<?=$no?>.value);" /> -->
        <?php
        
            
            /* FETCH ALL TABLES DATA  */
            /*   OVERRIDE HEADER      */
            $toOverride =$exQueryDet ;
            for ($i=0;$i<10;$i++){array_shift($toOverride);}
            foreach ($toOverride as $name=>$val){
                print "<input type='hidden' name='$name' value='$val' />";
            }
            print "</td></tr>";
            $no++;
        }
            $param = $no-1;
            print "<input type='hidden' name='param' value='$param'/>
                   <input type='hidden' name='idPO' value='$idPO' />
                   <input type='hidden' name='flags' value='$flags' />
            ";
        ?>
            
            </table>
		</td>
	</tr>
    <tr>
    <td>
        <hr width="75%" size="3" />
        <hr width="50%" size="3" />
        <hr width="35%" size="3" />
    </td>                        
    </tr>
 </table>
