<?
$_TITLE = "Statistik Kunjungan";
		$paging = new MyPagina;
		$paging->hal = $_GET[hal];
		$paging->rows_on_page = 5;
		$sql = "
			SELECT
				k.id as id,
				pas.id as no_rm,
				CONCAT_WS('-', SUBSTRING(pas.id, 1,2), SUBSTRING(pas.id, 3,2), SUBSTRING(pas.id, 5,2)) as id_display,
				pas.nama as nama,
				pas.tgl_lahir as tgl_lahir,
				pas.nama_ortu as nama_ortu,
				CONCAT(pas.alamat, '<br />', 'RT ', pas.rt, ' RW ', pas.rw, '<br />Kecamatan\t', kec.nama, '<br />Kabupaten\t', kab.nama, '<br />Provinsi\t\t', prop.nama) as alamat,
				pel.nama as pelayanan,
				k.kunjungan_ke as kunjungan_ke,
				k.tgl_periksa as tgl_periksa,
				d.nama as dokter,
				k.berat_badan as bb,
				k.tinggi_badan as tb,
				k.lingkar_kepala as lk,
				TRIM(k.anamnesa) as anamnesa,
				k.diagnosa_utama as diagnosa_utama,
				CONCAT(i.kode_icd, ' ', i.nama) as diagnosa_utama_nama,				
				k.ket as ket,
				k.biaya as biaya,
				rsp.nama as status
			FROM
				kunjungan k
				JOIN pasien pas ON (pas.id = k.pasien_id)
				JOIN pelayanan pel ON (pel.id = k.pelayanan_id)

				LEFT JOIN icd i ON (i.id = k.diagnosa_utama)
				JOIN dokter d ON (d.id = k.dokter_id)

				JOIN ref_kecamatan kec ON (kec.id = pas.kecamatan_id)
				JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
				JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)

				JOIN ref_status_periksa rsp ON (rsp.id = k.status_periksa_id)
			WHERE
				k.pasien_id = '".$_GET[no_rm]."'
			ORDER BY
				k.id
		";
		$paging->sql = $sql;
		$paging->get_page_result();

		$data = $paging->data;
		$ket_hal = $paging->ket_hal_ini();

		$objResponse = new xajaxResponse();
		$objResponse->addClear("list_semua_kunjungan", "style.display");
		$ret .= "<h3>Daftar Kunjungan</h3>";
		$table = new Table;
		$table->anime_bg_color = "";
		$table->addRow("<b>No.RM</b>", $data[0][id_display]);
		$table->addExtraTd(" style=\"width: 150px;\" ");
		$table->addRow("<b>Nama</b>", $data[0][nama]);
		$table->addExtraTd(" style=\"vertical-align: top;\" ");
		$table->addRow("<b>Tanggal Lahir</b>", tanggalIndo($data[0][tgl_lahir], "j F Y"));
		$table->addExtraTd(" style=\"vertical-align: top;\" ");
		$table->addRow("<b>Nama Orang Tua</b>", $data[0][nama_ortu]);
		$table->addExtraTd(" style=\"vertical-align: top;\" ");
		$table->addRow("<b>Alamat</b>", $data[0][alamat]);
		$table->addExtraTd(" style=\"vertical-align: top;\" ");
		$ret = $table->build();
		$ret .= "<hr />";

		$kon = new Konek;

		for($i=0;$i<sizeof($data);$i++) {
			$ret .= "<b>Kunjungan Ke - " . $data[$i][kunjungan_ke] . " [ " . tanggalIndo($data[$i][tgl_periksa], "j F Y") . " ]</b><br /><br />";
			$ret .= "<table cellpadding=\"0\" cellspacing=\"2\" border=\"0\">";
			$ret .= "<tr><td style=\"width:150px\">Pelayanan</td><td>" . $data[$i][pelayanan] . "</td></tr>";
			$ret .= "<tr><td>Dokter</td><td>" . $data[$i][dokter] . "</td></tr>";
			if($data[$i][bb])
				$ret .= "<tr><td>Berat Badan</td><td>" . $data[$i][bb] . " Kg</td></tr>";
			if($data[$i][tb])
				$ret .= "<tr><td>Tinggi Badan</td><td>" . $data[$i][tb] . " Cm</td></tr>";
			if($data[$i][lk])
				$ret .= "<tr><td>Lingkar Kepala</td><td>" . $data[$i][lk] . " Cm</td></tr>";
			if($data[$i][anamnesa])
				$ret .= "<tr><td>Anamnesa</td><td>" . nl2br($data[$i][anamnesa]) . "</td></tr>";
			if($data[$i][diagnosa_utama])
				$ret .= "<tr><td>Diagnosa Utama</td><td><b>" . $data[$i][diagnosa_utama_nama] . "</b></td></tr>";
			$kon->sql = "
				SELECT 
					im.nama as nama
				FROM kunjungan k 
					JOIN kunjungan_imunisasi ki ON (ki.kunjungan_id = k.id)
					JOIN imunisasi im ON (im.id = ki.imunisasi_id)
				WHERE
					k.id = '".$data[$i][id]."'
			";
			$kon->execute();
			unset($im);
			$im = $kon->getAll();
			if(!empty($im)) {
				$ret .= "<tr><td>Imunisasi</td><td>";
				for($j=0;$j<sizeof($im);$j++) {
					$ret .= $im[$j][nama] . "<br />";
				}
				$ret .= "</td></tr>";
			}
			/*
			if($data[$i][diagnosa_lain1])
				$ret .= "<tr><td>Diagnosa Lain I</td><td>" . $data[$i][diagnosa_lain1_nama] . "</td></tr>";
			if($data[$i][diagnosa_lain2])
				$ret .= "<tr><td>Diagnosa Lain II</td><td>" . $data[$i][diagnosa_lain2_nama] . "</td></tr>";
			*/
			if($data[$i][imunisasi_nama])
				$ret .= "<tr><td>Imunisasi</td><td>" . $data[$i][imunisasi_nama] . "</td></tr>";
			if($data[$i][ket])
				$ret .= "<tr><td>Keterangan</td><td>" . nl2br($data[$i][ket]) . "</td></tr>";
			if($data[$i][biaya] != "0.00")
				$ret .= "<tr><td>Biaya</td><td>" . uangIndo($data[$i][biaya]) . "</td></tr>";
			$ret .= "</table>";
			$ret .= "<hr />";
		}
		$ret .= "<div class=\"navi\">" . $ket_hal . "</div>";
?>