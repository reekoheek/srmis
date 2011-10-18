function focusFirst() {
	//document.getElementById('tgl_mulai_tgl').focus();
	//document.getElementById('tgl_mulai_tgl').select;
	list_data('0');
}
var timeoutId;
function list_data(hal) {
	clearTimeout(timeoutId);
	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
	timeoutId = setTimeout("list_data()", 600000);
}
function set_content_tab(obj, tab) {
	//obj.id='current';
	obj.parentNode.setAttribute('id','active');
	//obj.parentNode.removeAttribute('id');
	xajax_set_content_tab(tab);
}
function showNomor(objVal) {
	nmr = document.getElementById('input_nomor');
	if(objVal == '1'){
		nmr.readOnly = true;
		nmr.value='';
	} else {
		nmr.readOnly = false;
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
function get_diagnosa(diagnosa_id, nama) {
	document.getElementById('input_diagnosa_utama').value=diagnosa_id;
	document.getElementById('input_diagnosa_utama_nama').innerHTML=nama;
	tutup_diagnosa();
}

function clear_imunisasi(trigger) {
	document.getElementById(trigger).value='';
	document.getElementById(trigger + '_nama').innerHTML="&nbsp;";
}
function tutup_imunisasi() {
	enable_kunjungan();
	document.getElementById('form_cari_imunisasi').style.display='none';
}
function buka_imunisasi(trigger, btn) {
	disable_kunjungan();
	document.getElementById('imunisasi_trigger').value=trigger;
	document.getElementById('form_cari_imunisasi').style.display='';
	document.getElementById('add_btn_imunisasi_again').value=btn;
	fokus('imunisasi');
}
function get_imunisasi(im_id, nama, btn) {
	var trigger = document.getElementById('imunisasi_trigger').value;
	document.getElementById(trigger).value=im_id;
	document.getElementById(trigger + '_nama').innerHTML=nama;
	if(btn == '1') {
		var cnt = document.getElementById('jml_imunisasi').value;
		xajax_add_button_imunisasi(cnt);
	}
	tutup_imunisasi();
}

function clear_tindakan(trigger) {
	document.getElementById(trigger).value='';
	document.getElementById(trigger + '_nama').innerHTML="&nbsp;";
}
function tutup_tindakan() {
	enable_kunjungan();
	document.getElementById('form_cari_tindakan').style.display='none';
}
function buka_tindakan(trigger, btn) {
	disable_kunjungan();
	document.getElementById('tindakan_trigger').value=trigger;
	document.getElementById('form_cari_tindakan').style.display='';
	document.getElementById('add_btn_tindakan_again').value=btn;
	fokus('tindakan');
}
function get_tindakan(im_id, nama, btn) {
	var trigger = document.getElementById('tindakan_trigger').value;
	document.getElementById(trigger).value=im_id;
	document.getElementById(trigger + '_nama').innerHTML=nama;
	if(btn == '1') {
		var cnt = document.getElementById('jml_tindakan').value;
		xajax_add_button_tindakan(cnt);
	}
	tutup_tindakan();
}

function clear_bhp(trigger) {
	document.getElementById(trigger).value='';
	document.getElementById(trigger + '_nama').innerHTML="&nbsp;";
}
function tutup_bhp() {
	enable_kunjungan();
	document.getElementById('form_cari_bhp').style.display='none';
}
function buka_bhp(trigger, btn) {
	disable_kunjungan();
	document.getElementById('bhp_trigger').value=trigger;
	document.getElementById('form_cari_bhp').style.display='';
	document.getElementById('add_btn_bhp_again').value=btn;
	fokus('bhp');
}
function get_bhp(im_id, nama, btn) {
	var trigger = document.getElementById('bhp_trigger').value;
	document.getElementById(trigger).value=im_id;
	document.getElementById(trigger + '_nama').innerHTML=nama;
	if(btn == '1') {
		var cnt = document.getElementById('jml_bhp').value;
		xajax_add_button_bhp(cnt);
	}
	tutup_bhp();
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
function xcari_tindakan(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_tindakan('0',xajax.getFormValues('cari_tindakan'));
	}
    return true;
}
function xcari_imunisasi(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_imunisasi('0',xajax.getFormValues('cari_imunisasi'));
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
