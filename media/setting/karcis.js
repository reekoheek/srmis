function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_karcis(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_karcis(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
function jumlahkan(inputId, val1, val2) {
	var x = parseFloat(val1)+ parseFloat(val2);
	if(x == 'NaN' || x == 'undefined') x = 0;
	document.getElementById(inputId).value = x;
}
function jumlahkan2(inputId, val1, val2, val3, val4) {
	document.getElementById(inputId).value = parseFloat(val1)+ parseFloat(val2) + parseFloat(val3)+ parseFloat(val4);
}