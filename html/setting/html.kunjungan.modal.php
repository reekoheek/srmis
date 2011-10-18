<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_kunjungan();" /></div>
<div class="modal_title_bar">Ubah Data Kunjungan</div>
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
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td colspan="2">
						 <div id="tab_navcontainer">
								<ul id="tab_navlist">
								   <li style="tab_active"><a href="javascript:void(0)" onclick="set_content_tab(this, 'tab_data_kunjungan');">Data Kunjungan</a></li>
								   <li><a href="javascript:void(0)" onclick="set_content_tab(this, 'tab_diagnosa_tindakan');">Diagnosa &amp; Tindakan</a></li>
								   <li><a href="javascript:void(0)" onclick="set_content_tab(this, 'tab_data_lain');">Data Penyerta</a></li>
								</ul>
							</div>
					</td>
				</tr>
			</table>
			<div id="tab_data_kunjungan">
			<fieldset>
			<legend>Data Kunjungan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Jenis Pelayanan*</td>
					<td colspan="2">
						<select name="input_jenis" id="input_jenis" style="width: 200px;" onkeypress="focusNext( 'input_pelayanan_id', event, 'input_kelanjutan', this)" class="inputan" onchange="xajax_ref_get_pelayanan('input_pelayanan_id', this.value)">
							<option value="">--- PILIH ---</option>
				<option value="IGD">IGD</option>
				<option value="RAWAT JALAN">RAWAT JALAN</option>
				<option value="RAWAT INAP">RAWAT INAP</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Klinik/ Bangsal*</td>
					<td colspan="2">
						<select name="input_pelayanan_id" id="input_pelayanan_id" style="width: 200px;" onkeypress="focusNext('input_kamar_id', event, 'input_jenis', this)" class="inputan" onchange="xajax_ref_get_kamar('input_kamar_id', this.value);">
						<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kamar*</td>
					<td colspan="2">
						<select name="input_kamar_id" id="input_kamar_id" style="width: 200px;" onkeypress="focusNext('input_dokter_id', event, 'input_pelayanan_id', this)" class="inputan" onchange="xajax_ref_get_dokter('input_dokter_id', this.value)">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Dokter*</td>
					<td colspan="2">
						<select name="input_dokter_id" id="input_dokter_id" style="width: 200px;" onkeypress="focusNext('input_tgl_daftar_tgl', event, 'input_kamar_id', this)" class="inputan">
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
						<select name="input_tgl_daftar_mnt" id="input_tgl_daftar_mnt" style="width: 50px;" onkeypress="focusNext( 'input_tgl_daftar_dtk', event, 'input_tgl_daftar_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
							?>
								<option value="<?=$mnt?>"><?=$mnt?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_daftar_dtk" id="input_tgl_daftar_dtk" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_tgl', event, 'input_tgl_daftar_mnt', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
								$dtk = tambahNol($i, 2);
							?>
								<option value="<?=$dtk?>"><?=$dtk?></option>
							<? endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td colspan="2">
						<select name="input_tgl_periksa_tgl" id="input_tgl_periksa_tgl" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_bln', event, 'input_tgl_daftar_dtk', this)" class="inputan">
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
						<select name="input_tgl_periksa_mnt" id="input_tgl_periksa_mnt" style="width: 50px;" onkeypress="focusNext( 'input_tgl_periksa_dtk', event, 'input_tgl_periksa_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
							?>
								<option value="<?=$mnt?>"><?=$mnt?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_periksa_dtk" id="input_tgl_periksa_dtk" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_tgl', event, 'input_tgl_periksa_mnt', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
								$dtk = tambahNol($i, 2);
							?>
								<option value="<?=$dtk?>"><?=$dtk?></option>
							<? endfor; ?>
						</select>

					</td>
				</tr>
				<tr>
					<td>Tgl Keluar</td>
					<td colspan="2">
						<select name="input_tgl_keluar_tgl" id="input_tgl_keluar_tgl" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_bln', event, 'input_tgl_periksa_dtk', this)" class="inputan">
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_keluar_bln" id="input_tgl_keluar_bln" style="width: 80px;" onkeypress="focusNext( 'input_tgl_keluar_thn', event, 'input_tgl_keluar_tgl', this)" class="inputan">
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									if($bln==$bln_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_keluar_thn" id="input_tgl_keluar_thn" style="width: 60px;" onkeypress="focusNext( 'input_tgl_keluar_jam', event, 'input_tgl_keluar_bln', this)" class="inputan">
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									if($i==$thn_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>

						<select name="input_tgl_keluar_jam" id="input_tgl_keluar_jam" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_mnt', event, 'input_tgl_keluar_thn', this)" class="inputan">
							<?	for($i=0;$i<25;$i++) :
									$jam = tambahNol($i, 2);
							?>
								<option value="<?=$jam?>"><?=$jam?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_keluar_mnt" id="input_tgl_keluar_mnt" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_dtk', event, 'input_tgl_keluar_jam', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
									$mnt = tambahNol($i, 2);
							?>
								<option value="<?=$mnt?>"><?=$mnt?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_keluar_dtk" id="input_tgl_keluar_dtk" style="width: 50px;" onkeypress="focusNext( 'input_kelanjutan', event, 'input_tgl_keluar_mnt', this)" class="inputan">
							<? for($i=0;$i<60;$i++) :
								$dtk = tambahNol($i, 2);
							?>
								<option value="<?=$dtk?>"><?=$dtk?></option>
							<? endfor; ?>
						</select>

					</td>
				</tr>
				
			</table>
			</fieldset>
			<fieldset>
			<legend>Data Status Pemeriksaan</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Kelanjutan*</td>
					<td colspan="2">
						<select name="input_kelanjutan" id="input_kelanjutan" style="width: 200px;" onkeypress="focusNext( 'input_jenis', event, 'input_tgl_keluar_dtk', this)" class="inputan">
							<option value="">--- PILIH ---</option>
							<option value="DIRAWAT">DIRAWAT</option>
							<option value="DIRUJUK">DIRUJUK</option>
							<option value="PULANG">PULANG</option>
						</select>
					</td>
				</tr>
			</table>
			</fieldset>
			</div>
			<div id="tab_diagnosa_tindakan" style="display:none;">
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
			</div>
			<div id="tab_data_lain" style="display:none;">
			<fieldset>
			<legend>Data Penyerta</legend>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 150px;">Kunjungan Ke</td>
					<td>
						<input type="text" name="input_kunjungan_ke" id="input_kunjungan_ke" value="" class="inputan" onkeypress="focusNext( 'input_cara_masuk', event, 'input_pj_hubungan_keluarga', this)" />
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
						<select name="input_cara_bayar" id="input_cara_bayar" style="width: 200px;" onkeypress="focusNext( 'input_nomor', event, 'input_perujuk_id', this)" class="inputan" onchange="showNomor(this.value)">
						<option value="">--- PILIH ---</option>
						<option value="UMUM">UMUM</option>
						<option value="ASKESKIN">ASKESKIN</option>
						<option value="JAMSOSTEK">JAMSOSTEK</option>
						<option value="KARYAWAN PKU">KARYAWAN PKU</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Nomor Askes/ NIK</td>
					<td>
						<input type="text" name="input_nomor" id="input_nomor" value="" class="inputan" onkeypress="focusNext( 'input_pj_nama', event, 'input_cara_bayar', this)" />
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
						<select name="input_pj_hubungan_keluarga" id="input_pj_hubungan_keluarga" style="width: 200px;" onkeypress="focusNext( 'input_kunjungan_ke', event, 'input_pj_telp', this)" class="inputan">
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
			</div>
		</td>
		<td style="width:50%">
			<div id="tab_list_semua_kunjungan_navi" class="navi"></div>
			<div id="tab_list_semua_kunjungan" style="height:auto;max-height:350px;overflow:scroll;border-right:solid 1px #000000;"></div>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kunjungan_check(xajax.getFormValues('input_kunjungan'));" />&nbsp;&nbsp;
		<input type="button" name="input_simpan_as" id="input_simpan_as" value="Simpan Sebagai Kunjungan Baru" class="inputan" onclick="xajax_simpan_kunjungan(xajax.getFormValues('input_kunjungan'), true);" />&nbsp;&nbsp;
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="xajax_tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>

<div id="form_cari_diagnosa" class="window_modal" style="display:none;top:170px;left:195px;width:600px;z-index:3">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_diagnosa();" class="close_button" />
	<h3>Pencarian Diagnosa</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_diagnosa" id="cari_diagnosa" onsubmit="return false;">
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Diagnosa</td>
			<td>
				<input type="text" name="diagnosa" id="diagnosa" class="inputan" onkeypress="focusNext('cari_diagnosa_cari', event, 'cari_diagnosa_cari', this)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_diagnosa_cari" id="cari_diagnosa_cari" value="Cari" class="inputan" onclick="xajax_cari_diagnosa('0',xajax.getFormValues('cari_diagnosa'));" onkeypress="focusNext('diagnosa', event, 'diagnosa', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="diagnosa_navi" class="navi"></div>
	<div id="list_diagnosa"></div>
</div>

<div id="form_cari_tindakan" class="window_modal" style="display:none;top:250px;left:195px;width:450px;z-index:3">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_tindakan();" class="close_button" />
	<h3>Daftar Tindakan</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_tindakan" id="cari_tindakan" onsubmit="return false;">
	<input type="hidden" name="tindakan_trigger" id="tindakan_trigger" value="0" />
	<input type="hidden" name="add_btn_tindakan_again" id="add_btn_tindakan_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Tindakan</td>
			<td>
				<input type="text" name="tindakan" id="tindakan" class="inputan" onkeypress="focusNext( 'cari_tindakan_cari', event, 'cari_tindakan_cari', this)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_tindakan_cari" id="cari_tindakan_cari" value="Cari" class="inputan" onclick="xajax_cari_tindakan('0',xajax.getFormValues('cari_tindakan'));" onkeypress="focusNext('tindakan', event, 'tindakan', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="tindakan_navi" class="navi"></div>
	<div id="list_tindakan"></div>
</div>

<div id="form_cari_bhp" class="window_modal" style="display:none;top:300px;left:195px;width:450px;z-index:5">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_bhp();" class="close_button" />
	<h3>Daftar BHP</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_bhp" id="cari_bhp" onsubmit="return false;">
	<input type="hidden" name="bhp_trigger" id="bhp_trigger" value="0" />
	<input type="hidden" name="add_btn_bhp_again" id="add_btn_bhp_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">BHP</td>
			<td>
				<input type="text" name="bhp" id="bhp" class="inputan" onkeypress="focusNext( 'cari_bhp_cari', event, 'cari_bhp_cari', this)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_bhp_cari" id="cari_bhp_cari" value="Cari" class="inputan" onclick="xajax_cari_bhp('0',xajax.getFormValues('cari_bhp'));" onkeypress="focusNext('bhp', event, 'bhp', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="bhp_navi" class="navi"></div>
	<div id="list_bhp"></div>
</div>

<div id="form_cari_imunisasi" class="window_modal" style="display:none;top:370px;left:195px;width:450px;z-index:3">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_imunisasi();" class="close_button" />
	<h3>Daftar Imunisasi</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_imunisasi" id="cari_imunisasi" onsubmit="return false;">
	<input type="hidden" name="imunisasi_trigger" id="imunisasi_trigger" value="0" />
	<input type="hidden" name="add_btn_imunisasi_again" id="add_btn_imunisasi_again" value="0" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:150px;">Imunisasi</td>
			<td>
				<input type="text" name="imunisasi" id="imunisasi" class="inputan" onkeypress="focusNext( 'cari_imunisasi_cari', event, 'cari_imunisasi_cari', this)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_imunisasi_cari" id="cari_imunisasi_cari" value="Cari" class="inputan" onclick="xajax_cari_imunisasi('0',xajax.getFormValues('cari_imunisasi'));" onkeypress="focusNext('imunisasi', event, 'imunisasi', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="imunisasi_navi" class="navi"></div>
	<div id="list_imunisasi"></div>
</div>