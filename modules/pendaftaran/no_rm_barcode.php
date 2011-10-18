<?
  $code = $_GET[code];
  $label = $_GET[label];
  $style = $_GET[style];
  $width = $_GET[width];
  $height = $_GET[height];
  $xres = $_GET[xres];
  $font = $_GET[font];
  $type = $_GET[type];

  define (__TRACE_ENABLED__, false);
  define (__DEBUG_ENABLED__, false);
  
  require(LIB_DIR . "barcode/barcode.php");  
  require(LIB_DIR . "barcode/i25object.php");
  require(LIB_DIR . "barcode/c39object.php");
  require(LIB_DIR . "barcode/c128aobject.php");
  require(LIB_DIR . "barcode/c128bobject.php");
  require(LIB_DIR . "barcode/c128cobject.php");


  if (!isset($style))  $style   = BCD_DEFAULT_STYLE;
  if (!isset($width))  $width   = BCD_DEFAULT_WIDTH;
  if (!isset($height)) $height  = BCD_DEFAULT_HEIGHT;
  if (!isset($xres))   $xres    = BCD_DEFAULT_XRES;
  if (!isset($font))   $font    = BCD_DEFAULT_FONT;

  switch ($type) {
    case "I25":
			  $obj = new I25Object($width, $height, $style, $code);
			  break;
    case "C39":
			  $obj = new C39Object($width, $height, $style, $code);
			  break;
    case "C128A":
			  $obj = new C128AObject($width, $height, $style, $code);
			  break;
    case "C128B":
			  $obj = new C128BObject($width, $height, $style, $code);
			  break;
    case "C128C":
              $obj = new C128CObject($width, $height, $style, $code);
			  break;
	default:
			$obj = new I25Object($width, $height, $style, $code);
			$obj = false;
  }
  if ($obj) {
      $obj->SetFont($font);   
      $obj->DrawObject($xres);
      $obj->FlushObject();
  	  $obj->DestroyObject();
  	  unset($obj);
  }
?>