<? 
     $_SESSION['status'] = 'RAWAT INAP';
   include KOMPONEN_DIR . "header.php"; ?>
<h3>Pendaftaran Rawat Inap : Data Kunjungan</h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">

<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width:50%;">
<fieldset>
		<legend>Pencarian Berdasarkan Tanggal</legend>        
<table cellpadding="0" cellspacing="2" border="0" class="form">
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_start = $thn_skr-70;
				?>
    <tr><td><input type="checkbox" name="pilih"/>Per Tanggal</td></tr>
	<tr>    
		<td style="width:150px;">Periksa Dari</td>
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
		<td colspan="2" style="text-align: center;"><input type="button" name="tampil" id="tampil" value="Tampilkan" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'tgl_mulai_tgl', event, 'tgl_selesai_thn', this)" /></td>
	</tr>
	<tr>
		<td height="21px">&nbsp;</td>
	</tr>
</table>
</fieldset>
</td>
		<td>
		<fieldset>
		<legend>Pencarian Berdasarkan Identitas Pasien</legend>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width:150px;">Nomor Rekam Medis</td>
					<td><input type="text" name="pasien_id" id="pasien_id" size="20" maxlength="20" class="inputan" onkeypress="focusNext( 'nama', event, 'cari', this)" /></td>
				</tr>
				<tr>
					<td style="width:150px;">Nama Pasien</td>
					<td><input type="text" name="nama" id="nama" size="30" class="inputan" onkeypress="focusNext( 'cari', event, 'pasien_id', this)" />&nbsp;</td>
				</tr>
                <tr>
					<td style="width:150px;">Telp</td>
					<td><input type="text" name="telp" id="telp" size="30" class="inputan" onkeypress="focusNext( 'cari', event, 'pasien_id', this)" />&nbsp;<input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'pasien_id', event, 'pasien_id', this)" /></td>
				</tr>
			</table>
		</fieldset>
		<fieldset>
		<legend>Informasi Kamar</legend>
			<table cellspacing="2" cellpadding="0" class="form">
				<tr>
					<td style="width:30px;">Bangsal</td>
					<td>
					<select id="bangsal" name="bangsal" class="inputan" onkeypress="focusNext( 'nama', event, 'simpan', this)" style="width:100px" onchange="xajax_ref_get_info_no_kamar('no_kamar', this.value);xajax_ref_get_kamar('kamar_id', this.value);get_info_kamar(this);">
						<option value="">-- PILIH --</option>
						<?for($i=0;$i<sizeof($_data_pel);$i++):?>
							<option value="<?=$_data_pel[$i][id]?>"><?=$_data_pel[$i][nama]?></option>
						<?endfor;?>
					</select>
					</td>
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
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Klik pada salah satu kunjungan mendaftar rawat inap.
Kunjungan dengan background <span style="background:#dcdcdc;color:#ffffff">abu-abu</span> adalah kunjungan rawat inap.
Untuk mengubah kunjungan rawat inap, klik pada kunjungan tersebut.
</div>
<? include_once "html.ranap.daftar_ranap.modal.php"; ?>
<? include KOMPONEN_DIR . "footer.php"; ?>