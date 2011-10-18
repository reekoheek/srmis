<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_tindakan" id="form_tindakan" onsubmit="return false;">
<input type="hidden" name="id_icopim" id="id_icopim" value="" />
<input type="hidden" name="id_icopim_detil" id="id_icopim_detil" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width: 150px">Jenis Tindakan</td>
                    <td><select name="tindakan_id" id="tindakan_id" style="width: 200px;" class="inputan">
						<option value="-1">--- PILIH ---</option>
                        <option value="1">DOKTER</option>
                        <option value="2">KEPERAWATAN</option>
					</select>
                    </td>
				</tr>
                <tr>
					<td style="width: 150px">Nama Tindakan</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'kode', event, 'simpan', this)" size="30" /></td>
				</tr>
				<tr>
					<td>Kode ICOPIM</td><td><input type="text" name="kode" id="kode" value="" class="inputan" onkeypress="focusNext( 'tingkat', event, 'nama', this)" size="20" /></td>
				</tr>
				<tr>
					<td>Tingkat</td><td><input type="text" name="tingkat" id="tingkat" value="" class="inputan" onkeyup="hurufBesar(this)" onkeypress="focusNext( 'kelas', event, 'kode', this)" size="20" /></td>
				</tr>
				<tr>
					<td>Kelas</td><td>
						<select name="kelas" id="kelas" style="width: 100px;" onkeypress="focusNext( 'jasa_p', event, 'tingkat', this)" class="inputan">
						<option value="TANPA KELAS">--- PILIH ---</option>
						<option value="I">I</option>
						<option value="II">II</option>
						<option value="III">III</option>
						<option value="VIP">VIP</option>
						</select>
					</td>
				</tr>
                <tr>
					<td style="width: 135px">Biaya Jasa</td>
					<td><input type="text" name="biaya" id="biaya" value="0" class="inputan" onkeypress="focusNext( 'jasa_rs_op', event, 'kode', this)" size="30" class="inputan_angka" /></td>
				</tr>				
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_tindakan_check(xajax.getFormValues('form_tindakan'));" onkeypress="focusNext( 'nama', event, 'biaya', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_tindakan();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>