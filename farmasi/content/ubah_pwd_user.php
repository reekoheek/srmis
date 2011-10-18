<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>
<link rel="stylesheet" type="text/css" href="include/style.css">

<body>
<?
if($_POST['go'])
{
 $user=$_POST['username'];
 $q1=mysql_query("select * from user where nm_user='$user'");
 $r1=mysql_fetch_array($q1);
 $cekrow=mysql_num_rows($q1);
 if($cekrow>0)
 {
 	if(md5($_POST['pass_lama'])==$r1['pwd'])
	{
 		$namauser=$r1['nm_user'];
 		$pass_lama=$r1['pwd'];
	}else
	{
	 	print"<script>alert('Username atau Password Anda Salah');location.href='home.php?hal=content/ubah_pwd_user'</script>";
	}
 }else
 {
 print"<script>alert('Username Tidak Ditemukan');location.href='home.php/content/ubah_pwd_user'</script>";
 }
}
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Ubah Password</font></b></td>
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
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="center">
							<table border="0" width="380px">
							<?
								if(!$_POST['go'])
								{
							?>
							<form method="post" action="home.php?hal=content/ubah_pwd_user">
							<tr>
								<td>Username</td><td>:</td>
								<td><input type="text" name="username" value="<?=$_SESSION['U_USER'];?>" readonly="true"/></td>
							</tr>
							<tr>
								<td>Password</td><td>:</td>
								<td><input type="text" name="pass_lama" />
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="2"><input type="submit" name="go" value="GO" />&nbsp;&nbsp;<input type="reset" name="reset"  value="Reset"/></td>
							</tr>
							</form>
							<?
							}else
							if($_POST['go'])
							{
							?>
							<form method="post" action="home.php?hal=action/update_pwd_user">
							<tr>
								<td>Username</td><td>:</td>
								<td><input type="text" name="username" readonly="true" value="<?=$namauser;?>" style="background-color:#CCCFFF"/></td>
							</tr>
							<tr>
								<td>Password Lama</td><td>:</td>
								<td><input type="password" name="pass_lama" readonly="true" value="<?=$pass_lama;?>" style="background-color:#CCCFFF"/>
							</tr>
							<tr>
								<td>Password Baru</td><td>:</td>
								<td><input type="text" name="pass_baru" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="2"><input type="submit" name="ubah" value="Ubah Password" />&nbsp;&nbsp;<input type="reset" name="btl" value="Batal"/></td>
							</tr>
							</form>
							<?
							}
							?>
							
							</table>

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
