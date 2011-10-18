<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="include/counter.js">

function startCalculate(){
interval=setInterval("Calculate()",10);
}

function Calculate(){
var a=document.formreq.ap.value;
var b=document.formreq.harga_dosp.value;
//var c=document.form1.jml_barang.value
document.form1.sub_total.value=(a*b);
}

function stopCalc(){
clearInterval(interval);
}

</script>

</head>
<body>
<?php
$tahun = date("y");
$qp = mysql_query("SELECT * FROM mr WHERE type='SPB'");
$rp = mysql_fetch_array($qp);
$lastNO = $rp['full_no'];
$tgl = substr($lastNO,8,2);

if ($tgl == $tahun)
{    
	$count = $rp['next_no'];
    $no_req = getNextNo('SPB', 'content/mr_auto');
}
else
{ 
	$count = 1;
    $no_req = resetNo('SPB','content/mr_auto');
}
/*
if ($tgl == $tahun)
{
	$temp = $rp['param_no'];
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
$no_req = "SPB/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
*/
$param_no = $count;

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Proses Request</b></font></td>
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
			<form method="post" action="home.php?hal=action/insert_proses_req" enctype="multipart/form-data" id="formreq" name="formreq">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="left" width="100px">No Request </td>
							<td>
							: <input type="text" size="20" name="no_req" value="<?php echo $no_req ; ?>" style="background-color:#CCCFFF; " readonly="true" />
							<input type="hidden" size="20" name="param_no" value="<?php $param_no ; ?>" />
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
								: <input type="text" size="12" name="xdate" value="<?= $date?>" style="background-color:#CCCFFF; " readonly="true" />
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
 							$query2  = mysql_query ("SELECT distinct * FROM ms_barang,req_pembelian 
                                        WHERE ms_barang.kd_barang = req_pembelian.kd_barang 
                                        and req_pembelian.aktivasi=1 and ms_barang.flags = 2");
																		
							echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF>Nama</font></td>
										<td><font color=#FFFFFF>Stok</font></td>
										<td><font color=#FFFFFF>H Beli</font></td>
										<td><font color=#FFFFFF width=140px>Expired</font></td>
                                        <td><font color=#FFFFFF width=70px>Stok Min</font></td>
										<td><font color=#FFFFFF width=70px>Stock Req</font></td>
										<td><font color=#FFFFFF>Sub Total</font></td>
									</tr>';
									$no = 1;
									while ($result2 = mysql_fetch_array($query2))
									{
//									   print_r ($result2);                                       
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										
										
										echo "<td width=70px>$result2[kd_barang]</td>
											<td>$result2[nama]</td>
											<td align=right>$result2[stok]</td>
											<td align=right name='harga_dosp' id='harga_dosp' >
                                            <input type=hidden name='harga$no' value='$result2[harga_dosp]' />";
											rupiah($result2[harga_dosp]);
											echo "</td>";
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
											
											echo "<td align=right name='min_stok'> $result2[stok_min] </td>";
											echo "<td align=center width=70px>";
											$date = date("d/m/Y");											
											echo "<input type=text name='ap".$no."' size=8 onchange='startCalculate()' onblur='stopCalc()' id='ap'>												  
												  <input type=hidden name='ap2".$no."' value='".$result2['kd_barang']."'></td>
												  <td align=center>
                                                  <input type=text size=15 name=sub_total id=sub_total onchange='startCalculate()' onblur='stopCalc()'></td>
												  </tr>
                                                  <input type=hidden name='idme".$no."' value ='".$result2[0]."' />
                                                  ";
										$no++;
									}
									$no_f=$no-1;
									echo "<input type=hidden name=param value='$no_f'>";
									echo "<tr><td colspan=7 align=right>Grand Total : </td><td align=center><input type=text size=15 name=grand_total></td></tr>";
									echo "<tr><td colspan=8><hr></td></tr><tr><td colspan=7></td><td align=center><input type=submit value='Proses Request'></td></tr>";
									
									echo '</table>';
							?>
							</td>
                            
						</tr>
					</table>
					</font>
					</form>
					</td>
					<td width="15px">&nbsp;</td>
                    
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
 
</table>
</body>
</html>
