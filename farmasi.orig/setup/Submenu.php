<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<?php
$id = $_GET['id'];
?>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
	  <td><table border="0" width="100%" cellpadding="0" cellspacing="0">
        <tr>
          <td width="8px">&nbsp;</td>
          <td width="300px" bgcolor="#9b9999">&nbsp; <b><font color="#fefafa">Sub M</font></b><font style="font-size:14px; " color="#fefafa"><b>enu</b></font></td>
          <td></td>
        </tr>
      </table></td>
	</tr>
	<tr>
		<td><img src="file:///C|/xampp/htdocs/prj_apotek_repair/setup/images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px; ">
					<?php
						$q= mysql_query("SELECT * FROM tbl_menu WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						echo '<form method=post action=home.php?hal=action_setup/update_sub enctype=multipart/form-data>';
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
					<hr>
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<input name="menus" type="hidden" value="<?=$r['Menu']?>">
						<tr>
						  <td width="38%" align="right"><div align="right">Menu : </div></td>
						  <td width="62%">
						  <?=$r['name_menu']?></td>
						</tr>
						<tr>
						  <td align="right"><div align="right">Child 1 : </div></td>
						  <td>
						  <select name="Master">
							<option value="">--Pilih--</option>
							<?php
								$qq=mysql_query("SELECT * FROM tbl_menu where menu ='1'");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($rq['id'])
									{
										echo "<option value='$rq[id]' selected>$rq[name_menu]</option>";
									}
									else
									{
										echo "<option value='$rq[id]'>$rq[name_menu]</option>";
									}
								}
							?>
							</select>							</td>
					  </tr>
					  <tr>
						  <td align="right"><div align="right">Child 2 : </div></td>
						  <td>
						  <select name="Child1">
							<option value="">--Pilih--</option>
							<?php
								$qq=mysql_query("SELECT * FROM tbl_menu where menu ='2'");
								while ($rq=mysql_fetch_array($qq))
								{
									if ($rq['id'])
									{
										echo "<option value='$rq[id]' selected>$rq[name_menu]</option>";
									}
									else
									{
										echo "<option value='$rq[id]'>$rq[name_menu]</option>";
									}
								}
							?>
							</select>							</td>
					  </tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					<hr>
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
			</table>
	</tr>
	<tr>
		<td><img src="file:///C|/xampp/htdocs/prj_apotek_repair/setup/images/bawah_isi.png"></td>
	</tr>
</table>

</body>
</html>
