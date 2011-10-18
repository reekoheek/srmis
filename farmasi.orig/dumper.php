<?php
	include ("include/koneksi.php");
	include ("include/leveling_access.inc");
	$menuDraw =array();
	$access = new AccessMe('1');
	$menuUp= $access->getMenu();
	print_r ($menuUp);
	echo "<br /> <br />";

	array_push(&$menuDraw,$access->getGroup('1'));
	print_r ($menuDraw);

?>