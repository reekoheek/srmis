function focusFirst() {
	document.getElementById('cara_bayar').focus();
	document.getElementById('cara_bayar').select;
	xajax_list_data(xajax.getFormValues('form_kunjungan'));
}

function setDisable(obj) {
	if(obj.value == "tahun") {
		document.getElementById('tgl_start').disabled = true;
		document.getElementById('bln_start').disabled = true;
		document.getElementById('tgl_end').disabled = true;
		document.getElementById('bln_end').disabled = true;
	} else if (obj.value == "bulan") {
		document.getElementById('tgl_start').disabled = true;
		document.getElementById('bln_start').disabled = false;
		document.getElementById('tgl_end').disabled = true;
		document.getElementById('bln_end').disabled = false;
	} else {
		document.getElementById('tgl_start').disabled = false;
		document.getElementById('bln_start').disabled = false;
		document.getElementById('tgl_end').disabled = false;
		document.getElementById('bln_end').disabled = false;
	}
}

function setBg(obj) {
	var warna = obj.style.backgroundColor;
	if(warna == '') obj.style.backgroundColor = '#FFCC00';
	else obj.style.backgroundColor = '';
}