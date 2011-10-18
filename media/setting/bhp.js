function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_bhp(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_bhp(idx);
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