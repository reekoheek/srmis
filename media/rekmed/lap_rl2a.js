function focusFirst() {
	document.getElementById('tahun').focus();
	document.getElementById('tahun').select;
	xajax_get_lap_rl2a(xajax.getFormValues('lap_rl2a'));
}
function setDisable(obj) {
	if(obj.value == "tahun") {
		document.getElementById('tgl_periksa_tgl_start').disabled = true;
		document.getElementById('tgl_periksa_tgl_end').disabled = true;
		document.getElementById('tgl_periksa_bln_start').disabled = true;
		document.getElementById('tgl_periksa_bln_end').disabled = true;
	} else if (obj.value == "bulan")
	{
		document.getElementById('tgl_periksa_tgl_start').disabled = true;
		document.getElementById('tgl_periksa_tgl_end').disabled = true;
		document.getElementById('tgl_periksa_bln_start').disabled = false;
		document.getElementById('tgl_periksa_bln_end').disabled = false;
	} else {
		document.getElementById('tgl_periksa_tgl_start').disabled = false;
		document.getElementById('tgl_periksa_tgl_end').disabled = false;
		document.getElementById('tgl_periksa_bln_start').disabled = false;
		document.getElementById('tgl_periksa_bln_end').disabled = false;
	}
}