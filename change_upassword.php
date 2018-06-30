<?php
include("session.php");
include("mysqlconnect.php");
$oldpwd=$_REQUEST['oldpwd'];
$newpwd=$_REQUEST['newpwd'];
$res1=mysql_query("select pwd from register where uid='".$uid."'");
if($row=mysql_fetch_array($res1))
{
if($oldpwd==$row['pwd'])
{
$oldpwd=str_replace("'","''",$oldpwd);
$newpwd=str_replace("'","''",$newpwd);
$res2=mysql_query("update register set pwd='".$newpwd."' where uid='".$uid."'");
if($res2==1)
echo "Password Updated Successfully!";
else
echo "Sorry! There is an error.";
}
else
{echo "Invalid old password! Password not changed.";}
}
?>