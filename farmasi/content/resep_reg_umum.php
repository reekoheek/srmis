<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>

<!-- pop up jquery -->
<link rel="stylesheet" href="include/general.css" type="text/css" media="screen" />
<script src="include/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="include/popup.js" type="text/javascript"></script>
<script src="include/popup2.js" type="text/javascript"></script>
<!-- end pop up jquery-->


<!-- pop up windows-->
<script>
function PopupCenter(pageURL, title,w,h) {
//var left = (screen.width/2)-(w/2);
//var top = (screen.height/2)-(h/2);
var targetWin = window.open 
//(pageURL, title, 'toolbar=no, alwaysraised=yes, fullscreen=true location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top='+top+', left='+left);
(pageURL, title, 'toolbar=no, alwaysraised='+1+', fullScreen=no, locationbar=no, location=0, directories=no, status=no, menubar=0, scrollbars=yes, resizable=0, copyhistory=0, width=600, height=500, top=100, left=400');
this.targetWin.focus();
}
</script>

<!-- suggestion -->


<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("action/string_daftar_barang_apt.php", {mysearchString: ""+inputString+""}, function(data){
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
if(!$_GET['no_resep'])
{
//awal insert no resep
// 50=rawat inap
// 51=igd
// 52=oca
// 4=rawat jalan


$qp= mysql_query("SELECT * FROM resep_head WHERE LAST_INSERT_ID(param_no) and no_resep like 'RPU%' ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);


$tanggal_sekarang=date("d/m/Y");
//$month=substr($rp['tgl'],3,2);
$date=date("m");

$tgl = substr($rp['tgl'],3,2);


if ($tgl == $date)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

//cek untuk ketersediaan record
if (!$rp)
{
	$temp = 1;
	$count = $temp;
}


$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);



$kd="RPU/";
	
$no_resep = $kd . date("dmy")."$digit7" . "$digit6" . "$digit5" . "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;



}
//akhir counter
else
{
	
	$no_resep=$_GET['no_resep'];
	$param_no=$_GET['param_no'];
	$nama_pasien=$_GET['nama'];
	$rs_asal=$_GET['rs_asal'];
	$no_ket=$_GET['no_ket'];
	$jenis_ket=$_GET['jenis_ket'];
	$qqqq=mysql_query("select * from resep_head where no_resep='$no_resep'");
	$rrr1=mysql_fetch_array($qqqq);
	
	//biaya pembayaran
	$qrh = mysql_query("SELECT * FROM resep_head WHERE no_resep='$no_resep'");
	$rrh = mysql_fetch_array($qrh);

	$qq=mysql_query("SELECT * FROM margin WHERE klasifikasi_pasien='$rrh[cara_masuk]'");
	$rq=mysql_fetch_array($qq);
	if ($_GET['sub_margin'])
	{
		$qmar2=mysql_query("select * from sub_margin2 where id='$_GET[sub_margin]'");
		$rmar2=mysql_fetch_array($qmar2);
		$margin=$rmar2['margin'] / 100;
		$tampil=$rmar2['margin'];
	}
	else
	{
		$margin=30/100;
		$tampil=30;
	}
					
		$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$no_resep'");
		$r3=mysql_fetch_array($q3);
		$sub = $r3['SUM(sub_total)'];
		$tambah = $margin * $sub;
		//$grand = $sub + $potongan;
		$grand = $sub + $tambah;
				

}					

?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><strong>Penjualan Bebas </strong></font></td>
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
					<form method="post" action="home.php?hal=action/simpan_resep_umum" enctype="multipart/form-data">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td width="100">No Resep </td>
							<td><input type="text" name="no_resep" value="<?=$no_resep?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							
							<td width="80"></td>
						</tr>
						<tr>
							<td>Jenis</td>
							<td>
							<?php
								if ($_GET['jenis_ket'])
								{
									echo "<input type='text' name='jenis_keterangan' value='$jenis_ket' readonly='true' style='background-color:#CCCFFF;'>";
								}
								else
								{
							?>
								 <select id="cmb_jenis" name="cmb_jenis" onchange="window.location='home.php?hal=content/resep_reg_umum&cmb_jenis=' + this.options[this.selectedIndex].value" tabindex="1">
								<?php
								
									if ($_GET['cmb_jenis'])
									{
										$jns = $_GET['cmb_jenis'];
									}
									else
									{
										$jns= '';
									}
									
									if ($jns==1)
									{
										echo "<option value=0>--Pilih--</option>";
                                        echo "<option value=1 selected>KARYAWAN</option>";
                                        echo "<option value=2>ASKES</option>";
                                        echo "<option value=3>UMUM</option>";
									}
									else if ($jns==2)
									{
										echo "<option value=0>--Pilih--</option>";
                                        echo "<option value=1>KARYAWAN</option>";
                                        echo "<option value=2  selected>ASKES</option>";
                                        echo "<option value=3>UMUM</option>";
									}
									else if ($jns==3)
									{
										echo "<option value=0>--Pilih--</option>";
                                        echo "<option value=1>KARYAWAN</option>";
                                        echo "<option value=2>ASKES</option>";
                                        echo "<option value=3 selected>UMUM</option>";
									}
									else
									{
										echo "<option value=0 selected>--Pilih--</option>";
                                        echo "<option value=1>KARYAWAN</option>";
                                        echo "<option value=2>ASKES</option>";
                                        echo "<option value=3>UMUM</option>";
									}		
								?>
                                </select>
								<?php
									if ($jns==1)
									{
										$keterangan="KARYAWAN";
									}
									elseif ($jns==2)
									{
										$keterangan="ASKES";
									}
									elseif ($jns==3)
									{
										$keterangan="UMUM";
									}
									else
									{
										$keterangan="";
									}
								?>
								<input type="hidden" value="<?= $keterangan?>" name="jenis_keterangan">							</td>
							<?php
								}
							?>
							<td></td>
						</tr>
						<tr>
							<td>
							<?php
								if ($jns==1 || $_GET['jenis_ket']=="KARYAWAN")
								{
									echo "No Karyawan";
								}
								elseif ($jns==2 || $_GET['jenis_ket']=="ASKES")
								{
									echo "No Askes";
								}
								else
								{
									echo "";
								}
							?>							</td>
							<td>
							<?php
								if ($_GET['cmb_jenis'])
								{
									if ($jns==1 || $jns==2 || $jns==4)
									{
										echo "<input type='text' name='no_ket' size=20>";
									}
									else
									{
										echo "";
									}
								}
								
								elseif (!$_GET['no_ket'])
								{
									echo "";
								}
								elseif ($_GET['no_ket'])
								{
									echo "<input type='text' name='no_ket' value='$no_ket' size=20 readonly=true style='background-color:#CCCFFF;'>";
								}
							?>							</td>
							<td></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><?php
							if ($_GET['nama'])
							{
							?>
                              <input type="text" name="nama_pasien" value="<?= $nama_pasien ?>" readonly="true" size="40" style="background-color:#CCCFFF; ">
                              <?php
							}
							else
							{
							?>
                              <input type="text" name="nama_pasien"  size="40" >
                              <?php
							}
							?>                          </td>
						  <td>&nbsp;</td>
					  </tr>
					  <tr>
					  <td>Nama Rumah Sakit Asal</td>
					  <? if($_GET['no_resep']){ ?>
					  <td><input type="text" name="rs_asal" value="<?=$rrr1['fld03']?>" readonly="true" style="background-color:#CCCFFF; "></td>
					  <? }else{ ?>
					  <td><input type="text" name="rs_asal"></td>
					  <? } ?>
					  <td>&nbsp;</td>
					  </tr>
					  <tr >
						<td colspan="4" style="border-top-style:solid; border-top-color:#888888; border-top-width:medium; border-bottom-style:solid; border-bottom-color:#888888; border-bottom-width:medium;">
             
                            <input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
						
							<input type="hidden" name="grand" value="<?=$grand?>" readonly="true">							
					
					  Nama Obat : 
					  <input type="text" name="nama_obat" value="" size="25"  id="inputString" onkeyup="lookup(this.value);" onblur="fill();" tabindex="2"><div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 0px; right:150px;" alt="upArrow" />
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
							
							<input type="hidden" readonly="true" value="<?=$jenis_ket?>" name="jenis_ket">
							<input type="hidden" readonly="true" name="param_no" value="<?=$param_no?>">
							
							<hr>
															<table><tr><td>
							<? 
							if(!$_GET['sub_margin'])
								{
								$qmar=mysql_query("select * from margin2 WHERE klasifikasi='$keterangan'");
								$rmar=mysql_fetch_array($qmar);
									
								echo"
										<td>Sub Margin</td>
										<td>
										<select name=sub_margin>";
										$qsubmar=mysql_query("select * from sub_margin2 WHERE margin_id='$rmar[id]'");
										while($rsubmar=mysql_fetch_array($qsubmar))
										{
											echo"<option value='$rsubmar[id]'>$rsubmar[sub_klasifikasi]</option>";
										}
										echo"</select></td><td>&nbsp;</td>";
								}else
								{	
									$qsubmargin=mysql_query("select * from sub_margin2 where id='$_GET[sub_margin]'");
									$rsubmargin=mysql_fetch_array($qsubmargin);
									echo"<td>Sub Margin</td>
										<td>";
									echo"<input type=text readonly=true name=sub_margind value='$rsubmargin[sub_klasifikasi]' style='background-color:#CCCFFF;'></td><td>&nbsp;</td>";
									echo"<input type=hidden name=sub_margin value=$_GET[sub_margin]>";
								}

							?>
							</td></tr></table>
				      </form></td>
					 
						<td align="left">				  </td>
			  </tr>
					  <tr>
					  <td colspan="3" align="right">
					  <form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_pencetakan_resep_umum">
					  <input type="hidden" name="sub_margin" value="<?=$_GET['sub_margin']?>" readonly="true">
					  <input type="hidden" name="nama" value="<?=$_GET['nama']?>">
					  <input type="hidden" name="no_resep" value="<?=$no_resep?>">
					  <input type="hidden" name="jenis_ket" value="<?=$_GET['jenis_ket']?>">
					  <input type="hidden" name="grand" value="<?=$grand?>">
					  <input type="submit" name="Simpan" value="Simpan Resep">
					  </form>					  </td>
					  <td align="left"><form method="post" enctype="multipart/form-data" action="home.php?hal=action/insert_racik_obat_umum">
					  			<input type="hidden" name="sub_margin" value="<?=$_GET['sub_margin']?>" readonly="true">
								<input type="hidden" name="id" value="<?=$id?>">
								<input type="hidden" readonly="true" value="<?=$no_resep?>" name="no_resep">
								<input type="hidden" readonly="true" value="<?=$param_no?>" name="param_no">
								<input type="hidden" name="nama" value="<?=$_GET['nama']?>" readonly="true">
							<input type="hidden" name="rs_asal" value="<?=$_GET['rs_asal']?>" readonly="true">
							<input type="hidden" readonly="true" value="<?=$_GET['jenis_ket']?>" name="jenis_ket">
								<input type="hidden" readonly="true" value="<?=$_GET['no_ket']?>" name="no_ket">
								
								&nbsp;<input type="submit" value="Racik Obat"> &nbsp;
						  </form></td>
					  </tr>
					</table>
					<hr>
					<div style="border:1px  solid; border-color:#CCCCCC; width:670px; height:300px; overflow:auto;">
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
												<td><font color=#FFFFFF>Subtotal</font></td>																										
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
												echo "$r2[no_racik]";
											}
											else
											{
												echo "$ro[kd_barang]";
											}
											echo "</td>";
											if($r['racikan']=='YA')
											{
												echo "<td><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_racik=$r2[no_racik]&no_resep=$r2[no_resep]', 'myPop1',800,400);\">$r2[nama]</a></td>";
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
										echo "</td><td align=right>";
											 	rupiah($r[sub_total]);
										echo "</td>

										

											<td>$r[ket_banyak]</td>
											<td align=center width=160px>";
											
											if ($r['racikan']=='YA')
											{
											echo"<a href=\"home.php?hal=action/hapus_resep_reg_umum&jenis_ket=$jenis_ket&no_ket=$no_ket&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no&nama=$nama_pasien&id=$r[id]&sub_margin=$_GET[sub_margin]\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $r[fld01]?')\">
											<font size=-1>HAPUS</font></a>";
											}
											else
											{
											echo"<a href=\"home.php?hal=action/hapus_resep_reg_umum&jenis_ket=$jenis_ket&no_ket=$no_ket&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no&nama=$nama_pasien&id=$r[id]&sub_margin=$_GET[sub_margin]\" 
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
							<td>Margin : <input type="text" name="tambah" size="20" value="<?= $tampil."%" ?> (<?php rupiah($tambah)?>)"></td>
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
