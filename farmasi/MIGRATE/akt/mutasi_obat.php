
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Akuntansi Rumah Sakit - Mutasi BHP Dan Obat</title>
<link href="akt.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function nilai_akun(obyeknya,variabelnya) { //v1.0

}
//-->
</script>
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" class="header">Akuntansi - Daftar mutasi BHP dan Obat</td>
  </tr>
  <tr>
    <td height="15" class="nav">
	<ul class="cssMenu cssMenum">
	<li class=" cssMenui"><a href="../menuadm.php">Depan</a></li>
  <li class=" cssMenui"><a class="  cssMenui" href="#"><span>File</span>
    <![if gt IE 6]>
	  </a>
      <![endif]>
	  <!--[if lte IE 6]><table><tr><td><![endif]-->
      <ul class=" cssMenum">
	      <li class=" cssMenui"><a href="periode.php">Periode Awal Pembukuan</a></li>
		  <li class=" cssMenui"><a class="  cssMenui" href="#"><span>Buku Besar</span>
          <![if gt IE 6]>
		    </a>
	        <![endif]>
		    <!--[if lte IE 6]><table><tr><td><![endif]-->
		    <![if gt IE 6]>
		    <![endif]>
		    <!--[if lte IE 6]><table><tr><td><![endif]-->
		    <ul class=" cssMenum">
		      <li class=" cssMenui"><a href="akun.php" class="  cssMenui">Buat Rekening BB</a></li>
		      <li class=" cssMenui"><a href="dftrekening.php" target="_blank" class="  cssMenui">Cetak Daftar Rekening </a></li>
    
			<li class=" cssMenui"><a href="saldoawal_akun.php">Saldo Awal Akun</a></li>
	          <li class=" cssMenui"><a class="  cssMenui" href="bbpembantu.php">Rekening Buku Pembantu</a></li>
			  <li class=" cssMenui"><a class="  cssMenui" href="neraca_saldo.php">NERACA Saldo</a></li>
		      <li class=" cssMenui"><a class="  cssMenui" href="la_bkbesar.php">Laporan Buku Besar</a></li>
		      <li class=" cssMenui"><a class="  cssMenui" href="gol_bkbesar.php">Golongan Buku Besar</a></li>
	        </ul>
	    </li>
	    <li class=" cssMenui"><a class="  cssMenui"  href="#"><span>Buku Besar Pembantu</span></a>
	      <ul>
	        <li class=" cssMenui">
	          <!--[if lte IE 6]></td></tr></table></a><![endif]-->
              <a class="  cssMenui"  href="bk_hutang.php">BB. Pembantu Hutang</a></li>
            <li><a class="  cssMenui"  href="bk_piutang.php">BB. Pembantu Piutang</a></li>
	      </ul>
	    </li>
          
	    <li class=" cssMenui"><a class="  cssMenui" href="#"><span>Persediaan</span>
        <![if gt IE 6]>
	      </a>
          <![endif]>
	      <!--[if lte IE 6]><table><tr><td><![endif]-->
	      <ul class=" cssMenum">
	        <li class=" cssMenui"><a href="gudang.php">Gudang</a></li>
	        <li class=" cssMenui"><a href="gol_stok.php">Golongan Persediaan</a></li>
	        <li class=" cssMenui"><a href="satuan.php">Satuan Barang dan Obat</a></li>
	        <li class=" cssMenui"><a class="  cssMenui" href="persediaan.php">Daftar Persediaan</a></li>
	        <li class=" cssMenui"><a href="saldoawal_stok.php">Input Saldo Awal Persediaan</a></li>
	        <li class=" cssMenui"><a class="  cssMenui" href="mutasi_obat.php">Rekap Mutasi Barang</a></li>
	        <li class=" cssMenui"><a class="  cssMenui" href="kartu_stok.php">Kartu Stok</a></li>
          </ul>
	      <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
	    <li class=" cssMenui"><a class="  cssMenui" href="supplier.php">Supplier</a></li>
	    <li class=" cssMenui"><a href="settarif.php">Setting Tarif</a></li>
	    <li class=" cssMenui"><a class="  cssMenui" href="../logout.php">Log Out</a></li>
    </ul>
	  <!--[if lte IE 6]></td></tr></table></a><![endif]-->
  </li>
	<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Jurnal</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul class=" cssMenum">
		<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Jurnal Kas</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class=" cssMenum">
			<li class=" cssMenui"><a class="  cssMenui" href="jk_masuk.php">Penerimaan Kas Lainnya</a></li>
		  <li class=" cssMenui"><a class="  cssMenui" href="jk_keluar.php">Pengeluaran Kas Lainnya</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Jurnal Bank</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class=" cssMenum">
			<li class=" cssMenui"><a class="  cssMenui" href="ju_bankmasuk.php">Penerimaan Kas Bank</a></li>
		  <li class=" cssMenui"><a class="  cssMenui" href="ju_bankkeluar.php">Pengeluaran Kas Bank</a></li>
		</ul>

		<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
		<li class=" cssMenui"><a class="  cssMenui" href="ju.php">Jurnal Umum</a></li>
	  <li class=" cssMenui"><a class="  cssMenui" href="ju_kasir.php">Penerimaan Kasir</a></li>
	  <li class=" cssMenui"><a class="  cssMenui" href="#"><span>Pembelian Obat </span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class=" cssMenum">
			<li class=" cssMenui"><a class="  cssMenui" href="ju_pembelian.php">Lihat Pembelian Obat</a></li>
		</ul>

		<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Penjualan Obat</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
		<ul class=" cssMenum">
			<li class=" cssMenui"><a class="  cssMenui" href="ju_penjualan.php">Lihat Penjualan Obat</a></li>
		</ul>
		<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Kerusakan Barang</a></li>

		<li class=" cssMenui"><a class="  cssMenui" href="#">Opname Persediaan</a></li>
	</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
	<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Posting-Posting</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul class=" cssMenum">
		<li class=" cssMenui"><a class="  cssMenui" href="#">Penerimaan Kas</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Pengeluaran Kas</a></li>

		<li class=" cssMenui"><a class="  cssMenui" href="#">Penerimaan Kas Bank</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Pengeluaran Kas Bank</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Jurnal Umum</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Kerusakan Barang</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Opname Persediaan</a></li>
	</ul>

	<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
	<li class=" cssMenui"><a class="  cssMenui" href="#"><span>Laporan</span><![if gt IE 6]></a><![endif]><!--[if lte IE 6]><table><tr><td><![endif]-->
	<ul class=" cssMenum">
		<li class=" cssMenui"><a class="  cssMenui" href="#">N e r a c a</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">L a b a  R u g i</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Rekap Pembelian Total</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="#">Rekap Pembelian per SUPPLIER</a></li>

		<li class=" cssMenui"><a class="  cssMenui" href="#">Rekap Penjualan Obat</a></li>
		<li class=" cssMenui"><a class="  cssMenui" href="tutupbuku.php">Tutup Tahun Akuntansi</a></li>
	</ul>
	<!--[if lte IE 6]></td></tr></table></a><![endif]--></li>
