<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<?php
	include "../include/koneksi.php";
?>
<link rel="stylesheet" type="text/css" href="../include/style.css">
<!-- suggestion -->
<script type="text/javascript" src="../include/jquery-1.2.1.pack.js"></script> 
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("../action/string_daftar_barang_apt.php", {mysearchString: ""+inputString+""}, function(data){
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
<?php
	/*if (($_POST['nama_racikan']=="") OR ($_POST['ket']==""))
	{
		$no_resep=$_POST['no_resep'];
		print "<script>alert('Nama Racikan dan Keterangan Harus Di Isi.');location.href='home.php?hal=content/racik_obat&no_resep=$no_resep'</script>";
	}*/
	
	if ($_POST['no_racik'])
	{
	$no_racik = $_POST['no_racik'];
	$id = $_POST['id'];
	$pasien_id = $_POST['pasien_id'];
	$param_no = $_POST['param_no'];
	$no_resep = $_POST['no_resep'];
	$kd_barang = $_POST['kd_barang'];
	$fld02 = $_POST['fld02'];
	}
	
	elseif ($_GET['no_racik'])
	{
	$no_racik = $_GET['no_racik'];
	$id = $_GET['id'];
	$pasien_id = $_GET['pasien_id'];
	$param_no = $_GET['param_no'];
	$no_resep = $_GET['no_resep'];
	$kd_barang = $_GET['kd_barang'];
	$fld02 = $_GET['fld02'];
	}
	
	$qb = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$kd_barang'");
	$rb = mysql_fetch_array($qb);
	$qq2=mysql_query("SELECT * FROM racik_head WHERE no_racik='$no_racik'");
	$rq2=mysql_fetch_array($qq2);
	
	if (!$rq2['nama'])
	{
		$query3=mysql_query("UPDATE racik_head SET nama='".$_POST['nama_racikan']."', dosis_id='".$_POST['dosis_id']."', ket='".$_POST['ket']."'
				, deskripsi='".$_POST['deskripsi']."', biaya_racik='".$_POST['biaya_racik']."' WHERE no_racik='$no_racik'");
	}
?>
<center>
<fieldset style="width:90%">
<legend style="background-color:#9b9999">
<font style="font-size:14px; " color="#fefafa"><b>Tambah Racikan Obat</b></font>
</legend>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px">&nbsp;&nbsp;</td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/#.png"></td>
	</tr>
	<tr>
		<td id="" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top">
					<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="70%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					
					<form method="post" enctype="multipart/form-data" action="../action/insert_detail_racik_obat.php">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="fld02" value="<?=$fld02?>">
						<input type="hidden" name="nama_racikan" value="<?=$nama_racikan?>">
						<input type="hidden" name="ket" value="<?=$ket?>">
						<input type="hidden" name="id" value="<?=$id?>">
						<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
						<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
						<input type="hidden" name="pasien_id" value="<?= $pasien_id?>" readonly="true">
						<input type="hidden" name="kode_obat" value="<?= $kd_barang?>">
						<input type="hidden" readonly="true" value="<?=$no_racik?>" name="no_racik">
						<tr>
							<td align="left" width="200px"><font color="#FF0000">Nama Obat* :</font> </td>
							<td>
								<div id="container">
								<input type="text" name="nama_obat" id="inputString" onkeyup="lookup(this.value);" onblur="fill();" size="45">
								
								<!-- hide our suggesetion box to begin with-->
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="../upArrow.png" style="position: relative; top: -18px; left: 90px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
					          	<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
							</td>
						</tr>
						<tr>
							<td align="left">Stok : </td>
							<td>
							<input type="text" name="stok" size="8" id="inputString2" onkeyup="lookup(this.value);" onblur="fill();"  readonly="true" disabled>
							</td>
						</tr>
						<tr>
							<td align="left"><font color="#FF0000">Jumlah* :</font> </td>
							<td><input type="text" name="jumlah" size="8" value=""></td>
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
						<tr>
							<td>
							<form method="post" enctype="multipart/form-data" action="home.php?hal=content/daftar_racik_obat">
								<input type="hidden" name="id" value="<?=$id?>" name="id">
								<input type="hidden" readonly="true" value="<?=$fld02?>" name="fld02">
								<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
								<input type="hidden" readonly="true" value="<?=$no_racik?>" name="no_racik">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								<input type="hidden" name="pasien_id" value="<?= $pasien_id?>" readonly="true">
								<input type="hidden" name="nama_racikan" value="<?=$_POST['nama_racikan']?>">
								<input type="hidden" name="ket" value="<?=$_POST['ket']?>">
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
		<td><img src="images/#.png"></td>
	</tr>
</table>
</fieldset>
</center>
</body>
</html>
