<?
   include_once "init.php";
   antiIE();
   $_url = new URL_Reader();
   $_url->setParts('module', 'page');
   $_part = $_url->part;

   $_arr_module_accepted = $_SESSION[module][nama];

   $_xajax = new xajax();
   if(!$_part[module]) {
      header("LOCATION:".URL."index.html");
   } else {
      //if() {
      if(is_file(MODULES_DIR.$_part[module]."/index.php") && @in_array($_part[module], $_arr_module_accepted)) {
          
         //modules/setting
         include_once MODULES_DIR . $_part[module] . "/index.php";

         if(is_file(MODULES_DIR.$_part[module]."/".$_part[page].".php")) {
            //modules/setting/dokter.php
            include_once "chat.php";
            include_once MODULES_DIR.$_part[module]."/".$_part[page].".php";
            $_xajax->processRequests();

            if(is_file(HTML_DIR.$_part[module]."/html.".$_part[page].".php")) {
               //html/setting/html.dokter.php
               include_once HTML_DIR.$_part[module]."/html.".$_part[page].".php";
            }
         } else {
            include_once HTML_DIR.$_part[module]."/html.index.php";
         }
      } elseif(APP_DEBUG == "ON") {
         echo "Module ".$_part[module]." Tidak Ada.<br />";
         header('Location: login.php');
         //print_r($_arr_module_accepted);
      } else {
         header("LOCATION:".URL."index.html");
      }
   }
?>
