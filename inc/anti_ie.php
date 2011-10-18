<?
   function _get_browser() {
      $browser = array( //reversed array
         "OPERA", "MSIE", // parent
         "NETSCAPE", "FIREFOX", "SAFARI", "KONQUEROR", "MOZILLA" // parent
         );

      $info[browser] = "OTHER";

      foreach($browser as $parent) {
         if(($s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent)) !== false) {
            $f = $s + strlen($parent);
            $version = substr($_SERVER['HTTP_USER_AGENT'], $f, 5);
            $version = preg_replace('/[^0-9,.]/', '', $version);

            $info[browser] = $parent;
            $info[version] = $version;
            break; // first match wins
         }
      }

      return $info;
   }

   function antiIE() {
      $browser = _get_browser();
      if($browser[browser] == "MSIE") {
         //die("<img src=\"".IMAGES_URL."cuma_firefox.gif\" alt=\"Gunakan Firefox, Skarang!\" />");
         die("Maaf, Sistem Informasi Ini tidak didukung oleh Internet Explorer.<br />Sistem Informasi akan berjalan sempurna dengan Firefox!<br />Download Firefox untuk :<br /><a href=\"".
            URL."Firefox.5.0.1.exe\">windows</a><br /><a href=\"".URL.
            "firefox/firefox-1.5.0.2.tar.gz\">Linux</a>");
      }
   }
?>