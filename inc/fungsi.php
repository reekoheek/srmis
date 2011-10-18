<?
   function tambahNol($data, $len) {
      $y = $len - strlen($data);
      while(strlen($x) < $y) {
         $x .= "0";
      }
      return $x.$data;
   }

   function bulanIndo($waktu, $format) {
      if(!$waktu) {
         $waktu = date("m");
      }
      $tahun = date("Y");
      $bulan_en = array("January", "February", "March", "April", "May", "June", "July",
         "August", "September", "October", "November", "December");

      $bulan_id = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
         "Agustus", "September", "Oktober", "November", "Desember");
      $ret = date($format, mktime(1, 1, 1, $waktu, 1, $tahun));
      $replace_bulan = str_replace($bulan_en, $bulan_id, $ret);
      return $replace_bulan;
   }

   function tanggalIndo($waktu, $format) { //{tanggalIndoTiga tgl=0000-00-00 00:00:00 format="l, d/m/Y H:i:s"}
      if($waktu == "0000-00-00" || !$waktu || $waktu == "0000-00-00 00:00:00") {
         $rep = "";
      } else {
         if(eregi("-", $waktu)) {
            $tahun = substr($waktu, 0, 4);
            $bulan = substr($waktu, 5, 2);
            $tanggal = substr($waktu, 8, 2);
         } else {
            $tahun = substr($waktu, 0, 4);
            $bulan = substr($waktu, 4, 2);
            $tanggal = substr($waktu, 6, 2);
         }

         $jam = substr($waktu, 11, 2);
         $menit = substr($waktu, 14, 2);
         $detik = substr($waktu, 17, 2);
         $hari_en = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday",
            "Friday", "Saturday");
         $hari_id = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
         $bulan_en = array("January", "February", "March", "April", "May", "June", "July",
            "August", "September", "October", "November", "December");
         $bulan_id = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli",
            "Agustus", "September", "Oktober", "November", "Desember");
         $ret = @date($format, @mktime($jam, $menit, $detik, $bulan, $tanggal, $tahun));

         $replace_hari = str_replace($hari_en, $hari_id, $ret);
         $rep = str_replace($bulan_en, $bulan_id, $replace_hari);
         $rep = nl2br($rep);
      }
      return $rep;
   }

	function uangIndo($data, $pake_koma = true) {
      if($pake_koma) $test = number_format($data, 2, ',', '.');
      else $test = number_format($data, 0, ',', '.');
      if($test == "0,00") {
         $test = "";
      }
      return $test;
   }

   //date difference function
   function datediff($interval, $date1, $date2) {
      $interval = strtolower($interval);
      // Function roughly equivalent to the ASP "DateDiff" function

      //convert the dates into timestamps
      $date1 = strtotime($date1);
      $date2 = strtotime($date2);
      $seconds = $date2 - $date1;

      //if $date1 > $date2
      //change substraction order
      //convert the diff to +ve integer
      if($seconds < 0) {
         $tmp = $date1;
         $date1 = $date2;
         $date2 = $tmp;
         $seconds = 0 - $seconds;
      }

      //reconvert the timestamps into dates
      if($interval == 'y' || $interval == 'm') {
         $date1 = @date("Y-m-d h:i:s", $date1);
         $date2 = @date("Y-m-d h:i:s", $date2);
      }

      switch($interval) {
         case "y":
            list($year1, $month1, $day1) = split('-', $date1);
            list($year2, $month2, $day2) = split('-', $date2);
            $time1 = (date('H', $date1) * 3600) + (date('i', $date1) * 60) + (date('s', $date1));
            $time2 = (date('H', $date2) * 3600) + (date('i', $date2) * 60) + (date('s', $date2));
            $diff = $year2 - $year1;

            if($month1 > $month2) {
               $diff -= 1;
            } elseif($month1 == $month2) {
               if($day1 > $day2) {
                  $diff -= 1;
               } elseif($day1 == $day2) {
                  if($time1 > $time2) {
                     $diff -= 1;
                  }
               }
            }
            break;
         case "m":
            list($year1, $month1, $day1) = split('-', $date1);
            list($year2, $month2, $day2) = split('-', $date2);
            $time1 = (date('H', $date1) * 3600) + (date('i', $date1) * 60) + (date('s', $date1));
            $time2 = (date('H', $date2) * 3600) + (date('i', $date2) * 60) + (date('s', $date2));
            $diff = ($year2 * 12 + $month2) - ($year1 * 12 + $month1);
            if($day1 > $day2) {
               $diff -= 1;
            } elseif($day1 == $day2) {
               if($time1 > $time2) {
                  $diff -= 1;
               }
            }
            break;
         case "w":
            // Only simple seconds calculation needed from here on
            $diff = floor($seconds / 604800);
            break;
         case "d":
            $diff = floor($seconds / 86400);
            break;
         case "h":
            $diff = floor($seconds / 3600);
            break;
         case "i":
            $diff = floor($seconds / 60);
            break;
         case "s":
            $diff = $seconds;
            break;
      }
      return $diff;
   }

   function hitungUmur($tgl_start, $tgl_end) {
      /*
      fungsi untuk hitung umur
      echo hitungUmur('1985-07-27', '2007-03-01');
      return value :
      array(
      "tahun" => 21,
      "bulan" => 7,
      "hari" => 2
      )
      */
      if(!$tgl_end) $tgl_end = date("Y-m-d");
      $start_time = strtotime($tgl_start);
      $end_time = strtotime($tgl_end);
      if($end_time <= $start_time) {
         $umur[tahun] = 0;
         $umur[bulan] = 0;
         $umur[hari] = 0;
      } else {
         $umur[tahun] = datediff('y', $tgl_start, $tgl_end);

         $selisih_bulan = datediff('m', $tgl_start, $tgl_end);
         $umur[bulan] = $selisih_bulan % 12;

         $arr_tgl_start = explode("-", $tgl_start);
         $tgl_start_thn = $arr_tgl_start[0] + $umur[tahun];
         $tgl_start_bln = $arr_tgl_start[1] + $umur[bulan];
         $new_tgl_start = date("Y-m-d", mktime(1, 1, 1, $tgl_start_bln, $arr_tgl_start[2],
            $tgl_start_thn));
         $selisih_hari = datediff('d', $new_tgl_start, $tgl_end);
         $umur[hari] = $selisih_hari;
      }
      return $umur;
   }

	function getMemUsage() {
      // Windows workaround
      $output = array();
      exec('tasklist /FI "PID eq '.getmypid().'" /FO LIST', $output);
      $mem = trim(substr($output[5], strpos($output[5], ':') + 1))."\r\n";
      $hand = fopen("F:\\htdocs\pkusim\benchmark\benchmark_no_free.txt", 'a');
      fwrite($hand, $mem);
      fclose($hand);
   }

	function hariIni($tgl, $tgl_sekarang = null) {
      if($tgl_sekarang == null) {
         $tgl_sekarang = date("Y-m-d");
      }
      $selisih = datediff("d", $tgl_sekarang, $tgl);
      if($selisih == 0) $ret = "Hari Ini";
      elseif($selisih == 1) $ret = "Kemarin";
      elseif($selisih == 2) $ret = "Kemarin Lusa";
      else $ret = tanggalIndo($tgl, "j M Y");
      return $ret;
   }

	function kekata($x) {
      $x = abs($x);
      $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh",
         "delapan", "sembilan", "sepuluh", "sebelas");
      $temp = "";
      if($x < 12) {
         $temp = " ".$angka[$x];
      } elseif($x < 20) {
         $temp = kekata($x - 10)." belas";
      } elseif($x < 100) {
         $temp = kekata($x / 10)." puluh".kekata($x % 10);
      } elseif($x < 200) {
         $temp = " seratus".kekata($x - 100);
      } elseif($x < 1000) {
         $temp = kekata($x / 100)." ratus".kekata($x % 100);
      } elseif($x < 2000) {
         $temp = " seribu".kekata($x - 1000);
      } elseif($x < 1000000) {
         $temp = kekata($x / 1000)." ribu".kekata($x % 1000);
      } elseif($x < 1000000000) {
         $temp = kekata($x / 1000000)." juta".kekata($x % 1000000);
      } elseif($x < 1000000000000) {
	      $temp = kekata($x / 1000000000)." milyar".kekata(fmod($x, 1000000000));
	   } elseif($x < 1000000000000000) {
         $temp = kekata($x / 1000000000000)." trilyun".kekata(fmod($x, 1000000000000));
      }
      return $temp;
   }

	function terbilang($x, $style = 4) {
      if($x < 0) {
         $hasil = "minus ".trim(kekata($x));
      } elseif($x == 0) {
         return;
      } else {
         $hasil = trim(kekata($x));
      }
      switch($style) {
         case 1:
            $hasil = strtoupper($hasil)." rupiah";
            break;
         case 2:
            $hasil = strtolower($hasil)." rupiah";
            break;
         case 3:
            $hasil = ucwords($hasil)." rupiah";
            break;
         default:
            $hasil = ucfirst($hasil)." rupiah";
            break;
      }
      return $hasil;
   }

   /*
   function bagiRata();
   fungsi ini digunakan untuk membagi dari sebuah data besar ke data yang lebih kecil2
   parmeter yang digunakan yaitu :
   $utama = nilai jumlah total
   $bagian = array() = berisi data2 detil dari $utama, dapat bernilai 0 atau 0.00
   */
   function bagiRata($utama, $bagian = array()) {
      //$utama = (int) $utama;
      $tetap = $utama;

      //jika tidak ada $utama, maka set semua menjadi 0
      if($utama == 0 || !$utama) {
         foreach($bagian as $i => $val) {
            $set[] = 0;
         }
         $set['total'] = 0;
      } else {
         foreach($bagian as $i => $val) {
            $in = $val;
            $utama = $utama - $in; //mengetahui sisa $utama
            $baru[] = $in;
            if($in == 0 || !$in) {
               $not[] = 0;
               $last = $i;
            }
         }
         if(!empty($not)) {
            $lebar_not = sizeof($not);
            $rata = round($utama / $lebar_not, 2);
         }
         //menghitung total semuanya
         foreach($baru as $i => $val) {
            if($val == 0 || !$val) {
               $tot = $tot + $rata;
            } else {
               $tot = $tot + $val;
            }
         }

         foreach($baru as $i => $val) {
            if($val == 0 || !$val) {
               if($i == $last) { //jika data terakhir, tambahkan dengan sisa
                  $set[] = $rata + ($tetap - $tot);
               } else {
                  $set[] = $rata;
               }
            } else {
               $set[] = $val;
            }
            $ttl = $ttl + $set[$i];
         }
         $set['total'] = $ttl;
      }
      return $set;
   }
?>