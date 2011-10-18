<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Detail Barang</b></font></td>
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
					<font style="font-size:12px; ">
					<?php
						$q= mysql_query("SELECT * FROM ms_barang WHERE id = '$_GET[barang_id]'");
						$r = mysql_fetch_array($q);
						
						$q2= mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$r[id]'");
						$r2 = mysql_fetch_array($q2);
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="right">Group Obat : </td>
							<td>
                                <?php
								$qg=mysql_query ("SELECT * FROM group_barang WHERE kd_group_barang = '$r[group_barang]' ");
								$rg=mysql_fetch_array($qg)
								?>
                              <input type="text" name="group_obat" readonly="true" value="<?=$rg['deskripsi']?>">
                            </td>
							<td align="right">Kode Guna : </td>
							<td><?php
								$qgo=mysql_query ("SELECT * FROM guna_obat WHERE kd_guna_obat = '$r[kode_guna]'");
								$rgo=mysql_fetch_array($qgo)
								?>
                                <input type="text" name="kode_guna" value="<?= $rgo['kd_guna_obat']?>" readonly="true">
                            </td>
						</tr>
						<tr>
							<td align="right">Kode Barang : </td>
							<td>
                                <input type="text" name="kd_barang" size="10" value="<?= $r['kd_barang']?>" readonly="true">
                            </td>
							<td align="right">No. Rekening : </td>
							<td><input type="text" name="kode_reduksi" size="35" value="<?= $r['kode_reduksi']?>" readonly="true"></td>
						</tr>
						<tr>
							<td align="right">Nama Barang : </td>
							<td><input type="text" name="nama" size="35" value="<?= $r['nama']?>" readonly="true"></td>
							<td align="right">Expire Date : </td>
							<td><INPUT name="expire_date" readonly="true" value="<?= $r['expire_date']?>"></td>
						</tr>
						<tr>
							<td align="right">Satuan : </td>
							<td>
                                <?php
								$qs=mysql_query ("SELECT * FROM satuan WHERE kd_satuan = '$r[satuan]'");
								$rs=mysql_fetch_array($qs)
								?>
                              <input type="text" name="satuan" value="<?= $rs['deskripsi']?>" readonly="true">
                            </td>
							<td align="right">Tipe Obat : </td>
							<td><?php
								$qto=mysql_query ("SELECT * FROM tipe_obat WHERE kd_tipe_obat = '$r[tipe_obat]'");
								$rto=mysql_fetch_array($qto)
								?>
                                <input type="text" name="tipe_obat" value="<?= $rto['nama_tipe_obat']?>" readonly="true">
                            </td>
						</tr>
						<tr>
							<td align="right">Pabrik 01: </td>
							<td>
                                <?php
								$qp=mysql_query ("SELECT * FROM pbf WHERE id = '$r[pabrik01]'");
								$rp=mysql_fetch_array($qp)
								?>
                              <input type="text" value="<?= $rp['nama']?>" readonly="true" name="pabrik01" size="40">
                            </td>
							<td align="right">HNA : </td>
							<td><input type="text" name="hna" size="35" value="<?= $r['hna']?>" readonly="true"></td>
						</tr>
						<tr>
						  <td align="right">Pabrik 02: </td>
						  <td><?php
								$qp2=mysql_query ("SELECT * FROM pbf WHERE id = '$r[pabrik02]'");
								$rp2=mysql_fetch_array($qp2)
								?>
                              <input type="text" value="<?= $rp2['nama']?>" readonly="true" name="pabrik02" size="40">
                          </td>
						  <td align="right">Harga DOSP : </td>
						  <td><input type="text" name="harga_dosp" size="15" value="<?= $r2['fld02']?>" readonly="true"></td>
					  </tr>
						<tr>
						  <td align="right">Pabrik 03: </td>
						  <td><?php
								$qp3=mysql_query ("SELECT * FROM pbf WHERE id = '$r[pabrik03]'");
								$rp3=mysql_fetch_array($qp3)
								?>
                              <input type="text" value="<?= $rp3['nama']?>" readonly="true" name="pabrik03" size="40">
                          </td>
						  <td align="right">Avarange Sale : </td>
						  <td><input type="text" name="averange_sale" size="10" value="<?= $r['averange_sale']?>" readonly="true"></td>
					  </tr>
						<tr>
						  <td align="right">Pabrik 04: </td>
						  <td><?php
								$qp4=mysql_query ("SELECT * FROM pbf WHERE id = '$r[pabrik04]'");
								$rp4=mysql_fetch_array($qp4)
								?>
                              <input type="text" value="<?= $rp4['nama']?>" readonly="true" name="pabrik04" size="40">
                          </td>
							<td align="right">Stok</td>
							<td><input type="text" name="stok" value="<?=$r2['stok']?>" readonly="true" size="7"></td>
						</tr>
						<tr>
						  <td align="right">Pabrik 05: </td>
						  <td><?php
								$qp5=mysql_query ("SELECT * FROM pbf WHERE id = '$r[pabrik05]'");
								$rp5=mysql_fetch_array($qp5)
								?>
                              <input type="text" value="<?= $rp5['nama']?>" readonly="true" name="pabrik05" size="40">
                          </td>
							<td align="right">Stok Min : </td>
							<td><input type="text" name="min_stok" size="7" value="<?= $r2['min_stok']?>" readonly="true"></td>
						</tr>
						<tr>
						  <td align="right">Jenis Obat : </td>
						  <td><?php
								$qj=mysql_query ("SELECT * FROM jenis_obat WHERE kd_jenis_obat ='$r[jenis_obat]'");
								$rj=mysql_fetch_array($qj)
								?>
                              <input type="text" value="<?= $rj['deskripsi']?>" readonly="true" name="jenis_obat" size="30">
                          </td>
							<td align="right">Stok Max : </td>
							<td><input type="text" name="max_stok" size="7" value="<?= $r2['max_stok']?>" readonly="true"></td>
						</tr>
						<tr>
						  <td align="right">Kategori Obat : </td>
						  <td><input type="text" name="kategori_obat" value="<?=$r['kategori_obat']?>" readonly="true">
                          </td>
                          <td align="right">Status : </td>
                          <td><input type="text" name="sstatus" size="15" value="<?= $r['status']?>" readonly="true"></td>
					  </tr>
						<tr>
						  <td align="right">Golongan : </td>
						  <td><?php
								$qgl=mysql_query ("SELECT * FROM golongan_obat WHERE kd_golongan_obat = '$r[golongan]'");
								$rgl=mysql_fetch_array($qgl)
								?>
                              <input type="text" value="<?= $rgl['deskripsi']?>" readonly="true" name="golongan">
                          </td>
						  <td align="right">&nbsp;</td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
							<td></td>
							<td colspan="3"><a href="javascript:history.go(-1)">[KEMBALI]</a></td>
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
