<?php
include("session.php");
include("mysqlconnect.php");
$postid=$_REQUEST['postid'];
$res=mysql_query("delete from posts where post_id=".$postid);
if($res==1)
{
echo "Removed!";
}
?>