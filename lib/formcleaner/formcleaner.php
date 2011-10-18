<?
   /*
   Class FormCleaner
   by tantos@4/1/2007
   $arr = array(
				"nama" => "  tanto's",
				"alamat" => "jogja",
				"telp" => "555",
				"hobi" => array(
					"makan " => "'nasi",
					"minum" => array(
						"es",
						"x'uxu" => array(
							"kuda liar",
      					"kuda gila",
							"xuxu no'na")
						)
					)
				);

   $cek = new FormCleaner;
   $cek->setValue($arr);
   $cek->clean();
   echo "<pre>";
   print_r($cek->getValue());
   echo "</pre>";
   */

   class FormCleaner {
      var $value;
      var $arr_value;

      function __construct() {
         //
      }

      function FormCleaner() {
         return $this->__construct();
      }

      function clean() {
         $arr = $this->arr_value;
         $kunci = array_keys($arr);
         for($i = 0; $i < sizeof($arr); $i++) {
            if(!is_array($arr[$kunci[$i]])) {
               $this->value[$kunci[$i]] = $this->fetchString($arr[$kunci[$i]]);
            } else {
               $this->value[$kunci[$i]] = $this->fetchArray($arr[$kunci[$i]]);
            }
         }
      }

      function fetchArray($arr) {
         $kunci = array_keys($arr);
         for($i = 0; $i < sizeof($arr); $i++) {
            if(!is_array($arr[$kunci[$i]])) {
               $value[$kunci[$i]] = $this->fetchString($arr[$kunci[$i]]);
            } else {
               $value[$kunci[$i]] = $this->fetchArray($arr[$kunci[$i]]);
            }
         }
         return $value;
      }

      function fetchString($str) {
         return addslashes(trim($str));
      }

      function setValue($arr_value) {
         $this->arr_value = $arr_value;
      }

      function getValue() {
         return $this->value;
      }
   }
?>