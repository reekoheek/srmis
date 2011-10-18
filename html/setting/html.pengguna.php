<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_pengguna" id="form_pengguna" onsubmit="return false;">
<input type="hidden" name="id_pengguna" id="id_pengguna" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nama*</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'username', event, 'simpan', this)" size="30" /></td>
	</tr>
	<tr>
		<td>Username*</td><td><input type="text" name="username" id="username" value="" class="inputan" onkeypress="focusNext( 'pwd', event, 'nama', this)" /></td>
	</tr>
	<tr>
		<td>Password*</td><td><input type="password" name="pwd" id="pwd" value="" class="inputan" onkeypress="focusNext( 'pwd2', event, 'username', this)" /><div id="msg_pwd" style="font-style:italic;"></div></td>
	</tr>
	<tr>
		<td>Re-type password*</td><td><input type="password" name="pwd2" id="pwd2" value="" class="inputan" onkeypress="focusNext( 'pengguna_group_id', event, 'pwd', this)" /><div id="msg_pwd2" style="font-style:italic;"></div></td>
	</tr>
	<tr>
		<td>Group*</td><td>
			<select name="pengguna_group_id" id="pengguna_group_id" class="inputan" onkeypress="focusNext( 'pelayanan_id', event, 'pwd2', this)" onchange="get_pelayanan(this.value)" style="width:200px;">
				<option value="">--- PILIH ---</option>
				<? for($i=0;$i<sizeof($data_group);$i++) :?>
					<option value="<?=$data_group[$i][id]?>"><?=$data_group[$i][nama]?></option>
				<? endfor; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Pelayanan</td><td>
			<select name="pelayanan_id" id="pelayanan_id" class="inputan" onkeypress="focusNext( 'simpan', event, 'pengguna_group_id', this)" style="width:200px;">
				<option id="pelayanan_id_0" value="">--- PILIH ---</option>
			</select>
			<i>Hanya untuk Rawat Jalan, Rawat Inap, dan Ruang Tindakan</i>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_pengguna_check(xajax.getFormValues('form_pengguna'));" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_pengguna();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>