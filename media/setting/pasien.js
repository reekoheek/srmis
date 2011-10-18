function focusFirst() {
	document.getElementById('id').focus();
	document.getElementById('id').select;
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
function add_desa_combo(val) {
	if(val == "add_desa") {
		var id_propinsi = document.getElementById('propinsi_id').value;
		var id_kabupaten = document.getElementById('kabupaten_id').value;
		var id_kecamatan = document.getElementById('kecamatan_id').value;
		if(!id_propinsi) {
			alert('Silakan Pilih Propinsi dan Kabupaten.');
			fokus('propinsi_id');
		} else if (!id_kabupaten) {
			alert('Silakan Pilih Kabupaten.');
			fokus('kabupaten_id');
		} else if(!id_kecamatan) {
			alert('Silakan Pilih Kecamatan.');
			fokus('kabupaten_id');
		} else {
			var nama = prompt('Kelurahan');
			if(nama && nama != "undefined") {
				xajax_add_desa_check(id_kecamatan, nama);
			} else {
				document.getElementById('desa_id').options[0].selected=1;
			}
		}
	}
}
function add_perujuk_combo(val) {
	if(val == "add_perujuk") {
		var nama = prompt('Nama Perujuk');
		var alamat = prompt('Alamat Perujuk');
		if(nama && nama != "undefined" && alamat && alamat != "undefined") {
			xajax_ref_add_perujuk_check(nama, alamat);
		} else {
			document.getElementById('perujuk_id').options[0].selected=1;
		}
	}
}
function show_hide_form(divIdShow) {
	var gbr = document.getElementById('gbr_cari');
	var arr_gambar = gbr.src.split("/");
	var lebar_arr_gambar = (arr_gambar.length)-1;
	if(divIdShow) {
		if(divIdShow =="form_tambah") {
			document.getElementById('judul').innerHTML = 'Administrasi Data Pasien';
			document.getElementById('form_tambah').style.display = '';
			document.getElementById('form_cari').style.display = 'none';
			arr_gambar[lebar_arr_gambar] = 'search.png';
			var x = arr_gambar.join("/");
			gbr.alt = "Cari Pasien";
			gbr.src = x;
			fokus('id');
		} else {
			document.getElementById('judul').innerHTML = 'Pencarian pasien';
			document.getElementById('form_tambah').style.display = 'none';
			document.getElementById('form_cari').style.display = '';
			arr_gambar[lebar_arr_gambar] = 'back.png';
			var x = arr_gambar.join("/");
			gbr.alt = "Tambah Pasien";
			gbr.src = x;
			fokus('cari_id');
		}
	} else {
	
		var form_tambah = document.getElementById('form_tambah').style.display;
		var form_cari = document.getElementById('form_cari').style.display;
		if(form_cari == "none") {
			document.getElementById('judul').innerHTML = 'Pencarian Pasien';
			document.getElementById('form_tambah').style.display = 'none';
			document.getElementById('form_cari').style.display = '';
			arr_gambar[lebar_arr_gambar] = 'back.png';
			var x = arr_gambar.join("/");
			gbr.alt = "Tambah Pasien";
			gbr.src = x;
			fokus('cari_id');
		} else {
			document.getElementById('judul').innerHTML = 'Administrasi Data Pasien';
			document.getElementById('form_tambah').style.display = '';
			document.getElementById('form_cari').style.display = 'none';
			arr_gambar[lebar_arr_gambar] = 'search.png';
			var x = arr_gambar.join("/");
			gbr.alt = "Cari Pasien";
			gbr.src = x;
			fokus('id');
		}
	}
}
function get_pasien_from_no_rm(no_rm, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13 || charCode == 3 || charCode == 9) {
		xajax_get_pasien(no_rm);
		return false;
    }
	return true;
}

function showNomor(obj) {
	nmr = document.getElementById('nomor');
	if(obj.value == 'UMUM' || obj.value == 'undefined' || obj.value == ''){
		nmr.readOnly = true;
		nmr.value='';
	} else {
		nmr.readOnly = false;
	}
}
function hapus_pasien(idx, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_pasien(idx);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}