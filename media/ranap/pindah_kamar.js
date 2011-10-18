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

function showNomor(val) {
	nmr = document.getElementById('nomor');
	if(val == 'UMUM' || val == 'LAIN-LAIN' || val == 'DANA REKSA DESA' || val == 'KONTRAK' || val == 'undefined' || val == ''){
		nmr.readOnly = true;
		nmr.value='';
	} else {
		nmr.readOnly = false;
	}
}


function enable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#F8F9F5';
}

function disable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#E5E6E1';
}
var div_info_kamar = false;
function get_info_kamar(obj) {
	var pelayanan_id = obj.value;
	var kamar_id = document.getElementById('kamar_id').value;

	var atas = (ajaxTooltip_getTopPos(obj) - 20);
	var kiri = (ajaxTooltip_getLeftPos(obj) + obj.offsetWidth + 75);

	if(!div_info_kamar)	{
		div_info_kamar = document.createElement('DIV');
		div_info_kamar.style.position = 'absolute';
		div_info_kamar.style.width = '300px';
		div_info_kamar.style.height = 'auto';
		div_info_kamar.style.border = 'dotted 2px #FF0000';
		div_info_kamar.style.backgroundColor = '#FFFFFF';
		div_info_kamar.style.display = 'block';
		div_info_kamar.style.padding = '5px 5px 5px 5px';
		div_info_kamar.style.color = '#000000';
		div_info_kamar.style.overflow = 'visible';
		div_info_kamar.id = 'info_kamar';
		document.body.appendChild(div_info_kamar);
	}
	div_info_kamar.style.display = '';
	div_info_kamar.style.top = atas + 'px';
	div_info_kamar.style.left = kiri + 'px';
	xajax_get_info_kamar(pelayanan_id, 'kamar_id');
}
function hide_info_kamar() {
	if(div_info_kamar) {
		div_info_kamar.style.display = 'none';
		div_info_kamar.innerHTML = '';
	}
}