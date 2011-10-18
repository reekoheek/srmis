function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_imunisasi(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_imunisasi(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
function simpan_imunisasi_check() {
	var val = xajax.getFormValues('form_imunisasi');
	var baru = new Array();
	if(document.getElementById('sebab_sakit_1').checked == true) baru[0] = 'Dipteri';	else baru[0] = "";
	if(document.getElementById('sebab_sakit_2').checked == true) baru[1] = 'Pertusis';	else baru[1] = "";
	if(document.getElementById('sebab_sakit_3').checked == true) baru[2] = 'Tetanus';	else baru[2] = "";
	if(document.getElementById('sebab_sakit_4').checked == true) baru[3] = 'Tetanus Neonatorum';	else baru[3] = "";
	if(document.getElementById('sebab_sakit_5').checked == true) baru[4] = 'TBC Paru';	else baru[4] = "";
	if(document.getElementById('sebab_sakit_6').checked == true) baru[5] = 'Campak';	else baru[5] = "";
	if(document.getElementById('sebab_sakit_7').checked == true) baru[6] = 'Polio';	else baru[6] = "";
	if(document.getElementById('sebab_sakit_8').checked == true) baru[7] = 'Hepatitis';	else baru[7] = "";
	xajax_simpan_imunisasi_check(val, baru);
}