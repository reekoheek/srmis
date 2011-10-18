<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_kamar" id="form_kamar" onsubmit="return false;">
<input type="hidden" name="id_kamar" id="id_kamar" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>Bangsal</td><td>
			<select id="pelayanan_id" name="pelayanan_id" class="inputan" onkeypress="focusNext( 'nama', event, 'simpan', this)" style="width:200px" onchange="xajax_ref_get_nama_kamar('kamar_id', this.value, null);">
					<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_pel);$i++):?>
					<option value="<?=$_data_pel[$i][id]?>"><?=$_data_pel[$i][nama]?></option>
				<?endfor;?>
			</select>
		</td>
	</tr>
	<tr>
	    <td>Nama kamar</td>
		<td>
		      <select name="kamar_id" id="kamar_id" style="width: 200px;" onkeypress="focusNext( 'no_kamar', event, 'pelayanan_id', this)" class="inputan">
			     <option value="">--- PILIH ---</option>
			  </select>
		</td>
	</tr>
    <tr>
		<td style="width: 150px">No Bed</td><td><input type="text" name="no_kamar" id="no_kamar" value="" class="inputan" onkeypress="focusNext( 'kelas', event, 'pelayanan_id', this)" size="30" /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_kamar_check(xajax.getFormValues('form_kamar'));" />&nbsp;&nbsp;
		<input type="reset" id="baru" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_kamar();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_kamar"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>