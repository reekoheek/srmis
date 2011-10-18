<?php
	session_start();
	include "include/koneksi.php";
	include "include/fungsi_rp.php";
	include "action/barang_kadaluarsa.php";
	include "action/amc.php";
	if(!isset($_SESSION['U_ID']) || $_SESSION['U_ID'] == "")
		die("Anda harus login untuk mengakses halaman ini. <meta http-equiv=refresh content=2;url='index.php'>");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"  />
<title>Selamat Datang di Apotek</title>

<link rel="stylesheet" type="text/css" href="include/ddlevelsmenu-base.css" />
<link rel="stylesheet" type="text/css" href="include/ddlevelsmenu-sidebar.css" />
<script type="text/javascript" src="include/ddlevelsmenu.js"></script>
<!-- SPRY Style -->
<link rel="stylesheet" type="text/css" href="include/SpryTabbedPanels.css" />
<link rel="stylesheet" type="text/css" href="include/SpryHTMLPanel.css" />
<link rel="stylesheet" type="text/css" href="include/SpryAccordion.css" />
<script type="text/javascript" src="include/SpryTabbedPanels.js"></script>
<script type="text/javascript" src="include/SpryHTMLPanel.js"></script>
<script type="text/javascript" src="include/SpryEffects.js"></script>
<script type="text/javascript" src="include/SpryAccordion.js"></script>
<!-- End SPRY -->

<!-- pop up jquery -->
<link rel="stylesheet" href="include/general.css" type="text/css" media="screen" />
<script src="include/jquery-1.2.6.min.js" type="text/javascript"></script>
<script src="include/popup.js" type="text/javascript"></script>
<script src="include/popup2.js" type="text/javascript"></script>
<!-- end pop up jquery-->


<!-- pop up windows-->
<script>
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open 
(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}
</script>
<!--end pop up windows -->


<!-- setting auto suggest-->
<script type="text/javascript" src="include/jquery-1.2.1.pack.js"></script> 
<!-- end auto suggest-->


<link rel="shortcut icon" href="logo.ico" />
<script language= "JavaScript">
<!--
function numbersonly()
{
	if (event.keyCode<48||event.keyCode>57)
	{
	return false;
	} else
	{
	return true;
	}			
}	
//-->
</SCRIPT>
</head>
<link rel="stylesheet" type="text/css" href="include/style.css">
<link rel="stylesheet" type="text/css" href="include/style_menu.css">
<script src="include/main_menu.js" type="text/javascript"></script>

<!--setting untuk calendar-->  
		<SCRIPT type="text/javascript" src="calendar/firebug.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="calendar/jquery.min.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="calendar/date.js"></SCRIPT>
		<SCRIPT type="text/javascript" src="calendar/jquery.datePicker.js"></SCRIPT>
		<LINK rel="stylesheet" type="text/css" media="screen" href="calendar/datePicker.css">
		<LINK rel="stylesheet" type="text/css" media="screen" href="calendar/demo.css">
		<SCRIPT type="text/javascript" charset="utf-8">
            $(function()
            {
				//$('.date-pick').datePicker().val(new Date().asString()).trigger('change');
				$('.date-pick').datePicker({startDate:'01/01/1901'});
            });
		</SCRIPT>
<!-- end calendar-->

<body style="background-color:#d5d4d4; " >
<table border="0" cellpadding="0" cellspacing="0" width="1024px" align="center" bgcolor="#fefafa">
	<tr valign="top">
		<td><img src="images/kiri_atas.png"></td>
		<td><img src="images/apotek.png"></td>
		<td rowspan="2">
		<?php
			if ($_SESSION["U_JNS_KEL"] == "L")
			{
				echo '<img src=images/foto_male_gray.png>';
			}
			else
			{
				echo '<img src=images/foto_female_gray.png>';
			}
            $userLoged = $_SESSION["U_USER"];
		?>		</td>
	</tr>
	<tr valign="top">
		<td id="kiri_atas2"><br></td>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top" height="33px">
					<td width="389" height="33" align="right"><img src="images/kiri.png"></td>
					<td align="right" id="tengah" width="311">
					<table border="0" cellpadding="4" cellspacing="0" width="100%">
						<tr>
						<?php
						if ($_SESSION['U_SUBUNIT']=='0')
							{
							$SubUnit = "";
							}
						else
							{
							$SubUnit = " - " .$_SESSION['U_NMUNIT']."";
							}		
						?>
							<td align="right" width="20%"><font style="font-size:12px "> <?=$_SESSION['U_USER'].  " - "  .$_SESSION['U_KET']. "".$SubUnit."" ;?> </font>&nbsp;&nbsp;</td>
						</tr>
					</table>				  </td>
				</tr>
				<tr>
					<td colspan="2" height="32px">&nbsp;</td>
				</tr>
			</table>		</td>
	</tr>
	
	<tr valign="top">
	  <td id="kiri_atas2"><table border="0" cellpadding="0" cellspacing="0" width="303px">
        <tr>
          <td width="36px">&nbsp;</td>
          <td width="76px" valign="top" align="center"><?php include "content/icon_menu.php";?></td>
          <td width="191px" valign="top">&nbsp;&nbsp;
              <?php include "include/main_menu.php";?></td>
        </tr>
      </table></td>
		<td colspan="2">
			<table border="0" cellpadding="0" cellspacing="0" width="721px">
				<tr valign="top">
					<td valign="top">
					<?php 
						$q = mysql_query ("select * from tbl_menu where id='".$_SESSION['unit_id']."'");
						$r = mysql_fetch_array($q);				
						
						$page = $r['Link'];
						if (strlen($_GET[hal])>0)
						{
							$file = strip_tags($_GET[hal]).".php";
							if(file_exists($file))
								{
								include $file;
								} 
								else include "isi_home.php";
						} 
						else include "isi_home.php";
					?>					</td>
					<td width="18px">&nbsp;</td>
				</tr>
			</table>		</td>
	</tr>
	
	<tr>
		<td><img src="images/kiri_bawah.png"></td>
		<td colspan="2" id="bawah"></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="1024" align="center">
	<tr>
		<td align="center"><font style="font-size:11px; ">Copyright &copy; 2011 | All Right Reserved</font></td>
	</tr>
</table>
</body>
</html>
