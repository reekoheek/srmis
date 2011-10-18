<?php
include "./../include/fungsi_rp.php";
include "./../include/koneksi.php";

$id_resep=$_GET['no_resep'];
									$no=1;					
									$qr=mysql_query("select * from resep where no_resep='$id_resep'");
									echo "<table border=0 cellpadding=2 cellspacing=2 width=800px style='border:0px  solid  #CCCCCC overflow:scroll';>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF width=65px>Kode</font></td>
												<td><font color=#FFFFFF width=250px>Obat</font></td>
												<td><font color=#FFFFFF width=45px>Racikan</font></td>
												<td><font color=#FFFFFF width=160px>Dosis</font></td>
												<td><font color=#FFFFFF width=40px>Jml</font></td>
												<td><font color=#FFFFFF width=90px>Harga</font></td>
												<td><font color=#FFFFFF width=90px>Sub Total</font></td>
												<td><font color=#FFFFFF>Ket</font></td>
											</tr>";
											
									
									
					
									while ($rr = mysql_fetch_array($qr))
									{
			
										$qo = mysql_query ("SELECT * FROM ms_barang WHERE kd_barang = '$rr[kode_obat]'");
										$ro = mysql_fetch_array($qo);
										
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
										if($rr['racikan']=='YA')
											{
											echo "<td width=65px>$rr[fld02]</td>";
											}else
											{
										echo "<td width=65px>$rr[kode_obat]</td>";
											}
											if($rr['racikan']=='YA')
											{
												echo "<td width=250px><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_resep=$rr[no_resep]&no_racik=$rr[fld02]', 'myPop1',800,400);\">$rr[fld01]</a></td>";
											}
											else
											{
												echo "<td width=250px>$ro[nama]</td>";
											}
										echo "<td width=45px align=center>$rr[racikan]</td>
											<td width=160px>$rd[deskripsi] ($rr[ket])</td>
											<td width=40px align=right>$rr[diberi]</td>
											<td align=right width=90px>";
											 	rupiah($ro[harga_dosp]);
										echo "</td>
											<td align=right width=90px>";
											 	rupiah($rr[sub_total]);
										echo "</td>
											<td>$rr[ket_banyak]</td>
											</tr> ";
										$no++;
										
									}
									echo "<tr>
											<td colspan=8>
											</table>";
									?>