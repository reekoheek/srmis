<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<!-- suggestion -->


<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_obat_req.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue,thisValue2,thisValue3) {
		$('#inputString').val(thisValue);
		$('#inputString2').val(thisValue2);
		$('#inputString3').val(thisValue3);
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

<body>
<?php

	$id_p = $_GET['pasien_id'];
	$qar = mysql_query("SELECT * FROM simrs.pasien WHERE id='$id_p'");
	$rar = mysql_fetch_array($qar);

	$no_resep=$_GET['no_resep'];
	$param_no=$_GET['param_no'];


	$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$id_p' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	$re=mysql_fetch_array($qe);
					

//biaya pembayaran

	$qq=mysql_query("SELECT * FROM margin WHERE klasifikasi_pasien='$re[cara_bayar]'");
	$rq=mysql_fetch_array($qq);
	if ($rq)
	{
		$margin=$rq['margin'] / 100;
		$tampil=$rq['margin'];
	}
	else
	{
		$margin=30/100;
		$tampil=30;
	}
					
	$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$no_resep'");
	$r3=mysql_fetch_array($q3);
	$sub = $r3['SUM(sub_total)'];
	$potongan = $margin * $sub;
	//$grand = $sub + $potongan;
	$grand = $sub + $potongan;


?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Resep Obat</b></font></td>
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
							<td width="100">No Resep </td>
							<td width="647"><input type="text" name="no_resep" value="<?=$_GET['no_resep']?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							<td width="302"></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><?php
							if ($_GET['pasien_id'])
							{
							?>
                              <input type="text" name="nama_pasien" value="<?= $rar['nama'] ?>" readonly="true" size="40" style="background-color:#CCCFFF; ">
                              <?php
							}
							else
							{
							?>
                              <input type="text" name="nama_pasien" value="<?= $_GET['nama'] ?>" readonly="true" size="40" style="background-color:#CCCFFF; ">
                              <?php
							}
							?>
                          </td>
						  <td>&nbsp;</td>
					  </tr>
						<tr>
						  <td>Jenis Pembayaran </td>
						  <td><?php
							if ($_GET['pasien_id'])
							{
							?>
                            <input type="text" name="jenis" value="<?= $re['cara_bayar'] ?>" readonly="true" size="30" style="background-color:#CCCFFF; ">
                            <?php
							}
							else
							{
							?>
                            <input type="text" name="jenis" value="<?= $re['cara_bayar'] ?>" readonly="true" size="30" style="background-color:#CCCFFF; ">
                            <?php
							}
							?></td>
						  <td>
						  <table border="0" cellpadding="0" cellspacing="0" width="100%">
						  	<tr>
							<td width="65%" align="right">
							<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_racik_obat">
								<input type="hidden" readonly="true" value="<?=$_GET['no_resep']?>" name="no_resep">
                            <input type="hidden" readonly="true" value="<?=$_GET['param_no']?>" name="param_no">
                            <input type="hidden" name="pasien_id" value="<?= $_GET['id']?>" readonly="true">
                            <input type="hidden" name="id" value="<?= $_GET['id']?>" readonly="true">
                            <input type="hidden" name="nama" value="<?= $_GET['nama']?>" readonly="true">
							<input type="hidden" name="cara_bayar" value="<?=$re['cara_bayar']?>" readonly="true">
								&nbsp;<input type="submit" value="Racik Obat"> &nbsp;
								</form>
						  
						  </td>
						  <td width="15px">&nbsp;</td>
						  	<td width="35%" align="right"><form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_pencetakan_apt">
							<input type="hidden" readonly="true" value="<?=$_GET['no_resep']?>" name="no_resep">
							<input type="hidden" readonly="true" value="<?=$_GET['param_no']?>" name="param_no">
                            <input type="hidden" name="pasien_id" value="<?= $_GET['id']?>" readonly="true">
                            <input type="hidden" name="id" value="<?= $_GET['id']?>" readonly="true">
                            <input type="hidden" name="nama" value="<?= $_GET['nama']?>" readonly="true">
							<input type="hidden" name="grand" value="<?= $grand?>" readonly="true">
								<input type="submit" value="Simpan Resep">
							</form>
							</td>
							</tr>
						  </table>
						  </td>
					  </tr>
					  <tr>
					  <td colspan="3" style="border-bottom-color:#888888; border-bottom-style:solid; border-bottom-width:medium; border-top-color:#888888; border-top-style:solid; border-top-width:medium;">
					  <form method="post" action="home.php?hal=action/insert_resep_reg" enctype="multipart/form-data">
					  Nama Obat : 
					  <input type="text" name="nama_obat" value="" size="25"  id="inputString" onkeyup="lookup(this.value);" onblur="fill();" tabindex="1"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div> 
						   <input type="hidden" name="kd_obatt" size="40"  id="inputString3" onKeyUp="lookup(this.value);" onblur="fill();"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div>&nbsp;
						   Jumlah : <input type="text" name="jumlah" size="5"> &nbsp; 
					  Dosis : <select name="dosis_id">
                                <option value="">--Pilih--</option>
                                <?php
									$qd = mysql_query("SELECT * FROM dosis");
									while ($rd = mysql_fetch_array($qd))
									{
										echo "<option value='$rd[id]'>$rd[deskripsi]</option>";
									}
								?>
                              </select> 
							  &nbsp; 
							  Ket : 
							  <select name="ket">
                                <option value="">--Pilih--</option>
                                <option value="Sebelum Makan">Sebelum Makan</option>
                                <option value="Sesudah Makan">Sesudah Makan</option>

                              </select>
							  &nbsp;
							  <input type="submit" name="tambah" value="Tambah">
							  <input type="hidden" readonly="true" value="<?=$_GET['no_resep']?>" name="no_resep">
                            	<input type="hidden" readonly="true" value="<?=$_GET['param_no']?>" name="param_no">
                            	<input type="hidden" name="pasien_id" value="<?= $_GET['pasien_id']?>" readonly="true">
								<input type="hidden" name="id" value="<?= $_GET['pasien_id']?>" readonly="true">
								<?php
								if ($_GET['nama'] == $rar['nama'])
								{
								?>
                            	<input type="hidden" name="nama" value="<?= $_GET['nama']?>" readonly="true">
								
								<?php
								}
								else
								{
								?>
								<input type="hidden" name="nama" value="<?= $re['nama']?>" readonly="true">
								<?php
								}
								?>
							  </form></td>
					  </tr>
					</table>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM resep WHERE no_resep = '$no_resep'");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=1100px>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Kode</font></td>
												<td><font color=#FFFFFF>Obat</font></td>
												<td><font color=#FFFFFF>Racikan</font></td>
												<td><font color=#FFFFFF>Dosis</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Sub Total</font></td>
												<td><font color=#FFFFFF>Ket</font></td>
												<td><font color=#FFFFFF width=60px>Action</font></td>
											</tr>';
									$no = 1;
									while ($r = mysql_fetch_array($q))
									{
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
										$qd = mysql_query ("SELECT * FROM dosis WHERE id = '$r[dosis_id]'");
										$rd = mysql_fetch_array($qd);
										
										$q2 = mysql_query ("SELECT * FROM racik_head WHERE no_racik = '$r[fld02]'");
										$r2 = mysql_fetch_array($q2);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>";
											if ($r['racikan']=='YA')
											{
												echo "-";
											}
											else
											{
												echo "$r[kode_obat]";
											}
											echo "</td>";
											if($r['racikan']=='YA')
											{
												echo "<td><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_racik=$r2[no_racik]&no_resep=$r2[no_resep]', 'myPop1',800,400);\">$r[fld01]</a></td>";
											}
											else
											{
												echo "<td>$ro[nama]</td>";
											}
											echo "<td>";
											if ($r['racikan']=='YA')
											{
												echo "$r[racikan]";
											}
											else
											{
												echo "-";
											}
											echo "</td>
											<td>$rd[deskripsi] ($r[ket])</td>
											<td>";
											if ($r['racikan']=='YA')
											{
												echo "-";
											}
											else
											{
												echo "$r[diberi]";
											}
											echo "</td>
											<td align=right>";
												if ($r['racikan']=='YA')
												{
													echo "-";
												}
												else
												{
											 		rupiah($r[harga]);
												}
										echo "</td>
										<td align=right>";
											 	rupiah($r[sub_total]);
										echo "</td>

											<td>$r[ket_banyak]</td>
											<td align=center width=160px>";
											
											if ($r['racikan']=='YA')
											{
											echo"<a href=\"home.php?hal=content/racik_obat&fld02=$r[fld02]&no_racik=$r[fld02]&id=$r[id]&pasien_id=$id_p&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no\">
											<font size=-1>EDIT</font></a> | <a href=\"home.php?hal=action/hapus_resep_reg&id=$r[id]&pasien_id=$id_p&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no&pasien_id=$id_p&nama=$_GET[nama]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $r[fld01]?')\">
											<font size=-1>HAPUS</font></a>";
											}
											else
											{
											echo"<a href=\"home.php?hal=action/hapus_resep_reg&id=$r[id]&pasien_id=$id_p&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no&pasien_id=$id_p&nama=$_GET[nama]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $ro[nama]?')\">
											<font size=-1>HAPUS</font></a>";
											}
										echo "</td>
											</tr>";
										$no++;
									}
									echo '</table>';
								?>
							</td>
						</tr>
					</table>
					</div><br>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>Sub Total : <input type="text" name="sub_tot" size="16" value="<?php rupiah($r3['SUM(sub_total)'])?>"></td>
							<td width="80px"></td>
							<td>Margin : <input type="text" name="potongan" size="20" value="<?= $tampil."%" ?> (<?php rupiah($potongan)?>)"></td>
							<td width="80px"></td>
							<td>Grand Total : <input type="text" name="grand_total" size="20" value="<?php rupiah($grand)?>"></td>
						</tr>
					</table>
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