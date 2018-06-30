<?php
include("session.php");
include("mysqlconnect.php");
session_destroy();
$res1=mysql_query("delete from chat where txtfrom='".$uid."' or txtto='".$uid."'");
$res2=mysql_query("delete from onlineuser where uid='".$uid."'");
header("location:index.php");
?>