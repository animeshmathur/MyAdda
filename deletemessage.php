<?php
include("session.php");
include("mysqlconnect.php");
$msgid=$_REQUEST['msgid'];
$res=mysql_query("delete from messages where msgid='".$msgid."'");
header("location:messages.php");
?>
