<?php
/************************************************************************
MyPagina ver. 1.01
Use this class to handle MySQL record sets and get page navigation links 

Copyright (C) 2005 - Olaf Lederer

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

_________________________________________________________________________
available at http://www.finalwebsites.com/
Comments & suggestions: http://www.finalwebsites.com/contact.php

Updates & bugfixes

ver. 1.01 - There was a small bug inside the page_info() method while showing
the last page (set). The error (last record) is fixed. There is also a small 
update in the method set_page(), the check is now with $_REQUEST values in 
place of $_GET values.

*************************************************************************/
//require($_SERVER['DOCUMENT_ROOT']."/classes/my_pagina/db_config.php");
//error_reporting(E_ALL); // only for testing
// modify these constants to fit your environment

// some external constants to controle the output
define("QS_VAR", "hal"); // the variable name inside the query string (don't use this name inside other links)
//define("NUM_ROWS", 10); // the number of records on each page
define("STR_FWD", "[next]"); // the string is used for a link (step forward)
define("STR_BWD", "[back]"); // the string is used for a link (step backward)
define("NUM_LINKS", 5); // the number of links inside the navigation (the default value)

class MyPagina extends Konek {
	
	var $sql;
	var $result;
	
	var $get_var = QS_VAR;
	var $rows_on_page = 10;
	var $str_forward = STR_FWD;
	var $str_backward = STR_BWD;
	var $str_start = "[start]";
	var $str_last = "[last]";
	
	var $all_rows;
	var $num_rows;
	
	var $page;
	var $number_pages;
	
	//var $onclick1_func = "show_loading";
	var $onclick_func = "xajax_list_data";
	var $onclick2_func = "xajax_list_data";
	//var $onclick1_value;
	var $onclick2_value;
	var $onclick_value;

	var $anchor = "#list_data";

	var $hal = 0;
	
	// constructor
	function MyPagina() {
		parent::__construct();
	}
	/*
	function onclick1($val = "") {
		$func = $this->onclick1_func;
		$ret = $func . "(" . $this->onclick1_value . ")";
		//echo $ret;
		return $ret;
	}
	*/

	function onclick2($val = "") {
		$func = $this->onclick2_func;
		if(!$this->onclick2_value) {
			$ret = $func . "(" . $val . ")";
		} else {
			$ret = $func . "(" . $val . "," . $this->onclick2_value .")";
		}
		//echo $ret;
		return $ret;
	}

	function setOnclickValue() {
		$val = func_get_args();
		$this->onclick_value = $val;
	}

	function onclick($val = "") {
		$func = $this->onclick_func;
		if(!$this->onclick_value) {
			$ret = $func . "(" . $val . ")";
		} else {
			$ov = $this->onclick_value;
			for($i=0;$i<sizeof($ov);$i++) {
				if($ov[$i] == "" || !$ov[$i]) $ov[$i] = "''";
			}
			$s = implode(",", $ov);
			//$str = "'" . $s . "'";
			$ret = $func . "(" . $val . ", " . $s .")";
		}
		//echo $ret;
		return $ret;
	}

	// sets the current page number
	function set_page() {
		$page = (isset($_REQUEST[$this->get_var]) && $_REQUEST[$this->get_var] != "") ? $_REQUEST[$this->get_var] : 0;
		if($this->hal) {
			//echo "asdf";
			$this->page = $this->hal;
		} else {
			$this->page = $page;
		}
		//echo $this->page;
		return $this->page;
	}
	// gets the total number of records 
	function get_total_rows() {
		//tantos hack
		//penyimpanan jumlah baris ini digunakan untuk speed up, karena tidak menjalankan perintah mysql_query dan mysql_num_rows pada halaman 1 dst
		if($this->hal > 0) {
			$this->all_rows = $_SESSION[$this->onclick_func]['all_rows'];
		} else {
			$tmp_result = $this->query($this->sql);
			$this->all_rows = $tmp_result->num_rows;
			//$tmp_result->free();
			$_SESSION[$this->onclick_func]['all_rows'] = $this->all_rows;
		}
		return $this->all_rows;
	}
	// get the totale number of result pages
	function get_num_pages() {
		$this->number_pages = ceil($this->all_rows / $this->rows_on_page);
		return $this->number_pages;
	}

	// returns the records for the current page
	function get_page_result() {
		$this->set_page();
		$this->get_total_rows();
		$start = $this->page * $this->rows_on_page;
		$page_sql = sprintf("%s LIMIT %s, %s", $this->sql, $start, $this->rows_on_page);
		$this->result = $this->execute($page_sql);
		$this->data = $this->getAll();
		//$this->result->free();
		return $this->result;
	}

	//tantos start
	/*
	function getAll($hasil) {
		while($baris = $hasil->fetch_assoc()) {
			$test[] = $baris;
		}
		return $test;
	}
	*/
	//tantos end

	// get the number of rows on the current page
	function get_page_num_rows() {
		$hasil = $this->result;
		$num_rows = $hasil->num_rows;
		return $num_rows;
	}

