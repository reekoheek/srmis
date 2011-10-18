<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_karcis" id="form_karcis" onsubmit="return false;">
<input type="hidden" name="id_karcis" id="id_karcis" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width: 150px">Nama Karcis</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'jenis', event, 'simpan', this)" size="30" /></td>
				</tr>
				<tr>
					<td>Jenis</td><td>
						<select name="jenis" id="jenis" style="width: 150px;" onkeypress="focusNext( 'kelas', event, 'nama', this)" class="inputan">
						<option value="">--- PILIH ---</option>
						<option value="IGD">IRD</option>
						<option value="RAWAT JALAN">RAWAT JALAN</option>
						<option value="RAWAT INAP">RAWAT INAP</option>
						<option value="RUANG TINDAKAN">RUANG TINDAKAN</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Kelas</td><td>
						<select name="kelas" id="kelas" style="width: 100px;" onkeypress="focusNext( 'biaya_bhp', event, 'jenis', this)" class="inputan">
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
					<td><input type="text" name="biaya_jasa" id="biaya_jasa" value="0" class="inputan" onkeypress="focusNext( 'jasa_p', event, 'bhp_rs', this)" size="30" class="inputan_angka" /></td>
				</tr>				
	       <tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_karcis_check(xajax.getFormValues('form_karcis'));" onkeypress="focusNext( 'nama', event, 'netto', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_karcis();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>