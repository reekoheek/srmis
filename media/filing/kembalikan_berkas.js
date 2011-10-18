var window_cetak_tracer;
function focusFirst() {
	document.getElementById('tgl_keluar_tgl').focus();
	document.getElementById('tgl_keluar_tgl').select;
	xajax_list_data(xajax.getFormValues('form_tracer'));
}
function setKembalikan(trId, obj) {
	if(obj.checked == true) {
		setBgColor2(trId, '#FFcc00');
	} else {
		setBgColor2(trId, '');
	}
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
function list_data() {
	var cek = document.getElementById('tanggal_ini').checked;
	if(cek == true) xajax_list_data(xajax.getFormValues('form_tracer'), '1');
	else xajax_list_data(xajax.getFormValues('form_tracer'), '0');
}
function tandai_semua_berkas(obj) {
	var jml = parseInt(document.getElementById('jml_baris').value);
	if(obj.checked == false) {
		for(i=0;i<jml;i++) {
			document.getElementById('kembalikan_' + i).checked = false;
			setKembalikan('tr_' + i, document.getElementById('kembalikan_' + i));
		}
	} else {
		for(i=0;i<jml;i++) {
			document.getElementById('kembalikan_' + i).checked = true;
			setKembalikan('tr_' + i, document.getElementById('kembalikan_' + i));
		}
	}
}