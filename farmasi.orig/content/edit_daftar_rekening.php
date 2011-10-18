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
			$.post("action/string_daftar_bpb.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->



</head>
<body>

<?
$no_rek=$_GET['no_rek'];
$q1=mysql_query("select * from daftar_akun where no_rek='$no_rek'");
$r1=mysql_fetch_array($q1);
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Update Daftar Rekening </font></b></td>
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
							<form id="form1" name="form1" method="post" action="home.php?hal=action/update_rekening">
  <table width="493" border="0">
    <tr>
      <td width="192">No. Rek </td>
      <td width="291"><label>
        <input name="no_rek" type="text" id="no_rek" size="10" maxlength="5" value="<?=$r1['no_rek']?>" readonly="true"/>
      </label></td>
    </tr>
    <tr>
      <td>Nama Rekening </td>
      <td><label>
        <input name="nama_rek" type="text" id="nama_rek" value="<?=$r1['nama_rek']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td><label>
        <select name="kategori" id="kategori">
		<? if($r1['type']=='Aktiva'){ ?>
          <option value="1" selected="selected">1 - Aktiva</option>
          <option value="2">2 - Kewajiban</option>
          <option value="3">3 - Modal</option>
          <option value="4">4 - Pendapatan</option>
          <option value="5">5 - Beban</option> <? }else 
		  if($r1['type']=='Pasiva'){ ?>
		  <option value="1">1 - Aktiva</option>
          <option value="2" selected="selected">2 - Kewajiban</option>
          <option value="3">3 - Modal</option>
          <option value="4">4 - Pendapatan</option>
          <option value="5">5 - Beban</option> <? }else 
		  if($r1['type']=='Modal'){ ?>
		  <option value="1">1 - Aktiva</option>
          <option value="2">2 - Kewajiban</option>
          <option value="3" selected="selected">3 - Modal</option>
          <option value="4">4 - Pendapatan</option>
          <option value="5">5 - Beban</option> <? }else 
		  if($r1['type']=='Pendapatan'){ ?>
		  <option value="1">1 - Aktiva</option>
          <option value="2">2 - Kewajiban</option>
          <option value="3">3 - Modal</option>
          <option value="4" selected="selected">4 - Pendapatan</option>
          <option value="5">5 - Beban</option> <? }else 
		  if($r1['type']=='Beban'){ ?>
		  <option value="1">1 - Aktiva</option>
          <option value="2">2 - Kewajiban</option>
          <option value="3">3 - Modal</option>
          <option value="4">4 - Pendapatan</option>
          <option value="5" selected="selected">5 - Beban</option> <? } ?>
        </select>
      </label></td>
    </tr>
	<tr>
      <td>Saldo Awal </td>
      <td><label>
        <input name="saldo_awal" type="text" id="nama_rek" value="<?=$r1['saldo_awal']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="Simpan" type="submit" id="Simpan" value="Simpan" />
        <input name="Batal" type="reset" id="Batal" value="Batal" onClick="javascript:history.back(1)"/>
      </label></td>
    </tr>
  </table>
</form>
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