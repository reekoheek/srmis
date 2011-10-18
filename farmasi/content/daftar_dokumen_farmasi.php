<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */



?>


</head>
<body>
<?php
$cari = $_POST['spbno'];
$carispp = $_POST['sppno'];
$tgl = $_POST['tgl'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar Dokumen</b></font></td>
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
			<table border="0" cellpadding="0" cellspacing="0" width="98%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
                    
<!--  START HEADER -->     
						           
    					<font style="font-size:12px;">
    					<table border="0" cellpadding="2" cellspacing="2" width="99%">
							<tr>
								<td colspan="3" align="left"><strong>Permintaan Pembelian</strong><hr></td>
							</tr>
    						<tr>
                                <form method="post" action="home.php?hal=content/list_spb_grid" enctype="multipart/form-data" name="frmSpbSearch">
        							<td width="100px">
        								<input type="text" name="spbno" id="spbno" />
        							</td>
        							<td>
        								&nbsp;<input type="submit" value="Cari SPB" />  &nbsp;
        							</td>
    							</form>
    							<td width="80px">
    								<!--
    								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
    								-->
    							</td>
    					   </tr>
						   <tr>
						   		<td colspan="3"></td>
						   </tr>
    			         </table>
<!-- END HEADER  -->
<!-- **********  -->                         
<!-- START GRID  -->                         
                         
                         <div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
                         <table border="0" cellpadding="0" cellspacing="0" width="100%">
                         <tr>
                            <td>
                                <?php
                                /**********************/
                                /* START GRID CONTAIN */
                                /**********************/                    
                                $rowsPerPage = 20;
            					$pageNum = 1;
            					if(isset($_GET['page']))
            					{
            						$pageNum = $_GET['page'];
            					}
            					$offset = ($pageNum - 1) * $rowsPerPage;
                                $strSqlHeader = "select 
                                a.id, a.spb_no, a.tgl_req, sum(b.subtotal) as total, a.created_user as request_by,
                                b.status_approval as status, b.is_po as po_created
                                from head_spb a inner join detail_spb b
                                on a.spb_no = b.spb_no";
                                
                                if (!empty($cari)){
                                    $strSqlHeader=$strSqlHeader . " where a.spb_no like '%".$cari."%' group by a.id";                                    
                                }else{
                                    $strSqlHeader= $strSqlHeader . " group by a.id";
                                }
                                
                                
                                ?>
                                <!-- HEADER TABLE -->    
                                <table cellpadding=2 cellspacing=2 width=670px>
        							<tr bgcolor=#414141 align=center>
            							<td width=60px>
                                            <font color=#FFFFFF>No Surat</font></td>
            							<td width=50px>
                                            <font color=#FFFFFF>Tanggal </font></td>            							
            							<td width=80px>
                                            <font color=#FFFFFF>Total</font></td>
                                        <td width=30px>
                                            <font color=#FFFFFF>Request By</font></td>
            							<td width=30px>
                                            <font color=#FFFFFF>Status</font></td>
            							<td width=30px>
                                            <font color=#FFFFFF>PO Created</font></td>

                                        <!--    
            							<td>
                                            <font color=#FFFFFF>Status</font></td>
            							<td>
                                            <font color=#FFFFFF>Jenis</font></td>
                                        -->     
            						</tr>
                                    <?php 
                                        $no= 1;
                                        $resHeader = mysql_query($strSqlHeader) or die (mysql_error()); 
                                    ?>
                                 <!--  END HEADER  -->
                                 <!-- START DETAIL -->
                                        <?php
                                            while($fetchHeader=mysql_fetch_array($resHeader)){
                                                if ($no%2){
      												echo "
                                                      <form method='post' action='home.php?hal=content/list_spb' enctype='multipart/form-data'>
                                                      <tr valign=top>
                                                      ";
        										}else{
        											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
        										}
                                                if ($fetchHeader[po_created]==0){
                                                    $poStatus = "NONE";
                                                }else{
                                                    $poStatus = "PO Created";
                                                }
                                                echo(
                                                "<td align=center>
												<a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_SPB.php?spb_no=$fetchHeader[spb_no]', 'myPop1',800,400);\">
												$fetchHeader[spb_no]</a></td>
                                                <td align=right>$fetchHeader[tgl_req]</td>
                                                <td align=right>") ;
                                                rupiah($fetchHeader[total]);
                                                echo(
                                                "</td>
                                                <td align=center>$fetchHeader[request_by]</td>
                                                <td align=center>$fetchHeader[status]</td>
                                                <td align=center>
                                                    $poStatus
                                                    <input type=hidden name='stream' value=$fetchHeader[id] />
                                                </td>
                                                </tr>
                                                </form>
                                                ");
                                                $no++;
                                            }
                                        ?>
                                         
                                        </td>
                                    </tr>
                                 </table>

                            </td>
                         </tr>
						 
                         </table>
                         </div><br><br><br>
						 
						 <!-- untuk spp-->
						 
						
						<table border="0" cellpadding="2" cellspacing="2" width="100%">
							<tr>
								<td colspan="3" align="left"><strong>Permintaan Stok</strong><hr></td>
							</tr>
    						<tr>
                                <form method="post" action="home.php?hal=content/daftar_dokumen_farmasi" enctype="multipart/form-data" name="frmSpbSearch">
        							<td width="100px">
        								<input type="text" name="cari_spp" id="cari" />
        							</td>
        							<td>
        								&nbsp;<input type="submit" value="Cari SPP" />  &nbsp;
        							</td>
    							</form>
    							<td width="80px">
    								<!--
    								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
    								-->
    							</td>
    					   </tr>
						   <tr>
						   		<td colspan="3"></td>
						   </tr>
					</table>
					
					
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 1;
									$ppmonth = date ("m") + 0;
									$pyear = date("Y") + 0;
							$query2  = mysql_query ("SELECT * FROM permintaan_unit ORDER BY No_SPP DESC");
																		
							echo '<table cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF>Tanggal SPP</font></td>
										<td><font color=#FFFFFF>No. SPP</font></td>
										<td><font color=#FFFFFF>Unit</font></td>
										<td><font color=#FFFFFF width=110px>Applyed</font></td>
										<td><font color=#FFFFFF width=140px >Status</font></td>
										
									</tr>';
									$no = 1;
									while ($result2 = mysql_fetch_array($query2))
									{
										if ($no%2)
										{
											if ($result2['status']==0)
											{
												echo "<tr valign=top bgcolor=red>";
											}
											else
											{
												echo "<tr valign=top>";
											}
										}
										else
										{
											if ($result2['status']==0)
											{
												echo "<tr valign=top bgcolor=red>";
											}
											else
											{
												echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
											}
										}
										
										
										echo "<td align=center width=80px>$result2[Tgl_SPP]</td>
											<td align=center width=110px><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_SPP.php?No_SPP=$result2[No_SPP]', 'myPop1',800,400);\">".$result2['No_SPP']."</a></td>";
											
											$qunit = mysql_query("select * from pelayanan where id='".$result2['Unit']."'");
											$runit = mysql_fetch_array($qunit);
											
											echo "<td align=center>".$runit['nama']."</td>";										
											
											$qstatus = mysql_query("select * from status where id='".$result2['status']."'");
											$rstatus = mysql_fetch_array($qstatus);
											
											echo "<td align=center>".$result2['UsrBuat']."</td>";	
											echo "<td align=center>".$rstatus['nama']."</td>";
										
											
										echo "</tr>";
										$no++;
									}
									$no_f=$no-1;
									echo'</table>';
							?>
							</td>
						</tr>
					</table>
					</div>
					
						 
<!--   END GRID   -->
<!-- ************ -->
<!-- START FOOTER -->
                    </td>
                </tr>
           </table>
        </td>
     </tr>
     <tr>
        <td><img src="images/bawah_isi.png" /></td>
     </tr>
</table>
        