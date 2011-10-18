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
		<td style="width:150px">Tahun</td>
		<td>
			<select name="tahun" id="tahun" style="width: 70px;" onkeypress="focusNext( 'bulan_1', event, 'bln_start', this)" class="inputan">
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
		<td>Target : </td>
		<td>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
			<? for($i=1;$i<13;$i++):?>
				<tr>
					<td style="width:100px"><?=bulanIndo($i, "F")?></td>
					<td>
					<? if($i==1) : ?>
						<input type="text" size="30" name="bulan_<?=$i?>" id="bulan_<?=$i?>" onkeypress="focusNext( 'bulan_<?=($i+1)?>', event, 'tahun', this)" class="inputan_angka" />
					<? elseif($i==12) :?>
						<input type="text" size="30" name="bulan_<?=$i?>" id="bulan_<?=$i?>" onkeypress="focusNext( 'tampil', event, 'bulan_<?=($i-1)?>', this)" class="inputan_angka" />
					<? else : ?>
						<input type="text" size="30" name="bulan_<?=$i?>" id="bulan_<?=$i?>" onkeypress="focusNext( 'bulan_<?=($i+1)?>', event, 'bulan_<?=($i-1)?>', this)" class="inputan_angka" />
					<? endif;?>
					</td>
				</tr>
				<? endfor; ?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data(xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'tahun', event, 'bulan_12', this)" /></td>
	</tr>
</table>
</form>
<div style="text-align:right;width:100%;">
<img src="<?=IMAGES_URL?>printer.gif" alt="Cetak" onclick="cetak('<?=URL?>keuangan/lap_keuangan_bulanan_cetak/', 1000);" class="printer_button" />
</div>
<br /><h2 id="title"></h2>
<div id="list_data"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Pilih tahun dan masukkan target bulanan, lalu tekan tombol tampilkan
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>