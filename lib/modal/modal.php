<?
   class Modal {
      var $title;
      var $content;
      var $print_button_url;
      var $name = "xxx";
      var $navi_id;
      var $cetak_lebar = 800;
      var $cetak_tinggi = 768;

      function __construct() {}

      function Modal() {
         return $this->__construct();
      }

      function setTitle($title) {
         $this->title = $title;
      }

      function setPrintButtonUrl($url) {
         $this->print_button_url = $url;
      }

      function setCloseButtonOnclick($onclick) {
         $this->close_button_onclick = $onclick;
      }

      function titleBarOnclick($onclick) {
         $this->title_bar_onclick = $onclick;
      }

      function setContent($cnt) {
         $this->content[] = $cnt;
      }

      function setContentStyle($style) {
         $this->content_style[] = $style;
      }

      function setContentFromFile($file) {
         ob_start();
         include $file;
         $the_file = ob_get_clean();
         $this->content[] = $the_file;
      }

      function setNavi($navi) {
         $this->navi = $navi;
      }

      function build() {
         $ret = "";
         $ret .= "<div class=\"modal_button_group\">";
         if(isset($this->print_button_url)) $ret .= "<a href=\"javascript:void(0)\" title=\"Cetak\" onclick=\"cetak('".
               $this->print_button_url."', ".$this->cetak_lebar.", ".$this->cetak_tinggi.")\"><img src=\"".
               IMAGES_URL."printer.png\" alt=\"Cetak\" border=\"0\" /></a>";
         if(isset($this->close_button_onclick)) $ret .= "<a href=\"javascript:void(0)\" title=\"Tutup\" onclick=\"".
               $this->close_button_onclick."\"><img src=\"".IMAGES_URL."close.png\" alt=\"Tutup\" border=\"0\" /></a>";
         $ret .= "</div>";

         $ret .= "<div id=\"\" class=\"modal_title_bar\" onclick=\"".$this->title_bar_onclick.
            "\">";
         $ret .= $this->title;
         $ret .= "</div>";
         if(isset($this->navi)) {
            $ret .= "<div id=\"\" class=\"navi\">";
            $ret .= $this->navi;
            $ret .= "</div>";
         }
         $ret .= "<div class=\"modal_content_container\">";
         for($i = 0; $i < sizeof($this->content); $i++) {
            $ret .= "<div id=\"\" class=\"modal_content\" style=\"".$this->content_style[$i].
               "\">";
            $ret .= $this->content[$i];
            $ret .= "</div>";
         }
         $ret .= "</div>";

         return $ret;
      }
   }
?>