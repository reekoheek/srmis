<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_cara_bayar" id="form_cara_bayar" onsubmit="return false;">
<input type="hidden" name="id_cara_bayar" id="id_cara_bayar" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 100px">Nama</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'simpan', event, 'simpan', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_cara_bayar_check(xajax.getFormValues('form_cara_bayar'));" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_cara_bayar();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>