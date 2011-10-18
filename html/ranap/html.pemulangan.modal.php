<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_kunjungan();" /></div>
<div class="modal_title_bar">Pemulangan Pasien</div>
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
					<td>Lama Dirawat</td>
					<td><div id="input_lama_dirawat"></div></td>
				</tr>
				<tr>
					<td>Dokter</td>
					<td><div id="input_dokter"></div></td>
				</tr>
				<tr>
					<td>Kelanjutan*</td>
					<td colspan="2">
						<select name="input_kelanjutan" id="input_kelanjutan" style="width: 200px;" onkeypress="focusNext('input_keadaan_keluar', event, 'input_simpan', this)" class="inputan">
							<option value="">--- PILIH ---</option>
							<option value="DIRUJUK">DIRUJUK</option>
							<option value="PULANG">PULANG</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Keadaan Keluar*</td>
					<td colspan="2">
						<select name="input_keadaan_keluar" id="input_keadaan_keluar" style="width: 200px;" onkeypress="focusNext('input_tgl_keluar_tgl', event, 'input_kelanjutan', this)" class="inputan">
							<option value="">--- PILIH ---</option>
							<option value="BELUM SEMBUH">BELUM SEMBUH</option>
							<option value="SEMBUH">SEMBUH</option>
							<option value="MATI < 48 JAM">MATI < 48 JAM</option>
							<option value="MATI >= 48 JAM">MATI >= 48 JAM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Tgl Keluar</td>
					<td colspan="2">
						<select name="input_tgl_keluar_tgl" id="input_tgl_keluar_tgl" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_bln', event, 'input_keadaan_keluar', this)" class="inputan">
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
						</select><br /><br />
						<?
							$jam_skr = date("H");
							$mnt_skr = date("i");
							$dtk_skr = date("s");
						?>
						<select name="input_tgl_keluar_jam" id="input_tgl_keluar_jam" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_mnt', event, 'input_dokter_id', this)" class="inputan">
							<?	for($i=0;$i<25;$i++) :
									$jam = tambahNol($i, 2);
									if($jam==$jam_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$jam?>" <?=$sel?> ><?=$jam?></option>
							<? endfor; ?>
						</select>
						<select name="input_tgl_keluar_mnt" id="input_tgl_keluar_mnt" style="width: 50px;" onkeypress="focusNext( 'input_simpan', event, 'input_tgl_keluar_jam', this)" class="inputan">
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
		<td style="width:50%">
			<fieldset class="fieldset_modal">
			<legend>Diagnosa Utama</legend>
				<div style="margin-left:40px;"><span id="input_diagnosa_utama_nama">&nbsp;</span></div>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>Jasa Kamar</legend>
				<ol class="" id="tabel_input_karcis"></ol>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>Tindakan</legend>
				<ol class="" id="tabel_input_tindakan"></ol>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>BHP</legend>
				<ol class="" id="tabel_input_bhp"></ol>
			</fieldset><!-- 
			<fieldset class="fieldset_modal">
			<legend>Imunisasi</legend>
				<ol class="" id="tabel_input_imunisasi"></ol>
			</fieldset> -->
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kunjungan_check(xajax.getFormValues('input_kunjungan'));" />&nbsp;&nbsp;
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="xajax_tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>