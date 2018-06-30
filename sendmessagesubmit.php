<?php 
include("session.php");
include("mysqlconnect.php");
$msgto=$_REQUEST['msgto'];
$msg=$_REQUEST['msgtext'];
$res=mysql_query("select msgid from autogen");
if($row=mysql_fetch_array($res))
{
	$msg=str_replace("'","''",$msg);
	$msg=str_replace("<","&lt;",$msg);
	$msg=str_replace(">","&gt;",$msg);
	$breaks = array("\r\n", "\n", "\r");
	$msg=str_replace($breaks,"<br>",$msg);
	if($msgto=="all")
	{
		$res1=mysql_query("select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
		if(mysql_num_rows($res1))
		{
			while($row1=mysql_fetch_array($res1))
			{
				if($row1['reqfrom']==$uid)
				{
					$q="insert into messages values('".$uid."','".$row1['reqto']."','".$msg."',NOW(),'".$row['msgid']."',1)";
				}
				else
				{
					$q="insert into messages values('".$uid."','".$row1['reqfrom']."','".$msg."',NOW(),'".$row['msgid']."',1)";
				}
				$res2=mysql_query($q);
				if($res2)
				{
					$res3=mysql_query("update autogen set msgid=msgid+1");
				}
			}
			echo "<font color=green>Message Composed to all!</font>";
		}
	}
	else
	{
		$q="insert into messages values('".$uid."','".$msgto."','".$msg."',NOW(),'".$row['msgid']."',1)";
		//echo $q;
		$res1=mysql_query($q);
		if($res1)
		{
			$res2=mysql_query("update autogen set msgid=msgid+1");
			echo "<font color=green>Message Composed!</font>";
		}
		else
		{
			echo "<font color=#FF0000>Error occurred while composing!</font>";
		}
	}
}
else
{
	echo "<font color=#FF0000>Error occurred while composing!</font>";
}
?>