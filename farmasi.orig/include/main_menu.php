<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>
<body>
<div id="ddsidemenubar" class="markermenu" style="width:100%">
<ul>
<?php
$qu= mysql_query("SELECT * FROM user where id='".$_SESSION['U_ID']."' order by id asc");
while($ru = mysql_fetch_array($qu))
{
	if (trim($_SESSION['U_KODE']) == trim($ru['type_id']))
	{
		if ($ru['unit_id'] == "")
		{$fld08 = "";}
		else
		{$fld08 = "and id='".$ru['unit_id']."'";}
		if ($ru['type_id']=='3')
		{$Group = "";}
		else
		{$Grpup="and fld06 = '".$ru['group_id']."'";}
		$q= mysql_query("SELECT * FROM tbl_menu where menu = '1' ".$Group." ".$fld08." and f_aktif='1' order by id asc");
		while($r = mysql_fetch_array($q))
			{
			$qmen1 = mysql_query("SELECT * FROM tbl_menu where fld02='".$r['id']."' and f_aktif='1' order by id asc");
			$rmen1 = mysql_fetch_array($qmen1);
				//echo "".$rsub['Menu']."and".$rmen['fld01']."&nbsp;";
			if ($r['Menu']=$rmen1['fld01'])
				{
				$rel = "rel='ddsubmenuside".$r['id']."'";
				}
				else
				{
				$rel = "";
				}
			echo "<li> <a href='home.php?hal=".trim($r['Link'])."' ".$rel." ><img src='images/icon/".trim($r['fld01'])."'>&nbsp;".$r['name_menu']."</a></li>";
			}	
echo "<li><a href='logout.php'><img src='images/icon/logout.png'> Logout</a></li>";
echo "</ul>";
	
echo "<script type='text/javascript'>";
echo "ddlevelsmenu.setup('ddsidemenubar', 'sidebar')";
echo "</script>";

		$qsub= mysql_query("SELECT * FROM tbl_menu where Menu = '1' ".$Group." ".$fld08." and f_aktif='1' order by id asc");
		while($rsub = mysql_fetch_array($qsub))
		{	
		echo "<ul id='ddsubmenuside".$rsub['id']."' class='ddsubmenustyle blackwhite'>";
		$qsub1= mysql_query("SELECT * FROM tbl_menu where Menu = '2' and fld02 = '".$rsub['id']."' and f_aktif='1' order by id asc");
		while($rsub1 = mysql_fetch_array($qsub1))
			{
			echo "<li><a href='home.php?hal=".trim($rsub1['Link'])."'><img src='images/icon/".$rsub1['fdl01']."'>".$rsub1['name_menu']."</a>";
			$qmen1 = mysql_query("SELECT * FROM tbl_menu where fld03='".$rsub1['id']."' and f_aktif='1' order by id asc");
			$rmen1 = mysql_fetch_array($qmen1);
			if ($rsub1['id']=$rmen1['fld03'])
				{
				
					echo "<ul>";
					$qsub2= mysql_query("SELECT * FROM tbl_menu where Menu ='3' and fld02 = '".$rsub1['fld02']."' and fld03='".$rsub1['id']."' and f_aktif='1' order by id asc");
					while($rsub2 = mysql_fetch_array($qsub2))
					{
					echo "<li><a href='home.php?hal=".trim($rsub2['Link'])."'><img src='images/icon/".$rsub['fdl01']."'>".$rsub2['name_menu']."</a></li>";
					}
				echo "</ul>";
				}
			echo "</li>";
			} 
			echo "</ul>";
			echo "</li>";				
		echo "</ul>";
		}
	}
}
?>