</ul>
</td>
  </tr>
  <tr>
    <td valign="top" class="content"><div id="keterangan">Sistim Akuntasi Rumah Sakit. Pencatatan mutasi BHP maupun Obat.</div>
        <br/><div>&nbsp;<form id="form4" name="form4" method="post" action="">
      <table width="260" border="0" cellpadding="3" cellspacing="1" class="tableisi">
        <tr>
          <th colspan="2" nowrap="nowrap" scope="col">FILTER DATA MUTASI</th>
          </tr>
        <tr>
          <th nowrap="nowrap" scope="col">
              <label for="bulan"></label>
              <select name="bulan" id="bulan">
                <option value="1" >Januari</option>
                <option value="2" >Pebruari</option>
                <option value="3" >Maret</option>
                <option value="4" >April</option>
                <option value="5" >Mei</option>
                <option value="6" >Juni</option>
                <option value="7" >Juli</option>
                <option value="8" >Agustus</option>
                <option value="9" >September</option>
                <option value="10" >Oktober</option>
                <option value="11" >Nopember</option>
                <option value="12" >Desember</option>
              </select>
              <label for="tahun"></label>
              <label for="button2"></label></th>
          <th nowrap="nowrap" scope="col"><input name="tahun" type="text" id="tahun" value="" size="10" maxlength="4" /></th>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" name="button5" id="button2" value="Filter" /></td>
          </tr>
      </table>
    </form>
    </div><br/>
    <div id="Accordion1" class="Accordion" tabindex="0">
    <div class="AccordionPanel">
      <div class="AccordionPanelTab">Daftar Mutasi Obat</div>
        <div class="CollapsiblePanelContent">          <table width="99%" border="0" cellpadding="3" cellspacing="1" class="tableisi">
            <tr>
              <td align="center"><a href="?var=baru">Isi Baru&nbsp;<img class="icon" src="../images/add_icon.gif" alt="New" width="16" height="16" align="absmiddle" /></a></td>
              <td colspan="9" align="center"><table width="400" border="0" cellspacing="1" cellpadding="3">
                  <tr class="sidebar">
                    <td align="center"><a href="/simrs/akt/mutasi_obat.php?pageNum_rsMts=0&totalRows_rsMts=1">Awal</a></td>
                    <td align="center"><a href="/simrs/akt/mutasi_obat.php?pageNum_rsMts=0&totalRows_rsMts=1">Sebelumnya</a></td>
                    <td align="center">Hal:&nbsp;1 / 1</td>
                    <td align="center"><a href="/simrs/akt/mutasi_obat.php?pageNum_rsMts=0&totalRows_rsMts=1">Selanjutnya</a></td>
                    <td align="center"><a href="/simrs/akt/mutasi_obat.php?pageNum_rsMts=0&totalRows_rsMts=1">Akhir</a></td>
                  </tr>
              </table></td>
              </tr>
            <tr>
              <td width="100" align="center" class="t_head">No Mutasi</td>
              <td width="90" align="left" class="t_head">Tanggal</td>
              <td width="200" align="left" class="t_head">Obat/BHP</td>
              <td width="60" align="center" class="t_head">Satuan</td>
              <td width="80" align="right" class="t_head">Jumlah</td>
              <td width="130" align="center" class="t_head">Dari Gdng</td>
              <td width="130" align="center" class="t_head">Tujuan</td>
              <td align="left" nowrap="nowrap" class="t_head">Keterangan</td>
              <td width="50" align="center" class="t_head">Edit</td>
              <td width="50" align="center" class="t_head">Hapus</td>
            </tr></table>
