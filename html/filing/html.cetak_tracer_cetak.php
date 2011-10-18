<? include KOMPONEN_DIR . "header_cetak.php"; ?>
<? for($i=0;$i<sizeof($data);$i++) :?>
<table cellpadding="0" cellspacing="0" border="0" style="overflow: hidden; width: 8.5cm; height: 3cm; border: 1pt solid #000000; padding: 2mm 2mm 2mm 2mm;">
	<tr>
		<td colspan="3" style="vertical-align:top;text-align:center;">
			<div style="font-size:10pt;font-weight:bold;">TRACER&nbsp;<?=$poli[$i]?></div>
		</td>
	</tr>
	<tr>
		<td style="width:100px;"><b>No. RM</b></td>
		<td>:</td>
		<td><?=$data[$i][no_rm]?></td>
	</tr>
	<? if($data[$i][no_antrian]) : ?>
	<tr>
		<td><b>No. Antrian</b></td>
		<td>:</td>
		<td><?=$data[$i][no_antrian]?></td>
	</tr>
	<? endif; ?>
	<tr>
		<td><b>Pasien</b></td>
		<td>:</td>
		<td><?=$data[$i][nama]?></td>
	</tr>
	<? if($data[$i][dokter]) : ?>
	<tr>
		<td><b>Dokter</b></td>
		<td>:</td>
		<td><?=$data[$i][dokter]?></td>
	</tr>
	<? endif; ?>
	<? if($data[$i][tgl_periksa]) : ?>
	<tr>
		<td><b>Tgl Kunjung</b></td>
		<td>:</td>
		<td><?=tanggalIndo($data[$i][tgl_periksa], 'j F Y')?></td>
	</tr>
	<? endif; ?>
	<? if($data[$i][tgl_pinjam]) : ?>
	<tr>
		<td><b>Tgl Pinjam</b></td>
		<td>:</td>
		<td><?=tanggalIndo($data[$i][tgl_pinjam], 'j F Y')?></td>
	</tr>
	<? endif; ?>
	<? if($data[$i][peminjam]) : ?>
	<tr>
		<td><b>Peminjam</b></td>
		<td>:</td>
		<td><?=$data[$i][peminjam]?></td>
	</tr>
	<? endif; ?>
	<tr>
		<td><b>Keperluan</b></td>
		<td>:</td>
		<td><?=$data[$i][keperluan]?></td>
	</tr>
</table>
<br />
<table cellpadding="0" cellspacing="0" border="0" style="overflow: hidden; width: 8.5cm; height: 3cm; border: 1pt solid #000000; padding: 2mm 2mm 2mm 2mm;">
	<tr>
		<td colspan="3" style="vertical-align:top;text-align:center;">
			<div style="font-size:10pt;font-weight:bold;">TRACER&nbsp;<?=$poli[$i]?></div>
		</td>
	</tr>
	<tr>
		<td style="width:100px;"><b>No. RM</b></td>
		<td>:</td>
		<td><?=$data[$i][no_rm]?></td>
	</tr>
	<? if($data[$i][no_antrian]) : ?>
	<tr>
		<td><b>No. Antrian</b></td>
		<td>:</td>
		<td><?=$data[$i][no_antrian]?></td>
	</tr>
	<? endif; ?>
	<tr>
		<td><b>Pasien</b></td>
		<td>:</td>
		<td><?=$data[$i][nama]?></td>
	</tr>
	<? if($data[$i][dokter]) : ?>
	<tr>
		<td><b>Dokter</b></td>
		<td>:</td>
		<td><?=$data[$i][dokter]?></td>
	</tr>
	<? endif; ?>
	<? if($data[$i][tgl_periksa]) : ?>
	<tr>
		<td><b>Tgl Kunjung</b></td>
		<td>:</td>
		<td><?=tanggalIndo($data[$i][tgl_periksa], 'j F Y')?></td>
	</tr>
	<? endif; ?>
	<? if($data[$i][peminjam]) : ?>
	<tr>
		<td><b>Peminjam</b></td>
		<td>:</td>
		<td><?=$data[$i][peminjam]?></td>
	</tr>
	<? endif; ?>
	<tr>
		<td><b>Keperluan</b></td>
		<td>:</td>
		<td><?=$data[$i][keperluan]?></td>
	</tr>
</table>
<hr />
<? endfor; ?>
<? include KOMPONEN_DIR . "footer_cetak.php"; ?>