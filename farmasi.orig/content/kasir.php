<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Transaksi Penjualan</title>
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
(pageURL, title, 'toolbar=no, alwaysraised='+1+', fullScreen=no, locationbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top=0, left=0');
this.targetWin.focus();
}
</script>


<style type="text/css">
<!--
-->
</style>
</head>
<body>
<?php
if($_GET['no_transaksi'])
{
$no_trans=$_GET['no_transaksi'];
}
else
{


$date = date("d/m/Y");
	//$no_SPP = $_POST['no_SPP'];	
$month = date("m");
$qp= mysql_query("SELECT * FROM penjualan_head WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

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

$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_trans = "TRK/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;
}
//print $param_no;
//print ($month);
//print ($tgl);
//die ($no_trans);
$sql="select * from penjualan_head where no_trans='$no_trans'";
$pjl=mysql_query($sql);
$row=mysql_fetch_array($pjl);
$jenis =$row['flags'];




?>


<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;<b><font color="#fefafa">Transaksi Penjualan Umum </font></b></td>
				<td bgcolor="">&nbsp;<b><font color="#1bda01"></font></b></td>
			</tr>
			
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
	<td id="tengah_isi"><font size="-1.5"><table cellpadding="0" cellspacing="0"><tr><td width="15px">&nbsp;</td>
	<td width="200px"> Petugas : <? echo $_SESSION['U_USER']; ?></td>
	<td align="right" width="470px">
	<a href="home.php?hal=content/lap_kasir&date=<? echo $date; ?>" > Laporan Kasir</a>
					| <a href="home.php?hal=content/menu_kasir">Menu Kasir</a></td></tr></table></font>
	</td>
	</tr>
	<tr>
	
    <?php
//        include ('kasir_container.php');
    ?>
		<td id="tengah_isi">
			        <table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="center">
							<div id="container">
			<div style="border:1px  solid  #CCCCCC; width:670px; height:400px;">					
								<form method="post" action="home.php?hal=action/insert_data_transaksi_umum" enctype="multipart/form-data">
							<input type="hidden" name="param_no" value="<? print($param_no); ?>">
								  <table width="700" border="0">
                                    <tr>
                                      <td width="130">No. Transaksi </td>
                                      <td width="285"><label>
                                        <input type="text" name="textfield" value="<?  echo $no_trans;   ?>" readonly="" style="background-color:#BBBBBB"/>
                                      </label></td>
									  <td colspan="3"><table><tr><td width="235"><div align="right">Tanggal : 
									    <? $tgl=date("d-m-Y"); $tsh=date("d M Y"); echo"<strong>$tsh</strong>"; ?>
									  </div></td><td width="24">&nbsp;</td>
									  </tr></table></td>
								    </tr>
                                    <tr>
                                      <td>Jenis Resep									  </td>
                                      <td><label>
                                      <!--
                                      onChange="window.location='home.php?hal=content/kasir?cmb_jenis='+this.options[this.selectedIndex].value">
                                      -->
                                        <select id="cmb_jenis" name="cmb_jenis" onchange="window.location='home.php?hal=content/kasir&cmb_jenis=' + this.options[this.selectedIndex].value+'&textfield='+textfield.value">
											<option value="">--Pilihan--</option>
											<?php
												if ($_GET['cmb_jenis'])
												{$jns = $_GET['cmb_jenis'];}
												else
												{$jns= "";}
												if ($jns==0)
													{
													echo "<option value=0 selected>Penjualan Umum</option>";
                                          			echo "<option value=1>Resep Lain</option>";
													}
												else 
													{
													echo "<option value=0>Penjualan Umum</option>";
                                          			echo "<option value=1 selected>Resep Lain</option>";
													}
												
											?>
                                        </select>
										<input type="hidden" value="<? echo $_GET['cmb_jenis'];?>" name="jenis">
										
                                       
                                      </label></td>
                                    </tr>
									<tr>
									<td>Tipe Pembayaran</td>
									<td><strong><em> Tunai</em></strong></td>
									</tr>
									<?php
									
									 if (($_GET[cmb_jenis]=='1') || ($jenis=='4'))
									 {
									 
									 echo"
									<tr>
									<td>No. Resep
									  </td>
									<td>
									  <input type=\"text\" name=\"txt_no_resep\" value=$row[no_resep]>
									</td>
									<tr>";
									
									}
									if(($_GET[cmb_jenis]=='0') || ($jenis=='3'))
									{
									 echo"
									
									  <input type=\"hidden\" name=\"txt_no_resep\" value=$row[no_resep]>
									
									";
									}
									?>
									<td>Nama Pasien									</td>
									<td><input type="text" name="txt_nama" value="<?=$row['fld01'];?>">									</td>
									</tr>
									<?php
									if(($_GET[cmb_jenis]=='1') || ($jenis=='4'))
									{
									echo"
									<tr>
									<td>Rumah Sakit</td>
									<td><input type=\"text\" name=\"txt_rumahsakit\" value=$row[fld02]></td>
									</tr>";
									}
									?>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td align="right" width="240"><input value="Tambah Obat" type="submit"></td>
									<td width="27">&nbsp;</td>
									</tr>
									
                                  </table>
								  
								 
								</form>
				
			
					<div style="border:1px  solid  #CCCCCC; width:650px; height:220px; overflow:scroll;">	
									  
								<?php
									$q = mysql_query ("SELECT * FROM penjualan WHERE no_trans = '$no_trans'");
									echo '<table border=0 cellpadding=0 cellspacing=2 width=650px>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>Nama Obat</font></td>
												<td><font color=#FFFFFF>Racikan</font></td>
												<td><font color=#FFFFFF>Dosis</font></td>
												<td><font color=#FFFFFF>Jml</font></td>
												<td><font color=#FFFFFF>Harga</font></td>
												<td><font color=#FFFFFF>Sub Total</font></td>
												<td><font color=#FFFFFF>Ket</font></td>
												<td><font color=#FFFFFF width=60px>Action</font></td>
											</tr>';
									$no = 1;
									while ($d_trans = mysql_fetch_row($q))
									{
										$id=$d_trans[0];
										$k_obat=$d_trans[3];
										$id_dosis=$d_trans[5];
										$racik=$d_trans[13];
										$jml=$d_trans[7];
										$subtotal=$d_trans[11];
										$ket=$d_trans[8];
										$q_bar=mysql_query("select * from ms_barang where kd_barang='$k_obat'");
										$ro = mysql_fetch_array($q_bar);
										
										$q_dosis = mysql_query ("SELECT * FROM dosis WHERE id = '$id_dosis'");
										$rd = mysql_fetch_array($q_dosis);
										$q_rac=mysql_query("select * from racik_head where no_racik='$racik'");
										$r_rac=mysql_fetch_array($q_rac);
										echo"<td>"; if($d_trans[9]=="YA"){
							echo $r_rac['nama']." (racikan)";
														$jml=1;
							}
						else
							{
								echo $ro["nama"];
							}
							echo "</td>
											<td align=center>";
											if($d_trans[9]=="YA"){
											 echo $r_rac['nama'];
											 
											 $jml=1;
											 }
											 else
											 {
											 echo "-";
											 }
											echo "</td>
											<td align=center>$rd[deskripsi]</td>
											<td align=right>$jml</td>
											<td align=right>"; if($d_trans[9]=="YA"){ 
											rupiah($subtotal); }else{ rupiah($ro['harga_dosp']); } echo"</td>
											<td align=right>"; rupiah($subtotal); echo"</td>
											<td align=center>$ket</td>
											<td align=center><a href=\"home.php?hal=action/hapus_transaksi_obat&id=$id&kd_barang=$k_obat&diberi=$jml&no_transaksi=$no_trans\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $ro[nama]?')\">
											<font size=-1>HAPUS</font></a></td>";
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										
											
											
										echo "</td>
											</tr>";
										$no++;
									}
									echo '</table>';
								?>
							  </div>
							
							</td>		
						</tr>
						<form action="home.php?hal=content/kasir&no_transaksi=<? echo $no_trans; ?>"  method="post" >
						<?php
					$q3=mysql_query("SELECT SUM(sub_total) FROM penjualan WHERE no_trans = '$no_trans'");
					$r3=mysql_fetch_array($q3);
					
					
					$sub = $r3['SUM(sub_total)'];
					$ppn = (10/100) * $sub;
					$grand = $sub + $ppn;
					$bayar=$_POST['u_bayar'];
					if($_POST['u_bayar']){
						if($u_bayar<$grand){ echo"<script>alert('Maaf, Uang Anda Kurang');location.href='home.php?hal=content/kasir&no_transaksi=$no_trans'</script>"; }
						else
						{
					$kembali=$bayar-$grand;
				print "<script>alert('Menyimpan transaksi $_GET[no_transaksi] . Tunai : $_POST[u_bayar] .  Kembali : $kembali ');location.href='home.php?hal=action/insert_total_pembayaran&no_transaksi=$no_trans&bayar=$bayar&total=$grand'</script>";
	}
/*	
print "<script>confirm('Apakah Anda  mencetak transaksi $_GET[no_transaksi] . Tunai : $_POST[u_bayar] .  Kembali : $kembali ?');PopUpCenter('home.php?hal=content/cetak_struk_penjualan&no_transaksi= $no_trans','Cetak Struk',400,400)</script>";
*/				}
					else
					{
					$bayar=0;
					$kembali=0;
					}
					?>
				
						<tr>
							<td align="right"><p>Sub Total : 
							<input type="hidden" name="trans" value="<? echo $textfield; ?>" >
						      <input type="text" name="sub_tot" size="20"  align="right" value="<?php rupiah($r3['SUM(sub_total)'])?>" readonly="yes"></p> <p>PPN : 
							    <input type="text" name="ppn" size="20" align="right" value="10% (<?php rupiah($ppn)?>)" readonly="yes"></p> <p>Grand Total : 
							  <input type="text" name="grand_total" size="20" align="right" value="<?php rupiah($grand)?>" readonly="yes">
						      </p>
						  <p><? $no_trans; ?>Bayar : <input type="text" name="u_bayar"size="20" align="right" value="<?php echo $bayar ?>" onKeyPress="<script>if(event.keyCode<49 || evebt.keyCode>57)event.returnValue=false;</script>"></p>
						  
						  
						  <p>Kembali : <input type=\"text\" size=\"20\" align=\"right\" value="<? rupiah($kembali) ?>"></p><input type="submit" name="byr" style="visibility:hidden"  ></td>
						</tr>
						</form>
					</table>

					<hr>
					<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 250px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
					
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								
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
		<td><img src="images/bawah_isi.png" /></td>
	</tr>
</table>
</body>
</html>