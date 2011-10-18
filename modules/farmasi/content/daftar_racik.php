<?php
	include "../include/koneksi.php";
	include ".../include/fungsi_rp.php";
	$query2  = mysql_query ("SELECT * FROM ms_barang,racik_detail WHERE ms_barang.kd_barang = racik_detail.kode_obat
										AND racik_detail.no_resep='".$_GET['no_resep']."'");
																		
							echo "<div style='border:1px  solid  #CCCCCC; width:100%; height=400px; overflow:auto;'>";
								echo '<table cellpadding=2 cellspacing=2 width=100%>
									
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=70px>Kode</font></td>
										<td><font color=#FFFFFF width=130px>Nama</font></td>
										<td><font color=#FFFFFF width=30px>Satuan</font></td>
										<td><font color=#FFFFFF width=20px>QTY</font></td>
										<td><font color=#FFFFFF width=100px>Expired</font></td>
										<td><font color=#FFFFFF width=120px>Harga</font></td>
										<td><font color=#FFFFFF width=20px>Sub Total</font></td>
									</tr>';
									$no = 1;
									
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
											<td width=120px>$result2[nama]</td>
											<td width=30px align=left>$result2[satuan]</td>
											<td width=30px align=right>$result2[qty]</td>";
											
											//echo "<td></td>";
											if (($pmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{ 
												echo "<td width=70px align=center><font color=blue>$result[expire_date]</font></td>";
											}
											else if (($pmonth > $result2['ex_month']) AND ($pyear > $result2['ex_year']) AND ($pdate > $result2['ex_date'])) 
											{
												$qy = mysql_query("UPDATE ms_barang SET status='Non-Aktif' WHERE kd_barang='$result[kd_barang]'"); 
												echo "<td width=70px align=center><font color=red>$result2[expire_date]</font></td>";
											}
											else if (($ppmonth == $result2['ex_month']) AND ($pyear == $result2['ex_year']))
											{
												echo "<td width=70px align=center><font color=blue>$result2[expire_date]</font></td>";
											}
											else
											{
											 	echo "<td width=70px align=center>$result2[expire_date]</td>";
											}
											
										
											echo "<td align=left width=70px>"; rupiah($result2['harga']); echo "</td>
												  <td align=center width=70px>";rupiah($result2['subtotal']); echo "</td>
												  </td>";
											echo"</tr>";
										
										$no++;
									}
?>

