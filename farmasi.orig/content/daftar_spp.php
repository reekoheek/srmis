<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type=�text/css�>
@media print {
input.noPrint { display: none; }
}
</style>

</head>
<body>
<?php
include "../include/koneksi.php";
$no_SPP = $_GET['No_SPP'];
$user = $_GET['UsrBuat'];
$qar=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
$rar=mysql_fetch_array($qar);

$qyu=mysql_query("SELECT * FROM pelayanan WHERE id='$rar[Unit]'");
$ryu=mysql_fetch_array($qyu);

?>
<link rel="stylesheet" type="text/css" href="../include/style.css">
<center><fieldset style="width:90%;"><legend style="background-color:#9b9999;"><b><font color="#fefafa" style="font-size:14px;">&nbsp;&nbsp;Bukti Terima Barang&nbsp;&nbsp;</font></b></legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td><img src="images/#.png"></td>
	</tr>
	<tr>
		<td id="" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
					<tr>
                          <td align="left" width="100">No BTB </td>
							<td>
							: <?= $rar['No_BTB']?>
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right"></td>
					  </tr>
					<tr>
                          <td align="left" width="100">No BPB </td>
							<td>
							: <?= $rar['No_BPB']?>
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					  <tr>
                          <td align="left" width="100">No SPP </td>
							<td>
							: <?= $_GET['No_SPP']?></td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					  <tr>
					  	<td>Unit</td>
						<td>: <?= $ryu['jenis']?></td>
						<td width="70px" align="right"><input class="noPrint" type="button" value="Print" onclick="window.print()"></td>
					  </tr>
						
					</table>
					<hr>
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
								
								$query2  = mysql_query ("SELECT * FROM ms_barang,permintaan_unitdetail WHERE ms_barang.id = permintaan_unitdetail.barang_id
										AND permintaan_unitdetail.No_SPP='".$_GET['No_SPP']."'");
																		
							echo "<div style='border:1px  solid  #CCCCCC; width:100%; height=400px; overflow:auto;'>";
								echo '<table cellpadding=2 cellspacing=2 width=100%>
									
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF width=130px>Nama</font></td>
										<td><font color=#FFFFFF width=30px>Satuan</font></td>
										<td><font color=#FFFFFF width=20px>Jumlah Stock</font></td>
										<td><font color=#FFFFFF width=120px>Expired</font></td>
										<td><font color=#FFFFFF width=100px>Status</font></td>
									</tr>';
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
										
										$qu=mysql_query("SELECT * FROM satuan WHERE kd_satuan='$result2[satuan]'");
										$ru=mysql_fetch_array($qu);
										
										echo "<td width=70px>$result2[kd_barang]</td>
											<td width=120px>$result2[nama]</td>
											<td width=30px align=left>$ru[deskripsi]</td>
											<td width=30px align=right>$result2[Qty_diberi]</td>";
											
											//echo "<td></td>";
											if (($pmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
											}
											else if (($pmonth > $result2['ex_month']) AND ($pyear > $result2['ex_year']) AND ($pdate > $result2['ex_date'])) 
											{
												$qy = mysql_query("UPDATE ms_barang SET status='Non-Aktif' WHERE kd_barang='$result[kd_barang]'"); 
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}
											else if (($ppmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
											}
											else
											{
											 	echo "<td width=70px align=center>$result2[expire_date]</td>";
											}
											
										
											$qs=mysql_query("SELECT * FROM status WHERE id='$result2[status_detail]'");
											$rs=mysql_fetch_array($qs);
												echo "<td width=140px align=center>$rs[nama]</td>";
											/*if ($result2['status_detail']==1)
											{
												echo "<td width=140px align=center>NOT APPROVAL</td>";
											}
											else if ($result2['status_detail']==2)
											{
												echo "<td width=140px align=center>APPROVAL</td>";
											}
											else if ($result2['status_detail']==3)
											{
												echo "<td width=140px align=center>PENDING</td>";
											}
											else if ($result2['status_detail']==4)
											{
												echo "<td width=140px align=center>CANCEL</td>";
											}*/
											echo"</tr>";
										
										$no++;
									}
									echo '</table>';
							?>
							</td>
						</tr>
						<tr>
							<td>
								
								<table width="100%">
									<tr>
									<td>
									<table width="100%">
										<tr>
											<td width="100">Created by User</td>
											<td>: <?=$rar['UsrBuat']?></td>
										</tr>
										<tr>
											<td width="100">Approved by User</td>
											<td>: <?=$rar['UsrApprove']?></td>
										</tr>
										<tr>
											<td width="100">Received by User</td>
											<td>: <?=$rar['UsrReceived']?></td>
										</tr>
									</table>
									</td>
									<td align="right" valign="top">
										
									</td>
									</tr>
							  </table>	
							</td>
						</tr>
						
					</table>
					</font>
					
					</td>
					<td width="15px"><p>&nbsp;</p>
				    <p>&nbsp;</p></td>
					
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="#"></td>
	</tr>
</table>
</fieldset></center>
</body>
</html>
