function focusFirst() {
	document.getElementById('tgl_mulai_tgl').focus();
	document.getElementById('tgl_mulai_tgl').select;
	list_data('0');
}
var timeoutId;
function list_data(hal) {
	clearTimeout(timeoutId);
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
}
function xcari_pemeriksaan(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_pemeriksaan('0',xajax.getFormValues('cari_pemeriksaan'));
	}
    return true;
}

function xcari_bhp(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_bhp('0',xajax.getFormValues('cari_bhp'));
	}
    return true;
}
function kaliKan(inputId, val1, val2, val3) {
	var val1 = parseFloat(val1);
	var val2 = parseFloat(val2);
	var val3 = parseFloat(val3);
	var hasil_jml = val1+val2;
	var hasil_kali;
	hasil_kali = hasil_jml * val3;
	document.getElementById(inputId).value = hasil_kali.toFixed(2);
}
function kaliKan2(inputId, val1, val2, val3) {
	var val1 = parseFloat(val1);
	var val2 = parseFloat(val2);
	var val3 = parseFloat(val3);
	var hasil_kali;
	hasil_kali = val1 * val2 * val3;
	document.getElementById(inputId).value = hasil_kali.toFixed(2);
}
function tutup_pemeriksaan() {
	enable_kunjungan();
	document.getElementById('form_cari_pemeriksaan').style.display='none';
}
function buka_pemeriksaan(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_pemeriksaan').style.top = atas + 'px';
	document.getElementById('form_cari_pemeriksaan').style.display='';
	fokus('pemeriksaan');
}

function tutup_bhp() {
	enable_kunjungan();
	document.getElementById('form_cari_bhp').style.display='none';
}
function buka_bhp(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_bhp').style.top = atas + 'px';
	document.getElementById('form_cari_bhp').style.display='';
	fokus('bhp');
}

function cek_kosong(val) {
	if(val == '' || val == 'undefined') return false;
	else return true;
}
function simpan_kunjungan(arr) {
	xajax_simpan_kunjungan(arr);
	return;
}
function tutup_kunjungan() {
	document.getElementById("modal_kunjungan").style.display = 'none';
	
	document.getElementById("tbody_input_pemeriksaan").innerHTML = '';
	document.getElementById("tbody_input_bhp").innerHTML = '';
	tutup_pemeriksaan();
	tutup_bhp();
	ref_clear_form('input_kunjungan');
	enable_mainbar();
}

function langsung_bayar_mas(obj) {
	if(obj.checked == true) document.getElementById('fieldset_pembayaran').style.display = '';
	else document.getElementById('fieldset_pembayaran').style.display = 'none';
}


function hapus_kunjungan_bayar(idx, trId) {
	document.getElementById(trId).style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		if(idx)	xajax_hapus_kunjungan_bayar(idx);
		remIt(trId);
	}
	else {
		document.getElementById(trId).style.backgroundColor = '';
		return;
	}
}

function get_total(simpan_dulu) {
	xajax_get_total(xajax.getFormValues('input_kunjungan'), simpan_dulu);
}
function cetak_kwitansi(id_kwitansi) {
	cetak(URL + 'radio/kwitansi_cetak/?id_kwitansi=' + id_kwitansi, 350, 500);
}
function buka_daftar_penunjang(idkk) {
	document.getElementById('modal_daftar_penunjang').style.display='';
	document.getElementById('dp_idkk').value = idkk;
	xajax_buka_daftar_penunjang(idkk);
	disable_mainbar();
	fokus('dp_pengirim');
}
function tutup_daftar_penunjang() {
	document.getElementById('modal_daftar_penunjang').style.display='none';
	document.getElementById('dp_idkk').value = '';
	document.getElementById('dp_lab').checked = false;
	document.getElementById('dp_radio').checked = false;
	document.getElementById('dp_vk').checked = false;
	//xajax_ref_clear_form('form_daftar_penunjang');
	enable_mainbar();
}

function ke_kunjungan() {
	document.getElementById('modal_daftar_penunjang').style.display='none';
	document.getElementById('dp_idkk').value = '';
	document.getElementById('dp_lab').checked = false;
	//xajax_ref_clear_form('form_daftar_penunjang');
	xajax_buka_kunjungan();
}