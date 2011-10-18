<div id="modal_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:95%;z-index:2;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kunjungan();" /></div>
<div class="modal_title_bar">Input Pemeriksaan IRD</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="input_kunjungan" id="input_kunjungan" onsubmit="return false;">
<input type="hidden" name="input_id_kunjungan_kamar" id="input_id_kunjungan_kamar" />
<input type="hidden" name="input_id_kunjungan" id="input_id_kunjungan" />
<input type="hidden" name="input_param_no" id="input_param_no" />
<input type="hidden" name="input_pasien_id" id="input_pasien_id" />
<input type="hidden" name="input_no_resep" id="input_no_resep" />
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
				<!-- <tr>
					<td>Perujuk</td>
					<td><div id="input_perujuk"></div></td>
				</tr> -->
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
				<tr>
					<td>Dokter*</td>
					<td>
						<select name="input_dokter_id" id="input_dokter_id" style="width: 200px;" onkeypress="focusNext('input_kelanjutan', event, 'input_simpan', this)" class="inputan">
							<option value="">--- PILIH ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kelanjutan*</td>
					<td colspan="2">
						<select name="input_kelanjutan" id="input_kelanjutan" style="width: 200px;" onkeypress="focusNext('input_keadaan_keluar', event, 'input_dokter_id', this)" class="inputan">
							<option value="">--- PILIH ---</option>
							<option value="DIRAWAT">DIRAWAT</option>
							<option value="DIRUJUK">DIRUJUK</option>
							<option value="PULANG">PULANG</option>
							<!-- <option value="PINDAH KAMAR">PINDAH KAMAR</option> -->
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
						</select>
						<?
							$jam_skr = date("H");
							$mnt_skr = date("i");
							$dtk_skr = date("s");
						?>
						<br /><br />
						<select name="input_tgl_keluar_jam" id="input_tgl_keluar_jam" style="width: 50px;" onkeypress="focusNext( 'input_tgl_keluar_mnt', event, 'input_tgl_keluar_thn', this)" class="inputan">
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
			<fieldset class="fieldset_modal">
			<legend>Diagnosa Utama</legend>
				<div style="margin-left:10px;"><a href="javascript:void(0)" title="Add or Update Diagnosa Utama" onclick="xajax_cari_diagnosa('0',xajax.getFormValues('cari_diagnosa'));buka_diagnosa();"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" /></a>&nbsp;&nbsp;<a href="javascript:void(0)" title="Hapus Diagnosa Utama" onclick="clear_diagnosa()"><img src="<?=IMAGES_URL?>remove.png" alt="" border="0" /></a>&nbsp;&nbsp;&nbsp;<span id="input_diagnosa_utama_nama">&nbsp;</span><input type="hidden" name="input_diagnosa_utama" id="input_diagnosa_utama" /></div>
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
			<legend>Resep (Data Obat)</legend><font color="red"><b>No Resep <div id="no_resep"></div></b></font>
				<a href="javascript:void(0)" title="Add Obat" onclick="xajax_cari_obat('0',xajax.getFormValues('cari_obat'));buka_obat(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Resep</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th style="width:200px;">Obat</th>
							<th>Hak</th>
							<th>Biaya</th>
							<th>Racikan</th>
                            <th>Dosis</th>
                            <th>Ket.</th>
							<th style="width:70px;">Jml</th>
							<th style="width:100px;">Biaya</th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_bhp"></tbody>
				</table>
			</fieldset>
			<fieldset class="fieldset_modal">
			<legend>Sewa Kendaraan</legend>
				<table cellpadding="0" cellspacing="5" border="0" class="form">
					<tr>
						<td style="width:100px;">Harga BBM (Rp)</td><td><input type="text" name="input_harga_bbm" id="input_harga_bbm" value="" class="inputan_angka" size="30" onkeypress="focusNext('input_jarak_tempuh', event, 'input_simpan', this)" /></td>
					</tr>
					<tr>
						<td>Jarak Tempuh (KM)</td><td><input type="text" name="input_jarak_tempuh" id="input_jarak_tempuh" class="inputan_angka" size="30" onkeypress="xcari_kendaraan(this, event);focusNext('input_simpan', event, 'input_harga_bbm', this)" /></td>
					</tr>
				</table><br />
				<a href="javascript:void(0)" title="Add Kendaraan" onclick="xajax_cari_kendaraan();buka_kendaraan(this);" class="btn_add"><img src="<?=IMAGES_URL?>add.gif" alt="" border="0" />&nbsp;&nbsp;Tambah Kendaraan</a>
				<table cellpadding="0" cellspacing="0" border="0" class="tabel_biaya">
					<thead>
						<tr>
							<th></th>
							<th style="width:20px;">&nbsp;</th>
						</tr>
					</thead>
					<tbody id="tbody_input_kendaraan"></tbody>
				</table>
			</fieldset>
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

<div id="form_cari_bhp" class="window_modal" style="display:none;left:30px;width:500px;z-index:3">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_bhp();" class="close_button" />
	<h3>Obat (Resep Obat)</h3>
	<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="cari_bhp" id="cari_bhp" onsubmit="return false;">
	<table cellpadding="0" cellspacing="5" border="0" class="form">
		<tr>
			<td>Obat</td>
			<td>
				<input type="text" name="obat" id="obat" class="inputan" onkeypress="xcari_obat(event)" onkeyup="hurufBesar(this)" size="30" />&nbsp;&nbsp;
				<input type="button" name="cari_obat_cari" id="cari_obat_cari" value="Cari" class="inputan" onclick="xajax_cari_obat('0',xajax.getFormValues('cari_obat'));" onkeypress="focusNext('obat', event, 'obat', this)" />
			</td>
		</tr>        
       
	</table>  
	</form>
	<div id="bhp_navi" class="navi"></div>
	<div id="list_bhp"></div>
</div>

<div id="form_cari_kendaraan" class="window_modal" style="display:none;left:30px;width:340px;z-index:7">
	<img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_kendaraan();" class="close_button" />
	<h3>Daftar Kendaraan</h3>
	<div id="list_kendaraan"></div>
</div>
