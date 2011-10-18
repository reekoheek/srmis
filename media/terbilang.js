function kekata(s) {
	var x = Math.floor(Math.abs(s));
	var temp;
	var angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];
	var temp = "";
	if (x <12) {
		temp = " " + angka[x];
	} else if (x <20) {
		temp = kekata(x - 10) + " belas";
	} else if (x <100) {
		temp = kekata(x/10) + " puluh" + kekata(x % 10);
	} else if (x <200) {
		temp = " seratus" + kekata(x - 100);
	} else if (x <1000) {
		temp = kekata(x/100) + " ratus" + kekata(x % 100);
	} else if (x <2000) {
		temp = " seribu" + kekata(x - 1000);
	} else if (x <1000000) {
		temp = kekata(x/1000) + " ribu" + kekata(x % 1000);
	} else if (x <1000000000) {
		temp = kekata(x/1000000) + " juta" + kekata(x % 1000000);
	} else if (x <1000000000000) {
		temp = kekata(x/1000000000) + " milyar" + kekata(x % 1000000000);
	} else if (x <1000000000000000) {
		temp = kekata(x/1000000000000) + " trilyun" + kekata(x % 1000000000000);
	}
	return temp;
}
function terbilang(x) {
	var hasil;
    if(x<0) {
        hasil = "MINUS " + kekata(x) + " rupiah";
    } else if(x == "") {
		return;
	} else {
        hasil = kekata(x);
    }
	return hasil + " rupiah";
}

function writeTerbilang(divId, x) {
	var hasil;
    if(x<0) {
        hasil = "minus " + kekata(x) + " rupiah";
    } else if(x == '' || x == ' ' || x == '\n' || x == '\r' || x == '\t' || x == '\f' || x == '\v' || x == '\b' || x == '0.00 ' || x == '0.00' || x == '0') {
		hasil = "";
	} else {
        hasil = kekata(x) + " rupiah";
    }
	document.getElementById(divId).innerHTML = hasil;
}