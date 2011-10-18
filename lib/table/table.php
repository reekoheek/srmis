<?
Class Table {

	var $jml_kolom;
	var $cellpadding="0";
	var $cellspacing="2";
	var $extra_table = "";
	var $border="0";
	var $css_table = "list";
	var $css_td = "";
	var $extra_td;
	var $extra_tr = "";
	var $anime_bg_color = " onmouseover=\"setBgColor(this, '#FFCC66')\" onmouseout=\"setBgColor(this, '');\" ";
	var $onclick_td;
	var $onclick_tr;
	var $index;
	var $extra_tr_th = "style=\"background-color:#CCCCCC;\"";
	var $tbody_height = 400;
	var $scroll = true;

	function __construct() {
		
	}

	function Table() {
		return $this->__construct();
	}

	function addTh() {
		$val = func_get_args();
		$num = func_num_args();
		$this->jml_kolom = $num;
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->Th[] = $ret;
	}

	function addExtraTh() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->extra_th[] = $ret;
	}

	function addRow() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->Row[] = $ret;
	}

	function addExtraTr($val = NULL) {
		//$a = " onmouseover=\"setBgColor(this, '#FFCC66')\" onmouseout=\"setBgColor(this, '#000000');\" ";
		$ret = $a . $val;
		$this->extra_tr[] = $ret;
	}

	function addTfoot() {
		$val = func_get_args();
		$num = func_num_args();
		$this->jml_kolom = $num;
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->Tfoot[] = $ret;
	}

	function addExtraTfoot() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->extra_tfoot[] = $ret;
	}

	function addExtraTd() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->extra_td[] = $ret;
	}

	function addOnclickTd() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->onclick_td[] = $ret;
	}

	function buildTh() {
		if(!empty($this->Th)) {
			$ret = "<thead>\n";
			for($i=0;$i<sizeof($this->Th);$i++) {
				$ret .= "<tr ".$this->extra_tr_th.">\n";
					for($j=0;$j<sizeof($this->Th[$i]);$j++) {
						$ret .= "<th ".$this->extra_th[$i][$j].">".$this->Th[$i][$j]."</th>\n";
					}
				$ret .= "</tr>\n";
			}
			$ret .= "</thead>\n";
		} else {
			$ret = "";
		}
		return $ret;
	}

	function buildRow() {
		if($this->scroll) {
			$scroll = "class=\"skroll\" style=\"height:".$this->tbody_height."px;\"";
		} else $scroll = "";
		$ret = "<tbody ".$scroll.">\n";
		if(sizeof($this->Row) == 0) {
			$ret .= "<tr>\n";
			$ret .= "<td colspan=\"".$this->jml_kolom."\" style=\"text-align:center;font-style:italic;\">No Data To Display</td>\n";
			$ret .= "</tr>\n";
		} else {
			for($i=0;$i<sizeof($this->Row);$i++) {
				$ret .= "<tr ".$this->anime_bg_color." " . $this->extra_tr[$i] . ">\n";
					for($x=0;$x<sizeof($this->Row[$i]);$x++) {
						if(!empty($this->extra_td)) $extra = $this->extra_td[$i][$x];
						if(!empty($this->onclick_td)) $onclick = $this->onclick_td[$i][$x];
						$ret .= "<td " . $extra . " onclick=\"" . $onclick . "\">".$this->Row[$i][$x]."</td>\n";
					}
				$ret .= "</tr>\n";
			}
		}
		$ret .= "</tbody>\n";
		return $ret;
	}

	function buildTfoot() {
		if(!empty($this->Tfoot)) {
			$ret = "<tfoot>\n";
			for($i=0;$i<sizeof($this->Tfoot);$i++) {
				$ret .= "<tr ".$this->extra_tr_tfoot.">\n";
					for($j=0;$j<sizeof($this->Tfoot[$i]);$j++) {
						$ret .= "<td ".$this->extra_tfoot[$i][$j].">".$this->Tfoot[$i][$j]."</td>\n";
					}
				$ret .= "</tr>\n";
			}
			$ret .= "</tfoot>\n";
		} else {
			$ret = "";
		}
		return $ret;
	}

	function build() {
		$ret = "<table cellpadding=\"".$this->cellpadding."\" cellspacing=\"".$this->cellspacing."\" border=\"".$this->border."\" class=\"".$this->css_table."\" ".$this->extra_table.">\n";
		$ret .= $this->buildTh();
		$ret .= $this->buildRow();
		$ret .= $this->buildTfoot();
		$ret .= "</table>\n";
		return $ret;
	}
}
?>