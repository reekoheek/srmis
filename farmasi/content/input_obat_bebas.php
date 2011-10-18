<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>


</head>
<body>
<?php
$no_trans=$_GET['no_transaksi'];
if($_GET['kode'])
{	

$barang=$_GET['kode'];
$sql="select * from ms_barang where kd_barang='$barang'";
$qqq=mysql_query($sql);
$rb=mysql_fetch_array($qqq);
}
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Tambah Obat</b></font></td>
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
				<tr valign="top">
				  <td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="85%">
				<tr>
					<td width="15">&nbsp;</td>
					<td  valign="top">
					<font style="font-size:12px; ">
					
			 
					<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_obat_umum&no_transaksi=<? echo $no_trans;?>&kode=<? echo $kode_obat; ?>">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						
						
						
						<input type="hidden" value="<? echo $no_trans; ?>" name="no_transaksi">
						<input type="hidden" name="kode_obat" value="<?=$rb['kd_barang']?>">

						<tr>
							<td align="left" width="200px"><font color="#FF0000">Nama Obat* :</font> </td>
							<td><input type="text" name="nama" value="<?=$rb['nama']?>" size="40" readonly="true"></td>
						</tr>
						<tr>
							<td align="left"><font color="#FF0000">Jumlah* :</font> </td>
							<td><input type="text" name="jumlah" size="5" value=""></td>
						</tr>
						<tr>
							<td align="left">Dosis : </td>
							<td><select name="dosis_id">
                                <option value="">--Pilih--</option>
                                <?php
									$qd = mysql_query("SELECT * FROM dosis");
									while ($rd = mysql_fetch_array($qd))
									{
										echo "<option value='$rd[id]'>$rd[deskripsi]</option>";
									}
								?>
                              </select>
                            </td>
						</tr>
						<tr>
							<td align="left">Keterangan : </td>
							<td><select name="ket">
                                <option value="">--Pilih--</option>
                                <option value="Sebelum Makan">Sebelum Makan</option>
                                <option value="Sesudah Makan">Sesudah Makan</option>
                              </select>
                            </td>
						</tr>
						<tr>
							<td align="left">Keterangan <br>(Pemesanan Obat Banyak) : </td>
							<td><textarea name="ket_banyak" style="width:210px; height:60px; "></textarea>
                            </td>
						</tr>

						<tr>
							<td></td>
							<td><br><input type="submit" value="Simpan">&nbsp;<input type="reset" value="Reset"><br><br></td>
						</tr>
					</table>
					</form>
					
				  </td>
					<td width="85" valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td width="51" style="height:1px;"></td>
						</tr>
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=content/daftar_obat_bebas&no_transaksi=<? echo $no_trans; ?>">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
								
								<input type="hidden" name="no_transaksi" value="<? echo $no_trans;?>" readonly="true"><input type="hidden" name="pasien_id" value="<?= $id?>" readonly="true">
								
								&nbsp;<input type="submit" value="Pilih"> &nbsp;
							  </form>
							</td>
						</tr>
					</table>
				  </td>
					<td width="130" valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:1px;"></td>
						</tr>
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_racik_obat_umum">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_transaksi?>" name="r_no_trans">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								
								
								&nbsp;<input type="submit" value="Racik Obat"> &nbsp;
							  </form>
							</td>
						</tr>
					</table>
				  </td>
				</tr>
			</table>
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
