<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_REQUEST['albumid'];
$photoid=$_REQUEST['photoid'];
//echo $albumid.",".$photoid;
$res1=mysql_query("select photo from photos where photoid='".$photoid."'");
if($row1=mysql_fetch_array($res1))
{
	$res2=mysql_query("update albums set albumcover='".$row1['photo']."' where albumid='".$albumid."'");
	echo "<font color=#FFFFFF>Album cover changed!</font>";
}
?>