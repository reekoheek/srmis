<? include KOMPONEN_DIR . "header.php"; ?>
<h3>Statistik Penyakit</h3>
<div id="div_sepuluh_besar">
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="sepuluh_besar" id="sepuluh_besar" onsubmit="return false;">
<table cellpadding="0" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td style="width:50%">

<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px;">Jenis Pelayanan</td><td>
			<select id="jenis" name="jenis" class="inputan" onkeypress="focusNext( 'pelayanan_id', event, 'cari', this)" style="width:200px" onchange="xajax_ref_get_pelayanan('pelayanan_id', this.value)">
				<option value="">-- Semua --</option>
				<option value="IGD">IGD</option>
				<option value="RAWAT JALAN">RAWAT JALAN</option>
				<option value="RAWAT INAP">RAWAT INAP</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Pelayanan</td><td>
			<select id="pelayanan_id" name="pelayanan_id" class="inputan" onkeypress="focusNext( 'jangka_waktu', event, 'jenis', this)" style="width:200px">
					<option value="">-- Semua --</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Jangka Waktu</td>
		<td>
			<select name="jangka_waktu" id="jangka_waktu" style="width: 90px;" class="inputan" onkeypress="focusNext( 'tgl_periksa_tgl_start', event, 'pelayanan_id', this)" onchange="setDisable(this);">
			<option value="hari">Hari</option>
			<option value="bulan">Bulan</option>
			<option value="tahun">Tahun</option>
			</select> 
		</td>
	</tr>
	<tr>
		<td style="width: 150px;">Dari</td>
		<td>
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_start = 1971;
				?>

			<select name="tgl_periksa_tgl_start" id="tgl_periksa_tgl_start" style="width: 50px;" onkeypress="focusNext( 'tgl_periksa_bln_start', event, 'jangka_waktu', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="tgl_periksa_bln_start" id="tgl_periksa_bln_start" style="width: 100px;" onkeypress="focusNext( 'tgl_periksa_thn_start', event, 'tgl_periksa_tgl_start', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="tgl_periksa_thn_start" id="tgl_periksa_thn_start" style="width: 70px;" onkeypress="focusNext( 'tgl_periksa_tgl_end', event, 'tgl_periksa_bln_start', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_skr;$i++) {
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Sampai</td>
		<td>
			<select name="tgl_periksa_tgl_end" id="tgl_periksa_tgl_end" style="width: 50px;" onkeypress="focusNext( 'tgl_periksa_bln_end', event, 'tgl_periksa_thn_start', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="tgl_periksa_bln_end" id="tgl_periksa_bln_end" style="width: 100px;" onkeypress="focusNext( 'tgl_periksa_thn_end', event, 'tgl_periksa_tgl_end', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="tgl_periksa_thn_end" id="tgl_periksa_thn_end" style="width: 70px;" onkeypress="focusNext( 'tampilkan', event, 'tgl_periksa_bln_end', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_skr;$i++) {
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tampilkan</td>
		<td>
			<select name="tampilkan" id="tampilkan" style="width: 90px;" class="inputan" onkeypress="focusNext( 'propinsi_id', event, 'tgl_periksa_thn_end', this)">
			<option value="Semua">Semua</option>
			<? for($i=1;$i<101;$i++) : ?>
				<? if($i==10) $sel="selected"; else $sel=""; ?>
				<option value="<?=$i?>" <?=$sel?>><?=$i?></option>
			<? endfor; ?>
			</select> penyakit
		</td>
	</tr>
</table>
		</td>
		<td>
			<table cellpadding="0" cellspacing="4" border="0" class="form">
				<tr>
					<td>Propinsi</td>
					<td>
						<select name="propinsi_id" id="propinsi_id" style="width: 200px;" onkeypress="focusNext( 'kabupaten_id', event, 'jenis_grafik', this)" class="inputan" onchange="xajax_ref_get_kabupaten('kabupaten_id', this.value)">
						<option value="">--- Semua Propinsi ---</option>
						<? for($i=0;$i<sizeof($data_propinsi);$i++) {?>
								<option value="<?=$data_propinsi[$i]['id']?>" ><?=$data_propinsi[$i]['nama']?></option>
						<? } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kabupaten</td>
					<td>
						<select name="kabupaten_id" id="kabupaten_id" style="width: 200px;" onkeypress="focusNext( 'kecamatan_id', event, 'propinsi_id', this)" class="inputan" onchange="xajax_ref_get_kecamatan('kecamatan_id', this.value);">
							<option value="">--- Semua Kabupaten ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kecamatan</td>
					<td>
						<select name="kecamatan_id" id="kecamatan_id" style="width: 200px;" onkeypress="focusNext( 'desa_id', event, 'kabupaten_id', this)" class="inputan" onchange="xajax_ref_get_desa('desa_id', this.value);">
							<option value="">--- Semua Kecamatan ---</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kelurahan</td>
					<td>
						<select name="desa_id" id="desa_id" style="width: 200px;" onkeypress="focusNext( 'cari', event, 'kecamatan_id', this)" class="inputan">
							<option value="">--- Semua Kelurahan ---</option>
						</select>
					</td>
				</tr>
			</table>
		</td>

	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="cari" id="cari" value="Tampilkan" class="inputan" onclick="xajax_get_penyakit_check(xajax.getFormValues('sepuluh_besar'));" onkeypress="focusNext( 'jenis', event, 'desa_id', this)" /></td>
	</tr>
</table>
</form>
</div>

<br />
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>rekmed/statistik_penyakit_cetak/');" class="printer_button" /></div>
<h2 id="title"></h2>
<div id="graph" style="text-align:center;height:300px;"></div>
<br />
<div id="list_data"></div>
<div id="list_pasien" class="window_modal" style="display:none;top:20px;width:600px;z-index:1;"></div>
<div class="info" id="info">Petunjuk :
Klik salah satu penyakit untuk mendapatkan list pasien penderita.
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>