<div id="form_cari" style="display:none;">
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_pasien" id="cari_pasien" onsubmit="return false;" >
	<fieldset>
	<legend>Parameter Pencarian</legend>
	<input type="hidden" name="is_cari" value="1" />
	<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
		<tr>
			<td style="width:50%;">
				<table cellpadding="0" cellspacing="4" border="0" class="form">
					<tr>
						<td style="width: 150px">No. RM</td><td><input type="text" name="cari_id" id="cari_id" maxlength="8" size="11" value="" class="inputan" onkeyup="numeralsOnly(this, event, '', this);" onkeypress="focusNext( 'cari_nama', event, '', this)" /></td>
					</tr>
					<tr>
						<td>Nama</td><td><input type="text" name="cari_nama" id="cari_nama" value="" class="inputan" onkeypress="focusNext( 'cari_sex', event, 'cari_id', this)" size="50" /></td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>
							<select name="cari_sex" id="cari_sex" style="width: 100px;" onkeypress="focusNext( 'cari_alamat', event, 'cari_nama', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						<option value="LAKI-LAKI">LAKI-LAKI</option>
						<option value="PEREMPUAN">PEREMPUAN</option>
							</select>
						</td>
					</tr>

					<tr>
						<td>Alamat</td><td><input type="text" name="cari_alamat" id="cari_alamat" value="" class="inputan" size="50" onkeypress="focusNext( 'cari_rt', event, 'cari_sex', this)" onkeyup="this.value=this.value.toUpperCase()" />
						</td>
					</tr>
					<tr>
						<td></td><td>
						RT <input type="text" name="cari_rt" id="cari_rt" value="" class="inputan" size="5" onkeypress="focusNext( 'cari_rw', event, 'cari_alamat', this)" />&nbsp;RW <input type="text" name="cari_rw" id="cari_rw" value="" class="inputan" size="5" onkeypress="focusNext( 'cari_propinsi_id', event, 'cari_rt', this)" />
						</td>
					</tr>
                    <tr>
					<td>Tgl Lahir</td>
					<td>
							<?
							$tgl_skr = date("d");
							$bln_skr = date("m");
							$thn_skr = date("Y");
							$thn_start = $thn_skr-70;
							?>					
						<select name="tgl_lahir_tgl" id="tgl_lahir_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_lahir_bln', event, 'tempat_lahir', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									/*if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_bln" id="tgl_lahir_bln" style="width: 100px;" onkeypress="focusNext( 'tgl_lahir_thn', event, 'tgl_lahir_tgl', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									/*if($bln==$bln_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_thn" id="tgl_lahir_thn" style="width: 60px;" onkeypress="focusNext( 'gol_darah_id', event, 'tgl_lahir_bln', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									/*if($i==$thn_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor ?>
						</select>
					</td>
				</tr>
				</table>
			</td>
			<td>
				<table cellpadding="0" cellspacing="4" border="0" class="form">
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
							<select name="cari_kabupaten_id" id="cari_kabupaten_id" style="width: 200px;" onkeypress="focusNext( 'cari_kecamatan_id', event, 'cari_propinsi_id', this)" class="inputan" onchange="xajax_cari_get_kecamatan(this.value);">
								<option value="">--- PILIH ---</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Kecamatan</td>
						<td>
							<select name="cari_kecamatan_id" id="cari_kecamatan_id" style="width: 200px;" onkeypress="focusNext( 'cari_desa_id', event, 'cari_kabupaten_id', this)" class="inputan" onchange="xajax_cari_get_desa(this.value);">
								<option value="">--- PILIH ---</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Kelurahan</td>
						<td>
							<select name="cari_desa_id" id="cari_desa_id" style="width: 200px;" onkeypress="focusNext( 'cari', event, 'cari_kecamatan_id', this)" class="inputan">
								<option value="">--- PILIH ---</option>
							</select>
						</td>
					</tr>
                    <tr>
						<td>Telp</td>
						<td>
							<input type="text" name="cari_telp" id="cari_telp" value="" class="inputan" size="20" onkeypress="focusNext( 'cari_telp', event, 'id', this)" onkeyup="this.value=this.value.toUpperCase()" />
						</td>
					</tr>                   
				</table>
			</td>
		</tr>
	</table>
	</fieldset>
	</form>
	<div style="text-align:center"><input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('cari_pasien'));" />&nbsp;&nbsp;<input type="button" name="daftarkan" id="daftarkan" value="Daftarkan Sebagai Pasien Baru" class="inputan" onclick="xajax_daftar_dari_cari(xajax.getFormValues('cari_pasien'));" /></div>
	<h3>Hasil Pencarian</h3>
<div id="cari_navi" class="navi"></div>
<div id="list_data"></div>
<!-- <div class="info" id="info_cari"><b>Petunjuk :</b>
Silakan isi parameter pencarian pasien.
Klik pada salah satu pasien untuk melihat detil data pasien dan kunjungan.
Klik tombol <img src="<?=IMAGES_URL?>back.png" alt="" /> untuk kembali.
</div> -->
</div>