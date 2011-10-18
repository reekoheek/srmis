function focusFirst() {
	document.getElementById('nama').focus();
	document.getElementById('nama').select;
	xajax_list_data();
}

function add_kabupaten_combo(val) {
	if(val == "add_kabupaten") {
		var id_propinsi = document.getElementById('propinsi_id').value;
		if(!id_propinsi) {
			alert('Silakan Pilih Propinsi dan Kabupaten.');
			fokus('propinsi_id');
		} else {
			var nama = prompt('Kabupaten');
			if(nama && nama != "undefined") {
				xajax_add_kabupaten_check(id_propinsi, nama);
			} else {
				document.getElementById('kabupaten_id').options[0].selected=1;
			}
		}
	}
}

function add_kecamatan_combo(val) {
	if(val == "add_kecamatan") {
		var id_propinsi = document.getElementById('propinsi_id').value;
		var id_kabupaten = document.getElementById('kabupaten_id').value;
		if(!id_propinsi) {
			alert('Silakan Pilih Propinsi dan Kabupaten.');
			fokus('propinsi_id');
		} else if (!id_kabupaten)
		{
			alert('Silakan Pilih Kabupaten.');
			fokus('kabupaten_id');
		} else {
			var nama = prompt('Kecamatan');
			if(nama && nama != "undefined") {
				xajax_add_kecamatan_check(id_kabupaten, nama);
			} else {
				document.getElementById('kecamatan_id').options[0].selected=1;
			}
		}
	}
}


function show_hide_form(divIdShow) {
	var gbr = document.getElementById('gbr_cari');
	var arr_gambar = gbr.src.split("/");
	var lebar_arr_gambar = (arr_gambar.length)-1;
	if(divIdShow) {
		if(divIdShow =="form_tambah") {
			document.getElementById('form_tambah').style.display = '';
			document.getElementById('form_cari').style.display = 'none';
			arr_gambar[lebar_arr_gambar] = 'find.gif';
			var x = arr_gambar.join("/");
			gbr.alt = "Cari Pasien";
			gbr.src = x;
			fokus('nama');
		} else {
			document.getElementById('form_tambah').style.display = 'none';
			document.getElementById('form_cari').style.display = '';
			arr_gambar[lebar_arr_gambar] = 'add.gif';
			var x = arr_gambar.join("/");
			gbr.alt = "Tambah Pasien";
			gbr.src = x;
			fokus('cari_nama');
		}
	} else {
	
		var form_tambah = document.getElementById('form_tambah').style.display;
		var form_cari = document.getElementById('form_cari').style.display;
		if(form_cari == "none") {
			document.getElementById('form_tambah').style.display = 'none';
			document.getElementById('form_cari').style.display = '';
			arr_gambar[lebar_arr_gambar] = 'add.gif';
			var x = arr_gambar.join("/");
			gbr.alt = "Tambah Pasien";
			gbr.src = x;
			fokus('cari_nama');
		} else {
			document.getElementById('form_tambah').style.display = '';
			document.getElementById('form_cari').style.display = 'none';
			arr_gambar[lebar_arr_gambar] = 'find.gif';
			var x = arr_gambar.join("/");
			gbr.alt = "Cari Pasien";
			gbr.src = x;
			fokus('nama');
		}
	}
}
/*
function add_kecamatan() {
	var id_propinsi = document.getElementById('propinsi_id').value;
	var id_kabupaten = document.getElementById('kabupaten_id').value;
	if(!id_propinsi) {
		alert('Silakan Pilih Propinsi dan Kabupaten.');
		fokus('propinsi_id');
	} else if (!id_kabupaten)
	{
		alert('Silakan Pilih Kabupaten.');
		fokus('kabupaten_id');
	} else {
		var nama = prompt('Kecamatan');
		if(nama && nama != "undefined") {
			xajax_add_kecamatan_check(id_kabupaten, nama);
		}
	}
}
*/