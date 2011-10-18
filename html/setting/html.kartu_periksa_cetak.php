<? include_once KOMPONEN_DIR . "header_cetak.php"; ?>
<table cellpadding="0" cellspacing="0" border="0" style="overflow: hidden; width: 8.5cm; height: 5cm; border: 1pt solid #000000; padding: 2mm 2mm 2mm 2mm;">
	<tr>
		<th colspan="3" style="text-align: center;">
			<div style="font-size: 11pt;"><?=$_SESSION[setting][rs_nama]?></div>
			<div style="font-size: 5pt;"><?=$_SESSION[setting][rs_alamat]?> Telp. <?=$_SESSION[setting][rs_telp]?></div>
			<hr />
		</th>
	</tr>
	<tr>
		<td colspan="3" style="vertical-align:top;text-align:center;">
			<div style="font-size:10pt;font-weight:bold;">KARTU IDENTITAS BEROBAT</div>
		</td>
	</tr>
	<tr>
		<td><B>Nama</B></td>
		<td>:</td>
		<td><?=$data[nama]?></td>
	</tr>
	<tr>
		<td><B>Sex</B></td>
		<td>:</td>
		<td><?=$data[jk]?></td>
	</tr>
	<tr>
		<td style="vertical-align:top;"><b>Alamat</b></td>
		<td style="vertical-align:top;">:</td>
		<td><?=$data[alamat]?></td>
	</tr>
	<tr>
		<td colspan="3">
			<table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
				<tr>
					<td>
						<img src="<?=URL?>pendaftaran/no_rm_barcode/?code=<?=$data[pasien_id]?>&style=324&type=C128C&width=200&height=60&xres=2&font=3" alt="<?=$data[pasien_id]?>" />
					</td>
					<td style="">
						<div style="font-weight:bold;font-size:10pt;text-align:center;border:solid 1px #000000;line-height:30pt;"><?=$data[no_rm]?></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<? include_once KOMPONEN_DIR . "footer_cetak.php"; ?>