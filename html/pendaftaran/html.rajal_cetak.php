<? include_once KOMPONEN_DIR . "header_cetak.php"; ?>

<h3 id="judul">Pendaftaran Pasien Rawat Jalan</h3>
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
					<td style="width:150px">No. RM</td><td><input type="text" name="id" id="id" maxlength="8" size="11" value="" class="inputan" /></td>
				</tr>
				<tr>
					<td>Nama<font color="red">*</font></td><td><input type="text" name="nama" id="nama" value="" class="inputan" size="50" /></td>
				</tr>
                <tr>
					<td>NO KTP/SIM<font color="red">*</font></td><td><input type="text" name="no_ktp_sim" id="no_ktp_sim" value="" class="inputan" size="50" /></td>
				</tr>
				<tr>
					<td>Usia</td><td><input type="text" name="usia_tahun" id="usia_tahun" value="" size="5" class="inputan"  />
					Thn
					&nbsp;&nbsp;
					<input type="text" name="usia_bulan" id="usia_bulan" value="" size="5" class="inputan"  />
					Bln
					&nbsp;&nbsp;
					<input type="text" name="usia_hari" id="usia_hari" value="" size="5" class="inputan"  />
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
						<input type="text" name="tempat_lahir" id="tempat_lahir" value="" class="inputan"  size="10" />
						<input type="text" name="tgl_lahir_tgl" id="tgl_lahir_tgl" style="width: 50px;" class="inputan"/>							
						<input type="text" name="tgl_lahir_bln" id="tgl_lahir_bln" style="width: 75px;" class="inputan"/>
						<input type="text" name="tgl_lahir_thn" id="tgl_lahir_thn" style="width: 60px;" class="inputan"/>
					</td>
				</tr>
				<tr>
					<td>Golongan Darah</td>
					<td>
						<input type="text" name="gol_darah_id" id="gol_darah_id" style="width: 100px;" class="inputan"/>
				</tr>
				<tr>
					<td>Jenis Kelamin<font color="red">*</font></td>
					<td>
						<input type="radio" name="sex" id="sex" value= "Laki-Laki" class="inputan"/> Laki-Laki
						<input type="radio" name="sex" id="sex" value= "Perempuan" class="inputan"/> Perempuan
				 	</td>
				</tr>
				<tr>
					<td>Agama<font color="red">*</font></td>
					<td>
						<input type="radio" name="agama" id="agama" value="ISLAM" class="inputan"/>ISLAM
						<input type="radio" name="agama" id="agama" value="KATOLIK" class="inputan"/>KATOLIK
                        <input type="radio" name="agama" id="agama" value="PROTESTAN" class="inputan"/>PROTESTAN<br />
                        <input type="radio" name="agama" id="agama" value="HINDU" class="inputan"/>HINDU
						<input type="radio" name="agama" id="agama" value="BUDHA" class="inputan"/>BUDHA						
					</td>
				</tr>
				<tr>
					<td>Pendidikan<font color="red">*</font></td>
					<td>
					   <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SD
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SMP
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SMA
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SMK <br />
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SARJANA MUDA
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>SARJANA
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>PASCA SARJANA<br />
                       <input type="radio" name="pendidikan" id="pendidikan" value="SD" class="inputan"/>LAIN-LAIN	
					</td>
				</tr>
				<tr>
					<td>Pekerjaan<font color="red">*</font></td>
					<td>
						<input type="radio" value="" class="inputan"/>TIDAK BEKERJA
                        <input type="radio" value="" class="inputan"/>PEGAWAI SWASTA
                        <input type="radio" value="" class="inputan"/>PROFESIONAL
                        <input type="radio" value="" class="inputan"/>PNS
                        <input type="radio" value="" class="inputan"/>WIRASWASTA
                        <input type="radio" value="" class="inputan"/>LAIN-LAIN
					</td>
				</tr>

				<tr>
					<td>Status Pernikahan<font color="red">*</font></td>
					<td>
					    <input type="radio" value="" class="inputan"/>BELUM KAWIN
                        <input type="radio" value="" class="inputan"/>DUDA
                        <input type="radio" value="" class="inputan"/>JANDA
                        <input type="radio" value="" class="inputan"/>KAWIN					
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
                <tr>
					<td style="width:150px">Nama Ayah<font color="red">*</font></td><td><input type="text" name="nama_ayah" id="nama_ayah" value="" class="inputan" size="50" onkeypress="focusNext( 'nama_ibu', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Ibu<font color="red">*</font></td><td><input type="text" name="nama_ibu" id="nama_ibu" value="" class="inputan" size="50" onkeypress="focusNext( 'nama_suami', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Suami<font color="red">*</font></td><td><input type="text" name="nama_suami" id="nama_suami" value="" class="inputan" size="50" onkeypress="focusNext( 'nama_istri', event, 'id', this)" onkeyup="hurufBesar(this)" />
					</td>
				</tr>
                <tr>
					<td style="width:150px">Nama Istri<font color="red">*</font></td><td><input type="text" name="nama_istri" id="nama_istri" value="" class="inputan" size="50" onkeypress="focusNext( 'alamat', event, 'id', this)" onkeyup="hurufBesar(this);" />
					</td>
				</tr>
				<tr>
					<td style="width:150px">Alamat<font color="red">*</font></td><td><input type="text" name="alamat" id="alamat" value="" class="inputan" size="50" onkeypress="focusNext( 'rt', event, 'status_nikah', this)" onkeyup="hurufBesar(this); kopiPaste(this, 'pj_alamat')" />
					</td>
				</tr>
				<tr>
					<td></td><td>
					RT <input type="text" name="rt" id="rt" value="" class="inputan" size="5" onkeypress="focusNext( 'rw', event, 'alamat', this)" />&nbsp;RW <input type="text" name="rw" id="rw" value="" class="inputan" size="5" onkeypress="focusNext( 'propinsi_id', event, 'rt', this)" />
					</td>
				</tr>
				<tr>
					<td>Propinsi<font color="red">*</font></td>
					<td>
						<input type="text" name="propinsi_id" id="propinsi_id" />						
					</td>
				</tr>
				<tr>
					<td>Kabupaten<font color="red">*</font></td>
					<td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
				<tr>
					<td>Kecamatan<font color="red">*</font></td>
					<td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
				<tr>
					<td>Kelurahan<font color="red">*</font></td>
					<td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
				<tr>
					<td>Telepon</td><td><input type="text" name="telp" id="telp" value="" class="inputan" onkeypress="focusNext( 'tgl_periksa_tgl', event, 'desa_id', this)" />
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
					<td>Poliklinik<font color="red">*</font></td><td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
				<tr>
					<td>Dokter<font color="red">*</font></td><td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
				<tr>
					<td>Cara Masuk<font color="red">*</font></td><td>
                        <input type="radio" value="" class="inputan"/>DATANG SENDIRI
                        <input type="radio" value="" class="inputan"/>KASUS POLISI <br />
                        <input type="radio" value="" class="inputan"/>RUJUKAN
                        <input type="radio" value="" class="inputan"/>LAIN-LAIN						
						</select>
					</td>
				</tr>
				<tr>
					<td>Perujuk</td><td>
						<input type="text" name="propinsi_id" id="propinsi_id" />
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td style="width:150px">Cara Bayar*</td><td>
                        <input type="radio" value="" class="inputan"/>DEBIT
                        <input type="radio" value="" class="inputan"/>UMUM
                        <input type="radio" value="" class="inputan"/>UMUM
                        <input type="radio" value="" class="inputan"/>ASKES <br />
                        <input type="radio" value="" class="inputan"/>JAMSOSTEK
                        <input type="radio" value="" class="inputan"/>DANA REKSA DESA <br/>
                        <input type="radio" value="" class="inputan"/>LAIN LAIN
						
						</select>
					</td>
				</tr>
				<tr>
					<td>Jenis Askes</td><td>
						<input type="text" name="nomor" id="nomor" value="" class="inputan" onkeypress="focusNext( 'pj_nama', event, 'perusahaan_id', this)" />
					</td>
				</tr>
				<tr>
					<td>Perusahaan</td><td>
						<input type="text" name="nomor" id="nomor" value="" class="inputan" onkeypress="focusNext( 'pj_nama', event, 'perusahaan_id', this)" />
					</td>
				</tr>
				<tr>
					<td>Nomor</td>
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
						<input type="text" name="pj_alamat" id="pj_alamat" value="" size="50" class="inputan" onkeypress="focusNext('pj_telp', event, 'pj_nama', this)" />
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
					<td style="width:150px">Nama Petugas</td><td><input type="text" name="nama_petugas" id="nama_petugas" value="" class="inputan" onkeypress="focusNext( 'nama_petugas', event, 'id', this)" size="30" />
					</td>
				</tr>
		    </table></td>
    </tr>
</table>        
