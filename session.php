<?php
session_start();
if(isset($_SESSION['uid']))
{
	$uid=$_SESSION['uid'];
	$id=$_SESSION['reg_id'];
}
else
{
	header("location:index.php");
}
?>