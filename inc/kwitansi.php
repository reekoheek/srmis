<?
   function bikinKwitansi($tempat_pembayaran, $bayar, $status = "LUNAS") {
      $kon = new Konek;
      $kon->sql = "INSERT INTO kwitansi (tgl, bayar, tempat_pembayaran, status) VALUES (NOW(), '".
         $bayar."', '".$tempat_pembayaran."', '".$status."')";
      $kon->execute();
      $id = $kon->last_id;
      return $id;
   }

   function getDataKwitansi($jenis, $id) {
      //mendapatkan data pembayaran dari tabel2 berdasarkan id kwitansi
      switch(strtolower($jenis)) {
         case "karcis":
            //get data pembayaran tindakan;
            break;
         case "icopim":
            //get data icopim
            break;
         case "bhp":
            //get data BHP
            break;
         case "imunisasi":
            //get data imunisasi
            break;
         case "all":
            //get all data
            break;
      }
   }

   class Kwitansi {
      var $id;

      function __construct() {
      	//
      }
      function Kwitansi() {
         return $this->__construct();
      }

      function insertKwitansi() {
         $kon = new Konek;
         $kon->sql = "INSERT INTO kwitansi (tgl) VALUES (NOW())";
         $kon->execute();
         $this->id = $kon->last_id;
         return $id;
      }

      function getPasien($pasien_id = null) {
         if(!$pasien_id) $pasien_id = $this->pasien_id;
         $kon = new Konek;
         $kon->sql = "
				SELECT
					CONCAT_WS('-', SUBSTRING(p.id, 1,2), SUBSTRING(p.id, 3,2), SUBSTRING(p.id, 5,2), SUBSTRING(p.id, 7,2)) as no_rm,
					REPLACE((p.nama), ('".$val[cari_nama]."'), ('<b>".$val[cari_nama].
            "</b>')) as nama,
					CONCAT(p.alamat, ' ', 'RT ', p.rt, '/ RW ', p.rw, '<br />',des.nama, ', ', kec.nama, ', ', kab.nama, '<br />', prop.nama) as alamat
				FROM
					pasien p
					JOIN ref_desa des ON (des.id = p.desa_id)
					JOIN ref_kecamatan kec ON (kec.id = des.kecamatan_id)
					JOIN ref_kabupaten kab ON (kab.id = kec.kabupaten_id)
					JOIN ref_propinsi prop ON (prop.id = kab.propinsi_id)
				WHERE
					p.id = '".$pasien_id."'
			";
         $kon->execute();
         $data = $kon->getOne();
         return $data;
      }

      function getKarcis($id = null) {
         if(!$id) $id = $this->id;
         $kon = new Konek;
         $kon->sql = "
				SELECT
					k.pasien_id as pasien_id,
					k.kunjungan_id as kunjungan_id,
					kk.id as kunjungan_kamar_id,
					kkk.id as kunjungan_karcis_id,
					kkk.kwitansi_id as kwitansi_id,
					kw.tgl as tgl_kwitansi,
					kar.id as karcis_id,
					kar.nama as nama,
					kkk.jumlah as jumlah,
					kkk.biaya as biaya,
					kkk.bayar as bayar
				FROM
					kunjungan_kamar_karcis kkk
					JOIN karcis kar ON (kar.id = kkk.karcis_id)
					JOIN kwitansi kw ON (kw.id = kkk.kwitansi_id)
					JOIN kunjungan_kamar kk ON (kk.id = kkk.kunjungan_kamar_id)
					JOIN kunjungan k ON (k.id = kk.kunjungan_id)
				WHERE
					kkk.kwitansi_id = '".$id."'
				GROUP BY
					kkk.id ";
         $kon->execute();
         $data = $kon->getAll();
         $this->pasien_id = $data[0][pasien_id];
         return $data;
      }
   }
?>