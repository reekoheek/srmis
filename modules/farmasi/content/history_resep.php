<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Untitled Document</title>
</head>
<body>
<?php
//$pasien_id = $_POST['pasien_id'];
$tgl= $_POST['tgl'];
$id = $_POST['id'];
$nama = $_POST['nama'];
//$date=date("d/m/Y");

$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$id' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
$re=mysql_fetch_array($qe);


?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>History Resep Pasien</b></font></td>
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
					<form method="post" action="home.php?hal=content/history_resep" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>No RM </td>
							<td><input type="text" name="id" value="<?=$id?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							<td></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><input type="text" name="nama" value="<?= $nama?>" readonly="true" size="40" style="background-color:#CCCFFF; "></td>
						  <td></td>
					  </tr>
						<tr>
						  <td>Jenis Pembayaran</td>
						  <td><input type="text" name="jenis" value="<?= $re['cara_bayar'] ?>" readonly="true" size="30" style="background-color:#CCCFFF; ">
                            </td>
						  <td width="220px">
						  	<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									
									<td width="100px"><INPUT name="tgl" id="date1" class="date-pick" readonly="true" value="<?= $tgl?>"></td>
									<td>&nbsp;<input type="submit" value="Cari"> &nbsp;</td>
									</form>
									<td>
									<form action="home.php?hal=content/pasien" method="post">
										<input type="submit" value="Kembali">
									</form>
									</td>
								</tr>
							</table>
						  </td>
					  </tr>
					</table>
					
					<hr>
					<div style="border:0px  solid  #CCCCCC; width:670px; height:500px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									//untuk penggabungan tanggal
									if ($tgl)
									{
										$q = mysql_query ("SELECT DISTINCT(resep.tgl) FROM resep,resep_head WHERE resep.pasien_id = '$id' AND resep.tgl LIKE '$tgl%' AND resep.no_resep=resep_head.no_resep AND resep_head.status_bayar'1' ORDER BY resep.tgl DESC ");
									}
									else
									{
										$q = mysql_query ("SELECT DISTINCT(resep.tgl) FROM resep,resep_head WHERE resep_head.status_bayar='1' AND resep.pasien_id = '$id' AND resep.no_resep=resep_head.no_resep ORDER BY resep.tgl DESC ");
									}
									$no = 1;
									while ($r = mysql_fetch_array($q))
									{
									echo "<fieldset>
											<legend><strong>$r[tgl]</strong></legend>";
											
									//untuk penggabungan no resep
									$qq2 = mysql_query ("SELECT DISTINCT(resep.no_resep) FROM resep_head,resep WHERE resep.no_resep=resep_head.no_resep AND resep_head.flags='1' AND resep.pasien_id = '$id' AND resep.tgl='$r[tgl]' ORDER BY resep.tgl DESC");
									while ($rr2 = mysql_fetch_array($qq2))
									{
									
									echo "<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr><td colspan=2><br>No Resep : $rr2[no_resep]</td></tr></table>";
											
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
											
									
									
									$qq = mysql_query ("SELECT * FROM resep WHERE pasien_id = '$id' AND tgl='$r[tgl]' AND no_resep = '$rr2[no_resep]'");
									while ($rr = mysql_fetch_array($qq))
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
										
										if ($rr['racikan']=='YA')
										{
											echo "<td align=center>-</td>";
										}
										else
										{
											echo "<td width=65px>$rr[kode_obat]</td>";
										}
											
											if($rr['racikan']=='YA')
											{
												echo "<td width=250px><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_resep=$rr[no_resep]', 'myPop1',800,400);\">$rr[fld01]</a></td>";
											}
											else
											{
												echo "<td width=250px>$ro[nama]</td>";
											}
											
											
										if ($rr['racikan']<>'YA')
										{
											echo "<td align=center>-</td>";
										}
										else
										{

										echo "<td width=45px align=center>$rr[racikan]</td>";
										}
										echo "<td width=160px>$rd[deskripsi] ($rr[ket])</td>";
										
										
										if ($rr['racikan']=='YA')
										{
											echo "<td align=center>-</td>";
											echo "<td align=center>-</td>";
										}
										else
										{

											echo "<td width=40px align=right>$rr[diberi]</td>
											<td align=right width=90px>";
											 	rupiah($rr[harga]);
										echo "</td>";
										}
										echo "<td align=right width=90px>";
											 	rupiah($rr[sub_total]);
										echo "</td>
											<td>";
										if ($rr['flags']==4)
										{
											echo "EMPTY";
										}
										else
										{
											echo "$rr[ket_banyak]";
										}
										echo "</td>
											</tr>";
										$no++;
										
									}
									echo "<tr>
											<td colspan=9><hr>";
									?>
									<table border="0" cellpadding="1" cellspacing="2" width="100%">
					<?php
					$qq=mysql_query("SELECT * FROM margin WHERE klasifikasi_pasien='$re[cara_bayar]'");
					$rq=mysql_fetch_array($qq);
					if ($rq)
					{
						$margin=$rq['margin'] / 100;
						$tampil=$rq['margin'];
					}
					else
					{
						$margin=10/100;
						$tampil=10;
					}
					
					$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$rr2[no_resep]'");
					$r3=mysql_fetch_array($q3);
					$sub = $r3['SUM(sub_total)'];
					$ppn=(10/100) * $sub;
					$potongan = $margin * $sub;
					//$grand = $sub + $potongan;
					$grand = $sub + $potongan + $ppn;
					?>
						<tr>
							<td width="100px">Sub Total </td><td>: <input type="text" name="sub_tot" size="20" value="<?php rupiah($r3['SUM(sub_total)'])?>"></td>
							<td width="80px"></td>
						</tr>
						<tr>
							<td>Margin </td><td>: <input type="text" name="potongan" size="20" value="<?= $tampil."%"?> (<?php rupiah($potongan)?>)"></td>
							<td width="80px"></td>
						</tr>
						<tr>
							<td>PPN </td><td>: <input type="text" name="potongan" size="20" value="<?= "10%"?> (<?php rupiah($ppn)?>)"></td>
							<td width="80px"></td>
						</tr>
						<tr>
							<td>Grand Total </td><td>: <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>"></td>
							<td width="80px"></td>
						</tr>
					</table>

									
									
									<?php
										echo "</td>
												</tr>";
									}
									echo "</table>";
									echo "</fieldset><br>";
									}
								?>
							</td>
						</tr>
					</table>
					</div>
					</font>
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