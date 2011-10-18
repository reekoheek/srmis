<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Menu Kasir</title>
</head>

<body bgcolor="#BBBBBB">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;<b><font color="#fefafa">Menu Kasir </font></b></td>
				<td bgcolor="">&nbsp;<b><font color="#1bda01"></font></b></td>
			</tr>
			
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
	<td id="tengah_isi" height="150px"><font size="-1.5"></font>
	<tr>
	
	
	<td>
	

<?
$tgl=date("d/m/Y");
?>
<div align="center" style="padding-top:0px; padding-left:50px; vertical-align:middle">
<table width="443" border="0" style="table-layout:fixed;border-bottom-style:solid;border-bottom-color:#888888" bgcolor="#1bda01">
  <tr>
    <td height="33" colspan="2"><div align="center" style="font-size:medium"><strong>MENU KASIR </strong></div></td>
  </tr>
  <tr>
    <td width="195" bgcolor="#EEEEEE"><font style="font-style:italic;font-size:x-small">Tanggal : <? $date=date("d - M - Y"); echo $date;?></font></td>
    <td width="238" bgcolor="#EEEEEE">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE"><form id="form1" name="form1" method="post" action="home.php?hal=content/kasir_tes">
      <label>
      <div align="right">
        <input type="submit" name="Submit" value="Transaksi" />
      </div>
      </label>
        </form>
    </td>
    <td bgcolor="#EEEEEE"><form id="form2" name="form2" method="post" action="home.php?hal=content/lap_kasir">
      <label>
      <input type="submit" name="Submit2" value="Laporan Kasir" />
      </label>
        </form>
    </td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE">&nbsp;</td>
    <td bgcolor="#EEEEEE"></td>
  </tr>
</table>
</td>
</div>
</td>
<td>&nbsp;</td>
</tr>



</table>
</td>
<tr>
<td><img src="images/bawah_isi.png" /></td>
</tr>
</table>
</body>
</html>