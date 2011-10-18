<?php
$tdy=$_GET['date'];
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Untitled Document</title>


</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa" style="font-size:14px; "> Laporan Distribusi </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"/></td>
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
    						<td>
							
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp;[ Laporan Distribusi ]&nbsp;</legend>
							
							<table width="100%" align="center">
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_obat.php">
											<table border="0" cellpadding="0" cellspacing="0" width="60%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left" width="100px"><input type="submit" value="Laporan Excel"/></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_obat_pdf.php">			
											<table border="0" cellpadding="0" cellspacing="0" width="60%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left" width="100px"><input type="submit" value="Laporan PDF"/></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
							</fieldset></center>
							  
							</td>
  						</tr>
					</table>
					</div>			
					</font>
					
					
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td height="40px">&nbsp;</td>
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
					<? //laporan distribusi per unit ?>
					<font style="font-size:12px;">
					<div align="center" style="border:0px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">
					<table width="100%" border="0">
  						<tr>
    						<td>
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp;[ Laporan Distribusi Unit ]&nbsp;</legend>
							<table align="center" width="100%">
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_unit.php">			
											<table border="0" cellpadding="0" cellspacing="0" width="82%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left">
														<select name="unit">
															<option value="">--Pilih--</option>
															<option value="2">Apotik</option>
															<option value="51">IGD</option>
															<option value="52">OKA</option>
															<option value="4">Rawat Jalan</option>
															<option value="50">Rawat Inap</option>
															<option value="87">Laboratorium</option>
															<option value="91">Radiologi</option>
														</select>
													</td> 
													<td align="left" width="100px"><input type="submit" value="Laporan Excel"></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_unit_pdf.php">			
											<table border="0" cellpadding="0" cellspacing="0" width="82%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left">
														<select name="unit">
															<option value="">--Pilih--</option>
															<option value="2">Apotik</option>
															<option value="51">IGD</option>
															<option value="52">OKA</option>
															<option value="4">Rawat Jalan</option>
															<option value="50">Rawat Inap</option>
															<option value="87">Laboratorium</option>
															<option value="91">Radiologi</option>
														</select>
													</td> 
													<td align="left" width="100px"><input type="submit" value="Laporan PDF"></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
							</fieldset>
							</center>    
							</td>
  						</tr>
					</table>
					</div>			
					</font>
					
					<table width="60%" cellspacing="0" cellpadding="0" border="0" align="center">
						<tr>
							<td height="40px">&nbsp;</td>
						</tr>
					</table>
					
					
					<!-- laporan distribusi per pabrik-->
					<font style="font-size:12px;">
					<div align="center" style="border:0px  solid  #CCCCCC; width:100%; height:100%; overflow:auto;">
					<table width="100%" border="0">
  						<tr>
    						<td>
							<center>
							<fieldset style="border:1px  solid  #CCCCCC;">
							<legend>&nbsp;[ Laporan Distribusi Berdasarkan Pabrik ]&nbsp;</legend>
							<table align="center" width="100%">
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_pabrik.php">			
											<table border="0" cellpadding="0" cellspacing="0" width="82%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left">
														<select name="pabrik_obat">
															<option value="">--Pilih--</option>
															<?php
																$q_p = mysql_query ("SELECT * FROM pabrik");
																while ($r_p = mysql_fetch_array($q_p))
																{
																	echo "<option value='$r_p[kd_pabrik]'>$r_p[nama]</option>";
																}
															?>
														</select>
													</td> 
													<td align="left" width="100px"><input type="submit" value="Laporan Excel"></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
								<tr>
									<td>
										<form method="post" enctype="multipart/form-data" action="content/lap_distribusi_pabrik_pdf.php">			
											<table border="0" cellpadding="0" cellspacing="0" width="82%" align="left">
												<tr>
													<td align="right">Dari&nbsp;</td>
													<td width="100px"><input name="tgl_mulai" id="date1" class="date-pick" readonly="true"/></td>
													<td align="right" width="10px">s/d&nbsp;</td>
													<td><input name="tgl_selesai" id="date2" class="date-pick" readonly="true"/></td>
													<td align="left">
														<select name="pabrik_obat">
															<option value="">--Pilih--</option>
															<?php
																$q_p = mysql_query ("SELECT * FROM pabrik");
																while ($r_p = mysql_fetch_array($q_p))
																{
																	echo "<option value='$r_p[kd_pabrik]'>$r_p[nama]</option>";
																}
															?>
														</select>
													</td>
													<td align="left" width="100px"><input type="submit" value="Laporan PDF"></td>
												</tr>
											</table>
										</form>
									</td>
								</tr>
							</table>
							</fieldset>
							</center>    
							</td>
  						</tr>
					</table>
					</div>			
					</font>
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