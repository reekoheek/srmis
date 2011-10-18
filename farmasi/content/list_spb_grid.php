<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>List Surat Permintaan Barang</title>
</head>
<body>
<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 */

//die ("<center><h1> NYANG NIE MASIH DI KUNCI DULU, LANJUT KE LIST PURCHASE AJA .... </H1></CENTER> ");


$cari = $_POST['spbno'];
$tgl = $_POST['tgl'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar SPB</b></font></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png" /></td>
	</tr>
	<tr>
		<td id="tengah_isi">
			<table border="0" cellpadding="0" cellspacing="0" width="98%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
                    
<!--  START HEADER -->     
						           
    					<font style="font-size:12px;">
    					<table border="0" cellpadding="2" cellspacing="2" width="99%">
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
						   		<td colspan="3"><hr></td>
						   </tr>
    			         </table>
<!-- END HEADER  -->
<!-- **********  -->                         
<!-- START GRID  -->                         
                         
                         <div style="border:1px  solid  #CCCCCC; width:670px; height:400px; overflow:auto;">
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
                                $strSqlHeader = "SELECT * FROM v_spb_list ";
                                
                                if (!empty($cari)){
                                    $strSqlHeader=$strSqlHeader . " where a.spb_no like '%".$cari."%' ";                                    
                                }else{
                                    $strSqlHeader= $strSqlHeader . " ";
                                }
                                ?>
                                <!-- HEADER TABLE -->                                    
                                <table cellpadding=2 cellspacing=2 width=670px>
        							<tr bgcolor=#414141 align=center>
            							<td width=60px>
                                            <font color=#FFFFFF>No Surat</font></td>
            							<td width=50px>
                                            <font color=#FFFFFF>Tanggal </font></td>            							
            							<!--<td width=80px>
                                            <font color=#FFFFFF>Total</font></td>-->    
                                        <td width=30px>
                                            <font color=#FFFFFF>Request By</font></td>
            							<td width=30px>
                                            <font color=#FFFFFF>Status</font></td>
            							<td width=50px>
                                            <font color=#FFFFFF>PO Created</font></td>

            							<td width=50px colspan="2">
                                            <font color=#FFFFFF>Action</font></td>
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
                                                ?>

                                                <?php
                                                if ($no%2){                                                    
      												echo "<tr valign=top>";                                                    
        										}else{        										  
        											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
        										}                                                
                                                if ($fetchHeader[po_created]==0){
                                                    $poStatus = "NONE";
                                                }else{
                                                    $poStatus = "PO Created";
                                                }
                                                ?>
                                                <td align=center><?=$fetchHeader[spb_no]?></td>
                                                <td align=right><?=$fetchHeader[tgl_req]?></td>
                                                <!--<td align=right><?=rupiah($fetchHeader[total])?></td>-->
                                                <td align=center><?=$fetchHeader[request_by]?></td>
                                                <td align=center><?=$fetchHeader[status]?></td>
                                                <td align=center><?=$poStatus?></td>
                                                <td width='50px' align='center' style='padding-bottom: 2px; padding-top: 2px;'>
                                                <div id="frm<?=$no?>">
                                                    <form method="post" action="home.php?hal=content/list_spb" enctype="multipart/form-data" name="frm<?=$no?>">
                                                        <input type="hidden" name="stream" value="<?=$fetchHeader[id]?>" />
                                                <?php
                                                $stream = $fetchHeader[id];
                                                if ($fetchHeader[po_created]==0){
                                                    print ("<input type=submit name=submit value='Create PO' /></td>
                                                    </form><div></tr>");
                                                }else{
                                                ?>
                                                    <a style="border: 1px solid #CCCCCC; background-color: #F0F0F0; text-decoration: none; border-spacing: 2px" 
                                                    href="home.php?hal=content/po_processing&stream=<?php echo $stream ; ?>">
                                                        View PO
                                                    </a>
                                                <?php
                                                    echo (" </td></form></div></tr>");
                                                }
                                                $no++;
                                            }
                                        ?>                                
                                </table> 
                                
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
        