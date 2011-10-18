function focusFirst() {
	document.getElementById('jenis').focus();
	document.getElementById('jenis').select;
	xajax_list_data();
}
function enadisa(objVal) {
	if(objVal == "2"){
		//rajal pake hari buka
		document.getElementById('hari_buka').readOnly = false;
	} else {
		document.getElementById('hari_buka').readOnly = true;
	}
}