<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_dokter" id="form_dokter" onsubmit="return false;">
<input type="hidden" name="id_dokter" id="id_dokter" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td>Spesialisasi</td><td>
			<select id="spesialisasi_id" name="spesialisasi_id" class="inputan" onkeypress="focusNext( 'subspesialisasi_id', event, 'simpan', this)" style="width:200px" onchange="xajax_ref_get_subspesialisasi('subspesialisasi_id', this.value)">
					<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_spc);$i++):?>
					<option value="<?=$_data_spc[$i][id]?>"><?=$_data_spc[$i][nama]?></option>
				<?endfor;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Sub-Spesialisasi</td><td>
			<select id="subspesialisasi_id" name="subspesialisasi_id" class="inputan" onkeypress="focusNext( 'nama', event, 'spesialisasi_id', this)" style="width:200px">
					<option value="">-- PILIH --</option>
			</select>
		</td>
	</tr>
	<tr>
		<td style="width: 150px">Nama</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'simpan', event, 'subspesialisasi_id', this)" size="30" /></td>
	</tr>

	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_dokter_check(xajax.getFormValues('form_dokter'));" onkeypress="focusNext( 'spesialisasi_id', event, 'aktif', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_dokter();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>