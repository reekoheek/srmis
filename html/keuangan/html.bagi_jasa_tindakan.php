<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width:150px">Cara Bayar</td><td>
			<select name="cara_bayar" id="cara_bayar" style="width: 200px;" onkeypress="focusNext( 'jenis_askes', event, 'tampil', this)" class="inputan" onchange="xajax_ref_get_jenis_askes('jenis_askes', this.value);xajax_ref_get_perusahaan('perusahaan_id', this.value);">
			<option value="">--- SEMUA ---</option>
			<option value="UMUM">UMUM</option>
			<option value="ASKES">ASKES</option>
			<option value="JAMSOSTEK">JAMSOSTEK</option>
			<option value="DANA REKSA DESA">DANA REKSA DESA</option>
			<option value="KONTRAK">KONTRAK</option>
			<option value="LAIN-LAIN">LAIN-LAIN</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Jenis Askes</td><td>
			<select name="jenis_askes" id="jenis_askes" style="width: 200px;" onkeypress="focusNext( 'perusahaan_id', event, 'cara_bayar', this)" class="inputan">
			<option value="">--- PILIH ---</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Perusahaan</td><td>
			<select name="perusahaan_id" id="perusahaan_id" style="width: 200px;" onkeypress="focusNext( 'tempat_pembayaran', event, 'jenis_askes', this)" class="inputan">
			<option value="">--- PILIH ---</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tempat Pembayaran</td><td>
			<select name="tempat_pembayaran" id="tempat_pembayaran" style="width: 200px;" onkeypress="focusNext( 'jangka_waktu', event, 'perusahaan_id', this)" class="inputan">
			<option value="">--- SEMUA ---</option>
			<option value="KASIR">KASIR</option>
			<option value="IRD">IRD</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Jangka Waktu</td>
		<td>
			<select name="jangka_waktu" id="jangka_waktu" style="width: 90px;" class="inputan" onkeypress="focusNext( 'tgl', event, 'pelayanan_id', this)" onchange="setDisable(this);">
			<option value="hari">Hari</option>
			<option value="bulan">Bulan</option>
			<option value="tahun">Tahun</option>
			</select> 
		</td>
	</tr>
	<tr>
		<td>Periode Pembayaran</td>
		<td>
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn = 1971;
				?>

			<select name="tgl_start" id="tgl_start" style="width: 50px;" onkeypress="focusNext( 'bln_start', event, 'jangka_waktu', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==($tgl_skr)) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="bln_start" id="bln_start" style="width: 100px;" onkeypress="focusNext( 'thn_start', event, 'tgl_start', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="thn_start" id="thn_start" style="width: 70px;" onkeypress="focusNext( 'tgl_end', event, 'bln_start', this)" class="inputan">
				<? for($i=$thn;$i<=$thn_skr;$i++) {
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
			<select name="tgl_end" id="tgl_end" style="width: 50px;" onkeypress="focusNext( 'bln_end', event, 'thn_start', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==($tgl_skr)) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="bln_end" id="bln_end" style="width: 100px;" onkeypress="focusNext( 'thn_end', event, 'tgl_end', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="thn_end" id="thn_end" style="width: 70px;" onkeypress="focusNext( 'tampil', event, 'bln_end', this)" class="inputan">
				<? for($i=$thn;$i<=$thn_skr;$i++) {
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data(xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'jangka_waktu', event, 'thn', this)" /></td>
	</tr>
</table>
</form>
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>keuangan/bagi_jasa_cetak/', 1000);" class="printer_button" />
</div>
<br /><h2 id="title"></h2>
<div id="list_data"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Pilih jangka waktu dan tanggal lalu tekan tombol Tampilkan.
Tindakan Tidak Masuk Pada Laporan Ini!
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>