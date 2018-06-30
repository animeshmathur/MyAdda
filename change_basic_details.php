<?php
include("session.php");
include("mysqlconnect.php");
$uname=$_REQUEST['uname'];
$uname=str_replace("'","''",$uname);
$ugender=$_REQUEST['ugender'];
$ucity=$_REQUEST['ucity'];
$bday=$_REQUEST['bday'];
$bmonth=$_REQUEST['bmonth'];
$byear=$_REQUEST['byear'];
if($bday<10)
{
$bday="0".$bday;
}
if($bmonth<10)
{
$bmonth="0".$bmonth;
}
$dob=$byear."-".$bmonth."-".$bday;
//echo "update register set uname='".$uname."',ugender='".$ugender."',ucity='".$ucity."',dob='".$dob."'";
$res=mysql_query("update register set uname='".$uname."',ugender='".$ugender."',ucity='".$ucity."',dob='".$dob."' where uid='".$uid."'");
if($res==1)
echo "Details Updated Successfully!";
else
echo "Sorry! There is an error.";
?>