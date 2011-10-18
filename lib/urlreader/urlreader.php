<?
   /*
   *	Class URL_Reader by tantos @ 03/02/2007
   *
   *	example :
   *	$url = new URL_Reader($_GET[page]);
   *	$url->setParts("nama", "nim", "alamat");
   *	$part = $url->part;
   *	print_r($part);
   *
   *	return :
   *	http://localhost/fungsi/urlreader.php?page=tantos/12/jogja/
   *	Array
   *	(
   *	    [nama] => tantos
   *	    [nim] => 12
   *	    [alamat] => jogja
   *	)
   */

   class URL_Reader {
      var $arr_isi;

      function __construct($var = null) {
         $this->readURL($var);
      }

      function URL_Reader($var = null) {
         return $this->__construct($var);
      }

      function readURL($var = null) {
         if(!$var) {
            $var = str_replace("?", "", $_SERVER['REQUEST_URI']);
            //$var = $_SERVER['REQUEST_URI'];
         }
         //echo URL;
         //echo $var;
         /*
         sekarang :
         URL = http://tantos.web.id/klinikanak/
         $var = /klinikanak/home/

         nanti
         URL = http://tantos.web.id/app/klinikanak/
         $var = /app/klinikanak/
         */
         if(eregi("https://", URL)) {
            $arr_url = explode("https://", URL);
         } else {
            $arr_url = explode("http://", URL);
         }
         $new_arr_url = explode("/", $arr_url[1]);
         array_pop($new_arr_url);
         if($_SERVER[HTTP_HOST] == $new_arr_url[0]) {
            array_shift($new_arr_url);
         }

         $arr = explode("/", $var);
         array_shift($arr);
         for($i = 0; $i < sizeof($new_arr_url); $i++) {
            if($new_arr_url[$i] == $arr[$i]) {
               array_shift($arr);
            }
         }
         $this->arr_isi = $arr;
      }

      function setParts() {
         $jml_args = func_num_args();
         $arg_list = func_get_args();
         for($i = 0; $i < $jml_args; $i++) {
            if(eregi("&", $this->arr_isi[$i])) {
               $x = explode("&", $this->arr_isi[$i]);
               for($m = 0; $m < sizeof($x); $m++) {
                  if(eregi("=", $x[$m])) {
                     $a = explode("=", $x[$m]);
                     $test[$arg_list[$i]] = $this->arr_isi[$i];
                     $test[$a[0]] = $a[1];
                  }
               }
            } elseif(eregi("=", $this->arr_isi[$i])) {
               $a = explode("=", $this->arr_isi[$i]);
               $test[$arg_list[$i]] = $this->arr_isi[$i];
               $test[$a[0]] = $a[1];
            } else {
               $test[$arg_list[$i]] = $this->arr_isi[$i];
            }
         }
         $this->part = $test;
         //print_r($test);
      }
   }
?>