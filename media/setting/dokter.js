function focusFirst() {
	document.getElementById('spesialisasi_id').focus();
	document.getElementById('spesialisasi_id').select;
	xajax_list_data();
}
function hapus_dokter(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_dokter(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
