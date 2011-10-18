<?
$bulan=date("M");
$bln=date("m");
$thn=date("Y");
$blnjurnal=$thn."-".$bln."-";



$q1=mysql_query("select * from daftar_akun");
while($r1=mysql_fetch_array($q1))
{
	//echo $r1['no_rek'];
			$saldo=$r1["saldo_penyesuaian"];
			$q2=mysql_query("select * from jurnal_penyesuaian where no_rek='$r1[no_rek]' and fld01=0 and tgl like '$blnjurnal%'");

	
			while($r2=mysql_fetch_array($q2))
			{	
			$saldo=$saldo+$r2["debit"]-$r2["kredit"];
			mysql_query("update daftar_akun set saldo_penyesuaian='$saldo' where no_rek='$r1[no_rek]'");
			mysql_query("update jurnal_penyesuaian set fld01=1 where no_rek='$r1[no_rek]'");
	 		
	}
			
}

echo"<script>location.href='home.php?hal=content/neraca_lajur&bln=$bln&thn=$thn'</script>";

?>