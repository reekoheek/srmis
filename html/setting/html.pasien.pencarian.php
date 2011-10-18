<div id="form_cari" style="display:none;">
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_pasien" id="cari_pasien" onsubmit="return false;" >
	<input type="hidden" name="is_cari" value="1" />
		<table cellpadding="0" cellspacing="2" border="0" class="form">
			<tr>
				<td style="width: 200px">No. RM</td><td><input type="text" name="cari_id" id="cari_id" maxlength="6" size="9" value="" class="inputan" onkeyup="numeralsOnly(this, event, '', this);" onkeypress="focusNext( 'cari_nama', event, '', this)" /></td>
			</tr>
			<tr>
				<td>Nama</td><td><input type="text" name="cari_nama" id="cari_nama" value="" class="inputan" onkeypress="focusNext( 'cari_sex_id', event, 'cari_id', this)" onkeyup="this.value=this.value.toUpperCase()" /></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>
					<select name="cari_sex_id" id="cari_sex_id" style="width: 100px;" onkeypress="focusNext( 'cari_alamat', event, 'cari_nama', this)" class="inputan">
					<option value="">--- PILIH ---</option>
					<? for($i=0;$i<sizeof($data_sex);$i++) {?>
							<option value="<?=$data_sex[$i]['id']?>" ><?=$data_sex[$i]['nama']?></option>
					<? } ?>
					</select>
				</td>
			</tr>

			<tr>
				<td>Alamat</td><td><input type="text" name="cari_alamat" id="cari_alamat" value="" class="inputan" size="50" onkeypress="focusNext( 'cari_rt', event, 'cari_sex_id', this)" onkeyup="this.value=this.value.toUpperCase()" />
				</td>
			</tr>
		<tr>
			<td></td><td>
			RT <input type="text" name="cari_rt" id="cari_rt" value="" class="inputan" size="5" onkeypress="focusNext( 'cari_rw', event, 'cari_alamat', this)" />&nbsp;RW <input type="text" name="cari_rw" id="cari_rw" value="" class="inputan" size="5" onkeypress="focusNext( 'cari_propinsi_id', event, 'cari_rt', this)" />
			</td>
		</tr>
		<tr>
			<td>Propinsi</td>
			<td>
				<select name="cari_propinsi_id" id="cari_propinsi_id" style="width: 200px;" onkeypress="focusNext( 'cari_kabupaten_id', event, 'cari_rw', this)" class="inputan" onchange="xajax_cari_get_kabupaten(this.value)">
				<option value="">--- PILIH ---</option>
				<? for($i=0;$i<sizeof($data_propinsi);$i++) {?>
						<option value="<?=$data_propinsi[$i]['id']?>" ><?=$data_propinsi[$i]['nama']?></option>
				<? } ?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kabupaten</td>
			<td>
				<select name="cari_kabupaten_id" id="cari_kabupaten_id" style="width: 200px;" onkeypress="focusNext( 'cari_kecamatan_id', event, 'cari_propinsi_id', this)" class="inputan" onchange="xajax_cari_get_kecamatan(this.value); add_kabupaten_combo(this.value);">
					<option value="">--- PILIH ---</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kecamatan</td>
			<td>
				<select name="cari_kecamatan_id" id="cari_kecamatan_id" style="width: 200px;" onkeypress="focusNext( 'cari_nama_ortu', event, 'cari_kabupaten_id', this)" class="inputan" onchange="add_kecamatan_combo(this.value);">
					<option value="">--- PILIH ---</option>
				</select>
				<br />
				<br />
			</td>
		</tr>
		<tr>
			<td>Nama Orang Tua</td><td><input type="text" name="cari_nama_ortu" id="cari_nama_ortu" value="" class="inputan" onkeypress="focusNext( 'cari', event, 'cari_kecamatan_id', this)" onkeyup="hurufBesar(this)" />
			</td>
		</tr>

		<tr>
			<td colspan="2" style="text-align: center;"><input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('cari_pasien'));" />&nbsp;&nbsp;<input type="button" name="daftarkan" id="daftarkan" value="Daftarkan Sebagai Pasien Baru" class="inputan" onclick="xajax_daftar_dari_cari(xajax.getFormValues('cari_pasien'));" /></td>
		</tr>
	</table>
	</form>
	<h3>Hasil Pencarian</h3>
<div id="cari_navi" class="navi"></div>
<div id="list_data"></div>
<div class="info" id="info_cari">
<b>Petunjuk :</b><br />
Silakan isi parameter pencarian pasien.<br />
Klik pada salah satu pasien untuk melihat detil data pasien dan kunjungan.<br />
Klik tombol <img src="<?=IMAGES_URL?>add.gif" alt="" /> untuk kembali.<br />
</div>
</div>