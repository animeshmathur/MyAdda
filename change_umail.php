<?php
include("session.php");
include("mysqlconnect.php");
$umail=$_REQUEST['umail'];
$umail=str_replace("'","''",$umail);
$res=mysql_query("update register set umail='".$umail."' where uid='".$uid."'");
if($res==1)
echo "E-mail updated successfully!";
else
echo "Sorry! There is an error.";
?>