<? 
     $_SESSION['status'] = 'IGD';
   include KOMPONEN_DIR . "header.php"; ?>
<h3 id="judul"><?=$_TITLE?></h3>
<div style="text-align:left;width:100%;">
	<a href="javascript:void(0)" title="" onclick="show_hide_form();"><img src="<?=IMAGES_URL?>search.png" alt="Search Pasien" border="0" name="gbr_cari" id="gbr_cari" /></a> PENCARIAN PASIEN
</div>
<div id="form_tambah">
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="tambah_pasien" id="tambah_pasien" onsubmit="return false;">
<input type="hidden" name="id_pasien" id="id_pasien" value="" />
<fieldset>
<legend>Data pasien</legend>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
	<tr>
		<td style="width:50%;">

			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">No. RM</td><td><input type="text" name="id" id="id" maxlength="8" size="11" value="" class="inputan" onkeyup="numeralsOnly(this, event);" onkeypress="focusNext( 'nama', event, 'simpan', this); get_pasien_from_no_rm(this.value, event, this); " />&nbsp;<em>Kosongkan untuk nomor selanjutnya</em></td>
				</tr>
				<tr>
					<td>Nama*</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'usia_tahun', event, 'id', this)" size="50" /></td>
				</tr>
                <tr>
					<td>NO KTP/SIM<font color="red">*</font></td><td><input type="text" name="no_ktp_sim" id="no_ktp_sim" value="" class="inputan" onkeypress="focusNext( 'usia_tahun', event, 'id', this)" size="50" /></td>
				</tr>
				<tr>
					<td>Usia</td><td><input type="text" name="usia_tahun" id="usia_tahun" value="" size="5" class="inputan" onkeypress="focusNext( 'usia_bulan', event, 'nama', this);xajax_get_tgl_lahir(xajax.getFormValues('tambah_pasien'))" onkeyup="numeralsOnly(this, event);" />
					Thn
					&nbsp;&nbsp;
					<input type="text" name="usia_bulan" id="usia_bulan" value="" size="5" class="inputan" onkeypress="focusNext( 'usia_hari', event, 'usia_tahun', this);xajax_get_tgl_lahir(xajax.getFormValues('tambah_pasien'))" onkeyup="numeralsOnly(this, event);" />
					Bln
					&nbsp;&nbsp;
					<input type="text" name="usia_hari" id="usia_hari" value="" size="5" class="inputan" onkeypress="focusNext( 'tempat_lahir', event, 'usia_bulan', this);xajax_get_tgl_lahir(xajax.getFormValues('tambah_pasien'))" onkeyup="numeralsOnly(this, event);" />
					Hr
					</td>
				</tr>
				<tr>
					<td>Tempat/ Tgl Lahir</td>
					<td>
							<?
							$tgl_skr = date("d");
							$bln_skr = date("m");
							$thn_skr = date("Y");
							$thn_start = $thn_skr-70;
							?>
						<input type="text" name="tempat_lahir" id="tempat_lahir" value="" class="inputan" onkeypress="focusNext( 'tgl_lahir_tgl', event, 'usia_hari', this)" onkeyup="hurufBesar(this)" size="10" />
						<select name="tgl_lahir_tgl" id="tgl_lahir_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_lahir_bln', event, 'tempat_lahir', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_bln" id="tgl_lahir_bln" style="width: 75px;" onkeypress="focusNext( 'tgl_lahir_thn', event, 'tgl_lahir_tgl', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									if($bln==$bln_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_thn" id="tgl_lahir_thn" style="width: 60px;" onkeypress="focusNext( 'gol_darah', event, 'tgl_lahir_bln', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									if($i==$thn_skr) $sel = "selected";
									else $sel = "";
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Golongan Darah</td>
					<td>
						<select name="gol_darah_id" id="gol_darah_id" style="width: 100px;" onkeypress="focusNext( 'sex', event, 'tgl_lahir_thn', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="A">A</option>
						<option value="B">B</option>
						<option value="AB">AB</option>
						<option value="O">O</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jenis Kelamin*</td>
					<td>
						<select name="sex" id="sex" style="width: 100px;" onkeypress="focusNext( 'agama', event, 'gol_darah', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="LAKI-LAKI">LAKI-LAKI</option>
						<option value="PEREMPUAN">PEREMPUAN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Agama*</td>
					<td>
						<select name="agama" id="agama" style="width: 136px;" onkeypress="focusNext( 'pendidikan_id', event, 'sex', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="ISLAM">ISLAM</option>
						<option value="KATOLIK">KATOLIK</option>
						<option value="PROTESTAN">PROTESTAN</option>
						<option value="HINDU">HINDU</option>
						<option value="BUDHA">BUDHA</option>
						<option value="KONG HU CHU">KONG HU CHU</option>
						<option value="ALIRAN KEPERCAYAAN">ALIRAN KEPERCAYAAN</option>
						<option value="LAIN-LAIN">LAIN-LAIN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Pendidikan*</td>
					<td>
						<select name="pendidikan_id" id="pendidikan_id" style="width: 200px;" onkeypress="focusNext( 'pekerjaan_id', event, 'agama', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<? for($i=0;$i<sizeof($data_pendidikan);$i++) :?>
								<option value="<?=$data_pendidikan[$i]['id']?>" <? if($data_pendidikan[$i]['selected'] == "1") echo "selected"?> ><?=$data_pendidikan[$i]['nama']?></option>
						<? endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Pekerjaan*</td>
					<td>
						<select name="pekerjaan_id" id="pekerjaan_id" style="width: 200px;" onkeypress="focusNext( 'status_nikah', event, 'pendidikan_id', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<? for($i=0;$i<sizeof($data_pekerjaan);$i++) :?>
								<option value="<?=$data_pekerjaan[$i]['id']?>" <? if($data_pekerjaan[$i]['selected'] == "1") echo "selected"?> ><?=$data_pekerjaan[$i]['nama']?></option>
						<? endfor; ?>
						</select>
						
					</td>
				</tr>

				<tr>
					<td>Status Pernikahan*</td>
					<td>
						<select name="status_nikah" id="status_nikah" style="width: 200px;" onchange="kawin(this)" onkeypress="focusNext( 'alamat', event, 'pekerjaan_id', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="BELUM KAWIN">BELUM KAWIN</option>
						<option value="DUDA">DUDA</option>
						<option value="JANDA">JANDA</option>
						<option value="KAWIN">KAWIN</option>
						</select>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
                <tr>
					<td style="width:150px">Nama Ayah<font color="red">*</font></td><td><input type="text" name="nama_ayah" id="nama_ayah" value="-" class="inputan" size="50" onkeypress="focusNext( 'nama_ibu', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Ibu<font color="red">*</font></td><td><input type="text" name="nama_ibu" id="nama_ibu" value="-" class="inputan" size="50" onkeypress="focusNext( 'nama_suami', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Suami<font color="red">*</font></td><td><input type="text" name="nama_suami" id="nama_suami" value="-" class="inputan" size="50" onkeypress="focusNext( 'nama_istri', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Istri<font color="red">*</font></td><td><input type="text" name="nama_istri" id="nama_istri" value="-" class="inputan" size="50" onkeypress="focusNext( 'alamat', event, 'id', this)" onkeyup="hurufBesar(this);" />
					</td>
				</tr>

				<tr>
					<td style="width:150px">Alamat*</td><td><input type="text" name="alamat" id="alamat" value="" class="inputan" size="50" onkeypress="focusNext( 'rt', event, 'status_nikah', this)" onkeyup="hurufBesar(this); kopiPaste(this, 'pj_alamat')" />
					</td>
				</tr>
				<tr>
					<td></td><td>
					RT <input type="text" name="rt" id="rt" value="" class="inputan" size="5" onkeypress="focusNext( 'rw', event, 'alamat', this)" />&nbsp;RW <input type="text" name="rw" id="rw" value="" class="inputan" size="5" onkeypress="focusNext( 'propinsi_id', event, 'rt', this)" />
					</td>
				</tr>
				<tr>
					<td>Propinsi*</td>
					<td>
						<select name="propinsi_id" id="propinsi_id" style="width: 200px;" onkeypress="focusNext( 'kabupaten_id', event, 'rw', this)" class="inputan" onchange="xajax_ref_get_kabupaten('kabupaten_id', this.value, null, true);">
						<option value="">--- PILIH ---</option>
						<? for($i=0;$i<sizeof($data_propinsi);$i++) :?>
								<option value="<?=$data_propinsi[$i]['id']?>" ><?=$data_propinsi[$i]['nama']?></option>
						<? endfor; ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kabupaten*</td>
					<td>
						<select name="kabupaten_id" id="kabupaten_id" style="width: 200px;" onkeypress="focusNext( 'kecamatan_id', event, 'propinsi_id', this)" class="inputan" onchange="xajax_ref_get_kecamatan('kecamatan_id', this.value, null, true); add_kabupaten_combo(this.value);">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kecamatan*</td>
					<td>
						<select name="kecamatan_id" id="kecamatan_id" style="width: 200px;" onkeypress="focusNext( 'desa_id', event, 'kabupaten_id', this)" class="inputan" onchange="xajax_ref_get_desa('desa_id', this.value, null, true); add_kecamatan_combo(this.value);">
							<option value="">--- PILIH ---</option>
						</select>

					</td>
				</tr>
				<tr>
					<td>Kelurahan*</td>
					<td>
						<select name="desa_id" id="desa_id" style="width: 200px;" onkeypress="add_desa_combo(this.value);focusNext( 'telp', event, 'kecamatan_id', this)" class="inputan" onchange="add_desa_combo(this.value);">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Telepon</td><td><input type="text" name="telp" id="telp" value="" class="inputan" onkeypress="focusNext( 'cara_masuk', event, 'desa_id', this)" />
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend>Data Kunjungan</legend>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
	<tr>
		<td style="width:50%;">
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Cara Masuk*</td><td>
						<select name="cara_masuk" id="cara_masuk" style="width: 200px;" onkeypress="focusNext('perujuk_id', event, 'telp', this)" class="inputan" onchange="xajax_ref_get_perujuk('perujuk_id', this.value, '', true)">
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
						<select name="perujuk_id" id="perujuk_id" style="width: 200px;" onkeypress="focusNext( 'cara_bayar', event, 'cara_masuk', this)" class="inputan" onchange="add_perujuk_combo(this.value)">
						<option value="">--- PILIH ---</option>
						<? for($i=0;$i<sizeof($data_perujuk);$i++) :?>
								<option value="<?=$data_perujuk[$i]['id']?>"><?=$data_perujuk[$i]['nama']?></option>
						<? endfor; ?>
						</select>
					</td>
				</tr>
			</table>
		</td><!-- 'UMUM','ASKES','JAMSOSTEK','DANA REKSA DESA','KONTRAK','LAIN-LAIN' -->
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Cara Bayar*</td><td>
						<select name="cara_bayar" id="cara_bayar" style="width: 200px;" onkeypress="focusNext( 'jenis_askes', event, 'perujuk_id', this)" class="inputan" onchange="showNomor(this.value);xajax_ref_get_jenis_askes('jenis_askes', this.value);xajax_ref_get_perusahaan('perusahaan_id', this.value);">
						<option value="">--- PILIH ---</option>
						<option value="UMUM">UMUM</option>
						<option value="ASURANSI">ASURANSI</option>
						<option value="KARYAWAN">KARYAWAN</option>
						<option value="PERUSAHAAN">PERUSAHAAN</option>
						<option value="LAIN-LAIN">LAIN-LAIN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jenis Asuransi</td><td>
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
		</td>
	</tr>
</table>
</fieldset>

<fieldset>
<legend>Data Penanggung Jawab</legend>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
	<tr>
		<td style="width:50%;">
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Nama</td><td><input type="text" name="pj_nama" id="pj_nama" value="" class="inputan" onkeypress="focusNext( 'pj_alamat', event, 'nomor', this)" size="50" />
					</td>
				</tr>
				<tr>
					<td>Alamat</td><td><input type="text" name="pj_alamat" id="pj_alamat" value="" size="50" class="inputan" onkeypress="focusNext('pj_telp', event, 'pj_nama', this)" />
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Telepon</td><td><input type="text" name="pj_telp" id="pj_telp" value="" class="inputan" onkeypress="focusNext('pj_hubungan_keluarga', event, 'pj_alamat', this)" />
					</td>
				</tr>
				<tr>
					<td>Hubungan Keluarga</td>
					<td>
						<select name="pj_hubungan_keluarga" id="pj_hubungan_keluarga" style="width: 200px;" onkeypress="focusNext( 'bayar_karcis', event, 'pj_telp', this)" class="inputan">
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
		</td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend>Petugas</legend>
<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
	<tr>
		<td style="width:50%;">	
            <table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Nama Petugas</td><td><input type="text" name="nama_petugas" id="nama_petugas" value="" class="inputan" onkeypress="focusNext( 'nama_petugas', event, 'id', this)" size="50" onkeyup="hurufBesar(this)"  />
					</td>
				</tr>
		    </table></td>
    </tr>
</table>
</fieldset>        
<div style="text-align:center;">
<label for="bayar_karcis"><input type="checkbox" name="bayar_karcis" id="bayar_karcis" value="1" class="inputan" onkeypress="focusNext('simpan', event, 'pj_hubungan_keluarga', this)'" checked="checked"/>Bayar Biaya Pendaftaran dan Poli</label><br /><br />
<input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_pasien_check(xajax.getFormValues('tambah_pasien'));" onkeypress="focusNext( 'id', event, 'bayar_karcis', this)" />&nbsp;&nbsp;
<input type="reset" name="baru" id="baru" value="Tambah Baru" class="inputan" onclick="xajax_reset_pasien(); fokus('id');" onkeypress="focusNext( 'id', event, 'simpan', this)" />&nbsp;&nbsp;<input type="button" name="cetak" id="cetak" value="Cetak Form" class="inputan" onclick="xajax_cetak_form();"/></div>
</form>
<div class="info"><B>Petunjuk :</B>
Untuk mendaftar pasien lama, tuliskan nomor rekam medis, lalu tekan Enter atau Tab
Untuk mendaftar pasien baru :
	- kosongkan nomor rekam medis untuk menggunakan nomor selanjutnya, atau
	- isikan nomor rekam medis yang dikehendaki

Klik tombol <img src="<?=IMAGES_URL?>search.png" alt="cari" /> untuk melakukan pencarian pasien lama
</div>
</div>
<? include_once "html.sub.pencarian.php"; ?>

<? include KOMPONEN_DIR . "footer.php"; ?>
