<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<!-- suggestion -->
<script>
	function lookup(inputString) {
		if(inputString.length <= 0) {
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
	margin-left: 10px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}

</style>

</head>
<body>
<?php
	if($_POST['no_resep'])
	{
	$id = $_POST['id'];
	$pasien_id = $_POST['pasien_id'];
	$param_no = $_POST['param_no'];
	$no_resep = $_POST['no_resep'];
	$kd_barang = $_POST['kd_barang'];
	$nama=$_POST['nama'];

	}
	
	if($_GET['no_resep'])
	{
	
	$pasien_id = $_GET['pasien_id'];
	$param_no = $_GET['param_no'];
	$no_resep = $_GET['no_resep'];
	$kd_barang = $_GET['kd_barang'];
	$nama=$_GET['nama'];
	
	}
	$qb = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kd_barang'");
	$rb = mysql_fetch_array($qb);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Tambah Obat</b></font></td>
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
				<tr valign="top">
					<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="85%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					
					<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_resep_reg_lab">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						
						<input type="hidden" name="id" value="<?=$_POST['id']?>">
						<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
						<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
						<input type="hidden" name="pasien_id" value="<?=$pasien_id?>" readonly="true">
						<input type="hidden" name="kode_obat" value="<?= $rb['kd_barang']?>">
						<input type="hidden" name="nama_pas" value="<?=$nama?>">
						
						
						<tr>
							<td align="left" width="200px"><font color="#FF0000">Nama Obat* :</font> </td>
							<td><input type="text" name="nama" value="<?=$rb['nama']?>" size="40"  id="inputString" onkeyup="lookup(this.value);" onblur="fill();">
							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div></td>
						</tr>
						<tr>
							<td align="left" width="200px">Stok : </td>
							<td><input type="text" name="stok" size="7" disabled="true"  id="inputString2" onKeyUp="lookup(this.value);" onblur="fill();">
							<input type="hidden" name="kd_obatt" size="7"  id="inputString3" onKeyUp="lookup(this.value);" onblur="fill();">
							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					      </div></td>
						</tr>

						<tr>
							<td align="left"><font color="#FF0000">Jumlah* :</font> </td>
							<td><input type="text" name="jumlah" size="5" value=""></td>
						</tr>
						<tr>
							<td align="left">Dosis : </td>
							<td><select name="dosis_id">
                                <option value="">--Pilih--</option>
                                <?php
									$qd = mysql_query("SELECT * FROM dosis");
									while ($rd = mysql_fetch_array($qd))
									{
										echo "<option value='$rd[id]'>$rd[deskripsi]</option>";
									}
								?>
                              </select>
                            </td>
						</tr>
						<tr>
							<td align="left">Keterangan : </td>
							<td><select name="ket">
                                <option value="">--Pilih--</option>
                                <option value="Sebelum Makan">Sebelum Makan</option>
                                <option value="Sesudah Makan">Sesudah Makan</option>

                              </select>
                            </td>
						</tr>
						<tr>
							<td align="left">Keterangan <br>(Pemesanan Obat Banyak) : </td>
							<td><textarea name="ket_banyak" style="width:210px; height:60px; "></textarea>
                            </td>
						</tr>

						<tr>
							<td></td>
							<td><br><input type="submit" value="Simpan">&nbsp;<input type="reset" value="Reset"><br><br></td>
						</tr>
					</table>
					</form>
					
					</td>
					<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:1px;"></td>
						</tr>
					</table>
					</td>
					<td valign="top">
					<table border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td style="height:1px;"></td>
						</tr>
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_racik_obat_lab">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								<input type="hidden" name="pasien_id" value="<?= $pasien_id?>" readonly="true">
								<input type="hidden" name="nama_pas" value="<?=$nama?>">
								
								&nbsp;<input type="submit" value="Racik Obat"> &nbsp;
								</form>
							</td>
						</tr>
					</table>
					</td>
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
