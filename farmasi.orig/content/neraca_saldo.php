<?php
//$bulan=date("M");
$bln=$_POST['bulan'];
$thn=$_POST['tahun'];
if($bln=="01"){
		$bulan="Januari";
		}else
	if($bln=="02"){
		$bulan="Februari";
		}else
	if($bln=="03"){
		$bulan="Maret";
		}else
	if($bln=="04"){
		$bulan="April";
		}else
	if($bln=="05"){
		$bulan="Mei";
		}else
	if($bln=="06"){
		$bulan="Juni";
		}else
	if($bln=="07"){
		$bulan="Juli";
		}else
	if($bln=="08"){
		$bulan="Agustus";
		}else
	if($bln=="09"){
		$bulan="September";
		}else
	if($bln=="10"){
		$bulan="Oktober";
		}else
	if($bln=="11"){
		$bulan="November";
		}else
	if($bln=="12"){
		$bulan="Desember";
		}
$blnjurnal=$thn."-".$bulan."-";
$q1=mysql_query("select * from daftar_akun order by no_rek asc");
$deb=0;
$kre=0;
?>

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
			$.post("string_daftar_akun.php", {mysearchString: ""+inputString+""}, function(data){
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> Neraca Saldo </font></b></td>
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
							<table border="0" width="100%">
								<tr align="center">
									<td>NERACA SALDO</td>
								</tr>
								<tr align="center">
									<td>BHINEKA BAKTI HUSADA</td>
								</tr>
								<tr align="center">
									<td>per <? echo $bulan." ".$thn; ?></td>
								</tr>
								<tr align="center">
									<td>
							<table border="0" width="100%">
<tr align="center" bgcolor="#414141">
	<td width="80px"><font color="#FFFFFF">No. Rek</font></td>
	<td><font color="#FFFFFF">Nama Rekening</font></td>
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
</tr>
<?
$no = 1;
while($r1=mysql_fetch_array($q1))
{
 if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
 echo" 	<td align=center>$r1[no_rek]</td>
		<td align=left>$r1[nama_rek]</td>";
		$li_saldo=$r1["saldo_awal"]+$r1["saldo"];
		if($li_saldo>0)
		{
			$deb=$deb+$li_saldo;
		 echo"<td align=right>"; rupiah($li_saldo); echo"</td>
		 		<td>&nbsp;</td>";
		}else if($li_saldo<0)
		{
			$ss=str_replace("-","",$li_saldo);
			$kre=$kre-$li_saldo;
		 echo"<td>&nbsp;</td>
		 		<td align=right>"; rupiah($ss); echo"</td>";
		}else
		{
		 echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }
	echo"</tr>";
	$no++;
}
echo"<tr>
		<td>&nbsp;</td>
		<td align=right><strong>Jumlah</strong></td>
		<td align=right><strong>"; rupiah($deb); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre); echo"</strong></td>
	</tr>";
?>
</table>
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