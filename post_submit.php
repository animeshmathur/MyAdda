<?php
include("session.php");
include("mysqlconnect.php");
$post_text=$_REQUEST['post_text'];
$post_text=str_replace("'","''",$post_text);
$post_text=str_replace("<","&lt;",$post_text);
$post_text=str_replace(">","&gt;",$post_text);
$res=mysql_query("select post_id from autogen");
if($row=mysql_fetch_array($res))
{
	mysql_query("insert into posts values('".$row['post_id']."','".$post_text."',NOW(),'".$uid."')");
	mysql_query("update autogen set post_id=post_id+1");
	echo $row['post_id'];
}
?>