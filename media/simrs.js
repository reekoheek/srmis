function backBgColor(tag, warna) {
	tag.style.backgroundColor = warna;
}
var lebarMonitor = screen.width;
var tinggiMonitor = screen.height;
var lebarTengah = lebarMonitor/2;
var tinggiTengah = tinggiMonitor/2;

var helpWindow;
function bukaHelp(helpUrl) {
    if (!helpWindow || helpWindow.closed) {
		var windowFeatures = "width=1,height=1,status=0,resizable=0,alwaysRaised=1,left=" + lebarTengah + ",top=" + tinggiTengah + ",scrollbars=1";
		helpWindow = window.open(helpUrl,"xxxx",windowFeatures);
    } else {
        helpWindow.focus();
    }
}

function focusNext(elemId, evt, elemBefore, elemThis) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
    if (charCode == 13) { //enter
		if (elemThis.type == "text" || elemThis.type == "button" || elemThis.type == "select-one" || elemThis.type == "password" || elemThis.type == "checkbox" || elemThis.type == "radio")
		{
			document.getElementById(elemId).focus();
			document.getElementById(elemId).select;
	        return false;
		} 
    } else if (charCode == 93) {
		if (elemThis.type == "text" || elemThis.type == "button" || elemThis.type == "select-one" || elemThis.type == "password" || elemThis.type == "textarea" || elemThis.type == "checkbox" || elemThis.type == "radio")
		{
			document.getElementById(elemBefore).focus();
			document.getElementById(elemBefore).select;
	        return false;
		} 
    } else if (charCode == 40 || charCode == 34) { //arrow down || pg down
		if (elemThis.type == "text" || elemThis.type == "button" || elemThis.type == "password" || elemThis.type == "textarea" || elemThis.type == "checkbox")
		{
			document.getElementById(elemId).focus();
			document.getElementById(elemId).select;
	        return false;
		} 
    } else if (charCode == 38 || charCode == 33) { //arrow up || pg up
		if (elemThis.type == "text" || elemThis.type == "button" || elemThis.type == "password" || elemThis.type == "textarea" || elemThis.type == "checkbox")
		{
			document.getElementById(elemBefore).focus();
			document.getElementById(elemBefore).select;
	        return false;
		} 
	}
    return true;
}

function numeralsOnly(obj, evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode : 
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode > 105 || charCode < 96)) {
		var val = parseInt(obj.value);
		if(val == "NaN" || val == "undefined" || !val) val = "";
		obj.value = val;
    }
    return true;
}
function hurufBesar(obj) {
	obj.value = obj.value.toUpperCase();
	return false;
}
function addOption(selectId,optionId,txt,val,defsel,sel)
{
	var objOption = new Option(txt,val,defsel,sel);
	objOption.id = optionId;
	//objOption.style.color = '#FF0000';
	//objOption.style.fontStyle = 'italic';
	document.getElementById(selectId).options.add(objOption);
}
/*
var _loader;
function show_loading(teks) {
	clearTimeout(_loader);
	document.getElementById('loading').style.top = (tinggiTengah-50) + 'px';
	document.getElementById('loading').style.left = (lebarTengah-100) + 'px';
	document.getElementById('loading_background').style.display = '';
	document.getElementById('loading').style.display = '';
	if(teks) {
		document.getElementById('loading_text').innerHTML = teks;
	} else document.getElementById('loading_text').innerHTML = 'Please Wait...';
	var _loader = setTimeout("remove_loading()", 1000);
}
function remove_loading() {
	document.getElementById('loading').style.display = 'none';
	document.getElementById('loading_background').style.display = 'none';
}
*/

function show_loading(teks) {
	document.getElementById('loading').style.top = (tinggiTengah-50) + 'px';
	document.getElementById('loading').style.left = (lebarTengah-100) + 'px';
	//document.getElementById('loading_background').style.display = '';
	document.getElementById('loading').style.display = '';
	if(teks) {
		document.getElementById('loading_text').innerHTML = teks;
	} else document.getElementById('loading_text').innerHTML = 'Please Wait...';
}
function remove_loading() {
	document.getElementById('loading').style.display = 'none';
	//document.getElementById('loading_background').style.display = 'none';
}
function disable_mainbar(warna) {
	//document.getElementById('sidebar').style.backgroundColor='#E6E7DE';
	if(!warna)
		document.getElementById('mainbar').style.backgroundColor='#E5E6E1';
	else document.getElementById('mainbar').style.backgroundColor= warna;
}

function enable_mainbar() {
	//document.getElementById('sidebar').style.backgroundColor='';
	document.getElementById('mainbar').style.backgroundColor='';
}
var timeoutStatusSimpan;
function show_status_simpan(teks) {
	clearTimeout(timeoutStatusSimpan);
	document.getElementById('status_simpan').style.top = (tinggiTengah-50) + 'px';
	document.getElementById('status_simpan').style.left = (lebarTengah-100) + 'px';
	document.getElementById('status_simpan').style.display = '';
	//document.getElementById('status_simpan').innerHTML = "Data Disimpan";
	var timeoutStatusSimpan = setTimeout("hide_status_simpan()", 1000);
}

