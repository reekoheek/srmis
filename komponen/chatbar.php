<br />
<form method="post" action="" onsubmit="return false;" name="chat_form" id="chat_form">
   <select name="chat_penerima_id" id="chat_penerima_id" class="inputan" style="width:150px;margin-bottom:5px;" onkeypress="focusNext( 'chat_pesan', event, 'chat_kirim', this)">
      <option value="">---Semua---</option>
      <?for($i=0;$i<sizeof($_chat_pengguna);$i++) :?>
         <option value="<?=$_chat_pengguna[$i][id]?>"><?=$_chat_pengguna[$i][nama]?></option>
      <?endfor;?>
   </select><br />
   <div id="chat_smilies" class="tangan"></div>
   <textarea cols="25" rows="5" class="inputan" name="chat_pesan" id="chat_pesan" style="margin-bottom:5px;" onkeypress="focusNext( 'chat_kirim', event, 'chat_penerima_id', this)"></textarea>
   <input type="submit" value="Kirim" name="chat_kirim" id="chat_kirim" class="inputan" onclick="xajax_chat_kirim_pesan_check(xajax.getFormValues('chat_form'));" />
</form>
<hr />
<div id="chat_list_pesan" style="overflow:scroll;width:170px;height:500px;"></div>