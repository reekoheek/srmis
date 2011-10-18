<?php
	session_start();

	include "include/koneksi.php";
    	
	// Mengecek user dan password
		echo $_SESSION['user'];
       echo $_SESSION['pwd'];
		// Mengecek user dan password

       $user = $_SESSION['user'];
	   $pwd = md5($_SESSION['pwd']);
    
	//$pwd = $_POST['password'];
	$query = "SELECT * FROM db_apotek.user WHERE nm_user = '$user' AND pwd = '$pwd'";
	$result = mysql_query($query);
    
    

	// Cek apakah user ditemukan atau tidak
	if(mysql_num_rows($result) > 0) {
		$data = mysql_fetch_array($result);

		$qq1 = mysql_query ("SELECT * FROM pelayanan where id='".$data['sub_unit']."'");
		$rr1 = mysql_fetch_array($qq1);
		
		
		$qq = mysql_query ("update user set f_login='1' WHERE id = '".$data['id']."'");
		$rr = mysql_query($qq);
		
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
		
		$_SESSION['U_ID'] = $data['id'];
		$_SESSION['U_NAME'] = $data['fullname'];
		$_SESSION['U_USER'] = $data['nm_user'];
		$_SESSION['U_JNS_KEL'] = trim($data['jns_kel']);
		$_SESSION['U_STATUS'] = $data['status_aktifasi'];
		$_SESSION['U_KODE'] = $data['type_id'];
		$_SESSION['U_UNIT'] = $data['group_id'];
		$_SESSION['U_KET'] = trim($data['Ket']);
		$_SESSION['U_UNITID'] = trim($data['unit_id']);
		$_SESSION['U_SUBUNIT'] = trim($data['sub_unit']);
		$_SESSION['U_NMUNIT'] = trim($rr1['nama_lain']);	
		
		$qq2 = mysql_query ("select * from tbl_menu where id='".$_SESSION['U_UNITID']."'");
		$rr2 = mysql_fetch_array($qq2);				
						
		$page = $rr2['Link'];	
		
		header("location:home.php?hal=$page");
		}
		
		else
		{
			$q = mysql_query("SELECT * FROM user WHERE nm_user = '$user' AND pwd = '$pwd'");
			$r = mysql_fetch_array($q);
		if ($r['status_aktivasi'] == '0')
		{
			print "<script>alert('Akun sudah tidak aktif lagi.');location.href='index.php'</script>";
		}
		else
		{
			echo 'session :'.$_GET['user'];
		}
	}
    /* GLOBAL CONSTANTS */
    $userLoged = $_SESSION['U_USER'];
	
?>