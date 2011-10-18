<?
if($_POST['no_trans'])
{
$no_trans=$_POST['no_trans'];
$sql="delete from penjualan where no_trans='$no_trans'";
mysql_query($sql);
$sql2="delete from penjualan_head where no_trans='$no_trans'";
mysql_query($sql2);
echo"<script>alert('Transaksi Dibatalkan');location.href='home.php?hal=content/kasir_tes'</script>";
}else
{
 echo"<script>alert('Transaksi Gagal Dibatalkan');location.href='home.php?hal=content/kasir_tes'</script>";
}
?>