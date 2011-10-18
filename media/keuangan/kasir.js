function focusFirst() {
	document.getElementById('cara_bayar').focus();
	document.getElementById('cara_bayar').select;
	list_data('0');
}
var timeoutId;
function list_data(hal) {
	clearTimeout(timeoutId);
	var semua = document.getElementById('semua').checked;
	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
	timeoutId = setTimeout("list_data()", 600000);
}

function enable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#F8F9F5';
}

function disable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#E5E6E1';
}
function tutup_modal_lb() {
	document.getElementById('modal_lb').style.display='none';
	enable_mainbar();
}
function simpan_langsung_bayar() {
	var mampu = parseInt(document.getElementById('lb_mampu_bayar').value);
	if(mampu <= 0 || !mampu) {
		alert('Masukkan Nilai Pembayaran');
		fokus('lb_mampu_bayar');
	} else {
		xajax_simpan_langsung_bayar(xajax.getFormValues('form_lb'))
	}
}
function cetak_kwitansi(id_kwitansi) {
	cetak(URL + 'keuangan/kwitansi_cetak/?id_kwitansi=' + id_kwitansi, 500, 600);
}