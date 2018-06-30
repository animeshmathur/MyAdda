<?php
include("session.php");
include("mysqlconnect.php");
$atitle=$_REQUEST['atitle'];
$res1=mysql_query("select * from autogen");
if($row1=mysql_fetch_array($res1))
{
	$q="insert into albums values('".$row1['albumid']."','".$atitle."','albumcover.jpg','".$uid."')";
	//echo $q;
	$res2=mysql_query($q);
	if($res2)
	{
		$res3=mysql_query("update autogen set albumid=albumid+1");
		echo "<font color=green>Album Created!</font>";
	}
	
}
?>