	// function to handle other querystring than the page variable
	function rebuild_qs($curr_var) {
		if (!empty($_SERVER['QUERY_STRING'])) {
			$parts = explode("&", $_SERVER['QUERY_STRING']);
			$newParts = array();
			foreach ($parts as $val) {
				if (stristr($val, $curr_var) == false)  {
					array_push($newParts, $val);
				}
			}
			if (count($newParts) != 0) {
				$qs = "&".implode("&", $newParts);
			} else {
				return false;
			}
			return $qs; // this is your new created query string
		} else {
			return false;
		}
	} 
	// this method will return the navigation links for the conplete recordset
	function navigation($separator = " | ", $css_current = "", $back_forward = false) {
		$max_links = NUM_LINKS;
		$curr_pages = $this->page; 
		$all_pages = $this->get_num_pages() - 1;
		$var = $this->get_var;
		$navi_string = "";
		if (!$back_forward) {
			$max_links = ($max_links < 2) ? 2 : $max_links;
		}
		if ($curr_pages <= $all_pages && $curr_pages >= 0) {
			if ($curr_pages > ceil($max_links/2)) {
				$start = ($curr_pages - ceil($max_links/2) > 0) ? $curr_pages - ceil($max_links/2) : 1;
				$end = $curr_pages + ceil($max_links/2);
				if ($end >= $all_pages) {
					$end = $all_pages + 1;
					$start = ($all_pages - ($max_links - 1) > 0) ? $all_pages  - ($max_links - 1) : 1;
				}
			} else {
				$start = 0;
				$end = ($all_pages >= $max_links) ? $max_links : $all_pages + 1;
			}
			//xajax_list_data('".$backward.$this->rebuild_qs($var)."')
			if($all_pages >= 1) {
				$forward = $curr_pages + 1;
				$backward = $curr_pages - 1;
				$navi_string = ($curr_pages > 0) ? "<a href=\"javascript:void(0)\" title=\"start\" onclick=\"".$this->onclick('0')."\">".$this->str_start."</a>&nbsp;<a href=\"javascript:void(0)\" onclick=\"".$this->onclick("'".$backward.$this->rebuild_qs($var)."'").";\" title=\"back\">".$this->str_backward."</a>&nbsp;" : $this->str_start . "&nbsp;" . $this->str_backward."&nbsp;";
				if (!$back_forward) {
					for($a = $start + 1; $a <= $end; $a++){
						$theNext = $a - 1; // because a array start with 0
						if ($theNext != $curr_pages) {
							$navi_string .= "<a href=\"javascript:void(0)\" onclick=\"".$this->onclick("'".$theNext.$this->rebuild_qs($var)."'").";\" title=\"Halaman ".$theNext.$this->rebuild_qs($var)."\">";
							$navi_string .= $a."</a>";
							$navi_string .= ($theNext < ($end - 1)) ? $separator : "";
						} else {
							$navi_string .= ($css_current != "") ? "<span class=\"".$css_current."\">".$a."</span>" : $a;
							$navi_string .= ($theNext < ($end - 1)) ? $separator : "";
						}
					}
				}
				$navi_string .= ($curr_pages < $all_pages) ? "&nbsp;<a href=\"javascript:void(0)\" onclick=\"".$this->onclick("'".$forward.$this->rebuild_qs($var)."'").";\" title=\"".$forward.$this->rebuild_qs($var)."\">".$this->str_forward."</a>&nbsp;<a href=\"javascript:void(0)\" onclick=\"".$this->onclick($this->number_pages-1)."\" title=\"End\" >".$this->str_last."</a>" : "&nbsp;".$this->str_forward . "&nbsp;" . $this->str_last;
			}
		} elseif($all_pages == 0 && $curr_pages > 0) {
			$navi_string = "<a href=\"javascript:void(0)\" onclick=\"".$this->onclick("'".$backward.$this->rebuild_qs($var)."'").";\">".$this->str_backward."</a>&nbsp;";
		}
		return $navi_string;
	}
	// this info will tell the visitor which number of records are shown on the current page
	function page_info($to = "-") {
		$first_rec_no = $this->start_number();
		$last_rec_no = $first_rec_no + $this->rows_on_page - 1;
		$last_rec_no = ($last_rec_no > $this->all_rows) ? $this->all_rows : $last_rec_no;
		$to = trim($to);
		$info = "Data " . $first_rec_no." ".$to." ".$last_rec_no . " [" . $this->all_rows . " data, " . $this->get_num_pages() . " Halaman]";
		return $info;
	}

	// simple method to show only the page back and forward link.
	function back_forward_link() {
		$simple_links = $this->navigation(" ", "", true);
		return $simple_links;
	}

	function start_number() {
		$mulai = ($this->page * $this->rows_on_page) + 1;
		return $mulai;
	}

	function navi() {
		$nav_info = $this->page_info();
		$nav_links = $this->navigation("&nbsp;&nbsp;", "merah");
		$navi = $nav_info . "<br />" . $nav_links;
		return $navi;
	}

	function ket_hal_ini() {
		$ret = "Halaman " . ($this->page+1) . " dari " . $this->get_num_pages();
		return $ret;
	}

	function is_last_page() {
		if($this->page+1 == $this->get_num_pages())
			return true;
		else return false;
	}
}
?>