<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta  http-equiv="refresh" content="5">
<title>Untitled Document</title>
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">USER LOGIN STATUS </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>Non-Pelayanan<hr></td>
						</tr>
						<tr>
							<td>
							<?php
							$query2  = mysql_query ("SELECT * FROM user WHERE group_id='2' ORDER BY id ASC");
																		
							echo '<table cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF>#</font></td>
										<td><font color=#FFFFFF>Username</font></td>
										<td><font color=#FFFFFF>Poliklinik</font></td>
										<td><font color=#FFFFFF>Unit</font></td>
										<td><font color=#FFFFFF>Status</font></td>
									</tr>';
									$no = 1;
									while ($result2 = mysql_fetch_array($query2))
									{
										$q=mysql_query("SELECT * FROM group_unit WHERE group_id='$result2[group_id]'");
										$r=mysql_fetch_array($q);
										
										$q2=mysql_query("SELECT * FROM pelayanan WHERE unit_id='$result2[unit_id]'");
										$r2=mysql_fetch_array($q2);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										echo "<td align=left width=80px>$no</td>
											<td align=left>$result2[nm_user]</td>
											<td align=left>$r2[nama]</td>
											<td align=left>$r2[jenis]</td>
											<td align=center>";
											if ($result2['f_login']==1)
											{
												echo "<font color=blue>Login</font>";
											} 
											else
											{
												echo "<font color=red>Logout</font>";
											}
											echo "</td>";
											
										echo "</tr>";
										$no++;
									}
									echo'</table>';
							?>
							</td>
						</tr>
					</table>
					</div>
					<br>
					
					<div style="border:1px  solid  #CCCCCC; width:670px; height:300px; overflow:auto;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td>Pelayanan<hr></td>
						</tr>
						<tr>
							<td>
							<?php
							$query2  = mysql_query ("SELECT * FROM user WHERE group_id='1' ORDER BY id ASC");
																		
							echo '<table cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF>#</font></td>
										<td><font color=#FFFFFF>Username</font></td>
										<td><font color=#FFFFFF>Poliklinik</font></td>
										<td><font color=#FFFFFF>Unit</font></td>
										<td><font color=#FFFFFF>Status</font></td>
									</tr>';
									$no = 1;
									while ($result2 = mysql_fetch_array($query2))
									{
										$q=mysql_query("SELECT * FROM group_unit WHERE group_id='$result2[group_id]'");
										$r=mysql_fetch_array($q);
										
										$q2=mysql_query("SELECT * FROM pelayanan WHERE unit_id='$result2[unit_id]'");
										$r2=mysql_fetch_array($q2);
										
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										echo "<td align=left width=80px>$no</td>
											<td align=left>$result2[nm_user]</td>
											<td align=left>$r2[nama]</td>
											<td align=left>$r2[jenis]</td>
											<td align=center>";
											if ($result2['f_login']==1)
											{
												echo "<font color=blue>Login</font>";
											} 
											else
											{
												echo "<font color=red>Logout</font>";
											}
											echo "</td>";
											
										echo "</tr>";
										$no++;
									}
									echo'</table>';
							?>
							</td>
						</tr>
					</table>
					</div>
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
		</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>

</html>