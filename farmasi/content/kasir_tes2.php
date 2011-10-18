<?php
session_start();

include("../include/koneksi.php");
include("../include/fungsi_rp.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<title>Kasir</title>

<!-- suggestion -->


<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("../action/string_no_resep_kasir.php", {mysearchString: ""+inputString+""}, function(data){
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

<!-- Jam Digital -->
<script type="text/javascript">  
// 1 detik = 1000  
window.setTimeout("waktu()",1000);    
function waktu() {     
    var tanggal = new Date();    
    setTimeout("waktu()",1000);    
    document.getElementById("output").innerHTML = tanggal.getHours()+":"+tanggal.getMinutes()+":"+tanggal.getSeconds();  
}  
</script> 

<style>

a:link {
	color: #000000;
	text-decoration:none;
	padding:0,0,0,0;
	margin-bottom:0px;
}

a:visited {
  color: #000000;
  text-decoration:none;
  padding:0,0,0,0;
  margin-bottom:0px;
}

a:hover {
	color:#FF9900;
	text-decoration:underline;
	padding:0,0,0,0;
	margin-bottom:0px;
}

a:active {
	color: #000000;
	text-decoration:none;
	padding:0,0,0,0;
	margin-bottom:0px;
}


body {	
	font-family: Trebuchet MS;
	font-color :#555855;
	
	margin-top: 30px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	}
	
#tengah {
	background-image:url(../images/tengah.png);
	height:33px;
	background-repeat:repeat-x;
	}
	
#tengah_isi {
	background-image:url(../images/tengah_isi.png);
	width:703px;
	background-repeat:repeat-y;
	}

#bawah {
	background-image:url(../images/bawah.png);
	height:52px;
	background-repeat:repeat-x;
	}
	
#kiri_atas2 {
	background-image:url(../images/kiri_atas2.png);
	width:303px;
	background-repeat:repeat-y;
}

button, img {
	border:0px; 
}


hr {
	border-style:dotted;
	color:#9b9999;
	}
	
div.buttonsdiv{ /*div that wraps around the submit/reset buttons*/
margin-top: 5px; /*space above buttonsdiv*/
}

div.buttonsdiv input{ /* style for INPUT fields within 'buttonsdiv'. Assumed to be form buttons. */
width: 80px;
background: #e1dfe0;
}

fieldset {
	border-top : 1px solid #9b9999;
	border-right : 1px solid #9b9999;
	border-left : 1px solid #9b9999;
	border-bottom : 1px solid #9b9999;
	}

