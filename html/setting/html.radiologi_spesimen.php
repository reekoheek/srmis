<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kamar" id="form_kamar" onsubmit="return false;">
<input type="hidden" name="id_radio" id="id_radio" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nama Spesimen</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'no_kamar', event, 'pelayanan_id', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
    <tr>
		<td>Kelas</td><td>
			<select name="kelas" id="kelas" class="inputan" onkeypress="focusNext( 'jml_bed', event, 'nama', this)">
				<option value="">-- PILIH --</option>
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="RAWAAT JALAN">RAWAT JALAN</option>
				<option value="RAWAT INAP">RAWAT INAP</option>
				<option value="TANPA KELAS">TANPA KELAS</option>				
			</select>
		</td>
	</tr>
	<tr>
		<td>Biaya</td><td>
			<input type="text" name="biaya" id="biaya" class="inputan" onkeypress="focusNext( 'tarif_umum', event, 'kelas', this)" /></td>
	</tr>    
	<tr>
		<td>Tingkat</td><td><input type="text" name="tingkat" id="tingkat" value="" class="inputan" onkeyup="hurufBesar(this)" onkeypress="focusNext( 'kelas', event, 'kode', this)" size="20" /></td>
	</tr>
	<tr>
		<td>Jenis Pelayanan</td><td><input type="text" name="jenis_pelayanan" id="jenis_pelayanan" value="" class="inputan" onkeyup="hurufBesar(this)" onkeypress="focusNext( 'kelas', event, 'kode', this)" size="20" /></td>
	</tr>
	<tr>
		<td>Biaya Jasa</td><td><input type="text" name="biaya_jasa" id="biaya_jasa" value="" class="inputan" onkeyup="hurufBesar(this)" onkeypress="focusNext( 'kelas', event, 'kode', this)" size="20" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_radio_check(xajax.getFormValues('form_kamar'));" onkeypress="focusNext( 'pelayanan_id', event, 'jml_bed', this)" />&nbsp;&nbsp;
		<input type="reset" id="baru" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_kamar();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data_radio"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>