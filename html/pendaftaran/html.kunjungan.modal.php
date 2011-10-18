<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_kunjungan();" /></div>
<div class="modal_title_bar"><?=$_TITLE?></div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_id_kunjungan" id="input_id_kunjungan" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 150px;">No. RM</td>
					<td><div id="input_no_rm"></div></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td><div id="input_pasien"></div></td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 150px;">Jenis Kelamin</td>
					<td><div id="input_sex"></div></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><div id="input_usia"></div></td>
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
					<td style="width: 150px;">Pelayanan</td>
					<td colspan="2">
						IRD
					</td>
				</tr>
				<tr>
					<td>Dokter</td>
					<td colspan="2">
						<select name="input_dokter_id" id="input_dokter_id" style="width: 200px;" onkeypress="focusNext('input_tgl_daftar_tgl', event, 'input_simpan', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
			<fieldset>
			<legend>Tanggal Kunjungan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Tgl Daftar</td>
					<td colspan="2">
						<select name="input_tgl_daftar_tgl" id="input_tgl_daftar_tgl" style="width: 50px;" onkeypress="focusNext( 'input_tgl_daftar_bln', event, 'input_dokter_id', this)" class="inputan">
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_daftar_bln" id="input_tgl_daftar_bln" style="width: 80px;" onkeypress="focusNext( 'input_tgl_daftar_thn', event, 'input_tgl_daftar_tgl', this)" class="inputan">
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									if($bln==$bln_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_daftar_thn" id="input_tgl_daftar_thn" style="width: 60px;" onkeypress="focusNext( 'input_tgl_daftar_jam', event, 'input_tgl_daftar_bln', this)" class="inputan">
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									if($i==$thn_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>

						<select name="input_tgl_daftar_jam" id="input_tgl_daftar_jam" style="width: 50px;" onkeypress="focusNext( 'input_tgl_daftar_mnt', event, 'input_tgl_daftar_thn', this)" class="inputan">
							<?	for($i=0;$i<25;$i++) :
									$jam = tambahNol($i, 2);
							?>
								<option value="<?=$jam?>"><?=$jam?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_daftar_mnt" id="input_tgl_daftar_mnt" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_tgl', event, 'input_tgl_daftar_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
							?>
								<option value="<?=$mnt?>"><?=$mnt?></option>
							<? endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td colspan="2">
						<select name="input_tgl_periksa_tgl" id="input_tgl_periksa_tgl" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_bln', event, 'input_tgl_daftar_mnt', this)" class="inputan">
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_periksa_bln" id="input_tgl_periksa_bln" style="width: 80px;" onkeypress="focusNext( 'input_tgl_periksa_thn', event, 'input_tgl_periksa_tgl', this)" class="inputan">
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									if($bln==$bln_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_periksa_thn" id="input_tgl_periksa_thn" style="width: 60px;" onkeypress="focusNext( 'input_tgl_periksa_jam', event, 'input_tgl_periksa_bln', this)" class="inputan">
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									if($i==$thn_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>

						<select name="input_tgl_periksa_jam" id="input_tgl_periksa_jam" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_mnt', event, 'input_tgl_periksa_thn', this)" class="inputan">
							<?	for($i=0;$i<25;$i++) :
									$jam = tambahNol($i, 2);
							?>
								<option value="<?=$jam?>"><?=$jam?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_periksa_mnt" id="input_tgl_periksa_mnt" style="width: 50px;" onkeypress="focusNext( 'input_kelanjutan', event, 'input_tgl_periksa_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
							?>
								<option value="<?=$mnt?>"><?=$mnt?></option>
							<? endfor; ?>
						</select>
					</td>
				</tr>				
			</table>
			</fieldset>
			<fieldset>
			<legend>Data Kelanjutan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Kelanjutan*</td>
					<td colspan="2">
						<select name="input_kelanjutan" id="input_kelanjutan" style="width: 200px;" onkeypress="focusNext( 'input_kunjungan_ke', event, 'input_tgl_periksa_mnt', this)" class="inputan">
							<option value="">--- PILIH ---</option>
							<option value="DIRAWAT">DIRAWAT</option>
							<option value="DIRUJUK">DIRUJUK</option>
							<option value="PULANG">PULANG</option>
							<option value="PINDAH KAMAR">PINDAH KAMAR</option>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
		</td>
		<td style="width:50%"><fieldset>
			<legend>Data Penyerta</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Kunjungan Ke</td>
					<td>
						<input type="text" name="input_kunjungan_ke" id="input_kunjungan_ke" value="" class="inputan" onkeypress="focusNext( 'input_cara_masuk', event, 'input_kelanjutan', this)" />
					</td>
				</tr>
				<tr>
					<td>Cara Masuk*</td><td>
						<select name="input_cara_masuk" id="input_cara_masuk" style="width: 200px;" onkeypress="focusNext('input_perujuk_id', event, 'input_kunjungan_ke', this)" class="inputan" onchange="xajax_ref_get_perujuk('input_perujuk_id', this.value)">
						<option value="">--- PILIH ---</option>
						<option value="DATANG SENDIRI">DATANG SENDIRI</option>
						<option value="KASUS POLISI">KASUS POLISI</option>
						<option value="RUJUKAN">RUJUKAN</option>
						<option value="LAIN-LAIN">LAIN-LAIN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Perujuk</td><td>
						<select name="input_perujuk_id" id="input_perujuk_id" style="width: 200px;" onkeypress="focusNext( 'input_cara_bayar', event, 'input_cara_masuk', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Cara Bayar*</td><td>
						<select name="input_cara_bayar" id="input_cara_bayar" style="width: 200px;" onkeypress="focusNext( 'input_jenis_askes', event, 'input_perujuk_id', this)" class="inputan" onchange="showNomor(this.value);xajax_ref_get_jenis_askes('input_jenis_askes', this.value);xajax_ref_get_perusahaan('input_perusahaan_id', this.value);">
						<option value="">--- PILIH ---</option>
						<option value="UMUM">UMUM</option>
						<option value="ASKES">ASKES</option>
						<option value="JAMSOSTEK">JAMSOSTEK</option>
						<option value="DANA REKSA DESA">DANA REKSA DESA</option>
						<option value="KONTRAK">KONTRAK</option>
						<option value="LAIN-LAIN">LAIN-LAIN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jenis Askes</td><td>
						<select name="input_jenis_askes" id="input_jenis_askes" style="width: 200px;" onkeypress="focusNext( 'input_perusahaan_id', event, 'input_cara_bayar', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Perusahaan</td><td>
						<select name="input_perusahaan_id" id="input_perusahaan_id" style="width: 200px;" onkeypress="focusNext( 'input_nomor', event, 'input_jenis_askes', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Nomor Askes/ NIK</td>
					<td>
						<input type="text" name="input_nomor" id="input_nomor" value="" class="inputan" onkeypress="focusNext( 'input_pj_nama', event, 'input_perusahaan_id', this)" />
					</td>
				</tr>
			</table>
			</fieldset>
			<fieldset>
			<legend>Penanggung Jawab</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td>Nama</td>
					<td>
						<input type="text" name="input_pj_nama" id="input_pj_nama" value="" class="inputan" onkeypress="focusNext( 'input_pj_alamat', event, 'input_nomor', this)" size="50" />
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>
						<input type="text" name="input_pj_alamat" id="input_pj_alamat" value="" size="50" class="inputan" onkeypress="focusNext('input_pj_telp', event, 'input_pj_nama', this)" />
					</td>
				</tr>
				<tr>
					<td style="width:150px">Telepon</td><td><input type="text" name="input_pj_telp" id="input_pj_telp" value="" class="inputan" onkeypress="focusNext('input_pj_hubungan_keluarga', event, 'input_pj_alamat', this)" />
					</td>
				</tr>
				<tr>
					<td>Hubungan Keluarga</td>
					<td>
						<select name="input_pj_hubungan_keluarga" id="input_pj_hubungan_keluarga" style="width: 200px;" onkeypress="focusNext( 'input_simpan', event, 'input_pj_telp', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="AYAH">AYAH</option>
						<option value="IBU">IBU</option>
						<option value="SUAMI">SUAMI</option>
						<option value="ISTRI">ISTRI</option>
						<option value="SAUDARA">SAUDARA</option>
						<option value="PAMAN">PAMAN</option>
						<option value="BIBI">BIBI</option>
						<option value="LAIN-LAIN">LAIN-LAIN</option>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kunjungan_check(xajax.getFormValues('input_kunjungan'));" onkeypress="focusNext( 'input_dokter_id', event, 'input_pj_hubungan_keluarga', this)" />&nbsp;&nbsp;
		<!-- <input type="button" name="input_simpan_as" id="input_simpan_as" value="Simpan Sebagai Kunjungan Baru" class="inputan" onclick="xajax_simpan_kunjungan(xajax.getFormValues('input_kunjungan'), true);" />&nbsp;&nbsp; -->
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="xajax_tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>