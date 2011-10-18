<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<?
	$tgl_skr = date("d");
	$bln_skr = date("m");
	$thn_skr = date("Y");
	$thn_start = $thn_skr-70;
	?>
	<tr>
		<td style="width: 150px">Masuk Dari</td>
		<td>
			<select name="tgl_mulai_tgl" id="tgl_mulai_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_mulai_bln', event, 'pelayanan_id', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
					$tgl = tambahNol($i, 2);
					if($tgl_skr == $i) $sel = "selected"; else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<select name="tgl_mulai_bln" id="tgl_mulai_bln" style="width: 100px;" onkeypress="focusNext( 'tgl_mulai_thn', event, 'tgl_mulai_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) {
					$bln = tambahNol($i, 2);
					if($bln==$bln_skr) $sel = "selected"; else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? } ?>
			</select>
			<select name="tgl_mulai_thn" id="tgl_mulai_thn" style="width: 70px;" onkeypress="focusNext( 'tgl_selesai_tgl', event, 'tgl_mulai_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_skr;$i++) {
					if($thn_skr == $i) $sel = "selected"; else $sel = "";
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
			<select name="tgl_selesai_thn" id="tgl_selesai_thn" style="width: 70px;" onkeypress="focusNext( 'tampil', event, 'tgl_selesai_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_skr;$i++) {
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? } ?>
			</select>
			<br />
		<br />
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'jenis', event, 'tgl_selesai_thn', this)" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<div class="info">Petunjuk:
Klik salah satu kunjungan untuk merubah data kunjungan
</div>
<? include_once "html.kunjungan.modal.php"; ?>
<? include KOMPONEN_DIR . "footer.php"; ?>