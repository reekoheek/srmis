<? include KOMPONEN_DIR . "header.php"; ?>
<h3>Cetak Tracer</h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Cetak</td><td>
			<select id="jenis_tracer" name="jenis_tracer" class="inputan" onkeypress="focusNext( 'jml_tracer', event, 'cetak_otomatis', this)" style="width:200px" onchange="list_data()">
				<option value="BELUM" selected="">Tracer yang belum tercetak</option>
				<option value="SUDAH">Tracer yang sudah tercetak</option>
				<option value="">Semua tracer</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Jumlah per cetak</td><td>
			<select name="jml_tracer" id="jml_tracer" style="width:70px" onkeypress="focusNext( 'tgl_periksa_tgl', event, 'jenis_tracer', this)" onchange="list_data()" class="inputan">
				<option value="1">1</option>
				<option value="5" selected="">5</option>
				<option value="10">10</option>
			</select>
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
		<td>Tgl Periksa</td>
		<td colspan="2">
			<select name="tgl_periksa_tgl" id="tgl_periksa_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_periksa_bln', event, 'jml_tracer', this)" class="inputan">
				<?	for($i=1;$i<32;$i++) :
						$tgl = tambahNol($i, 2);
						if($tgl==$tgl_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_periksa_bln" id="tgl_periksa_bln" style="width: 80px;" onkeypress="focusNext( 'tgl_periksa_thn', event, 'tgl_periksa_tgl', this)" class="inputan">
				<? for($i=1;$i<13;$i++) :
						$bln = tambahNol($i, 2);
						if($bln==$bln_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
				<? endfor; ?>
			</select>
			<select name="tgl_periksa_thn" id="tgl_periksa_thn" style="width: 60px;" onkeypress="focusNext( 'hanya_tanggal_ini', event, 'tgl_periksa_bln', this)" class="inputan">
				<? for($i=$thn_start;$i<=$thn_bsok;$i++) :
						if($i==$thn_skr) $sel = "selected";
						else $sel = "";
				?>
					<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
				<? endfor; ?>
			</select><input type="checkbox" name="hanya_tanggal_ini" id="hanya_tanggal_ini" value="1" checked="" onkeypress="focusNext('cetak_otomatis', event, 'tgl_periksa_thn', this)" onclick="list_data()" class="inputan" /><label for="hanya_tanggal_ini" id="label_hanya_tanggal_ini">Hanya tanggal ini</label>
		</td>
	</tr>
	<tr>
		<td>Cetak Otomatis</td><td>
			<input type="checkbox" name="cetak_otomatis" id="cetak_otomatis" value="1" onkeypress="focusNext('jenis_tracer', event, 'hanya_tanggal_ini', this)" onclick="list_data()" class="inputan" /><label for="cetak_otomatis" id="label_cetak_otomatis">Cetak otomatis&nbsp;&nbsp;<i>(setiap 10 menit, khusus tracer yang belum tercetak)</i></label>
		</td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<div id="list_semua_kunjungan" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:600px;"></div>
<div class="info" id="info_cari"><b>Petunjuk :</b>
Klik pada salah satu pasien untuk melihat kunjungan yang pernah dilakukan.
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>