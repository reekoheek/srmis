<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<?
	$tgl_skr = date("d");
	$bln_skr = date("m");
	$thn_skr = date("Y");
	$thn_start = $thn_skr-70;
?>
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width:50%;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width:150px">Cara Bayar</td><td>
			<select name="cara_bayar" id="cara_bayar" style="width: 200px;" onkeypress="focusNext( 'tgl_mulai_tgl', event, 'tampil', this)" class="inputan">
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
		<td>Masuk Dari</td>
		<td>
			<select name="tgl_mulai_tgl" id="tgl_mulai_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_mulai_bln', event, 'pelayanan_id', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="tgl_mulai_bln" id="tgl_mulai_bln" style="width: 100px;" onkeypress="focusNext( 'tgl_mulai_thn', event, 'tgl_mulai_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="tgl_mulai_thn" id="tgl_mulai_thn" style="width: 70px;" onkeypress="focusNext( 'tgl_selesai_tgl', event, 'tgl_mulai_bln', this)" class="inputan">
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
			<select name="tgl_selesai_tgl" id="tgl_selesai_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_selesai_bln', event, 'tgl_mulai_thn', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="tgl_selesai_bln" id="tgl_selesai_bln" style="width: 100px;" onkeypress="focusNext( 'tgl_selesai_thn', event, 'tgl_selesai_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="tgl_selesai_thn" id="tgl_selesai_thn" style="width: 70px;" onkeypress="focusNext( 'semua', event, 'tgl_selesai_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_skr;$i++) {
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<br />
		</td>
	</tr>
	<tr>
		<td></td><td><label for="semua"><input type="checkbox" name="semua" id="semua" value="1" onkeypress="focusNext( 'tampil', event, 'tgl_selesai_thn', this)" />Tampilkan Semua Pembayaran</label></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'cara_bayar', event, 'tgl_selesai_thn', this)" /></td>
	</tr>
</table>
		</td>
		<td>
		<fieldset>
		<legend>Pencarian Berdasarkan Identitas Pasien</legend>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width:150px;">Nomor Rekam Medis</td>
					<td><input type="text" name="pasien_id" id="pasien_id" size="20" maxlength="8" class="inputan" onkeypress="focusNext( 'nama', event, 'cari', this)" /></td>
				</tr>
				<tr>
					<td style="width:150px;">Nama Pasien</td>
					<td><input type="text" name="nama" id="nama" size="30" class="inputan" onkeypress="focusNext( 'cari', event, 'pasien_id', this)" />&nbsp;<input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'pasien_id', event, 'pasien_id', this)" /></td>
				</tr>
			</table>
		</fieldset>
		</td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<div id="list_daftar_tbi" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:500px;"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Klik pada salah satu baris untuk melakukan pembayaran.
</div>
<div id="modal_list_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:50%;z-index:3;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_list_kunjungan();" /></div>
<div class="modal_title_bar">Daftar Kunjungan Yang Pernah Dilakukan</div>
<div id="tab_list_semua_kunjungan_navi" class="navi"></div>
<div id="tab_list_semua_kunjungan" style="height:auto;max-height:400px;overflow:scroll;border-right:solid 1px #000000;"></div>
</div>
<? //include_once "html.kunjungan.modal.php"; ?>
<? include_once "html.langsung_bayar.modal.php"; ?>
<? include KOMPONEN_DIR . "footer.php"; ?>