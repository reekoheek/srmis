var window_cetak_tracer;
function focusFirst() {
	document.getElementById('no_rm').focus();
	document.getElementById('no_rm').select;
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
