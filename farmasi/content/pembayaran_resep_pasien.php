<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Untitled Document</title>
</head>
<body>
<?php
//$pasien_id = $_POST['pasien_id'];
$id_resep = $_GET['noresep'];
$id_pasien = $_GET['id'];
$namapasien=$_GET['nama'];
//$date=date("d/m/Y");

$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$month = date("m");
$qp= mysql_query("SELECT * FROM penjualan_head WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['tgl'],5,2);
if ($tgl == $month)
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
$no_trans = "TRK/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;


?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Pembayaran Resep Pasien</b></font></td>
				<td><div align="right">
				  <label></label>
				</div></td>
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
					<table border="0" cellpadding="2" cellspacing="2" width="100%" >
					<tr>
							<td>No Transaksi </td>
							<td><input type="text" name="no_trans" value="<? echo $no_trans;?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							<td></td>
						</tr>
					<tr>
							<td>No Resep </td>
							<td><input type="text" name="no_resep" value="<? echo $id_resep;?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							<td></td>
						</tr>
						<tr>
							<td>No RM </td>
							<td><input type="text" name="no_rm" value="<? echo $id_pasien; ?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							<td></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><input type="text" name="nama_pasien" value="<? echo $namapasien; ?>" readonly="true" size="40" style="background-color:#CCCFFF; "></td>
						  <td></td>
					  </tr>
						
					</table>
					
					<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">

								<?php
									$no=1;					
									$qr=mysql_query("select * from resep where no_resep='$id_resep'");
									echo "<table border=0 cellpadding=2 cellspacing=2 width=800px style='border:0px  solid  #CCCCCC overflow:scroll';>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=65px>Kode</font></td>
												<td><font color=#FFFFFF width=250px>Obat</font></td>
												<td><font color=#FFFFFF width=45px>Racikan</font></td>
												<td><font color=#FFFFFF width=160px>Dosis</font></td>
												<td><font color=#FFFFFF width=40px>Jml</font></td>
												<td><font color=#FFFFFF width=90px>Harga</font></td>
												<td><font color=#FFFFFF width=90px>Sub Total</font></td>
												<td><font color=#FFFFFF>Ket</font></td>
											</tr>";
											
									
									
					
									while ($rr = mysql_fetch_array($qr))
									{
			
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$rr[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
										$qd = mysql_query ("SELECT * FROM dosis WHERE id = '$rr[dosis_id]'");
										$rd = mysql_fetch_array($qd);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td width=65px>$rr[kode_obat]</td>";
											if($rr['racikan']=='YA')
											{
												echo "<td width=250px><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_resep=$rr[no_resep]', 'myPop1',800,400);\">$rr[fld01]</a></td>";
											}
											else
											{
												echo "<td width=250px>$ro[nama]</td>";
											}
										echo "<td width=45px align=center>$rr[racikan]</td>
											<td width=160px>$rd[deskripsi] ($rr[ket])</td>
											<td width=40px align=right>$rr[diberi]</td>
											<td align=right width=90px>";
											 	rupiah($ro[harga_dosp]);
										echo "</td>
											<td align=right width=90px>";
											 	rupiah($rr[sub_total]);
										echo "</td>
											<td>$rr[ket_banyak]</td>
											</tr> ";
										$no++;
										
									}
									echo "<tr>
											<td colspan=8>
											</table>";
									?></table>
									<form method="post" action="home.php?hal=content/pembayaran_resep_pasien&noresep=<? echo $id_resep; ?>&id=<? echo $id_pasien; ?>&nama=<? echo $namapasien ?>">
									<table border="0" cellpadding="1" cellspacing="2" width="100%">
					<?php
					$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep='$id_resep'");
					$r3=mysql_fetch_array($q3);
					$sub = $r3['SUM(sub_total)'];
					$ppn = (10/100) * $sub;
					$grand = $sub + $ppn;
					$bayar=$_POST['u_bayar'];
					if($_POST['u_bayar']){
					if($bayar<$grand){ echo"<script>alert('Maaf, Uang Anda Kurang');location.href='home.php?hal=content/pembayaran_resep_pasien&noresep=$id_resep&id=$id_pasien&nama=$namapasien'</script>"; }
					else{
					$kembali=$bayar-$grand;
				print "<script>alert('Menyimpan transaksi $no_trans . Tunai : $bayar .  Kembali : $kembali');location.href='home.php?hal=action/insert_pembayaran_resep&no_transaksi=$no_trans&bayar=$bayar&total=$grand&no_resep=$id_resep&paramno=$param_no&namapas=$namapasien'</script>"; }
				}
					else
					{
					$bayar=0;
					$kembali=0;
					}
					?><font size="-1">
						</font>
					
					<tr>
						<td width="600px" align="right">&nbsp;</td>
						<td colspan="2"><font size="-1">
							  <div align="right"><font size="-2">
							    Sub Total </font>
						        <input type="text" name="sub_tot" size="20" value="<?php rupiah($r3['SUM(sub_total)'])?>" readonly></div></td></tr>
								
								<tr>
						<td width="200px" align="right">&nbsp;</td>
						<td colspan="2">
							  <font size="-2"><div align="right"><font size="-2">PPN</font> 
							    <input type="text" name="ppn" size="20" value="10% (<?php rupiah($ppn)?>)" readonly></div></td></tr>
								<tr>
						<td width="7" align="right">&nbsp;</td>
						<td colspan="2">
						     <font size="-2"><div align="right"><font size="-2"> Grand Total</font>
						      <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>" readonly=></div></td></tr>
					    
					
					
					
					<tr>
						<td align="right">&nbsp;</td><td width="582" align="right">
							  <div align="right"><font size="-2">Bayar </font></div>
							</td>
						<td width="122" align="right"><font size="-1">
						  <input type="text" name="u_bayar" size="20" value="<? echo $bayar ?>" >
					  </font></td><td width="21">&nbsp;</td>
						</tr>
					<font size="-1">						</font>
					<tr>
						<td align="right">&nbsp;</td><td align="right"><font size="-2">
							  <div align="right">Kembali </div>
							</font></td>
						<td width="122" align="right"><font size="-1">
						  <input type="text" name="kembali" size="20" value="<?php rupiah($kembali)?>" readonly=>
					  </font></td><td width="21">&nbsp;</td>
						</tr>
					<font size="-1">
						<input type="submit" name="byr" style="visibility:hidden" >
						</font>
					                                                                                </table>
</form>
									
									
									<?php
										echo "</td>
												</tr>";
									
									
									echo "</fieldset><br>";
									
								?>
							</td>
						</tr>
					
					</div>
					</font>
					</td>
					
				</tr>
			
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>
