<? include KOMPONEN_DIR . "header_cetak.php"; ?>
<table cellpadding="2" cellspacing="0" border="0" style="border:solid 1px #000000;width:9cm;">
	<tr>
		<th style="text-align: center;">
			<div style="font-size: 11pt;"><?=$_SESSION[setting][rs_nama]?></div>
			<div style="font-size: 5pt;"><?=$_SESSION[setting][rs_alamat]?> Telp. <?=$_SESSION[setting][rs_telp]?></div>
			<hr />
		</th>
	</tr>
	<tr>
		<td>
			<table cellpadding="0" cellspacing="5" border="0" class="form">
				<tr>
					<td style="width: 120px;">No. Kwitansi</td>
					<td><?=$_GET[id_kwitansi]?></td>
				</tr>
				<tr>
					<td>Tgl Bayar</td>
					<td><?=tanggalIndo($data_kw[tgl], "j F Y H:i")?></td>
				</tr>
				<tr>
					<td>No. RM</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][id_display]?></td>
				</tr>
				<tr>
					<td style="vertical-align:top">Nama Pasien</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][nama]?></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][jk]?></td>
				</tr>
				<tr>
					<td>Usia</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][usia]?></td>
				</tr>
				<tr>
					<td style="vertical-align:top">Alamat</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][alamat]?></td>
				</tr>
				<tr>
					<td>Tgl Periksa</td>
					<td><?=tanggalIndo($_SESSION[radio][langsung_bayar][data_px][tgl_periksa], "j F Y")?></td>
				</tr>
				<tr>
					<td style="vertical-align:top">Cara Bayar</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][cara_bayar]?></td>
				</tr>
				<tr>
					<td>Nomor</td>
					<td><?=$_SESSION[radio][langsung_bayar][data_px][nomor]?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><?=$tabel_jasa?></td>
	</tr>
	<tr>
		<td>
		<?=$_SESSION[setting][rs_kabupaten] . ", " . tanggalIndo(date('Y-m-d'), 'j F Y')?>
			<br />
			Petugas,
			<br />
			<br />
			<br />
			<br />
			(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)
		</td>
	</tr>
</table>
<? include KOMPONEN_DIR . "footer_cetak.php"; ?>