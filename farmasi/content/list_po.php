<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>List PO</title>
</head>
<body>

<?php

/**
 * @author Jalu Ahmad Pambudi
 * @copyright 2011
 * @link http://yoursite.yourdomain/home.php?hal=content/list_po
 * @param $cari = search box
 * 
 */
$cari      = $_POST['pono'];
$typeUser  = $_SESSION['U_SUBUNIT'];
$unitType  = $_SESSION['U_UNITID'];
$flags     = $_GET['sent'];
if (empty($flags)){$flags = $_POST['sent'];}

//die($groupUser . $unit);
/*foreach ($GLOBALS['_SESSION'] as $gl => &$val){
    echo "$gl  :  ";
    print_r ($val) ;
    echo "<br /> \n";
}
*/
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Daftar Purchase Order</b></font></td>
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
    							<td width="100px">
                                    <form method="post" action="home.php?hal=content/list_po" enctype="multipart/form-data" name="frmPOSearch">
                                    <table>
                                    <tr>
                                        <td>
            								<input type="text" name="pono" id="pono" />
            							</td>
            							<td>
            								&nbsp;<input type="submit" value="Cari PO" />  &nbsp;
            						  	</td>
                                    </tr>
                                    </table>
        							</form>
    							<td width="80px" align="right">
                                  <form action="home.php?hal=content/po_man" name="frmManPO" id="frmManPO" method="POST" enctype='multipart/form-data'>
                                    <input type="submit" value="Manual PO" id="submitMan" />
                                    <input type="hidden" name="po_man" value="1" />
                                   </form>
    							</td>
    					   </tr>
						   <tr>
						   		<td colspan="3"><hr /></td>
						   </tr>
    			         </table>
<!-- END HEADER  -->
<!-- **********  -->                         
<!-- START GRID  -->                         
                         <div style="border:1px  solid  #CCCCCC; width:670px; height:400px; overflow:auto;">
                         <table border="0" cellpadding="0" cellspacing="0" width="100%">
                         <tr>
                            <td>
                                <!-- HEADER TABLE -->    
                                <table cellpadding=2 cellspacing=2 width=670px>
        							<tr bgcolor=#414141 align=center>
            							<td width=60px>
                                            <font color=#FFFFFF>No PO</font></td>
            							<td width=50px>
                                            <font color=#FFFFFF>Tanggal </font></td>            							
            							<td width=80px>
                                            <font color=#FFFFFF>Total</font></td>
                                        <td width=30px>
                                            <font color=#FFFFFF>Created By</font></td>
            							<td width=30px>
                                            <font color=#FFFFFF>Status</font></td>
            							<td width=30px>
                                            <font color=#FFFFFF>Canceled</font></td>

            							<td width=50px>
                                            <font color=#FFFFFF>Action</font></td>
                                        <!--    
            							<td>
                                            <font color=#FFFFFF>Status</font></td>
            							<td>
                                            <font color=#FFFFFF>Jenis</font></td>
                                        -->     
            						</tr>                            
                                <?php
                                /**********************/
                                /* START GRID CONTAIN */
                                /**********************/                    
                                $rowsPerPage = 20;
            					$pageNum = 1;
                                $stream = 0;
            					if(isset($_GET['page']))
            					{
            						$pageNum = $_GET['page'];
            					}  
            					$offset = ($pageNum - 1) * $rowsPerPage;
                                $strSqlHeader = "select distinct 
                                a.id, a.po_no, a.tgl_po, a.grand_total, a.created_user as createBy,
                                a.flags as status, a.usr_cancel as canceledBy
                                from purchase_order a ";
                                
                                if (!empty($cari) || !empty($flags) ){
                                    $strSqlHeader=$strSqlHeader . " where a.flags = $flags and a.po_no like '%".$cari."%'  " ;                                    
                                }else{
                                    $strSqlHeader= $strSqlHeader . " ";
                                }
 
                                $no= 1;
                                $resHeader = mysql_query($strSqlHeader) or die (mysql_error()); 
                                    ?>
                                 <!--  END HEADER  -->
                                 <!-- START DETAIL -->
                                        <?php
                                            while($fetchHeader=mysql_fetch_array($resHeader)){
                                                if ($no%2){
      												echo "                                                      
                                                      <tr valign=top>
                                                      ";
        										}else{
        											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
        										}
                                                echo "<div><form method='post' action='home.php?hal=content/po_processing' enctype='multipart/form-data'>";
                                                switch($fetchHeader['status']){
                                                    case 1:
                                                        $poStatus = "Closed";
                                                    break;
                                                    case 2:
                                                        $poStatus = "Receiving";
                                                    break;
                                                    case 3:
                                                        $poStatus = "Approved";
                                                    break;
                                                    case 4:
                                                        $poStatus = "Generated";
                                                    break;
                                                    case 5:
                                                        $poStatus = "Open";
                                                    break;
                                                    case 6:
                                                        $poStatus = "Canceled";
                                                    break;
                                                    default:
                                                        $poStatus = "Open";
                                                    break;
                                                }                                                
                                                $canceledStatus = $fetchHeader['canceledBy'];
                                                if ((empty($canceledStatus))) {
                                                    $canceledStatus = " -- ";
                                                }
                                                $datePO = substr($fetchHeader[tgl_po],0, 10);
                                                $stream = $fetchHeader['id'];
/*                                                if ($fetchHeader[]==0){
                                                    $poStatus = "NONE";
                                                }else{
                                                    $poStatus = "PO Created";
                                                }
*/
                                                echo(
                                                "<td align=center>$fetchHeader[po_no]</td>
                                                <td align=right> $datePO</td>
                                                <td align=right>") ;
                                                rupiah($fetchHeader[grand_total]);
                                                echo(
                                                "</td>
                                                <td align=center>$fetchHeader[createBy]</td>
                                                <td align=center>
                                                    $poStatus
                                                    <input type=hidden name='flags' value='$fetchHeader[status]' />
                                                </td>
                                                <td align=center>$canceledStatus</td>                                                
                                                <td align=center>");
                                                ?>
                                                    <input type="hidden" name="stream" value="<?=$stream?>" />
                                                    <input type="submit" name="submit" value='Process PO' id='submit' />
                                                <?php
                                                print ("</td> </form></div></tr> ") ;
                                                $no++;
                                            }
                                        ?>
                                        </td>
                                    </tr>                                    
                                 </table>

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
                                        