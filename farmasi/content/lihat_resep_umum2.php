<?php
session_start();

include("../include/koneksi.php");
include("../include/fungsi_rp.php");
$tgl=date("Y/m/d");
//$tgl="2011/07/14";
$no_trans=$_GET['no_trans'];
$param_no=$_GET['param_no'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<script>
function PopupCenter(pageURL, title,w,h) {
//var left = (screen.width/2)-(w/2);
//var top = (screen.height/2)-(h/2);
var targetWin = window.open 
//(pageURL, title, 'toolbar=no, alwaysraised=yes, fullscreen=true location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=screen.availWidth.MAX_VALUE, height=screen.availHeight.MAX_VALUE, top='+top+', left='+left);
(pageURL, title, 'address=no, toolbar=no, alwaysraised='+1+', fullScreen=no, locationbar=no, location=0, directories=no, status=no, menubar=0, scrollbars=yes, resizable=0, copyhistory=0, width=700, height=500, top=100, left=400');
 targetWin.focus();
}
</script>
<style>

a:link {
	color: #000000;
	text-decoration:none;
	padding:0,0,0,0;
	margin-bottom:0px;
}

a:visited {
  color: #000000;
  text-decoration:none;
  padding:0,0,0,0;
  margin-bottom:0px;
}

a:hover {
	color:#FF9900;
	text-decoration:underline;
	padding:0,0,0,0;
	margin-bottom:0px;
}

a:active {
	color: #000000;
	text-decoration:none;
	padding:0,0,0,0;
	margin-bottom:0px;
}


body {	
	font-family: Trebuchet MS;
	font-color :#555855;
	
	margin-top: 30px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	}
	
#tengah {
	background-image:url(../images/tengah.png);
	height:33px;
	background-repeat:repeat-x;
	}
	
#tengah_isi {
	background-image:url(../images/tengah_isi.png);
	background-position:center;
	width:703px;
	background-repeat:repeat-y;
	}

#bawah {
	background-image:url(../images/bawah.png);
	height:52px;
	background-repeat:repeat-x;
	}
	
#kiri_atas2 {
	background-image:url(../images/kiri_atas2.png);
	width:303px;
	background-repeat:repeat-y;
}

button, img {
	border:0px; 
}


hr {
	border-style:dotted;
	color:#9b9999;
	}
	
div.buttonsdiv{ /*div that wraps around the submit/reset buttons*/
margin-top: 5px; /*space above buttonsdiv*/
}

div.buttonsdiv input{ /* style for INPUT fields within 'buttonsdiv'. Assumed to be form buttons. */
width: 80px;
background: #e1dfe0;
}

fieldset {
	border-top : 1px solid #9b9999;
	border-right : 1px solid #9b9999;
	border-left : 1px solid #9b9999;
	border-bottom : 1px solid #9b9999;
	}

input {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

textarea {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

select {
font-family:Trebuchet MS;
font-size:11px;
border:1px #CCCCCC solid;
}

/*  Styling for Suggestion Box Container  */
.suggestionsBox {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 300px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}


.suggestionList {
	margin: 0px;
	padding: 0px;
}


/*  Individual Search Results  */
.suggestionList li {
	margin: 0px 0px 3px 0px;
	padding: 7px;
	cursor: pointer;
	-moz-border-radius: 3px;
	-webkit-border-radius: 3px;
	list-style-type: none;
}

/*  Hover effect  */
.suggestionList li:hover {
background-color: #9b9999;
font-weight: bold;
}



.suggestionsBox {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 210px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}
</style>

</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="169px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> DAFTAR RESEP UMUM </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="center"><img src="../images/atas_isi.png"></td>
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
							<table border="0" width="100%">
							<tr align="right">
									<td><a href="kasir_tes2.php">[ Kembali ]</a> &nbsp;</td>
								</tr>
								<tr align="center">
									<td>DAFTAR RESEP UMUM</td>
								</tr>
								<tr align="center">
									<td>BHINEKA BAKTI HUSADA</td>
								</tr>
								
								<tr align="center">
									<td>
							<div style="border:1px  solid  #CCCCCC; width:670px; height:100%; overflow:auto;">
							<table align="center" width="100%">
								<tr align="center" bgcolor="#414141">
								<td width="120px"><font color="#FFFFFF">Tanggal</font></td>
								<td width="120px"><font color="#FFFFFF">No. Resep</font></td>
								<td width="150px"><font color="#FFFFFF">Nama Pasien</font></td>
								<td width="120px"><font color="#FFFFFF">Rumah Sakit Asal</font></td>
								<td width="80px"><font color="#FFFFFF">Action</font></td>
								</tr>
							<?
							$rowsPerPage = 20;


							$pageNum = 1;

							if(isset($_GET['page']))
							{
    							$pageNum = $_GET['page'];
							}

							$offset = ($pageNum - 1) * $rowsPerPage;
							
							
							$q1=mysql_query("select * from resep_head where no_resep like 'RPU/%' and status_bayar=0 order by tgl desc LIMIT $offset, $rowsPerPage");
							

							$no = 1;
							while($r1=mysql_fetch_array($q1))
							{
								 if ($no%2)
								{
								echo "<tr valign=top>";
								}
								else
								{
								echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
								}
								$resepMe= $r1[no_resep];
							 echo"<td align=center>$r1[tgl]</td>
<!--							 <td align=center><a href='../action/to_preview_resep2.php?no_resep=$r1[no_resep]&no_trans=$no_trans&param_no=$param_no'>$r1[no_resep]</a></td> -->
								 <td align=center>" ; ?> 
								 <input type="button" onclick="PopupCenter('preview_resep.php?no_resep=<?= $resepMe ?>','myPop1',800,800)" value='<?php echo $resepMe ;?>'/> </td>
							 	 <?php	
							 	 	echo "<td align=left>$r1[fld02]</td>
									<td align=left>$r1[fld03]</td>
									<td align=center><a href='../action/insert_resep_to_kasir2.php?no_resep=$r1[no_resep]&no_trans=$no_trans&param_no=$param_no&namapas=$r1[fld02]&rsasal=$r1[fld03]'>Bayar</a></td>
									</tr>";
									$no++;
							}
							echo"</table>
							</div>";
							
							echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM resep_head WHERE no_resep like 'RPU/%' and status_bayar=0 order by tgl desc ";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&no_trans=$no_trans&param_no=$param_no\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';
							
							?>
							
							
</td>
</tr>
</table>
							</td>
						</tr>
						<tr>
							<td align="center">
							
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
		<td align="center"><img src="../images/bawah_isi.png"></td>
	</tr>
</table>
</body>

</html>