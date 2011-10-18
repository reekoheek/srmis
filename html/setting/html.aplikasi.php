<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_setting" id="form_setting" onsubmit="return false;">
<div style="height:530px;overflow:scroll;background-color:#E5E6E1;">
<fieldset>
<legend>Informasi Aplikasi</legend>
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 200px">Nama Aplikasi</td><td><input type="text" name="app_name" id="app_name" value="" class="inputan" onkeypress="focusNext( 'app_name_pendek', event, 'simpan', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Nama Pendek Aplikasi</td><td><input type="text" name="app_name_pendek" id="app_name_pendek" value="" class="inputan" onkeypress="focusNext( 'app_version', event, 'app_name', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Versi Aplikasi</td><td><input type="text" name="app_version" id="app_version" value="" class="inputan" onkeypress="focusNext( 'owner_nama', event, 'app_name_pendek', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Pemilik</td><td><input type="text" name="owner_nama" id="owner_nama" value="" class="inputan" onkeypress="focusNext( 'rs_nama', event, 'app_version', this)" size="70" /></td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend>Profil Rumah Sakit</legend>
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 200px">Nama</td><td><input type="text" name="rs_nama" id="rs_nama" value="" class="inputan" onkeypress="focusNext( 'rs_kode', event, 'owner_nama', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Kode</td><td><input type="text" name="rs_kode" id="rs_kode" value="" class="inputan" onkeypress="focusNext( 'rs_jenis', event, 'rs_nama', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Jenis</td><td>
			<select name="rs_jenis" id="rs_jenis" onkeypress="focusNext( 'rs_kelas', event, 'rs_kode', this)" style="width:50px;" class="inputan">
				<? for($i=65;$i<85;$i++) :?>
				<option value="<?=chr($i)?>"><?=chr($i)?></option>
				<?endfor;?>
			</select></td>
	</tr>
	<tr>
		<td>Kelas</td><td><input type="text" name="rs_kelas" id="rs_kelas" value="" class="inputan" onkeypress="focusNext( 'rs_alamat', event, 'rs_jenis', this)" size="5" maxlength="1" /></td>
	</tr>
	<tr>
		<td>Alamat</td><td><input type="text" name="rs_alamat" id="rs_alamat" value="" class="inputan" onkeypress="focusNext( 'rs_kabupaten', event, 'rs_kelas', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Kabupaten</td><td><input type="text" name="rs_kabupaten" id="rs_kabupaten" value="" class="inputan" onkeypress="focusNext( 'rs_kode_pos', event, 'rs_alamat', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Kode Pos</td><td><input type="text" name="rs_kode_pos" id="rs_kode_pos" value="" class="inputan" onkeypress="focusNext( 'rs_telp', event, 'rs_kabupaten', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Telp</td><td><input type="text" name="rs_telp" id="rs_telp" value="" class="inputan" onkeypress="focusNext( 'rs_fax', event, 'rs_kode_pos', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Fax</td><td><input type="text" name="rs_fax" id="rs_fax" value="" class="inputan" onkeypress="focusNext( 'rs_email', event, 'rs_telp', this)" size="70" /></td>
	</tr>
	<tr>
		<td>E-mail</td><td><input type="text" name="rs_email" id="rs_email" value="" class="inputan" onkeypress="focusNext( 'rs_agama', event, 'rs_fax', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Agama</td><td>
			<select name="rs_agama" id="rs_agama" onkeypress="focusNext( 'dir_nama', event, 'rs_email', this)" style="width:140px;" class="inputan">
				<option value="Islam">Islam</option>
				<option value="Katholik">Katholik</option>
				<option value="Protestan">Protestan</option>
				<option value="Hindu">Hindu</option>
				<option value="Budha">Budha</option>
				<option value="Organisasi Sosial">Organisasi Sosial</option>
				<option value="Perorangan">Perorangan</option>
				<option value="Perusahaan">Perusahaan</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Nama Direktur</td><td><input type="text" name="dir_nama" id="dir_nama" value="" class="inputan" onkeypress="focusNext( 'si_nomor', event, 'rs_agama', this)" size="70" /></td>
	</tr>
	<tr>
		<td><b>Surat Ijin Penetapan</b></td>
	</tr>
	<tr>
		<td>Nomor</td><td><input type="text" name="si_nomor" id="si_nomor" value="" class="inputan" onkeypress="focusNext( 'si_tanggal', event, 'dir_nama', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Tanggal</td><td><input type="text" name="si_tanggal" id="si_tanggal" value="" class="inputan" onkeypress="focusNext( 'si_oleh', event, 'si_nomor', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Oleh</td><td><input type="text" name="si_oleh" id="si_oleh" value="" class="inputan" onkeypress="focusNext( 'si_sifat', event, 'si_tanggal', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Sifat</td><td>
			<select name="si_sifat" id="si_sifat" onkeypress="focusNext( 'si_berlaku_sampai', event, 'si_oleh', this)" style="width:140px;" class="inputan">
				<option value="Sementara">Sementara</option>
				<option value="Tetap">Tetap</option>
				<option value="Perpanjangan">Perpanjangan</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Berlaku sampai</td><td><input type="text" name="si_berlaku_sampai" id="si_berlaku_sampai" value="" class="inputan" onkeypress="focusNext( 'milik_nama', event, 'si_sifat', this)" size="10" maxlength="4" /></td>
	</tr>
	<tr>
		<td><b>Kepemilikan</b></td>
	</tr>
	<tr>
		<td>Pemilik</td><td><input type="text" name="milik_nama" id="milik_nama" value="" class="inputan" onkeypress="focusNext( 'milik_status', event, 'si_berlaku_sampai', this)" size="70" /></td>
	</tr>
	<tr>
		<td>Status</td><td><input type="text" name="milik_status" id="milik_status" value="" class="inputan" onkeypress="focusNext( 'akr_tahap', event, 'milik_nama', this)" size="5" maxlength="2" /></td>
	</tr>
	<tr>
		<td><b>Akreditasi</b></td>
	</tr>
	<tr>
		<td>Tahap</td><td>
			<select name="akr_tahap" id="akr_tahap" onkeypress="focusNext( 'akr_status', event, 'milik_status', this)" style="width:140px;" class="inputan">
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Status</td><td>
			<select name="akr_status" id="akr_status" onkeypress="focusNext( 'cetak_header', event, 'akr_tahap', this)" style="width:140px;" class="inputan">
				<option value="Penuh">Penuh</option>
				<option value="Bersyarat">Bersyarat</option>
				<option value="Gagal">Gagal</option>
				<option value="Belum">Belum</option>
			</select>
		</td>
	</tr>
</table>
</fieldset>
<fieldset>
<legend>Print-out Laporan</legend>
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 200px">Header</td>
		<td>
			<textarea cols="50" rows="10" name="cetak_header" id="cetak_header" class="inputan" onkeypress="focusNext( 'cetak_tanda_tangan', event, 'akr_status', this)"></textarea>
		</td>
	</tr>
	<tr>
		<td>Tanda tangan</td>
		<td>
			<textarea cols="50" rows="10" name="cetak_tanda_tangan" id="cetak_tanda_tangan" class="inputan" onkeypress="focusNext( 'cetak_footer', event, 'cetak_header', this)"></textarea>
		</td>
	</tr>
	<tr>
		<td>Footer</td><td><input type="text" name="cetak_footer" id="cetak_footer" class="inputan" onkeypress="focusNext( 'simpan', event, 'cetak_tanda_tangan', this)" size="70" /></td>
	</tr>
</table>
</fieldset>
<!-- <fieldset>
<legend>Logo</legend>
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 200px">Logo Kiri</td>
		<td>
			<input type="file" name="logo_kiri" id="logo_kiri" class="inputan" size="50" />
		</td>
	</tr>
	<tr>
		<td>Logo Kanan</td>
		<td>
			<input type="file" name="logo_kanan" id="logo_kanan" class="inputan" size="50" />
		</td>
	</tr>
</table>
</fieldset> -->
</div>
<div style="text-align:center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_setting_check(xajax.getFormValues('form_setting'));" onkeypress="focusNext( 'app_name', event, 'cetak_footer', this)" /></div>
</form>
<? include KOMPONEN_DIR . "footer.php"; ?>