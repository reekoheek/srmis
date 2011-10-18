<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_jadwal_dokter" id="form_jadwal_dokter" onsubmit="return false;">
<input type="hidden" name="id_jadwal_dokter" id="id_jadwal_dokter" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Klinik</td><td>
			<select id="pelayanan_id" name="pelayanan_id" class="inputan" onkeypress="focusNext( 'dokter_id', event, 'simpan', this)" style="width:200px" onchange="xajax_ref_get_dokter('dokter_id',this.value);cumaIni();">
					<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_pelayanan);$i++):?>
					<option value="<?=$_data_pelayanan[$i][id]?>"><?=$_data_pelayanan[$i][nama]?></option>
				<?endfor;?>
			</select>
			&nbsp;
			<label for="ceked_spc"><input type="checkbox" value="1" name="ceked_spc" id="ceked_spc" onclick="cumaIni();" />Tampilkan Hanya Klinik Ini</label>
		</td>
	</tr>
	<tr>
		<td>Dokter</td><td>
			<select id="dokter_id" name="dokter_id" class="inputan" onkeypress="focusNext( 'hari', event, 'kamar_id', this)" style="width:200px" onchange="cumaIni();">
					<option value="">-- PILIH --</option>
			</select>
			&nbsp;
			<label for="ceked_dok"><input type="checkbox" value="1" name="ceked_dok" id="ceked_dok" onclick="cumaIni();" />Tampilkan Hanya Dokter Ini</label>
		</td>
	</tr>
	<tr>
		<td>Hari</td><td>
			<select id="hari" name="hari" class="inputan" onkeypress="focusNext( 'mulai_jam', event, 'dokter_id', this)" style="width:200px" onchange="cumaIni();">
					<option value="">-- PILIH --</option>
					<option value="Monday">Senin</option>
					<option value="Tuesday">Selasa</option>
					<option value="Wednesday">Rabu</option>
					<option value="Thursday">Kamis</option>
					<option value="Friday">Jumat</option>
					<option value="Saturday">Sabtu</option>
					<option value="Sunday">Ahad</option>
			</select>
			&nbsp;
			<label for="ceked_har"><input type="checkbox" value="1" name="ceked_har" id="ceked_har" onclick="cumaIni();" />Tampilkan Hanya Hari Ini</label>
		</td>
	</tr>
	
	<tr>
		<td>Jam Mulai</td><td><input type="text" name="mulai_jam" id="mulai_jam" value="" class="inputan" onkeypress="focusNext( 'mulai_menit', event, 'hari', this)" size="4" maxlength="2" />&nbsp;:<input type="text" name="mulai_menit" id="mulai_menit" value="" class="inputan" onkeypress="focusNext( 'selesai_jam', event, 'mulai_jam', this)" size="4" maxlength="2" />&nbsp;<em>jam:menit</em></td>
	</tr>
	<tr>
		<td>Jam Selesai</td><td><input type="text" name="selesai_jam" id="selesai_jam" value="" class="inputan" onkeypress="focusNext( 'selesai_menit', event, 'mulai_menit', this)" size="4" maxlength="2" />&nbsp;:<input type="text" name="selesai_menit" id="selesai_menit" value="" class="inputan" onkeypress="focusNext( 'ket', event, 'selesai_jam', this)" size="4" maxlength="2" />&nbsp;<em>jam:menit</em></td>
	</tr>
	<tr>
		<td>Keterangan</td>
		<td><input type="text" class="inputan" name="ket" id="ket" size="50" onkeypress="focusNext( 'simpan', event, 'selesai_menit', this)" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_jadwal_dokter_check(xajax.getFormValues('form_jadwal_dokter'));" onkeypress="focusNext( 'kamar_id', event, 'ket', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_jadwal_dokter();xajax_list_data();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>