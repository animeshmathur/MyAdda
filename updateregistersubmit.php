<?php
include("session.php");
include("mysqlconnect.php");
$ucity=$_REQUEST["ucity"];
$umail=$_REQUEST["umail"];
$umail=str_replace("'","''",$umail);
$q="update register set ucity='".$ucity."',umail='".$umail."' where uid='".$uid."'";
$res=mysql_query($q);
header("location:profile.php");
?>