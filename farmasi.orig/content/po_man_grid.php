<?php

/**
 * @author Richard
 * @copyright 2011
 */

?>
<form method="post" action="home.php?hal=action/generate_po" enctype="multipart/form-data" id="frmPOCreate" name="frmPOCreate">
<table border="0" cellpadding="3" cellspacing="3" width="100%">
<tr>
    <td>
        <table cellpadding='2' cellspacing='2' width='800px' style="border:1px  solid  #CCCCCC;">
		<tr bgcolor="#414141" align='center'>
			<th width ="70px"><font color="#FFFFFF" >Kode</font></th>
			<th><font color="#FFFFFF">Nama</font></th>
            <th width="50px"><font color="#FFFFFF">Req.Qty </th>
			<th width="80px"><font color="#FFFFFF">Satuan</font></th>
            <th width='50px'><font color="#FFFFFF" >PO Qty</font></th>
			<th width="90px"><font color="#FFFFFF">Harga</font></th>
			<th width='50px'><font color="#FFFFFF" >Disc(%)</font></th>
            <th width='100px'><font color="#FFFFFF" >Disc(Rp)</font></th>
            <th width='100px'><font color="#FFFFFF" >Sub Total </font></th>
        </tr>
       </table>
    </td>
	</tr>
    <tr>
    <td>
        <hr width="75%" size="3" />
        <hr width="50%" size="3" />
        <hr width="35%" size="3" />
    </td>                        
    </tr>                                             
    <tr>
        <td align="right" >
            <input type="submit" name="submitPP" value="Create PO" />
        </td>
    </tr>
 </table>
</form>