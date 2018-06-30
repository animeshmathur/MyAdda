<?php
include("mysqlconnect.php");
$userid=$_REQUEST['userid'];
if(mysql_num_rows(mysql_query("select uname from register where uid='".$userid."'")))
{
echo "<font color=#FF3333><img src=\"images/cross.jpg\" title=\"User ID unavailable! Please try another. \"></font>";
}
else
{
echo "<font color=green><img src=\"images/tick.jpg\" title=\"User ID avalable!\"></font>";
}
?>