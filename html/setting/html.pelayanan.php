<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_pelayanan" id="form_pelayanan" onsubmit="return false;">
<input type="hidden" name="id_pelayanan" id="id_pelayanan" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Jenis Pelayanan</td><td>
			<select id="jenis" name="jenis" class="inputan" onkeypress="focusNext( 'spesialisasi_id', event, 'simpan', this)" style="width:200px" onchange="enadisa(this.value);">
					<option value="">-- PILIH --</option>
				<option value="RAWAT JALAN">RAWAT JALAN</option>
				<option value="RAWAT INAP">RAWAT INAP</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Spesialisasi</td><td>
			<select id="spesialisasi_id" name="spesialisasi_id" class="inputan" onkeypress="focusNext( 'nama', event, 'jenis', this)" style="width:200px">
					<option value="">-- PILIH --</option>
				<?for($i=0;$i<sizeof($_data_spc);$i++):?>
					<option value="<?=$_data_spc[$i][id]?>"><?=$_data_spc[$i][nama]?></option>
				<?endfor;?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Nama Klinik/ Bangsal</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'hari_buka', event, 'spesialisasi_id', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td>Hari Buka Seminggu</td><td>
			<input type="text" name="hari_buka" id="hari_buka" class="inputan" onkeypress="focusNext( 'simpan', event, 'nama', this)" onkeyup="numeralsOnly(this, event)" />
			<em> hanya untuk jenis pelayanan rawat jalan</em></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="xajax_simpan_pelayanan_check(xajax.getFormValues('form_pelayanan'));" onkeypress="focusNext( 'jenis', event, 'hari_buka', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_pelayanan();" /></td>
	</tr>
</table>
</form>
<br />
<div class="navi" id="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>