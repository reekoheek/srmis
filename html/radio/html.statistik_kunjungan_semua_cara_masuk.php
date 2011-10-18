<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE;?></h3>
<div id="div_kunjungan">
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="statistik_kunjungan" id="statistik_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width:150px;">Tampilkan per</td>
		<td>
			<select name="tampilkan" id="tampilkan" style="width: 90px;" class="inputan" onkeypress="focusNext( 'tgl_periksa_tgl_start', event, 'pelayanan_id', this)" onchange="setDisable(this)">
			<option value="hari">Hari</option>
			<option value="bulan">Bulan</option>
			<option value="tahun">Tahun</option>
			</select> 
		</td>
	</tr>
	<tr>
		<td>Dari</td>
		<td>
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_start = 1971;
				?>

			<select name="tgl_periksa_tgl_start" id="tgl_periksa_tgl_start" style="width: 50px;" onkeypress="focusNext( 'tgl_periksa_bln_start', event, 'tampilkan', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) {
						$tgl = tambahNol($i, 2);
						if($tgl==($tgl_skr-3)) $sel = "selected";
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
			<select name="tgl_periksa_thn_end" id="tgl_periksa_thn_end" style="width: 70px;" onkeypress="focusNext( 'cari', event, 'tgl_periksa_bln_end', this)" class="inputan">
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
		<td colspan="2" style="text-align: center;"><input type="button" name="cari" id="cari" value="Tampilkan" class="inputan" onclick="xajax_get_kunjungan_check(xajax.getFormValues('statistik_kunjungan'));" onkeypress="focusNext( 'tampilkan', event, 'tgl_periksa_thn_end', this)" /></td>
	</tr>
</table>
</form>
</div>

<br />
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>radio/statistik_kunjungan_semua_cara_masuk_cetak/', 1000);" class="printer_button" />
</div>
<h2 id="title"></h2>
<div id="graph" style="text-align:center;height:300px;"></div>
<br />
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>