<?
   include "init.php";
   antiIE();

   function proses_login($val) {
      $objResponse = new xajaxResponse();
      $kon = new Konek;
      $kon->sql = "
			SELECT
				p.id as id,
				pg.id as group_id,
				pg.nama as group_nama,
				p.nama as nama,
				p.username as username,
				p.pwd as pwd,
				p.pelayanan_id as pelayanan_id,
				pg.menu_file as menu_file,
				pel.nama as pelayanan_nama,
				mpg.module as nama_module
			FROM
				pengguna p
				JOIN pengguna_group pg ON (pg.id = p.pengguna_group_id)
				JOIN module_pengguna_group mpg ON (mpg.pengguna_group_id = pg.id)
				LEFT JOIN pelayanan pel ON (p.pelayanan_id = pel.id)
			WHERE
				p.username = '".$val[username]."'

		";
      $kon->execute();
      $data = $kon->getAll();

      $objResponse->addClear("pwd", "value");
      if(empty($data)) {
         //cek ke seeting farmasi
         $kon->sql = "SELECT * FROM db_apotek.user WHERE db_apotek.user.nm_user = '".$val[username]."' AND db_apotek.user.pwd = '".md5($val[pwd])."'";            
          $kon->execute();
          $farmasi= $kon->getOne();
          if(empty($farmasi)) {          
             $objResponse->addAssign("status_login", "innerHTML", "Account Tidak Ditemukan");
             $objResponse->addScriptCall("fokus", "username");
          } else
          {
              $kon->sql = "SELECT * FROM db_apotek.pelayanan where db_apotek.pelayanan.id='".$farmasi[sub_unit]."'";            
              $kon->execute();
              $p = $kon->getAll();
              
              $kon->sql = "update db_apotek.user set db_apotek.user.f_login='1' WHERE db_apotek.user.id = '".$farmasi[id]."'";            
              $kon->execute();
             
             
             $_SESSION[user] = $farmasi[nm_user];
	         $_SESSION[pwd] = $farmasi[pwd];
             
             setcookie("user",$val[username]);
             setcookie("pwd",$val[pwd]);
             
             //setting farmasi
             // Register variable session
    		session_register("U_ID");
    		session_register("U_NAME");
    		session_register("U_USER");
    		session_register("U_JNS_KEL");
    		session_register("U_STATUS");
    		session_register("U_KODE");
    		session_register("U_KET");
    		session_register("U_UNITID");
    		session_register("U_SUBUNIT");
    		session_register("U_NMUNIT");
    		
    		$_SESSION['U_ID'] = $farmasi['id'];
    		$_SESSION['U_NAME'] = $farmasi['fullname'];
    		$_SESSION['U_USER'] = $farmasi['nm_user'];
    		$_SESSION['U_JNS_KEL'] = trim($farmasi['jns_kel']);
    		$_SESSION['U_STATUS'] = $farmasi['status_aktifasi'];
    		$_SESSION['U_KODE'] = $farmasi['type_id'];
    		$_SESSION['U_UNIT'] = $farmasi['group_id'];
    		$_SESSION['U_KET'] = trim($farmasi['Ket']);
    		$_SESSION['U_UNITID'] = trim($farmasi['unit_id']);
    		$_SESSION['U_SUBUNIT'] = trim($farmasi['sub_unit']);
    		$_SESSION['U_NMUNIT'] = trim($p['nama_lain']);   
          
          
          
             $kon->sql = "SELECT * FROM setting";
             $kon->execute();
             $_SESSION[setting] = $kon->getOne();
             $_SESSION[pengguna_id] = $data[0][id];
             if($data[0][pelayanan_id]) $_SESSION[pelayanan_id] = $data[0][pelayanan_id];
             if($data[0][pelayanan_nama]) $_SESSION[pelayanan_nama] = $data[0][pelayanan_nama];
             $_SESSION[nama] = $farmasi[fullname];
             $_SESSION[username] = $farmasi[nm_user];
             $_SESSION[group_id] = $data[0][group_id];
             $_SESSION[group_nama] = $farmasi[Ket];
             
             //$_SESSION[menu_file] = $data[0][menu_file];
             $_SESSION[menu_file] = "menu_farmasi.js";
             $_SESSION[module][nama][0] = "home";
             for($i = 0; $i < sizeof($data); $i++) {
                $_SESSION[module][nama][$i + 1] = $data[$i][nama_module];
             }
             $objResponse->addRedirect(URL."home/");
              
          }   
      } elseif($data[0][pwd] != md5($val[pwd])) {
         $objResponse->addAssign("status_login", "innerHTML", "Password Salah");
         $objResponse->addScriptCall("fokus", "pwd");
      } else {
         
         $kon->sql = "SELECT * FROM setting";
         $kon->execute();
         $_SESSION[setting] = $kon->getOne();
         $_SESSION[pengguna_id] = $data[0][id];
         if($data[0][pelayanan_id]) $_SESSION[pelayanan_id] = $data[0][pelayanan_id];
         if($data[0][pelayanan_nama]) $_SESSION[pelayanan_nama] = $data[0][pelayanan_nama];
         $_SESSION[nama] = $data[0][nama];
         $_SESSION[username] = $data[0][username];
         $_SESSION[group_id] = $data[0][group_id];
         $_SESSION[group_nama] = $data[0][group_nama];
         $_SESSION[menu_file] = $data[0][menu_file];
         $_SESSION[module][nama][0] = "home";
         for($i = 0; $i < sizeof($data); $i++) {
            $_SESSION[module][nama][$i + 1] = $data[$i][nama_module];
         }
         $objResponse->addRedirect(URL."home/");
      }
      return $objResponse;
   }

   if($_GET[page] == "logout") {
      session_destroy();
      session_regenerate_id();
      header("LOCATION:".URL."login.php");
   }
   $xajax = new xajax();
   $xajax->registerFunction("proses_login");
   $xajax->processRequests();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US" xml:lang="en-US">
	<head>
		<title>Login</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="author" content="tantos" />
		<meta name="blog" content="" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link href="<?= MEDIA_URL ?>simrs.css" type="text/css" rel="stylesheet" />
		<link href="<?= MEDIA_URL ?>login.css" type="text/css" rel="stylesheet" />
		<?php
		   if(is_object($xajax)) $xajax->printJavascript(MEDIA_URL."xajax");
		?>
		<script type="text/javascript" language="JavaScript" src="<?= MEDIA_URL ?>simrs.js"></script>
		<script type="text/javascript">
			function cekEnableJs() {
				if(window.opener) window.opener.close();
				document.getElementById('login').style.display = '';
			}
			function fokus(divId) {
				if(!divId){
					document.getElementById('username').focus();
					document.getElementById('username').select;
				} else {
					document.getElementById(divId).focus();
					document.getElementById(divId).select;
				}
			}
			function tutupWindow() {
				window.close();
			}
		</script>
		<script language="JavaScript" type="text/javascript">
			function proses_login(evt) {
				evt = (evt) ? evt : event;
				var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
				if (charCode == 13) { //enter
					xajax_proses_login(xajax.getFormValues('login_form'));
				}
				return true;
			}
			function clickIE() {
				if (document.all) {
					return false;
				}
			}
			function clickNS(e) {
				if (document.layers||(document.getElementById&&!document.all)) {
					if (e.which==2||e.which==3) {
						return false;
					}
				}
			}
			if (document.layers) {
				document.captureEvents(Event.MOUSEDOWN);
				document.onmousedown=clickNS;
			}else{
				document.onmouseup=clickNS;
				document.oncontextmenu=clickIE;
			}
			document.oncontextmenu=new Function("return false")
		</script>
	</head>
	<body id="login_bodi" onload="cekEnableJs();fokus('username')">
		<div id="loading" style="display:none;"><img src="<?= IMAGES_URL ?>wait.gif" alt="Loading" style="float:left;margin-right:10px;" /><span id="loading_text">Please Wait...</span></div>
		<center>
			<div id="login" style="width:500px;display:none;">
				<div style="width:100%;height:150px;background-image:url('<?= IMAGES_URL ?>login.gif')"></div>
				<div style="width:450px;height:125px;background-color:#fefafa">
					<form method="post" action="login.php" name="login_form" id="login_form" onsubmit="return false;">
						<table cellpadding="0" cellspacing="0" border="0" class="login_table" align="100%">
							<tr>
								<td colspan="2" style="text-align: center; height: 10px;"><div id="status_login" style="color:#FFFFFF;font-family:Verdana;font-weight:bold;width:100%;"></div></td>
							</tr>
							<tr>
								<td style="width: 200px; height: 25px;">Username</td>
								<td><input type="text" class="inputan" name="username" id="username" onkeypress="focusNext( 'pwd', event, 'tbl_login', this)" value="" /></td>
							</tr>
							<tr>
								<td style="height: 25px;">Password</td>
								<td><input type="password" class="inputan" name="pwd" onkeypress="proses_login(event)" value="" id="pwd" /></td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td style="height: 30px; text-align: center; width:100%">
								<input type="button" name="tbl_login" id="tbl_login" class="inputan" value="Login" onclick="xajax_proses_login(xajax.getFormValues('login_form'))" /></td>
							</tr>
						</table>
					</form>
				</div>
				<div style="width:100%;height:0px;background-image:url('<?= IMAGES_URL ?>login-footer.gif');"></div>
			</div>
		</center>
		<noscript>
			Aktifkan javascript pada browser Anda, lalu Refresh halaman ini.<br />
			Cara mengaktifkan javascript :<br />
			Tools -> Options -> Content<br />
			Berikan tanda cek pada field "Enable JavaScript".
		</noscript>
	</body>
</html>
