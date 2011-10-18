<?php
	$q = "INSERT INTO margin_tunai (kategori_obat, margin) VALUES ('".$_POST['kategori_obat']."', '".$_POST['margin']."')";
	$r = mysql_query($q);
	echo "<meta http-equiv='refresh' content='0;url=home.php?hal=content/margin_tunai'>";
?>