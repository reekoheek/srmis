<div id="modal_resep_rawat_jalan" class="window_modal" style="display:none;left:20px;top:20px;width:70%;z-index:8;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_resep_rawat_jalan();" /></div>
<div class="modal_title_bar" id="judul_resep_jalan"></div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_resep_rawat_jalan" id="input_resep_rawat_jalan" onsubmit="return false;">
<input type="hidden" name="id_kunjungan_kamar" id="id_kunjungan_kamar" />
<input type="hidden" name="id_kunjungan" id="id_kunjungan" />
<input type="hidden" name="is_ranap" id="is_ranap" />
<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top">
					<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="85%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					
					<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_resep_reg_rawat_jalan">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						
						<input type="hidden" name="id" value="<?=$_POST['id']?>">
						<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
						<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
						<input type="hidden" name="pasien_id" value="<?=$pasien_id?>" readonly="true">
						<input type="hidden" name="kode_obat" value="<?= $rb['kd_barang']?>">
						<input type="hidden" name="nama_pas" value="<?=$nama?>">
						
						
						<tr>
							<td align="left" width="200px"><font color="#FF0000">Nama Obat* :</font> </td>
							<td><input type="text" name="nama" value="<?=$rb['nama']?>" size="40"  id="inputString" onkeyup="lookup(this.value);" onblur="fill();"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div></td>
						</tr>
						<tr>
							<td align="left" width="200px">Stok</td>
							<td><input type="text" name="kd_obatt" size="7"  disabled id="inputString2" onKeyUp="lookup(this.value);" onblur="fill();"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <input type="hidden" name="kd_obatt" size="40"  id="inputString3" onKeyUp="lookup(this.value);" onblur="fill();"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div></td>
						</tr>
						<tr>
							<td align="left">Jumlah : </td>
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
							<td align="left"><font color="#FF0000">Keterangan* : </font></td>
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
					<td valign="top">&nbsp;				  </td>
					<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:1px;"></td>
						</tr>
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_racik_obat_rawat_jalan">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								<input type="hidden" name="pasien_id" value="<?= $pasien_id?>" readonly="true">
								<input type="hidden" name="nama_pas" value="<?=$nama?>">
								
								&nbsp;<input type="submit" value="Racik Obat"> &nbsp;
							  </form>
							</td>
						</tr>
					</table>
</id>