<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kunjungan" id="form_kunjungan" onsubmit="return false;">
<table cellpadding="0" cellspacing="2" border="0" class="form">
				<?
				$tgl_skr = date("d");
				$bln_skr = date("m");
				$thn_skr = date("Y");
				$thn_start = $thn_skr-70;
				?>

	<tr>
		<td style="width:150px;">Keluar Dari</td>
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
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<div id="list_daftar_tbi" class="window_modal" style="display:none;top:20px;left:20px;z-index:3;width:500px;"></div>
<div class="info" id="info_rajal"><b>Petunjuk :</b>
Klik pada salah satu kunjungan untuk menyewa kendaraan.
Klik tombol <img src="<?=IMAGES_URL?>kunjungan24.png" alt="Kunjungan Sebelumnya" /> untuk melihat kunjungan sebelumnya.
Klik tombol <img src="<?=IMAGES_URL?>uang.png" alt="Langsung Bayar" /> untuk melihat atau melakukan pembayaran.
Untuk pasien IRD, input sewa kendaraan dan pembayaran dapat dilakukan dari halaman pemeriksaan pasien IRD. (IRD -> Pemeriksaan)
Jika pasien tidak terdapat pada list, daftarkan dulu pasien ke pelayanan IRD.
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
		<td><b>Sex</b></td><td><div id="mlk_sex"></div></td>
	</tr>
</table>
<div id="tab_list_semua_kunjungan" style="height:auto;max-height:400px;overflow:scroll;border-right:solid 1px #000000;"></div>
</div>

<? include_once "html.kendaraan.modal.php"; ?>
<? include_once "html.kendaraan_langsung_bayar.modal.php"; ?>
<? include KOMPONEN_DIR . "footer.php"; ?>