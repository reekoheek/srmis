<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_bhp" id="form_bhp" onsubmit="return false;">
<input type="hidden" name="id_bhp" id="id_bhp" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nama BHP</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'biaya', event, 'simpan', this)" size="30" /></td>
	</tr>
	<tr>
		<td>Biaya BHP</td>
		<td><input type="text" name="biaya" id="biaya" value="0" class="inputan" onkeypress="focusNext( 'bhp_p', event, 'nama', this)" size="30" class="inputan_angka" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_bhp_check(xajax.getFormValues('form_bhp'));" onkeypress="focusNext( 'nama', event, 'bhp_rs', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_bhp();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>