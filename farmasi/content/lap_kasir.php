<?php
$tdy=$_GET['date'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>


</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa" style="font-size:14px; "> Laporan Kasir </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<div align="center" style="border:0px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">
					<table width="100%" border="0">
  						<tr>
    						<td>&nbsp;
								Tanggal : <? $date=date("d - M - Y"); echo $date;?>
							</td>
    					</tr>
  						<tr>
    						<td>
							<form id="form1" name="form1" method="post" action="home.php?hal=content/ke_lap_kasir&tgl=<? echo $tgl; ?>">
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp; Laporan Transaksi Resep &nbsp;</legend>
							
							<table width="90%" border="0" align="center" height="40px">
								<tr valign="middle">
									<td>Dari</td>
									<td> : </td>
									<td><INPUT name="tgl1" id="date1" class="date-pick" readonly="true" value="<? echo $tdy; ?>"></td>
									<td>&nbsp; - &nbsp;</td>
									<td>Sampai</td>
									<td> : </td>
									<td><INPUT name="tgl2" id="date2" class="date-pick" readonly="true" value="<? echo $tdy; ?>"></td>
									<td><select name="shifting">
										<option value="0">--Pilihan--</option>
										<?php
										$qshift=mysql_query("select * from shift_karyawan ORDER by ID");
										while($rshift=mysql_fetch_array($qshift))
										{
											echo"<option value=$rshift[id]>$rshift[nama]</option>";
										}
									?>
									</select></td>&nbsp;
										<td><input type="submit" name="submit" value="Cetak Laporan Kasir" />
									</td>
								
								</tr>
							</table>
							</fieldset></center>
							</form>    
							</td>
  						</tr>
					</table>
					</div>			
					</font>
					
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<!--
					<table width="90%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					
					
					<table width="30%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<table width="10%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					--!>
					<? //laporan parkir ?>
					<font style="font-size:12px;">
					<div align="center" style="border:0px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">
					<table width="100%" border="0">
  						<tr>
    						<td>
							<form id="form2" name="form2" method="post" action="home.php?hal=content/ke_lap_parkir&tgl=<? echo $tgl; ?>">
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp; Laporan Parkir &nbsp;</legend>
							<table width="75%" border="0" align="center" height="40px">
								<tr valign="middle">
									<td>Dari</td>
									<td> : </td>
									<td><INPUT name="tgl1" id="date1" class="date-pick" readonly="true" value="<? echo $tdy; ?>"></td>
									<td>&nbsp; - &nbsp;</td>
									<td>Sampai</td>
									<td> : </td>
									<td><INPUT name="tgl2" id="date2" class="date-pick" readonly="true" value="<? echo $tdy; ?>">&nbsp;&nbsp;&nbsp;
										<input type="submit" name="submit" value="Cetak Laporan Parkir" />
									</td>
								
								</tr>
							</table>
							</fieldset>
							</center>
							</form>    
							</td>
  						</tr>
					</table>
					</div>			
					</font>
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<table width="90%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td><hr /></td>
						</tr>
					</table>
					<font style="font-size:12px;">
					<div align="center" style="border:0px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">
					<table width=100% border=0>
						<tr>
							<td>
							<form id="form3" name="form3" method="post" action="home.php?hal=action/ke_jml_obat_terpakai&tgl=<? echo $tgl; ?>">
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp; Laporan Penggunaan Obat &nbsp;</legend>
							<table width="75%" border="0" align="center" height="40px">
								<tr valign="middle">
									
									<td align="right">Tanggal : </td>
									<td align="left"><INPUT name="tgl1" id="date1" class="date-pick" readonly="true" value="<? echo $tdy; ?>">
									</td>
									<td>&nbsp; - &nbsp;</td>
									<td>Sampai</td>
									<td> : </td>
									<td><INPUT name="tgl2" id="date2" class="date-pick" readonly="true" value="<? echo $tdy; ?>"></td>
									<td><select name=shift_jml>
									<option value=0>--Pilihan--</option>
									<?php
										$qshift=mysql_query("select * from shift_karyawan ORDER by ID");
										while($rshift=mysql_fetch_array($qshift))
										{
											echo"<option value=$rshift[id]>$rshift[nama]</option>";
										}
									?>
									</select></td>
									<td>
										<input type="submit" name="submit" value="Cetak" />
									</td>
								
								</tr>
							</table>
							</fieldset>
							</center>
							</form>    
							</td>
						</tr>
					</table>
					</font>
					</div>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>

</html>