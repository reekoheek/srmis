<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<!-- suggestion -->
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_daftar_akun.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue,thisValue2) {
		$('#inputString').val(thisValue);
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->

<style>
.suggestionsBox {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}

</style>



</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Input Jurnal Umum </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="center">
							
	<form id="form1" name="form1" method="post" action="home.php?hal=action/simpan_jurnal_umum_detail">
  <table width="500" border="0" align="left">
    <tr>
      <td width="162">Tanggal</td>
      <td width="528"><label>
        <input name="tanggal" id="date1" class="date-pick" readonly="true" />
      </label></td>
    </tr>
    <tr>
      <td>No. Rek </td>
      <td><label>
        <input type="text" name="no_rek" id="inputString" onKeyUp="lookup(this.value);" onblur="fill();"/><div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div>
      </label></td>
    </tr>
    <tr>
      <td>Nama Rekening </td>
      <td><label>
        <input name="nama_rek" type="text" id="inputString2" onKeyUp="lookup(this.value);" onblur="fill();" />
		<div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div>
      </label></td>
    </tr>
    <tr>
      <td>Keterangan</td>
      <td><label>
        <input name="keterangan" type="text" id="keterangan" />
      </label></td>
    </tr>
    <tr>
      <td>Debit</td>
      <td><label>
        <input name="debit" type="text" id="debit" />
      </label></td>
    </tr>
    <tr>
      <td>Kredit</td>
      <td><label>
        <input name="kredit" type="text" id="kredit" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Simpan" />
        <input type="reset" name="Submit2" value="Batal" />
      </label></td>
    </tr>
  </table>
</form>
</td>
<td valign="top">
							<table border="0" width="100px" align="right">
							<tr>
							<td align="right"><form method="post" action="home.php?hal=content/daftar_akun">
								<input type="submit" value="Daftar Rekening" name="input_rekening" size="70%">
							</form>
							</td>
							</tr>
							<tr>
							<td align="right"><form method="post" action="home.php?hal=content/jurnal_umum">
								<input type="submit" value="Jurnal Umum" name="jurnal" size="70%">
							</form>
							</td>
							</tr>
							</table>
							</td>
						</tr>
						<tr>
							<td align="center">
							
							</td>
						</tr>
					</table>
					</div>
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
		</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>

</html>