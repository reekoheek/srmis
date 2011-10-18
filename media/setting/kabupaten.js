function focusFirst() {
	document.getElementById('propinsi_id').focus();
	document.getElementById('propinsi_id').select;
	xajax_list_data();
}
function hapus_kabupaten(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_kabupaten(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}


function show_prop(hal) {
	if(!hal) hal = '0';
	var pId = document.getElementById('propinsi_id').value;
	var ceked = document.getElementById('show_this_prop').checked;
	if(ceked == true) {
		xajax_list_data(hal, pId);
	} else {
		xajax_list_data(hal);
	}
}