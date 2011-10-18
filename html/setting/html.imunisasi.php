<? include KOMPONEN_DIR . "header.php"; ?>
<h3><?=$_TITLE?></h3>
<form method="post" action="<?$_SERVER['PHP_SELF']?>" name="form_imunisasi" id="form_imunisasi" onsubmit="return false;">
<input type="hidden" name="id_imunisasi" id="id_imunisasi" value="" />
<table cellpadding="0" cellspacing="2" border="0" class="form">
	<tr>
		<td style="width: 150px">Nama</td><td><input type="text" name="nama" id="nama" value="" class="inputan" onkeypress="focusNext( 'sebab_sakit_1', event, 'simpan', this)" onkeyup="hurufBesar(this)" size="30" /></td>
	</tr>
	<tr>
		<td>Penyabab Sakit</td>
		<td>
			<table cellpadding="0" cellspacing="5" border="0">
				<tr>
					<td>
			<label for="sebab_sakit_1"><input type="checkbox" name="sebab_sakit_1" id="sebab_sakit_1" value="Dipteri" class="inputan" onkeypress="focusNext( 'sebab_sakit_2', event, 'nama', this)" />Dipteri</label><br />
			<label for="sebab_sakit_2"><input type="checkbox" name="sebab_sakit_2" id="sebab_sakit_2" value="Pertusis" class="inputan" onkeypress="focusNext( 'sebab_sakit_3', event, 'sebab_sakit_1', this)" />Pertusis</label><br />
			<label for="sebab_sakit_3"><input type="checkbox" name="sebab_sakit_3" id="sebab_sakit_3" value="Tetanus" class="inputan" onkeypress="focusNext( 'sebab_sakit_4', event, 'sebab_sakit_2', this)" />Tetanus</label><br />
			<label for="sebab_sakit_4"><input type="checkbox" name="sebab_sakit_4" id="sebab_sakit_4" value="Tetanus Neonatorum" class="inputan" onkeypress="focusNext( 'sebab_sakit_5', event, 'sebab_sakit_3', this)" />Tetanus Neonatorum</label><br />
					
					</td>
					<td>
			<label for="sebab_sakit_5"><input type="checkbox" name="sebab_sakit_5" id="sebab_sakit_5" value="TBC Paru" class="inputan" onkeypress="focusNext( 'sebab_sakit_6', event, 'sebab_sakit_4', this)" />TBC Paru</label><br />
			<label for="sebab_sakit_6"><input type="checkbox" name="sebab_sakit_6" id="sebab_sakit_6" value="Campak" class="inputan" onkeypress="focusNext( 'sebab_sakit_7', event, 'sebab_sakit_5', this)" />Campak</label><br />
			<label for="sebab_sakit_7"><input type="checkbox" name="sebab_sakit_7" id="sebab_sakit_7" value="Polio" class="inputan" onkeypress="focusNext( 'sebab_sakit_8', event, 'sebab_sakit_6', this)" />Polio</label><br />
			<label for="sebab_sakit_8"><input type="checkbox" name="sebab_sakit_8" id="sebab_sakit_8" value="Hepatitis" class="inputan" onkeypress="focusNext( 'simpan', event, 'sebab_sakit_7', this)" />Hepatitis</label><br />
					
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: center;"><input type="button" name="simpan" id="simpan" value="Simpan" class="inputan" onclick="simpan_imunisasi_check();" onkeypress="focusNext( 'nama', event, 'sebab_sakit_8', this)" />&nbsp;&nbsp;
		<input type="reset" name="baru" value="Data Baru" class="inputan" onclick="xajax_reset_imunisasi();" /></td>
	</tr>
</table>
</form>
<br />
<div id="navi" class="navi"></div>
<div id="list_data"></div>
<? include KOMPONEN_DIR . "footer.php"; ?>