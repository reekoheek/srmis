<?php
$bulan=date("M");
if($_POST['bulan'])
{
$bln=$_POST['bulan'];
$thn=$_POST['tahun'];
}else
if($_GET['bulan'])
{
 $bln=$_GET['bulan'];
 $thn=$_GET['tahun'];
}
$blnjurnal=$thn."-".$bln."-";

$q1=mysql_query("select * from daftar_akun");
while($r1=mysql_fetch_array($q1))
{
			$saldo=$r1["saldo"];
			$saldoawal=$r1["saldo_awal"];
			$q2=mysql_query("select * from jurnal_umum where no_rek='$r1[no_rek]' and fld01=0 and tgl like '$blnjurnal%' order by id asc");
			$no=1;
	
			while($r2=mysql_fetch_array($q2))
			{
			 
					$saldo=$saldo+$r2["debit"]-$r2["kredit"];
			
	  		
	 			 $no++;
	 			mysql_query("update daftar_akun set saldo='$saldo' where no_rek='$r1[no_rek]'");
				mysql_query("update jurnal_umum set fld01=1 where no_rek='$r1[no_rek]'");
	}
			
}


print"<script>alert('Buku Besar Telah disimpan, Klik OK untuk melihat Buku Besar');location.href='home.php?hal=content/lihat_buku_besar&bln=$bln&thn=$thn'</script>";

?>