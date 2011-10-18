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
			$.post("action/string_SPP.php", {mysearchString: ""+inputString+""}, function(data){
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
	margin-left: 10px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}
</style>

</head>
<body>
<?php
	$cari = $_POST['cari'];
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<?php
					if ($_GET['f']=='1')
					{
						$f=$_GET['f'];
						$tampil="Bukti Penerimaan Barang ";
					}
					elseif ($_GET['f']=='2')
					{
						$f=$_GET['f'];
						$tampil="Bukti Pengeluaran Barang ";
					}
					else
					{
						$f="";
						$tampil="Distribusi Permintaan Obat ";
					}
					
					if ($_GET['status_ket']=='2')
					{
						$status_ket="2";
					}
					elseif ($_GET['status_ket']=='9')
					{
						$status_ket="9";
					}
					?>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"><?= $tampil?> </font></b></td>
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
							<form method="post" action="home.php?hal=content/Distribusi_obat" enctype="multipart/form-data">
							<td align="left">
								<div id="container">
								<input type="hidden" name="ket_status" value="<?= $ket_status?>">
								Cari No SPP : 
								  <input type="text" name="cari" value="" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="18">
								&nbsp;<input type="submit" value="Cari">
								
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 60px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
								
							</td>
							</form>
						</tr>
					</table>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:400px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
								
									if ($cari)
									{
										if (($_GET['status_ket']=='2') OR ($_GET['f']=='1'))
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE No_SPP LIKE '$cari%' AND status = 2 AND ket_status='0' ORDER BY id DESC");
										}
										elseif (($_GET['status_ket']=='9') OR ($_GET['f']=='2'))
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE No_SPP LIKE '$cari%' AND status = 9 AND ket_status='0' ORDER BY id DESC");
										}
										else
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE No_SPP LIKE '$cari%' AND ket_status='0' AND status <> 0 ORDER BY id DESC");
										}
									}
									else
									{
										if (($_GET['status_ket']=='2') OR ($_GET['f']=='1'))
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE (ket_status='0' AND status='2') OR (ket_status='0' AND status='2') OR (ket_status='0' AND status='3') OR (ket_status='0' AND status='4') OR (ket_status='0' AND status = '8') ORDER BY id DESC");
										}
										elseif (($_GET['status_ket']=='9') OR ($_GET['f']=='2'))
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE (ket_status='0' AND status='9') OR (ket_status='0' AND status='9') OR (ket_status='0' AND status='9') OR (ket_status='0' AND status='9') OR (ket_status='0' AND status = '9') ORDER BY id DESC");
										}
										else
										{
											$query  = mysql_query ("SELECT * FROM permintaan_unit WHERE (ket_status='0' AND status='1') OR (ket_status='0' AND status='3') OR (ket_status='0' AND status='4') OR (ket_status='0' AND status = '8') ORDER BY id DESC");
										}
											   
									}
									
									echo '<table cellpadding=2 cellspacing=2 width=100%">
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=70px>Tanggal SPP</font></td>
												<td><font color=#FFFFFF width=110px>No. SPP</font></td>';
											if ($_GET['f']=='2')
											{
												echo '<td><font color=#FFFFFF width=110px>No. BPB</font></td>';
											}
												echo '<td><font color=#FFFFFF>Unit</font></td>
												<td><font color=#FFFFFF width=100px>Status</font></td>
												<td colspan="3"><font color=#FFFFFF width=140px >Action</font></td>
											</tr>';
									$no = 1;
									$pdate = date ("d") + 0; 
									$pmonth = date("m") + 1;
									$ppmonth = date ("m") + 0;
									$pyear = date("Y") + 0;
									while ($result = mysql_fetch_array($query))
									{
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
											echo "<td width=80px align=center>".$result['Tgl_SPP']."</td>";
											//echo "<td width=110px align=center><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_SPP.php?No_SPP=$result[No_SPP]', 'myPop1',800,400);\">".$result['No_SPP']."</a></td>";
											echo "<td width=110px align=center>".$result['No_SPP']."</td>";
											if ($_GET['f']=='2')
											{
												echo "<td width=110px align=center>".$result['No_BPB']."</td>";
											}
											$qunit = mysql_query("select * from pelayanan where id='".$result['Unit']."'");
											$runit = mysql_fetch_array($qunit);
											
											echo "<td align=center>".$runit['jenis']."</td>";										
											
											$qstatus = mysql_query("select * from status where id='".$result['status']."'");
											$rstatus = mysql_fetch_array($qstatus);
											
											echo "<td align=center>".$rstatus['nama']."</td>";
											echo "<td align=center width=140px>";
												if ($_GET['f']=='1')
												{
													echo "
													<a href='javascript:void(0);' onClick=\"PopupCenter('content/bukti_penerimaan_menu_farmasi.php?No_SPP=$result[No_SPP]', 'myPop1',800,400);\">Lihat</a>";
												}
												elseif ($_GET['f']=='2')
												{
													echo "
													<a href='javascript:void(0);' onClick=\"PopupCenter('content/bukti_pengeluaran_menu_farmasi.php?No_SPP=$result[No_SPP]', 'myPop1',800,400);\">Lihat</a>";
												}
												elseif ($result['status']=='2')
												{
													echo "<a href=home.php?hal=action/insert_bpb&No_SPP=$result[No_SPP]&Tgl_SPP=$result[Tgl_SPP]
													style=visibility:hidden><font style=font-size:12px;>Buat Obat Keluar</font></a>";
												}
												elseif ($_POST['ket_status']=='1')
												{
													echo "";
												}

												elseif ($result['status']=='1') 
												{
													echo "<a href=home.php?hal=action/insert_bpb&No_SPP=$result[No_SPP]&Tgl_SPP=$result[Tgl_SPP]>
														  <font style=font-size:12px;>Buat Obat Keluar</font></a>";
												}												
											echo "</td>
											</tr>";
										$no++;
									}
									echo '</table><br>';
									

									?>
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
