<?php
include("session.php");
include("mysqlconnect.php");
$albumid=$_REQUEST['albumid'];
if($row=mysql_fetch_array(mysql_query("select activity_id from autogen")))
{$res=mysql_query("insert into activities values('".$row['activity_id']."','new_album_photo_".$albumid."',NOW(),'".$uid."')");
$res=mysql_query("update autogen set activity_id=activity_id+1");}
?>