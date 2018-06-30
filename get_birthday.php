<?php
include("session.php");
include("mysqlconnect.php");
$res1=mysql_query("select * from friends where reqfrom='".$uid."' and status='accepted' or reqto='".$uid."' and status='accepted'");
if(mysql_num_rows($res1))
{
	$friend_id="";
	while($row1=mysql_fetch_array($res1))
	{
		if($row1['reqfrom']==$uid)
		{
			$friend_id=$row1['reqto'];
		}
		else
		{
			$friend_id=$row1['reqfrom'];
		}
		$res2=mysql_query("select uname from register where uid='".$friend_id."' and substring(dob,5)=substring(DATE(Now()),5)");
		if($row2=mysql_fetch_array($res2))
		{
			echo "<tr><td style=\"border-bottom:thin #E5E5E5 solid;\"><img src=\"images/bday.jpg\" height=22px width=26px></td><td style=\"border-bottom:thin #E5E5E5 solid;\"><font color=\"#0066CC\"><i>".$row2['uname']."</i></font></td></tr>";
		}
	}
}
?>