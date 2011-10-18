<?php

/**
 * @author Richard
 * @copyright 2011
 */
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
  <tr>
    <td>
      <table border=0 cellpadding=2 cellspacing=2 width=400px>
		<tr bgcolor=#414141 align=center>
			<td><font color=#FFFFFF>#</font></td>
			<td><font color=#FFFFFF>Kode Rekanan</font></td>
			<td><font color=#FFFFFF>Nama</font></td>
		</tr>
    	<?php
    		$q = mysql_query ("SELECT * FROM pbf");
    		$no = 1;
    		while ($r = mysql_fetch_array($q))
    		{
    			if ($no%2)
    			{
    				echo "<tr valign=top>";
    			}
    			else
    			{
    				echo "<tr bgcolor=#CCCCCC valign=top>";
    			}
    			echo "
                    <td align = center>$no</td>
    				<td>$r[kd_rekanan]</td>
    				<td>$r[nama]</td>
    				</tr>";
    			$no++;
    		}
    	?>
</table>
