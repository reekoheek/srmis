<? include KOMPONEN_DIR . "header_cetak_portrait.php"; ?>
<table cellpadding="0" cellspacing="0" border="0" style="width: 20.5cm;font-size:8pt;">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width: 20cm;" class="print-lap-header">
				<tr>
					<th style="text-align: center;" colspan="3">
					DATA DASAR RUMAH SAKIT<br /> 
					Keadaan 31 Desember <span id="keadaan_tahun"></span>
					</th>
				</tr>
				<tr>
					<th style="text-align: left;">Formulir RL3</th><th></th><th style="text-align: right;"></th>
				</tr>
			</table>
			<table cellpadding="2" cellspacing="2" border="0" style="width: 20cm;border:solid 1px #000000">
				<tr>
					<td>
						<table cellpadding="2" cellspacing="2" border="0">
							<tr>
								<td>1. </td>
								<td>Nomor Kode RS</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_kode]?></td>
							</tr>
							<tr>
								<td>2. </td>
								<td>Nama Rumah Sakit</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_nama]?></td>
							</tr>
							<tr>
								<td>3. </td>
								<td>Jenis Rumah Sakit</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_jenis]?></td>
							</tr>
							<tr>
								<td>4. </td>
								<td>Kelas Rumah Sakit</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_kelas]?></td>
							</tr>
							<tr>
								<td>5. </td>
								<td>Nama Direktur RS</td>
								<td>:</td>
								<td><?=$_SESSION[setting][dir_nama]?></td>
							</tr>
							<tr>
								<td>6. </td>
								<td>Alamat/Lokasi RS</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_alamat]?></td>
							</tr>
							<tr>
								<td></td>
								<td>Kab/Kota</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_kabupaten]?> Kode Pos. <?=$_SESSION[setting][rs_kode_pos]?></td>
							</tr>
							<tr>
								<td></td>
								<td>Telepon/Fax/Email</td>
								<td>:</td>
								<td><?=$_SESSION[setting][rs_telp]?>/ <?=$_SESSION[setting][rs_fax]?>/ <?=$_SESSION[setting][rs_email]?></td>
							</tr>
							<tr>
								<td>7. </td>
								<td>Surat Ijin Penetapan</td>
								<td>:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>a. Nomor</td>
								<td>:</td>
								<td><?=$_SESSION[setting][si_nomor]?></td>
							</tr>
							<tr>
								<td></td>
								<td>b. Tanggal</td>
								<td>:</td>
								<td><?=tanggalIndo($_SESSION[setting][si_tanggal], "d F Y")?></td>
							</tr>
							<tr>
								<td></td>
								<td>c. Oleh</td>
								<td>:</td>
								<td><?=$_SESSION[setting][si_oleh]?></td>
							</tr>
							<tr>
								<td></td>
								<td>d. Sifat</td>
								<td>:</td>
								<td>
									<table cellpadding="0" cellspacing="2" border="0">
										<tr>
											<?if ($_SESSION[si_sifat] == "Sementara") :?>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Sementara</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Tetap</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Perpanjangan</td>
											<?elseif ($_SESSION[si_sifat] == "Tetap") :?>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Sementara</td>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Tetap</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Perpanjangan</td>
											<?else :?>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Tetap</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Sementara</td>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Perpanjangan</td>
											<?endif;?>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>e. Masa Berlaku</td>
								<td>:</td>
								<td>Sampai Tahun <?=$_SESSION[setting][si_berlaku_sampai]?></td>
							</tr>
						</table>
					</td>
					<td>
						<table cellpadding="0" cellspacing="2" border="0">
							<tr>
								<td>8. </td>
								<td>Kepemilikan RS</td>
								<td>:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>a. Nama</td>
								<td>:</td>
								<td><?=$_SESSION[setting][milik_nama]?></td>
							</tr>
							<tr>
								<td></td>
								<td>b. Status</td>
								<td>:</td>
								<td><?=$_SESSION[setting][milik_status]?></td>
							</tr>
							<tr>
								<td>9. </td>
								<td colspan="2">Khusus Untuk Swasta berilah tanda (&radic;)</td>
								<td>:</td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3">
									<table cellpadding="0" cellspacing="2" border="0">
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Islam") echo "&radic;";?></td><td>Islam</td>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Hindu") echo "&radic;";?></td><td>Hindu</td>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Perorangan") echo "&radic;";?></td><td>Perorangan</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Katholik") echo "&radic;";?></td><td>Katholik</td>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Budha") echo "&radic;";?></td><td>Budha</td>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Perusahaan") echo "&radic;";?></td><td>Perusahaan</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Protestan") echo "&radic;";?></td><td>Protestan</td>
											<td style="border: solid 1px #000000; width: 0.5cm"><?if($_SESSION[setting][rs_agama] == "Organisasi Sosial") echo "&radic;";?></td><td colspan="3">Organisasi Sosial</td>
										</tr>
									</table>
								
								</td>
							</tr>
							<tr>
								<td>10. </td>
								<td>Akreditasi RS</td>
								<td>:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>Pentahapan</td>
								<td>:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3">
									<table cellpadding="0" cellspacing="2" border="0">
										<tr>
											<?if ($_SESSION[akr_tahap] == "I") :?>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>I<br />5 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>II<br />12 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>III<br />16 Pelayanan</td>
											<?elseif ($_SESSION[akr_tahap] == "II"):?>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>I<br />5 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>II<br />12 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>III<br />16 Pelayanan</td>
											<?else:?>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>I<br />5 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm"></td><td>II<br />12 Pelayanan</td>
												<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>III<br />16 Pelayanan</td>
											<?endif;?>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td></td>
								<td>Status</td>
								<td>:</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="3">
									<table cellpadding="0" cellspacing="2" border="0">
										<?if ($_SESSION[akr_status] == "Penuh"):?>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Penuh</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Bersyarat</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Gagal</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Belum</td>
										</tr>
										<?elseif ($_SESSION[akr_status] == "Bersyarat"):?>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Penuh</td>
											<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Bersyarat</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Gagal</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Belum</td>
										</tr>
										<?elseif ($_SESSION[akr_status] == "Gagal"):?>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Penuh</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Bersyarat</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Gagal</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Belum</td>
										</tr>
										<?else:?>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Penuh</td>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Bersyarat</td>
										</tr>
										<tr>
											<td style="border: solid 1px #000000; width: 0.5cm"></td><td>Gagal</td>
											<td style="border: solid 1px #000000; width: 0.5cm">&radic;</td><td>Belum</td>
										</tr>
										<?endif;?>
									</table>
								
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="">
						<b>11. Fasilitas Tempat Tidur Rawat Inap</b>
						<div id="list_data"><?=$ret_1?></div>
					</td>
				</tr>
			</table>
			*) Apabila tidak terdapat pemisahan jenis pelayanan menurut spesialisasi, dimasukkan kedalam Jenis Pelayanan Umum
		</td>
	</tr>
</table>
<hr style="width:1cm;page-break-after:always;" />
<table cellpadding="0" cellspacing="0" border="0" style="width: 20.5cm;">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" style="width: 20cm;" class="print-lap-header">
				<tr>
					<th style="text-align: center;" colspan="3">
					DATA DASAR RUMAH SAKIT<br /> 
					Keadaan 31 Desember <span id="keadaan_tahun_2"></span>
					</th>
				</tr>
				<tr>
					<th style="text-align: left;"></th><th></th><th style="text-align: right;">Formulir RL3</th>
				</tr>
				<tr>
					<th style="text-align: left;">12. Fasilitas Unit Rawat Jalan (Poliklinik)</th><th></th><th style="text-align: right;">Halaman 2</th>
				</tr>
			</table>
			<div id="list_data_2" style="border:solid 1px #000000;width: 100%;"><?=$ret_2?></div>
			*) Isilah kotak yang tersedia dengan HARI BUKA KLINIK dalam seminggu<br />
			**) Asma termasuk alergi yang Immunologi, Paru Kerja termasuk PPOM
		</td>
	</tr>
</table>
<? include KOMPONEN_DIR . "footer_cetak.php"; ?>