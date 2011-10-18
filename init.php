<?
   session_name("simrs");
   session_start();

   include_once "config.php";

   define("HTML_DIR", APP_DIR."html/");
   define("MODULES_DIR", APP_DIR."modules/");
   define("IMAGES_DIR", APP_DIR."images/");
   define("MEDIA_DIR", APP_DIR."media/");
   define("INC_DIR", APP_DIR."inc/");
   define("KOMPONEN_DIR", APP_DIR."komponen/");
   define("LIB_DIR", APP_DIR."lib/");
   define("BACKUPDB_DIR", APP_DIR."bekapdb/");
   define("TTF_DIR", LIB_DIR."jpgraph/fonts/");
   define("AJAX_REF_DIR", APP_DIR."ajax_ref/");
   

   define("IMAGES_URL", URL."images/");
   define("MEDIA_URL", URL."media/");
   define("IMAGES_URL1", URL."farmasi/");
   define("FARMASI_URL",URL);

   include_once INC_DIR."fungsi.php";
   include_once INC_DIR."koneki.php";
   include_once INC_DIR."anti_ie.php";
   include_once INC_DIR."kwitansi.php";
   include_once INC_DIR."xkonek.php";

   include_once MEDIA_DIR."xajax/xajax.inc.php";

   include_once LIB_DIR."mypagina/my_pagina_class.php";
   include_once LIB_DIR."jpgraph/src/jpgraph.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_bar.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_pie.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_pie3d.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_line.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_scatter.php";
   include_once LIB_DIR."jpgraph/src/jpgraph_regstat.php";

   //include_once LIB_DIR . "html2doc/html2doc.php";

   include_once LIB_DIR."urlreader/urlreader.php";
   include_once LIB_DIR."table/table.php";
   include_once LIB_DIR."cetak/cetak.php";
   include_once LIB_DIR."formcleaner/formcleaner.php";
   //include_once LIB_DIR . "paging/paging.php";
   include_once LIB_DIR."modal/modal.php";
   include_once LIB_DIR."bj/bj.php";
?>