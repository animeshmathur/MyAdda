<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_REQUEST['albumid'];
$res1=mysql_query("select * from photos where albumid='".$albumid."' order by photoid");
if(mysql_num_rows($res1))
{
	while($row1=mysql_fetch_array($res1))
	{
		$res2=mysql_query("delete from photos where photoid='".$row1['photoid']."'");
		if(file_exists("upload//album_photos//".$row1['photo'])==1)
		{	
			unlink("upload//album_photos//".$row1['photo']);
		}
	}
}
$res3=mysql_query("delete from albums where albumid='".$albumid."'");
header("location:albums.php");
?>