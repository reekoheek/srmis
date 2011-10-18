function focusFirst() {
	document.getElementById('tgl_mulai_tgl').focus();
	document.getElementById('tgl_mulai_tgl').select;
	list_data('0');
}
function list_data(hal) {
	xajax_list_data(hal, xajax.getFormValues('form_kunjungan'));
	//setTimeout("list_data()", 600000);
}

function kawin(val)
{
   var val = document.getElementById('status_nikah').value; 
   if(!val) {
			alert('Silakan Pilih Status Pernikahan.');
			fokus('status_nikah');
   } else if (val =='BELUM KAWIN')
		{
			document.getElementById('nama_suami').disabled=true;
            document.getElementById('nama_istri').disabled=true;
            document.getElementById('nama_suami').value='-';
            document.getElementById('nama_istri').value='-';
            document.getElementById('nama_ayah').focus();
		} else {
			document.getElementById('nama_suami').disabled=false;
            document.getElementById('nama_istri').disabled=false;
            document.getElementById('nama_suami').value='-';
            document.getElementById('nama_istri').value='-';
            document.getElementById('nama_ayah').focus();
			}
		
}

function showNomor(val) {
	nmr = document.getElementById('nomor');
	if(val == 'UMUM' || val == 'LAIN-LAIN' || val == 'DANA REKSA DESA' || val == 'KONTRAK' || val == 'undefined' || val == ''){
		nmr.readOnly = true;
		nmr.value='';
		setBgColor(nmr,'#F8F9F5');
	} else {
		nmr.readOnly = false;
		setBgColor(nmr,'#EEEEEE');
	}
}

function enable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#F8F9F5';
}

function disable_kunjungan() {
	document.getElementById('modal_kunjungan').style.backgroundColor='#E5E6E1';
}
var div_info_kamar = false;
function get_info_kamar(obj) {
	var pelayanan_id = obj.value;
	var kamar_id = document.getElementById('kamar_id').value;

	var atas = (ajaxTooltip_getTopPos(obj) - 20);
	var kiri = (ajaxTooltip_getLeftPos(obj) + obj.offsetWidth + 75);

	if(!div_info_kamar)	{
		div_info_kamar = document.createElement('DIV');
		div_info_kamar.style.position = 'absolute';
		div_info_kamar.style.width = '300px';
		div_info_kamar.style.height = 'auto';
		div_info_kamar.style.border = 'dotted 2px #FF0000';
		div_info_kamar.style.backgroundColor = '#FFFFFF';
		div_info_kamar.style.display = 'block';
		div_info_kamar.style.padding = '5px 5px 5px 5px';
		div_info_kamar.style.color = '#000000';
		div_info_kamar.style.overflow = 'visible';
		div_info_kamar.id = 'info_kamar';
		document.body.appendChild(div_info_kamar);
	}
	div_info_kamar.style.display = '';
	div_info_kamar.style.top = atas + 'px';
	div_info_kamar.style.left = kiri + 'px';
	xajax_get_info_kamar(pelayanan_id, 'kamar_id');
}
function hide_info_kamar() {
	if(div_info_kamar) {
		div_info_kamar.style.display = 'none';
		div_info_kamar.innerHTML = '';
	}
}
function hapus_kunjungan_kamar(idk, idkk, obj) {
	var tr = obj.parentNode.parentNode;
	tr.style.backgroundColor = '#FF3333';
	var konfirmasi = confirm("Yakin Akan Menghapus Data?");
	if(konfirmasi) {
		xajax_hapus_kunjungan_kamar(idk, idkk);
	}
	else {
		tr.style.backgroundColor = '';
		return;
	}
}