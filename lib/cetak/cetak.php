<?
Class Cetak {
	
	var $page_one = 10;
	var $page_other = 20;
	var $Th;
	var $extra_th;
	var $last_row = array();

	var $subTitle;
	var $contentBefore;

	var $layout = "portrait";
	var $Col;

	function __construct() {
		$this->getUtama();
	}

	function Cetak() {
		return $this->__construct();
	}

	function getUtama() {
		$this->setting = $_SESSION[setting];
	}

	function createContent($data) {
		$table = new Table;
		$table->scroll = false;
		$table->cellpadding = "2";
		$table->cellspacing = "0";
		$table->anime_bg_color = "";
		$table->Th = $this->Th;
		$table->extra_th = $this->extra_th;
		$table->jml_kolom = sizeof($this->Th);
		
		for($i=0;$i<sizeof($data);$i++) {
			for($j=0;$j<sizeof($data[$i]);$j++) {
				$table->Row[$i][$j] = $data[$i][$j];
			}
		}
		$content = $table->build();
		return $content;
	}

	function buildPage($content_utama, $content_before=false, $content_tanda_tangan = false, $ganti_halaman=true, $footer_content) {
		
		$content = $this->subTitle;
		if($content_before == true) {
			$content .= $this->contentBefore;
		}
		$content .= $content_utama;
		if($content_tanda_tangan == true) {
			$content .= $this->setTandaTangan();
		}

		$ret = "<div class=\"".$this->layout."_document\">";
		$ret .= $this->buildHeader();
		$ret .= $this->buildContent($content);
		$ret .= $this->buildFooter($footer_content);
		$ret .= "</div>";
		if($ganti_halaman == true)
			$ret .= "<hr style=\"page-break-before: always; width:1cm\" />";
		return $ret;
	}

	function build() {
		$val = func_get_args();
		$num = func_num_args();
		if(empty($val)) {
			$val = $this->Col;
			$num = sizeof($this->Col);
		}

		for($i=0;$i<$num;$i++) { //perulangan mendatar
			$data[$i] = $val[$i];
		}
		$arr_data_page_one = array();
		$arr_data_other_page = array();
		for($i=0;$i<sizeof($data);$i++) {
			$k = 0;
			for($j=0;$j<sizeof($data[$i]);$j++) {
				if($j<$this->page_one) {
					$arr_data_page_one[$j][$i] = $data[$i][$j];
				} else {
					$arr_data_other_page[$k][$i] = $data[$i][$j];
					$k++;
				}
			}
		}
		$arr_per_page = array_chunk($arr_data_other_page, $this->page_other);
		$other_page_total = sizeof($arr_per_page);

		if($other_page_total == 0) {
			//if only one page
			$arr_data = array_merge($arr_data_page_one, $this->last_row);
			//creating page one
			$content_page_one = $this->createContent($arr_data);
			$ret = $this->buildPage($content_page_one, true, true, false, "Halaman 1 dari " . ($other_page_total+1));
		} else {
			$content_page_one = $this->createContent($arr_data_page_one);
			$ret = $this->buildPage($content_page_one, true, false, true, "Halaman 1 dari " . ($other_page_total+1));
		}

		//creating page 2, ...
		for($i=0;$i<$other_page_total;$i++) {
			$footer_content = "Halaman " . ($i+2) . " dari " . ($other_page_total+1);
			if(($i+1) == $other_page_total) { //last page
				$gabungan = array_merge($arr_per_page[$i], $this->last_row);
				$content = $this->createContent($gabungan);
				$ret .= $this->buildPage($content, false, true, false, $footer_content);
			} else {
				$content = $this->createContent($arr_per_page[$i]);
				$ret .= $this->buildPage($content, false, false, true, $footer_content);
			}

		}
		//print_r($con);
		return $ret;
	}

	function buildHeader() {
		$ret = "<div class=\"header\"><img src=\"".IMAGES_URL."logo/".$this->setting[logo_kiri]."\" alt=\"Logo PKU\" style=\"height:70px;float:left;margin-top:0.2em;margin-left:0.5em\"><img src=\"".IMAGES_URL."logo/".$this->setting[logo_kanan]."\" alt=\"Logo PKU\" style=\"height:70px;float:right;margin-top:0.2em;margin-right:0.5em\"><h3>" . nl2br($this->setting[cetak_header]) . "</h3>" . $this->setting[rs_alamat] . " Telp. " . $this->setting[rs_telp] . 
		"</div>";
		return $ret;
	}

	function buildContent($content) {
		$ret = "<div class=\"".$this->layout."_content\">" . $content . "</div>";
		return $ret;
	}

	function buildFooter($content) {
		$ret = "
		<div class=\"footer\">
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"footer_content\">
				<tr>
					<td style=\"text-align:left;\">".$this->setting[cetak_footer]."</td>
					<td style=\"text-align:right;\">".$content."</td>
				</tr>
			</table>
		</div>";
		return $ret;
	}

	function addTh() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->Th[] = $ret;
	}

	function addThFromArray($arr = array()) {
		$this->Th[] = $arr;
	}
	function addExtraThFromArray($arr = array()) {
		$this->extra_th[] = $arr;
	}

	function addRowFromArray($arr = array()) {
		for($s=0;$s<sizeof($arr);$s++) {
			for($i=0;$i<sizeof($arr[$s]);$i++) {
				$new[$i][$s] = $arr[$s][$i];
			}
		}
		for($i=0;$i<sizeof($new);$i++) {
			$this->Col[] = $new[$i];
		}
	}

	function addLastRowFromArray($arr = array()) {
		$this->last_row[] = $arr;
	}

	function addExtraTh() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->extra_th[] = $ret;
	}

	function addLastRow() {
		$val = func_get_args();
		$num = func_num_args();
		for($i=0;$i<$num;$i++) {
			$ret[] = $val[$i];
		}
		$this->last_row[] = $ret;
	}

	function setSubTitle($title) {
		$this->subTitle = "<div class=\"subtitle\"><h4>".$title."</h4></div>";
	}

	function setContentBefore($content) {
		$this->contentBefore = "<div class=\"content_before\">" . $content . "</div>";
	}

	function setContentAfter($content) {
		$this->contentAfter = "<div class=\"content_after\">" . $content . "</div>";
	}

	function setTandaTangan() {
		$tanda_tangan = $this->setting[cetak_tanda_tangan];
		$arr = explode("{", $tanda_tangan);
		$arr2 = explode("}", $arr[1]);
		$tanggal = tanggalIndo(date("Ymd"), $arr2[0]);
		$ret = str_replace($arr2[0], "", $tanda_tangan);
		$return = str_replace("%", "", $ret);
		$return = str_replace("{}", $tanggal, $ret);
		$return = str_replace("%", "", $return);
		$return = "<div class=\"".$this->layout."_tanda_tangan\">".nl2br($return)."</div>";
		return $return;
	}
}
?>