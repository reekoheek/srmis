<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kecamatan" id="form_kecamatan" onsubmit="return false;">
<input type="hidden" name="id_kecamatan" id="id_kecamatan" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>Propinsi</td><td>
			<select name="propinsi_id" id="propinsi_id" class="inputan" onkeypress="focusNext( 'kabupaten_id', event, 'simpan', this)" style="width:300px;" onchange="xajax_get_kabupaten(this.value);show_this_only();">
				<option value="">--- PILIH ---</option>
				<? for($i=0;$i<sizeof($_data_prop);$i++) :?>
					<option value="<?=$_data_prop[$i][id]?>"><?=$_data_prop[$i][nama]?></option>
				<? endfor; ?>
			</select>
			&nbsp;
			<label for="show_this_prop"><input type="checkbox" value="1" name="show_this_prop" id="show_this_prop" onclick="show_this_only();" />Tampilkan Hanya Propinsi Ini</label>
		</td>
	</tr>
	<tr>
		<td>Kabupaten</td><td>
			<select name="kabupaten_id" id="kabupaten_id" class="inputan" onkeypress="focusNext( 'nama', event, 'propinsi_id', this)" style="width:300px;" onchange="show_this_only();">
				<option value="">--- PILIH ---</option>
			</select>
			&nbsp;
			<label for="show_this_kab"><input type="checkbox" value="1" name="show_this_kab" id="show_this_kab" onclick="show_this_only();" />Tampilkan Hanya Kabupaten Ini</label>
		</td>
	</tr>
	<tr>
		<td style="width: 100px">Nama</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'simpan', event, 'propinsi_id', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kecamatan_check(xajax.getFormValues('form_kecamatan'));" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_kecamatan();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>