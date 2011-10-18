<?
   /*
   * halaman konak
   * mbikin konak PHP ma DATABASE
   */

   class Konek {
      var $hasil;
      var $debug = 0;
      var $affected_rows;
      var $sql;

      function __construct() {
         $this->_konak = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT) or
            die("TIDAK BISA BERHUBUNGAN DENGAN DATABASE SERVER.<br />CEK username, password dan nama database di FILE config.php");
         //@mysqli_select_db(DB_NAME, $_konak) or die("DATABASE TIDAK ADA.<br />CEK file config.php.");
         return $this->_konak;
      }

      function Konek() {
         return $this->__construct();
      }

      function execute() {
         if(true == $this->debug) {
            echo "<pre><b>SQL: </b><code>".str_replace("\n", "", $this->sql)."</code>";
         }
         $arr = explode(" ", trim($this->sql));
         $this->hasil = mysqli_query($this->_konak, $this->sql);
         $this->affected_rows = @mysqli_affected_rows();
         $this->last_id = @mysqli_insert_id($this->_konak);
         if(strtolower($arr[0]) == "delete") {
            $this->optimis($arr[2]);
         }
      }

      function last_id() {
         return $this->last_id;
      }

      function optimis($table) {
         $max = @mysqli_fetch_assoc(@mysqli_query($this->_konak,
            "SELECT MAX(id)+1 as maks FROM ".$table));
         @mysqli_query($this->_konak, "ALTER TABLE ".$table." AUTO_INCREMENT = ".$max[maks]);
         @mysqli_query($this->_konak, "OPTIMIZE TABLE ".$table);
      }

      function getJml() {
         return @mysqli_num_rows($this->hasil);
      }

      function affected_rows() {
         $this->affected_rows = @mysqli_affected_rows();
         return $this->affected_rows;
      }

      function field_name() {
         $jml = $this->num_field();
         for($i = 0; $i < $jml; $i++) {
            $arr_field[] = mysqli_field_name($this->hasil, $i);
         }
         return $arr_field;
      }

      function num_field() {
         return mysqli_num_fields($this->hasil);
      }

      function getOne() {
         $data = mysqli_fetch_assoc($this->hasil);
         return $data;
      }

      function getAll() {
         while($baris = mysqli_fetch_assoc($this->hasil)) {
            $test[] = $baris;
         }
         return $test;
      }

      function getAllByField() {
         $field = $this->field_name();
         $jml = sizeof($field);
         while($baris = mysqli_fetch_assoc($this->hasil)) {
            for($i = 0; $i < $jml; $i++) {
               $arr[$field[$i]][] = $baris[$field[$i]];
            }
         }
         return $arr;
      }

      function tutup() {
         return mysqli_free_result($this->hasil);
      }
   }
?>