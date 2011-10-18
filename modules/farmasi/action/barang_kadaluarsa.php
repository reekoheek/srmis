<?php
	$pdate = date ("d") + 0;
	$pmonth = date("m") + 4;
	$ppmonth = date ("m") + 3;
	$pyear = date("Y") + 0;
	
	$query  = mysql_query ("SELECT * FROM ms_barang");
	while ($result = mysql_fetch_array($query))
	{
		if ((($ppmonth > $result['ex_month']) AND ($pyear >= $result['ex_year']) AND ($pdate > $result['ex_date'])) OR (($ppmonth > $result['ex_month']) AND 			  ($pyear >= $result['ex_year'])))
		{
			$qy = mysql_query("UPDATE ms_barang SET flags='9', status='Non-Aktif' WHERE id='$result[id]'"); 
		}
		
	}
?>