function focusFirst() {
	document.getElementById('tgl_mulai_tgl').focus();
	document.getElementById('tgl_mulai_tgl').select;
	list_data('0');
}
function list_data(hal) {
	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
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

function xcari_kendaraan(obj, evt) {
    evt = (evt) ? evt : event;
	var jarak_tempuh = parseFloat(document.getElementById('input_jarak_tempuh').value);
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		if(!jarak_tempuh || jarak_tempuh == '0' || jarak_tempuh == 'undefined') {
			alert('Silakan Masukkan Jarak Tempuh');
			fokus('input_jarak_tempuh');
		} else {
			xajax_cari_kendaraan();
			buka_kendaraan(obj);
		}
	}
    return true;
}
function tutup_kendaraan() {
	enable_kunjungan();
	document.getElementById('form_cari_kendaraan').style.display='none';
}
function buka_kendaraan(obj) {
	disable_kunjungan();
	var atas = (ajaxTooltip_getTopPos(obj) - 200);
	document.getElementById('form_cari_kendaraan').style.top = atas + 'px';
	document.getElementById('form_cari_kendaraan').style.display='';
}

function hapus_kunjungan_kendaraan(idx, trId, tableId) {
	document.getElementById(trId).style.backgroundColor = '#FF3333';
	document.getElementById(tableId).style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		if(idx)	xajax_hapus_kunjungan_kendaraan(idx);
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
	var input_harga_bbm = document.getElementById('input_harga_bbm').value;
	var input_jarak_tempuh = document.getElementById('input_jarak_tempuh').value;
	//var langsung_bayar = document.getElementById('langsung_bayar').checked;
	if(cek_kosong(input_harga_bbm) == false) {
		alert("Silakan Masukkan harga BBM");
		fokus('input_harga_bbm');
	} else if(cek_kosong(input_jarak_tempuh) == false) {
		alert("Silakan Masukkan jarak yang ditempuh");
		fokus('input_jarak_tempuh');
	} else {
		xajax_simpan_kunjungan(arr);
	}
	return;
}

function tutup_kunjungan() {
	document.getElementById("modal_kunjungan").style.display = 'none';
	document.getElementById("input_diagnosa_utama_nama").innerHTML = '&nbsp;';
	
	document.getElementById("tbody_input_kendaraan").innerHTML = '';
	tutup_kendaraan();
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

function cetak_kwitansi(id_kwitansi) {
	cetak(URL + 'igd/kwitansi_cetak/?id_kwitansi=' + id_kwitansi, 350, 500);
}