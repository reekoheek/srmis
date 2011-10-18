<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Akuntansi Rumah Sakit - Daftar Item Persediaan Obat dan BHP</title>
<link href="akt.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function hitppn() {
	var psnppn;
	var hasilppn;
	var harga;
	
	harga 		= document.getElementById("harganetapotek");
	psnppn 		= document.getElementById("ppn");
	hasilppn 	= document.getElementById("hasilppn");
	
	hasilppn.value = eval(harga.value) + eval((harga.value*psnppn.value)/100);
}

function hithj ()
{
	var hnet;
	var psn;
	var hasil;
	
	hnet 		= document.getElementById("hasilppn");
	psn 		= document.getElementById("prosenhargajual");
	hasil 		= document.getElementById("hargasatuan");	
	hasil.value = eval(hnet.value)+eval(hnet.value*psn.value/100);
}

function hitppn2 () {
	var psnppn;
	var hasilppn;
	var harga;
	
	harga 		= document.getElementById("harganetapotek2");
	psnppn 		= document.getElementById("ppn2");
	hasilppn 	= document.getElementById("hasilppn2");
	
	hasilppn.value = eval(harga.value) + eval((harga.value*psnppn.value)/100);
}

function hithj2 ()
{
	var hnet;
	var psn;
	var hasil;
	
	hnet 		= document.getElementById("hasilppn2");
	psn 		= document.getElementById("prosenhargajual2");
	hasil 		= document.getElementById("hargasatuan2");	
	hasil.value = eval(hnet.value)+eval(hnet.value*psn.value/100);
}

