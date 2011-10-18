<?php
session_start();

include("../include/koneksi.php");
include("../include/fungsi_rp.php");
if($_POST['no_resep'])
{
$no_trans=$_POST['no_trans'];
$no_resep=$_POST['no_resep'];
$param_no=$_POST['param_no'];
$pasien_id=$_POST['pasien_id'];
$namapas=$_POST['namapas'];
$tgl=date("Y-m-d");
}else if($_GET['no_resep'])
{
$no_trans=$_GET['no_trans'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$pasien_id=$_GET['pasien_id'];
$namapas=$_GET['namapas'];
$tgl=date("Y-m-d");
}

$k_unit=substr($no_resep,0,3);

if($k_unit=='IGD')
{
 $unit_id='51';
}else
if($k_unit=='OKA')
{
 $unit_id='52';
}else
if($k_unit=='LAB')
{
 $unit_id='87';
}else
if($k_unit=='RAD')
{
 $unit_id='91';
}else
if($k_unit=='RRI')
{
 $unit_id='50';
}else 
if($k_unit=='RRJ')
{
 $unit_id='4';
}else
if($k_unit='RPU')
{
 $unit_id='2';
}

$q_cek= mysql_query("select * from penjualan_head where no_trans='$no_trans'");
$r_cek=mysql_fetch_array($q_cek);
$baris=mysql_num_rows($q_cek);

if($baris>0)
{
 $sql=mysql_query("update penjualan_head set no_resep='$no_resep',pasien_id='$pasien_id',fld01='$namapas',created_datetime=now(),created_user='".$_SESSION['U_USER']."' where no_trans='$no_trans'");
}
else 
{
 $sql="insert into penjualan_head (no_trans,no_resep,pasien_id,tgl,created_datetime,created_user,flags,fld01,param_no) values('$no_trans','$no_resep','$pasien_id','".$tgl."',now(),'".$_SESSION['U_USER']."','".$flg."','$namapas','$param_no')";
mysql_query($sql);
} 

$q_p_det=mysql_query("select * from penjualan where no_resep='$no_resep' AND no_trans='$no_trans'");
$r_p_det=mysql_num_rows($q_p_det);
 
if($r_p_det>0)
{ 
 	$dell=mysql_query("delete from penjualan where no_resep='$no_resep' AND no_trans='$no_trans'");
  	$q1=mysql_query("select * from resep where no_resep='$no_resep'");
	$q2=mysql_query("select * from resep_head where no_resep='$no_resep'");
	$r2=mysql_fetch_array($q2);
	while($r1=mysql_fetch_array($q1))
	{
	if($r1['racikan']=='YA')
 	{
	 $p_id=$r1['pasien_id'];
  	 $q_pas=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
  	 $r_pas=mysql_fetch_array($q_pas);
	 /* if($k_unit=='RPU'){
   	 $namapas=$r2['fld02'];
   	}else{
  	$namapas=$r_pas['nama'];
  	} */
 	 mysql_query("insert into penjualan (no_trans,no_resep,dosis_id,ket,racikan,ket_banyak,sub_total,fld01,fld03,tgl) VALUES ('$no_trans','$no_resep','$r1[dosis_id]','$r1[ket]','YA','$r1[ket_banyak]','$r1[sub_total]','$namapas','$r1[fld02]','$tgl')");
  	}
else
	{
  	$p_id=$r1['pasien_id'];
   	$q_pas=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
   	$r_pas=mysql_fetch_array($q_pas);
    /* if($k_unit=='RPU'){
   	$namapas=$r2['fld02'];
   	}else{
  	$namapas=$r_pas['nama'];
  	} */
    $q_obt=mysql_query("select * from ms_barang where kd_barang='$r1[kode_obat]'");
    $r_obt=mysql_fetch_array($q_obt);
    $e_date=$r_obt['expire_date'];
    mysql_query("insert into penjualan (no_trans,no_resep,obat_id,tgl_expire,dosis_id,diberi,ket,ket_banyak,sub_total,fld01,tgl) VALUES ('$no_trans','$no_resep','$r1[kode_obat]','$e_date','$r1[dosis_id]','$r1[diberi]','$r1[ket]','$r1[ket_banyak]','$r1[sub_total]','$namapas','$tgl')");
    }
	}

	
 }
 

else
{  

$q1=mysql_query("select * from resep where no_resep='$no_resep'");
$q2=mysql_query("select * from resep_head where no_resep='$no_resep'");
$r2=mysql_fetch_array($q2);
while($r1=mysql_fetch_array($q1))
{
 if($r1['racikan']=='YA')
 {
  $p_id=$r1['pasien_id'];
  $q_pas=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
  $r_pas=mysql_fetch_array($q_pas);
  /* if($k_unit=='RPU'){
   $namapas=$r2['fld02'];
   }else{
  	$namapas=$r_pas['nama'];
  	} */
 		 mysql_query("insert into penjualan (no_trans,no_resep,dosis_id,ket,racikan,ket_banyak,sub_total,fld01,fld03,tgl) VALUES ('$no_trans','$no_resep','$r1[dosis_id]','$r1[ket]','YA','$r1[ket_banyak]','$r1[sub_total]','$namapas','$r1[fld02]','$tgl')");
  }
  else
  {
   $p_id=$r1['pasien_id'];
   $q_pas=mysql_query("select * from simrs.pasien where id='$r1[pasien_id]'");
   $r_pas=mysql_fetch_array($q_pas);
   /* if($k_unit=='RPU'){
   $namapas=$r2['fld02'];
   }else{
  $namapas=$r_pas['nama'];
  }*/
   $q_obt=mysql_query("select * from ms_barang where kd_barang='$r1[kode_obat]'");
   $r_obt=mysql_fetch_array($q_obt);
   $e_date=$r_obt['expire_date'];
   mysql_query("insert into penjualan (no_trans,no_resep,obat_id,tgl_expire,dosis_id,diberi,ket,ket_banyak,sub_total,fld01,tgl) VALUES ('$no_trans','$no_resep','$r1[kode_obat]','$e_date','$r1[dosis_id]','$r1[diberi]','$r1[ket]','$r1[ket_banyak]','$r1[sub_total]','$namapas','$tgl')");
  }
 }
 $sql="insert into penjualan_head (no_trans,no_resep,pasien_id,tgl,created_datetime,created_user) values('$no_trans','$no_resep','$pasien_id','".$tgl."',now(),'$usercreated','$paramno')";
mysql_query($sql);

}
/* $q_pas=mysql_query("select * from pasien where id='$r1[pasien_id]'");
  $r_pas=mysql_fetch_array($q_pas);
   if($r2['flags']==3){
   $namapas=$r2['fld02'];
   }else{
  $namapas=$r_pas['nama']; 
  }*/
 print "<script>location.href='../content/kasir_tes2.php?no_trans=$no_trans&no_resep=$no_resep&namapas=$namapas&param_no=$param_no&pasien_id=$pasien_id&unit_id=$unit_id'</script>";
?>