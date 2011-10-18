<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
			$.post("action/string_daftar_barang.php", {mysearchString: ""+inputString+""}, function(data){
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
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Permintaan Stok</b></font></td>
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
							<td align="right"></td>
							<td width="180px" align="right">
								<!--
								<input type="button" src="javascript:void(0);" onClick="PopupCenter('content/input_daftar_barang.php', 'myPop1',400,400);" value="Tambah Data">
								-->
								
							</td>
						</tr>
					</table>
					<hr>
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
							<?php
                            $date = date("d/m/Y");
							$pdate = date ("d") + 0;
							$pmonth = date("m") + 1;
							$ppmonth = date ("m") + 0;
							$pyear = date("Y") + 0;
                            
//							$query2  = mysql_query ("SELECT * FROM ms_barang WHERE stok_min >= stok  and flags <> '2' group by kd_barang ORDER BY expire_date ASC");
                            $query2 = mysql_query("select * from v_ps where stok_min >= stok and flags <> 9");
							echo '<table cellpadding=2 cellspacing=2 width=100% style="border:1px  solid  #CCCCCC; ">
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF width=100px>Nama</font></td>
										<td><font color=#FFFFFF>Stok</font></td>
										<td><font color=#FFFFFF width=80px>H Beli</font></td>
                                        <!--<td><font color=#ffffff width=80px> Batch No </font></td>-->
										<td><font color=#FFFFFF width=70px>Expired</font></td>
										<td><font color=#FFFFFF >Action</font></td>
									</tr>';
									$no = 1;
									echo '<form method=post action=home.php?hal=action/insert_req_pembelian enctype=multipart/form-data>';
									while ($result2 = mysql_fetch_array($query2))									
                                    {
									   
										if ($no%2)
										{
												echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										
										
										echo "<td width=70px>$result2[kd_barang]</td>
											<td>$result2[nama]</td>
											<td align=right>$result2[stok]</td>
											<td align=right>";
											rupiah($result2[harga_dosp]);
											echo "</td> <!--<td width=80px align='center'> $result2[no_batch]</td>-->";
                                            
                                            $dbdate = $result2['expire_date'];
                                            $dbpdate = date("d",strtotime($dbdate));
                                            $dbpmonth = date("m",strtotime($dbdate));
                                            $dbpyear = date("Y",strtotime($dbdate));
                                            if (($pmonth == $dbpmonth) and ($pyear == $dbpyear)){
                                                echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
                                            }else if (($pmonth > $dbpmonth) AND ($pyear > $dbpyear) AND ($pdate > $dbpdate)){
												//$qy = mysql_query("UPDATE ms_barang SET status='Non-Aktif' WHERE id='$result[id]'"); 
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}else if (($ppmonth == $dbpmonth) AND ($pyear == $dbpyear)){
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
											}else{ echo "<td width=70px align=center>$result2[expire_date]</td>"; }											
											echo "<td align=center width=140px>";
                                            $sm = "";
											$qreq = mysql_query("SELECT aktivasi FROM req_pembelian WHERE kd_barang='$result2[kd_barang]' and aktivasi =1 order by aktivasi ASC");
											//$rreq = mysql_fetch_row($qreq);
                                            $sm = mysql_fetch_array($qreq);
//                                            print_r ($sm);
                                            mysql_freeresult($qreq);

                                             if ((!empty($sm))&& ($sm['aktivasi']= '1')){
                                                 echo "<input type=checkbox name='pq".$no."' CHECKED>" ;
                                                 echo "<input type=hidden name='ap".$no."' value='".$result2['id']."'>";
//                                                 echo ("SELECT kd_barang, aktivasi FROM req_pembelian WHERE kd_barang='$result2[kd_barang]' order by aktivasi ASC");
//                                                 print_r($sm);
//                                                 $sm=0;
                                              }else{
                                                  echo "<input type=checkbox name='pq".$no."'>"  ;
                                                  echo "<input type=hidden name='ap".$no."' value='".$result2['id']."'>";
//                                                  echo ("SELECT kd_barang, aktivasi FROM req_pembelian WHERE kd_barang='$result2[kd_barang]' order by aktivasi ASC");
//                                                  print_r($qreq);                                                
                                              }
/*											if ($rreq)
											{
												if ($rreq['aktivasi']="1")
												{
													echo "<input type=checkbox name='ap".$no."' value='".$result2['kd_barang']."' checked>";
                                                    echo "<input type=hidden name='pq".$no."'value=1>";
												}
												else
												{
													echo "<input type=checkbox name='ap".$no."' value='".$result2['kd_barang']."'>";
                                                    echo "<input type=hidden name='pq".$no."' value = 0>";
												}
											}
											else
											{
												echo "<input type=checkbox name='ap".$no."' value='".$result2['kd_barang']."'>";
                                                echo "<input type=hidden name='pq".$no."' value = 0>";
											}
*/											echo "</td></tr>";
										$no++;
									}
									$no_f=$no-1;
                                    mysql_free_result($query2);
									echo "<input type=hidden name=param value='$no_f'>";
                                    if ($no==1){
                                        echo "<tr><td colspan=7 align=right><input type=submit value='Buat Request' disabled='true'></td></tr>";
                                    }else{
                                        echo "<tr><td colspan=7 align=right><input type=submit value='Buat Request'></td></tr>";
                                    }
                                    
									
									echo '</form></table>';
							?>
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