function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data_lab();
}
function hapus_lab(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_lab(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}