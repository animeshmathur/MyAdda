<?php
include("session.php");
include("mysqlconnect.php");
$fid=$_REQUEST['fid'];
$q="delete from friends where reqfrom='".$uid."' and reqto='".$fid."' or reqfrom='".$fid."' and reqto='".$uid."'";
$res=mysql_query($q);
header("location:friends.php");
?>