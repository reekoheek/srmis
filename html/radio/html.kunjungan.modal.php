<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kunjungan();" /></div>
<div class="modal_title_bar">Input Pemeriksaan Radiologi</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_radio" id="input_id_kunjungan_radio" />
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_kelas" id="input_kelas" />
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
					<td>Pengirim</td>
					<td><div id="input_pengirim"></div></td>
				</tr>
				<tr>
					<td>Cara Bayar</td>
					<td><div id="input_cara_bayar"></div></td>
				</tr>
				<tr>
					<td>Kelas</td>
					<td><div id="display_kelas"></div></td>
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
					<td>Tgl Daftar</td>
					<td><div id="input_tgl_daftar"></div></td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td><div id="input_tgl_periksa"></div></td>
				</tr>
			</table>
			</fieldset>
		</td>
		<td>
			<fieldset class="fieldset_modal">
			<legend>Pemeriksaan</legend>
				<input type="hidden" name="jml_pemeriksaan" id="jml_pemeriksaan" value="1" />
				<a href="javascript:void(0)" title="Add Karcis" onclick="xajax_cari_pemeriksaan('0',xajax.getFormValues('cari_pemeriksaan'));buka_pemeriksaan(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Pemeriksaan</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th style="width:200px;">Jasa</th>
							<th>Hak</th>
						<!--	<th>BHP</th>
							<th>Jasa</th>
							<th style="width:70px;">Jml</th>-->
							<th style="width:100px;">Bayar</th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_pemeriksaan"></tbody>
				</table>
			</fieldset>
		<!--	<fieldset class="fieldset_modal">
			<legend>BHP (OBAT)</legend>
				<a href="javascript:void(0)" title="Add BHP" onclick="xajax_cari_bhp('0',xajax.getFormValues('cari_bhp'));buka_bhp(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah BHP</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th style="width:200px;">BHP</th>
							<th>Hak</th>
							<th>Biaya</th>
							<th>Sifat</th>
							<th style="width:70px;">Jml</th>
							<th style="width:100px;">Bayar</th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_bhp"></tbody>
				</table>
			</fieldset>-->
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="input_simpan" id="input_simpan" value="Simpan" class="inputan" onclick="simpan_kunjungan(xajax.getFormValues('input_kunjungan'));" onkeypress="focusNext('input_dokter_id', event, 'mampu', this)" />&nbsp;&nbsp;
		<input type="button" name="input_cancel" id="input_cancel" value="Tutup" class="inputan" onclick="tutup_kunjungan();" /> </td>
	</tr>
</table>
</form>
</div>


<div id="form_cari_pemeriksaan" class="window_modal" style="display:none;left:30px;width:340px;z-index:4">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_pemeriksaan();" class="close_button" />
	<h3>Daftar Pemeriksaan</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_pemeriksaan" id="cari_pemeriksaan" onsubmit="return false;">
	<input type="hidden" name="kelas" id="kelas" value="" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:100px;">Pemeriksaan</td>
			<td>
				<input type="text" name="pemeriksaan" id="pemeriksaan" class="inputan" onkeypress="xcari_pemeriksaan(event)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_pemeriksaan_cari" id="cari_pemeriksaan_cari" value="Cari" class="inputan" onclick="xajax_cari_pemeriksaan('0',xajax.getFormValues('cari_pemeriksaan'));" onkeypress="focusNext('pemeriksaan', event, 'pemeriksaan', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="pemeriksaan_navi" class="navi"></div>
	<div id="list_pemeriksaan"></div>
</div>

<div id="form_cari_bhp" class="window_modal" style="display:none;left:30px;width:340px;z-index:6">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_bhp();" class="close_button" />
	<h3>Daftar BHP</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_bhp" id="cari_bhp" onsubmit="return false;">
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:100px;">BHP</td>
			<td>
				<input type="text" name="bhp" id="bhp" class="inputan" onkeypress="xcari_bhp(event)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_bhp_cari" id="cari_bhp_cari" value="Cari" class="inputan" onclick="xajax_cari_bhp('0',xajax.getFormValues('cari_bhp'));" onkeypress="focusNext('bhp', event, 'bhp', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="bhp_navi" class="navi"></div>
	<div id="list_bhp"></div>
</div>