<?php
include("session.php");
include("mysqlconnect.php");
$photoid=$_REQUEST['photoid'];
$res=mysql_query("select photo from photos where photoid='".$photoid."'");
if($row=mysql_fetch_array($res))
{
	echo "<img src=\"upload/album_photos/".$row['photo']."\" height=100% draggable=false ondragstart=\"return false\" oncontextmenu=\"return false\">";
}
?>