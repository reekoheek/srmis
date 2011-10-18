function focusFirst() {
	document.getElementById('penyakit').focus();
	document.getElementById('penyakit').select;
	xajax_get_kunjungan_check(xajax.getFormValues('statistik_kunjungan'));
}
function tutup_list_pasien() {
	document.getElementById('list_pasien').style.display='none';
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

function clear_diagnosa() {
	document.getElementById('input_diagnosa_utama').value="";
	document.getElementById('input_diagnosa_utama_nama').innerHTML="&nbsp;";
}
function tutup_diagnosa() {
	enable_mainbar();
	document.getElementById('form_cari_diagnosa').style.display='none';
	fokus('tampilkan');
}
function buka_diagnosa(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    //if (charCode == 13 || charCode == 9) { //enter
		disable_mainbar();
		document.getElementById('form_cari_diagnosa').style.display='';
		fokus('diagnosa');
	//}
    return true;
}
function get_diagnosa(diagnosa_id, nama) {
	document.getElementById('icd_id').value=diagnosa_id;
	document.getElementById('penyakit').value=nama;
	fokus('tampilkan');
	tutup_diagnosa();
}
function xcari_diagnosa(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 9) { //enter tab
		xajax_cari_diagnosa('0',xajax.getFormValues('cari_diagnosa'));
	}
    return true;
}