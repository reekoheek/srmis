<? include KOMPONEN_DIR . "header.php"; ?>
<div style="height:98%;">
<h3>Welcome</h3>
Selamat Datang Di <b><?=$_SESSION[setting][app_name_pendek]?>, <?=$_SESSION[setting][app_name]?></b> versi <b><?=$_SESSION[setting][app_version]?></b><br /><br />
<b><?=$_SESSION[setting][app_name_pendek]?> ini mencakup :</b>
<ul>
	<li>Pendaftaran pasien IGD, Rawat Jalan, Rawat Inap baik pasien baru maupun pasien lama</li>
	<li>Input diagnosa, tindakan, dan BHP pada masing-masing pelayanan (IGD, Poliklinik, dan Bangsal)</li>
	<li>Modul pelaporan mencakup laporan Internal yang dibutuhkan dan Eksternal (RL2a, RL2a1, RL2b, RL2b1, RL2c, dan RL3)</li>
	<li>Pembuatan dan Pencetakan Tracer pada modul Filing disertai list kunjungan yang pernah dilakukan untuk mentrace berkas rekam medis apabila tidak ditemukan.</li>
	<li>Setting data master pada modul Administrasi Data</li>
</ul>
</div>
<? include KOMPONEN_DIR . "footer.php"; ?>