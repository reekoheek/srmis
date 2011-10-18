<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_kunjungan();" /></div>
<div class="modal_title_bar">Input Pemeriksaan Rawat Inap</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_id_kunjungan" id="input_id_kunjungan" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td style="width:50%">
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 150px;">No. RM</td>
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
		<td style="width:50%">
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 150px;">Cara Masuk</td>
					<td><div id="input_cara_masuk"></div></td>
				</tr>
				<tr>
					<td>Pelayanan Asal</td>
					<td><div id="input_pelayanan_asal"></div></td>
				</tr>
				<tr>
					<td>Cara Bayar</td>
					<td><div id="input_cara_bayar"></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="width:50%">
			<fieldset>
			<legend>Data Kunjungan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Kunjungan ke-</td>
					<td><div id="input_kunjungan_ke"></div></td>
				</tr>
				<tr>
					<td>Kamar</td>
					<td><div id="input_spesialisasi"></div></td>
				</tr>
				<tr>
					<td>Tgl Daftar</td>
					<td><div id="input_tgl_daftar"></div></td>
				</tr>
				<tr>
					<td>Dokter*</td>
					<td>
						<select name="input_dokter_id" id="input_dokter_id" style="width: 250px;" onkeypress="focusNext('input_simpan', event, 'input_simpan', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
			<fieldset>
			<legend>Diagnosa Utama</legend>
				<div style="margin-left:40px;"><a href="javascript:void(0)" title="Add or Update Diagnosa Utama" onclick="buka_diagnosa()"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" /></a>&nbsp;&nbsp;<a href="javascript:void(0)" title="Hapus Diagnosa Utama" onclick="clear_diagnosa()"><img src="<?=IMAGES_URL?>remove.png" alt="" border="0" /></a>&nbsp;&nbsp;&nbsp;<span id="input_diagnosa_utama_nama">&nbsp;</span><input type="hidden" name="input_diagnosa_utama" id="input_diagnosa_utama" /></div>
			</fieldset>
			<fieldset>
			<legend>Tindakan</legend>
				<input type="hidden" name="jml_tindakan" id="jml_tindakan" value="1" />
				<ol class="" id="tabel_input_tindakan"></ol>
			</fieldset>
			<fieldset>
			<legend>BHP</legend>
				<input type="hidden" name="jml_bhp" id="jml_bhp" value="1" />
				<ol class="" id="tabel_input_bhp"></ol>
			</fieldset>
			<fieldset>
			<legend>Imunisasi</legend>
				<input type="hidden" name="jml_imunisasi" id="jml_imunisasi" value="1" />
				<ol class="" id="tabel_input_imunisasi"></ol>
			</fieldset>
		</td>
		<td style="width:50%">
			<div id="tab_list_semua_kunjungan_navi" class="navi"></div>
			<div id="tab_list_semua_kunjungan" style="height:auto;max-height:350px;overflow:scroll;border-right:solid 1px #000000;"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kunjungan_check(xajax.getFormValues('input_kunjungan'));" onkeypress="focusNext('input_dokter_id', event, 'input_dokter_id', this)" />&nbsp;&nbsp;
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="xajax_tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>

<div id="form_cari_diagnosa" class="window_modal" style="display:none;top:200px;left:195px;width:600px;z-index:3">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_diagnosa();" class="close_button" />
	<h3>Pencarian Diagnosa</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_diagnosa" id="cari_diagnosa" onsubmit="return false;">
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Diagnosa</td>
			<td>
				<input type="text" name="diagnosa" id="diagnosa" class="inputan" onkeypress="xcari_diagnosa(event);" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_diagnosa_cari" id="cari_diagnosa_cari" value="Cari" class="inputan" onclick="xajax_cari_diagnosa('0',xajax.getFormValues('cari_diagnosa'));" onkeypress="focusNext('diagnosa', event, 'diagnosa', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="diagnosa_navi" class="navi"></div>
	<div id="list_diagnosa"></div>
</div>

<div id="form_cari_tindakan" class="window_modal" style="display:none;top:200px;left:195px;width:450px;z-index:4">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_tindakan();" class="close_button" />
	<h3>Daftar Tindakan</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_tindakan" id="cari_tindakan" onsubmit="return false;">
	<input type="hidden" name="tindakan_trigger" id="tindakan_trigger" value="0" />
	<input type="hidden" name="add_btn_tindakan_again" id="add_btn_tindakan_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Tindakan</td>
			<td>
				<input type="text" name="tindakan" id="tindakan" class="inputan" onkeypress="xcari_tindakan(event);" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_tindakan_cari" id="cari_tindakan_cari" value="Cari" class="inputan" onclick="xajax_cari_tindakan('0',xajax.getFormValues('cari_tindakan'));" onkeypress="focusNext('tindakan', event, 'tindakan', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="tindakan_navi" class="navi"></div>
	<div id="list_tindakan"></div>
</div>

<div id="form_cari_bhp" class="window_modal" style="display:none;top:200px;left:195px;width:450px;z-index:5">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_bhp();" class="close_button" />
	<h3>Daftar BHP</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_bhp" id="cari_bhp" onsubmit="return false;">
	<input type="hidden" name="bhp_trigger" id="bhp_trigger" value="0" />
	<input type="hidden" name="add_btn_bhp_again" id="add_btn_bhp_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">BHP</td>
			<td>
				<input type="text" name="bhp" id="bhp" class="inputan" onkeypress="xcari_bhp(event);" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_bhp_cari" id="cari_bhp_cari" value="Cari" class="inputan" onclick="xajax_cari_bhp('0',xajax.getFormValues('cari_bhp'));" onkeypress="focusNext('bhp', event, 'bhp', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="bhp_navi" class="navi"></div>
	<div id="list_bhp"></div>
</div>

<div id="form_cari_imunisasi" class="window_modal" style="display:none;top:200px;left:195px;width:450px;z-index:6">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_imunisasi();" class="close_button" />
	<h3>Daftar Imunisasi</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_imunisasi" id="cari_imunisasi" onsubmit="return false;">
	<input type="hidden" name="imunisasi_trigger" id="imunisasi_trigger" value="0" />
	<input type="hidden" name="add_btn_imunisasi_again" id="add_btn_imunisasi_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Imunisasi</td>
			<td>
				<input type="text" name="imunisasi" id="imunisasi" class="inputan" onkeypress="xcari_imunisasi(event);" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_imunisasi_cari" id="cari_imunisasi_cari" value="Cari" class="inputan" onclick="xajax_cari_imunisasi('0',xajax.getFormValues('cari_imunisasi'));" onkeypress="focusNext('imunisasi', event, 'imunisasi', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="imunisasi_navi" class="navi"></div>
	<div id="list_imunisasi"></div>
</div>