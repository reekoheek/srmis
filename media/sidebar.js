var timeoutSidebar;
function get_sidebar_content() {
	clearTimeout(timeoutSidebar);
	chat_get_pesan();
	info_get_jml_pasien();
	//info_get_kamar_kosong();
	timeoutSidebar = setTimeout("get_sidebar_content()", 600000);
}
function chat_get_pesan(by_me) {
	if(!by_me) by_me = "no";
	xajax_chat_get_pesan(by_me);
}
function sendSmilies(gbr) {
	var arr = gbr.split("/");
	var lebar = arr.length;
	var lbr = parseInt(lebar)-1;
	var arr2 = arr[lbr];
	var arr3 = arr2.split(".");
	var kode = ":" + arr3[0] + ":";
	var lama = document.getElementById('chat_pesan').value;
	document.getElementById('chat_pesan').value = lama + kode;
	document.getElementById('chat_pesan').focus();
}
function chat_ganti_button(img) {
	document.getElementById('chatbar_button').src = IMAGES_URL + img;
}

function info_get_jml_pasien() {
	xajax_info_get_jml_pasien();
}
function info_get_kamar_kosong() {
	xajax_info_get_kamar_kosong();
}
var div_infobar_cari_px = false;
function infobar_cari_px_cari(obj, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode > 64 && charCode < 91 || charCode == 8 || charCode == 46) {
		var val = obj.value;
		var atas = (ajaxTooltip_getTopPos(obj) + 17);
		var kiri = (ajaxTooltip_getLeftPos(obj) + 10);

		if(!div_infobar_cari_px)	{
			div_infobar_cari_px = document.createElement('DIV');
			div_infobar_cari_px.style.position = 'absolute';
			div_infobar_cari_px.style.width = '555px';
			div_infobar_cari_px.style.height = 'auto';
			div_infobar_cari_px.style.border = 'dotted 2px #FF0000';
			div_infobar_cari_px.style.backgroundColor = '#FFFFFF';
			div_infobar_cari_px.style.display = 'block';
			div_infobar_cari_px.style.padding = '5px 5px 5px 5px';
			div_infobar_cari_px.style.color = '#000000';
			div_infobar_cari_px.style.overflow = 'visible';
			div_infobar_cari_px.id = 'infobar_cari_px_id';
			document.body.appendChild(div_infobar_cari_px);
		}
		div_infobar_cari_px.style.display = '';
		div_infobar_cari_px.style.top = atas + 'px';
		div_infobar_cari_px.style.left = kiri + 'px';
		xajax_infobar_cari_px_cari('infobar_cari_px_id', val);
	}
}
function hide_infobar_cari_px_cari() {
	if(div_infobar_cari_px) {
		div_infobar_cari_px.style.display = 'none';
		div_infobar_cari_px.innerHTML = '';
	}
}