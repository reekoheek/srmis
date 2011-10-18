<?php
	include "../include/koneksi.php";
	if ($_POST['no_resep'])
	{
		$no_resep = $_POST['no_resep'];
	}
	else
	{
		$no_resep = $_GET['no_resep'];
	}
	
	$q = mysql_query("SELECT * FROM resep WHERE no_resep = '$no_resep'");
	while($r = mysql_fetch_array($q))
	{	
		if ($r['racikan'] == 'YA')
		{
			$q_racik = mysql_query("SELECT * FROM racik_detail WHERE no_resep = '$r[no_resep]' AND no_racik='$r[fld02]'");
			while ($r_racik = mysql_fetch_array($q_racik))
			{
				$q_ms_barang = mysql_query("SELECT * FROM ms_barang WHERE kd_barang = '$r_racik[kode_obat]'");
				$r_ms_barang = mysql_fetch_array($q_ms_barang);

				$q_apt = mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$r_ms_barang[id]' AND unit_id='2'");
				$r_apt = mysql_fetch_array($q_apt);
				
				if ($r_apt)
				{
					
					$stok_apt = $r_apt['stok'];
				
					$minta = $r_racik['qty'];
					$stok_sekarang = $stok_apt - $minta;
				
					$q_update_apt = mysql_query("UPDATE barang_unit SET stok = '$stok_sekarang' WHERE unit_id = '2' AND barang_id = '$r_apt[barang_id]'");
					$q_update_racik = mysql_query("UPDATE racik_detail SET flags='1' WHERE no_resep='$no_resep' AND kode_obat='$r_ms_barang[kd_barang]'");
				}
				else
				{
					
					$q_update_racik = mysql_query("UPDATE racik_detail SET flags='4' WHERE no_resep='$no_resep' AND kode_obat='$r_ms_barang[kd_barang]'");
				}
			}
			$q_cek=mysql_query("SELECT * FROM racik_detail WHERE no_resep='$r[no_resep]' AND flags='1'");
			$r_cek=mysql_fetch_array($q_cek);
			if ($r_cek)
			{
				$q_update_resep = mysql_query ("UPDATE resep SET flags='1' WHERE no_resep='$r[no_resep]'");
			}
			else
			{
				$q_update_resep = mysql_query ("UPDATE resep SET flags='4' WHERE no_resep='$r[no_resep]'");
			}
		}
		else
		{
			$q_ms_barang = mysql_query("SELECT * FROM ms_barang WHERE kd_barang = '$r[kode_obat]'");
			$r_ms_barang = mysql_fetch_array($q_ms_barang);

			$q_apt = mysql_query("SELECT * FROM barang_unit WHERE barang_id = '$r_ms_barang[id]' AND unit_id='2'");
			$r_apt = mysql_fetch_array($q_apt);
			if ($r_apt)
			{
				$stok_apt = $r_apt['stok'];
				
				$minta = $r['diminta'];
				$stok_sekarang = $stok_apt - $minta;
				$diberi = $minta;
				$harga = $r_apt['fld02'];
				$grand = ($harga * $minta)+500;
				
				$q_update_apt = mysql_query("UPDATE barang_unit SET stok = '$stok_sekarang' WHERE unit_id = '2' AND barang_id = '$r_apt[barang_id]'");
				$q_update_resep = mysql_query ("UPDATE resep SET flags='1',
																 diberi='$diberi',
																 sub_total='$grand',
																 harga='$harga' 
																 WHERE no_resep = '$r[no_resep]' AND kode_obat = '$r[kode_obat]'");
			}
			else
			{
				$q_update_resep = mysql_query ("UPDATE resep SET flags='4' WHERE no_resep='$r[no_resep]' AND kode_obat = '$r[kode_obat]'");
			}
		}
	}
	$q_update_resep_head = mysql_query ("UPDATE resep_head SET flags='1' WHERE no_resep='$no_resep'");
	echo "</script><script language=javascript>window.opener.location.reload();window.close();</script><script runat=server>";
?>