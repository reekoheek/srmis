<?php
if(!$_POST['caribulan']){
$bulan=date("M");
$bln=date("m");
$thn=date("Y");

}
else
{
	$bln=$_POST['caribulan'];
	$thn=$_POST['carithn'];
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
}
$blnjurnal=$thn."-".$bln."-";
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> Jurnal Penyesuaian </font></b></td>
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
							
							<table border="0" width="600px">
							<tr>
	<td><div align="left"><form action="home.php?hal=content/jurnal_penyesuaian" method="post">Lihat Jurnal Bulan : 
	      <label>
	      <select name="caribulan" id="caribulan">
	        <option value="01">Januari</option>
	        <option value="02">Februari</option>
	        <option value="03">Maret</option>
	        <option value="04">April</option>
	        <option value="05">Mei</option>
	        <option value="06">Juni</option>
	        <option value="07">Juli</option>
	        <option value="08">Agustus</option>
	        <option value="09">September</option>
	        <option value="10">Oktober</option>
	        <option value="11">November</option>
	        <option value="12">Desember</option>
	        </select>
	      </label>
	      <label>
	      <input name="carithn" type="text" size="8" maxlength="4" value="(tahun)">
	      </label>
	      <label>
	      <input name="Lihat" type="submit" id="Lihat" value="Lihat">
	      </label>
	</form></div></td><td><form method="post" action="home.php?hal=content/input_jurnal_penyesuaian"><input type="submit" value="Input Jurnal"></form></td>
	<td>
	<form method="post" action="home.php?hal=action/hitung_penyesuaian">
	<input type="hidden" name="bulan" value="<?=$bln?>">
	<input type="hidden" name="tahun" value="<?=$thn?>">
	<input type="submit" value="Simpan Ke Neraca Lajur">
	</form></td>
	</tr>
	</table><hr></hr>
							
							
							
	<table width="700" border="0">
  <tr>
    <td><div align="center">BHINNEKA BAKTI HUSADA </div></td>
  </tr>
  <tr>
    <td><div align="center">JURNAL PENYESUAIAN </div></td>
  </tr>
  <tr>
    <td><div align="center">per <? echo $bulan." ".$thn; ?> </div></td>
  </tr>
  <tr>
    <td><div align="center">
	<table border="0" width="90%">
	<tr bgcolor="#414141" align="center">
		<td><font color="#FFFFFF">Tanggal</font></td>
		<td><font color="#FFFFFF">Kode</font></td>
		<td><font color="#FFFFFF">Nama Rekening</font></td>
		<td><font color="#FFFFFF">Keterangan</font></td>
		<td><font color="#FFFFFF">Debit</font></td>
		<td><font color="#FFFFFF">Kredit</font></td>
		<td><font color="#FFFFFF">Action</font></td>
		<?php
			$no = 1;
		 	$q1=mysql_query("select * from jurnal_penyesuaian where tgl like '$blnjurnal%'");
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
			 echo"<td>$r1[tgl]</td>
					<td>$r1[no_rek]</td>";
					if($r1['flags']==1)
					{
					 echo"<td align=right>$r1[nama_rek]</td>";
					}
					else if($r1['flags']==2)
					{
					 echo"<td align=left>$r1[nama_rek]</td>";
					}
			 echo"<td>$r1[keterangan]</td>
			 		<td align=right>"; rupiah($r1['debit']); echo"</td>
					<td align=right>"; rupiah($r1['kredit']); echo"</td>
					<td align=center><a href='home.php?hal=action/hapus_jurnal_penyesuaian&id=$r1[id]'>Hapus</a></td>
					</tr>";
				$no++;
			}
			echo"</table>";
		?>
	</div></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
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