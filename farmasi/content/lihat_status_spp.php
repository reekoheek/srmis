<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php


$no_SPP = $_GET['No_SPP'];
$user = $_GET['UsrBuat'];
$No_BTB = $_GET['No_BTB'];
$UsrRetur = $_SESSION['U_USER'];

$qar=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
$rar=mysql_fetch_array($qar);

		$q=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP='$No_SPP' AND status = '7'");
		$r=mysql_fetch_array($q);
		
		//echo $q;
		if ($r)
		{
			print "<script>location.href='home.php?hal=content/list_BTB'</script>";
		}

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa" style="font-size:14px;">Bukti Terima Barang </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
					<tr>
                          <td align="left" width="100">No BTB </td>
							<td>
							: <input type="text" size="20" name="no_BTB" value="<?= $rar['No_BTB']?>" style="background-color:#CCCFFF; " readonly="true">
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					<tr>
                          <td align="left" width="100">No BPB </td>
							<td>
							: <input type="text" size="20" name="no_BPB" value="<?= $rar['No_BPB']?>" style="background-color:#CCCFFF; " readonly="true">
							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					  <tr>
                          <td align="left" width="100">No SPP </td>
							<td>
							: <input type="text" size="20" name="no_SPP" value="<?= $_GET['No_SPP']?>" style="background-color:#CCCFFF; " readonly="true">
							<input type="hidden" size="20" name="id" value="<?= $id?>">							</td>
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
						  <td width="70px" align="right">						  </td>
					  </tr>
					  <tr>
					  	<td>Unit</td>
						<td>: <input type="text" name="unit" value="<?=$_SESSION['U_NMUNIT']  ?>" readonly="true" style="background-color:#CCCFFF; " size="60"></td>
						<td width="70px" align="right">
						  
						  </td>
					  </tr>
						
					</table>
					<hr>
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 1;
									$ppmonth = date ("m") + 0;
									$pyear = date("Y") + 0;
 							$query2  = mysql_query ("SELECT * FROM ms_barang,permintaan_unitdetail WHERE ms_barang.id = permintaan_unitdetail.barang_id
										AND permintaan_unitdetail.No_SPP='".$_GET['No_SPP']."' AND permintaan_unitdetail.flags=1 AND permintaan_unitdetail.status_detail <> 6");
																		
							echo "<div style='border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;'>";
								echo '<table cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF width=130px>Nama</font></td>
										<td><font color=#FFFFFF width=30px>Satuan</font></td>
										<td><font color=#FFFFFF width=20px>Diminta</font></td>
										<td><font color=#FFFFFF width=20px>Diberi</font></td>
										<td><font color=#FFFFFF width=120px>Expired</font></td>
										<td><font color=#FFFFFF width=50px>Status</font></td>
										<td><font color=#FFFFFF width=60px>Action</font></td>
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
										
										
										echo "<td width=70px>$result2[kd_barang]</td>
											<td width=120px>$result2[nama]</td>
											<td width=30px align=left>$result2[satuan]</td>
											<td width=30px align=right>$result2[Qty]</td>
											<td width=30px align=right>$result2[Qty_diberi]</td>";
											
											//echo "<td></td>";
											if (($pmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
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
											
											
											//$qunit = mysql_query("select * from pelayanan where id='".$result2['Unit']."'");
											//$runit = mysql_fetch_array($qunit);
											
											
											
										    //echo "<td align=left width=70px>$runit[nama]</td>";
												  
											$qstatus = mysql_query("select * from status where id='".$result2['status_detail']."'");
											$rstatus = mysql_fetch_array($qstatus);
											echo "<td width=50px align='center'>".$rstatus['nama']."</td>";
											
											if ($result2['status_detail'] == 3)
											{
											echo "<td>Watting List</td>";
											}
											
											echo "<td width=60px align=center>
											<a href='javascript:void(0);' onClick=\"PopupCenter('content/input_buat_retur.php?UsrRetur=$UsrRetur&No_SPP=$result2[No_SPP]&id=$result2[id]', 'myPop1',800,400);\">BUAT RETUR</a></td>";
											
											/*else if ($result2['status_detail'] == 2)
											{
											echo "<td width=100px align=center>
											<a href='javascript:void(0);' onClick=\"PopupCenter('content/input_buat_retur.php?UsrRetur=$UsrRetur&No_SPP=$result2[No_SPP]&id=$result2[id]', 'myPop1',800,400);\">BUAT RETUR</a>
											| 									
											<a href='home.php?hal=action/terima_barang&id=$result2[barang_id]&id=$result2[id]&id_ms=$result2[0]&No_SPP=$result2[No_SPP]&No_BTB=$rar[No_BTB]&No_BPB=$rar[No_BPB]'>Received</a>
											</td>";
											}
											else if ($result2['status_detail'] == 9)
											{
											echo "<td>".$rstatus['nama']."</td>";
											}*/
											echo "</tr>";
										
										$no++;
									}
									$no_f=$no-1;
									echo "<input type=hidden name=param value='$no_f'>";								
									echo '</table></div>';
									echo '<hr>';
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
											<td width="100">User Buat</td>
											<td>: <input type="text" size="30" name="" value="<?=$rar['UsrBuat']?>"  readonly="true" style="background-color:#CCCFFF; "></td>
										</tr>
										<tr>
											<td width="100">User Approve </td>
											<td>: <input type="text" size="30" name="" value="<?=$rar['UsrApprove']?>"  readonly="true" style="background-color:#CCCFFF; "></td>
										</tr>
									</table>
									</td>
									<td align="right" valign="top">
										<?php
										if ($rar['flags_unit']==0)
										{
										?>
											<form method="post" enctype="multipart/form-data" action="home.php?hal=action/terima_barang_unit">
												<input type="hidden" name="No_BTB" value="<?= $rar['No_BTB']?>">
												<input type="hidden" name="No_BPB" value="<?= $rar['No_BPB']?>">
												<input type="hidden" name="No_SPP" value="<?= $rar['No_SPP']?>">
												<input type="submit" value="Terima Barang">
											</form>
										<?php
										}
										else
										{
										?>
											<form method="post" enctype="multipart/form-data" action="home.php?hal=action/terima_barang_unit">
												<input type="hidden" name="No_BTB" value="<?= $rar['No_BTB']?>">
												<input type="hidden" name="No_BPB" value="<?= $rar['No_BPB']?>">
												<input type="hidden" name="No_SPP" value="<?= $rar['No_SPP']?>">
												<input type="submit" value="Terima Barang" disabled>
											</form>	
										<?php
										}
										?>
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
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>
