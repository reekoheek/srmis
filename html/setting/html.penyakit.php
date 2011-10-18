<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<table cellpadding="10" cellspacing="0" border="0">
	<tr>
		<td style="width:50%;">
			<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_icd" id="form_icd" onsubmit="return false;">
			<input type="hidden" name="id_icd" id="id_icd" value="" />
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width: 150px">Kode ICD Group</td>
					<td>
					<input type="text" name="kode_icd_group" id="kode_icd_group" value="" class="inputan" onkeypress="focusNext( 'kode_icd', event, 'simpan', this)" onkeyup="hurufBesar(this);kopiPaste(this, 'kode_icd')" size="30" /></td>
				</tr>
				<tr>
					<td>Kode ICD</td><td><input type="text" name="kode_icd" id="kode_icd" value="" class="inputan" onkeypress="focusNext( 'no_dtd', event, 'kode_icd_group', this)" size="50" onkeyup="hurufBesar(this)" /></td>
				</tr>
				<tr>
					<td>No. DTD</td><td><input type="text" name="no_dtd" id="no_dtd" value="" class="inputan" onkeypress="focusNext( 'nama', event, 'kode_icd', this)" size="50" /></td>
				</tr>
				<tr>
					<td>Nama Penyakit</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'gol_sebab_sakit', event, 'no_dtd', this)" size="50"/></td>
				</tr>
				<tr>
					<td>Gol. Sebab Sakit</td><td><input type="text" name="gol_sebab_sakit" id="gol_sebab_sakit" value="" class="inputan" onkeypress="focusNext( 'simpan', event, 'nama', this)" size="50" /></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_icd_check(xajax.getFormValues('form_icd'));" onkeypress="focusNext( 'kode_icd_group', event, 'gol_sebab_sakit', this)" />&nbsp;&nbsp;
					<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_icd();" /></td>
				</tr>
			</table>
			
		</td>
		<td>
			
			<fieldset>
			<legend>Pencarian</legend>
			<table cellpadding="0" cellspacing="2" border="0" class="form">
				<tr>
					<td style="width: 150px">Pencarian</td>
					<td>
					<input type="text" name="cari_nama" id="cari_nama" value="" class="inputan" onkeypress="focusNext( 'cari', event, 'cari', this)" size="30" />&nbsp;&nbsp;<input type="button" name="cari" id="cari" value="Cari" class="inputan" onclick="list_data('0');" onkeypress="focusNext( 'cari_nama', event, 'cari_nama', this)" /></td>
				</tr>
			</table>
			</fieldset>
			</form>
		</td>
	</tr>
</table>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>