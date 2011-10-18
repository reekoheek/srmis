<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_perujuk" id="form_perujuk" onsubmit="return false;">
<input type="hidden" name="id_perujuk" id="id_perujuk" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 100px">Nama</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'alamat', event, 'simpan', this)" size="30" /></td>
	</tr>
	<tr>
		<td>Alamat</td><td><input type="text" name="alamat" id="alamat" value="" size="70" class="inputan" onkeypress="focusNext( 'simpan', event, 'nama', this)" size="30" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_perujuk_check(xajax.getFormValues('form_perujuk'));" onkeypress="focusNext( 'nama', event, 'alamat', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_perujuk();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>