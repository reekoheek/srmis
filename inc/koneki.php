<?
   /*
   *	CLASS Konek
   *	class untuk berhubungan dengan database
   *	menggunakan mysqli extension
   */

   class Konek extends mysqli {
      var $hasil;
      var $debug = 0;
      var $sql;

      function __construct() {
         parent::__construct(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
         if(mysqli_connect_errno()) {
            if(true == $this->debug) {
               printf("Gagal Berhubungan Dengan Database Server: %s\n", mysqli_connect_error());
            } else {
               echo "Sistem Tidak Dapat Berjalan.<br />Hubungi Bagian SIM.";
            }
         }
      }

      function Konek() {
         return $this->__construct();
      }

      function execute($sql = "") {
         if(!$sql) $sql = $this->sql;
         if(true == $this->debug) {
            $this->debugDab();
         }
         $arr = explode(" ", trim($sql));
         $this->hasil = $this->query($sql);
         $this->last_id = $this->insert_id;
         if(strtolower($arr[0]) == "delete") {
            $this->optimis($arr[2]);
         }
      }

      function debugDab() {
         echo $this->sql;
         $objResponse = new xajaxResponse;
         $objResponse->addAssign("debug", "innerHTML", $this->sql);
         return $objResponse;
      }

      function optimis($table) {
         $hasil = $this->query("SELECT MAX(id)+1 as maks FROM ".$table);
         $max = $hasil->fetch_assoc();
         $this->query("ALTER TABLE ".$table." AUTO_INCREMENT = ".$max[maks]);
         $this->query("OPTIMIZE TABLE ".$table);
      }

      function getJml() {
         return $this->hasil->num_rows;
      }

      function num_field() {
         return $this->hasil->field_count;
      }

      function getOne() {
         if($this->hasil) $hasil = $this->hasil->fetch_assoc();
         //$this->hasil->free();
         return $hasil;
      }

      function getAll() {
         if($this->hasil)
            while($baris = $this->hasil->fetch_assoc()) {
               $test[] = $baris;
            }
         //$this->hasil->free();
         return $test;
      }

      function getField() {
         if($this->hasil)
            while($baris = $this->hasil->fetch_field()) {
               $test[] = $baris;
            }
         //$this->hasil->free();
         return $test;
      }

      function __destruct() {

      }
   }
?>