function focusFirst() {
	document.getElementById('belum_pulang').focus();
	document.getElementById('belum_pulang').select;
	list_data('0');
}
var timeoutId;
function list_data(hal) {
//	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
	/* clearTimeout(timeoutId);
	var semua_pasien = document.getElementById('semua_pasien').checked;
	setDisable(semua_pasien);
	if(semua_pasien == true) {
		xajax_list_data(hal, '1', xajax.getFormValues('form_kunjungan'));
	} else {
		xajax_list_data(hal, '0', xajax.getFormValues('form_kunjungan'));
	}
	timeoutId = setTimeout("list_data()", 600000); */
    xajax_list_data(hal, '0', xajax.getFormValues('form_kunjungan'));
    timeoutId = setTimeout("list_data()", 600000);
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
function clear_diagnosa() {
	document.getElementById('input_diagnosa_utama').value="";
	document.getElementById('input_diagnosa_utama_nama').innerHTML="&nbsp;";
}
function tutup_diagnosa() {
	enable_kunjungan();
	document.getElementById('form_cari_diagnosa').style.display='none';
}
function buka_diagnosa() {
	disable_kunjungan();
	document.getElementById('form_cari_diagnosa').style.display='';
	fokus('diagnosa');
}
function tutup_modal_lb() {
	document.getElementById('modal_lb').style.display='none';
	enable_mainbar();
}
function get_diagnosa(diagnosa_id, nama) {
	document.getElementById('input_diagnosa_utama').value=diagnosa_id;
	document.getElementById('input_diagnosa_utama_nama').innerHTML=nama;
	tutup_diagnosa();
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

function xcari_diagnosa(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_diagnosa('0',xajax.getFormValues('cari_diagnosa'));
	}
    return true;
}
function xcari_karcis(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_karcis('0',xajax.getFormValues('cari_karcis'), document.getElementById('icopim_kelas').value);
	}
    return true;
}
function xcari_icopim(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_icopim('0',xajax.getFormValues('cari_icopim'));
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
function kaliKan(inputId, val1, val2) {
	var val1 = parseFloat(val1);
	var val2 = parseFloat(val2);
	var hasil_kali;
	hasil_kali = val1 * val2;
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

function kaliKan3(inputId, val1, val2) {
	var val1 = parseFloat(val1);
	var val2 = parseFloat(val2);
	var hasil_kali;
	hasil_kali = val1 * val2;
	document.getElementById(inputId).value = hasil_kali.toFixed(2);
}

function tutup_karcis() {
	enable_kunjungan();
	document.getElementById('form_cari_karcis').style.display='none';
}
function buka_karcis(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_karcis').style.top = atas + 'px';
	document.getElementById('form_cari_karcis').style.display='';
	fokus('karcis');
}

function tutup_bhp() {
	enable_kunjungan();
	document.getElementById('form_cari_bhp').style.display='none';
}

function tutup_obat() {
	enable_kunjungan();
	document.getElementById('form_cari_bhp').style.display='none';
}

function buka_obat(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 400);
	document.getElementById('form_cari_bhp').style.top = atas + 'px';
	document.getElementById('form_cari_bhp').style.display='';
	fokus('bhp');
    
}

function buka_bhp(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_bhp').style.top = atas + 'px';
	document.getElementById('form_cari_bhp').style.display='';
	fokus('bhp');
}

function tutup_icopim() {
	enable_kunjungan();
	document.getElementById('form_cari_icopim').style.display='none';
}
function buka_icopim(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_icopim').style.top = atas + 'px';
	document.getElementById('form_cari_icopim').style.display='';
	fokus('icopim');
}
function hapus_kunjungan_kamar_icopim(idx, trId, tableId) {
	document.getElementById(trId).style.backgroundColor = '#FF3333';
	document.getElementById(tableId).style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		if(idx)	xajax_hapus_kunjungan_kamar_icopim(idx);
		remIt(trId);
		remIt(tableId);
	}
	else {
		document.getElementById(trId).style.backgroundColor = '';
		document.getElementById(tableId).style.backgroundColor = '';
	}
	return;
}
function cek_kosong(val) {
	if(val == '' || val == 'undefined') return false;
	else return true;
}
function simpan_kunjungan(arr) {
	var input_dokter_id = document.getElementById('input_dokter_id').value;
	if(cek_kosong(input_dokter_id) == false) {
		alert("Silakan Pilih Dokter");
		fokus('input_dokter_id');
	} else {
		xajax_simpan_kunjungan(arr);
	}
	return;
}
function tutup_kunjungan() {
	document.getElementById("modal_kunjungan").style.display = 'none';
	document.getElementById("input_diagnosa_utama_nama").innerHTML = '&nbsp;';
	
	document.getElementById("tbody_input_karcis").innerHTML = '';
	document.getElementById("tbody_input_icopim").innerHTML = '';
	document.getElementById("tbody_input_bhp").innerHTML = '';
	document.getElementById("data_pemberian_jasa").innerHTML = '';
	tutup_diagnosa();
	tutup_karcis();
	tutup_icopim();
	tutup_bhp();
	ref_clear_form('input_kunjungan');
	enable_mainbar();
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

function buka_daftar_penunjang(idkk, kelas) {
	document.getElementById('modal_daftar_penunjang').style.display='';
	document.getElementById('dp_idkk').value = idkk;
	document.getElementById('dp_kelas').value = kelas;
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
	fokus('belum_pulang');
}