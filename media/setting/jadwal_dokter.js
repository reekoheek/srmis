function focusFirst() {
	document.getElementById('pelayanan_id').focus();
	document.getElementById('pelayanan_id').select;
	xajax_list_data();
}
function hapus_jadwal_dokter(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_jadwal_dokter(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}

function cumaIni() {
	var spc = document.getElementById('pelayanan_id').value;
	var dok = document.getElementById('dokter_id').value;
	var har = document.getElementById('hari').value;
	var cekedSpc = document.getElementById('ceked_spc').checked;
	var cekedDok = document.getElementById('ceked_dok').checked;
	var cekedHar = document.getElementById('ceked_har').checked;
	if (cekedSpc || cekedDok || cekedHar)
	{
		xajax_list_data(0, spc, dok, har);
	} else {
		xajax_list_data(0);
	}
}
