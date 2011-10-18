<?php
$tgl=date("Y-m-d");
$usercreated=$_SESSION['U_USER'];
if($_POST['jenis']=='0')
{
 $flg='3';
}
else
{
 $flg='4';
}
$cari=mysql_query("select * from penjualan_head where no_trans='".$_POST['textfield']."'");
$num_cari=mysql_num_rows($cari);
if ($num_cari<1)
{
$sql="insert into penjualan_head (no_trans,no_resep,tgl,created_datetime,created_user,flags,fld01,fld02,param_no) values('".$_POST['textfield']."','".$_POST['txt_no_resep']."','".$tgl."',now(),'$usercreated','".$flg."','".$_POST['txt_nama']."','".$_POST['txt_rumahsakit']."','".$_POST['param_no']."')";
mysql_query($sql);
}
$no_transaksi=$_POST['textfield'];
?>
<form method="post" action="home.php?hal=content/input_obat_bebas">
<input type="hidden" name="no_transaksi" value="<?php $no_transaksi; ?>" />
</form>
<?	
print "<script>location.href='home.php?hal=content/input_obat_bebas&no_transaksi=$no_transaksi'</script>";

?>
