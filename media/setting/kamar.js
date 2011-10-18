function focusFirst() {
	document.getElementById('pelayanan_id').focus();
	document.getElementById('pelayanan_id').select;
	xajax_list_data();
}
function hapus_kamar(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_kamar(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}