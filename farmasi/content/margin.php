<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<font style="font-size:14px; " color="#fefafa"><b>Margin</b></font></td>
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
					<font style="font-size:12px; ">
					<?php
						$q= mysql_query("SELECT * FROM margin WHERE id = '$_GET[id]'");
						$r = mysql_fetch_array($q);
						if ($r) 
						{
							echo '<form method=post action=home.php?hal=action/update_margin enctype=multipart/form-data>';
						}
						else
						{
							echo '<form method=post action=home.php?hal=action/insert_margin enctype=multipart/form-data>';
						}
					?>
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<input type="hidden" name="id" value="<?=$r['id'];?>">
						<tr>
							<td align="right">Jenis : </td>
							<td>
							<select name="jenis">
								<?php
									if ($r['jenis']=="Tunai")
									{
										echo "<option value=''>--Pilih--</option>
											  <option value='Tunai' selected>Tunai</option>
											  <option value='Non-Tunai'>Non-Tunai</option>";
									}
									elseif ($r['jenis']=="Non-Tunai")
									{
										echo "<option value=''>--Pilih--</option>
											  <option value='Tunai'>Tunai</option>
											  <option value='Non-Tunai' selected>Non-Tunai</option>";
									}
									else
									{
										echo "<option value='' selected>--Pilih--</option>
											  <option value='Tunai'>Tunai</option>
											  <option value='Non-Tunai'>Non-Tunai</option>";
									}
								?>
							</select>
							</td>
						</tr>
						<tr>
							<td align="right">Kode : </td>
							<td>
							<?php
							if ($r)
							{
							?>
								<input type="text" name="kode" size="5" value="<?= $r['kode']?>" style="background-color:#CCCFFF; " readonly="true">
							<?php
							}
							else
							{	
							?>
								<input type="text" name="kode" size="5" value="<?= $r['kode']?>">
							<?php
							}
							?>
							</td>
						</tr>
						<tr>
							<td align="right">Klasifikasi Pasien : </td>
							<td><input type="text" name="klasifikasi_pasien" size="20" value="<?= $r['klasifikasi_pasien']?>"></td>
						</tr>
						<tr>
							<td align="right">Margin % : </td>
							<td><input type="text" name="margin" size="5" value="<?= $r['margin']?>"></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" value="Simpan"> &nbsp; <input type="reset" value="Reset"></td>
						</tr>
					</table>
					</form>
					<hr>
					<div style="border:1px  solid  #CCCCCC; width:100%; height:200px; overflow:auto;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td>
								<?php
									$q = mysql_query ("SELECT * FROM margin");
									echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
											<tr bgcolor=#414141 align=center>
												<td><font color=#FFFFFF>#</font></td>
												<td><font color=#FFFFFF>Jenis</font></td>
												<td><font color=#FFFFFF width=100px>Kode</font></td>
												<td><font color=#FFFFFF>Klasifikasi</font></td>
												<td><font color=#FFFFFF>Margin % </font></td>
												<td><font color=#FFFFFF width=120px>Action</font></td>
											</tr>';
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
										echo "<td align = center>$no</td>
											<td>$r[jenis]</td>
											<td width=100px>$r[kode]</td>
											<td>$r[klasifikasi_pasien]</td>
											<td align=right>$r[margin]</td>
											<td align=center width=120px>
											<a href=home.php?hal=content/margin&id=$r[id]><font size=-1>EDIT</font></a> | 
											<a href=\"home.php?hal=action/hapus_margin&id=$r[id]\" onClick=\"return confirm('Apakah Anda benar-benar akan menghapus ?')\">
											<font size=-1>HAPUS</font></a>
											</td>
											</tr>";
										$no++;
									}
									echo '</table>';
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
