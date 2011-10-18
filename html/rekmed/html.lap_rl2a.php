<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE;?></h3>
<div id="div_kunjungan">
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="lap_rl2a" id="lap_rl2a" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px;">Tahun</td>
		<td>
				<?
				$thn_start = 2006;
				$thn_skr = date("Y");
				?>
			<select name="tahun" id="tahun" style="width: 70px;" onkeypress="focusNext( 'tw', event, 'cari', this)" class="inputan">
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
		<td>Triwulan</td>
		<td>
			<select name="tw" id="tw" style="width: 50px;" onkeypress="focusNext( 'cari', event, 'tahun', this)" class="inputan">
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="IV">IV</option>
			</select>
		</td>
	</tr>	
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="cari" id="cari" value="Tampilkan" class="inputan" onclick="xajax_get_lap_rl2a(xajax.getFormValues('lap_rl2a'));" onkeypress="focusNext( 'tahun', event, 'tw', this)" /></td>
	</tr>
</table>
</form>
</div>

<br />
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>rekmed/lap_rl2a_cetak/',800,768);" class="printer_button" />
</div>
<h2 id="title"></h2>
<div id="list_data"></div>
<div class="info" id="info">Petunjuk :
Silakan pilih tahun dan triwulan
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>