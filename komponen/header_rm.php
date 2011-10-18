<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
<head>
	<title><?=$_SESSION[setting][app_name_pendek]?> - <?=$_TITLE?></title>
	<meta name="Generator" content="EditPlus" />
	<meta name="Author" content="" />
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>simrs.css" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>header.css" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>sidebar.css" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>mainbar.css" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>modal.css" />
	<link rel="stylesheet" type="text/css" href="<?=MEDIA_URL?>tooltip.css" />
	<link rel="shortcut icon" type="image/ico" href="<?=IMAGES_URL?>favicon.ico" />
	<?php
		if(is_object($_xajax))
		$_xajax->printJavascript(MEDIA_URL . "xajax"); 
	?>
	<script language="javascript" type="text/javascript">
		/*global variable untuk digunakan di pulldown menu dll*/
		var URL = '<?=URL?>';var IMAGES_URL = '<?=IMAGES_URL?>';var MEDIA_URL = '<?=MEDIA_URL?>';function cekEnableJs(){document.getElementById('window_utama').style.display = '';setSidebarMainbar();}function setSidebarMainbar(){var lebar = screen.width - 180;var tinggi = screen.height - 162;document.getElementById('sidebar').style.height = tinggi + 'px';document.getElementById('mainbar').style.height = tinggi + 'px';}
		
		function clickIE(){if(document.all){return false;}}function clickNS(e){if(document.layers||(document.getElementById&&!document.all)){if(e.which==2||e.which==3){return false;}}}if(document.layers){document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}document.oncontextmenu=new Function("return false")
		
	</script>
	<script language="javascript" type="text/javascript" src="<?=MEDIA_URL?>simrs.js"></script>
	<script language="javascript" type="text/javascript" src="<?=MEDIA_URL?>sidebar.js"></script>
	<script language="javascript" type="text/javascript" src="<?=MEDIA_URL?>terbilang.js"></script>
	<script language="javascript" type="text/javascript" src="<?=MEDIA_URL?>tooltip.js"></script>
	<? if(is_file(MEDIA_DIR . $_part[module] . '/' . $_part[page] . '.js')): ?>
		<script language="javascript" type="text/javascript" src="<?=MEDIA_URL . $_part[module] . '/' . $_part[page] . '.js'; ?>"></script>
	<?  else: ?>
		<script language="javascript" type="text/javascript" src="<?=MEDIA_URL . $_part[module] . '/' . $_part[module] . '.js'; ?>"></script>
	<? endif; ?>
	<script type="text/javascript" language="JavaScript1.2" src="<?=MEDIA_URL?>menu/stmenu.js"></script>
</head>
<body id="main-body" onload="cekEnableJs();focusFirst();get_sidebar_content();">
<div id="window_utama" style="display:none;">
<div id="debug"></div>
<div id="about" style="display:none;" ondblclick="hide_about();"><div style="text-align:center;"><b>SIMRS 2011</b><br />Sistem Informasi Manajemen Rumah Sakit 2011</div><br /><br /><div style="text-align:center;"><b>&copy; Rumah Sakit Bhineka Bakti Husada</b></div></div>
<div id="loading_background" style="display:none;"></div>
<div id="loading" style="display:none;"><img src="<?=IMAGES_URL?>wait.gif" alt="Loading" style="float:left;margin-right:10px;" /><span id="loading_text">Please Wait...</span></div>
<div id="status_simpan" style="display:none;"><img src="<?=IMAGES_URL?>save.png" alt="Data Disimpan" style="float:left;margin-top:10px;margin-left:5px;margin-right:10px;" /><br />Data Disimpan</div>
<a name="top"></a>
<div id="top-menu">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td style="width:250px;">
				<script type="text/javascript" language="JavaScript1.2" src="<?=MEDIA_URL . "menu/" . $_SESSION[menu_file]?>"></script>
			</td>
			<td>
				<a href="javascript:void(0);" title="Show Hide Sidebar" onclick="showHideSidebar();focusFirst();" accesskey="S" ><img src="<?=IMAGES_URL?>sidebar.png" id="sidebar_button" alt="Show Hide Sidebar" border="0"/></a>&nbsp;
				<a href="javascript:void(0);" title="Chat" onclick="showHideSidebar();focusFirst();" accesskey="C" ><img src="<?=IMAGES_URL?>achat.png" id="chatbar_button" alt="Chat" border="0"/></a>
			</td>
		</tr>
	</table>
</div>
	<table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
		<tr>
			<td>
				<!-- header -->
				<table cellpadding="0" cellspacing="0" border="0" class="header">
					<tr>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<!-- content -->
				<table cellpadding="0" cellspacing="0" border="0" class="content">
					<tr>
						<td class="td_sidebar" id="td_sidebar" style="display:<?=$_COOKIE[sidebar_display]?>">
							<div id="sidebar" style="height:590px;width:180px;display:<?=$_COOKIE[sidebar_display]?>">
							<div id="infobar_head" class="tangan"><img src="<?=IMAGES_URL?>sidebar_infobar.gif" alt="" onclick="showHideInfoBar();"/></div>
							<div id="infobar" style="display:<?=$_COOKIE[infobar_display]?>;">
								<? include KOMPONEN_DIR . "infobar.php"; ?>
							</div>
							<div id="infobar_px_hari_ini_head" class="tangan"><img src="<?=IMAGES_URL?>sidebar_px_hari_ini.gif" alt="" onclick="showHidePxHariIni();"/></div>
							<div id="infobar_px_hari_ini" style="display:<?=$_COOKIE[infobar_px_hari_ini_display]?>;">
								<div style="font-style:italic;text-align:right;margin-right:30px;" id="infobar_tgl"></div>
								<div class="infobar_list" id="infobar_jml_pasien_rm"></div>
							</div>
							<!--<div id="infobar_cari_px_head" class="tangan"><img src="<?=IMAGES_URL?>sidebar_cari_px.gif" alt="" onclick="showHideCariPx();fokus('infobar_cari_px_param');"/></div>
							<div id="infobar_cari_px" style="display:<?=$_COOKIE[infobar_cari_px_display]?>;"><br />
								<form id="infobar_cari_px_form" name="infobar_cari_px_form" method="post" action="" onsubmit="return false;">
								<input type="text" name="infobar_cari_px_param" id="infobar_cari_px_param" size="25" class="inputanx" style="margin-left:20px;" onkeyup="infobar_cari_px_cari(this, event);" onblur="hide_infobar_cari_px_cari()" /></form><br />
							</div>-->
							<!-- <div id="infobar_info_bangsal_head" class="tangan"><img src="<?=IMAGES_URL?>sidebar_info_bangsal.gif" alt="" onclick="showHideInfoBangsal();"/></div>
							<div id="infobar_info_bangsal" style="display:<?=$_COOKIE[infobar_info_bangsal_display]?>;">
								<ul class="infobar_list" id="infobar_bangsal"></ul>
							</div> -->
							<div id="chatbar_head" class="tangan"><img src="<?=IMAGES_URL?>sidebar_chatbar.gif" alt="" onclick="showHideChatBar();" /></div>
							<div id="chatbar" style="margin-left:5px;display:<?=$_COOKIE[chatbar_display]?>;">
								<? include KOMPONEN_DIR . "chatbar.php"; ?>
							</div>
							</div>
						</td>
						<td style="background-color: #F8F9F5;">
							<!-- isine -->
							<div class="mainbar" id="mainbar" style="height:590px;width:98%;">

