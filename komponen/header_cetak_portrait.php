<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title><?=$_TITLE?></title>
	<meta name="Generator" content="EditPlus" />
	<meta name="Author" content="" />
	<meta name="" content="" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>cetak.css" media="print, screen" />
	<? if(is_file(MEDIA_DIR . $_part[module] . '/' . $_part[page] . '.js')): ?>
		<script language="javascript" type="text/javascript" src="<?=MEDIA_URL . $_part[module] . '/' . $_part[page] . '.js'; ?>"></script>
	<? endif; ?>
	<script type="text/javascript" language="JavaScript">
	function eskep(evt) {
		evt = (evt) ? evt : ((window.event) ? event : null);
		if (evt) {
			if (evt.keyCode == 27) {
				window.close();
			}
		}
	}
	document.onkeyup = eskep;
	function setBgColor() {}
	</script>

	<?php
		if(is_object($_xajax))
		$_xajax->printJavascript(MEDIA_URL . "xajax"); 
	?>
</head>
<!-- <body id="portrait_document"> -->
<body id="portrait_document" onload="window.print(); window.close();">
<div>