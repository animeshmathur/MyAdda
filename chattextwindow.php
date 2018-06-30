<?php
include("session.php");
include("mysqlconnect.php");
$friend=$_REQUEST['friend'];
$q="select * from chat where (txtfrom='".$friend."' and txtto='".$uid."') and txt_status='0' order by txt_time";
$res=mysql_query($q);
//echo $res;
if(mysql_num_rows($res))
{
	while($row=mysql_fetch_array($res))
	{
		echo "<tr><td><i><b>".$row['txtfrom'].": </b></i></td><td><font color=blue><i>".$row['txt']."</i></font></td></tr>";
		mysql_query("update chat set txt_status='1' where (txtfrom='".$friend."' and txtto='".$uid."') and txt_time='".$row['txt_time']."'");	
	}
}
else
{
	echo "";
}
?>