<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_tracer" id="form_tracer" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nomor Rekam Medis</td><td>
			<textarea name="no_rm" id="no_rm" class="inputan" cols="30" rows="10" onkeypress="focusNext( 'tgl_keluar_tgl', event, 'simpan', this)"></textarea>
		</td>
	</tr>
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_bsok = $thn_skr+1;
				$thn_start = $thn_skr-70;
				?>

	<tr>
		<td>Tgl Pinjam</td>
		<td colspan="2">
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
			<select name="tgl_keluar_thn" id="tgl_keluar_thn" style="width: 60px;" onkeypress="focusNext( 'keperluan', event, 'tgl_keluar_bln', this)" class="inputan">
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
		<td>Keperluan</td><td>
			<select name="keperluan" id="keperluan" onkeypress="focusNext('peminjam', event, 'tgl_keluar_thn', this)" class="inputan" style="width:200px;">
				<option value="PEMERIKSAAN">PEMERIKSAAN</option>
				<option value="PENELITIAN">PENELITIAN</option>
				<option value="MELENGKAPI ISI BERKAS">MELENGKAPI ISI BERKAS</option>
				<option value="LAIN-LAIN">LAIN-LAIN</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Peminjam</td><td>
			<input type="text" name="peminjam" id="peminjam" onkeypress="focusNext('simpan', event, 'keperluan', this)" class="inputan" size="50" />
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;">
		<input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_tracer_check(xajax.getFormValues('form_tracer'));" onkeypress="focusNext('no_rm', event, 'peminjam', this)" />
		</td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<div id="list_semua_kunjungan" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:600px;"></div>
<div class="info" id="info_cari"><b>Petunjuk :</b>
Contoh pengisian nomor rekam medis :
<textarea name="contoh_no_rm" id="contoh_no_rm" class="inputan" cols="30" rows="10" readonly="">023684
125678
000056
457812</textarea>
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>