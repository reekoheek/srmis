<div id="modal_lb" class="window_modal" style="display:none;left:20px;top:20px;width:15cm;z-index:3;">
<div class="modal_button_group"><img src="<?=IMAGES_URL?>close.png" alt="Tutup" onclick="tutup_modal_lb();" /></div>
<div class="modal_title_bar">Pembayaran</div>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_lb" id="form_lb" onsubmit="return false;">
<input type="hidden" name="lb_id_kunjungan" id="lb_id_kunjungan" />
<table cellpadding="5" cellspacing="0" border="0" style="width:100%">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form" style="width:100%;">
				<tr>
					<td style="width: 120px;">No. RM</td>
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
					<td>Tgl Masuk</td>
					<td><div id="lb_tgl_daftar"></div></td>
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
	<tr>
		<td>
			<fieldset class="fieldset_modal">
			<legend>Pembayaran</legend>
				<table cellpadding="2" cellspacing="2" border="0" style="width:100%">
					<tr>
						<td style="width:100px;">Total</td><td style="width:200px;">Rp. <input type="text" readonly="" name="lb_total_display" id="lb_total_display" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'lb_sudah_dibayar_display', event, 'langsung_bayar', this)" /></td>
					</tr>
					<tr>
						<td>Sudah Dibayar</td><td>Rp. <input type="text" readonly="" name="lb_sudah_dibayar_display" id="lb_sudah_dibayar_display" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'lb_kurang_display', event, 'lb_total_display', this)" /><input type="hidden" name="lb_sudah_dibayar" id="lb_sudah_dibayar" /></td>
					</tr>
					<tr>
						<td>Sisa</td><td>Rp. <input type="text" name="lb_kurang_display" id="lb_kurang_display" readonly="" class="inputan_angka_ro" size="30" onkeypress="focusNext( 'lb_mampu_bayar', event, 'lb_sudah_dibayar_display', this)" /><input type="hidden" name="lb_kurang" id="lb_kurang" /></td>
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<tr>
						<td>Pembayaran</td><td>Rp. <input type="text"  name="lb_mampu_bayar"  id="lb_mampu_bayar" class="inputan_angka" size="30" onkeypress="focusNext( 'lb_simpan', event, 'lb_kurang', this)" onkeyup="writeTerbilang('mampu_terbilang', this.value)" /><div id="mampu_terbilang" style="font-style:italic;"></div></td>
					</tr>
                    <tr>
                        <td><label for="ck_uang_muka"><input type="checkbox" name="ck_uang_muka" id="ck_uang_muka" value="0" onchange="uang_muka()" onclick="uang_muka();focusNext( 'lb_uang_muka', event, 'lb_cancel', this);" />Uang Muka</label></td>
                        <td><input type="text" name="lb_uang_muka" id="lb_uang_muka"  style="visibility: hidden;" class="inputan_angka" size="30" /></td>
                    </tr>
					<tr>
						<td colspan="2" style="text-align: center;padding-top:30px;">
						<input type="button" name="lb_simpan" id="lb_simpan" value="Bayar dan Cetak Kwitansi" class="inputan" onclick="simpan_langsung_bayar();" />&nbsp;&nbsp;
						<input type="button" name="lb_cancel" id="lb_cancel" value="Tutup" class="inputan" onclick="tutup_modal_lb();" /> &nbsp;&nbsp;
                        <input type="button" name="lb_dp" id="lb_dp" value="Uang Muka" class="inputan" onclick="bayar_uang_muka();" style="visibility: hidden;" /></td>
     
					</tr>
				</table>
			</fieldset>
			<br />
			<fieldset class="fieldset_modal"><legend>Pembayaran Sebelumnya</legend><div id="lb_button_kwitansi"></div></fieldset>
		</td>
	</tr>
</table>
</form>
</div>