</script>
<link href="../SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="60" class="header">Akuntansi - Daftar Item Persediaan Obat Dan BHP</td>
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
    <td valign="top" class="content"><div id="keterangan">Sistim Akuntasi Rumah Sakit. Input Daftar Persediaan. Data persediaan dikelompokkan menurut Golongan. Klik disini : <a href="?var=baru"><img src="../images/add_icon.gif" width="16" height="16" border="0" align="absmiddle" />&nbsp;Persediaan Baru.&nbsp;</a> </div>
    <div class="fields" id="frame">
    <fieldset>
    <legend>Isi Data Baru</legend>
    
    <form id="form3" name="form3" method="POST" action="persediaan.php">
      <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF" class="tableisi">
        <tr>
          <td width="40%" align="right" class="row_alt2">Kode Obat</td>
          <td align="center"><input type="text" name="kodeobat" id="kodeobat" /></td>
        </tr>
        <tr>
          <td align="right" class="row_alt2">Nama Obat</td>
          <td align="center"><label>
            <input type="text" name="namaobat" id="namaobat" />
          </label></td>
        </tr>
        <tr>
          <td align="right" class="row_alt2">Golongan</td>
          <td align="center"><select name="kodegol" id="kodegol">
                        <option value="01">01 | Obat Generik</option>
                        <option value="02">02 | Obat Patent</option>
                        <option value="03">03 | Obat Narkoba</option>
                      </select>          </td>
        </tr>
        
        <tr>
          <td align="right" class="row_alt2">Satuan Terkecil</td>
          <td align="center"><label for="satuanterkecil"></label>
            <select name="satuanterkecil" id="satuanterkecil">
                            <option value="Ampul">Ampul</option>
                            <option value="Botol">Botol</option>
                            <option value="Kantong">Kantong</option>
                            <option value="Pieces">Pieces</option>
                          </select>            <label></label></td>
        </tr>
        <tr>
          <td align="right" class="row_alt2">Jml Stok Awal</td>
          <td align="center"><label>
            <input name="jumlahstokawal" type="text" id="jumlahstokawal" value="0" />
          </label></td>
        </tr>
        <tr>
          <td align="right" class="row_alt2">Harga  Beli</td>
          <td align="center"><label>
            <input type="text" name="hargapokokbeli" id="hargapokokbeli" />
          </label></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="row_alt2">HargaNet Apotek</td>
          <td align="center"><label>
            <input type="text" name="harganetapotek" id="harganetapotek" />
          </label></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="row_alt2">% PPn</td>
          <td align="center"><input name="ppn" type="text" id="ppn" onblur="hitppn();" value="10" />
            <input readonly="readonly" type="text" name="hasilppn" id="hasilppn" />            </td>
        </tr>
        <tr>
          <td align="right" valign="top" class="row_alt2">% Harga Jual</td>
          <td align="center"><label>
            <input name="prosenhargajual" type="text" id="prosenhargajual" onblur="hithj();" value="20" />
          </label></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="row_alt2">Harga Jual</td>
          <td align="center"><label>
            <input type="text" name="hargasatuan" id="hargasatuan" />
          </label></td>
        </tr>
        
        <tr>
          <td class="row_alt2"><input name="bln" type="hidden" id="bln" value="1" />
            <input name="thn" type="hidden" id="thn" value="2010" /></td>
          <td><span class="row_alt2">
            <input type="submit" name="button" id="button" value="Simpan" />
            <input type="button" name="button4" id="button" value="Batal" onclick="location.href='/simrs/akt/persediaan.php'" />
          </span></td>
        </tr>
      </table>
        <input type="hidden" name="MM_insert" value="form3" />
        <input name="newId" type="hidden" id="newId" value="33370" />
    </form>
    </fieldset>
    </div>
            <br/>
    <div id="Accordion1" class="Accordion" tabindex="0">
      <div class="AccordionPanel">
        <div class="AccordionPanelTab">Daftar Item Persediaan Obat dan BHP</div>
        <div class="CollapsiblePanelContent">
          <table border="0" cellpadding="3" cellspacing="1" width="99%">
            <tr class="tableisi">
              <td width="150" align="left" class="t_head" >Golongan</td>
              <td width="75" align="center" >Kode Obat</td>
              <td width="240" align="left" >Nama Obat</td>
              <td width="75" align="center" nowrap="nowrap" >Sat Terkecil</td>
              <td width="130" align="center" >Harga Beli</td>
              <td width="130" align="center" >HNA</td>
              <td width="130" align="center" >+ PPn (%)</td>
              <td width="130" align="center" >+ 20 (%)</td>
              <td width="130" align="center" >Harga Jual</td>
              <td width="50" align="center" >Edit</td>
              <td width="50" align="center" >Hapus</td>
            </tr>
          </table>
        </div>
            <div class="AccordionPanelContent">
            <table border="0" cellpadding="3" cellspacing="1" class="tableisi">
                                              <tr class="row_alt1" onmousemove="this.className='row_hover'" onmouseout="this.className='row_alt1'">
                  <td width="150" align="left">Obat Patent</td>
                  <td width="75" align="center">OP0002</td>
                  <td width="240" align="left">Gramedinin</td>
                  <td width="75" align="center" nowrap="nowrap">Botol</td>
                  <td width="130" align="right">10.000</td>
                  <td width="130" align="right">10.000</td>
                  <td width="130" align="right">11.000</td>
                  <td width="130" align="right">13.200</td>
                  <td width="130" align="right">13.200</td>
                  <form id="form1" name="form1" method="post" action="">
                    <td width="50" align="center"><input name="id_edit" type="hidden" id="id_edit" value="OP0002" />
                        <input name="imageField" type="image" id="imageField" src="../images/edit_icon.gif" align="middle" />                </td>
                  </form>
                  <form id="form2" name="form2" method="post" action="">
                    <td width="50" align="center"><input name="id_hapus" type="hidden" id="id_hapus" value="OP0002" />
                        <input name="imageField2" type="image" id="imageField2" src="../images/hapus.gif" align="middle" />                </td>
                  </form>
                </tr>
                                                                  <tr class="row_alt2" onmousemove="this.className='row_hover'" onmouseout="this.className='row_alt2'">
                  <td width="150" align="left">Obat Patent</td>
                  <td width="75" align="center">OP0001</td>
                  <td width="240" align="left">Ambisol</td>
                  <td width="75" align="center" nowrap="nowrap">Ampul</td>
                  <td width="130" align="right">5.600</td>
                  <td width="130" align="right">5.800</td>
                  <td width="130" align="right">6.380</td>
                  <td width="130" align="right">7.392</td>
                  <td width="130" align="right">7.660</td>
                  <form id="form1" name="form1" method="post" action="">
                    <td width="50" align="center"><input name="id_edit" type="hidden" id="id_edit" value="OP0001" />
                        <input name="imageField" type="image" id="imageField" src="../images/edit_icon.gif" align="middle" />                </td>
                  </form>
                  <form id="form2" name="form2" method="post" action="">
                    <td width="50" align="center"><input name="id_hapus" type="hidden" id="id_hapus" value="OP0001" />
                        <input name="imageField2" type="image" id="imageField2" src="../images/hapus.gif" align="middle" />                </td>
                  </form>
                </tr>
                                                  

              <tr class="t_foot">
              <td colspan="11" align="left" class="t_foot">Total Item Obat:&nbsp;2</td>
            </tr>
          </table>
        </div>
      </div>
      </div>
    <script type="text/javascript">
<!--
var Accordion1 = new Spry.Widget.Accordion("Accordion1");
//-->
  </script>
</body>
</html>
