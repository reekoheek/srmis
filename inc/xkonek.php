<?
   /*
   *	halaman konak
   *	mbikin konak PHP ma DATABASE
   */

   class xKonek {
      var $hasil;
      var $kueri;
      var $debug = 0;
      var $affected_rows;
      var $sql;

      function __construct() {
         $_konak = @mysql_connect(DB_HOST.":".DB_PORT, DB_USER, DB_PASS) or die("TIDAK BISA BERHUBUNGAN DENGAN DATABASE SERVER.<br />CEK username, password dan nama database di FILE /sekarwangi/configure.php");
         @mysql_select_db(DB_NAME, $_konak) or die("DATABASE TIDAK ADA.<br />CEK file /sekarwangi/configure.php.");
         return $_konak;
      }

      function Konek() {
         return $this->__construct();
      }

      function execute($sql = "") {
         $sql = $this->sql;
         if(true == $this->debug) {
            echo "<pre><b>SQL: </b><code>".$sql."</code>";
         } // else {
         $arr = explode(" ", trim($sql));
         $this->hasil = @mysql_query($sql);
         if(strtolower($arr[0]) == "delete") {
            //$this->optimis($arr[2]);
         }
         $this->last_id = mysql_insert_id();
         $this->affected_rows = mysql_affected_rows();
         return $this->hasil;
         //}
      }

      function last_id() {
         return mysql_insert_id();
      }

      function optimis($table) {
         $max = mysql_fetch_assoc(mysql_query("SELECT MAX(id)+1 as maks FROM ".$table));
         mysql_query("ALTER TABLE ".$table." AUTO_INCREMENT = ".$max[maks]);
         mysql_query("OPTIMIZE TABLE ".$table);
      }

      function getJml() {
         return mysql_num_rows($this->hasil);
      }

      function affected_rows() {
         $this->affected_rows = mysql_affected_rows();
         return $this->affected_rows;
      }

      function field_name() {
         $jml = $this->num_field();
         for($i = 0; $i < $jml; $i++) {
            $arr_field[] = mysql_field_name($this->hasil, $i);
         }
         return $arr_field;
      }

      function num_field() {
         return mysql_num_fields($this->hasil);
      }

      function getOne() {
         $data = mysql_fetch_assoc($this->hasil);
         return $data;
      }

      function getAll() {
         while($baris = mysql_fetch_assoc($this->hasil)) {
            $m[] = $baris;
         }
         return $m;
      }

      function getAllByField() {
         $field = $this->field_name();
         $jml = sizeof($field);

         while($baris = mysql_fetch_assoc($this->hasil)) {
            for($i = 0; $i < $jml; $i++) {
               $arr[$field[$i]][] = $baris[$field[$i]];
            }
         }
         return $arr;
      }

      function tutup() {
         return mysql_free_result($this->hasil);
      }
   }
?>