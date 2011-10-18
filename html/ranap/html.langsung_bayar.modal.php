<div id="modal_lb" class="window_modal" style="display:none;left:20px;top:20px;width:10cm;z-index:3;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_modal_lb();" /></div>
<div class="modal_title_bar">Tagihan Pasien</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_lb" id="form_lb" onsubmit="return false;">
<input type="hidden" name="lb_id_kunjungan_kamar" id="lb_id_kunjungan_kamar" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 120px;">Pelayanan</td>
					<td><div id="lb_pelayanan"></div></td>
				</tr>
				<tr>
					<td>No. RM</td>
					<td><div id="lb_no_rm"></div></td>
				</tr>
				<tr>
					<td>Nama Pasien</td>
					<td><div id="lb_pasien"></div></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><div id="lb_sex"></div></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><div id="lb_usia"></div></td>
				</tr>
				<tr>
					<td>Alamat</td>
					<td><div id="lb_alamat"></div></td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td><div id="lb_tgl_periksa"></div></td>
				</tr>
				<tr>
					<td>Cara Bayar</td>
					<td><div id="lb_cara_bayar"></div></td>
				</tr>
				<tr>
					<td>Nomor</td>
					<td><div id="lb_nomor"></div></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><div id="lb_list_jasa"></div></td>
	</tr>
</table>
</form>
</div>