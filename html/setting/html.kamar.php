<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kamar" id="form_kamar" onsubmit="return false;">
<input type="hidden" name="id_kamar" id="id_kamar" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>Bangsal</td><td>
			<select id="pelayanan_id" name="pelayanan_id" class="inputan" onkeypress="focusNext( 'nama', event, 'simpan', this)" style="width:200px">
					<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_pel);$i++):?>
					<option value="<?=$_data_pel[$i][id]?>"><?=$_data_pel[$i][nama]?></option>
				<?endfor;?>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 150px">Nama Kamar</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'no_kamar', event, 'pelayanan_id', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
    <tr>
		<td style="width: 150px">No Kamar</td><td><input type="text" name="no_kamar" id="no_kamar" value="" class="inputan" onkeypress="focusNext( 'kelas', event, 'pelayanan_id', this)" size="30" /></td>
	</tr>
	<tr>
		<td>Kelas</td><td>
			<select name="kelas" id="kelas" class="inputan" onkeypress="focusNext( 'jml_bed', event, 'nama', this)">
				<option value="">-- PILIH --</option>
				<option value="I A">I A</option>
				<option value="II A">II A</option>
				<option value="I B">I B</option>
				<option value="II B">II B</option>
				<option value="III B">III B</option>
				<option value="UTAMA">UTAMA</option>
				<option value="TANPA KELAS">TANPA KELAS</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Jumlah TT</td><td>
			<input type="text" name="jml_bed" id="jml_bed" class="inputan" onkeypress="focusNext( 'tarif_umum', event, 'kelas', this)" /></td>
	</tr>
    <tr>
		<td>Tarif Umum</td><td>
			<input type="text" name="tarif_umum" id="tarif_umum" class="inputan" onkeypress="focusNext( 'tarif_asuransi', event, 'kelas', this)" /></td>
	</tr>
    <tr>
		<td>Tarif Asuransi</td><td>
			<input type="text" name="tarif_asuransi" id="tarif_asuransi" class="inputan" onkeypress="focusNext( 'simpan', event, 'kelas', this)" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kamar_check(xajax.getFormValues('form_kamar'));" onkeypress="focusNext( 'pelayanan_id', event, 'jml_bed', this)" />&nbsp;&nbsp;
		<input type="reset" id="baru" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_kamar();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>