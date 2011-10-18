function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_perujuk(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_perujuk(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
