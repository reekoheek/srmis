<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kunjungan();" /></div>
<div class="modal_title_bar">Input Pemeriksaan IRD</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_id_kunjungan" id="input_id_kunjungan" />
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
					<td>Cara Bayar</td>
					<td><div id="input_cara_bayar"></div></td>
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
					<td style="width: 120px;">Kunjungan ke-</td>
					<td><div id="input_kunjungan_ke"></div></td>
				</tr>
				<tr>
					<td>Pelayanan</td>
					<td><div id="input_spesialisasi"></div></td>
				</tr>
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
			<legend>Karcis</legend>
				<input type="hidden" name="jml_karcis" id="jml_karcis" value="1" />
				<a href="javascript:void(0)" title="Add Karcis" onclick="xajax_cari_karcis('0',xajax.getFormValues('cari_karcis'));buka_karcis(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Karcis</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th style="width:200px;">Jasa</th>
							<th style="width:150px;">Hak</th>
							<th style="width:70px;">Biaya</th>
							<th style="width:70px;">Jml</th>
							<th style="width:100px;">Bayar</th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_karcis"></tbody>
				</table>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>Tindakan</legend>
				<a href="javascript:void(0)" title="Add Tindakan" onclick="xajax_cari_icopim('0',xajax.getFormValues('cari_icopim'));buka_icopim(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Tindakan</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th></th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_icopim"></tbody>
				</table>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>BHP</legend>
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
			</fieldset>
			<!-- <label for="langsung_bayar"><input type="checkbox" name="langsung_bayar" id="langsung_bayar" value="1" class="inputan" onkeypress="focusNext('input_simpan', event, 'input_tgl_keluar_mnt', this)" onclick="langsung_bayar_mas(this);fokus('get_total')" />Langsung Bayar</label>
			<fieldset class="fieldset_modal" style="display:none;" id="fieldset_pembayaran">
			<legend>Pembayaran</legend>
				<input type="button" name="get_total" id="get_total" value="Hitung Total Pembayaran" class="inputan" onclick="xajax_get_total(xajax.getFormValues('input_kunjungan'));fokus('mampu')" onkeypress="focusNext( 'total', event, 'langsung_bayar', this)" /><br /><br />
				<table cellpadding="2" cellspacing="2" border="0" style="width:100%">
					<tr>
						<td style="width:100px;">Total</td><td style="width:200px;">Rp. <input type="text" readonly="" name="total" id="total" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'sudah', event, 'get_total', this)" /></td><td><span id="total_terbilang" style="font-style:italic;"></span></td>
					</tr>
					<tr>
						<td>Sudah Dibayar</td><td>Rp. <input type="text" readonly="" name="sudah" id="sudah" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'belum', event, 'total', this)" /></td><td><span id="sudah_terbilang" style="font-style:italic;"></span></td>
					</tr>
					<tr>
						<td>Kurang</td><td>Rp. <input type="text" name="belum" id="belum" readonly="" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'mampu', event, 'sudah', this)" /></td><td><span id="belum_terbilang" style="font-style:italic;"></span></td>
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<tr>
						<td>Mampu Bayar</td><td>Rp. <input type="text" name="mampu" id="mampu" class="inputan_angka" size="30" onkeypress="focusNext( 'input_simpan', event, 'belum', this)" onkeyup="writeTerbilang('mampu_terbilang', this.value)" /></td><td><span id="mampu_terbilang" style="font-style:italic;"></span></td>
					</tr>
				</table>
			</fieldset> -->
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

<div id="form_cari_diagnosa" class="window_modal" style="display:none;top:160px;left:160px;width:500px;z-index:3">
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


<div id="form_cari_karcis" class="window_modal" style="display:none;left:30px;width:340px;z-index:4">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_karcis();" class="close_button" />
	<h3>Daftar Karcis</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_karcis" id="cari_karcis" onsubmit="return false;">
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:100px;">Karcis</td>
			<td>
				<input type="text" name="karcis" id="karcis" class="inputan" onkeypress="xcari_karcis(event)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_karcis_cari" id="cari_karcis_cari" value="Cari" class="inputan" onclick="xajax_cari_karcis('0',xajax.getFormValues('cari_karcis'));" onkeypress="focusNext('karcis', event, 'karcis', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="karcis_navi" class="navi"></div>
	<div id="list_karcis"></div>
</div>

<div id="form_cari_icopim" class="window_modal" style="display:none;left:30px;width:340px;z-index:5">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_icopim();" class="close_button" />
	<h3>Daftar Tindakan</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_icopim" id="cari_icopim" onsubmit="return false;">
	<input type="hidden" name="icopim_kelas" id="icopim_kelas" value="" />
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td style="width:100px;">Tindakan</td>
			<td>
				<input type="text" name="icopim" id="icopim" class="inputan" onkeypress="xcari_icopim(event)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_icopim_cari" id="cari_icopim_cari" value="Cari" class="inputan" onclick="xajax_cari_icopim('0',xajax.getFormValues('cari_icopim'));" onkeypress="focusNext('icopim', event, 'icopim', this)" />
			</td>
		</tr>
	</table>
	</form>
	<div id="icopim_navi" class="navi"></div>
	<div id="list_icopim"></div>
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