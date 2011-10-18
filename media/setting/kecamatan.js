function focusFirst() {
	document.getElementById('propinsi_id').focus();
	document.getElementById('propinsi_id').select;
	xajax_list_data();
}
function hapus_kecamatan(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_kecamatan(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}

function show_this_only(hal) {
	if(!hal) hal = '0';
	var pId = document.getElementById('propinsi_id').value;
	var kId = document.getElementById('kabupaten_id').value;
	var cekedProp = document.getElementById('show_this_prop').checked;
	var cekedKab = document.getElementById('show_this_kab').checked;

	if(cekedProp && cekedKab == false) {
		xajax_list_data(hal, pId, '0');
	} else if(cekedProp && cekedKab) {
		xajax_list_data(hal, pId, kId);
	} else {
		xajax_list_data(hal);
	}

}