</div>
        <div class="AccordionPanelContent">
          <table width="100%" border="0" cellpadding="3" cellspacing="1" class="tableisi">
            
            <tr>
              <td width="100" align="center" class="t_head"></td>
              <td width="90" align="left" class="t_head"></td>
              <td width="200" align="left" class="t_head"></td>
              <td width="60" align="center" class="t_head"></td>
              <td width="80" align="right" class="t_head"></td>
              <td width="130" align="center" class="t_head"></td>
              <td width="130" align="center" class="t_head"></td>
              <td align="left" nowrap="nowrap" class="t_head"></td>
              <td width="50" align="center" class="t_head"></td>
              <td width="50" align="center" class="t_head"></td>
            </tr>
                                      <tr class="row_alt1" onmousemove="this.className='row_hover'" onmouseout="this.className='row_alt1'">
                  <td align="center" nowrap="nowrap">10</td>
                <td align="left" nowrap="nowrap">02-Jan-10</td>
                <td align="left" nowrap="nowrap">OP0001 | Ambisol</td>
                <td align="center" nowrap="nowrap">Ampul</td>
                <td align="right" nowrap="nowrap">10</td>
                <td align="left" nowrap="nowrap">INSTALASI FARMASI</td>
                <td align="left" nowrap="nowrap">IGD</td>
                <td align="left" nowrap="nowrap">tes</td>
                <form id="form1" name="form1" method="post" action="">
                  <td align="center"><input name="id_edit" type="hidden" id="id_edit" value="10" />
                    <input name="imageField" type="image" id="imageField" src="../images/edit_icon.gif" align="middle" />                </td>
                </form>
                <form id="form2" name="form2" method="post" action="">
                  <td align="center"><input name="id_hapus" type="hidden" id="id_hapus" value="10" />
                    <input name="imageField2" type="image" id="imageField2" src="../images/hapus.gif" align="middle" />                </td>
                </form>
              </tr>
                                      </table>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td class="footer">&nbsp;</td>
  </tr>
</table>
<script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
</script>
</body>
</html>
