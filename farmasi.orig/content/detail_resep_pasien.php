<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Untitled Document</title>
<style type="text/css">
<!--
-->
</style>
</head>
<body>
<?php
//$pasien_id = $_POST['pasien_id'];
$id_resep = $_GET['noresep'];
$id_pasien = $_GET['id'];
$namapasien=$_GET['nama'];
//$date=date("d/m/Y");

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Detail Resep Pasien</b></font></td>
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
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
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
					<hr>
					<div style="border:0px  solid  #CCCCCC; width:670px; height:200px; overflow:scroll">

								<?php
									$no=1;					
									$qr=mysql_query("select * from resep where no_resep='$id_resep'");
									echo "<table border=0 cellpadding=2 cellspacing=2 width=1100px style='border:1px  solid  #CCCCCC';>
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
											</tr>";
										$no++;
										
									}
									echo "</table>";
									echo"</div>";
									echo "<tr>
											<td colspan=4><hr>";
											echo "</td>
												</tr>";
									
									echo "</table>";
									?>
								<div style="font-size:10px">	
									<table border="0" cellpadding="1" cellspacing="2" width="100%">
					<?php
					$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep='$id_resep'");
					$r3=mysql_fetch_array($q3);
					$q4=mysql_query("select * from resep_head where no_resep='$id_resep'");
					$r4=mysql_fetch_array($q4);
					$sub = $r3['SUM(sub_total)'];
					$ppn = (10/100) * $sub;
					$grand = $sub + $ppn;
					?>
						<tr>
						<td>&nbsp;</td>
						<td width="240">&nbsp;</td>
						<td width="284"  align="right">Sub Total </td>
						<td width="144">: 
						  <input type="text" name="sub_tot" size="20" value="<?php rupiah($r3['SUM(sub_total)'])?>" readonly></td>
						<td width="10">&nbsp;</td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right">PPN </td><td>: <input type="text" name="ppn" size="20" value="10% (<?php rupiah($ppn)?>)" readonly></td>
						<td width="10">&nbsp;</td>	
						</tr>
						<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td align="right">Grand Total </td><td>: <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>" readonly=></td>
						<td width="10">&nbsp;</td>	
						</tr>
						<tr>
						<td colspan=4 height="50px" valign="bottom"><hr>
						</td>
						</tr>
						<tr>
						<td width="20">&nbsp;</td>
						<td><font size="+0"><a href="home.php?hal=content/resep_pasien_reg">  Kembali</a>   | <? if($r4['status_bayar']!='Sudah Dilayani'){   echo"<a href=home.php?hal=content/pembayaran_resep_pasien&home.php?hal=content/pembayaran_resep_pasien&noresep=$id_resep&id=$id_pasien&nama=$namapasien>   Bayar</a>"; } ?></font></td>
						<td></td>
						</tr>
					</table></div>

									
									
									<?php
										
									echo "</fieldset><br>";
									
								?>
							</td>
						</tr>
					</table>
					
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>
</html>
