<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_pelayanan" id="form_pelayanan" onsubmit="return false;">
<input type="hidden" name="id_pelayanan" id="id_pelayanan" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nama Bangsal</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'nama_lain', event, 'simpan', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td>Nama Lain</td><td><input type="text" name="nama_lain" id="nama_lain" value="" class="inputan" onkeypress="focusNext( 'spesialisasi_id', event, 'nama', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td>Spesialisasi</td><td>
			<select id="spesialisasi_id" name="spesialisasi_id" class="inputan" onkeypress="focusNext( 'simpan', event, 'nama_lain', this)" style="width:200px">
				<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_spc);$i++):?>
					<option value="<?=$_data_spc[$i][id]?>"><?=$_data_spc[$i][nama]?></option>
				<?endfor;?>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_pelayanan_check(xajax.getFormValues('form_pelayanan'));" onkeypress="focusNext( 'nama', event, 'spesialisasi_id', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_pelayanan();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>