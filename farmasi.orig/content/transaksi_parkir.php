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
			$.post("action/string_daftar_bpb.php", {mysearchString: ""+inputString+""}, function(data){
				if(data.length >0) {
					$('#suggestions').show();
					$('#autoSuggestionsList').html(data);
				}
			});
		}
	} //end
	
	// if user clicks a suggestion, fill the text box.
	function fill(thisValue) {
		$('#inputString').val(thisValue);
		setTimeout("$('#suggestions').hide();", 200);
	}
</script>

<!-- end suggestion-->



</head>
<body>
<?
$tagl = date("d-m-Y");
$month = date("m");
$qp= mysql_query("SELECT * FROM parkir WHERE LAST_INSERT_ID(param_no) ORDER BY id DESC LIMIT 1");
$rp = mysql_fetch_array($qp);

$tgl = substr($rp['tgl'],5,2);
if ($tgl == $month)
{
	$temp = $rp['param_no'];
	$count = $temp + 1;
}
else
{
	$temp = 1;
	$count = $temp;
}

$digit1 = (int) ($count % 10);
$digit2 = (int) (($count % 100) / 10);
$digit3 = (int) (($count % 1000) / 100);
$digit4 = (int) (($count % 10000) / 1000);
$no_trans = "TRP/" . date("dmy"). "$digit4" . "$digit3" . "$digit2" . "$digit1";
$param_no = $count;
?>


<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Transaksi Parkir</font></b></td>
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
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr>
						<td align=left><font size="-1">&nbsp;</font></td>
						<td align="right"><font size="-1">
							<a href="home.php?hal=content/kasir_tes">[ Menu Kasir ]</a> &nbsp;</font>
						</td>
					</tr>
			
				<tr>
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="center">
							<form method="post" action="home.php?hal=action/insert_transaksi_parkir">
<table border="0" width="">
<tr>
	<td>No. Transaksi Parkir</td>
	<td><input type="text" name="nomor_trans" value="<?=$no_trans?>"  readonly="true" style="background-color:#CCCFFF; "/></td>
</tr>
<tr>
	<td>Tanggal</td>
	<td><input type="text" name="tanggal" readonly="true" value="<?=$tagl?>" style="background-color:#CCCFFF; "/></td>
</tr>
<tr>
	<td>Jumlah Motor</td>
	<td><input type="text" size="5" name="motor" ></td>
</tr>
<tr>
	<td>Jumlah Mobil</td>
	<td><input type="text" size="5" name="mobil" ></td>
</tr>
<tr>
	<td>Total Harga</td>
	<td><input type="text" size="20" name="total"></td>
</tr>
<tr>
	<td></td>
	<td><input type="submit" name="simpan" value="Simpan" />&nbsp;&nbsp;<input type="reset" name="Batal" value="Batal" />
	<input type="hidden" name="param_no" value="<?=$param_no?>">
	</td>
</tr>
</table>
<hr />
</form>
							</td>
						</tr>
						<tr>
							<td align="center">
							<?php
							
								$rowsPerPage = 20;


							$pageNum = 1;

							if(isset($_GET['page']))
							{
    							$pageNum = $_GET['page'];
							}

							$offset = ($pageNum - 1) * $rowsPerPage;
							
								$query1=mysql_query("select * from parkir order by no_trans asc LIMIT $offset, $rowsPerPage");
								echo "<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF width=30px>No. </font></td>
										<td><font color=#FFFFFF width=80px>No. Transaksi</font></td>
										<td ><font color=#FFFFFF width=80px>Tanggal</font></td>
										<td ><font color=#FFFFFF width=50px>Jumlah Mobil</font></td>
										<td ><font color=#FFFFFF width=50px>Jumlah Motor</font></td>
										<td ><font color=#FFFFFF width=120px>Total</font></td>
										<td ><font color=#FFFFFF width=100px>Action</font></td>
									</tr>";
									$no = 1;
									while ($result1 = mysql_fetch_array($query1))
									
									{
									if (!empty($result1['no_trans']))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
										echo "<td align=right width=80px>$result1[id]</td>";
									echo "<td align=center >$result1[no_trans]</td>";
									$dd=substr($result1['tgl'],8,2);
									$mm=substr($result1['tgl'],5,2);
									$yy=substr($result1['tgl'],0,4);
									$tanggalstring=$dd."-".$mm."-".$yy;
									echo"<td align=center >$tanggalstring</td>";
										/* if($result1["kategori"]==1)
										{
										 $kat="Aktiva";
										}else if($result1["kategori"]==2)
										{
										 $kat="Kewajiban";
										}else if($result1["kategori"]==3)
										{
										 $kat="Modal";
										}else if($result1["kategori"]==4)
										{
										 $kat="Pendapatan";
										}else if($result1["kategori"]==5)
										{
										 $kat="Beban";
										} */
										echo"<td align=center >$result1[motor]</td>";
										echo"<td align=center >$result1[mobil]</td>";
										echo"<td align=right >"; rupiah($result1[total]); echo"</td>";
										echo"<td align=center ><a href='javascript:void(0);' onClick=\"PopupCenter('content/edit_transaksi_parkir.php?no_trans=$result1[no_trans]','myPop1',400,200);\">EDIT</a></td>";
										echo"</tr>";
										$no++;
									}
								}
									echo"</table>";
									
									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM parkir order by no_trans asc ";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/transaksi_parkir\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/transaksi_parkir\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/transaksi_parkir\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/transaksi_parkir\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
									}
									else
									{
   										$next = ' [&raquo;] ';
    									$last = ' [&raquo;&raquo;] ';
									}

										echo $first . $prev . "Halaman <strong>$pageNum</strong> dari <strong>$maxPage</strong> " . $next . $last;
									echo '</div>';
							?>
							</td>
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
		<td><img src="images/bawah_isi.png"></td>
	</tr>
</table>
</body>

</html>