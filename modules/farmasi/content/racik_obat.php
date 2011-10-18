<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<?php

	$id_p = $_GET['pasien_id'];
	$qar = mysql_query("SELECT * FROM simrs.pasien WHERE id='$id_p'");
	$rar = mysql_fetch_array($qar);

	$no_resep=$_GET['no_resep'];
	$param_no=$_GET['param_no'];
	$no_racik=$_GET['no_racik'];
	$namapas=$_GET['namapas'];
	$cara_bayar=$_GET['cara_bayar'];
	
	$qqu=mysql_query("SELECT * FROM racik_head WHERE no_racik='$no_racik'");
	$rru=mysql_fetch_array($qqu);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Racikan Obat</b></font></td>
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
					<form method="post" action="home.php?hal=action/insert_nama_racik" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>No Racik : </td>
							<td><input type="text" name="no_racik" value="<?=$_GET['no_racik']?>" readonly="true" size="20" style="background-color:#CCCFFF; "></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>No Resep : </td>
							<td><input type="text" name="no_resep" value="<?=$_GET['no_resep']?>" readonly="true" size="20" style="background-color:#CCCFFF; "></td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td>Nama Racikan : </td>
							<td><input type="text" name="nama_racikan" value="<?=$rru['nama']?>" size="30"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td align="left">Dosis : </td>
							<td><select name="dosis_id">
                                <option value="">--Pilih--</option>
                                <?php
									$qd = mysql_query("SELECT * FROM dosis");
									while ($rd = mysql_fetch_array($qd))
									{
										if ($rd['id']==$rru['dosis_id'])
										{
											echo "<option value='$rd[id]' selected>$rd[deskripsi]</option>";
										}
										else
										{
											echo "<option value='$rd[id]'>$rd[deskripsi]</option>";
										}
										
									}
								?>
                              </select>
                            </td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td align="left">Keterangan : </font></td>
							<td><select name="ket">
                                <option value="">--Pilih--</option>
								<?php
									if ($_GET['ket']=="Sebelum Makan")
									{
                                		echo "<option value='Sebelum Makan' selected>Sebelum Makan</option>
                                			  <option value='Sesudah Makan'>Sesudah Makan</option>";
									}
									else
									{
                                		echo "<option value='Sebelum Makan'>Sebelum Makan</option>
                                			  <option value='Sesudah Makan' selected>Sesudah Makan</option>";
									}
								?>
                              </select>
                            </td>
							<td></td>
							<td></td>
						</tr>

						<tr>
							<td valign="top">Deskripsi : </td>
							<td><textarea name="deskripsi" style="width:160px; height:60px; "><?=$rru['deskripsi']?></textarea></td>
							<td width="80px" valign="bottom">
								
							
							</td>
							<td></td>
						</tr>
						
						<tr>
							<td valign="top">Biaya Racik : </td>
							<td><input type="text" name="biaya_racik" size="15" value="<?=$rru['biaya_racik']?>"></td>
							<td width="80px" valign="bottom">
							<?php
								if ($_POST['no_racik'])
								{
							?>
									<input type="hidden" readonly="true" value="<?=$_POST['fld02']?>" name="fld02">
									<input type="hidden" readonly="true" value="<?=$_POST['no_racik']?>" name="no_racik">
									<input type="hidden" readonly="true" value="<?=$_POST['no_resep']?>" name="no_resep">
									<input type="hidden" readonly="true" value="<?=$_POST['param_no']?>" name="param_no">
									<input type="hidden" name="pasien_id" value="<?= $_POST['pasien_id']?>" readonly="true">
									<input type="hidden" name="id" value="<?= $_POST['id']?>" readonly="true">
									<input type="hidden" name="nama" value="<?= $_POST['nama']?>" readonly="true">
									<input type="hidden" name="namapas" value="<?=$namaps?>" readonly="true">
									<input type="hidden" name="cara_bayar" value="<?=$cara_bayar?>" readonly="true">
							<?php
								}
								elseif ($_GET['no_racik'])
								{
							?>
									<input type="hidden" readonly="true" value="<?=$_GET['fld02']?>" name="fld02">
									<input type="hidden" readonly="true" value="<?=$_GET['no_racik']?>" name="no_racik">
									<input type="hidden" readonly="true" value="<?=$_GET['no_resep']?>" name="no_resep">
									<input type="hidden" readonly="true" value="<?=$_GET['param_no']?>" name="param_no">
									<input type="hidden" name="pasien_id" value="<?= $_GET['pasien_id']?>" readonly="true">
									<input type="hidden" name="id" value="<?= $_GET['id']?>" readonly="true">
									<input type="hidden" name="nama" value="<?= $_GET['nama']?>" readonly="true">
									<input type="hidden" name="namapas" value="<?=$namapas?>" readonly="true">
									<input type="hidden" name="cara_bayar" value="<?=$cara_bayar?>" readonly="true">
							<?php
								}
							?>
									<input type="submit" value="Buat Racikan">
								</form>
							
							</td>
							<td width="80px" valign="bottom">
							<?php
								$q3=mysql_query("SELECT SUM(subtotal) FROM racik_detail WHERE no_resep = '$no_resep'");
								$r3=mysql_fetch_array($q3);
								$sub = $r3['SUM(subtotal)'];
					
								//$biaya = $rru['SUM(biaya_racik)'];
								$biaya=$rru['biaya_racik'];
								//echo $biaya;
								//$biaya = 3000 + $sub;
								$grand = $sub + $biaya + 500;
							?>

							
								<form method="post" action="home.php?hal=action/simpan_racik_obat" enctype="multipart/form-data">
									<input type="hidden" readonly="true" value="<?=$_GET['no_racik']?>" name="no_racik">
									<input type="hidden" readonly="true" value="<?=$_GET['no_resep']?>" name="no_resep">
									<input type="hidden" readonly="true" value="<?=$_GET['param_no']?>" name="param_no">
									<input type="hidden" name="pasien_id" value="<?= $_GET['pasien_id']?>" readonly="true">
									<input type="hidden" name="id" value="<?= $_GET['id']?>" readonly="true">
									<input type="hidden" name="nama" value="<?= $_GET['nama']?>" readonly="true">
									<input type="hidden" readonly="true" value="<?=$_GET['fld02']?>" name="fld02">
									<input type="hidden" readonly="true" value="<?=$grand?>" name="grand">
									<input type="submit" value="Simpan Racikan">
								</form>
							<?php
								if ($_POST['fld02'])
								{
									$fld02=$_POST['fld_02'];
								}
								elseif ($_GET['fld_02'])
								{
									$fld02=$_GET['fld02'];
								}
							?>
							</td>
						</tr>


					</table>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM racik_detail WHERE no_racik = '$no_racik'");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Obat</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Sub Total</font></td>
												<td><font color=#FFFFFF width=60px>Action</font></td>
											</tr>';
									$no = 1;
									while ($r = mysql_fetch_array($q))
									{
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
										$qd = mysql_query ("SELECT * FROM dosis WHERE id = '$r[dosis_id]'");
										$rd = mysql_fetch_array($qd);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$r[kode_obat]</td>
											<td>$ro[nama]</td>
											<td>$r[qty]</td>
											<td align=right>";
											 	rupiah($r[harga]);
										echo "</td>
											  <td align=right>";
											 	rupiah($r[subtotal]);
										echo "</td>
											<td align=center width=60px>
											<a href=\"home.php?hal=action/hapus_racik_obat&fld02=$fld02&qty=$r[qty]&no_racik=$no_racik&id=$r[id]&pasien_id=$id_p&namapas=$namapas&cara_bayar=$cara_bayar&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $ro[nama]?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table>';
								?>
							</td>
						</tr>
					</table>
					</div><br>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>Sub Total : <input type="text" name="sub_tot" size="18" value="<?php rupiah($r3['SUM(subtotal)'])?>"></td>
							<td width="80px"></td>
							<td>Biaya Racik : <input type="text" name="ppn" size="12" value="<?php rupiah($biaya)?>"></td>
							<td width="80px"></td>
							<td>Grand Total : <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>"></td>
						</tr>
					</table>
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
