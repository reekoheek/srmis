function focusFirst() {
	document.getElementById('belum_pulang').focus();
	document.getElementById('belum_pulang').select;
	list_data('0');
}
function list_data(hal) {
	var semua_pasien = document.getElementById('semua_pasien').checked;
	setDisable(semua_pasien);
	if(semua_pasien == true) {
		xajax_list_data(hal, '1', xajax.getFormValues('form_kunjungan'));
	} else {
		xajax_list_data(hal, '0', xajax.getFormValues('form_kunjungan'));
	}
	//setTimeout("list_data()", 600000);
}
function setDisable(semua_pasien) {
	if(semua_pasien == true) {
		document.getElementById('tgl_mulai_tgl').disabled = false;
		document.getElementById('tgl_mulai_bln').disabled = false;
		document.getElementById('tgl_mulai_thn').disabled = false;
		document.getElementById('tgl_selesai_tgl').disabled = false;
		document.getElementById('tgl_selesai_bln').disabled = false;
		document.getElementById('tgl_selesai_thn').disabled = false;
	} else {
		document.getElementById('tgl_mulai_tgl').disabled = true;
		document.getElementById('tgl_mulai_bln').disabled = true;
		document.getElementById('tgl_mulai_thn').disabled = true;
		document.getElementById('tgl_selesai_tgl').disabled = true;
		document.getElementById('tgl_selesai_bln').disabled = true;
		document.getElementById('tgl_selesai_thn').disabled = true;
	}
}
function enable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#F8F9F5';
}

function disable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#E5E6E1';
}
function tutup_daftar_tbi() {
	document.getElementById('list_daftar_tbi').style.display='none';
}