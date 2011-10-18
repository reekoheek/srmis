// JavaScript Document
function pilih_status_kelanjutan(val){
	var val = document.getElementById('input_kelanjutan').value;
	alert(val);
	if(val=='DIRAWAT' || val=='PULANG'){
		document.getElementById('input_keadaan_keluar').option[0].selected=1;
		document.getElementById('input_keadaan_keluar').disabled=!document.getElementById('input_keadaan_keluar').disabled;
		document.getElementById('input_poli').disabled=!document.getElementById('input_poli').disabled;
	}
	else if (val=='DIRUJUK'){
		document.getElementById('input_keadaan_keluar').disabled=disabled;
		document.getElementById('input_poli').disabled=!document.getElementById('input_poli').disabled;
	}
	
	
}	