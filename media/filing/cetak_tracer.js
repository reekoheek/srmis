var window_cetak_tracer;
var timeoutId;
function focusFirst() {
	document.getElementById('jenis_tracer').focus();
	document.getElementById('jenis_tracer').select;
	list_data();
}
function list_data() {
	clearTimeout(timeoutId);
	var jenis = document.getElementById('jenis_tracer').value;
	var jml = document.getElementById('jml_tracer').value;
	var isAuto = '0';
	var autoCetak = document.getElementById('cetak_otomatis').checked;
	if(autoCetak == true) isAuto = '1';
	else isAuto = '0';
	var hanya_tanggal_ini = document.getElementById('hanya_tanggal_ini').checked;
	if(hanya_tanggal_ini == true) {
		var tgl = document.getElementById('tgl_periksa_tgl').value;
		var bln = document.getElementById('tgl_periksa_bln').value;
		var thn = document.getElementById('tgl_periksa_thn').value;
		var strTgl = thn + "-" + bln + "-" + tgl;
		xajax_list_data(jenis, jml, isAuto, strTgl);
	} else {
		xajax_list_data(jenis, jml, isAuto, '');
	}
	timeoutId = setTimeout("list_data()", 600000);
}
function buka_semua_kunjungan() {
	document.getElementById('list_semua_kunjungan').style.display='';
}
function tutup_semua_kunjungan() {
	document.getElementById('list_semua_kunjungan').style.display='none';
}

function cetak_tracer(urle, lebar, tinggi) {
	if(!lebar) lebar = 300;
	if(!tinggi) tinggi = 600;
    var windowFeatures = "width=" + lebar + ",height=" + tinggi + ",status=0,resizable=0,alwaysRaised=1,left=0,top=0,scrollbars=1";
	if (!window_cetak_tracer || window_cetak_tracer.closed) {
		window_cetak_tracer = window.open(urle,"tracer",windowFeatures);
	} else {
		window_cetak_tracer.focus();
	}
}