input {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

textarea {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

select {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

/*  Styling for Suggestion Box Container  */
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
	margin-left: 300px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}


.suggestionList {
	margin: 0px;
	padding: 0px;
}


/*  Individual Search Results  */
.suggestionList li {
	margin: 0px 0px 3px 0px;
	padding: 7px;
	cursor: pointer;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	list-style-type: none;
}

/*  Hover effect  */
.suggestionList li:hover {
background-color: #9b9999;
font-weight: bold;
}



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
	margin-left: 210px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}
</style>

</head>
<body>
<?php
if($_POST['no_resep'])
{
$no_trans=$_POST['no_trans'];
$id_resep = $_POST['no_resep'];
$id_pasien = $_POST['pasien_id'];
$namapasien=$_POST['namapas'];
$param_no=$_POST['param_no'];
$unit_id=$_POST['unit_id'];
$date = date("d/m/Y");
//$date=date("d/m/Y");
}//$pasien_id = $_POST['pasien_id'];
else
if($_GET['no_resep'])
{
$no_trans=$_GET['no_trans'];
$id_resep = $_GET['no_resep'];
$id_pasien = $_GET['pasien_id'];
$namapasien=$_GET['namapas'];
$param_no=$_GET['param_no'];
$unit_id=$_GET['unit_id'];
$date = date("d/m/Y");
//$date=date("d/m/Y");
}
else
/* if($_GET['no_resep'])
{
$no_trans=$_GET['no_trans'];
$id_resep = $_GET['no_resep'];
$id_pasien = $_GET['pasien_id'];
}  
else */
{
$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$month = date("m");
$qp= mysql_query("SELECT * FROM penjualan_head WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$qstat=mysql_query("select * FROM penjualan_head where status=0 order by id desc limit 1");
$rstat=mysql_fetch_array($qstat);

$tgl = substr($rp['tgl'],5,2);
if ($tgl == $month)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

if($rp['status']==0){
$no_trans=$rp['no_trans'];
$param_no=$rp['param_no'];
$id_resep=$rp['no_resep'];
$id_pasien = $rp['pasien_id'];
$namapasien=$rp['fld01'];
}else
{
$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_trans = "TRK/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;
$id_resep="";
}
}


$k_unit=substr($id_resep,0,3);

if($k_unit=='IGD')
{
 $unit_id='51';
}else
if($k_unit=='OKA')
{
 $unit_id='52';
}else
if($k_unit=='LAB')
{
 $unit_id='87';
}else
if($k_unit=='RAD')
{
 $unit_id='91';
}else
if($k_unit=='RRI')
{
 $unit_id='50';
}else 
if($k_unit=='RRJ')
{
 $unit_id='4';
}else
if($k_unit='RPU')
{
 $unit_id='2';
}

$qe=mysql_query("SELECT * FROM simrs.pasien, simrs.kunjungan, simrs.kunjungan_kamar WHERE pasien.id= '$id_pasien' AND pasien.id=kunjungan.pasien_id AND kunjungan.id=kunjungan_kamar.kunjungan_id");
	$re=mysql_fetch_array($qe);


?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="center" colspan="3">
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Kasir</b></font></td>
				<td><div align="right">
				  <label></label>
				</div></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	<tr>
		<td align="center">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%" >
					<tr>
						<td align=left><?= $date ?> [ <?=$_SESSION['U_USER']?> ] <div id="output">  
</div></td>
						<td align="right" >Lihat Resep : 
							<a href="lihat_resep_umum2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">Umum</a> | 
							<a href="lihat_resep_igd2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">IGD</a> | 
							<a href="lihat_resep_oca2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">OKA</a> | 
						 	<a href="lihat_resep_rawat_jalan2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">Rawat Jalan</a> | 
						 	<a href="lihat_resep_rawat_inap2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">Rawat Inap</a> |
							<a href="lihat_resep_lab2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">LAB</a> | 
							<a href="lihat_resep_radiologi2.php?no_trans=<?=$no_trans?>&param_no=<?=$param_no?>">Radiologi &nbsp;</a>  
						</td>
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<tr>
						<td align="left"><form method="post" action="transaksi_parkir.php"></form></td>
						<td align="right"><form method="post" action="../action/insert_cari_resep2.php">Cari Resep : <input type="text" name="no_resep" value="<? echo $id_resep;?>"  size="17" id="inputString" tabindex="1" onkeyup="lookup(this.value);" onblur="fill();">
					  <div class="suggestionsBox" id="suggestions" style="display: none;" align="left"> <img src="upArrow.png" style="position: relative; top: -18px; left: 220px; right:150px;" alt="upArrow" />
								  <div class="suggestionList" id="autoSuggestionsList"></div>
							  </div>
					  <input type="hidden" name="no_trans" value="<?=$no_trans?>" readonly="true">
					<input type="hidden" name="param_no" value="<?=$param_no?>" readonly="true">	  <label>
							  <input type="submit" name="Submit" value="Cari">&nbsp;
						    </label></form></td>
							
					</tr>
					<tr>
						<td colspan="2"><hr /></td>
					</tr>
					<tr>
							<td>No Transaksi </td>
							<td><input type="text" name="no_trans" value="<? echo $no_trans;?>" readonly="true" size="17" style="background-color:#CCCFFF; "></td>
							
						</tr>
					<tr>
							<td>No Resep </td>
					  <td><input type="text" name="no_resep"  value="<? echo $id_resep;?>"  size="17" style="background-color:#CCCFFF; " readonly="true"> 
					 </td>
							<td></td>
						</tr>
						<tr>
							<td>No RM </td>
							<td>
							
							<input type="text" name="no_rm" value="<?= $id_pasien; ?>" readonly="true" size="17" style="background-color:#CCCFFF; ">
							</td>
							<td></td>
						</tr>
						<tr>
						  <td>Nama Pasien</td>
						  <td><input type="text" name="nama_pasien" value="<? echo $namapasien; ?>" readonly="true" size="40" style="background-color:#CCCFFF; "></td>
						  <td></td>
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
							if($k_unit=='RPU')
							{
							?>
                            <input type="text" name="jenis" value="Tunai" readonly="true" size="30" style="background-color:#CCCFFF; ">
                            <?php
							}
							else
							{
							?>
							<input type="text" name="jenis" value="<?= $re['cara_bayar'] ?>" readonly="true" size="30" style="background-color:#CCCFFF; ">
							<?
							}
							?></td>
							</tr>
						
					</table>
					
					<div style="border:1px  solid; border-color:#CCCCCC; width:670px; height:200px; overflow:auto; margin-left:160px;">

								<?php
									$no=1;					
									$qr=mysql_query("select * from resep where no_resep='$id_resep'");
									echo "<table border=0 cellpadding=2 cellspacing=2 width=670px style='border:0px  solid; border-color:#CCCCCC overflow:scroll';>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=150px>Obat</font></td>
												<td><font color=#FFFFFF width=45px>Racikan</font></td>
												<td><font color=#FFFFFF width=40px>Jml</font></td>
												<td><font color=#FFFFFF width=90px>Harga</font></td>
												<td><font color=#FFFFFF width=90px>Sub Total</font></td>
												
											</tr>";
											
									
									
					
									while ($rr = mysql_fetch_array($qr))
									{
			
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$rr[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
										$qbu = mysql_query("select * from barang_unit where barang_id='$ro[id]' and unit_id='2'");
										$rbu = mysql_fetch_array($qbu);
										
										$qd = mysql_query ("SELECT * FROM dosis WHERE id = '$rr[dosis_id]'");
										$rd = mysql_fetch_array($qd);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										/* if($rr['racikan']=='YA')
											{
											echo "<td width=65px>$rr[fld02]</td>";
											}else
											{
										echo "<td width=65px>$rr[kode_obat]</td>";
											} */
											if($rr['racikan']=='YA')
											{
												echo "<td width=250px><a href='javascript:void(0);' onClick=\"PopupCenter('daftar_racik.php?no_resep=$rr[no_resep]&no_racik=$rr[fld02]', 'myPop1',800,400);\">$rr[fld01]</a></td>";
											}
											else
											{
												echo "<td width=250px>$ro[nama]</td>";
											}
										echo "<td width=45px align=center>$rr[racikan]</td><td width=40px align=right>";
										if($rr['racikan']=='YA')
											{ echo"-";
											}else{
											echo"
											<a href='javascript:void(1);' onClick=\"PopupCenter('ubah_qty_transaksi.php?no_trans=$no_trans&no_resep=$id_resep&namapas=$namapasien&param_no=$param_no&pasien_id=$id_pasien&kd_obat=$rr[kode_obat]','myPop1',300,300);\">$rr[diberi]</a>"; }
											echo"</td>
											<td align=right width=90px>";
											if($rr['racikan']=='YA')
											{ echo" ";
											}else{
											 rupiah($rbu['fld02']);
											}
										echo "</td>
											<td align=right width=90px>";
											 	rupiah($rr['sub_total']);
										echo "</td>
											</tr> ";
										$no++;
										
									}
									echo "<tr>
											<td colspan=8>
											</table>";
									?></table>
									<form method="post" action="kasir_tes2.php?no_resep=<? echo $id_resep; ?>&id=<? echo $id_pasien; ?>&nama=<? echo $namapasien ?>">
									<input type="hidden" name="no_resep" value="<?=$id_resep?>">
									<input type="hidden" name="pasien_id" value="<?=$id_pasien?>">
									<input type="hidden" name="namapas" value="<?=$namapasien?>">
									<input type="hidden" name="no_trans" value="<?=$no_trans?>">
									<input type="hidden" name="param_no" value="<?=$param_no?>">
									
									<table border="0" cellpadding="1" cellspacing="2" width="100%">
					<?php
					
					$qq=mysql_query("SELECT * FROM margin WHERE klasifikasi_pasien='$re[cara_bayar]'");
					$rq=mysql_fetch_array($qq);
					//margin baru 140811
					$qhd=mysql_query("select * from resep_head where no_resep='$id_resep'");
					$rhd=mysql_fetch_array($qhd);
					if (isset($rhd['sub_margin']))
					{
						$qmar2=mysql_query("select * from sub_margin2 where id='$rhd[sub_margin]'");
						$rmar2=mysql_fetch_array($qmar2);
						$margin=$rmar2['margin'] / 100;
						$tampil=$margin;
					}
					else
					{
						$margin=30/100;
						$tampil=30;
					}
					
					$q3=mysql_query("SELECT SUM(sub_total) FROM resep WHERE no_resep = '$id_resep'");
					$r3=mysql_fetch_array($q3);
					$sub = $r3['SUM(sub_total)'];
					$tambah = $margin * $sub;
					$ppn=0.1*$sub;
					//$grand = $sub + $potongan;
					$grand = $sub + $tambah +$ppn;
					
					echo"<input type=hidden name=grand value=$grand>";
					$bayar=$_POST['u_bayar'];
					
					if($_POST['u_bayar']){
					$grand=$_POST['grand'];
					if($bayar<$grand){ echo"<script>alert('Maaf, Uang Anda Kurang');location.href='kasir_tes2.php?no_resep=$_POST[noresep]&pasien_id=$_POST[id_pasien]&namapas=$_POST[namapasien]&no_trans=$no_trans'</script>"; }
					else{
					$kembali=$bayar-$grand;
				print "<script>alert('Menyimpan transaksi $no_trans . Tunai : "; rupiah($bayar); print".  Kembali :"; rupiah($kembali); print"');location.href='../action/insert_total_pembayaran2.php?no_transaksi=$no_trans&bayar=$bayar&total=$grand&no_resep=$id_resep&paramno=$param_no&namapas=$namapasien&id_pasien=$id_pasien'</script>"; }
				}
					else
					{
					$bayar=0;
					$kembali=0;
					}
					?><font size="-1">
						</font>
					
					<tr>
						<td width="600px" align="right">&nbsp;</td>
						<td colspan="2"><font size="-1">
							  <div align="right"><font size="-2">
							    </font>
						        <input type="hidden" name="sub_tot" size="20" value="<?php rupiah($r3['SUM(sub_total)'])?>" readonly></div></td></tr>
								
								<tr>

						<td width="7" align="right">&nbsp;</td>
						<td colspan="2">
						     <font size="0"><div align="right"><font size="-2"> PPN (10%)</font>
						      <input type="text" name="ppn" size="20" value="<?php rupiah($ppn);?>" readonly=></div></td></tr>
							  <tr>
							  <td width="7" align="right">&nbsp;</td>
						<td colspan="2">
						     <font size="0"><div align="right"><font size="-2"> Grand Total</font>
						      <input type="text" name="grand_total" size="20" value="<?php rupiah($grand);?>" readonly=></div></td></tr>
					    
					
					
					
					<tr>
						<td align="right">&nbsp;</td><td width="582" align="right">
							  <div align="right"><font size="0">Bayar </font></div>
							</td>
						<td width="122" align="right"><font size="-1">
						  <input type="text" name="u_bayar" size="20" value="<? echo $bayar ?>" tabindex="2">
					  </font></td><td width="21">&nbsp;</td>
						</tr>
					<font size="-1">						</font>
					<tr>
						<td align="right">&nbsp;</td><td align="right"><font size="-2">
							  <div align="right">Kembali </div>
							</font></td>
						<td width="122" align="right"><font size="0">
						  <input type="text" name="kembali" size="20" value="<?php rupiah($kembali)?>" readonly=>
					  </font></td><td width="21">&nbsp;</td>
						</tr>
					<font size="-1">
						
						</font>
						<tr>
						<td>&nbsp;</td>
						<td align="right"><input type="submit" name="Bayar" value="Bayar" >
						</td>
						</tr></form>
						<tr>
						<td>&nbsp;</td>
						<td align="right"><form method="post" action="../action/batal_transaksi2.php">
						<input type="hidden" name="no_trans" value="<?=$no_trans?>">
						<input type="submit" name="Batal" value="Batal Transaksi">
						</form></td>
						</tr>
						</table>

									
									
									<?php
										echo "</td>
												</tr>";
									
									
									echo "</fieldset><br>";
									
								?>
							</td>
						</tr>
					
					</div>
					</font>
					</td>
					
				</tr>
			
	</tr>
	<tr>
		<td></td>
	</tr>
</table>
</body>
</html>