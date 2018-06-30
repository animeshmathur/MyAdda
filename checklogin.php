<?php
include("mysqlconnect.php");
$uid=$_POST['my_id'];
$pwd=$_POST['my_pwd'];
$pwd=str_replace("'","''",$pwd);
$res=mysql_query("SELECT reg_id,uid FROM register WHERE uid='".$uid."' AND pwd='".$pwd."'");
	if($row=mysql_fetch_array($res))
	{	
		session_start();
		$_SESSION['uid']=$uid;
		$_SESSION['reg_id']=$row['reg_id'];
		header("location:myhome.php");
		//echo "Login Successful!!!!".$res;
	}
	
	else
	{
		//echo "Login Unsuccessful";
		header("location:index.php?msg=0");
	}
mysql_close($con);
?>