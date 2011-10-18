<?
Class Sekuriti {
	var $arr_tipe;
	var $arr_allowed = array("USER", "OPERATOR", "ADMINISTRATOR", "SUPER_ADMINISTRATOR"); 

	function Sekuriti($tipe) { //input = Sekuriti("USER | OPERATOR | ADMINISTRATOR");

		$arr = explode("|", $tipe);
		foreach($arr as $i => $tip) {
			$new_arr[] = trim($tip);
		}
		$this->arr_tipe = $new_arr;
	}

	function cek() {
		if(!in_array($_SESSION[ses_group_nick], $this->arr_tipe)) {
			return false;
		} else {
			return true;
		}
	}

	function forceCek($tipe) {
		if(!in_array($_SESSION[ses_group_nick], $this->arr_tipe)) {
			die("AKSES DITOLAK!");
		} else {
			return true;
		}
	}
}
?>