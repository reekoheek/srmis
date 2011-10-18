<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kunjungan();" /></div>
<div class="modal_title_bar">Sewa Kendaraan</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_id_kunjungan" id="input_id_kunjungan" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td style="width:350px">
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 120px;">No. RM</td>
					<td><div id="input_no_rm"></div></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td><div id="input_pasien"></div></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><div id="input_sex"></div></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><div id="input_usia"></div></td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 120px;">Cara Masuk</td>
					<td><div id="input_cara_masuk"></div></td>
				</tr>
				<tr>
					<td>Cara Bayar</td>
					<td><div id="input_cara_bayar"></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			<fieldset>
			<legend>Data Kunjungan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 120px;">Kunjungan ke-</td>
					<td><div id="input_kunjungan_ke"></div></td>
				</tr>
				<tr>
					<td>Pelayanan</td>
					<td><div id="input_spesialisasi"></div></td>
				</tr>
				<tr>
					<td>Tgl Daftar</td>
					<td><div id="input_tgl_daftar"></div></td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td><div id="input_tgl_periksa"></div></td>
				</tr>
				<tr>
					<td>Dokter</td>
					<td><div id="input_dokter"></div></td>
				</tr>
				<tr>
					<td>Kelanjutan</td>
					<td><div id="input_kelanjutan"></div></td>
				</tr>
				<tr>
					<td>Keadaan Keluar</td>
					<td><div id="input_keadaan_keluar"></div></td>
				</tr>
				<tr>
					<td>Tgl Keluar</td>
					<td><div id="input_tgl_keluar"></div></td>
				</tr>
			</table>
			</fieldset>
			<fieldset>
			<legend>Diagnosa Utama</legend>
				<div style="margin-left:10px;"><span id="input_diagnosa_utama_nama">&nbsp;</span></div>
			</fieldset>
		</td>
		<td>
			<fieldset class="fieldset_modal">
			<legend>Sewa Kendaraan</legend>
				<table cellpadding="0" cellspacing="5" border="0" class="form">
					<tr>
						<td style="width:100px;">Harga BBM (Rp)</td><td><input type="text" name="input_harga_bbm" id="input_harga_bbm" value="" class="inputan_angka" size="30" onkeypress="focusNext('input_jarak_tempuh', event, 'input_simpan', this)" /></td>
					</tr>
					<tr>
						<td>Jarak Tempuh (KM)</td><td><input type="text" name="input_jarak_tempuh" id="input_jarak_tempuh" class="inputan_angka" size="30" onkeypress="xcari_kendaraan(this, event);focusNext('input_simpan', event, 'input_harga_bbm', this)" /></td>
					</tr>
				</table><br />
				<a href="javascript:void(0)" title="Add Kendaraan" onclick="xajax_cari_kendaraan();buka_kendaraan(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Kendaraan</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th></th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_kendaraan"></tbody>
				</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="simpan_kunjungan(xajax.getFormValues('input_kunjungan'));" onkeypress="focusNext('input_harga_bbm', event, 'input_jarak_tempuh', this)" />&nbsp;&nbsp;
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>

<div id="form_cari_kendaraan" class="window_modal" style="display:none;left:30px;width:340px;z-index:4">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kendaraan();" class="close_button" />
	<h3>Daftar Kendaraan</h3>
	<div id="list_kendaraan"></div>
</div>
