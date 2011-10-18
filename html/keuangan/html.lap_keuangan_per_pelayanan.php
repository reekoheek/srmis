<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn = 1971;
				?>

	<tr>
		<td style="width:150px">Jangka waktu</td>
		<td>

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
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data(xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'tgl_start', event, 'thn_end', this)" /></td>
	</tr>
</table>
</form>
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>keuangan/lap_keuangan_per_pelayanan_cetak/', 1000);" class="printer_button" />
</div>
<br /><h2 id="title"></h2>
<div id="list_data"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Pilih jangka waktu, lalu tekan tombol tampilkan
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>