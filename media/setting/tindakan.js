function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}
function hapus_tindakan(icid, idid, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data Biaya ?");
	var konfirmasi2 = confirm("Yakin Akan Menghapus Data Tindakan ?");
	if(konfirmasi) {
		if(konfirmasi2) xajax_hapus_tindakan(icid, idid);
		else xajax_hapus_tindakan('', idid);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}
function jumlahkan2(inputId, val1, val2, val3, val4) {
	document.getElementById(inputId).value = parseFloat(val1)+ parseFloat(val2) + parseFloat(val3)+ parseFloat(val4);
}
function jumlahkan() {
	var jasa_rumah_sakit = parseFloat(document.getElementById('jasa_rumah_sakit').value);
	var spesialis = parseFloat(document.getElementById('spesialis').value);
	var spesialis_pendamping = parseFloat(document.getElementById('spesialis_pendamping').value);
	var perawat_perinatologi = parseFloat(document.getElementById('perawat_perinatologi').value);
	var dr_umum = parseFloat(document.getElementById('dr_umum').value);
	var dr_gigi = parseFloat(document.getElementById('dr_gigi').value);
	var assisten_non_dokter = parseFloat(document.getElementById('assisten_non_dokter').value);
	var spesialis_anestesi = parseFloat(document.getElementById('spesialis_anestesi').value);
	var aknest = parseFloat(document.getElementById('aknest').value);
	var gizi = parseFloat(document.getElementById('gizi').value);
	var fisioterapi = parseFloat(document.getElementById('fisioterapi').value);
	var analis_pa = parseFloat(document.getElementById('analis_pa').value);
	var bidan = parseFloat(document.getElementById('bidan').value);
	var perawat = parseFloat(document.getElementById('perawat').value);
	var penunjang = parseFloat(document.getElementById('penunjang').value);
	var jml = jasa_rumah_sakit + spesialis + spesialis_pendamping +	perawat_perinatologi + dr_umum + dr_gigi + assisten_non_dokter + spesialis_anestesi + aknest + gizi + fisioterapi + analis_pa + bidan + perawat + penunjang;
	document.getElementById('biaya').value = jml;
}