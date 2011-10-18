
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Input Daftar Barang</b></font></td>
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
						$q= mysql_query("SELECT * FROM ms_barang WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_barang enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_barang enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="right"><div align="left"><font color="#FF0000" >Group Barang*</font> </div></td>
							<td width="3px">:</td>
							<td><select name="group_barang">
                                <option value="">--Pilih--</option>
                                <?php
								$qg=mysql_query ("SELECT * FROM group_barang");
								while ($rg=mysql_fetch_array($qg))
								{
									if ($rg['kd_group_barang'] == $r['group_barang'])
									{
										echo "<option value='$rg[kd_group_barang]' selected>$rg[deskripsi] ($rg[kd_group_barang])</option>";
									}
									else
									{
										echo "<option value='$rg[kd_group_barang]'>$rg[deskripsi] ($rg[kd_group_barang])</option>";
									}
								}
							?>
                              </select>
                            </td>
							<td align="right">&nbsp;</td>
							<td align="right"><div align="left">Kode Reduksi </div></td>
							<td>:</td>
							<td><input type="text" name="kode_reduksi" size="35" value="<?= $r['kode_reduksi']?>"></td>
						</tr>
						<tr>
							<td align="right"><div align="left"><font color="#FF0000" >Kode Barang*</font> </div></td>
							<td>:</td>
							<td><?php
							if ($r)
							{
							?>
                                <input type="text" name="kd_barang" size="10" value="<?= $r['kd_barang']?>" readonly="true" style="background-color:#CCCFFF; ">
                                <?php
							}
							else
							{
							?>
                                <input type="text" name="kd_barang" size="10" value="<?= $r['kd_barang']?>">
                                <?php
							}
							?>
                            </td>
							<td align="right">&nbsp;</td>
							<td align="right"><div align="left">Kode Biaya </div></td>
							<td>:</td>
							<td><input type="text" name="kode_biaya" size="10" value="<?= $r['kode_biaya']?>"></td>
						</tr>
						<tr>
							<td align="right"><div align="left"><font color="#FF0000" >Nama Barang*</font> </div></td>
							<td>:</td>
							<td><input type="text" name="nama" size="35" value="<?= $r['nama']?>"></td>
							<td align="right">&nbsp;</td>
							<td align="right"><div align="left">Kode PPN K </div></td>
							<td>:</td>
							<td><input type="text" name="kode_ppn_k" size="10" value="<?= $r['kode_ppn_k']?>"></td>
						</tr>
						<tr>
							<td align="right"><div align="left">No Batch </div></td>
							<td>&nbsp;</td>
							<td><input type="text" name="no_batch" value="<?=$r['no_batch']?>" size="5"></td>
							<td align="right" width="30px">&nbsp;</td>
							<td align="right"><div align="left">Kode PPN M </div></td>
							<td>:</td>
							<td><input type="text" name="kode_ppn_m" size="10" value="<?= $r['kode_ppn_m']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">No Rak </div></td>
						  <td>&nbsp;</td>
						  <td><input type="text" name="no_rak" value="<?=$r['no_rak']?>" size="5"></td>
						  <td align="right">&nbsp;</td>
						  <td align="right"><div align="left">Expire Date </div></td>
						  <td>:</td>
						  <td><INPUT name="expire_date" id="date1" class="date-pick" readonly="true" value="<?= $r['expire_date']?>"></td>
					  </tr>
						<tr>
						  <td align="right"><div align="left">Satuan </div></td>
						  <td>:</td>
						  <td><select name="satuan">
                              <option value="">--Pilih--</option>
                              <?php
								$qs=mysql_query ("SELECT * FROM satuan");
								while ($rs=mysql_fetch_array($qs))
								{
									if ($rs['kd_satuan'] == $r['satuan'])
									{
										echo "<option value='$rs[kd_satuan]' selected>$rs[deskripsi] ($rs[kd_satuan])</option>";
									}
									else
									{
										echo "<option value='$rs[kd_satuan]'>$rs[deskripsi] ($rs[kd_satuan])</option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
						  <td align="right"><div align="left">Tipe Obat </div></td>
						  <td>:</td>
						  <td><select name="tipe_obat">
                              <option value="">--Pilih--</option>
                              <?php
								$qto=mysql_query ("SELECT * FROM tipe_obat");
								while ($rto=mysql_fetch_array($qto))
								{
									if ($rto['kd_tipe_obat'] == $r['tipe_obat'])
									{
										echo "<option value='$rto[kd_tipe_obat]' selected>$rto[nama_tipe_obat] ($rto[kd_tipe_obat])</option>";
									}
									else
									{
										echo "<option value='$rto[kd_tipe_obat]'>$rto[nama_tipe_obat] ($rto[kd_tipe_obat])</option>";
									}
								}
							?>
                            </select>
                          </td>
					  </tr>
						<tr>
						  <td align="right"><div align="left">Pabrik 01 </div></td>
						  <td>:</td>
						  <td><select name="pabrik01">
                              <option value="">--Pilih--</option>
                              <?php
								$qp=mysql_query ("SELECT * FROM pbf");
								while ($rp=mysql_fetch_array($qp))
								{
									if ($rp['id'] == $r['id'])
									{
										echo "<option value='$rp[id]' selected>$rp[nama] </option>";
									}
									else
									{
										echo "<option value='$rp[id]'>$rp[nama] </option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
						  <td align="right"><div align="left">Obat Tunai </div></td>
						  <td>:</td>
						  <td><select name="obat_tunai">
                              <?php
								if ($r['obat_tunai']=="Tunai")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Tunai' selected>Tunai</option>";
									echo "<option value='Non-Tunai'>Non-Tunai</option>";
								}
								else if ($r['obat_tunai']=="Non-Tunai")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Tunai'>Tunai</option>";
									echo "<option value='Non-Tunai' selected>Non-Tunai</option>";
								}
								else
								{
									echo "<option value='' selected>--Pilih--</option>";
									echo "<option value='Tunai'>Tunai</option>";
									echo "<option value='Non-Tunai'>Non-Tunai</option>";
								}

							?>
                            </select>
                          </td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Pabrik 02 </div></td>
						  <td>:</td>
						  <td><select name="pabrik02">
                              <option value="">--Pilih--</option>
                              <?php
								$qp=mysql_query ("SELECT * FROM pbf");
								while ($rp=mysql_fetch_array($qp))
								{
									if ($rp['id'] == $r['id'])
									{
										echo "<option value='$rp[id]' selected>$rp[nama] </option>";
									}
									else
									{
										echo "<option value='$rp[id]'>$rp[nama] </option>";
									}
								}
							?>
                            </select>
                          </td>
							<td align="right">&nbsp;</td>
							<td align="right"><div align="left">HNA </div></td>
							<td>:</td>
							<td><input type="text" name="hna" size="35" value="<?= $r['hna']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Pabrik 03 </div></td>
						  <td>:</td>
						  <td><select name="pabrik03">
                              <option value="">--Pilih--</option>
                              <?php
								$qp=mysql_query ("SELECT * FROM pbf");
								while ($rp=mysql_fetch_array($qp))
								{
									if ($rp['id'] == $r['id'])
									{
										echo "<option value='$rp[id]' selected>$rp[nama] </option>";
									}
									else
									{
										echo "<option value='$rp[id]'>$rp[nama] </option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Harga DOSP </div></td>
							<td>:</td>
							<td><input type="text" name="harga_dosp" size="15" value="<?= $r['harga_dosp']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Pabrik 04</div></td>
						  <td>:</td>
						  <td><select name="pabrik04">
                              <option value="">--Pilih--</option>
                              <?php
								$qp=mysql_query ("SELECT * FROM pbf");
								while ($rp=mysql_fetch_array($qp))
								{
									if ($rp['id'] == $r['id'])
									{
										echo "<option value='$rp[id]' selected>$rp[nama] </option>";
									}
									else
									{
										echo "<option value='$rp[id]'>$rp[nama] </option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Discount %</div></td>
							<td>:</td>
							<td><input type="text" name="discount" size="10" value="<?= $r['discount']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Pabrik 05 </div></td>
						  <td>:</td>
						  <td><select name="pabrik05">
                              <option value="">--Pilih--</option>
                              <?php
								$qp=mysql_query ("SELECT * FROM pbf");
								while ($rp=mysql_fetch_array($qp))
								{
									if ($rp['id'] == $r['id'])
									{
										echo "<option value='$rp[id]' selected>$rp[nama] </option>";
									}
									else
									{
										echo "<option value='$rp[id]'>$rp[nama] </option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">PPN %</div></td>
							<td>:</td>
							<td><input type="text" name="ppn" size="10" value="<?= $r['ppn']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Satuan Kirim </div></td>
						  <td>:</td>
						  <td><input type="text" name="satuan_kirim" size="15" value="<?= $r['satuan_kirim']?>"></td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Avarange Sale </div></td>
							<td width="3px">:</td>
							<td><input type="text" name="averange_sale" size="10" value="<?= $r['averange_sale']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Jenis Obat </div></td>
						  <td>:</td>
						  <td><select name="jenis_obat">
                              <option value="">--Pilih--</option>
                              <?php
								$qj=mysql_query ("SELECT * FROM jenis_obat");
								while ($rj=mysql_fetch_array($qj))
								{
									if ($rj['kd_jenis_obat'] == $r['jenis_obat'])
									{
										echo "<option value='$rj[kd_jenis_obat]' selected>$rj[deskripsi] ($rj[kd_jenis_obat])</option>";
									}
									else
									{
										echo "<option value='$rj[kd_jenis_obat]'>$rj[deskripsi] ($rj[kd_jenis_obat])</option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Stok Max </div></td>
							<td>:</td>
							<td><input type="text" name="stok_max" size="5" value="<?= $r['stok_max']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left"><font color="#FF0000" >Kategori Obat*</font> </div></td>
						  <td>:</td>
						  <td><select name="kategori_obat">
                              <?php
								if ($r['kategori_obat']=="Obat Bebas")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Obat Bebas' selected>Obat Bebas</option>";
									echo "<option value='Obat Keras'>Obat Keras</option>";
								}
								else if ($r['kategori_obat']=="Obat Keras")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='Obat Bebas'>Obat Bebas</option>";
									echo "<option value='Obat Keras' selected>Obat Keras</option>";
								}
								else
								{
									echo "<option value='' selected>--Pilih--</option>";
									echo "<option value='Obat Bebas'>Obat Bebas</option>";
									echo "<option value='Obat Keras'>Obat Keras</option>";
								}

							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Stok Min </div></td>
							<td>:</td>
							<td><input type="text" name="stok_min" size="5" value="<?= $r['stok_min']?>"></td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Golongan </div></td>
						  <td>:</td>
						  <td><select name="golongan">
                              <option value="">--Pilih--</option>
                              <?php
								$qgl=mysql_query ("SELECT * FROM golongan_obat");
								while ($rgl=mysql_fetch_array($qgl))
								{
									if ($rgl['kd_golongan_obat'] == $r['golongan'])
									{
										echo "<option value='$rgl[kd_golongan_obat]' selected>$rgl[deskripsi] ($rgl[kd_golongan_obat])</option>";
									}
									else
									{
										echo "<option value='$rgl[kd_golongan_obat]'>$rgl[deskripsi] ($rgl[kd_golongan_obat])</option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Isi </div></td>
							<td>:</td>
							<td><input type="text" name="isi" size="10" value="<?= $r['isi']?>"></td>
						</tr>

						<tr>
						  <td align="right"><div align="left">Kode Guna </div></td>
						  <td>:</td>
						  <td><select name="kode_guna">
                              <option value="">--Pilih--</option>
                              <?php
								$qgo=mysql_query ("SELECT * FROM guna_obat");
								while ($rgo=mysql_fetch_array($qgo))
								{
									if ($rgo['kd_guna_obat'] == $r['kode_guna'])
									{
										echo "<option value='$rgo[kd_guna_obat]' selected>$rgo[kd_guna_obat] ($rgo[kd_guna_obat])</option>";
									}
									else
									{
										echo "<option value='$rgo[kd_guna_obat]'>$rgo[kd_guna_obat] ($rgo[kd_guna_obat])</option>";
									}
								}
							?>
                            </select>
                          </td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Kemasan </div></td>
							<td>:</td>
							<td><select name="kemasan">
                                <option value="">--Pilih--</option>
                                <?php
								$qs=mysql_query ("SELECT * FROM satuan");
								while ($rs=mysql_fetch_array($qs))
								{
									if ($rs['kd_satuan'] == $r['satuan'])
									{
										echo "<option value='$rs[kd_satuan]' selected>$rs[deskripsi] ($rs[kd_satuan])</option>";
									}
									else
									{
										echo "<option value='$rs[kd_satuan]'>$rs[deskripsi] ($rs[kd_satuan])</option>";
									}
								}
							?>
                              </select>
                            </td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Kode Persediaan </div></td>
						  <td>:</td>
						  <td><input type="text" name="kode_persediaan" size="30" value="<?= $r['kode_persediaan']?>"></td>
						  <td align="right">&nbsp;</td>
							<td align="right"><div align="left">Status </div></td>
							<td>:</td>
							<td><select name="status">
                                <?php
								if ($r['status']=="Aktif")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='1' selected>Aktif</option>";
									echo "<option value='9'>Non-Aktif</option>";
								}
								else if ($r['status']=="Non-Aktif")
								{
									echo "<option value=''>--Pilih--</option>";
									echo "<option value='1'>Aktif</option>";
									echo "<option value='9' selected>Non-Aktif</option>";
								}
								else
								{
									echo "<option value=''  selected>--Pilih--</option>";
									echo "<option value='1'>Aktif</option>";
									echo "<option value='9'>Non-Aktif</option>";
								}
							?>
                              </select>
                            </td>
						</tr>
						<tr>
						  <td align="right"><div align="left">Kode Pendapatan </div></td>
						  <td>:</td>
						  <td><input type="text" name="kode_pendapatan" size="30" value="<?= $r['kode_pendapatan']?>"></td>
						  <td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" value="Simpan">
								&nbsp;
								<input type="reset" value="Reset"></td>
						</tr>
						<tr>
							<td></td>
							<td colspan="6">&nbsp;</td>
						</tr>
					</table>
					</form>

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
