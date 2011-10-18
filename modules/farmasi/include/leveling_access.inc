<?php
class AccessMe
{
	var $menuID;
	var $userID;
	var $groupID;
	var $levelID;
	var $strSQL;
	var $dumpTest;
	
	private function main()
	{
	
	}

	public function __construct($userid)
	{
		$this->userID = $userid;
	}
	
	public function userid()
	{
		return $this->userID;
	}	
	
	private function __destruct()
	{
		$this->levelID = NULL;
		$this->menuID = NULL;
	}
	
	public static function getMenu()
	{
		$result  = array();
		$strSQL = mysql_query ("Select * from tbl_menu") ;
		while($resultMe = mysql_fetch_array($strSQL,MYSQL_BOTH))
		{
			array_push(&$result,$resultMe);
		}				
		return $result;
	}
	
	public static function getMe($levelingID)
	{
		$result = array();
		$strlSQL = mysql_query ("SELECT * FROM leveling_akses where id = " . $levelingID);
		while ($resultME = mysql_fetch_array($strSQL))
		{
			array_push(&$result,$resultME);
		}
		$dumptest = &$result;
		
		return $dumptest ;
	}
	
	function getGroup($userID)
	{
		$result = array();
		$strSQL = mysql_query("Select group_id from user where id = " . $userID);		
		$result = mysql_fetch_row($strSQL, MYSQL_BOTH);
		$strSQL = mysql_query ("Select id, lv_id from user_group where id = " . $result[0]) ;		
		while ($resultME = mysql_fetch_array($strSQL, MYSQL_BOTH))
		{
			$groupID = $resultME[0];
			$levelingID = $resultME[1];
		}

		array_push(&$result, getType($groupID));
		array_push(&$result, getMe($levelingID));

		$dumptest = &$test;

		return $dumptest;
	}
	
	public static function getType($groupID)
	{
		$result = NULL;
		$strSQL = mysql_query ("Select type_id from user_type where id = " . $groupID);
		$result = mysql_fetch_row($strSQL);
		$typeID  = $result ;		

		return $result;		
	}	
}
?>