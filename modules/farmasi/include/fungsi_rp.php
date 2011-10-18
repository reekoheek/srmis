<?php
//define ("STRNO", "");
$STRNO = "";
function rupiah($bilangan)
{
	$pecahan=number_format($bilangan,0,',','.');
	echo"Rp. $pecahan";
	return $pecahan;
}

function bilangan($bilangan)
{
	$pecahan=number_format($bilangan,0,',','.');
	echo"$pecahan";
	return $pecahan;
}

function getLoginStatus(){
    $user = $_SESSION['U_USER'];
    if ((empty($user)) || ($user='') ){
      echo "<meta http-equiv='refresh' content='0;url=home.php'>";        
    }
    else{
        $ret= $user;
        $userLoged = $user;
    }
    return ($ret);
}

function registerConstant($consName, $consValue){
    define($consName, $consValue);
}
function getConstant($consName){
    return ($consName);
}
function getSingleData($strSQL){
    print ($strSQL);
    $restMe = mysql_query($strSQL);
    $rest = mysql_fetch_row($restMe);
    if (!($restMe)) { mysql_freeresult($restMe); }
    return ($rest[0]);
}
function execSQL($strSQL){
    $restMe = mysql_query($strSQL) or die (("Failed!! <br /> Please contact PT. Priatman <br />") . mysql_error());
    return(true);
    //mysql_free_result($restMe);
}
function getRallyNo($iNO, $items){
    $rallyPO = trim($iNO);
    for($i=0;$i<=$items;$i++){
        $basePONO = substr($rallyPO,0,-4);
        $baseCount = substr($rallyPO,-4);        
        $baseCountZero = (int)$baseCount;
        $differs =strlen(trim($baseCount)) - strlen($baseCountZero);
        $zeroMarch="";
        for ($s=1;$s<=($differs);$s++){
            $zeroMarch .="0";
        }        
        $baseCountZero += 1;
        $nextPONO= $basePONO.$zeroMarch.$baseCountZero ;
        $rallyPO = trim($nextPONO) ;
//        print $nextPONO . "<br />";
    }  
}
function getNo($type){
    $strSQL = "SELECT full_no from mr where type = '$type'";
    $ret = getSingleData($strSQL);
    return ($ret);
}
function reserveNo($type){
    //getNO($type);
    $ret = getNextNo($type);
    return($ret);
}
function getNextNo($iType, $frm){
    $strSQL = "SELECT full_no,next_no from mr where type = '$iType'";
    $lastNo = execSQLReturn($strSQL);
    $lastNOdb = $lastNo['full_no'];
    $nextNO = $lastNOdb;
    if ($lastNo['in_use']==1){
        if ($lastNo['next_no']==1){
            updateNextNo($iType,$lastNo['next_no']+1,$lastNOdb, $frm);
            $nextNO = $lastNo['full_no'];
        }else{        
            $baseType = substr($lastNOdb,0,4);
//            $baseDate = substr($lastNOdb,4,-4);
            $baseDate = date("dmy");
            $baseFormat = substr($lastNOdb,0,-4);
            $baseCountZero = substr($lastNOdb,-4);        
            $baseCount = (int)$baseCountZero;
            $differs = strlen(trim($baseCountZero)) - strlen($baseCount);
            $zeroMarch="";
            for ($s=1;$s<=($differs);$s++){
                $zeroMarch .="0";
            }        
            $baseCountZero = (int)$lastNo['next_no']  ;
            $baseFormat = $baseType.$baseDate;
            $nextNO = $baseFormat.$zeroMarch.$baseCountZero ;
            updateNextNo($iType,$baseCountZero+1,$nextNO,$frm);
        }
    }
    $useThis = trim($nextNO) ;
    execSQL("update mr set in_use=1 where type='$iType'");
    return ($useThis);
}

function updateNextNo($iType, $nextNo, $fullNextNo, $frmSource){
    if ($userLoged = ''){ $userLoged = getLoginStatus(); }
    $last = (int)$nextNo - 1;    
    $strSQL = "UPDATE mr set next_no =$nextNo , last_no =$last  , full_no = '$fullNextNo' , 
              frm_update_by='$frmSource',  lupd_datetime=now() , lupd_user='$userLoged' where type='$iType' ";
    //print $strSQL;
    execSQL($strSQL) or die (("failed!! \n Please contact PT. Priatman --") . mysql_error());
    return ;
}
function resetNo($iType, $frmSource){
    if($iType = 'PO'){
            $head = 'PON' ; 
        }else{ 
            $head = $iType ;
        }
    $resetVal = ($head."/". date("dmy").'0001');
    updateNextNo($iType,1,$resetVal,$frmSource);
    $ret = getNo($iType);
    return ($ret);
}

function execSQLReturn($strSQL){
//    print $strSQL;
    $retVal = mysql_query($strSQL) or die (mysql_error());
    $reArray[]="";
    reset($reArray);
    while($retFetch = mysql_fetch_assoc($retVal)){
        if (mysql_fetch_row($retVal)>1){
             array_push($reArray,$retFetch);
        }else{
            $reArray = $retFetch;
        }
    }
    unset($strSQL);
    return $reArray;
}
function array2table($arr,$width){
   $count = count($arr);
   $width .= "%"; 
   if($count > 0){
       reset($arr);
       $num = count(current($arr));
       echo "
			<div style='border:1px  solid  #CCCCCC; width:670px; height:200px; overflow:auto;'>
			<table border='0' cellpadding='3' cellspacing='3' width=$width>
            <tr>
       ";
       foreach(current($arr) as $key => $value){
           echo "<th>";
           echo $key."&nbsp;";
           echo "</th>\n";   
           }   
       echo "</tr>\n";
       while ($curr_row = current($arr)) {
//           echo "<tr>\n";
           $col = 1;
           while ($curr_field = current($curr_row)) {
               echo "<td>";
               echo $curr_field."&nbsp;";
               echo "</td>\n";
               next($curr_row);
               $col++;
               }
           while($col <= $num){
               echo "<td>&nbsp;</td>\n";
               $col++;       
           }
           echo "</tr>\n";
           next($arr);
           
           }
        echo "</table></div>";
       }
/* cara pake ....
$temp = mysql_query("query mysql ....");
while($row = mysql_fetch_assoc($temp)){
  $array[] = $row; }
       
array2table($array,100); 
*/       
}

function getAcess($element, $vaed){
    $ret = "<script language:javascript>document.getElementByID('$element').visibility='$vaed'; </script>";
    return($ret);
}


/*foreach ($GLOBALS as $gl => &$val){
    echo "$gl  :  ";
    print_r ($val) ;
    echo "<br /> \n";
*/

?>

