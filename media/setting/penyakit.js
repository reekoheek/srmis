function focusFirst() {
	document.getElementById('kode_icd_group').focus();
	document.getElementById('kode_icd_group').select;
	list_data();
}
function hapus_icd(idx, obj) {
	document.getElementById(obj).style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_icd(idx);
	}
	else {
		document.getElementById(obj).style.backgroundColor = '';
	}
	return;
}

function list_data(hal) {
	if(!hal) hal = '0';
	xajax_list_data(hal, xajax.getFormValues('form_icd'));
}