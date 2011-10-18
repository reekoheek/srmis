<div id="modal_pesan_kamar" class="window_modal" style="display:none;left:20px;top:20px;width:70%;z-index:3;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_pesan_kamar();" /></div>
<div class="modal_title_bar">Pesan Kamar Rawat Inap</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="pesan_kamar" id="pesan_kamar" onsubmit="return false;">
<input type="hidden" name="id_kunjungan_kamar" id="id_kunjungan_kamar" />
<input type="hidden" name="id_kunjungan" id="id_kunjungan" />
<input type="hidden" name="id_pesan_kamar" id="id_pesan_kamar" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td colspan="2">
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 150px;">No. RM</td>
					<td><div id="no_rm"></div></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td><div id="pasien"></div></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><div id="usia"></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<fieldset>
			<legend>Kamar yang dipesan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width:150px;">Bangsal*</td>
					<td style="width:150px;">
						<select name="pelayanan_id" id="pelayanan_id" style="width: 200px;" onkeypress="focusNext('kamar_id', event, 'simpan', this)" class="inputan" onchange="xajax_ref_get_kamar('kamar_id', this.value);xajax_get_info_kamar(this.value)">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
					<td rowspan="4"><div id="info_kamar"></div></td>
				</tr>
				<tr>
					<td>Kamar*</td>
					<td>
						<select name="kamar_id" id="kamar_id" style="width: 200px;" onkeypress="focusNext('catatan_ke_ranap', event, 'pelayanan_id', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Catatan</td>
					<td>
						<input type="text" class="inputan" maxlength="255" size="50" name="catatan_ke_ranap" id="catatan_ke_ranap" onkeypress="focusNext('simpan', event, 'kamar_id', this)" />
					</td>
				</tr>
				<tr>
					<td></td>
					<td><div id="catatan_dari_ranap"></div></td>
				</tr>
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_pesan_kamar_check(xajax.getFormValues('pesan_kamar'));" />&nbsp;&nbsp;
		<input type="button" name="cancel" id="cancel" value="Tutup" class="inputan" onclick="xajax_tutup_pesan_kamar();" /> </td>
	</tr>
</table>
</form>
</div>