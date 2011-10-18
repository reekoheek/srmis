function focusFirst() {
	document.getElementById('tgl_start').focus();
	document.getElementById('tgl_start').select;
	xajax_list_data(xajax.getFormValues('form_kunjungan'));
}
function setBg(obj) {
	var warna = obj.style.backgroundColor;
	if(warna == '') obj.style.backgroundColor = '#FFCC00';
	else obj.style.backgroundColor = '';
}