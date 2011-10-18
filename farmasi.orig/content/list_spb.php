<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!--<meta http-equiv='refresh' content='0;url=home.php?hal=boo' /> -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>List Permintaan Barang</title>
</head>
<body>

<?php
/**
 *@filesource  == get LOWEST Price 
 *                "select po_no, barang_id, no_batch, supp_id, price_now, price_po, po_date, date_sub(po_date,interval 3 month) as po_t from set_harga 
 *                 where po_date between date_sub(curdate(), interval 3 month) and curdate() and 
 *                 barang_id =[REPLACE THIS]  group by no_batch order by price_po desc LIMIT 1"
 * 
 * 
*/
$idSPB = $_POST['stream'];
//die($idSPB);
if ($idSPB == 0){ 
    echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/list_spb_man' /> ";
//    header("Location: home.php?hal=content/list_spb_man");
}else{
    $spb_no = getSingleData("select spb_no from head_spb where id = $idSPB") ;
    $tahun = date("y");
    //$qp= mysql_query("SELECT * FROM mr WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
    $qp = mysql_query("SELECT * FROM mr WHERE type='PO'");
    $rp = mysql_fetch_array($qp);
    $lastNO = $rp['full_no'];
    $isUse = $rp['in_use'];
    $tgl = substr($lastNO,8,2);
    if ($tgl == $tahun)
    {
    	$count = $rp['next_no'];
        if ((empty($isUse))||($isUse==1)){
        $no_req = getNextNo('PO', 'content/list_spb');
        }else{ 
    	$count = 1;
        $no_req = resetNo('PO','content/list_spb');
        }
     }
}

$param_no = $count;
/*
$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_req = "PON/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
*/

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Create PO </b></font></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png" /></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<form method="post" action="home.php?hal=action/generate_po" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
                        <tr>
                            <td align="left" width="100px"> 
                                No PO 
                            </td>
                            <td>
                                : <input type="text" size="20" name="no_po" value="<?php echo $no_req ; ?> " style="background-color:#CCCFFF;" readonly="true"/> 
                            </td>
                        </tr>
						<tr>
							<td align="left" width="100px">No Request </td>
							<td>
							: <input type="text" size="20" name="no_req" value="<?php echo $spb_no ;?>" style="background-color:#CCCFFF; " readonly="true" />                            
							<input type="hidden" size="20" name="param_no" value="<?php $param_no ; ?>" />
                            <input type="hidden" name="lastno" value="<?php $rp['full_no'] ; ?>" />
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						</tr>
						<tr>
							<td>Tanggal</td>
							<td>
								<?php
									$date=date("d/m/Y");
								?>
								: <input type="text" size="12" name="tgl_req" value="<?= $date?>" style="background-color:#CCCFFF; " readonly="true">
							</td>
						</tr>
					</table>
					<hr />
					<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">                    
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 1;
									$ppmonth = date ("m") + 0;
									$pyear = date("Y") + 0;
