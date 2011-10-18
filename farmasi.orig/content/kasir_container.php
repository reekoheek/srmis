<?php

/**
 * @author Richard
 * @copyright 2011
 */



?>


		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td align="right">
								<div id="container">
			<div style="border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;">
								<form method="post" action="home.php?hal=content/kasir" enctype="multipart/form-data">
								  <table width="700" border="0">
                                    <tr>
                                      <td width="130">No. Transaksi </td>
                                      <td width="285"><label>
                                        <input type="text" name="textfield" />
                                      </label></td>
									  <td width="70">Tanggal</td>
									  <td width="197"><? $tgl=date("d-m-y"); echo"$tgl"; ?></td>
                                    </tr>
                                    <tr>
                                      <td>Jenis Resep 
									 
									  
									  </td>
                                      <td><label>
                                      <!--
                                      onChange="window.location='home.php?hal=content/kasir?cmb_jenis='+this.options[this.selectedIndex].value">
                                      -->
                                        <select id="cmb_jenis" name="cmb_jenis" onchange="window.location='home.php?hal=content/kasir?cmb_jenis=' + this.options[this.selectedIndex].value" >
											<option value="">--Pilihan--</option>
                                          <option value="0">Penjualan Umum</option>
                                          <option value="1">Resep Lain</option>
                                        </select>
                                       
                                      </label></td>
                                    </tr>
									<tr>
									<td>Tipe Pembayaran</td>
									<td><strong><em> Tunai</em></strong></td>
									</tr>
									<?php
									
									 if ($_GET[cmb_jenis]=='1')
									 {
									 
									 echo"
									<tr>
									<td>No. Resep
									  </td>
									<td>
									  <input type=\"text\" name=\"txt_no_resep\">
									</td>
									<tr>";
									}
									?>
									<td>Nama Pasien									</td>
									<td><input type="text" name="txt_nama">									</td>
									</tr>
									<?php
									if($_GET[cmb_jenis]=='1')
									{
									echo"
									<tr>
									<td>Rumah Sakit</td>
									<td><input type=\"text\" name=\"txt_rumahsakit\"></td>
									</tr>";
									}
									?>
									<tr>
									<td>&nbsp;</td>
									<td><input name="simpan" type="submit" id="simpan" value="Simpan">
									  <label>
									  <input name="Reset" type="reset" id="Reset" value="Reset">
									  </label></td></tr>
                                  </table>
								  <p align="left">&nbsp;</p>
								</form>
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
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top>";
										}
										echo "<td>$r[kode_obat]</td>";
											if($r['racikan']=='YA')
											{
												echo "<td><a href='javascript:void(0);' onClick=\"PopupCenter('content/daftar_racik.php?no_resep=$r[no_resep]', 'myPop1',800,400);\">$r[fld01]</a></td>";
											}
											else
											{
												echo "<td>$ro[nama]</td>";
											}
											echo "<td>$r[racikan]</td>
											<td>$rd[deskripsi] ($r[ket])</td>
											<td>$r[diberi]</td>
											<td align=right>";
											 	rupiah($ro[harga_dosp]);
										echo "</td>
											<td align=right>";
											 	rupiah($r[sub_total]);
										echo "</td>
											<td>$r[ket_banyak]</td>
											<td align=center width=60px>";
											
											if ($r['racikan']=='YA')
											{
											echo"<a href=\"home.php?hal=content/racik_obat&no_racik=$r[fld02]&id=$r[id]&pasien_id=$id&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no\">
											<font size=-1>EDIT</font></a>";
											}
											else
											{
											echo"<a href=\"home.php?hal=action/hapus_resep_reg&id=$r[id]&pasien_id=$id&kd_barang=$r[kode_obat]&diberi=$r[diberi]&no_resep=$no_resep&param_no=$param_no\" 
											onClick=\"return confirm('Apakah Anda benar-benar akan menghapus $ro[nama]?')\">
											<font size=-1>HAPUS</font></a>";
											}
										echo "</td>
											</tr>";
										$no++;
									}
									echo '</table>';
								?>
								</div>
								<!-- hide our suggesetion box to begin with-->
    							<div class="suggestionsBox" id="suggestions" style="display: none;" align="left">
        							<img src="upArrow.png" style="position: relative; top: -18px; left: 250px;" alt="upArrow" />
        						<div class="suggestionList" id="autoSuggestionsList"></div>
    							</div>
								</div>
							</td>		
						</tr>
					</table>
					<hr>
					
					
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