function hide_status_simpan() {
	document.getElementById('status_simpan').style.display = 'none';
}
var window_cetak;
function cetak(urle, lebar, tinggi) {
	if(!lebar) lebar = 800;
	if(!tinggi) tinggi = 768;
    var windowFeatures = "width=" + lebar + ",height=" + tinggi + ",status=0,resizable=0,alwaysRaised=1,left=0,top=0,scrollbars=1";
	window_cetak = window.open(urle,"x",windowFeatures);
	window_cetak.focus();
}
var window_cetak2;
function cetak2(urle, lebar, tinggi) {
	if(!lebar) lebar = 800;
	if(!tinggi) tinggi = 768;
    var windowFeatures = "width=" + lebar + ",height=" + tinggi + ",status=0,resizable=0,alwaysRaised=1,left=0,top=0,scrollbars=1";
	window_cetak2 = window.open(urle,"x",windowFeatures);
	window_cetak2.focus();
}
function kopiPaste(input1Id, input2Id) {
	document.getElementById(input2Id).value = input1Id.value;
}
function getCookieVal(offset) {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1) {
        endstr = document.cookie.length;
    }
    return unescape(document.cookie.substring(offset, endstr));
}

function getCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg) {
            return getCookieVal(j);
        }
        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break; 
    }
    return "";
}
   
function setCookie(name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape (value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function showHideSidebar() {
	var status_skr = document.getElementById('sidebar').style.display;
	var lebar_mainbar = parseInt(document.getElementById('mainbar').style.width);
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('td_sidebar').style.display = 'none';
		document.getElementById('sidebar').style.display = 'none';
		setCookie('sidebar_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('td_sidebar').style.display = '';
		document.getElementById('sidebar').style.display = '';
		setCookie('sidebar_display', '', '', '/');
		chat_ganti_button("achat.png");
	}
}

function showHideInfoBar() {
	var status_skr = document.getElementById('infobar').style.display;
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('infobar').style.display = 'none';
		setCookie('infobar_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('infobar').style.display = '';
		setCookie('infobar_display', '', '', '/');
	}
}
function showHidePxHariIni() {
	var status_skr = document.getElementById('infobar_px_hari_ini').style.display;
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('infobar_px_hari_ini').style.display = 'none';
		setCookie('infobar_px_hari_ini_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('infobar_px_hari_ini').style.display = '';
		setCookie('infobar_px_hari_ini_display', '', '', '/');
	}
}
function showHideCariPx() {
	var status_skr = document.getElementById('infobar_cari_px').style.display;
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('infobar_cari_px').style.display = 'none';
		setCookie('infobar_cari_px_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('infobar_cari_px').style.display = '';
		setCookie('infobar_cari_px_display', '', '', '/');
	}
}
function showHideInfoBangsal() {
	var status_skr = document.getElementById('infobar_info_bangsal').style.display;
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('infobar_info_bangsal').style.display = 'none';
		setCookie('infobar_info_bangsal_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('infobar_info_bangsal').style.display = '';
		setCookie('infobar_info_bangsal_display', '', '', '/');
	}
}
function showHideChatBar() {
	var status_skr = document.getElementById('chatbar').style.display;
	if(status_skr == '') {
		//sembunyikan
		document.getElementById('chatbar').style.display = 'none';
		setCookie('chatbar_display', 'none', '', '/');
	} else {
		//tampilkan
		document.getElementById('chatbar').style.display = '';
		setCookie('chatbar_display', '', '', '/');
		fokus('chat_penerima_id');
	}
}

function readModule(mod) {
	document.getElementById('mainbar').innerHTML = mod;
}

function ref_clear_form(formId) {
	xajax_ref_clear_form(xajax.getFormValuesExcept(formId));
}
function setBgColor(obj,warna) {
	obj.style.backgroundColor = warna;
}
function setBgColor2(obj,warna) {
	var objx = document.getElementById(obj);
	objx.style.backgroundColor = warna;
}
function fokus(inputId) {
	document.getElementById(inputId).focus();
	document.getElementById(inputId).select;		
}
function remIt(divId) {
	var elem = document.getElementById(divId);
	elem.parentNode.removeChild(elem);
}

var aboutWindow;
function bukaAbout(aboutUrl) {
    if (!aboutWindow || aboutWindow.closed) {
		var windowFeatures = "width=1,height=1,status=0,resizable=0,alwaysRaised=1,left=" + lebarTengah + ",top=" + tinggiTengah + ",scrollbars=1";
		aboutWindow = window.open(aboutUrl,"xxx",windowFeatures);
    } else {
        aboutWindow.focus();
    }
}

function show_about() {
	document.getElementById('about').style.display = '';
	disable_mainbar();
}
function hide_about() {
	document.getElementById('about').style.display = 'none';
	enable_mainbar();
}