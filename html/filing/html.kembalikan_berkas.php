<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_tracer" id="form_tracer" onsubmit="return false;">
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_bsok = $thn_skr+1;
				$thn_start = $thn_skr-70;
				?>

<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Tgl Berkas Keluar</td>
		<td>
			<select name="tgl_keluar_tgl" id="tgl_keluar_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_keluar_bln', event, 'jml_tracer', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) :
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_keluar_bln" id="tgl_keluar_bln" style="width: 80px;" onkeypress="focusNext( 'tgl_keluar_thn', event, 'tgl_keluar_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) :
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_keluar_thn" id="tgl_keluar_thn" style="width: 60px;" onkeypress="focusNext( 'tanggal_ini', event, 'tgl_keluar_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_bsok;$i++) :
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select>
			<label for="tanggal_ini"><input type="checkbox" name="tanggal_ini" id="tanggal_ini" onclick="list_data()" onkeypress="focusNext( 'tandai_semua', event, 'tgl_keluar_thn', this)" />Tampilkan Hanya Tanggal Ini</label>
		</td>
	</tr>
</table>
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<input type="hidden" name="jml_baris" id="jml_baris" />
<br />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Tandai Semua Berkas</td>
		<td>
			<label for="tandai_semua"><input type="checkbox" value="1" name="tandai_semua" id="tandai_semua" class="inputan" onclick="tandai_semua_berkas(this)" onkeypress="focusNext( 'tgl_kembali_tgl', event, 'jml_tracer', this)" />Centang Semua</label>
		</td>
	</tr>
	<tr>
		<td>Tgl Kembali</td>
		<td colspan="2">
			<select name="tgl_kembali_tgl" id="tgl_kembali_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_kembali_bln', event, 'jml_tracer', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) :
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_kembali_bln" id="tgl_kembali_bln" style="width: 80px;" onkeypress="focusNext( 'tgl_kembali_thn', event, 'tgl_kembali_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) :
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_kembali_thn" id="tgl_kembali_thn" style="width: 60px;" onkeypress="focusNext( 'simpan', event, 'tgl_kembali_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_bsok;$i++) :
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kembalikan_berkas_check(xajax.getFormValues('form_tracer'));" onkeypress="focusNext('tgl_keluar_tgl', event, 'tgl_kembali_thn', this)" />
		</td>
	</tr>
</table>
</form>
<div id="list_semua_kunjungan" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:600px;"></div>
<div class="info" id="info_cari"><b>Petunjuk :</b>
Cek pada baris berkas yang akan dikembalikan, lalu tekan tombol Simpan
*Perhatikan tanggal kembali
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>