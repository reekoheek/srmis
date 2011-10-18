function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_pengguna(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_pengguna(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
function get_pelayanan(val, sel) {
	if(!sel) sel = 0;
	if(val == '7') xajax_ref_get_pelayanan('pelayanan_id', 'RAWAT INAP', sel);
	else if(val == '8') xajax_ref_get_pelayanan('pelayanan_id', 'RAWAT JALAN', sel);
	else if(val == '12') xajax_ref_get_pelayanan('pelayanan_id', 'RUANG TINDAKAN', sel);
	else if(val == '9') {
		document.getElementById('pelayanan_id').options.length = 0;
		addOption('pelayanan_id','pelayanan_id_0','IRD','1','0','1');
		//document.getElementById('pelayanan_id_0').value = '1';//xajax_ref_get_pelayanan('pelayanan_id', 1);
	}
	else {
		//xajax_ref_get_pelayanan('pelayanan_id', 0);
		document.getElementById('pelayanan_id').options.length = 0;
		addOption('pelayanan_id','pelayanan_id_0','--- PILIH ---','','0','1');
	}
}