<?php
$bulan=date("M");
$bln=date("m");
$thn=date("Y");
$blnjurnal=$thn."-";
$q1=mysql_query("select * from daftar_akun order by no_rek asc");
$deb=0;
$kre=0;
$deb2=0;
$kre2=0;
$deb3=0;
$kre3=0;
$deb4=0;
$kre4=0;
$deb5=0;
$kre5=0;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<!-- suggestion -->
<script>
	function lookup(inputString) {
		if(inputString.length == 0) {
			// Hide the suggestion box.
			$('#suggestions').hide();
		} else {
			// post data to our php processing page and if there is a return greater than zero
			// show the suggestions box
			$.post("string_daftar_akun.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue,thisValue2) {
		$('#inputString').val(thisValue);
		$('#inputString2').val(thisValue2);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->

<style>
.suggestionsBox {
	position: absolute;
	width: 320px;
	background-color: #000000;
	border: 2px solid #000;
	color: #fff;
	padding: 5px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	-moz-border-radius: 8px;
	-webkit-border-radius: 8px;
}

</style>



</head>
<body>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa"> Neraca Lajur </font></b></td>
				<td></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/atas_isi.png"></td>
	</tr>
	<tr>
		<td id="tengah_isi" >
            <table>
             <tr> 
             <td width="15px"></td>
             <td align="right" width="65%">
               <div id="labaRugi" style="display: inline-block;">
               <form method="post" action="home.php?hal=action/cetak_labarugi">
        			<input type="hidden" name="bln" value="<?=$bln?>"/>
        			<input type="hidden" name="thn" value="<?=$thn?>"/>
        			<input type="submit" name="laba" value="Lap. Laba/Rugi"/>
                 </form>
               </div>
              </td>
              <td align="center"> 
               <div id="perubahanModal" style="display: inline;">
                  <form method="post" action="home.php?hal=action/cetak_perubahan_modal">
        			<input type="hidden" name="bln" value="<?=$bln?>"/>
        			<input type="hidden" name="thn" value="<?=$thn?>"/>
        			<input type="submit" name="peru" value="Lap. Perubahan Modal"/>
        	      </form>
               </div>
              </td>
              <td align="center"> 
               <div id="neraca" style="display: inline;">
                 <form method="post" action="home.php?hal=action/cetak_neraca">
        			<input type="hidden" name="bln" value="<?=$bln?>" />
        			<input type="hidden" name="thn" value="<?=$thn?>" />
        			<input type="submit" name="neraca" value="Lap. Neraca"/>
        		 </form>
               </div>
             </td>
              </tr>
            </table>                
        
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
                    <tr>
                    </tr>
<!--						<tr align="right">
							<td><form method="post" action="home.php?hal=action/cetak_labarugi">
							<input type="hidden" name="bln" value="<?=$bln?>">
							<input type="hidden" name="thn" value="<?=$thn?>">
							<input type="submit" name="laba" value="Lap. Laba/Rugi">
							</form></td>
						</tr>
						<tr align="right">
							<td>
							<form method="post" action="home.php?hal=action/cetak_perubahan_modal">
							<input type="hidden" name="bln" value="<?=$bln?>">
							<input type="hidden" name="thn" value="<?=$thn?>">
							<input type="submit" name="peru" value="Lap. Perubahan Modal">
							</form>
							</td>
						<tr align="right">
							<td>
							<form method="post" action="home.php?hal=action/cetak_neraca">
							<input type="hidden" name="bln" value="<?=$bln?>">
							<input type="hidden" name="thn" value="<?=$thn?>">
							<input type="submit" name="neraca" value="Lap. Neraca">
							</form></td>
						</tr>
-->
						<tr>
							<td align="center" colspan="3">
							<div style="border:1px  solid  #CCCCCC; width:670px; height:650px; overflow:auto;">
							<table border="0" width="1550px">
								<tr align="center">
									<td>NERACA LAJUR</td>
								</tr>
								<tr align="center">
									<td>BHINEKA BAKTI HUSADA</td>
								</tr>
								<tr align="center">
									<td>per <? echo $bulan." ".$thn; ?></td>
								</tr>
								<tr align="center">
									<td>
							<table border="0" width="100%">
<tr align="center" bgcolor="#414141">
	<td width="80px" rowspan="2"><font color="#FFFFFF">No. Rek</font></td>
	<td width="240px" rowspan="2"><font color="#FFFFFF">Nama Rekening</font></td>
	<td width="240px" colspan="2"><font color="#FFFFFF">Neraca Saldo</font></td>
	<td width="240px" colspan="2"><font color="#FFFFFF">Penyesuaian</font></td>
	<td width="240px" colspan="2"><font color="#FFFFFF">NSSP</font></td>
	<td width="240px" colspan="2"><font color="#FFFFFF">LABA/RUGI</font></td>
	<td width="240px" colspan="2"><font color="#FFFFFF">NERACA</font></td>
</tr>
<tr align="center" bgcolor="#414141">
	
	
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
	<td width="120px"><font color="#FFFFFF">Debit</font></td>
	<td width="120px"><font color="#FFFFFF">Kredit</font></td>
</tr>
<?
$no = 1;
while($r1=mysql_fetch_array($q1))
{
 if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
 echo" 	<td align=center>$r1[no_rek]</td>
		<td align=left>$r1[nama_rek]</td>";
		//neraca saldo
		$sal=$r1["saldo_awal"]+$r1["saldo"];
		if($sal>0)
		{
			$deb=$deb+$r1["saldo"]+$r1["saldo_awal"];
		 echo"<td align=right>"; rupiah($r1['saldo']+$r1['saldo_awal']); echo"</td>
		 		<td>&nbsp;</td>";
		}else if($sal<0)
		{
			$ss=str_replace("-","",$sal);
			$kre=$kre-$sal;
		 echo"<td>&nbsp;</td>
		 		<td align=right>"; rupiah($ss); echo"</td>";
		}else
		{
		 echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }
		 //Penyesuaian
		 if($r1["saldo_penyesuaian"]>0)
		{
			$deb2=$deb2+$r1["saldo_penyesuaian"];
		 echo"<td align=right>"; rupiah($r1['saldo_penyesuaian']); echo"</td>
		 		<td>&nbsp;</td>";
		}else if($r1["saldo_penyesuaian"]<0)
		{
			$ss=str_replace("-","",$r1["saldo_penyesuaian"]);
			$kre2=$kre2-$r1["saldo_penyesuaian"];
		 echo"<td>&nbsp;</td>
		 		<td align=right>"; rupiah($ss); echo"</td>";
		}else
		{
		 echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }
		 //NSSP
		 $jsaldo=$sal+$r1['saldo_penyesuaian'];
		 if($jsaldo>0)
		 {
		 	$deb3=$deb3+$jsaldo;
		  echo"<td align=right>"; rupiah($jsaldo); echo"</td>
		  		<td>&nbsp;</td>";
		 }else if($jsaldo<0)
		 {
		 	$ss=str_replace("-","",$jsaldo);
		  $kre3=$kre3-$jsaldo;
		  echo"<td>&nbsp;</td>
		  		<td align=right>"; rupiah($ss); echo"</td>";
		 }else
		 {
		  echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }
		 //laba/rugi
		 if(($r1['type']<>'Pendapatan') && ($r1['type']<>'Beban'))
		 {
		  echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }else
		 if(($r1['type']=='Pendapatan') || ($r1['type']=='Beban'))
		 {
			if($jsaldo>0)
		 	{
		 	 $deb4=$deb4+$jsaldo;
		 	 echo"<td align=right>"; rupiah($jsaldo); echo"</td>
		  		<td>&nbsp;</td>";
			}else if($jsaldo<0)
		 	{
				$ss=str_replace("-","",$jsaldo);
		  	$kre4=$kre4-$jsaldo;
		  	echo"<td>&nbsp;</td>
		  		<td align=right>"; rupiah($ss); echo"</td>";
			}else
		 	{
		  	echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 	}		 
		}
		//neraca
		if(($r1['type']=='Pendapatan') || ($r1['type']=='Beban'))
		 {
		  echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 }else
		 if(($r1['type']<>'Pendapatan') && ($r1['type']<>'Beban'))
		 {
			if($jsaldo>0)
		 	{
		 	 $deb5=$deb5+$jsaldo;
		 	 echo"<td align=right>"; rupiah($jsaldo); echo"</td>
		  		<td>&nbsp;</td>";
			}else if($jsaldo<0)
		 	{
			$ss=str_replace("-","",$jsaldo);
		  	$kre5=$kre5-$jsaldo;
		  	echo"<td>&nbsp;</td>
		  		<td align=right>"; rupiah($ss); echo"</td>";
			}else
		 	{
		  	echo"<td>&nbsp;</td><td>&nbsp;</td>";
		 	}		 
		}
	echo"</tr>";
	$no++;
}
echo"<tr>
		<td>&nbsp;</td>
		<td align=right><strong>Jumlah</strong></td>
		<td align=right><strong>"; rupiah($deb); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre); echo"</strong></td>
		<td align=right><strong>"; rupiah($deb2); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre2); echo"</strong></td>
		<td align=right><strong>"; rupiah($deb3); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre3); echo"</strong></td>
		<td align=right><strong>"; rupiah($deb4); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre4); echo"</strong></td>
		<td align=right><strong>"; rupiah($deb5); echo"</strong></td>
		<td align=right><strong>"; rupiah($kre5); echo"</strong></td>
	</tr>";
	$jml1=$deb4-$kre4;
	$jml2=$deb5-$kre5;
echo"<tr>
		<td colspan=8>&nbsp;</td>";
		if($jml1<0)
		{
		 $hlr1=$deb4-$jml1;
		 $hlr2=$kre4;
		 $ss=str_replace("-","",$jml1); 
		 echo"<td align=right><strong>"; rupiah($ss); echo"</strong></td>
		 	<td>&nbsp;</td>";
		}else
		if($jml1>0)
		{
		 $hlr1=$deb4;
		 $hlr2=$kre4+$jml1;
		 $ss=str_replace("-","",$jml1);
		 echo"<td>&nbsp;</td>";
		 echo"<td align=right><strong>"; rupiah($ss); echo"</strong></td>";
		}
		if($jml2<0)
		{
		 $hn1=$deb5-$jml2;
		 $hn2=$kre5;
		 $ss2=str_replace("-","",$jml2);
		 echo"<td align=right><strong>"; rupiah($ss2); echo"</strong></td>
		 	<td>&nbsp;</td>";
		}else
		if($jml2>0)
		{
		 $hn1=$deb5;
		 $hn2=$kre5+$jml2;
		 $ss2=str_replace("-","",$jml2);
		 echo"<td>&nbsp;</td>";
		 echo"<td align=right><strong>"; rupiah($ss2); echo"</strong></td>";
		}
echo"	</tr>";

echo"<tr>
		<td colspan=8>&nbsp;</td>
		<td align=right><strong>"; 
		if($hlr1<0){
			$sss1=str_replace("-","",$hlr1);
			rupiah($sss1); }else
		{ rupiah($hlr1); } echo"</strong></td>
		<td align=right><strong>"; if($hlr2<0){
			$sss2=str_replace("-","",$hlr2);
			rupiah($sss2); }else
		{ rupiah($hlr2); } echo"</strong></td>
		<td align=right><strong>"; if($hn1<0){
			$sss3=str_replace("-","",$hn1);
			rupiah($sss3); }else
		{ rupiah($hn1); } echo"</strong></td>
		<td align=right><strong>"; if($hn2<0){
			$sss4=str_replace("-","",$hn2);
			rupiah($sss4); }else
		{ rupiah($hn2); } echo"</strong></td>
	</tr>";
?>
</table>
</td>
</tr>
</table>
</div>
							</td>
						</tr>
						<tr>
						</tr>
					</table>
					</div>
					</font>
					</td>
					<td width="15px">&nbsp;</td>
				</tr>
		</table>
	</tr>
	<tr>
		<td><img src="images/bawah_isi.png"/></td>
	</tr>
</table>
</body>

</html>