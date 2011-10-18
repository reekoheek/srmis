<? 
echo '<pre>';print_r($_SESSION); exit;
   $_SESSION['status'] = 'RAWAT JALAN';
   include KOMPONEN_DIR . "header.php"; ?>
<h3>Daftar Kunjungan Rawat Jalan</h3>
<br />
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
					<td>Tgl Lahir</td>
					<td>
							<?
							$tgl_skr = date("d");
							$bln_skr = date("m");
							$thn_skr = date("Y");
							$thn_start = $thn_skr-70;
							?>					
						<select name="tgl_lahir_tgl" id="tgl_lahir_tgl" style="width: 50px;" onkeypress="focusNext( 'tgl_lahir_bln', event, 'tempat_lahir', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<?	for($i=1;$i<32;$i++) :
									$tgl = tambahNol($i, 2);
									/*if($tgl==$tgl_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$tgl?>" <?=$sel?> ><?=$i?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_bln" id="tgl_lahir_bln" style="width: 100px;" onkeypress="focusNext( 'tgl_lahir_thn', event, 'tgl_lahir_tgl', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<? for($i=1;$i<13;$i++) :
									$bln = tambahNol($i, 2);
									/*if($bln==$bln_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$bln?>" <?=$sel?> ><?=bulanIndo($i, "F")?></option>
							<? endfor; ?>
						</select>
						<select name="tgl_lahir_thn" id="tgl_lahir_thn" style="width: 60px;" onkeypress="focusNext( 'gol_darah_id', event, 'tgl_lahir_bln', this);xajax_hitung_umur(xajax.getFormValues('tambah_pasien'))" class="inputan">
						<option value=""></option>
							<? for($i=$thn_start;$i<=$thn_skr;$i++) :
									/*if($i==$thn_skr) $sel = "selected";
									else $sel = "";*/
							?>
								<option value="<?=$i?>" <?=$sel?> ><?=$i?></option>
							<? endfor ?>
						</select>
					</td>
				</tr>
                <tr>
					<td style="width:150px;">Telp</td>
					<td><input type="text" name="telp" id="telp" size="30" class="inputan" onkeypress="focusNext( 'cari', event, 'pasien_id', this)" />&nbsp;<input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="xajax_list_data('0',xajax.getFormValues('form_kunjungan'));" onkeypress="focusNext( 'pasien_id', event, 'pasien_id', this)" /></td>
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
<div id="list_daftar_tbi" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:500px;"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Klik pada salah satu kunjungan untuk menginput pemeriksaan.
Klik tombol <img src="<?=IMAGES_URL?>kunjungan24.png" alt="Kunjungan Sebelumnya" /> untuk melihat kunjungan sebelumnya.
Klik tombol <img src="<?=IMAGES_URL?>edu_science.png" alt="Daftar Penunjang" /> untuk mendaftarkan pasien ke pelayanan penunjang atau ruang tindakan.
Klik tombol <img src="<?=IMAGES_URL?>uang.png" alt="Langsung Bayar" /> untuk melihat tagihan.
</div>
<div id="modal_list_kunjungan" class="window_modal" style="display:none;left:20px;top:20px;width:50%;z-index:3;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="xajax_tutup_list_kunjungan();" /></div>
<div class="modal_title_bar">Daftar Kunjungan Yang Pernah Dilakukan</div>
<div id="tab_list_semua_kunjungan_navi" class="navi"></div>
<table cellpadding="0" cellspacing="2" border="0" class="form" style="margin:5px">
	<tr>
		<td style="width:150px;"><b>No. RM</b></td><td><div id="mlk_no_rm"></div></td>
	</tr>
	<tr>
		<td><b>Nama</b></td><td><div id="mlk_nama"></div></td>
	</tr>
	<tr>
		<td><b>Jenis Kelamin</b></td><td><div id="mlk_sex"></div></td>
	</tr>
</table>
<div id="tab_list_semua_kunjungan" style="height:auto;max-height:400px;overflow:scroll;border-right:solid 1px #000000;"></div>
</div>

<div id="modal_daftar_penunjang" class="window_modal" style="display:none;left:20px;top:20px;width:350px;z-index:4;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_daftar_penunjang();" /></div>
<div class="modal_title_bar">Pendaftaran Penunjang dan Ruang Tindakan</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_daftar_penunjang" id="form_daftar_penunjang" onsubmit="return false;">
<input type="hidden" name="dp_idkk" id="dp_idkk" />
<table cellpadding="0" cellspacing="5" border="0" class="form" style="margin:5px">
	<tr>
		<td style="width:100px;">No. RM</td><td><div id="dp_no_rm"></div></td>
	</tr>
	<tr>
		<td>Nama</td><td><div id="dp_nama"></div></td>
	</tr>
	<tr>
		<td>Sex</td><td><div id="dp_sex"></div></td>
	</tr>
	<tr>
		<td>Pengirim</td><td><input type="text" size="30" name="dp_pengirim" id="dp_pengirim" onkeypress="focusNext( 'dp_lab', event, 'dp_simpan', this)" class="inputan" /></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="2" border="0" class="form" style="margin:5px">
	<tr>
		<td><b>Daftarkan Untuk Penunjang</b> :</td>
	</tr>
	<tr>
		<td><label for="dp_lab"><input type="checkbox" name="dp_lab" id="dp_lab" value="1" onkeypress="focusNext( 'dp_radio', event, 'dp_pengirim', this)" class="inputan" />Laboratorium</label></td>
	</tr>
	<tr>
		<td><label for="dp_radio"><input type="checkbox" name="dp_radio" id="dp_radio" value="1" onkeypress="focusNext( 'dp_vk', event, 'dp_lab', this)" class="inputan" />Radiologi</label></td>
	</tr>
</table>
<table cellpadding="0" cellspacing="2" border="0" class="form" style="margin:5px">
	<tr>
		<td><b>Daftarkan Untuk Ruang Tindakan</b> :</td>
	</tr>
	<tr>
		<td><label for="dp_vk"><input type="checkbox" name="dp_vk" id="dp_vk" value="1" onkeypress="focusNext( 'dp_anestesi', event, 'dp_radio', this)" class="inputan" />VK</label></td>
	</tr>
	<tr>
		<td><label for="dp_anestesi"><input type="checkbox" name="dp_anestesi" id="dp_anestesi" value="1" onkeypress="focusNext( 'dp_roperasi', event, 'dp_vk', this)" class="inputan" />Anestesi</label></td>
	</tr>
	<tr>
		<td><label for="dp_roperasi"><input type="checkbox" name="dp_roperasi" id="dp_roperasi" value="1" onkeypress="focusNext( 'dp_simpan', event, 'dp_anestesi', this)" class="inputan" />Ruang Operasi</label></td>
	</tr>
	<tr>
		<td style="text-align:center;"><input type="button" name="dp_simpan" id="dp_simpan" value="Simpan" onclick="xajax_daftar_penunjang(xajax.getFormValues('form_daftar_penunjang'));" class="inputan" />&nbsp;&nbsp;<input type="button" name="dp_tutup" id="dp_tutup" value="Tutup" onclick="tutup_daftar_penunjang();" class="inputan" /></td>
	</tr>
</table>
</form>
</div>
<? include_once "html.kunjungan.modal.php"; ?>
<? include_once "html.langsung_bayar.modal.php"; ?>
<? include KOMPONEN_DIR . "footer.php"; ?>