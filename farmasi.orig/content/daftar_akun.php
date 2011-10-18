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

<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td>
		<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td width="8px">&nbsp;</td>
				<td width="300px" bgcolor="#9b9999">&nbsp;&nbsp;<b><font color="#fefafa">Daftar Rekening </font></b></td>
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
					<td width="15px">&nbsp;</td>
					<td valign="top">
					<font style="font-size:12px;">
					<table border="0" cellpadding="2" cellspacing="2" width="100%">
						<tr>
							<td align="center">
							<form id="form1" name="form1" method="post" action="home.php?hal=action/insert_rek">
  <table width="493" border="0">
    <tr>
      <td width="192">No. Rek </td>
      <td width="291"><label>
        <input name="no_rek" type="text" id="no_rek" size="10" maxlength="5" />
      </label></td>
    </tr>
    <tr>
      <td>Nama Rekening </td>
      <td><label>
        <input name="nama_rek" type="text" id="nama_rek" />
      </label></td>
    </tr>
    <tr>
      <td>Kategori</td>
      <td><label>
        <select name="kategori" id="kategori">
          <option value="1">1 - Aktiva</option>
          <option value="2">2 - Kewajiban</option>
          <option value="3">3 - Modal</option>
          <option value="4">4 - Pendapatan</option>
          <option value="5">5 - Beban</option>
        </select>
      </label></td>
    </tr>
	<tr>
      <td>Saldo Awal </td>
      <td><label>
        <input name="saldo_awal" type="text" id="nama_rek" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input name="Simpan" type="submit" id="Simpan" value="Simpan" />
        <input name="Batal" type="reset" id="Batal" value="Batal" />
      </label></td>
    </tr>
  </table>
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
							
								$query1=mysql_query("select * from daftar_akun order by no_rek asc LIMIT $offset, $rowsPerPage");
								echo '<table border=0 cellpadding=2 cellspacing=2 width=100%>
									<tr bgcolor=#414141 align=center>
										<td><font color=#FFFFFF>No. Rek</font></td>
										<td ><font color=#FFFFFF>Nama Rekening</font></td>
										<td ><font color=#FFFFFF>Kategori</font></td>
										<td ><font color=#FFFFFF>Saldo Awal</font></td>
										<td ><font color=#FFFFFF>Action</font></td>
									</tr>';
									$no = 1;
									while ($result1 = mysql_fetch_array($query1))
									
									{
									if (!empty($result1['no_rek']))
									{
										if ($no%2)
										{
											echo "<tr valign=top>";
										}
										else
										{
											echo "<tr bgcolor=#CCCCCC valign=top style=font-color:#FF0000>";
										}
									echo "<td align=center width=80px>$result1[no_rek]</td>
											<td align=left width=200px>$result1[nama_rek]</td>";
										if($result1["kategori"]==1)
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
										}
										echo"<td align=center width=100px>$kat</td>";
										echo"<td align=right width=80px>"; rupiah(abs($result1[saldo_awal])); echo"</td>";
										echo"<td align=center width=70px><a href='home.php?hal=content/edit_daftar_rekening&no_rek=$result1[no_rek]'>EDIT</a> | 
										<a href='home.php?hal=action/hapus_daftar_rekening&no_rek=$result1[no_rek]'>HAPUS</a></td>";
										echo"</tr>";
										$no++;
									}
								}
									echo"</table>";
									
									echo '<div align=center><br>';

									$query   = "SELECT COUNT(id) AS numrows FROM daftar_akun order by no_rek asc ";
									$result  = mysql_query($query) or die('Error, query failed');
									$row     = mysql_fetch_array($result, MYSQL_ASSOC);
									$numrows = $row['numrows'];

									$maxPage = ceil($numrows/$rowsPerPage);

									$self = $_SERVER['PHP_SELF'];

									if ($pageNum > 1)
									{
   										$page = $pageNum - 1;
   								   	 	$prev = " <a href=\"$self?page=$page&hal=content/daftar_akun\"><font color='#565957' size=-1>[&laquo;]</font></a> ";

    									$first = " <a href=\"$self?page=1&hal=content/daftar_akun\"><font color='#565957' size=-1>[&laquo;&laquo;]</font></a> ";
									}
									else
									{
   			 							$prev  = ' [&laquo;] ';
										$first = ' [&laquo;&laquo;] ';
									}

									if ($pageNum < $maxPage)
									{
    									$page = $pageNum + 1;
    									$next = " <a href=\"$self?page=$page&hal=content/daftar_akun\"><font color='#565957' size=-1>[&raquo;]</font></a> ";

    									$last = " <a href=\"$self?page=$maxPage&hal=content/daftar_akun\"><font color='#565957' size=-1>[&raquo;&raquo;]</font></a> ";
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