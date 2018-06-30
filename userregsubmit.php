<?php
include("mysqlconnect.php");
$uid=$_POST['user_id'];
$pwd=$_POST['user_pwd'];
$pwd=str_replace("'","''",$pwd);
$rpwd=$_POST['rpwd'];
$rpwd=str_replace("'","''",$rpwd);
$uname=$_POST['uname'];
$uanme=str_replace("'","''",$uname);
$ugender=$_POST['ugender'];
$bday=$_POST['bday'];
$bmonth=$_POST['bmonth'];
$byear=$_POST['byear'];
$ucity=$_POST['ucity'];
$umail=$_POST['umail'];
$umail=str_replace("'","''",$umail);
if($bday<10)
{
$bday="0".$bday;
}
if($bmonth<10)
{
$bmonth="0".$bmonth;
}
$dob=$byear."-".$bmonth."-".$bday;

if($row=mysql_fetch_array(mysql_query("select reg_id from autogen")))
{
	$res2=mysql_query("insert into register values('".$row['reg_id']."','".$uid."','".$pwd."','".$uname."','".$ugender."','".$ucity."','".$dob."','".$umail."','noimage.jpg')");
	mysql_query("update autogen set reg_id=reg_id+1");
	header("location:index.php?msg=1");	
}
?>