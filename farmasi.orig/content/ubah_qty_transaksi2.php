<?
session_start();
include "../include/koneksi.php";
include "../include/fungsi_rp.php";
 if($_GET['no_resep'])
{
$no_trans=$_GET['no_trans'];
$no_resep=$_GET['no_resep'];
$param_no=$_GET['param_no'];
$kd_obat=$_GET['kd_obat'];
$namapas=$_GET['namapas'];
$pasien_id=$_GET['pasien_id'];
$tgl=date("Y-m-d");
}

$q1=mysql_query("select * from resep where no_resep='$no_resep' AND kode_obat='$kd_obat'");
$r1=mysql_fetch_array($q1);
$q2=mysql_query("select * from ms_barang where kd_barang='$kd_obat'");
$r2=mysql_fetch_array($q2);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="../action/update_qty_transaksi2.php">
 	<input type="hidden" name="no_trans" value="<?=$no_trans?>" />
	<input type="hidden" name="no_resep" value="<?=$no_resep?>" />
	<input type="hidden" name="param_no" value="<?=$param_no?>" />
	<input type="hidden" name="kd_obat" value="<?=$kd_obat?>" />
	<input type="hidden" name="pasien_id" value="<?=$pasien_id?>" />
	<input type="hidden" name="namapas" value="<?=$namapas?>" />
	<input type="hidden" name="tgl" value="<?=$tgl?>" />
  <table width="700" border="0">
    <tr>
      <td width="102">Nama Obat </td>
      <td width="588"><label>
        <input name="nama_obat" type="text" id="nama_obat" value="<?=$r2['nama']?>" readonly="true"/>
      </label></td>
    </tr>
    <tr>
      <td>Jumlah</td>
      <td><label>
        <input type="text" name="jml" value="<?=$r1['diberi']?>"/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Simpan" onclick=""/>
      </label>
        <label>
        <input type="reset" name="Submit2" value="Batal" />
      </label></td>
    </tr>
  </table>
</form>
</body>
</html>
