function focusFirst() {
	document.getElementById('tgl_mulai_tgl').focus();
	document.getElementById('tgl_mulai_tgl').select;
	list_data('0');
}
function list_data(hal) {
	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
}
function showNomor(val) {
	nmr = document.getElementById('input_nomor');
	if(val == 'UMUM' || val == 'LAIN-LAIN' || val == 'DANA REKSA DESA' || val == 'KONTRAK' || val == 'undefined' || val == ''){
		nmr.readOnly = true;
		nmr.value='';
		setBgColor(nmr,'#F8F9F5');
	} else {
		nmr.readOnly = false;
		setBgColor(nmr,'#EEEEEE');
	}
}
function hapus_kunjungan_kamar(kunjungan_id, kunjungan_kamar_id, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data Kunjungan Ini?");
	if(konfirmasi) {
		xajax_hapus_kunjungan_kamar(kunjungan_id, kunjungan_kamar_id);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}