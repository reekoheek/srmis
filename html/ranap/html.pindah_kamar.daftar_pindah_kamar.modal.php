<div id="modal_daftar_pindah_kamar" class="window_modal" style="display:none;left:20px;top:20px;width:70%;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_daftar_pindah_kamar();" /></div>
<div class="modal_title_bar">Pindah Kamar Rawat Inap</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="daftar_pindah_kamar" id="daftar_pindah_kamar" onsubmit="return false;">
<input type="hidden" name="id_kunjungan_kamar" id="id_kunjungan_kamar" />
<input type="hidden" name="id_kunjungan_kamar_stl_pindah" id="id_kunjungan_kamar_stl_pindah" />
<input type="hidden" name="id_kunjungan" id="id_kunjungan" />
<input type="hidden" name="is_edit" id="is_edit" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td style="width:50%;">
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">No. RM</td>
					<td><div id="no_rm"></div></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td><div id="pasien"></div></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><div id="jenis_kelamin"></div></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><div id="usia"></div></td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Pelayanan Asal</td>
					<td><div id="pelayanan_asal"></div></td>
				</tr>
				<tr>
					<td>Dokter Pengirim</td>
					<td><div id="dokter_pengirim"></div></td>
				</tr>
				<tr>
					<td>Diagnosa</td>
					<td><div id="diagnosa_klinik"></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<fieldset>
			<legend>Cara Pembayaran</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Cara Bayar*</td><td>
						<select name="cara_bayar" id="cara_bayar" style="width: 200px;" onkeypress="focusNext( 'jenis_askes', event, 'simpan', this)" class="inputan" onchange="showNomor(this.value);xajax_ref_get_jenis_askes('jenis_askes', this.value);xajax_ref_get_perusahaan('perusahaan_id', this.value);">
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
						<select name="jenis_askes" id="jenis_askes" style="width: 200px;" onkeypress="focusNext( 'perusahaan_id', event, 'cara_bayar', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Perusahaan</td><td>
						<select name="perusahaan_id" id="perusahaan_id" style="width: 200px;" onkeypress="focusNext( 'nomor', event, 'jenis_askes', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Nomor Askes/ NIK</td>
					<td>
						<input type="text" name="nomor" id="nomor" value="" class="inputan" onkeypress="focusNext( 'pj_nama', event, 'perusahaan_id', this)" />
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
						<input type="text" name="pj_nama" id="pj_nama" value="" class="inputan" onkeypress="focusNext( 'pj_alamat', event, 'nomor', this)" size="50" />
					</td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td>
						<input type="text" name="pj_alamat" id="pj_alamat" value="" size="50" class="inputan" onkeypress="focusNext('pj_telp', event, 'pj_nama', this)" />
					</td>
				</tr>
				<tr>
					<td style="width:150px">Telepon</td><td><input type="text" name="pj_telp" id="pj_telp" value="" class="inputan" onkeypress="focusNext('pj_hubungan_keluarga', event, 'pj_alamat', this)" />
					</td>
				</tr>
				<tr>
					<td>Hubungan Keluarga</td>
					<td>
						<select name="pj_hubungan_keluarga" id="pj_hubungan_keluarga" style="width: 200px;" onkeypress="focusNext( 'pelayanan_id', event, 'pj_telp', this)" class="inputan">
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
			<fieldset>
			<legend>Kamar Rawat Inap</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width:150px;">Bangsal*</td>
					<td>
						<select name="pelayanan_id" id="pelayanan_id" style="width: 200px;" onkeypress="focusNext('kamar_id', event, 'pj_hubungan_keluarga', this)" class="inputan" onchange="xajax_ref_get_kamar('kamar_id', this.value);get_info_kamar(this);xajax_ref_get_bed('no_kamar', this.value);xajax_ref_get_dokter('dokter_id', this.value);">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kamar*</td>
					<td>
						<select name="kamar_id" id="kamar_id" style="width: 200px;" onkeypress="focusNext('dokter_id', event, 'pelayanan_id', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>No Bed*</td>
					<td>
						<select name="no_kamar" id="no_kamar" style="width: 200px;" onkeypress="focusNext('dokter_id', event, 'pelayanan_id', this)" class="inputan">
							<option value="">-- PILIH --</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Dokter</td>
					<td>
						<select name="dokter_id" id="dokter_id" style="width: 200px;" onkeypress="focusNext('tgl_keluar_tgl', event, 'kamar_id', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				
				<tr>
					<td>Tgl Pindah</td>
					<td>
						<select name="tgl_keluar_tgl" id="tgl_keluar_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_keluar_bln', event, 'dokter_id', this)" class="inputan">
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_keluar_bln" id="tgl_keluar_bln" style="width: 80px;" onkeypress="focusNext( 'tgl_keluar_thn', event, 'tgl_keluar_tgl', this)" class="inputan">
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									if($bln==$bln_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_keluar_thn" id="tgl_keluar_thn" style="width: 60px;" onkeypress="focusNext( 'tgl_keluar_jam', event, 'tgl_keluar_bln', this)" class="inputan">
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									if($i==$thn_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<?
							$jam_skr = date("H");
							$mnt_skr = date("i");
							$dtk_skr = date("s");
						?>
						<select name="tgl_keluar_jam" id="tgl_keluar_jam" style="width: 50px;" onkeypress="focusNext( 'tgl_keluar_mnt', event, 'dokter_id', this)" class="inputan">
							<?	for($i=0;$i<25;$i++) :
									$jam = tambahNol($i, 2);
									if($jam==$jam_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$jam?>" <?=$sel?> ><?=$jam?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_keluar_mnt" id="tgl_keluar_mnt" style="width: 50px;" onkeypress="focusNext( 'simpan', event, 'tgl_keluar_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
									if($mnt==$mnt_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$mnt?>" <?=$sel?> ><?=$mnt?></option>
							<? endfor; ?>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_daftar_pindah_kamar_check(xajax.getFormValues('daftar_pindah_kamar'));" onfocus="hide_info_kamar();" />&nbsp;&nbsp;
		<input type="button" name="cancel" id="cancel" value="Tutup" class="inputan" onclick="xajax_tutup_daftar_pindah_kamar();" /> </td>
	</tr>
</table>
</form>
</div>