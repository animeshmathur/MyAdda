<?php
include("session.php");
include("mysqlconnect.php");
$fid=$_REQUEST["fid"];
$q="insert into friends values('".$uid."','".$fid."','pending')";
$res=mysql_query($q);
echo "<font color=green>(<i>Friend Request Sent</i>)</font>";
?>