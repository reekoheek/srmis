<?
Class Ref_Form {

	function clear_form($arr) {
		$objResponse = new xajaxResponse();
		for($i=0;$i<sizeof($arr);$i++) {
			$key = key($arr);
			$objResponse->addClear($key, "value");
			next($arr);
		}
		return $objResponse;
	}

}
$_xajax->registerFunction(array("ref_clear_form", "Ref_Form", "clear_form"));
?>