/*                                    $spb_no = $_GET['spb_no'];
                                    echo $spb_no;
                                    $query2 = "SELECT * FROM ms_barang,detail_spb
                                    WHERE ms_barang.id = detail_spb.barang_id 
                                    and ms_barang.flags=2" ;
                                    $query2 = $query2 . " and ";
                                    $query2  = mysql_query ("SELECT * FROM ms_barang, detail_spb WHERE ms_barang.id = detail_spb.barang_id ");
*/
						          echo '<table cellpadding=2 cellspacing=2 width=1100px style="border:1px  solid  #CCCCCC; ">
    									<tr bgcolor=#414141 align=center>
    										<td><font color=#FFFFFF width=70px>Kode</font></td>
    										<td><font color=#FFFFFF>Nama</font></td>
    										<td><font color=#FFFFFF>Stok</font></td>
    										<td><font color=#FFFFFF>H Beli</font></td>
    										<td><font color=#FFFFFF width=70px>Expired</font></td>
    										<td><font color=#FFFFFF width=80px>Stok Req</font></td>
                                            <td><font color=#FFFFFF width=80px>SubTotal Req</font></td>
                                            <td><font color=#FFFFFF width=60px>Stok App </font></td>
    										<td><font color=#FFFFFF width=90px>Sub Total</font></td>
    										<td width=100px><font color=#FFFFFF>Supplier</font></td>
    									</tr>';
                                        
                                    $query2 = "
                                    select
                                        a.id as barang_id, a.kd_barang, a.nama as barang_nama, a.stok, a.harga_dosp as harga_beli, a.expire_date,
                                        a.ex_month, a.ex_year,
                                        b.id as det_id, b.req_stock as stok_req, b.harga as harga_req, b.subtotal as subtotal_req,
                                        b.status_approval as stat_req, b.is_po as po,
                                        c.id as head_id, c.spb_no, c.created_user as user_req
                                    from
                                        ms_barang a
                                        inner join detail_spb b
                                        on a.id = b.barang_id
                                        left outer join head_spb c
                                        on c.spb_no = b.spb_no
                                    where
                                        a.flags>1 and b.flags= 1 and c.flags =1 and b.is_po =0
                                    ";
									if (!($idSPB==0) & !empty($idSPB)){
									   $query2 .= " and c.id=$idSPB ";
                                       //die(print ($query2));                                       
                                       $query2 = mysql_query($query2);
									}else{
									   //die(print ($query2));
									   $query2 = mysql_query($query2);
									}
									$no = 1;
									while ($result2 = mysql_fetch_array($query2))
									{
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
                                        $date = date("d/m/Y");
                                        //$subtotalreq = rupiah($result2['subtotal']);
										echo "<td width=70px>$result2[kd_barang]</td>
											<td>$result2[barang_nama]</td>
											<td align=right>$result2[stok] <input type=hidden name='stok".$no."' value=$result2[stok] /></td>
											<td align=right>";                                            
											$harga = rupiah($result2[harga_beli]) ;
											echo "<input type=hidden name='harga".$no."' value=$result2[harga_beli] /></td>";
                                            $dbdate = $result2['expire_date'];
                                            $dbpdate = date("d",strtotime($dbdate));
                                            $dbpmonth = date("m",strtotime($dbdate));
                                            $dbpyear = date("Y",strtotime($dbdate));
                                            if (($pmonth == $dbpmonth) and ($pyear == $dbpyear)){
                                                echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
                                            }else if (($pmonth > $dbpmonth) AND ($pyear > $dbpyear) AND ($pdate > $dbpdate)){
												//$qy = mysql_query("UPDATE ms_barang SET status='Non-Aktif' WHERE id='$result[id]'"); 
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}else if (($ppmonth == $dbpmonth) AND ($pyear == $dbpyear)){
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
											}else{ echo "<td width=70px align=center>$result2[expire_date]</td>"; }											
											echo "<input type=hidden name='exdate".$no."' value=$result2[expire_date] />
                                                  <td align=center width=80px>
											         <input type=text name='reqstock' value=$result2[stok_req] size=8 disabled='true'>
                                                     <input type=hidden name='reqstock".$no."' value=$result2[stok_req] />
                                                  </td>
												  <td align=center width=100px>"; 
                                                  rupiah($result2['subtotal_req']) ;
                                                  $subtotalreq =  $result2[subtotal_req]; 
                                            echo "<input type=hidden name='sub_total".$no."' value=$subtotalreq /></td>
                                                  <td align=center width=80xp>
                                                    <input type=text name='stockapp".$no."' size=8  id='stockapp".$no."' value='$result2[stok_req]'/></td>
                                                  <td align=center width=80xp>
                                                    <input type=text name='subtotalapp".$no."' size=10  id='subtotalapp".$no."' ></td>
												  <td width=100px align=center>";
												  echo "<select name='pbf".$no."'><option value=''>--Pilih--</option>";
//												  $qpb = mysql_query("SELECT a.id, a.nama, b.pabrik01,  FROM pbf where ");
                                                  $str = "select distinct a.id, a.nama
                                                        from pbf a
                                                        inner join ms_barang b
                                                        where b.pabrik01 = a.id or
                                                        b.pabrik02 = a.id or
                                                        b.pabrik03 = a.id or
                                                        b.pabrik04 =a.id or
                                                        b.pabrik05 = a.id and b.id = $result2[barang_id]" ;
                                                  $qpb = mysql_query($str);
                                                  
												  while ($rpb = mysql_fetch_array($qpb))
												  {
												 	echo "<option value='$rpb[id]' >$rpb[nama]</option>";													
												  }
											echo  "</select>
                                                   <input type='hidden' name='idme".$no."' value='$result2[barang_id]' />
                                                   </td>
												   </tr>";
										$no++;
									}
									$no_f=$no-1;
									echo "<input type=hidden name=param value='$no_f'>";
									echo "<tr><td colspan='8' align='right'>Grand Total : </td>
									<td align='center'><input type='text' size='15' name='grand_total'></td>
									<td align='center'><input type='submit' value='Generate PO'><input type='hidden' name='flags' value='4' /></td></tr>
									</table>"; 
							?>
							</td>                            
						</tr>
					</table>
					</div>
					</font>
					</form>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png" /></td>
	</tr>
</table>
</body>

</html>