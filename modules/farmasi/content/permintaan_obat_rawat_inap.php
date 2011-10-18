<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<script type="text/javascript">
<!-
function startCalculate(){
interval=setInterval("Calculate()",10);
}

function Calculate(){
var a=document.form1.ap.value;
var b=document.form1.harga_dosp.value;
//var c=document.form1.jml_barang.value
document.form1.sub_total.value=(a*b);
}

function stopCalc(){
clearInterval(interval);
}
//->
</script>

</head>
<body>
<?php
/*$tahun = date("Y");
$qp= mysql_query("SELECT * FROM permintaan_unit WHERE LAST_INSERT_ID(ID) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);
$tgl = substr($rp['Tgl_SPP'],0,4);
if ($tgl == $tahun)
{
	$temp = $rp['ID'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}


$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_SPP = "SPP/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$id = $count;
*/

$no_SPP = $_GET['No_SPP'];
$qar=mysql_query("SELECT * FROM permintaan_unit WHERE No_SPP = '$no_SPP'");
$rar=mysql_fetch_array($qar);

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa" style="font-size:14px;">Permintaan Pemakaian Obat </font></b></td>
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
							<td>Tanggal</td>
						  <td><?php
									$date=date("d/m/Y");
								?>
						    :
						    <input type="text" size="12" name="tgl" value="<?= $_GET['Tgl_SPP']?>" style="background-color:#CCCFFF; " readonly="true">
                          </td>
							
							<td width="70px" align="right"></td>
							
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
						<td>: <input type="text" name="unit" value="<?= $_SESSION['U_NMUNIT']?>" readonly="true" style="background-color:#CCCFFF; "></td>
						<td width="70px" align="right">
						  <form method="post" enctype="multipart/form-data" action="home.php?hal=content/input_permintaan_obat_rawat_inap">
							<input type="hidden" name="no_SPP" value="<?= $_GET['No_SPP']?>">
							<input type="hidden" name="id" value="<?= $id?>">
							<input type="hidden" name="tgl" value="<?= $_GET['Tgl_SPP']?>">
						  	<input type="submit" value="Tambah Obat">
						  </form>
						  </td>
					  </tr>
						
					</table>
					<hr>
					
					<form method="post" action="home.php?hal=content/list_spb_rawat_inap" enctype="multipart/form-data" id="form1" name="form1">
					<input type="hidden" name="no_SPP" value="<?= $_GET['No_SPP']?>">
							<input type="hidden" name="id" value="<?= $id?>">
							<input type="hidden" name="tgl" value="<?= $_GET['Tgl_SPP']?>">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
									$pdate = date ("d") + 0;
									$pmonth = date("m") + 1;
									$ppmonth = date ("m") + 0;
									$pyear = date("Y") + 0;
 							$query2  = mysql_query ("SELECT * FROM ms_barang,permintaan_unitdetail WHERE ms_barang.kd_barang = permintaan_unitdetail.barang_id
										AND permintaan_unitdetail.No_SPP='".$_GET['No_SPP']."' AND permintaan_unitdetail.flags=1");
																		
							echo "<div style='border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;'>";
								echo '<table cellpadding=2 cellspacing=2 width=1100px>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF width=130px>Nama</font></td>
										<td><font color=#FFFFFF width=30px>Satuan</font></td>
										<td><font color=#FFFFFF width=20px>Jumlah Stock</font></td>
										<td><font color=#FFFFFF width=120px>Expired</font></td>
										<td><font color=#FFFFFF width=20px>Unit</font></td>
										<td><font color=#FFFFFF width=80px>Action</font></td>
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
											<td width=30px align=left>$result2[36]</td>
											<td width=30px align=right>$result2[Qty]</td>";
											
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
											
											$qunit = mysql_query("select * from pelayanan where id='".$result2['Unit']."'");
											$runit = mysql_fetch_array($qunit);
											
											echo "<td align=left width=70px>".$runit['nama']."</td>";
											
											echo 	"<td align=center width=80px>
													<a href=\"home.php?hal=action/hapus_permintaan_obat_rawat_inap&kd_barang=$result2[kd_barang]&id=$result2[id]&No_SPP=$result2[No_SPP]&Tgl_SPP=$rar[Tgl_SPP]\" 
												  onClick=\"return confirm('Apakah Anda benar-benar akan membatalkan $result2[nama]?')\">
												  <font size=-1>BATAL</font></a>
												  </td>
												  </td>
												  </tr>";
										
										$no++;
									}
									$no_f=$no-1;
									echo "<input type=hidden name=param value='$no_f'>";								
									echo '</table></div>';
									echo '<hr>';
							?>
							</td>
						</tr>
						</form>
						<tr>
							<td>
								
								<table width="100%">
									<tr>
									<td>
										<table width="100%">
											<tr>
											<td width="100">User Buat</td>
											<td>: <input type="text" size="20" name="" value="<?=$_SESSION['U_USER']?>"  readonly="true" style="background-color:#CCCFFF; "></td>
											</tr>
										</table>
									</td>
									<td align="right" valign="top">
									<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_distribusi_rawat_inap">
									<input type="hidden" name="no_SPP" value="<?= $_GET['No_SPP']?>">
									<input type="hidden" name="id" value="<?= $id?>">
									<input type="hidden" name="tgl" value="<?= $_GET['Tgl_SPP']?>">
									<input type=submit value="Buat Request"></form></td>
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