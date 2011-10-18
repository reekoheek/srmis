<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE;?></h3>
<div id="div_kunjungan">
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="performance" id="performance" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px;">Tahun</td>
		<td>
				<?
				$thn_start = 2007;
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
			<select name="tw" id="tw" style="width: 80px;" onkeypress="focusNext( 'kelas', event, 'tahun', this)" class="inputan">
				<option value="">1 Tahun</option>
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="IV">IV</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Kelas</td>
		<td>
			<select name="kelas" id="kelas" style="width: 120px;" onkeypress="focusNext( 'cari', event, 'tw', this)" class="inputan">
				<option value="">Semua Kelas</option>
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="VIP">VIP</option>
				<option value="TANPA KELAS">TANPA KELAS</option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="cari" id="cari" value="Tampilkan" class="inputan" onclick="xajax_get_performance(xajax.getFormValues('performance'));" onkeypress="focusNext( 'tahun', event, 'kelas', this)" /></td>
	</tr>
</table>
</form>
</div>

<br />
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>rekmed/performance_cetak/',800,768);" class="printer_button" />
</div>
<table cellpadding="0" cellspacing="4" border="0" class="form">
	<tr>
		<td style="width:70%">
			<h2 id="performance_title"></h2>
			<div id="performance_list_data"></div>
		</td>
		<td>
			<h2 id="performance_param_title"></h2>
			<div id="performance_param_list_data"></div>
		</td>
	</tr>
</table>
<br />
<div id="graph2" style="text-align:center;"></div>

<br />
<div id="graph" style="text-align:center;"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>